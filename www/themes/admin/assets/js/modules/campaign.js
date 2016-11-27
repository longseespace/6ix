jQuery(document).ready(function($){

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
  
  // Data Tables
  if (six.action == 'index') {
    
    
  } else if (six.action === 'create' || six.action === 'update') {

    // tab?
    if (six.campaign.id) {
      $('a[href="#products"]').click();
    };

    // Search form
    $('#search-form').on('submit', function(e){
      e.preventDefault();
      $(this).data('offset', 0);
      $('#results').html('');
      $.search();
    })
    
    $('#more > a').on('click', function(e){
      e.preventDefault();
      $.search();
    })
    
    $('#results, #products').on('mouseenter', '.product', function(e){
      $(this).addClass('hover');
    }).on('mouseleave', '.product', function(e){
      $(this).removeClass('hover');
    })
    
    $('#results').on('click', 'a.add', function(e){
      e.preventDefault();
      var $item = $(this).parent();
      var product = $item.data('product');
      
      $item.find('a.add').remove();
      $item.fadeOut('medium', function(){
        $item.append($('<input>', { type:'hidden', name:'sale[product_ids][]', value:product.id })).appendTo('#products').fadeIn('medium');
      })
      $('a[href="#products"]').click();

      jQuery.ajax({
        url: six.addProductsUrl,
        type: 'POST',
        dataType: 'json',
        data: { product_ids : product.id },
        complete: function(xhr, textStatus) {
          //called when complete
        },
        success: function(data, textStatus, xhr) {
          //called when successful
          console.log(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          //called when there is an error
        }
      });
      
    })
    
    $('#products').on('click', 'a.remove', function(e){
      e.preventDefault();
      
      var $item = $(this).parent();
      
      $item.fadeOut('medium', function(){
        $item.remove();
      });

      jQuery.ajax({
        url: six.removeProductsUrl,
        type: 'POST',
        dataType: 'json',
        data: { product_ids : $item.data('id') },
        complete: function(xhr, textStatus) {
          //called when complete
        },
        success: function(data, textStatus, xhr) {
          //called when successful
          console.log(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          //called when there is an error
        }
      });
    })
    
    $("#category").change(function(e){
      e.preventDefault();
      $('#search-form').data('offset', 0);
      $('#results').html('');
      $.search();
    })
    
    $('#search').focus(function(){
      $('#uhoh').slideDown();
      $.search();
    })
    
    $('input').focus(function(){
      $(this).removeClass('error');
    })
    
    $("#products").sortable();
    
    $('#campaign-form').submit(function(e){
      var start_time = new Date($('#start-date').val() + ' ' + $('#start-time').val());
      var end_time = new Date($('#end-date').val() + ' ' + $('#end-time').val());
      
      $('.datepair input').removeClass('error');
      
      if (isNaN(start_time.getTime()) || isNaN(end_time.getTime())){
        $.jGrowl('Invalid Date');
        $('.datepair input').addClass('error');
        return false;
      }
      
      if ($('#campaign-name').val() === '') {
        $.jGrowl('Campaign Name is Required', { sticky : true });
        $('#campaign-name').addClass('error');
        return false;
      };
      
      start_time = start_time.format('Y-m-d H:i:s');
      end_time = end_time.format('Y-m-d H:i:s');

      $('#Campaign_start_time').val(start_time);
      $('#Campaign_end_time').val(end_time);
      
    })
    
    
  };
  
  $.search = function (opts) {
    default_opts = {
      $form: $('#search-form'),
      $search: $('#search'),
      category_id: $("#category").val(),
      url: $('#search-form').attr('action'),
      keyword: $('#search').val(),
      limit: 12,
      offset: ~~$('#search-form').data('offset')
    }
    var options = $.extend({}, default_opts, opts);
    
    $.getJSON(options.url, { keyword:options.keyword, limit:options.limit, offset:options.offset, category_id:options.category_id }, function(products){
      for (var i=0; i < products.length; i++) {
        var product = products[i];
        var $item = $('<div>', { class: 'product' }).html("<a target='_blank' href='' title='"+product.name+"'><img alt='"+product.name+"' width=100 src=''></a><a href='#' class='add'><span class='glyph plus2'></span></a>");
        $item.data('product', product);
        $item.data('_id', product._id);
        $item.prependTo($('#results'));
      };
      options.$form.data('offset', options.offset + products.length);
      if (products.length == options.limit) {
        $('#more').show();
      } else {
        $('#more').hide();
      }
      
      if (options.afterRender) {
        options.afterRender();
      };
    })
  }
  
  // General setup
  
  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();
  
  $('input[type="file"]').customFileInput();
  
  $('.chzn-select').chosen({width : "100%"});


});