jQuery(document).ready(function($){
  
//  $("#hex").ColorPicker({
//    onShow: function (colpkr) {
//      $(colpkr).fadeIn(500);
//      return false;
//    },
//    onSubmit: function(hsb, hex, rgb, el) {
//      $(el).val(hex);
//      $(el).ColorPickerHide();
//    },
//    onBeforeShow: function () {
//      $(this).ColorPickerSetColor(this.value);
//    },
//    onChange: function (hsb, hex, rgb) {
//      $("#hex").val(hex);
//    }
//  });
  
  $("#colors li").hover(function(){
    $(this).wiggle('start').find('.delete').show();
  }, function(){
    $(this).wiggle('stop').find('.delete').fadeOut();
  });

  //Remove color
  $('#colors .delete').click(function (e) {
    var $this = $(this);
    var $id = $this.parents('li').attr('id');

    $.ajax({
      type: 'POST',
      url: six.color.deleteURL,
      data: {ajax: true, id: $id},
      beforeSend:function () {
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Color Deleted');

        $this.parents('li').remove();
      }
    })
  })
})