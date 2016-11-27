if (typeof(notifications) !== 'object') {
  notifications = new Object;
}

jQuery(document).ready(function($){
  $.jGrowl.defaults.closer = false;
  $.jGrowl.defaults.theme = 'lion';
  $.jGrowl.defaults.beforeOpen = function(e, m, o){
    e.find('div').wrapAll('<div class="border"/>');
  }
  
  for (var i=0; i < notifications.length; i++) {
    var notification = notifications[i];
    if (notification.notified) {
      continue;
    };
    if (notification.type == 'error') {
      $.jGrowl(notification.message, { 
        sticky : true
      })
    } else {
      $.jGrowl(notification.message, { sticky : false })
    }
  };
  
  $("#notifications .show").click(function(e){
    e.preventDefault();
    $("#primary, #secondary, #maincontainer").addClass('nodelay').css({ position : 'relative', left : '-300px' });
    $("#notifications").addClass('nodelay').css({ width : '290px' });
    $("#notifications .notifications").addClass('delay1s').show().css({ opacity : 1 });
    $(this).hide(); $(".nodelay").removeClass('nodelay');
    $("#notifications .hide").show();
  }).live();
  
  $("#notifications .hide").click(function(e){
    e.preventDefault();
    $("#primary, #secondary, #maincontainer").css({ position : 'relative', left : 0 });
    $("#notifications").css({ width : '0' });
    $("#notifications .notifications").addClass('delay1s').css({ opacity : 0 }).hide();
    $(this).hide();
    $("#notifications .show").show();
  }).live();
})