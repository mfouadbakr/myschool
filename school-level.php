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
  $istest;
  $isactive;

  if(empty($_POST['istest'])){
    $istest = 0;
  }
  else{
    $istest = 1;
  }

  if(empty($_POST['active'])){
    $isactive = 0;
  }
  else{
    $isactive = 1;
  }

  if(!empty($_POST['lvlname']) && !empty($_POST['tutfee']) && !empty($_POST['testfee']) && !empty($_POST['from']) && !empty($_POST['to']) && !empty($_POST['score'])){
    $_SESSION['account']->updateLevel($_GET['id'],$_POST['lvlname'],$_POST['tutfee'],$_POST['testfee'],$istest,$_POST['from'],$_POST['to'],$_POST['score'],$isactive);
  }
  ?>

<section class="custom-container mt-3 mb-5">
  <a href="school-levels.php" class="btn btn-color-2 rounded mb-3">&larr; Go back to levels</a>
  <!--level info-->
  <h3 class="border-bottom border-dark mb-3">Level information</h3>
  <?php $_SESSION['account']->getLevelInfo($_GET['id']); ?>


<hr>

<!--edit level form-->
<h3 class="border-bottom border-dark mb-3">Edit level information</h3>
<form action="school-level.php?id=<?php echo $_GET['id'];?>" method="POST">
  <div class="row">
    <div class="col-md-6">
        <h6>Level name</h6>
        <input type="text" class="form-control w-100 mb-1" placeholder="Level name" name="lvlname">
    </div>
    <div class="col-md-6">
        <h6>Tutition Fee</h6>
        <input type="number" class="form-control w-100 mb-1" placeholder="Tuition Fee" name="tutfee">
    </div>
  </div>

    <hr>

    <div class="row">
      <div class="col-md-6">
          <h6>Placement test</h6>
          <select name="istest">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
      </div>
      <div class="col-md-6">
          <h6>Placement test fee</h6>
          <input type="number" class="form-control w-100 mb-1" placeholder="Placement Fee" name="testfee">
      </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <h6>Age requirement</h6>
            <input type="number" class="form-control w-50 mb-1" placeholder="From" name="from">
            <input type="number" class="form-control w-50 mb-1" placeholder="To" name="to">
        </div>
        <div class="col-md-6">
            <h6>Score requirement</h6>
            <input type="number" class="form-control w-100 mb-1" placeholder="score" name="score">
        </div>
      </div>
    
      <hr>

      <h6>Active</h6>
          <select name="active">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>

          <hr>

      <input type="submit" class="btn btn-color-2 rounded-0 float-right" value="Update level">

</form>
</section>


  

  <footer class="py-5"></footer>


  
  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="js/user-profile.js"></script>
</body>

</html>