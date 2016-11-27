jQuery(document).ready(function($){
  
  /****************
    General Setup
  *****************/

  $('.chzn-select').chosen({width : "49%"});

  $('.chzn-product').chosen({width : "80%"});

  $('.datepicker').datepicker({changeMonth: true, changeYear: true, yearRange: "2012:" + new Date().getFullYear(), dateFormat: 'dd/mm/yy'});

  // Search

  $('#search-form').on('submit', function(e){
      e.preventDefault();
      $(this).data('offset', 0);
      $('#results').html('');
      $.search();
    })

  $('#results').on('click', '.product a', function(e){
    e.preventDefault();
    var $product = $(this).parent();
    var stock = $product.data('stock');

    $('#product').val(stock.upc._id);
    $('a[href="#products"]').click();
  })

  $.search = function (opts) {
    default_opts = {
      $form: $('#search-form'),
      $search: $('#search'),
      against: ['pcode'],
      url: $('#search-form').attr('action'),
      keyword: $('#search').val(),
      limit: 12,
      offset: ~~$('#search-form').data('offset'),
      include_stock_info: 1
    }
    var options = $.extend({}, default_opts, opts);
    
    $.getJSON(options.url, { keyword:options.keyword, limit:options.limit, offset:options.offset, include_stock_info:options.include_stock_info, against:options.against }, function(response){
      for (var i=0; i < response.products.length; i++) {
        var product = response.products[i];
        if (product.stocks) {
          for (var j = product.stocks.length - 1; j >= 0; j--) {
            var item = product.stocks[j];
            var $item = $('<div>', { class: 'product' }).html("<a href='#' title='Màu: "+item.upc.color.name+", Cỡ: "+item.upc.size.name+"'><img width=100 src='"+createProductImageLink(product, undefined, item.color_id)+"'/></a>");
            $item.data('product', product);
            $item.data('_id', product._id);
            $item.data('stock', item);
            $item.prependTo($('#results'));
          };
        };
        
      };
      options.$form.data('offset', options.offset + response.products.length);
      if (response.products.length == options.limit) {
        $('#more').show();
      } else {
        $('#more').hide();
      }
      
      if (options.afterRender) {
        options.afterRender();
      };
    })
  }

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

  function createProductImageLink(product, size, color_id) {
    if (typeof(size) === 'undefined') {
      size = 'listing';
    };
    if (typeof(product) === 'undefined') {
      return false;
    };
    var url = product.images[0].url;
    if (typeof(color_id) !== 'undefined') {
      for (var i = product.images.length - 1; i >= 0; i--) {
        var item = product.images[i];
        if (item.color_id == color_id) {
          url = item.url;
          break;
        };
      };
    };
    var info = pathinfo(url, 8 | 4);
    var newname = info['filename']+"_"+size+"."+info['extension'];
    return '/uploads/' + newname;
  }

  /******************
    Form Validation
  ******************/

  $('#form').validate({
    wrapper: 'span class="error"',
    meta: 'validate',
    highlight: function(element, errorClass, validClass) {
      if (element.type === 'radio') {
        this.findByName(element.name).addClass(errorClass).removeClass(validClass);
      } else {
        $(element).addClass(errorClass).removeClass(validClass);
      }
    
      // Show icon in parent element
      var error = $(element).parent().find('span.error');
    
      error.siblings('.icon').hide(0, function() {
        error.show();
      });
    },
    unhighlight: function(element, errorClass, validClass) {
      if (element.type === 'radio') {
        this.findByName(element.name).removeClass(errorClass).addClass(validClass);
      } else {
        $(element).removeClass(errorClass).addClass(validClass);
      }
    
      // Hide icon in parent element
      $(element).parent().find('span.error').hide(0, function() {
        $(element).parent().find('span.valid').fadeIn(200);
      });
    }
  });

  // Add valid icons to validatable fields
  $('form p > *').each(function() {
    var element = $(this);
    if(element.metadata().validate) {
      element.parent().append('<span class="icon tick valid"></span>');
    }
  });

  /******************
   Others
   ******************/

  //Add & edit products
  var $product = $('#product');
  var $quantity = $('#quantity').css('border', 'none');
  $('#addproduct').click(function (e) {
    e.preventDefault();
    $product.add($quantity).css('border', 'none');

    if ($product.val() == '') {
      $product.css('border', '1px solid red').focus();
      return false;
    }
    if ($quantity.val() == '') {
      $quantity.css('border', '1px solid red').focus();
      return false;
    }

    $('#products-table tbody').append('<tr>' +
        '<input type="hidden" name="order[products][upc_id][]" value="' + $product.val() + '" />' +
        '<td>' + $product.val() + '</td>' +
        '<td><input type="text" name="order[products][quantity][]" value="' + $quantity.val() + '" /></td>' +
        '<td class="actions"><a href="#" class="delete-product"><span class="glyph delete"></span></a></td></tr>');
  })

  $('#print-button').click(function (e) {
    window.frames["print_frame"].document.body.innerHTML = document.getElementById('printable').innerHTML;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
    window.frames["print_frame"].document.body.innerHTML = '';

    return false;
  })

  $('#products-table tbody').on('click', 'a.delete-product', function (e) {
    e.preventDefault();
    $(this).parents('tr').remove();
  })

  //Must have products
  $('#form').submit(function () {
    if ($('#products-table tbody tr').size() == 0) return false;
  })

  //Show note
  var noteTimeout;
  $('#inventory').on('mouseover', '.order-note', function () {
    $('.content').hide();
    $(this).find('.content').stop(true, true).show();
  })
  $('#inventory').on('mouseleave', '.order-note', function () {
    var $this = $(this);
    noteTimeout = setTimeout(function () {
      $this.find('.content').hide();
    }, 500)
  })
  $('#inventory').on('mouseover', '.content', function () {
    clearTimeout(noteTimeout);
    $(this).stop(true, true).show();
  })
  $('#inventory').on('mouseleave', '.content', function () {
    $(this).hide();
  })

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

  //Toggle advanced search
  $('#advance-search legend').click(function () {
    $(this).parent().find('form').slideToggle().end().find('.toggle').toggle();
  })

  //Export to CSV
  var exportUrl = $('#csv-export').attr('href');
  if (typeof exportUrl !== 'undefined') var token = exportUrl.indexOf('?') == -1 ? '?' : '&';
  $('#csv-export').click(function (e) {
    $(this).attr('href', exportUrl + token + 'k=' + encodeURIComponent($('#inventory_filter input').val()));
  })

  //Send email confirm toggle
  $('#inventory').on('click', '.send-email', function (e) {
    e.preventDefault();

    var $this = $(this);
    $('.mailer')
        .appendTo($this.parents('td')).show()
        .find('._id').text($this.parents('tr').attr('id'));
  })
  $('.mailer .close').click(function (e) {
    e.preventDefault();
    $(this).parents('.mailer').hide();
  })

  //Do send email
  $('.action-email input').click(function (e) {
    var $this = $(this);
    var $parent = $this.parents('.mailer');

    if ($parent.find('.email').val().length < 6) {
      return false;
    }

    $.ajax({
      url: $parent.parents('tr').find('a.send-email').attr('href'),
      data: {email: $parent.find('.email').val()},
      beforeSend:function () {
        $parent.find('.waiting').show();
        $this.attr('disabled', 'disabled');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.jGrowl('<span class="glyph alert" style="font-size: 16px;"></span> Error ' + jqXHR.status + ': ' + jqXHR.statusText);
      },
      complete: function (jqXHR, textStatus) {
        $parent.find('.waiting').hide();
        $this.removeAttr('disabled');
      },
      success: function (data, textStatus, jqXHR) {
        $.jGrowl('Email sent with token: ' + data);
        $parent.hide();
      }
    })
  })

  //Remove GA tracking
  $('#inventory').on('click', '.untrack', function (e) {
    return confirm('Are you sure want to permanently untrack this order from Google Analytics???');
  })

  //Edit coupon
  $('.edit-coupon a').click(function (e) {
    e.preventDefault();
    $('#coupons').toggle().focus();
  })
})



