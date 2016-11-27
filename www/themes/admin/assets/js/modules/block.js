jQuery(document).ready(function($){
  
  var borderWidth=6;
  
  if (six.action === 'index') {

  };
  
  /****************
    Block 
  *****************/
  
  $("#element-id").change(function(){
    var element_id = $(this).val();
    if (element_id > 0) {
      $("#add-element").fadeIn();
    };
  })
  
  $("#add-element, #add-element-alt").click(function(e){
    e.preventDefault();
    
    var element_id = $("#element-id").val();
    var element_width = $("#element-width").val();
    var element_height = $("#element-height").val();
    var element_class = $("#class").val();
    var element_float = $("#" + $(".float label.checked").attr('for')).val();
    var element_border = "";
    var element_style = $("#style").val();
    
    $(".border label.checked").each(function(){
      element_border = element_border + ' ' + $("#" + $(this).attr('for')).val();
    })
    
    if (element_width === '') {element_width = 'w160'};
    if (element_height === '') {element_height = 'h150'};
    
    var element = {
      id : element_id,
      width : element_width,
      height : element_height,
      float : element_float,
      border : element_border,
      class: element_class,
      style: element_style,
    };
    
    $("<input>", { type : 'hidden', name : 'Block[elements]['+element_id+']', value : JSON.stringify(element) }).appendTo($("#block-box form"));
    $("<div>", { id : 'element-' + element_id }).addClass('no-space').addClass(element_class).addClass(element_width).addClass(element_height).addClass(element_float).addClass(element_border).data('element', element).appendTo("#preview .elements");
    $("#preview").css('min-height', 0);
    $(document).trigger('blockChange');
    
    $('.placeholder').hide();
  });
  
  $("#update-element").click(function(e){
    e.preventDefault();
    
    var element_id = $("#element-id").val();
    var element_width = $("#element-width").val();
    var element_height = $("#element-height").val();
    var element_class = $("#class").val();
    var element_float = $("#" + $(".float label.checked").attr('for')).val();
    var element_border = "";
    var element_style = $("#style").val();
    
    $(".border label.checked").each(function(){
      element_border = element_border + ' ' + $("#" + $(this).attr('for')).val();
    })
    
    if (element_width === '') {element_width = 'w160'};
    if (element_height === '') {element_height = 'h150'};
    
    var element = {
      id : element_id,
      width : element_width,
      height : element_height,
      float : element_float,
      border : element_border,
      class: element_class,
      style: element_style
    };
    
    $("input[data-id="+element_id+"]").val(JSON.stringify(element));
    $("#element-"+element_id).attr('style', '').attr('class', '').addClass('no-space').addClass(element_class).addClass(element_width).addClass(element_height).addClass(element_float).addClass(element_border);
    
    $("#preview").css('min-height', 0);
    $(document).trigger('blockChange');
    
    $('.placeholder').hide();
    
    $("#element-box").trigger('reset');
  });
  
  $("#delete-element").click(function(e){
    e.preventDefault();
    
    var element_id = $("#element-id").val();
    $("input[data-id="+element_id+"]").remove();
    $("#element-"+element_id).fadeOut('medium', function(){ $(this).remove(); });
    
    $("#element-box").trigger('reset');
  })
  
  $("#preview .elements a").click(function(e){
    e.preventDefault();
  })
  
  $("#preview .elements > div").click(function(e){
    var id = $(this).data('id');
    var element = $.parseJSON($("input[data-id="+id+"]").val());
    
    $("#element-id").val(element.id);
    $("#element-width").val(element.width);
    $("#element-height").val(element.height);
    $("#class").val(element.class);
    $("#style").val(element.style);
    
    $("#element-id, #element-width, #element-height").trigger("liszt:updated");
    $(".radio.checked, .checkbox.checked").removeClass('checked');
    
    $("label[for='float-" + element.float + "']").addClass('checked');
    
    if (element.border) {
      var borders = $.trim(element.border.replace(/border-/g, '')).split(' ');
      for (var i=0; i < borders.length; i++) {
        $("label[for='border-" + borders[i] + "']").addClass('checked');
      };
    } else {
      $("p.border label").removeClass('checked');
    }
    
    $("#add-element").hide();
    $(".update-actions").fadeIn();
  })
  
  $("#element-box .cancel").click(function(e){
    e.preventDefault();
    
    $("#element-box").trigger('reset');
  })
  
  $("#element-box").bind('reset', function(){
    $("#element-id, #element-width, #element-height").val('').trigger("liszt:updated");;
    $(".radio.checked, .checkbox.checked").removeClass('checked');
    $("#class").val('');
    
    $(".update-actions").hide();    
    $("#add-element").fadeIn();
  })
  
  $("#preview .elements").sortable();
  
  $("form").submit(function(){
    var orders = $("#preview .elements").sortable('toArray');
    if (+orders.length > 0) {
      for (var i=0; i < orders.length; i++) {
        orders[i] = orders[i].replace('element-', '');
      };
      $("<input>", { type: 'hidden', name: 'Block[options][order]', value: orders.join()}).appendTo($(this));
    }
    return true;
  })

  $('#show-advance').toggle(function(e){
    e.preventDefault();
    $('#advance-options').slideDown();
    $(this).html('[–] Hide Advanced Options');
  }, function(e){
    e.preventDefault();
    $('#advance-options').slideUp();
    $(this).html('[+] Show Advanced Options');
  })
  
  /****************
    General Setup
  *****************/
  
  $(document).bind('blockChange', function(){
    
    $('.border-right').each(function(index, element) {
      $(this).css('width',$(this).width()-(borderWidth/2)).css('margin-right', borderWidth/2);
    });

    $('.border-left').each(function(index, element) {
      $(this).css('width',$(this).width()-(borderWidth/2)).css('margin-left', borderWidth/2);
    });

    $('.border-top').each(function(index, element) {
      $(this).css('height',$(this).height()-(borderWidth/2)).css('margin-top', borderWidth/2);
    });

    $('.border-bottom').each(function(index, element) {
      $(this).css('height',$(this).height()-(borderWidth/2)).css('margin-bottom', borderWidth/2);
    });
    
    // French Kiss? http://www.colourlovers.com/palette/803258/french_kiss
    // $("#preview .elements > div:nth-child(1)").css('background', '#EDF6EE');
    // $("#preview .elements > div:nth-child(2)").css('background', '#D1C089');
    // $("#preview .elements > div:nth-child(3)").css('background', '#B3204D');
    // $("#preview .elements > div:nth-child(4)").css('background', '#412E28');
    // $("#preview .elements > div:nth-child(5)").css('background', '#151101');
    // $("#preview .elements > div:nth-child(6)").css('background', '#EDF6EE');
    // $("#preview .elements > div:nth-child(7)").css('background', '#D1C089');
  })
  
  $(document).trigger('blockChange');
  
  $('.chzn-select.half').chosen({width : "49%"});
  $('.chzn-select.p75').chosen({width : "75%"});
  $('.chzn-select').chosen({width : "100%"});
  
  // Pretty checkboxes

  $('input[type=checkbox], input[type=radio]').prettyCheckboxes({display: 'inline'});
  
  
})