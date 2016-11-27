$('document').ready(function() {
  
  // Active menu
  var $secondary = $('#secondary');
  var $submenu = $('nav#primary .submenu li.active').parent();
  if ($submenu.length > 0) {
    $submenu.parent().addClass('active');
    var $clone = $submenu.clone();
    $clone.appendTo($secondary);
    $('.submenu', $secondary).removeClass('submenu');
    $secondary.data('content', $clone);
    $secondary.width(183);
    $clone.width(180);
  }
  
  // Show Submenu
  $('nav#primary li > a').click(function(e){

    var $parent = $(this).parent();
    var $secondary = $('#secondary');

    if ($parent.hasClass('showSubmenu')) {

      var $clone = $('.submenu', $parent).clone();
      $secondary.html('');
      $clone.appendTo($secondary);
      $('.submenu', $secondary).removeClass('submenu');
      $secondary.width(183);
    } else {
      $secondary.html('').width(0);
    }
  })

  $('nav#primary li > a').hover(function(e){

    var $parent = $(this).parent();
    var $secondary = $('#secondary')
    
    if ($parent.hasClass('showSubmenu')) {
      e.preventDefault();
      $secondary.html('');
      $('.submenu', $parent).clone().appendTo($secondary);
      $('.submenu', $secondary).removeClass('submenu');
      $secondary.width(183);
    } else {
      var $clone = $secondary.data('content');
      if ($clone) {
        $secondary.html('').append($clone).width(183);  
      } else {
        $secondary.html('').width(0);
      }
      
    }
  })

  $('#maincontainer').hover(function(e){
    e.preventDefault();

    var $parent = $(this).parent();
    var $secondary = $('#secondary')

    if ($secondary.data('content')) {
      var $clone = $secondary.data('content');
      $secondary.html('').append($clone).width(183);
    } else {
      $secondary.html('').width(0);
    }
  })
  
  /******************
    Tablet rotation
  ******************/
  
  var isiPad = navigator.userAgent.match(/iPad/i) != null;
  
  if(isiPad) {
    $('body').prepend('<div id="rotatedevice"><h1>Please rotate your device 90 degrees.</div>');
  }
  
  /********
    Login
  ********/
  
  $('#login_entry > a').click(function() {    
    $(this).fadeOut(200, function() {
      $('#login_form').fadeIn();
    });

    return false;
  });
  
  
  /*******
    PJAX
  *******/
  
  // $('nav#primary a').click(function() {
  //   window.location = $(this).attr("href");
  //   return false;
  // });
  
  function init() {
    
    /************************
      Combined input fields
    ************************/
    
    $('p.combined input:last-child').addClass('last-child');
  
    /**********************
      Modal functionality
    **********************/
  
    $('a.modal').each(function() {
      var link = $(this);
      var id = link.attr('href');
      var target = $(id);
      
      if($("#modalcontainer " + id).length == 0) {
        $("#modalcontainer").append(target);
      }
      
      $("#main " + id).remove();
    
      link.click(function() {
        $('#modalcontainer > div').hide();
        target.show();
        $('#overlay').show();
      
        return false;
      });
    });
  
    $('.close').click(function() {
      $('#modalcontainer > div').hide();
      $('#overlay').hide();
    
      return false;
    });
    
    /***********************
      Secondary navigation
    ***********************/
    
    $('nav#secondary > ul > li > a').click(function() {
      $('nav#secondary li').removeClass('active');
      $(this).parent().addClass('active');
    });
  
  }
  
  init();

});

