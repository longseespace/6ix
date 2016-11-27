;(function($) {

  $.fn.pandoraFileDrop = function(options) {
    var dropbox = this;
    var message = $('.message', this);

    var default_opts = {
      paramname: 'pic',
      varName: 'upload[file][]',
      width: 100,
      height: 100,
      maxfiles: 100,
      maxfilesize: 4,
      headers: { "X-Requested-With" : "XMLHttpRequest" },
      error: function(err, file) {
        switch(err) {
          case 'BrowserNotSupported':
            alert('Your browser does not support HTML5 file uploads!');
            break;
          case 'TooManyFiles':
            alert('Too many files! Please select 20 at most! (configurable)');
            break;
          case 'FileTooLarge':
            alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
            break;
          default:
            break;
        }
      },
      // Called before each upload is started
      beforeEach: function(file){
        if(!file.type.match(/^image\//)){
          $.jGrowl('Only images are allowed!');
          // Returning false will cause the
          // file to be rejected
          return false;
        }
      },
      progressUpdated: function(i, file, progress) {
        $.data(file).find('.progress').width(progress + '%');
        if (progress == 100) {
          $.data(file).find('.progressHolder').fadeOut(2000);
        };
      },
      uploadStarted:function(i, file, len){
        createImage(file, dropbox, message, opts.width, opts.height);
        $('.preview, .preview img').width(opts.width).height(opts.height);
        $('.progressHolder').width(opts.width - 10);
      },
      uploadFinished: function(i, file, response) {
        $.data(file).addClass('done');
        if (response.hasOwnProperty('error') && response.error) {
          $.jGrowl(response.message);
        } else {
          $("<input>").attr('type', 'hidden').attr('name', opts.varName).val(response.filename).prependTo($.data(file));
          $('<span class="glyph delete"></span>').prependTo($.data(file));
          $.data(file).find('.progressHolder').fadeOut(2000);
        }
      }
    }

    var opts = $.extend({}, default_opts, options);

    var template =  '<div class="preview">'+
                      '<span class="imageHolder">'+
                      '<img />'+
                      '<span class="uploaded"></span>'+
                      '</span>'+
                      '<div class="progressHolder">'+
                        '<div class="progress"></div>'+
                      '</div>'+
                    '</div>';
    function createImage(file, dropbox, message, width, height){
      var preview = $(template),image = $('img', preview);
      var reader = new FileReader();

      image.width = width;
      image.height = height;

      reader.onload = function(e){

        // e.target.result holds the DataURL which
        // can be used as a source of the image:

        image.attr('src',e.target.result);
      };

      // Reading the file as a DataURL. When finished,
      // this will trigger the onload function above:
      reader.readAsDataURL(file);

      message.hide();
      preview.appendTo(dropbox);

      // Associating a preview container
      // with the file, using jQuery's $.data():

      $.data(file,preview);
    }

    this.filedrop(opts);
	}
})(jQuery);