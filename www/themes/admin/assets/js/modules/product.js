jQuery(document).ready(function($){

  if (six.action == 'create' || six.action == 'update') {

    var rcOptions = {
      menu: '#contextmenu',
      target: function(target){
        if ($(".preview.ui-selected", $('#dropbox')).length > 0) {
          return $(".preview.ui-selected", $('#dropbox'));
        }
        return target;
      },
      fn : {
        open: function(target){console.log($('a.open-image'));
          window.open($('a.open-image', target).attr('href'), '_blank');
        },
        delete: function(target){
          $('.delete', target).click();
        },
        label: function(target){
          $('.color-input', target).val($(this).data('color'));
          $('.color-preview', target).remove();
          $('<span>', {'class':'color-preview'}).css('background', $(this).data('hex')).appendTo(target);
        }
      }
    };

    // Drag & Drop File Upload
    $('#dropbox').pandoraFileDrop({
      url: six.uploadURL,
      uploadFinished: function(i, file, response) {
        $.data(file).addClass('done');
        if (response.hasOwnProperty('error') && response.error) {
          $.jGrowl(response.message);
        } else {
          $("<input>", {
            'type': 'hidden',
            'name': 'upload[file][]',
            'class': 'filename-input'
          }).val(response.filename).prependTo($.data(file));
          $("<input>", {
            'type': 'hidden',
            'name': 'upload[id][]',
            'class': 'id-input'
          }).val(response.id).prependTo($.data(file));
          $("<input>", {
            'type': 'hidden',
            'name': 'upload[pattern_id][]',
            'class': 'color-input'
          }).prependTo($.data(file));
          $('<span class="glyph delete"></span>').prependTo($.data(file));
          $.data(file).find('.progressHolder').fadeOut(2000).end().rightclick(rcOptions);
        }
      }
    });
    
    $("#dropbox").sortable();
    
    $(document).keydown(function(e){
      if (e.shiftKey){
        $("#dropbox").sortable('destroy').selectable();
      }
    })
    
    $("#dropbox").click(function(e){
      if (e.target.nodeName !== 'IMG') {
        $("#dropbox").selectable('destroy').sortable();
        $('.ui-selected').removeClass('ui-selected');
      }
    })
    
    $('#dropbox').on('click', '.preview', function(e){
      $('.ui-selected', $(this)).removeClass('ui-selected');
      $(this).removeClass('ui-selectee').addClass('ui-selected');
    })

    $('#dropbox .preview').rightclick(rcOptions);

    //Remove image
    $('#dropbox').on('click', '.delete', function (e) {
      var $this = $(this);
      var id = $this.siblings('input.id-input').val();

      $.ajax({
        type: 'POST',
        url: six.deleteURL,
        data: {id: id },
        beforeSend:function () {
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
        },
        success: function (data, textStatus, jqXHR) {
          $.jGrowl('Image Deleted');

          $this.parents('.preview.done').remove();
        }
      })
      
    })
  }
  // end addnew & edit
  
  /****************
    General Setup
  *****************/
  
//  $('.taginput').tagsInput({
//    'width':'auto'
//  });

  $('.two-selects .chzn-select').chosen({width: "49.5%"});
  $('.chzn-select').chosen({width : "100%"});

//  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();

  $(".progressbar").each(function() {
    var options = $(this).metadata();
    $(this).progressbar(options);
  });

  $('#file-bulk-update').change(function(){
    smoke.confirm('Are you sure?', function(e){
      if(e){
        $('#form-bulk-update').submit();
      }
    });
  });

  //Advanced Search
  $('#advance-search form').submit(function (e) {
    e.preventDefault();
    var $this = $(this);
    var query = '';

    $('input, select', $this).each(function (i, e) {
      var $e = $(e);
      if ($e.attr('name') && $.trim($e.val()) != '') { //Skip submit button and blank field
        query += '|' + $e.attr('name') + ':' + $e.val();
      }
    })
    $('#inventory').dataTable().fnFilter(query.substring(1));
    $('#advance-search .waiting').show();
  })

  //Toggle advanced search
  $('#advance-search legend').click(function () {
    $(this).parent().find('form').slideToggle().end().find('.toggle').toggle();
  })

})
