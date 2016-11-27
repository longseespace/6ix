jQuery(document).ready(function($){


  
  /****************
    General Setup
  *****************/

  $('.chzn-select').chosen({width : "49.5%"});

  $('input[type="file"]').customFileInput();

  // Return a helper with preserved width of cells
  $(".sortable").sortable({
    helper: function(e, ui) {
      ui.children().each(function() {
        $(this).width($(this).width());
      });
      return ui;
    }
  }).disableSelection();
})