var wtranslate = (function($){
  var open = false;
  var l = null;
  var t = {};
  var pub = {
    msg: function(o){
      if(jbar) {jbar.open(o);}
    },
    add: function(col, obj){
      var li = $('<li/>').addClass('item');
      var div = $('<div/>').text(obj.text);
      var a = $('<a/>',{'class': 'wtranslate fancybox.ajax', id:'wt-'+obj.ref, href: obj.url}).text('edit');

      var span = $('<span/>').append(a);
      div.append(span);
      li.append(div);

      $('ul',col).append(li);
      col.show();
    },
    update: function (f)
    {
      var data = f.serialize();
      $.ajax({
        url: f.attr('action'),
        data: data,
        dataType: 'json',
        type: 'post',
        success: function(d){
          if(typeof d == 'object'){
            $('.wt-'+d.id).text(d.translation);
            var a = $('#wt-'+d.id);
            if(a.length){
              a.closest('div').addClass('edited');
            }
            jbar.open(d);
          }
        }
      });
      $.fancybox.close();
    },
    init: function(){
      $('.wtranslate').click(function(e){
        if(e.altKey){
          e.preventDefault();
          e.stopPropagation();
          $.get($(this).data('url'), function(content){
            $.fancybox(content, {
              maxWidth  : 800,
              maxHeight : 600,
              minWidth  : 800,
              fitToView : false,
              width   : '70%',
              height    : '70%',
              autoSize  : false,
              closeClick  : false,
              openEffect  : 'none',
              closeEffect : 'none',
              afterShow : function(){
                $('.wtranslate-wysiwyg').wysiwyg({initialContent:''});
              }
            });
          });
        }
      });
      $('#wtranslator-footerSlideButton').on('click',function(){
        var content = $('#wtranslator-footerSlideContent');
        var w = $('#wtranslator-footerSlideText').height() + 50;
        if(content.is(':animated'))
          return false;

        if(content.hasClass('footerSlideVisible')){
          content.animate({ height: '0px' }).removeClass('footerSlideVisible').addClass('footerSlideHidden');
          $(this).css('backgroundPosition', 'top left');
        }
        else {
          content.animate({ height: w+'px' }).removeClass('footerSlideHidden').addClass('footerSlideVisible');
          $(this).css('backgroundPosition', 'bottom left');
        }
        return false;
      });
      $(document).on('click', '.translate-buttons > a', function() {
        var action = $(this).attr('rel');
        if(action=='submit')
        {
          var frm = $('.translate-form > form');
          wtranslate.update(frm);
        }
        else if(action=='close')
        {
          $.fancybox.close();
        }
        return false;
      });
    }
  };

  return pub;

})(jQuery);