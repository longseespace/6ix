jQuery(document).ready(function($){

  
  /****************
    General Setup
  *****************/

  $('.chzn-select').chosen({width : "49.5%"});

  $('.datepicker').datepicker({changeMonth: true, changeYear: true, yearRange: "1900:" + new Date().getFullYear(), dateFormat: 'dd/mm/yy', defaultDate: '16/09/1989'});

  $('input[type="file"]').customFileInput();

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
//  $('form p > *').each(function() {
//    var element = $(this);
//    if(element.metadata().validate) {
//      element.parent().append('<span class="icon tick valid"></span>');
//    }
//  });

  $('.remove-picture').click(function () {
    $(this).hide().next('.pic').hide().next('.no-pic').show().next('[name=picremoved]').val(1);
    return false;
  })
})