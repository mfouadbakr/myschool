<?php
require_once('classes/account.php');
require_once('classes/application.php');
require_once('classes/request.php');
require_once('classes/school.php');
require_once('classes/systemAdmin.php');
require_once('classes/schoolAdmin.php');
require_once('classes/user.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My School</title>

  <!--Link to bootstrap 4 css-->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
  <!--link to my custom css-->
  <link rel="stylesheet" type="text/css" href="css/scheme.css" />
  <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
  <link rel="stylesheet" type="text/css" href="css/custom-bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/custom-modal.css" />
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <!--Link to google fonts (Requires internet)-->
  <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">

</head>

<body>

<?php 
  session_start();
  if (isset($_SESSION['account']) && !empty($_SESSION['account'])){
    echo file_get_contents("master-user.php");
  }else{
    echo file_get_contents("master.php");
  }
  ?>

  <?php
  // default values
  $city ='';
  $area ='';
  $type ='';
  $lang ='';
  $feeFrom ='';
  $feeTo = '';
  $intSwim='';
  $intSing='';
  $intAct='';
  $intFoot='';
  $intArt='';
  $sname='';
  // checking city
  if (!empty($_GET['city'])){
    $city = $_GET['city'];
  }
  // checking area
  if (!empty($_GET['area'])){
    $area = $_GET['area'];
  }
  // checking program
  if (!empty($_GET['program'])){
    if($_GET['program'] != 'all'){
      $type = $_GET['program'];
    }
  }
  // checking lang
  if (!empty($_GET['lang'])){
    if($_GET['lang'] != 'all'){
      $lang = $_GET['lang'];
    }
  }
  // checking feefrom
  if (!empty($_GET['feefrom'])){
    $feeFrom = $_GET['feefrom'];
  }
  // checking feeto
  if (!empty($_GET['feeto'])){
    $feeTo = $_GET['feeto'];
  }
  // checking intswim
  if (!empty($_GET['swimming'])){
    $intSwim = $_GET['swimming'];
  }
  // checking intsing
  if (!empty($_GET['singing'])){
    $intSing = $_GET['singing'];
  }
  // checking intact
  if (!empty($_GET['acting'])){
    $intAct = $_GET['acting'];
  }
  // checking intfoot
  if (!empty($_GET['football'])){
    $intFoot = $_GET['football'];
  }
  // checking intart
  if (!empty($_GET['art'])){
    $intArt = $_GET['art'];
  }
  // checking sname
  if (!empty($_GET['sname'])){
    $sname = $_GET['sname'];
  }
  ?>

  <section class="custom-container mt-3 mb-5">
      <div class="row">
        <!--Filters col-->
          <div class="col-lg-2 col-md-4">
            <div id="filters" class="d-none d-sm-block">
              <h5><img src="images/filter.svg" width="20"> Filters</h5>
              <!--Filters-->
              <form action="search.php" method="GET">
              <input type="text" class="form-control w-100 rounded-0 mb-1" id="text-search" placeholder="School name" name="sname">
                  <h6 class="border-bottom border-dark">Location</h6>
                  <select class="form-control form-control-sm mb-1" name="city" id="City">
                    <option>Select City</option>
                  </select>
                  <select class="form-control form-control-sm" name="area" id="Area">
                    <option>Select Area</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">School Type</h6>
                  <select class="form-control form-control-sm mb-1" name="program">
                  <option value="all">All</option>
                    <option value="national">National</option>
                    <option value="international">International</option>
                    <option value="Special_Needs">Special Needs</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">Tutition Fees Range</h6>
                  <input type="number" class="form-control w-100" placeholder="From" name="feefrom">
                  <input type="number" class="form-control w-100" placeholder="To" name="feeto">
    
                  <h6 class="border-bottom border-dark mt-3">First language</h6>
                  <!--Lanuages-->
                  <select class="form-control form-control-sm mb-1" name=lang>
                    <option value="all">All</option>
                    <option value="arabic">Arabic</option>
                    <option value="english">English</option>
                    <option value="french">French</option>
                    <option value="german">German</option>
                    <option value="spanish">Spanish</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">Interests</h6>
                  <!--interest 1-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkswimming" name="swimming">
                    <label class="custom-control-label" for="chkswimming">Swimming</label>
                  </div>
    
                  <!--interest 2-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chksinging" name="singing">
                    <label class="custom-control-label" for="chksinging">Special Needs</label>
                  </div>
    
                  <!--interest 3-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkacting" name="acting">
                    <label class="custom-control-label" for="chkacting">Acting</label>
                  </div>
    
                  <!--interest 4-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkfootball" name="football">
                    <label class="custom-control-label" for="chkfootball">Football</label>
                  </div>
    
                  <!--interest 5-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkarts" name="art">
                    <label class="custom-control-label" for="chkarts">Arts</label>
                  </div>
    
                  <input type="Submit" value="Refresh" class="btn btn-sm btn-color-2 rounded-0 my-3 d-none" id="btn-referesh2">
                  <button class="btn btn-sm btn-color-2 rounded-0 my-3" id="do-refresh">Search</button>
                </form>
            </div>
          </div><!--/filters col-->

          <div class="col-lg-10 col-md-8">
            <a href="#" class="a-color-1 float-right" id="btn-mapview"><img src="images/buttons/map.svg" height="20" width="20"> Map view</a>
            <a href="#" class="a-color-1 float-right d-none" id="btn-listview"><img src="images/buttons/list.svg" height="20" width="20"> List view</a>
            
            <?php
            if($_GET['city'] != 'Select City' || $_GET['area'] != 'Select Area'){
              echo '<h5>'.$_GET['city'].' - '.$_GET['area'].'</h5>';
            }
            else{
              echo '<h5>Search result</h5>';
            }
            ?>


            <!--Filters and Search in sm-->
            <div class="container-fluid mb-2 d-block d-sm-none">
              <div class="row">
                <div class="col" style="padding:0;">
                    <button class="btn btn-light rounded-0 w-100 border-top border-bottom" data-toggle="modal" data-target="#modalfilters"><img src="images/filter.svg" width="20"> Filters</button>
                </div>
                
              </div>
            </div>
            
            <!--Results here-->
            <div id="listResult">
            <?php
            // searchSchoolList($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname)
            School::searchSchoolList($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname);
            ?>
            </div>

            <!--Map-->
            <div id="map_div" class="d-none" style="height: 500px;"></div>
        


          </div>
        </div>
  </section>

  <!--------------------------------------------------------------------------------------------------------------------------------------->

  <!-- The Modal -->
<div class="modal" id="modalfilters">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h5><img src="images/filter.svg" width="20"> Filters</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <!--Filters-->
          <form action="search.php" method="GET">
          <input type="text" class="form-control w-100 rounded-0 mb-1" id="text-search" placeholder="School name" name="sname">

          <h6 class="border-bottom border-dark">Location</h6>
                  <select class="form-control form-control-sm mb-1" name="city" id="City">
                    <option>Select City</option>
                  </select>
                  <select class="form-control form-control-sm" name="area" id="Area">
                    <option>Select Area</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">School Type</h6>
                  <select class="form-control form-control-sm mb-1" name="program">
                    <option value="all">All</option>
                    <option value="national">National</option>
                    <option value="international">International</option>
                    <option value="Special_Needs">Special Needs</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">Tutition Fees Range</h6>
                  <input type="number" class="form-control w-100" placeholder="From" name="feefrom">
                  <input type="number" class="form-control w-100" placeholder="To" name="feeto">
    
                  <h6 class="border-bottom border-dark mt-3">First language</h6>
                  <!--Lanuages-->
                  <select class="form-control form-control-sm mb-1" name=lang>
                    <option value="all">All</option>
                    <option value="arabic">Arabic</option>
                    <option value="english">English</option>
                    <option value="french">French</option>
                    <option value="german">German</option>
                    <option value="spanish">Spanish</option>
                  </select>
    
                  <h6 class="border-bottom border-dark mt-3">Interests</h6>
                  <!--interest 1-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkswimming2" name="swimming">
                    <label class="custom-control-label" for="chkswimming2">Swimming</label>
                  </div>
    
                  <!--interest 2-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chksinging2" name="singing">
                    <label class="custom-control-label" for="chksinging2">Spacial Needs</label>
                  </div>
    
                  <!--interest 3-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkacting2" name="acting">
                    <label class="custom-control-label" for="chkacting2">Acting</label>
                  </div>
    
                  <!--interest 4-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkfootball2" name="football">
                    <label class="custom-control-label" for="chkfootball2">Football</label>
                  </div>
    
                  <!--interest 5-->
                  <div class="ml-5">
                    <input type="checkbox" class="custom-control-input" id="chkarts2" name="art">
                    <label class="custom-control-label" for="chkarts2">Arts</label>
                  </div>
    
                  <input type="Submit" value="Refresh" class="btn btn-sm btn-color-2 rounded-0 my-3 d-none" id="btn-refresh">
                </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-color-2 rounded-0" onclick="document.getElementById('btn-refresh').click();">Search</button>
        </div>
  
      </div>
    </div>
  </div>

  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?development&callback=myMap"></script>
  <script src="ajax.js"></script>
  <script>
  
/*
 * create map
 */
var map = new google.maps.Map(document.getElementById("map_div"), {
    center: new google.maps.LatLng(26.6943875,30.2536572),
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  /*
   * use google maps api built-in mechanism to attach dom events
   */
  google.maps.event.addDomListener(window, "load", function () {
    
    /*
     * create infowindow (which will be used by markers)
     */
    var infoWindow = new google.maps.InfoWindow();
  
    /*
     * marker creater function (acts as a closure for html parameter)
     */
    function createMarker(options, html) {
      var marker = new google.maps.Marker(options);
      if (html) {
        google.maps.event.addListener(marker, "click", function () {
          infoWindow.setContent(html);
          infoWindow.open(options.map, this);
        });
      }
      return marker;
    }
  
    /*
     * add markers to map
     */
    
  
    <?php
            // searchSchoolList($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname)
            School::searchSchoolMap($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname);
            ?>
  
  });
  
  // listen for the window resize event & trigger Google Maps to update too
  window.onresize = function() {
    var currCenter = map.getCenter();
    google.maps.event.trigger(map, 'resize');
    map.setCenter(currCenter);
  };
  </script>
</body>

</html>

<script>
$(document).ready(function(){

 load_json_data('City');

 function load_json_data(id, parent_id)
 {
  var html_code = '';
  $.getJSON('country_state_city.json', function(data){

   html_code += '<option value="">Select '+id+'</option>';
   $.each(data, function(key, value){
    if(id == 'City')
    {
     if(value.parent_id == '0')
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
    else
    {
     if(value.parent_id == parent_id)
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
   });
   $('#'+id).html(html_code);
  });

 }

 $(document).on('change', '#City', function(){
  var country_id = $(this).val();
  if(country_id != '')
  {
   load_json_data('Area', country_id);
  }
  else
  {
   $('#Area').html('<option value="">Select Area</option>');
  }
 });
 $(document).on('change', '#Area', function(){
  var state_id = $(this).val();
  if(state_id != '')
  {

  }
 });

 // converting
 $("#do-refresh").click(function(){
  $("#City > option").each(function() {
    $(this).val($(this).text());
});
$("#Area > option").each(function() {
    $(this).val($(this).text());
});
  document.getElementById('btn-refresh2').click();
      });

});



</script>