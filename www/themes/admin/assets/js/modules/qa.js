jQuery(function ($) {

    /******************
     Form Validation
     ******************/

    $('form').validate({
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

    $('textarea.tinymce').tinymce({
        // Location of TinyMCE script
        // script_url : 'tiny_mce.js',

        // General options
        theme : "advanced",
        plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|tablecontrols,|,cleanup,help,code,|,code",
        theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,

        // Example content CSS (should be your site CSS)
        content_css : six.styleUrl + 'styles/admin/modules/page-content.css',

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",
        height: '500',
        width: '100%',
        relative_urls: false,
        document_base_url: six.styleUrl + '../'
    });
})