jQuery(document).ready(function($){

    $("#approve").click(function(e){
      e.preventDefault();
      $('[name="review[status]"]').val(1);
      $("#reviewform").submit();
    })
    
    $("#reject").click(function(e){
      e.preventDefault();
      $('[name="review[status]"]').val(2);
      $("#reviewform").submit();
    })
  
})