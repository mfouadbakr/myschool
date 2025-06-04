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
  if (!empty($_GET['answer'])){
    if($_GET['answer']=="no"){
      $_SESSION['account']->rejectRequest($_GET['request']);
    }
  }

  if (!empty($_POST['val-appointment'])){
    $_SESSION['account']->makeAppointment($_GET['request'],$_POST['val-appointment']);
  }
  ?>

<section class="custom-container mt-3 mb-5">
<a href="school-advising.php" class="btn btn-color-2 rounded mr-2">&larr; Go back to advising</a>
<hr>
  <!--make new appointment-->
  <form action="school-appointment.php?request=<?php echo $_GET['request']; ?>" method="POST" class="mt-2">
      <div class="form-inline"><h6 class="mr-1">Choose appointment date</h6><h6 class="text-danger">*</h6></div>
      <input type="date" class="form-control w-100 mb-1" name="val-appointment">

      <input type="Submit" value="Make appointment" class="btn btn-sm btn-color-2 rounded-0 my-3">
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