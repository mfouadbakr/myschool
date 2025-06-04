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
  echo file_get_contents("master-user.php");
  ?>

  <section class="custom-container mt-3 mb-5">
  <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic text-center">
					<img src="images/user.svg" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
          <?php echo $_SESSION["account"]->fname .' '.$_SESSION["account"]->lname; ?>
					</div>
					<div class="profile-usertitle-job">
          <?php echo $_SESSION["account"]->country; ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <!--
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div>-->
				<!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <!--
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li>
					</ul>
				</div>-->
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
			   <!--Tabs-->
         <nav class="nav nav-pills flex-column flex-sm-row my-3">
            <a class="flex-sm-fill text-sm-center nav-link btn-color-2" href="#" id="btn-tab1">Requests sent</a>
            <a class="flex-sm-fill text-sm-center nav-link a-color-1" href="#" id="btn-tab2">Appointments</a>
            <a class="flex-sm-fill text-sm-center nav-link a-color-1" href="#" id="btn-tab3">Accepted/Rejected requests</a>
          </nav>



          <!--Tabs-->

          <!--requests sent-->
          <div id="tab1">
              <small>Click on action button to go to school profile.</small>
              <table class="table table-striped">
                  <thead class="table-head">
                    <tr>
                      <th scope="col">Action</th>
                      <th scope="col">Student</th>
                      <th scope="col">School</th>
                      <th scope="col">Program</th>
                      <th scope="col">Level</th>
                      <th scope="col">Issue Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $_SESSION["account"]->printRequests(); ?>
                  </tbody>
                </table>
          </div><!--/requests sent-->

          <!--appointments-->
          <div id="tab2" class="d-none">
            <small>Click on action button to route to school location on map.</small>
            <table class="table table-striped">
                <thead class="table-head">
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">App code</th>
                    <th scope="col">Student</th>
                    <th scope="col">School address</th>
                    <th scope="col">Level</th>
                    <th scope="col">Appointment Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php $_SESSION["account"]->printAppointments(); ?>
                </tbody>
              </table>
          </div><!--/appointments-->

          <!--accepted/rejected-->
          <div id="tab3" class="d-none">
              <small>Go pay your fees if you got accepted.</small>
              <table class="table table-striped">
                  <thead class="table-head">
                    <tr>
                      <th scope="col">Student</th>
                      <th scope="col">School</th>
                      <th scope="col">Level</th>
                      <th scope="col">Result</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $_SESSION["account"]->printAcceptRejectRequests(); ?>
                  </tbody>
                </table>
          </div><!--/accepted/rejected-->
            </div>
		</div>
  </div>
      
    

        
  </section>

  <footer class="py-5"></footer>


  
  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="js/user-profile.js"></script>
  <script src="ajax.js"></script>
</body>

</html>