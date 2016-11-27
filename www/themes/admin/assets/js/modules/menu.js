jQuery(document).ready(function ($) {
  
  $('.chzn-select').chosen({width : "100%"});

//  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();
  
  $( ".sortable" ).nestedSortable({
    disableNesting: 'no-nest',
    forcePlaceholderSize: true,
    listType: 'ul',
    helper:	'clone',
    handle: 'div.header',
    items: 'li',
    opacity: .5,
    placeholder: 'ui-state-highlight',
    revert: 250,
    tabSize: 20
  });

  /*******
   Tabs
   *******/

    // Hide all .tab-content divs
  $('.tab-content').livequery(function() {
    $(this).hide();
  });

  // Show all active tabs
  $('.box-header ul li.active a').livequery(function() {
    var target = $(this).attr('href');
    $(target).show();
  });

  // Add click eventhandler
  $('.box-header ul li').livequery(function() {
    $(this).click(function() {
      var item = $(this);
      var target = item.find('a').attr('href');

      if($(target).parent('form').length > 0) {
        if($(target).parent('form').valid()) {
          item.siblings().removeClass('active');
          item.addClass('active');

          item.parents('.box').find('.tab-content').hide();
          $(target).show();
        }
      } else {
        item.siblings().removeClass('active');
        item.addClass('active');

        item.parents('.box').find('.tab-content').hide();
        $(target).show();
      }

      return false;
    });
  });

  //Setup menus
  $('.menu-item-settings').hide();
  $('.all-menus').on('click', '.header a', function (e) {
    e.preventDefault();
    $(this).find('.down, .up').toggle().end().parent().siblings('.menu-item-settings').slideToggle();
  })
  
  // Edit Labels?
  $(".menu-item input.edit-menu-item-title").change(function(){
    var $menuitem = $(this).parents(".menu-item:first");
    $("span.title:first", $menuitem).css('text-decoration', 'line-through');
    $("span.newtitle:first", $menuitem).html($(this).val());
  })
  
  // Trigger form submit for custom button
  $("a[type=submit]").click(function(e){
    e.preventDefault();
    $(this).parents('form:first').submit();
  })

  //Add menu item
  $('#add-custom-menu').submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $title = $('#add-menu-custom .add-menu-title');
    var $url = $('#add-menu-custom .add-menu-url');
    var $class = $('#add-menu-custom .add-menu-class');
    var data = $this.serializeObject();
    data.menu_id = $('#edit-menu-id').val();

    if ($title.val() == '' || $url.val() == '') {
      $.jGrowl('Title and URL cannot be empty');
      return false;
    }

    $.ajax({
      type: 'POST',
      url: $this.attr('action'),
      data: {type: $this.data('type'), data: data},
      beforeSend:function () {
        $this.find('.waiting').show();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
        $this.find('.waiting').hide();
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Added menu item ID: ' + data);
        $this.find('.waiting').hide();

        var template = {
          id: data,
          title: $title.val(),
          url: $url.val(),
          classs: $class.val()
        }

        $title.val('');
        $url.val('');
        $class.val('');
        $('#add-custom-menu-template').tmpl(template).appendTo('.menus');
        $('.menus .newly-added').hide().removeClass('newly-added');
      }
    })
  })

  //Confirm delete menu item
  $('.menus, .menu-actions').on('click', '.delete', function (e) {
    e.preventDefault();
    $(this).siblings('.submitdelete').show();
  })

  //Delete menu item
  $('.menus').on('click', '.submitdelete', function (e) {
    e.preventDefault();
    var $a = $(this);
    var $this = $a.parents('li:first');

    $.ajax({
      type: 'POST',
      url: $a.attr('href'),
      data: {type: 'item', id: $a.data('id')},
      beforeSend:function () {
        $this.find('.waiting').show();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
        $this.find('.waiting').hide();
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Deleted menu item');
        $this.find('.waiting').hide();

        var $child = $this.find('> ul');

        $this.find('> .header').effect('highlight', {color: 'red'})
        $this.find('.menu-item-settings').slideUp(function () {
          if ($child.length > 0) {
            setTimeout(function () { //Unknown behavior
              $child.appendTo($this.parent()).children().unwrap();
              $this.remove();
            }, 300)
          } else $this.remove();
        });
      }
    })
  })

  //Cancel menu item
  $('.menus').on('click', '.submitcancel', function (e) {
    e.preventDefault();
    $(this).parents('li:first').find('.fields input').each(function () {
      $(this).val($(this).data('origin'));
    }).end().find('.submitdelete').hide();
  })

  //Edit menu name
  $('#menu-name').click(function () {
    $(this).hide();
    $('#edit-menu-name').val($(this).text()).show().focus();
  })
  $('#edit-menu-name').blur(function () {
    $(this).hide();
    $('#menu-name').text($(this).val()).show();
  })

  //Save menu
  $('#edit-custom-menu').submit(function () {
    $('#edit-menu-structure').val(JSON.stringify($('.menus').nestedSortable('toHierarchy')));
    return true;
  })

  //Popup menu list
  $('#menu-list-button').popover('#menu-list-popover');
  
  /*****************
   Fixed Menus
  *****************/
  $('.add-fixed-menu select[name=item]').change(function(){
    var title = $.trim($(this).find('option:selected').text().replace(/—/g, ''));
    var $form = $(this).parents('form:first');
    $("[name=title]", $form).val(title);
  })
  
  $('.add-fixed-menu').submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $title = $('[name=title]', $this);
    var $item = $('[name=item]', $this);
    var $slug = $('[name=slug]', $this);
    var $class = $('[name=class]', $this);
    var data = $this.serializeObject();
    data.menu_id = $('#edit-menu-id').val();
    data.slug = $slug.val();
    
    if (!Array.isArray(data.item)) {
      data.item = new Array(data.item);
    };

    if ($title.val() == '' || $item.val() == '') return false;

    $.ajax({
      type: 'POST',
      url: $this.attr('action'),
      data: {ajax: true, type: $this.data('type'), data: data},
      beforeSend:function () {
        $this.find('.waiting').show();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
        $this.find('.waiting').hide();
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Added menu item ID: ' + data);
        window.location = window.location;
        return false;
        
        $this.find('.waiting').hide();
        var template = {
          id: data,
          title: $title.val(),
          type: $this.data('type'),
          classs: $class.val(),
          item: items
        }

        $title.val('');
        $class.val('');
        $item.val('').trigger("liszt:updated");
        $('#add-fixed-menu-template').tmpl(template).appendTo('.menus');
        $('.menus .newly-added').hide().removeClass('newly-added');
      }
    })
  })
  
  // slug
  $("#brand-menu-title").slugify({ target : '#brand-menu-slug' });
  $("#category-menu-title").slugify({ target : '#category-menu-slug' });
  
})