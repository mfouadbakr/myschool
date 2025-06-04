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

  <?php 
  if(!empty($_POST['longitude']) && !empty($_POST['latitude'])){
    $_SESSION["account"]->acceptSignup($_GET['request'],$_POST['city'],$_POST['area'],$_POST['longitude'],$_POST['latitude']);
  }
  ?>

<section class="custom-container mt-3 mb-5">
<h3>School Registration</h3>
<?php $_SESSION["account"]->printSignupSchool($_GET['request']);?>

  <form action="system-school.php?request=<?php echo $_GET['request'];?>" method="POST" class="mt-2">
    <h6>Set school location</h6>
    <select class="form-control form-control-sm mb-1" name="city" id="City">
                <option>Select City</option>
              </select>
              <select class="form-control form-control-sm" name="area" id="Area">
                <option>Select Area</option>
              </select>
      
      <input type="text" class="form-control w-100 rounded-0" placeholder="Longitude" name="longitude">
      <input type="text" class="form-control w-100 rounded-0" placeholder="Latitude" name="latitude">

      <input type="Submit" name="activate" value="Activate account" class="btn btn-sm btn-color-2 rounded-0 my-3 d-none" id="btn-refresh">
      <button class="btn btn-sm btn-color-2 rounded-0 my-3" id="btn-refresh2">Activate account</button>
      <a href="system-signups.php" class="btn btn-sm btn-color-2 rounded-0 my-3">Cancel</a>
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