jQuery(document).ready(function ($) {

  $('.refresh').click(function (e) {
    var $this = $(this);
    if ($this.hasClass('analytics')) {
      $this.hide().siblings('.waiting').show();
      loadAnalytics(true, function () {
        $this.show().siblings('.waiting').hide();
      });
    } else if ($this.hasClass('visitors')) {
      $this.hide().siblings('.waiting').show();
      loadVisitors(true, function () {
        $this.show().siblings('.waiting').hide();
      });
    }
  })

  loadAnalytics();
  loadVisitors();
})

function loadAnalytics(refresh, callback) {
  var query = refresh ? 'r=1' : '';
  $.ajax({
    url: six.dashboard.analyticsUrl,
    data: query,
    dataType: 'json',
    success: function (result) {
      new Highcharts.Chart({
        chart: {
          renderTo: 'dashboardchart',
          type: 'spline',
          marginRight: '24',
          marginLeft: '50',
          marginTop: '24'
        },
        title: {
          text: ''
        },
        xAxis: {
          categories: result.date
        },
        yAxis: {
          title: {
            text: ''
          },
          plotLines: [
            {
              value: 0,
              width: 1,
              color: '#808080'
            }
          ]
        },
        legend: {
          borderWidth: 0
        },
        series: [
          {
            name: 'Unique visitors',
            data: result.uniques
          },
          {
            name: 'Visitors',
            data: result.visits
          }
        ]
      });
      if (typeof callback === 'function') callback();
    }
  })
}

function loadVisitors(refresh, callback) {
  var query = refresh ? 'r=1' : '';
  $.ajax({
    url: six.dashboard.visitorsUrl,
    data: query,
    dataType: 'json',
    success: function (result) {
      var $board = $('#visitors');
      var list = Object.keys(result);

      for (var i = 0; i < list.length; i++) {
        $('.' + list[i] + ' span', $board).text(result[list[i]]);
      }
      if (typeof callback === 'function') callback();
    }
  })
}