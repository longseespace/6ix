jQuery(function ($) {

  $('.two-selects .chzn-select').chosen({width: "49.5%"});
  $('.chzn-select').chosen({width : "100%"});

  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();

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

  //Add product
  $('.datatable.result').on('click', 'a.add', function (e) {
    $(this).parents('tr').clone()
        .removeAttr('id')
        .appendTo('#products tbody')
        .find('td:last-child')
        .html('<a href="#" class="button plain delete"><span class="glyph delete"></span>Delete</a>')
        .end()
        .append('<input type="hidden" name="collection[products][]" value="' + $(this).parents('tr').attr('id') + '"/>');
  })

  //Add product
  $('#products').on('click', 'a.delete', function (e) {
    $(this).parents('tr').remove();
  })

  //Show note
  var noteTimeout;
  $('.datatable').on('mouseover', 'tbody tr td:first-child a', function () {
    $('.content').removeClass('hovering');
    $(this).parents('td').find('.content').addClass('hovering').css('z-index', '10');
  })
  $('.datatable').on('mouseleave', 'tbody tr td:first-child a', function () {
    var $this = $(this);
    noteTimeout = setTimeout(function () {
      $this.parents('td').find('.content').removeClass('hovering').css('z-index', '8');
    }, 500)
  })
  $('.datatable').on('mouseover', '.content', function () {
    clearTimeout(noteTimeout);
  })
  $('.datatable').on('mouseleave', '.content', function () {
    $(this).removeClass('hovering').css('z-index', '8');
  })
})