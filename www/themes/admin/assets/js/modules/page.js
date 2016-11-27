jQuery(function ($) {

  $("#name").slugify({ target : '#slug' });

  //Drag drop image
  if (six.action == 'addnew' || six.action == 'edit') {
    // Drag & Drop File Upload
    $('#dropbox').pandoraFileDrop({
      url: six.uploadURL,
      width: 55,
      height: 55,
      varName: 'images[]',
      fallback_id: 'file'
    });
  }

  $('#dropbox').on('hover', '.preview.done', function (e) {
    if (e.type == 'mouseenter') {
      $(this).find('.delete').show();
    } else {
      $(this).find('.delete').fadeOut();
    }
  })

  //Remove image
  $('#dropbox').on('click', '.delete', function (e) {
    var $this = $(this);
    var filename = $this.siblings('input').val();

    $.ajax({
      type: 'POST',
      url: six.deleteURL,
      data: {ajax: true, filename: filename},
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

  /******************
   Form Validation
   ******************/

  $('form').validate({
    wrapper: 'span class="error"',
    meta: 'validate',
    highlight: function(element, errorClass, validClass) {
      if (element.type === 'radio') {
        this.findByName(element.name).addClass(errorClass).removeClass(validClass);
      } else {
        $(element).addClass(errorClass).removeClass(validClass);
      }

      // Show icon in parent element
      var error = $(element).parent().find('span.error');

      error.siblings('.icon').hide(0, function() {
        error.show();
      });
    },
    unhighlight: function(element, errorClass, validClass) {
      if (element.type === 'radio') {
        this.findByName(element.name).removeClass(errorClass).addClass(validClass);
      } else {
        $(element).removeClass(errorClass).addClass(validClass);
      }

      // Hide icon in parent element
      $(element).parent().find('span.error').hide(0, function() {
        $(element).parent().find('span.valid').fadeIn(200);
      });
    }
  });
})