jQuery(document).ready(function($){
  
  /****************
    Datatable
  *****************/
  
  if (six.action === 'index') {

  };
  
  
  /****************
    General Setup
  *****************/
  $('.chzn-select.half').chosen({width : "49%"});
  $('.chzn-select').chosen({width : "100%"});
  
  //Popup menu list
  $('#addnew-button').popover('#addnew-popover');
  

  // Pretty file inputs

  $('input[type="file"]').customFileInput();
  
  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();

})