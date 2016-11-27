jQuery(document).ready(function($){

  
  // Form localStorage
  
  // if (six.request.action == 'addnew') {
  //   var options = {
  //     customKeyPrefix: 'brand_',
  //     timeout: 0,
  //     onRestore: function(){
  //       
  //     }
  //   }
  // }
  
  if (six.action == 'create') {
    // slug
    // $("#name").slugify({ target : '#slug' });
  };
  
  // General setup
  
//  $('input[type=checkbox], input[type=radio]').prettyCheckboxes();
  
  $('input[type="file"]').customFileInput();
  
  $('.chzn-select').chosen({width : "100%"});

})