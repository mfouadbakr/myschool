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
  if(!empty($_POST['advising'])){
    $_SESSION["account"]->onoffAdvising($_SESSION["school"]->id);
    header("Location: school-advising.php"); // redirect to delete post to prevent refresh
  }
  ?>
<!--navigation on sm and xs-->
<section class="d-sm-block d-xs-block d-md-none container-fluid">
    <div class="row">
      <!--Option 1 - advising-->
      <div class="col p-0">
        <a href="school-advising.php" class="btn btn-color-2-active w-100 border-right" style="height:80px;">
          <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">Advising</div>
      </a>
    </div><!--/option 1-->
    <!--Option 2 - levels-->
    <div class="col p-0">
        <a href="school-levels.php" class="btn btn-color-2 w-100 border-right" style="height:80px;">
          <div><img src="images/buttons/levels.svg" height="30" width="30" class="mb-2"></div>
        <div class="d-md-none d-lg-block">Levels</div>
      </a>
    </div><!--/option 3-->
      <!--Option 3 - app generator-->
      <div class="col p-0">
          <a href="school-generator.php" class="btn btn-color-2 w-100" style="height:80px;">
            <div><img src="images/buttons/generator.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">App Generator</div>
        </a>
      </div><!--/option 3-->
    </div>
  </section>

