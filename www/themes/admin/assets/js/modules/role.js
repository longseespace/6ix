jQuery(document).ready(function($){

  
  /****************
    General Setup
  *****************/

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

  // Add valid icons to validatable fields
  $('form p > *').each(function() {
    var element = $(this);
    if(element.metadata().validate) {
      element.parent().append('<span class="icon tick valid"></span>');
    }
  });

  //Add & Edit role
  $('#add-button').click(function () {
    $('#edit-role').hide();
    $('#add-role').show().find('input').eq(0).focus();
    return false;
  });
  $('#inventory').on('click', 'a.edit', function (e) {
    e.preventDefault();
    var $data = $(this).parents('tr');
    $('#add-role').hide();
    var $form = $('#edit-role').show()
        .find('.title').val($data.find('td:first-child').html()).focus().end()
        .find('.description').val($data.find('td:nth-child(2)').html()).end()
        .find('.id').val($data.attr('id')).end()
        .find('form');

    $form.attr('action', $form.attr('action').substring(0, $form.attr('action').lastIndexOf('/') + 1) + $data.attr('id'));
  });
})