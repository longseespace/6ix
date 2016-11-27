jQuery.fn.rightclick = function(data) {

  // Build menu HTML
  function createmenu(target) {
    // Allow plugin to modify target (i.e. selectable plugin)
    if (data.target) {
      target = data.target.call(target, target);
    };
    
    // Build menu with standard markup
    if (data.items !== undefined) {
      var menu = $('<ul class="contextmenu"></ul>').appendTo(document.body);
      data.items.forEach(function(item) {
        if (item) {
          var row = $('<li><a href="#"><span class="title"></span></a></li>').appendTo(menu);
          if (item.colors !== undefined) {
            row.find('img').attr('src', item.icon);
          } else {
            row.find('img').replaceWith('<span class="menuicon" style="background-color: #'+item.color+'"></span>');
          }
          row.find('span.title').text(item.label);
          if (item.action) {
            row.find('a').click(item.action);
          }
        } else {
          $('<li class=divider></li>').appendTo(menu);
        }
      });
    };
    
    // Build menu with custom markup
    if (data.menu !== undefined) {
      var menu = $(data.menu).clone().appendTo(document.body);
      
      menu.find('a').click(function(e){
        e.preventDefault();
        var action = $(this).data('action');
        
        if (data.fn[action]) {
          data.fn[action].call(this, target);
        };
      })
    };
    
    return menu;
  }

  // On contextmenu event (right click)
  this.bind('contextmenu', function(e) {
    
    // Create and show menu
    var menu = createmenu(this)
      .show()
      .css({zIndex:9696, left:e.pageX + 5 /* nudge to the right, so the pointer is covering the title */, top:e.pageY})
      .bind('contextmenu', function() { return false; });

    // Cover rest of page with invisible div that when clicked will cancel the popup.
    var bg = $('<div></div>')
      .css({left:0, top:0, width:'100%', height:'100%', position:'absolute', zIndex:6969})
      .appendTo(document.body)
      .bind('contextmenu click', function() {
        // If click or right click anywhere else on page: remove clean up.
        bg.remove();
        menu.remove();
        return false;
      });

    // When clicking on a link in menu: clean up (in addition to handlers on link already)
    menu.find('a').click(function() {
      bg.remove();
      menu.remove();
    });

    // Cancel event, so real browser popup doesn't appear.
    return false;
  });

  return this;
};

