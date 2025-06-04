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
  <link rel="stylesheet" type="text/css" href="css/fonts.css" />
  <!--Link to google fonts (Requires internet)-->
  <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">

</head>

<body>

<?php 
  session_start();
  if (isset($_SESSION['school']) && !empty($_SESSION['school'])){
    if($_SESSION['school']->advisingStatus == 0){
      echo '<script type="text/javascript">alert("Sorry you can not apply now advising is closed")</script>';
      $url="school.php?id=".$_SESSION['school']->id;
      echo '<script type="text/javascript">window.location="'.$url.'";</script>';
    }
  }

  if (isset($_SESSION['account']) && !empty($_SESSION['account'])){
    echo file_get_contents("master-user.php");
  }else{
    echo '<script type="text/javascript">alert("Error: You need to login first")</script>';
    $url="login.php";
    echo '<script type="text/javascript">window.location="'.$url.'";</script>';
  }
  ?>

  <section class="custom-container mt-3 mb-5">

    <h4>Application Form</h4>

    <!--3 steps step 1 static step 2 dynamic step 3 overall look-->
    <div class="row">
      <div class="col-md-4 form-inline">
        <h5 class="color-4 p-2 px-3 mr-2 rounded-circle step-active" id="step1">1</h5> Basic Student Information
      </div>
      <div class="col-md-4 form-inline">
          <h5 class="color-4 p-2 px-3 mr-2 rounded-circle" id="step2">2</h5> Additional Student Information
        </div>
        <div class="col-md-4 form-inline">
            <h5 class="color-4 p-2 px-3 mr-2 rounded-circle" id="step3">3</h5> Finalize
          </div>
    </div>

    <div id="app-static" class="my-3 pb-2">
      <h4><?php echo $_SESSION['school']->sname; ?></h4>
      <div class="form-inline"><h6 class="mr-1">Student full name</h6><h6 class="text-danger">*</h6></div>
      <div class="row">
        <div class="col-md-3"><input type="text" class="form-control w-100 mb-1" placeholder="First" id="val-first"></div>
        <div class="col-md-3"><input type="text" class="form-control w-100 mb-1" placeholder="Middle" id="val-middle1"></div>
        <div class="col-md-3"><input type="text" class="form-control w-100 mb-1" placeholder="Middle" id="val-middle2"></div>
        <div class="col-md-3"><input type="text" class="form-control w-100 mb-1" placeholder="Last" id="val-last"></div>
      </div>

      <div class="form-inline"><h6 class="mr-1 mt-2">Gender</h6><h6 class="text-danger">*</h6></div>
      <select class="form-control form-control-sm mb-1" id="val-gender">
        <option>Male</option>
        <option>Female</option>
      </select>

      <hr>

      <div class="form-inline"><h6 class="mr-1">Date of birth</h6><h6 class="text-danger">*</h6></div>
      <input type="date" class="form-control w-100 mb-1" id="val-dob">

      <div class="row">
        <div class="col-md-6">
            <div class="form-inline"><h6 class="mr-1 mt-2">Nationality</h6><h6 class="text-danger">*</h6></div>
            <select class="form-control form-control-sm mb-1" id="val-nationality">
                <option>Egypt</option>
              </select>
        </div>
        <div class="col-md-6">
            <div class="form-inline"><h6 class="mr-1">Place of birth</h6><h6 class="text-danger">*</h6></div>
            <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-birthplace">
        </div>
      </div>

      <div class="form-inline"><h6 class="mr-1 mt-2">Religion</h6><h6 class="text-danger">*</h6></div>
            <select class="form-control form-control-sm mb-1" id="val-religion">
                <option>Muslim</option>
                <option>Christian</option>
              </select>

              <hr>
        
              <div class="form-inline"><h6 class="mr-1">Address</h6><h6 class="text-danger">*</h6></div>
              <div class="row">
                  <div class="col-md-6">
                      
                      <input type="text" class="form-control w-100 mb-1" placeholder="Address 1" id="val-address1">
                  </div>
                  <div class="col-md-6">
                      
                      <input type="text" class="form-control w-100 mb-1" placeholder="Address 2" id="val-address2">
                  </div>
                </div>

                <div class="form-inline"><h6 class="mr-1 mt-2">Home phone</h6><h6 class="text-danger">*</h6></div>
            <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-home">

            <hr>

            <div class="row">
              <div class="col-lg-4">
                  <div class="form-inline"><h6 class="mr-1">Name of school attended last year</h6></div>
                  <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-school1">
              </div>
              <div class="col-lg-4">
                  <div class="form-inline"><h6 class="mr-1">Name of 6th prim school</h6></div>
                  <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-school2">
                </div>
                <div class="col-lg-4">
                    <div class="form-inline"><h6 class="mr-1">3rd prep school</h6></div>
                    <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-school3">
                  </div>
            </div>

            <hr>

            <div class="row">
              <div class="col-md-6">
                <div class="form-inline"><h6 class="mr-1">Mother's Job</h6><h6 class="text-danger">*</h6></div>
                  <input type="text" class="form-control w-100 mb-1" placeholder=""id="val-job1">
              </div>
              <div class="col-md-6">
                <div class="form-inline"><h6 class="mr-1">Father's Job</h6><h6 class="text-danger">*</h6></div>
                  <input type="text" class="form-control w-100 mb-1" placeholder="" id="val-job2">
              </div>
            </div>

            <hr>

            <div class="mb-5 pb-2" id="step1-bottom">Must fill all the fields with <h6 class="text-danger" style="display:inline;">*</h6> on them<button class="btn btn-color-2 mb-5 rounded-0 float-right" id="next1">Next</button></div>

            

            
      
    </div>

      <div id="app-dynamic" class="my-3 d-none">
        <!--Where controls generated appear-->
        <?php Application::printDynamic($_SESSION['school']->id); ?>
        <hr id="dynamic-hr">

            <div class="mb-5 pb-2" id="step2-bottom">Must fill all the fields with <h6 class="text-danger" style="display:inline;">*</h6> on them<button class="btn btn-color-2 mb-5 rounded-0 float-right" id="next2">Next</button></div>
      </div>

      <div id="final" class="my-3 d-none">
        <!--Where output of all the application appear-->
        <hr>

            <div class="mb-5 pb-5">Make sure that information is correct<button class="btn btn-color-2 mb-5 rounded-0 float-right" id="finish">Finish</button></div>
      </div>
  </section>


  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="js/app-generator.js"></script>
  <script src="ajax.js"></script>
</body>

</html>