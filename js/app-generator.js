$(document).ready(function(){
  
    // add the control
    $("#btn-add").click(function(){
        if ($("#controlType").val() == "textbox" && $("#text-label").val() != ""){
          var outputText =
          "<h6 class='my-2'>" + $("#text-label").val() + "</h6>"+
          '<div><input type="text" class="form-control w-100" placeholder="Textbox"></div>'+
          '<button class="btn btn-sm btn-color-2 mt-2 btn-delete">X Remove control</button>';
            $("#app-dynamic").append("<div>" + outputText+ "</div>");
        }
        else if ($("#controlType").val() == "combobox" && $("#custom-textarea").val() != ""){
            // select tag creation
            var lines = $('#custom-textarea').val().split('\n');
            var selectOutput="";
            for(var i = 0;i < lines.length;i++){
              //code here using lines[i] which will give you each line
              selectOutput+='<option>'+lines[i]+'</option>';
            }

            $("#app-dynamic").append('<div><h6 class="my-2">'+$("#text-label").val()+'</h6><select class="form-control form-control-sm mb-1">'+selectOutput+'</select>'+'<button class="btn btn-sm btn-color-2 mt-2 btn-delete">X Remove control</button></div>');
        }
        else if ($("#controlType").val() == "text"){

            var outputTextOnly = '<div><h6 class="my-2">'+$("#text-label").val()+'</h6><pre>'+$("#custom-textarea").val()+'</pre><button class="btn btn-sm btn-color-2 mt-2 btn-delete">X Remove control</button></div>';
            $("#app-dynamic").append(outputTextOnly);
        }
      });


      // customization tools selection
      $("#controlType").change(function(){
        // show div
        $("#custom-textarea").val("");
        if($(this).val() == "combobox"){
          $("#custom-text").removeClass("d-none");
          $("#line1").removeClass("d-none");
          $("#line2").addClass("d-none");
        }
        else if($(this).val() == "text"){
          $("#custom-text").removeClass("d-none");
          $("#line2").removeClass("d-none");
          $("#line1").addClass("d-none");
        }
        else{
          $("#custom-text").addClass("d-none");
        }
        
      });

      //next button 1
      $("#next1").click(function(){
        $("#app-static").addClass("d-none");
        $("#step1-bottom").addClass("d-none"); // should be removed not hidden
        $("#app-dynamic").removeClass("d-none");

        $("#step1").removeClass("step-active");
        $("#step2").addClass("step-active");
      });

      //next button 2
      $("#next2").click(function(){
        $("#app-dynamic").addClass("d-none");
        $("#step2-bottom").addClass("d-none"); //should be removed not hidden
        $("#final").removeClass("d-none");

        $("#step2").removeClass("step-active");
        $("#step3").addClass("step-active");

        // clone app-dynamic into final div
        var $cloneDynamic = $('#app-dynamic').clone();
        $('#final').prepend($cloneDynamic);
        $("#final #app-dynamic").removeClass("d-none");
        $("#final #app-dynamic").removeClass("my-3");
        $("#final #app-dynamic #dynamic-hr").addClass("d-none"); // should be removed not hidden

        // clone app-static into final div
        var $cloneStatic = $('#app-static').clone();
        $('#final').prepend($cloneStatic);
        $("#final #app-static").removeClass("d-none");
        $("#final #app-static").removeClass("my-3");

        // gender selected conversion needs to be done here later

        
        // replace input with spans
        $('#final').find('input').each(function() {
          $(this).replaceWith("<span>" + this.value + "</span>");
        });

        // replace selects with spans
        $('#final').find('select').each(function() {
          $(this).replaceWith("<span>" + this.value + "</span>");
        });
      });
  });

  // delete control - since its dynamicly generated cant be in read event handler
  $(document).on('click', ".btn-delete", function() {
    $(this).parent().remove();
});

// delete all controls - since its dynamicly generated cant be in read event handler
$(document).on('click', "#btn-deleteall", function() {
  $('#app-dynamic').empty();
});