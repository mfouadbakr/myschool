$(document).ready(function(){
    // switch tabs
    $("#btn-tab1").click(function(){
      $("#tab1").removeClass("d-none");
      $("#tab2").addClass("d-none");
      $("#tab3").addClass("d-none");

      $("#btn-tab1").removeClass("a-color-1");
      $("#btn-tab1").addClass("btn-color-2");

      $("#btn-tab2").addClass("a-color-1");
      $("#btn-tab2").removeClass("btn-color-2");

      $("#btn-tab3").addClass("a-color-1");
      $("#btn-tab3").removeClass("btn-color-2");
    });

    $("#btn-tab2").click(function(){
      $("#tab2").removeClass("d-none");
      $("#tab1").addClass("d-none");
      $("#tab3").addClass("d-none");

      $("#btn-tab2").removeClass("a-color-1");
      $("#btn-tab2").addClass("btn-color-2");

      $("#btn-tab1").addClass("a-color-1");
      $("#btn-tab1").removeClass("btn-color-2");

      $("#btn-tab3").addClass("a-color-1");
      $("#btn-tab3").removeClass("btn-color-2");
    });

    $("#btn-tab3").click(function(){
      $("#tab3").removeClass("d-none");
      $("#tab2").addClass("d-none");
      $("#tab1").addClass("d-none");

      $("#btn-tab3").removeClass("a-color-1");
      $("#btn-tab3").addClass("btn-color-2");

      $("#btn-tab2").addClass("a-color-1");
      $("#btn-tab2").removeClass("btn-color-2");

      $("#btn-tab1").addClass("a-color-1");
      $("#btn-tab1").removeClass("btn-color-2");
    });
  });
