<?php
require_once('classes/account.php');
require_once('classes/application.php');
require_once('classes/request.php');
require_once('classes/school.php');
require_once('classes/systemAdmin.php');
require_once('classes/schoolAdmin.php');
require_once('classes/user.php');

session_start(); // to get account variable 
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
  <link rel="stylesheet" type="text/css" href="css/temp/profile.css" />
  <link rel="stylesheet" type="text/css" href="css/scheme.css" />
  <link rel="stylesheet" type="text/css" href="css/mystyle.css" />
  <link rel="stylesheet" type="text/css" href="css/custom-bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <!--Link to google fonts (Requires internet)-->
  <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">

</head>

<body>

<?php 
  echo file_get_contents("master-school.php");
  ?>

<?php
if(!empty($_POST['interest'])){
  $_SESSION['account']->addInterest($_POST['interest'],$_SESSION['school']->id);
}

if(!empty($_POST['bio'])){
  $_SESSION['account']->editBio($_SESSION['school']->id,$_POST['bio']);
}
?>
  <section class="custom-container mt-3 mb-5">

  <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="text-center">
					<img src="images/school.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
          <?php echo $_SESSION["school"]->sname; ?>
					</div>
					<div class="profile-usertitle-job">
          <?php echo $_SESSION["school"]->address; ?>
          </div>
          <div>
                    <?php
                    $_SESSION['school']->printInterests();
                    ?>
                </div>
				</div>
        <!-- END SIDEBAR USER TITLE -->
        
        <!-- SIDEBAR BUTTONS -->
				
				<!-- END SIDEBAR BUTTONS -->
        
        <div class="row mt-3 text-center bg-warning">
          <div class="col"><?php echo $_SESSION['school']->hits; ?> <br>Hits</div>
          <div class="col"><?php echo $_SESSION['school']->applies; ?> <br>Applied</div>
          <div class="col"><?php echo $_SESSION['school']->maxFee; ?> <br>L.E</div>
        </div>

        <div class="text-center mt-2">Advising <?php if($_SESSION["school"]->advisingStatus == 1){ echo "Opened";}else echo "Closed";?></div>

      </div>
      <div>
      <div class="profile-usermenu bg-white pb-2">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Biography </a>
						</li>
          </ul>
          <p class="p-2">
              <?php echo $_SESSION['school']->bio; ?>
              </p>
				</div>
      </div>

      <div>
      <div class="profile-usermenu bg-white pb-2">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Photos </a>
						</li>
          </ul>
          <div class="row text-center my-3 p-2">
            <div class="col-md-4"><a href="#" data-toggle="modal" data-target="#img-1"><img src="images/slider/1.jpg" class="img-fluid img-thumbnail"></a> </div>
            <!--image 1 modal-->
            <div id="img-1" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                          <img src="images/slider/1.jpg" class="img-responsive">
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4"><a href="#" data-toggle="modal" data-target="#img-2"><img src="images/slider/2.jpg" class="img-fluid img-thumbnail"></a> </div>
              <!--image 2 modal-->
              <div id="img-2" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img src="images/slider/2.jpg" class="img-responsive">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4"><a href="#" data-toggle="modal" data-target="#img-3"><img src="images/slider/3.png" class="img-fluid img-thumbnail"></a> </div>
            <!--image 1 modal-->
            <div id="img-3" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-body">
                          <img src="images/slider/3.png" class="img-responsive">
                      </div>
                  </div>
                </div>
              </div>
          </div>
				</div>
      </div>

      

      <div>
      <div class="profile-usermenu bg-white pb-2 mb-3">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Map </a>
						</li>
          </ul>
          <!--Map-->
          <div id="map_div" style="height: 300px;"></div>
				</div>
      </div>

      

		</div>
		<div class="col-md-9">
            <div class="profile-content">

            <h4 class="border-bottom border-dark">Edit Biography</h4>
            <form action="school-settings.php" method="post">
            <textarea class="w-100" style="height:100px;" name="bio"><?php echo $_SESSION['school']->bio;?></textarea>
            <input type="Submit" value="Edit Biography" class="btn btn-sm btn-color-2 rounded-0 my-3">

            </form>

            <h4 class="border-bottom border-dark">Add new school interest</h4>
      <form action="school-settings.php" method="POST" class="border p-3">
          <div class="form-inline">
            <h6>Interest</h6>
              <select class="form-control form-control-sm mb-3 ml-2" name="interest">
                  <option value="1">Acting</option>
                  <option value="2">Swimming</option>
                  <option value="3">Football</option>
                  <option value="4">Basketball</option>
                  <option value="5">Arts</option>
                  <option value="6">Special Needs</option>
                  <option value="7">Gym</option>
                </select>
          </div>
  
            <input type="Submit" name="add" value="Add new school interest" class="btn btn-sm btn-color-2 rounded-0 my-3">
        </form>

        <!--Edit interests-->
        <h4 class="border-bottom border-dark">Existing school interests</h4>
      <table class="table table-striped">
        <thead class="table-head">
          <tr>
            <th scope="col">School interests</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php $_SESSION["school"]->printInterests(); ?></td>
          </tr>
        
        </tbody>
      </table>

      <!--Billing-->
      <h4 class="border-bottom border-dark">Billing</h4>
      <table class="table table-striped">
        <thead class="table-head">
          <tr>
            <th scope="col">Transaction</th>
            <th scope="col">Amount paid</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        <tbody>
          
            <?php $_SESSION["account"]->printBills($_SESSION['school']->id); ?>
          
        
        </tbody>
      </table>

      <div class="py-2"></div>
            </div>
		</div>
  </div>

  
  </section>


  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="js/app-generator.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?development&callback=myMap"></script>
  <script src="ajax.js"></script>

  <script>
  
/*
 * create map
 */
var map = new google.maps.Map(document.getElementById("map_div"), {
    center: new google.maps.LatLng(<?php echo $_SESSION['school']->latitude ?>, <?php echo $_SESSION['school']->longitude ?>),
    zoom: 14,
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
    
  
    var marker0 = createMarker({
      position: new google.maps.LatLng(<?php echo $_SESSION['school']->latitude; ?>, <?php echo $_SESSION['school']->longitude; ?>),
      map: map
    }, "<h1><?php echo $_SESSION['school']->sname; ?></h1><p><?php echo $_SESSION['school']->bio; ?></p>");
  
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