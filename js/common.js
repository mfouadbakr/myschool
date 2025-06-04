
// back to top button appear and reappear
$(window).bind('scroll', function () {
    if ($(window).scrollTop() > 400) {
        $('#btn-back-top').removeClass('d-none');
    } else {
        $('#btn-back-top').addClass('d-none');
    }
});

$(document).ready(function(){
    $("#btn-mapview").click(function(){
        $('#btn-mapview').addClass('d-none');
        $('#btn-listview').removeClass('d-none');
        $('#listResult').addClass('d-none');
        $('#map_div').removeClass('d-none');
      });

      $("#btn-listview").click(function(){
        $('#btn-mapview').removeClass('d-none');
        $('#btn-listview').addClass('d-none');
        $('#listResult').removeClass('d-none');
        $('#map_div').addClass('d-none');
      });
});