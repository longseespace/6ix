jQuery(document).ready(function($){

  //Remove size
  $('#sizes .delete').click(function (e) {
    var $this = $(this);
    var $id = $this.parents('li').attr('id');

    $.ajax({
      type: 'POST',
      url: six.deleteURL,
      data: {ajax: true, id: $id},
      beforeSend:function () {
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Size Deleted');

        $this.parents('li').remove();
      }
    })
  })
})