<!--main section-->
<section class="container-fluid mt-3 mb-5">
  <div class="row">
    <section class="col-md-1 color-4 d-none d-md-block d-lg-block">
      <div class="row">
        <!--Option 1 - advising-->
        <div class="col-md-12 p-0">
          <a  href="school-advising.php" class="btn btn-color-2-active w-100 border-bottom" style="height:80px;">
            <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
            <div class="d-md-none d-lg-block">Advising</div>
        </a>
      </div><!--/option 1-->
      <!--Option 2 - levels-->
      <div class="col-md-12 p-0">
          <a href="school-levels.php" class="btn btn-color-2 w-100 border-bottom" style="height:80px;">
            <div><img src="images/buttons/levels.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">Levels</div>
        </a>
      </div><!--/option 3-->
        <!--Option 3 - app generator-->
        <div class="col-md-12 p-0">
            <a href="school-generator.php" class="btn btn-color-2 w-100 border-bottom" style="height:80px;">
              <div><img src="images/buttons/generator.svg" height="30" width="30" class="mb-2"></div>
            <div class="d-md-none d-lg-block">App Generator</div>
          </a>
        </div><!--/option 3-->
      </div>
    </section>
    <!--main part-->
    <section class="col-md-11">
        <div class="row">
          <div class="col-md-2 col-sm-4"><img class="card-img-top" src="images/school.png" alt="Card image cap" class="w-100 h-100"></div>
          <div class="col-md-10 col-sm-8 px-3">
            <!--Card-->
          <div class="card mb-2 color-4">
              <div class="">
                <div class="">
                  <div class="card-block px-3">
                      <h4 class="card-title pt-2"><?php echo $_SESSION["school"]->sname; ?></h4>
                      <p class="text-muted">Logged in as: <?php echo $_SESSION["account"]->fname . " " . $_SESSION["account"]->lname; ?></p>
    
                      
    
                    <!--Statistics and fee range-->
                    <div class="pt-2"><?php echo $_SESSION["school"]->hits; ?> Hits <?php echo $_SESSION["school"]->applies; ?> Applied<div class="float-right"><?php echo $_SESSION["school"]->maxFee; ?></div></div>
    
                    <!--Buttons apply and show on map-->
                    <div class="pb-2">
                      <hr>
                      <form action="school-advising.php" method="POST">
                        <input type="hidden" value="adviseme" name="advising">
                        <input type="submit" name="btn-advise" value="<?php if($_SESSION["school"]->advisingStatus == 0){ echo "Open";}else echo "Close";?> Advising" class="btn btn-sm btn-color-2 rounded-0 float-right">
                      </form>
                      
                        Advising <?php if($_SESSION["school"]->advisingStatus == 1){ echo "Opened";}else echo "Closed";?>
                    </div>
    
                  </div>
                </div>
              </div>
            </div><!--/card-->
          </div>
        </div>

        
          
        <div class="bg-white p-3 mt-3">
    
            <!--Tabs-->
            <nav class="nav nav-pills flex-column flex-sm-row my-3">
                <a class="flex-sm-fill text-sm-center nav-link btn-color-2"  id="btn-tab1">Requests recieved</a>
                <a class="flex-sm-fill text-sm-center nav-link a-color-1"  id="btn-tab2">Appointments</a>
                <a class="flex-sm-fill text-sm-center nav-link a-color-1"  id="btn-tab3">Accepted/Rejected requests</a>
              </nav>
    
    
    
              <!--Tabs-->
    
              <!--requests sent-->
              <div id="tab1">
                  <small>Tick to make appointment, Cross to reject</small>
                  <!--filter by program and level-->

                  <div class="form-inline">
                    <b class="mr-2">Filters</b>
                    <select class="form-control form-control-sm mb-2" id="filter-program">
                        <option value="">--Choose program--</option>
                        <?php $_SESSION["account"]->printSchoolProg($_SESSION["school"]->id,1); ?>
                      </select>
                  </div>

                  <table class="table table-striped">
                      <thead class="table-head">
                        <tr>
                          <th scope="col">Action</th>
                          <th scope="col">Student</th>
                          <th scope="col">Level</th>
                          <th scope="col">1st OCT Age</th>
                          <th scope="col">Father's Job</th>
                          <th scope="col">Mother's Job</th>
                        </tr>
                      </thead>
                      <tbody id="table-requests">
                        <?php //$_SESSION['account']->printRequests(10); ?>
                        
                      </tbody>
                    </table>
              </div><!--/requests sent-->
    
              <!--appointments-->
              <div id="tab2" class="d-none">
                
                <small>Click on action button to view application</small>

                <div class="row">
                  <div class="col-md-6">
                    <!--filter by attendance-->
                <div class="form-inline">
                    <b class="mr-2">Filters</b>
                    <select class="form-control form-control-sm mb-2" id="filter-appointment">
                      <option value="">--Choose attendance--</option>
                        <option value="0">Unattended</option>
                        <option value="1">Attended</option>
                      </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <!--app code attend-->
                  <form class="form-inline float-right" action="school-app.php" method="GET">
                      <input type="text" class="form-control mb-2" placeholder="Application Code" name="appcode">
                      <input type="submit" class="btn btn-color-2 mb-2 rounded-0" value="Attend">
                  </form>
                  </div>
                </div>
                


                  
                <table class="table table-striped">
                    <thead class="table-head">
                      <tr>
                        <th scope="col">Action</th>
                        <th scope="col">App Code</th>
                        <th scope="col">Student</th>
                        <th scope="col">Level</th>
                        <th scope="col">Appointment date</th>
                      </tr>
                    </thead>
                    <tbody id="table-appointments">
                    <?php //$_SESSION['account']->printAppointments(0,$_SESSION['school']->id); ?>
                      
                    </tbody>
                  </table>
              </div><!--/appointments-->
    
              <!--accepted/rejected-->
              <div id="tab3" class="d-none">
                <small>Click on action button to view application</small>
                <!--filter by attendance-->
                <div class="form-inline">
                    <b class="mr-2">Filters</b>
                    <select class="form-control form-control-sm mb-2" id="filter-accept">
                      <option value="">--Choose acceptance--</option>
                        <option value="1">Accepted</option>
                        <option value="0">Rejected</option>
                      </select>
                  </div>
                <table class="table table-striped">
                    <thead class="table-head">
                      <tr>
                        <th scope="col">Action</th>
                        <th scope="col">App Code</th>
                        <th scope="col">Student</th>
                        <th scope="col">Level</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody id="table-accept">
                    <?php //$_SESSION['account']->printAcceptRejectRequests(0,$_SESSION['school']->id); ?>
                      
                    </tbody>
                  </table>
              </div><!--/accepted/rejected-->
</div>
      </section><!--/main part-->
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