function pathinfo (path, options) {
  // http://kevin.vanzonneveld.net
  // +   original by: Nate
  // +  revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +  improved by: Brett Zamir (http://brett-zamir.me)
  // %    note 1: Inspired by actual PHP source: php5-5.2.6/ext/standard/string.c line #1559
  // %    note 1: The way the bitwise arguments are handled allows for greater flexibility
  // %    note 1: & compatability. We might even standardize this code and use a similar approach for
  // %    note 1: other bitwise PHP functions
  // %    note 2: php.js tries very hard to stay away from a core.js file with global dependencies, because we like
  // %    note 2: that you can just take a couple of functions and be on your way.
  // %    note 2: But by way we implemented this function, if you want you can still declare the PATHINFO_*
  // %    note 2: yourself, and then you can use: pathinfo('/www/index.html', PATHINFO_BASENAME | PATHINFO_EXTENSION);
  // %    note 2: which makes it fully compliant with PHP syntax.
  // -  depends on: dirname
  // -  depends on: basename
  // *   example 1: pathinfo('/www/htdocs/index.html', 1);
  // *   returns 1: '/www/htdocs'
  // *   example 2: pathinfo('/www/htdocs/index.html', 'PATHINFO_BASENAME');
  // *   returns 2: 'index.html'
  // *   example 3: pathinfo('/www/htdocs/index.html', 'PATHINFO_EXTENSION');
  // *   returns 3: 'html'
  // *   example 4: pathinfo('/www/htdocs/index.html', 'PATHINFO_FILENAME');
  // *   returns 4: 'index'
  // *   example 5: pathinfo('/www/htdocs/index.html', 2 | 4);
  // *   returns 5: {basename: 'index.html', extension: 'html'}
  // *   example 6: pathinfo('/www/htdocs/index.html', 'PATHINFO_ALL');
  // *   returns 6: {dirname: '/www/htdocs', basename: 'index.html', extension: 'html', filename: 'index'}
  // *   example 7: pathinfo('/www/htdocs/index.html');
  // *   returns 7: {dirname: '/www/htdocs', basename: 'index.html', extension: 'html', filename: 'index'}
  // Working vars
  var opt = '',
    optName = '',
    optTemp = 0,
    tmp_arr = {},
    cnt = 0,
    i = 0;
  var have_basename = false,
    have_extension = false,
    have_filename = false;

  // Input defaulting & sanitation
  if (!path) {
    return false;
  }
  if (!options) {
    options = 'PATHINFO_ALL';
  }

  // Initialize binary arguments. Both the string & integer (constant) input is
  // allowed
  var OPTS = {
    'PATHINFO_DIRNAME': 1,
    'PATHINFO_BASENAME': 2,
    'PATHINFO_EXTENSION': 4,
    'PATHINFO_FILENAME': 8,
    'PATHINFO_ALL': 0
  };
  // PATHINFO_ALL sums up all previously defined PATHINFOs (could just pre-calculate)
  for (optName in OPTS) {
    OPTS.PATHINFO_ALL = OPTS.PATHINFO_ALL | OPTS[optName];
  }
  if (typeof options !== 'number') { // Allow for a single string or an array of string flags
    options = [].concat(options);
    for (i = 0; i < options.length; i++) {
      // Resolve string input to bitwise e.g. 'PATHINFO_EXTENSION' becomes 4
      if (OPTS[options[i]]) {
        optTemp = optTemp | OPTS[options[i]];
      }
    }
    options = optTemp;
  }

  // Internal Functions
  var __getExt = function (path) {
    var str = path + '';
    var dotP = str.lastIndexOf('.') + 1;
    return str.substr(dotP);
  };


  // Gather path infos
  if (options & OPTS.PATHINFO_DIRNAME) {
    tmp_arr.dirname = this.dirname(path);
  }

  if (options & OPTS.PATHINFO_BASENAME) {
    if (false === have_basename) {
      have_basename = this.basename(path);
    }
    tmp_arr.basename = have_basename;
  }

  if (options & OPTS.PATHINFO_EXTENSION) {
    if (false === have_basename) {
      have_basename = this.basename(path);
    }
    if (false === have_extension) {
      have_extension = __getExt(have_basename);
    }
    tmp_arr.extension = have_extension;
  }

  if (options & OPTS.PATHINFO_FILENAME) {
    if (false === have_basename) {
      have_basename = this.basename(path);
    }
    if (false === have_extension) {
      have_extension = __getExt(have_basename);
    }
    if (false === have_filename) {
      have_filename = have_basename.substr(0, (have_basename.length - have_extension.length) - 1);
    }

    tmp_arr.filename = have_filename;
  }


  // If array contains only 1 element: return string
  cnt = 0;
  for (opt in tmp_arr) {
    cnt++;
  }
  if (cnt == 1) {
    return tmp_arr[opt];
  }

  // Return full-blown array
  return tmp_arr;
}

function basename (path, suffix) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ash Searle (http://hexmen.com/blog/)
  // +   improved by: Lincoln Ramsay
  // +   improved by: djmix
  // *   example 1: basename('/www/site/home.htm', '.htm');
  // *   returns 1: 'home'
  // *   example 2: basename('ecra.php?p=1');
  // *   returns 2: 'ecra.php?p=1'
  var b = path.replace(/^.*[\/\\]/g, '');

  if (typeof(suffix) == 'string' && b.substr(b.length - suffix.length) == suffix) {
    b = b.substr(0, b.length - suffix.length);
  }

  return b;
}

function dirname (path) {
  // http://kevin.vanzonneveld.net
  // +   original by: Ozh
  // +   improved by: XoraX (http://www.xorax.info)
  // *   example 1: dirname('/etc/passwd');
  // *   returns 1: '/etc'
  // *   example 2: dirname('c:/Temp/x');
  // *   returns 2: 'c:/Temp'
  // *   example 3: dirname('/dir/test/');
  // *   returns 3: '/dir'
  return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?$/, '');
}