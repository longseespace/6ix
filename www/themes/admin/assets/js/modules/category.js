jQuery(document).ready(function($){
  
  $('input[type="file"]').customFileInput();
  
//  $("#category-tree").jstree({
//    plugins : [ "html_data", "themes", "cookies" ],
//    themes : {
//      theme : "pandora",
//      dots: false
//    }
//  });
  
  $('.chzn-select').chosen({width : "100%"});
  
  // Drag & Drop File Upload
  $('#dropbox').pandoraFileDrop({
    url: six.uploadURL,
    varName: 'category[images][]',
    width: 50,
    height: 50
  });
  
  if (six.action == 'index') {
    // slug
    $("#name").slugify({ target : '#slug' });
  };
})