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
    echo file_get_contents("master-user.php");
  }else{
    echo file_get_contents("master.php");
  }
  ?>



  <!--Filter right away-->

  <section class="container-fluid cover-home">
    <div class="custom-container">
      <div class="row">
        <div class="col-md-3 d-none d-md-block">
          <img src="images/girl.png" class="mx-auto d-block" height="400px">
        </div>
        <div class="col-md-9">
        <div class="text-white mt-5 p-4 pb-5 bg-trans rounded">
        <h3>Apply to school online</h3>
        <small>Select area to see schools</small>
        <form action="Search.php" method="GET">
            <select class="form-control form-control-sm mb-1" name="city" id="City">
                <option>Select City</option>
              </select>
              <select class="form-control form-control-sm" name="area" id="Area">
                <option>Select Area</option>
              </select>
              <input type="Submit" value="FIND SCHOOLS" class="btn btn-color-2 rounded-0 my-3 w-100 d-none" id="btn-refresh">
              <button class="btn btn-color-2 rounded-0 my-3 w-100" id="btn-refresh2">FIND SCHOOLS</button>
        </form>
      </div>
        </div>
      </div>
      
        
    </div>
    </section>

    <!--Benefits-->
    <div class="container-fluid bg-warning">
      <div class="row text-center py-2">
        <div class="col-md-4">
        <div><img src="images/benefits/time.svg" width="40" height="40" class="d-inline-block" alt=""></div>
                    <b>Time Saving</b>
                    <div>Fill application online</div>
        </div>
        <div class="col-md-4">
        <div><img src="images/benefits/use.svg" width="40" height="40" class="d-inline-block" alt=""></div>
                    <b>Easy to use</b>
                    <div>Explore varity of schools</div>
        </div>
        <div class="col-md-4">
        <div><img src="images/benefits/choice.svg" width="40" height="40" class="d-inline-block" alt=""></div>
                    <b>Best choice</b>
                    <div>Find the right school for you</div>
        </div>
      </div>
    </div>

    <!--Tutorials-->
  <div class="custom-container mt-3">
      <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 color-4">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-color-1">Tutorial</strong>
              <h3 class="mb-0">
                <a class="text-dark" href="https://youtu.be/ZFwAi91U9fg">Register your school</a>
              </h3>
              <div class="mb-1 text-muted">2.55 mins</div>
              <p class="card-text mb-auto">If you are a school owner you should watch this.</p>
              <a href="https://youtu.be/ZFwAi91U9fg" class="btn btn-color-2"><img src="images/buttons/play.svg" width="30" class="pr-1"> Watch
                video</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb"
              alt="Thumbnail [200x250]" src="images/tutorial.jpg" data-holder-rendered="true"
              style="width: 200px; height: 250px;">
          </div>
        </div>

      </div>
    </div><!--/tutorials-->

    <!--About My School-->
    <section class="container-fluid cover-students">

      <div class="row">
      <div class="col-lg-6 text-center">
        <img src="images/students.png" class="img-fluid" height="400px">
        </div>
        <div class="col-lg-6 text-light">
          <div class="p-5 bg-trans">
          <h4>What's My School?</h4>
            <p>
            MySchool is a website that offers solutions to save schools application filling time and to stop wasting money on transportation from school to school. The user can fill an online application generated by the school and the school just have to give those who applied a time for an interview.
            </p>
          </div>
            
        </div>
        
      </div>

    </section>

    <section class="custom-container py-3">
    <h5>What are some facts about schools in Egypt?</h5>
    <ul>
      <li>Free education is provided by government at all levels</li>
      <li>The public education system in Egypt consists of three levels: the basic education stage (4–14 years old), kindergarten for (two years) followed by primary school for (six years) and preparatory school (three years)</li>
      <li>As of 2010, the overall literacy rate in Egypt is 72% as of 2010</li>
      <li>3% for males and 63.5% for females are literate</li>
      <li>Egypt has the largest overall education system in the Middle East and North Africa</li>
      <li>There are four types of private schools: Ordinary schools, Language schools, Religious schools, and Egypt International schools</li>
    </ul>
    </section>
    
       
    

    

    <footer class="pt-5">
      
    </footer>
    
  </section>

  
  

  <!--Link to jquery js-->
  <script src="jquery/jquery-3.3.1.js"></script>
  <!--Link to bootstrap 4 js-->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!--Link to my own js should be placed here-->
  <script src="js/common.js"></script>
  <script src="ajax.js"></script>
</body>

</html>

<script>
$(document).ready(function(){

 load_json_data('City');

 function load_json_data(id, parent_id)
 {
  var html_code = '';
  $.getJSON('country_state_city.json', function(data){

   html_code += '<option value="">Select '+id+'</option>';
   $.each(data, function(key, value){
    if(id == 'City')
    {
     if(value.parent_id == '0')
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
    else
    {
     if(value.parent_id == parent_id)
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
   });
   $('#'+id).html(html_code);
  });

 }

 $(document).on('change', '#City', function(){
  var country_id = $(this).val();
  if(country_id != '')
  {
   load_json_data('Area', country_id);
  }
  else
  {
   $('#Area').html('<option value="">Select Area</option>');
  }
 });
 $(document).on('change', '#Area', function(){
  var state_id = $(this).val();
  if(state_id != '')
  {

  }
 });

 // converting
 $("#btn-refresh2").click(function(){
  $("#City > option").each(function() {
    $(this).val($(this).text());
});
$("#Area > option").each(function() {
    $(this).val($(this).text());
});
  document.getElementById('btn-refresh').click();
      });

});



</script>