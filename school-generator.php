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
        <a href="school-levels.php" class="btn btn-color-2 w-100 border-right" style="height:80px;">
          <div><img src="images/buttons/levels.svg" height="30" width="30" class="mb-2"></div>
        <div class="d-md-none d-lg-block">Levels</div>
      </a>
    </div><!--/option 3-->
      <!--Option 3 - app generator-->
      <div class="col p-0">
          <a href="school-generator.php" class="btn btn-color-2-active w-100" style="height:80px;">
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
          <a href="school-levels.php" class="btn btn-color-2 w-100 border-bottom" style="height:80px;">
            <div><img src="images/buttons/levels.svg" height="30" width="30" class="mb-2"></div>
          <div class="d-md-none d-lg-block">Levels</div>
        </a>
      </div><!--/option 3-->
        <!--Option 3 - app generator-->
        <div class="col-md-12 p-0">
            <a href="school-generator.php" class="btn btn-color-2-active w-100 border-bottom" style="height:80px;">
              <div><img src="images/buttons/generator.svg" height="30" width="30" class="mb-2"></div>
            <div class="d-md-none d-lg-block">App Generator</div>
          </a>
        </div><!--/option 3-->
      </div>
    </section>
    <!--main part-->
    <section class="col-md-11">
        
          
        <!--App generator-->

        <div class="card flex-md-row mb-4 box-shadow h-md-250 color-4">
          <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-color-1">Tutorial</strong>
            <h3 class="mb-0">
              <a class="text-dark" href="https://youtu.be/ZFwAi91U9fg">How to use the application generator</a>
            </h3>
            <div class="mb-1 text-muted">1.25 mins</div>
            <p class="card-text mb-auto">This video explains how to use the application generator.</p>
            <a href="https://youtu.be/ZFwAi91U9fg" class="btn btn-color-2"><img src="images/buttons/play.svg" width="30" class="pr-1"> Watch
              video</a>
          </div>
          <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb"
            alt="Thumbnail [200x250]" src="images/tutorial.jpg" data-holder-rendered="true"
            style="width: 200px; height: 250px;">
        </div>

    <!--Steps-->
    

    <!--Collapse-->
        <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle">1</h5> Basic Student Information (Static)</div>
        </button>

      <div class="collapse mb-2" id="collapseExample">
        <div class="card card-body">
            <p class="ml-5">This area includes the following:-<br>
              <ul class="ml-5">
                <li>Student full name</li>
                <li>Gender</li>
                <li>Date of birth</li>
                <li>Nationality</li>
                <li>Place of birth</li>
                <li>Religion</li>
                <li>Applying stage</li>
                <li>Second lanugage</li>
                <li>Address</li>
                <li>Home phone</li>
                <li>Name of school attended last year</li>
                <li>Name of 6th prim school</li>
                <li>3rd prep school </li>
              </ul>
            
            </p>
        </div>
      </div>

      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
          <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">2</h5> Additional Information (Dynamic)</div>
      </button>

      <div class="collapse mb-2" id="collapseExample2">
          <div class="card card-body">
              
          <div class="border-bottom border-dark mb-2">
              <h5>Application Generator</h5>
          </div>
          <button id="btn-generate" class="btn btn-color-2 rounded-0 mb-2">Generate Application</button>
              
              
              Controls <small>Add controls needed</small>

      <div class="row">
        <div class="col-lg-4"><input type="text" class="form-control mr-2" id="text-label" placeholder="Control title"></div>
        <div class="col-lg-3">
          <select class="form-control form-control-sm mr-2" id="controlType">
            <option value="textbox">Text box</option>
            <option value="combobox">Combo box</option>
            <option value="text">Text</option>
          </select>
        </div>
        <div class="col-lg-5">
            <button class="btn btn-color-2 rounded-0" id="btn-add">+ Add Control</button>
            <button class="btn btn-color-2 rounded-0" id="btn-deleteall">X Delete All Controls</button>
        </div>
      </div>

      <div class="mt-2 d-none" id="custom-text">
        <small id="line1">Each line you write is an item in the combo box</small>
        <small id="line2">Write a paragraph here</small>
        <textarea class="w-100" style="height:200px;" id="custom-textarea"></textarea></div>

        <h4 class="my-3">Application Form</h4>
      <div id="app-dynamic" class="my-3 pb-5">
        
        <!--Where controls generated appear-->
      </div>
          </div>
        </div>
    
    <!--Preview tab-->
    <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
      <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle">3</h5> Current application preview</div>
  </button>

  <div class="collapse mb-2" id="collapseExample3">
      <div class="card card-body">
          <?php Application::printDynamic($_SESSION['school']->id); ?>
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
  <script src="js/app-generator.js"></script>
  <script src="js/user-profile.js"></script>
  <script src="ajax.js"></script>
</body>

</html>