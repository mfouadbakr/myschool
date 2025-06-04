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
  echo file_get_contents("master-system.php");
  ?>
<!--navigation on sm and xs-->
<section class="d-sm-block d-xs-block d-md-none container-fluid">
    <div class="row">
      <!--Option 1 - advising-->
      <div class="col p-0">
        <a class="btn btn-color-2-active w-100 border-right" style="height:80px;">
          <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">Signups</div>
      </a>
    </div><!--/option 1-->
    </div>
  </section>

<!--main section-->
<section class="container-fluid mt-3 mb-5">
  <div class="row">
    <section class="col-md-1 color-4 d-none d-md-block d-lg-block">
      <div class="row">
        <!--Option 1 - advising-->
        <div class="col-md-12 p-0">
          <a class="btn btn-color-2-active w-100 border-bottom" style="height:80px;">
            <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
            <div class="d-md-none d-lg-block">Signups</div>
        </a>
      </div><!--/option 1-->
      </div>
    </section>
    <!--main part-->
    <section class="col-md-11">
    Logged in as: 
    <?php echo $_SESSION["account"]->fname .' '.$_SESSION["account"]->lname; ?>
        <!--table for signups-->
        <table class="table table-striped">
            <thead class="table-head">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">School</th>
                <th scope="col">Address</th>
                <th scope="col">Contact name</th>
                <th scope="col">Job</th>
                <th scope="col">Mobile phone</th>
              </tr>
            </thead>
            <tbody>
            <?php $_SESSION["account"]->printSignupRequests(); ?>
            </tbody>
          </table>
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