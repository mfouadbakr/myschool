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
// call login function if there is post
if(!empty($_POST['type']) && !empty($_POST['flang'])) {
  $_SESSION["account"]->createSchoolProgram($_SESSION["school"]->id,$_POST['type'],$_POST['flang']);
}
?>

<!--navigation on sm and xs-->
<section class="d-sm-block d-xs-block d-md-none container-fluid">
    <div class="row">
      <!--Option 1 - advising-->
      <div class="col p-0">
        <a href="school-advising.php" class="btn btn-color-2 w-100 border-right" style="height:80px;">
          <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">Advising</div>
      </a>
    </div><!--/option 1-->
    <!--Option 2 - levels-->
    <div class="col p-0">
        <a href="school-levels.php" class="btn btn-color-2-active w-100 border-right" style="height:80px;">
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
          <a  href="school-advising.php" class="btn btn-color-2 w-100 border-bottom" style="height:80px;">
            <div><img src="images/buttons/advise.svg" height="30" width="30" class="mb-2"></div>
            <div class="d-md-none d-lg-block">Advising</div>
        </a>
      </div><!--/option 1-->
      <!--Option 2 - levels-->
      <div class="col-md-12 p-0">
          <a href="school-levels.php" class="btn btn-color-2-active w-100 border-bottom" style="height:80px;">
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
        

    <!--Levels-->
        <!--filter by program-->
        <h3 class="border-bottom border-dark">School levels</h3>
            <select id="filterProgram" class="form-control form-control-sm mb-3">
              <option value= "0">--Choose program--</option>
              <?php $_SESSION["account"]->printSchoolProg($_SESSION["school"]->id,1); ?>
            </select>
    
          <!--Result levels-->
          <div id="levels-results">
            <!--Tab - Levels-->
          </div>

    <div class="row"> 
    <div class="col-md-7">
      <h3 class="border-bottom border-dark">Existing school Programs</h3>
      <table class="table table-striped">
        <thead class="table-head">
          <tr>
            <th scope="col">School program</th>
          </tr>
        </thead>
        <tbody>
        <?php $_SESSION["account"]->printSchoolProg($_SESSION["school"]->id,2); ?>
        </tbody>
      </table>
      </div>
      <div class="col-md-5">
        <!--Program editing-->
      <!--Add new school program-->
      <h3 class="border-bottom border-dark">Add School Program</h3>
      <form action="school-levels.php" method="POST" class="border p-3 bg-white">
          <div class="form-inline">
            <h6>Program type</h6>
              <select class="form-control form-control-sm mb-3 ml-2" name="type">
                  <option value="1">International</option>
                  <option value="3">National</option>
                  <option value="5">Special Needs</option>
                </select>
          </div>
  
          <div class="form-inline">
              <h6>First Language</h6>
                <select class="form-control form-control-sm mb-3 ml-2" name="flang">
                    <option value="English">English</option>
                    <option value="French">French</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Germany">Germany</option>
                    <option value="Spanish">Spanish</option>
                  </select>
            </div>
  
            <input type="Submit" name="add" value="Add new school program" class="btn btn-sm btn-color-2 rounded-0 my-3">
        </form>
      </div>
      
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