jQuery(document).ready(function($){
  
  $('.datatable#mail').dataTable({
      iDisplayLength: six.mail.paging.limit,
      iDisplayStart: six.mail.paging.offset,
      sPaginationType: "full_numbers",
      aoColumns: [null, null, null, null, {"bSortable" : false}],
      bProcessing: false,
      sAjaxSource: six.mail.ajaxUrl,
      bServerSide: true
  }).fnFilterOnReturn();
    
  $('.dataTables_wrapper').each(function() {
    var table = $(this);
    var info = table.find('.dataTables_info');
    var paginate = table.find('.dataTables_paginate');
  
    table.find('.datatable').after('<div class="action_bar nomargin"></div>');
    table.find('.action_bar').prepend(info).append(paginate);
  });
  
})