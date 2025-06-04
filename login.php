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
if (isset($_SESSION['account']) && !empty($_SESSION['account'])){
  $url="user-profile.php";
  header( "Location: $url" );
}else{
  echo file_get_contents("master.php");
}
  
  ?>

<?php
// call login function if there is post
if(!empty($_POST['email']) && !empty($_POST['password'])) {
  // skipped validations here

  Account::login($_POST['email'],$_POST['password']);
}
?>

  <section class="custom-container mt-3 mb-5">
      <div class="color-1 text-light p-3 mb-3">
          <h5>Login Form</h5>
            <a href="index.php" class="btn btn-sm btn-color-2 rounded-0 text-center float-right">Go back to home page</a>
      </div>
      <div class="row">
          <div class="col-lg-4 col-md-5">
              <form action="login.php" method="POST">
                    <h6 class="border-bottom border-dark">Login Information</h6>
                    <input type="text" class="form-control w-100 mb-1" placeholder="Email" name="email">
                    <input type="password" class="form-control w-100 mb-1" placeholder="Password" name="password">

                    <div><a href="signup-user.php" class="a-color-1"><u>Don't have a user account yet? Click here!</u></a></div>
                    <input type="Submit" name="login" value="Login" class="btn btn-sm btn-color-2 rounded-0 my-3 text-center">
                    
              </form>
              
          </div>

          <div class="col-lg-8 col-md-7">
              <h3>Benefits of having a user account</h3>
              
                    <h6>Benefit 1: Apply for multiple schools at the same time</h6>
                      

                    <h6>Benefit 2: Make a wishlist of unavailable schools</h6>
                      

                    <h6>Benefit 3: Set default looking area when searching</h6>
                      


                      <div class="card flex-md-row mb-4 box-shadow h-md-250 color-4">
                          <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-color-1">Tutorial</strong>
                            <h3 class="mb-0">
                              <a class="text-dark" href="https://youtu.be/ZFwAi91U9fg">Apply to a School</a>
                            </h3>
                            <div class="mb-1 text-muted">1.25 mins</div>
                            <p class="card-text mb-auto">This video explains how to apply for a school.</p>
                            <a href="https://youtu.be/ZFwAi91U9fg" class="btn btn-color-2"><img src="images/buttons/play.svg" width="30" class="pr-1"> Watch
                              video</a>
                          </div>
                          <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb"
                            alt="Thumbnail [200x250]" src="images/tutorial.jpg" data-holder-rendered="true"
                            style="width: 200px; height: 250px;">
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
</body>

</html>