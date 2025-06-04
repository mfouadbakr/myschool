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
  $_SESSION['account']->submitAppCode($_GET['appcode'],$_SESSION['school']->id);
  if (!empty($_POST['answer'])){
    if($_POST['answer']=="no"){
      $_SESSION['account']->rejectRequest($_GET['appcode']);
    }
    if($_POST['answer']=="yes"){
      $_SESSION['account']->acceptRequest($_GET['appcode']);
    }
  }
  ?>

  <section class="custom-container mt-3 mb-5">
  <a href="school-advising.php" class="btn btn-color-2 rounded mr-2">&larr; Go back to advising</a>
  <hr>
    <!--accept and reject buttons-->
    <div class="form-inline">
    <form action="school-app.php?appcode=<?php echo $_GET['appcode']; ?>" method="POST" class="form-inline mb-3">
    <input type="hidden" value="yes" name="answer">
    <input type="submit" value="Accept in School" class="btn btn-color-2 rounded-0 mr-2">
      
    </form>

    <form action="school-app.php?appcode=<?php echo $_GET['appcode']; ?>" method="POST" class="form-inline mb-3">
    <input type="hidden" value="no" name="answer">
    <input type="submit" value="Reject in School" class="btn btn-color-2 rounded-0">
      
    </form>
    </div>
    


    
    <hr>
    
    <h4>Application Form</h4>

      <div id="app-output">
        <?php Request::printRequestApp($_GET['appcode']); ?>
      </div>
  </section>


  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="js/app-generator.js"></script>
</body>

</html>