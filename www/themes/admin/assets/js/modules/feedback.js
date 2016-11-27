jQuery(document).ready(function($){
  
  /****************
    Datatable
  *****************/
  
  if (six.request.action === 'index') {
    $('.datatable#feedbacks').dataTable({
        iDisplayLength: six.feedback.paging.limit,
        iDisplayStart: six.feedback.paging.offset,
        sPaginationType: "full_numbers",
        bProcessing: false,
        sAjaxSource: six.feedback.ajaxUrl,
        bServerSide: true
    }).fnFilterOnReturn();
      
    $('.dataTables_wrapper').each(function() {
      var table = $(this);
      var info = table.find('.dataTables_info');
      var paginate = table.find('.dataTables_paginate');
    
      table.find('.datatable').after('<div class="action_bar nomargin"></div>');
      table.find('.action_bar').prepend(info).append(paginate);
    });
  };
  
  if ($("#modalcontainer > #detail").length == 0) {
    $("#modalcontainer").append($("#detail"));
  }
  
  $("#main #detail").remove();
  
  $("#feedbacks").on('click', 'tr', function(e){
    e.preventDefault();
    
    var id = $(this).index();
    var feedback = six.feedback.feedbacks[id];
    
    var message = new Object();
    message.website = (feedback.website_message == '') ? 'No message for website' : feedback.website_message;
    message.product = (feedback.product_message == '') ? 'No message for product' : feedback.product_message;
    message.service = (feedback.service_message == '') ? 'No message for service' : feedback.service_message;
    message.payment = (feedback.payment_message == '') ? 'No message for payment' : feedback.payment_message;
    message.other = (feedback.other_message == '') ? 'No message' : feedback.other_message;
    
    $("#website").html(message.website);
    $("#product").html(message.product);
    $("#service").html(message.service);
    $("#payment").html(message.payment);
    $("#other").html(message.other);
    
    $('#modalcontainer > div').hide();
    $('#modalcontainer #detail').show();
    $('#overlay').show();
  })
  
  /*******
    Tabs
  *******/

  // Hide all .tab-content divs
  $('.tab-content').livequery(function() {
    $(this).hide();
  });

  // Show all active tabs
  $('.box-header ul li.active a').livequery(function() {
    var target = $(this).attr('href');
    $(target).show();
  });

  // Add click eventhandler
  $('.box-header ul li').livequery(function() {
    $(this).click(function() {
      var item = $(this);
      var target = item.find('a').attr('href');
      
      if($(target).parent('form').length > 0) {
        if($(target).parent('form').valid()) {
          item.siblings().removeClass('active');
          item.addClass('active');

          item.parents('.box').find('.tab-content').hide();
          $(target).show();
        }
      } else {
        item.siblings().removeClass('active');
        item.addClass('active');

        item.parents('.box').find('.tab-content').hide();
        $(target).show(); 
      }

      return false;
    });
  });
  
  var chart = new Highcharts.Chart({
    chart: {
      renderTo: 'feedbackchart',
      type: 'line',
      height: 400,
      plotBackgroundColor: '#FAFAFA'
    },
    colors: [
      '#497EAC'
    ],
    title: {
      text: 'Score Overview'
    },
    xAxis: {
      labels: false
    },
    yAxis: {
      title: {
        text: ''
      },
      max: 10.5,
      endOnTick: false,
      plotLines: [{ value: 0, width: 1, color: '#808080' }]
    },
    legend: { enabled: false },
    series: [{
      name: 'Scores',
      data: six.feedback.stats.chartData.reverse()
    }]
  });
    
})