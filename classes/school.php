<?php
require_once('dbconn.php');

class School{
    // attributes
    public $id;
    public $sname;
    public $package;
    public $address;
    public $maxFee;
    public $bio;
    public $pic1;
    public $pic2;
    public $pic3;
    public $longitude;
    public $latitude;
    public $applies;
    public $hits;
    public $advisingStatus;
    public $appDynamicLink;

    // static functions
    public static function createSchoolObj($schoolID){
        // open connection
        $conn = getConnection();

        // do school hit
        $sql = "update school set hits = hits+1 where id = ".$schoolID;
        execQuery($conn,$sql);
        
        $sql = "select * from school where id=".$schoolID;
        
        $result = selectQuery($conn,$sql);
        // fetch result in 1 row (need to validate that)
        $row = $result->fetch();
        
        $schoolOBJ = new School();
        $schoolOBJ->id=$row['id'];
        $schoolOBJ->sname=$row['school_name'];
        $schoolOBJ->package=$row['service_pakage'];
        $schoolOBJ->address=$row['address'];
        $schoolOBJ->maxFee=$row['max_fee'];
        $schoolOBJ->bio=$row['bio'];
        $schoolOBJ->pic1=$row['pic1'];
        $schoolOBJ->pic2=$row['pic2'];
        $schoolOBJ->pic3=$row['pic3'];
        $schoolOBJ->longitude=$row['longitude'];
        $schoolOBJ->latitude=$row['latitude'];
        $schoolOBJ->applies=$row['applies'];
        $schoolOBJ->hits=$row['hits'];
        $schoolOBJ->advisingStatus=$row['advising_status'];

            closeConnection($conn);

            return $schoolOBJ;
    }

    public static function searchSchoolList($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname){
      $sql2 = "
      SELECT distinct school.id, school.school_name , school.address,school.longitude ,school.latitude, school.max_fee, school.logo,school.hits,school.applies,school.advising_status FROM interest INNER join school_interest on interest.id=school_interest.interest_id INNER join school on school_interest.school_id=school.id inner join school_program on school.id=school_program.school_ID inner join program on school_program.prog_ID=program.id 
      
      ";
      $sql = "where";
      // check city and area
      if ($city != 'Select City' ){
        $sql .=" and school.city='".$city."'";
      }  

      if ($city != 'Select City' ){
        $sql .=" and school.area = '".$area."'";
      } 

      if ($sname != '' ){
        $sql .=" and school.school_name like'%".$sname."%'";
      }  

      // program filter
      if ($type != '' ){
        $sql .=" and program.program_name='".$type."'";
      }  

      // fee from to filters
      if ($feeFrom != ''){
        $sql .=" and school.max_fee>=".$feeFrom;
      }    

      if ($feeTo != ''){
        $sql .=" and school.max_fee<=".$feeTo;
      }  

      // first language filter
      if ($lang != ''){
        $sql .=" and school_program.first_lang='".$lang."'";
      } 
      
      $isinterest = false ;

      if ($intSwim  != '' or $intSing != '' or $intAct != '' or $intFoot != '' or $intArt != ''){
        $isinterest = true ;
      }

      
      // interest braket start
      if($isinterest == true){
        $sql .=" and(";
      } 

      // all interests
      $isinterestfirst = false;


      // swimming interest
      if ($intSwim != '' ){
        if ( $isinterestfirst == false){
           $sql .="  interest.interest_name ='swimming'";
           $isinterestfirst = true;
          }
          else{
            $sql .=" or interest.interest_name ='swimming'";
          }
       }

      // singing interest  
      if ($intSing != ''){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='Special_Needs'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='Special_Needs'";
        }
      }
      
      // acting interest
      if ($intAct  != ''){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='acting'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='acting'";
        }
      }

      // football interest
      if ($intFoot != '' ){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='football'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='football'";
        }
      }

      // art interest
      if ($intArt != '' ){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='arts'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='arts'";
        }
      }

      // interest braket end
      if($isinterest == true){
        $sql .=")";
      }

      // check the sql statement itself
      $sql = str_replace('where and', 'where ', $sql);
      if($sql == 'where'){
        $sql='';
      }
      $sql = $sql2." ".$sql;
      //echo $sql;

       // open connection
       $conn = getConnection();
       // execute select query
       $result= selectQuery($conn,$sql);

       // loop - start (for multi rows)
       while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $sqlInt="
          SELECT interest.interest_name 
          from interest inner join school_interest on interest.id=school_interest.interest_id
          where school_interest.school_id=".$row['id']
          ;
          $resultInt= selectQuery($conn,$sqlInt);
          $outputInt="";
            while ($row2 = $resultInt->fetch(PDO::FETCH_ASSOC)) {
               $outputInt .='<span class="badge badge-pill badge-color-1">'.$row2['interest_name'].'</span>';
            }

            $outputInt2 = "<div>".$outputInt."</div>";
           
            $output;

            $advising;

            if ($row['advising_status'] == 1){

              $advising = "Open";

            }

            else

            $advising = "closed";

           $output = '
          <div class="card mb-2 color-4">
          <div class="row ">
           <div class="col-2">
               <img class="card-img-top" src="images/school.png" alt="Card image cap" class="w-100 h-100">
           </div>
           <div class="col-10 px-3">
             <div class="card-block px-3">
                 <h4 class="card-title pt-2">'.$row["school_name"].'</h4>
                 <p class="text-muted">'.$row["address"].'</p>
               
               '.$outputInt2.'

               <!--Statistics and fee range-->
               <div class="pt-2">'.$row["hits"].' Hits '.$row["applies"].' Applied<div class="float-right">'.$row["max_fee"].'</div></div>

               <!--Buttons apply-->
               <div class="pb-2">
                 <hr>
                   <a href="school.php?id='.$row['id'].'" class="btn btn-sm btn-color-2 float-right">View details</a>
                   Advising '.$advising.'
               </div>

                </div>
              </div>
            </div>
          </div>
           ';
       
           echo $output;
         } // loop - end

       // close connection
       closeConnection($conn);
    }

    public static function searchSchoolMap($city,$area,$type,$feeFrom,$feeTo,$lang,$intSwim,$intSing,$intAct,$intFoot,$intArt,$sname){
        // [yahia] once you are done with list view just copy and paste but change what will be echoed (markers)
        $sql2 = "
      SELECT distinct school.id, school.school_name , school.address,school.longitude ,school.latitude, school.max_fee, school.logo,school.hits,school.applies,school.advising_status FROM interest INNER join school_interest on interest.id=school_interest.interest_id INNER join school on school_interest.school_id=school.id inner join school_program on school.id=school_program.school_ID inner join program on school_program.prog_ID=program.id 
      
      ";
      $sql = "where";
      // check city and area
      if ($city != 'Select City' ){
        $sql .=" and school.city='".$city."'";
      }  

      if ($city != 'Select City' ){
        $sql .=" and school.area = '".$area."'";
      } 

      if ($sname != '' ){
        $sql .=" and school.school_name like'%".$sname."%'";
      }  

      // program filter
      if ($type != '' ){
        $sql .=" and program.program_name='".$type."'";
      }  

      // fee from to filters
      if ($feeFrom != ''){
        $sql .=" and school.max_fee>=".$feeFrom;
      }    

      if ($feeTo != ''){
        $sql .=" and school.max_fee<=".$feeTo;
      }  

      // first language filter
      if ($lang != ''){
        $sql .=" and school_program.first_lang='".$lang."'";
      } 
      
      $isinterest = false ;

      if ($intSwim  != '' or $intSing != '' or $intAct != '' or $intFoot != '' or $intArt != ''){
        $isinterest = true ;
      }

      
      // interest braket start
      if($isinterest == true){
        $sql .=" and(";
      } 

      // all interests
      $isinterestfirst = false;


      // swimming interest
      if ($intSwim != '' ){
        if ( $isinterestfirst == false){
           $sql .="  interest.interest_name ='swimming'";
           $isinterestfirst = true;
          }
          else{
            $sql .=" or interest.interest_name ='swimming'";
          }
       }

      // singing interest  
      if ($intSing != ''){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='singing'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='singing'";
        }
      }
      
      // acting interest
      if ($intAct  != ''){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='acting'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='acting'";
        }
      }

      // football interest
      if ($intFoot != '' ){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='football'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='football'";
        }
      }

      // art interest
      if ($intArt != '' ){
        if ( $isinterestfirst == false){
          $sql .="  interest.interest_name ='arts'";
          $isinterestfirst = true;
        }
        else{
          $sql .=" or interest.interest_name ='arts'";
        }
      }

      // interest braket end
      if($isinterest == true){
        $sql .=")";
      }

      // check the sql statement itself
      $sql = str_replace('where and', 'where ', $sql);
      if($sql == 'where'){
        $sql='';
      }
      $sql = $sql2." ".$sql;
      //echo $sql;

       // open connection
       $conn = getConnection();
       // execute select query
       $result= selectQuery($conn,$sql);

       while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         $look='<h5>'.$row['school_name'].'</h5><p>'.$row['address'].'</p><a href="school.php?id='.$row['id'].'" class="btn btn-sm btn-color-2 float-right">View details</a>';
         echo "
         var marker".$row['id']." = createMarker({
          position: new google.maps.LatLng(".$row['latitude'].",".$row['latitude']."),
          map: map
        }, '".$look."');
         ";
       }
    }

    // non-static functions

    public function printInterests(){
      // school is an input
      $schoolID = $this->id;
      $conn = getConnection();
      $sql = "
      SELECT interest.interest_name 
          from interest inner join school_interest on interest.id=school_interest.interest_id
          where school_interest.school_id=".$schoolID
      ;
      $result = selectQuery($conn,$sql);
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<span class="badge badge-pill badge-color-1">'.$row["interest_name"].'</span>';
      }

      closeConnection($conn);

    }
    
    public function printProgFilter(){
        // schoolID is an input
        $schoolID = $this->id;
        // open connection
        $conn = getConnection();
        $sql="select school_program.id,first_lang,program_name from school_program, program where program.id = school_program.prog_ID and school_ID = ".$schoolID;
        $result= selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<option value="'.$row['id'].'">'.$row['program_name'].' - '.$row['first_lang'].'</option>';
        }
        closeConnection($conn);
    }

    public function printLevels($schoolProgID){
      $conn = getConnection();
      $sql="select * from level where school_prog_id = ".$schoolProgID." and isactive = 1";
      $result= selectQuery($conn,$sql)->fetchAll(PDO::FETCH_ASSOC);

      // printing levels
      $output="";

      // 1 - preschool
      // print opening
      $output .='
      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#preschool" aria-expanded="false" aria-controls="collapseExample">
              <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">1</h5> Preschool</div>
          </button>

          <div class="collapse mb-2" id="preschool">
              <div class="card card-body color-3">
      ';

      // fetch levels
      foreach ($result as $row) {
          // check if its preschool
          if($row['type'] == "Preschool"){
              $output .='
                  <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#'.str_replace(' ', '', $row['level_name']).'" aria-expanded="false" aria-controls="collapseExample">
                      <div class="form-inline px-3 mx-2">'.$row['level_name'].'</div>
                  </button>
                
                  <div class="collapse mb-2" id="'.str_replace(' ', '', $row['level_name']).'">
                      <div class="card card-body">
                          
                              <div><b class="text-color-2">Tuition Fee:</b> '.$row['tutition_fee'].'L.E</div>
                              <div><b class="text-color-2">Placement Test:</b> '.$row['istest'].'</div>
                              <div><b class="text-color-2">Placement Test Fee:</b> '.$row['test_fee'].'</div>
                              <div><b class="text-color-2">Age Requirement</b> '.$row['age_from'].' - '.$row['age_to'].'</div>
                              <div><b class="text-color-2">Score Requirement:</b> '.$row['score'].'%</div>
                              <div><a href="app.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Apply</a></div>
                          
                      </div>
                    </div><!--/nusery-->
              ';
          }
      }
      // print closing
      $output .= '
          </div>
      </div>
      ';// 1 - preschool close
      
      // 2 - kindergarten
      // print opening
      $output .='
      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#kingergarten" aria-expanded="false" aria-controls="collapseExample">
              <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">2</h5> Kingergarten</div>
          </button>

          <div class="collapse mb-2" id="kingergarten">
              <div class="card card-body color-3">
      ';

      // fetch levels
      foreach ($result as $row) {
          // check if its kindergarten
          if($row['type'] == "Kindergarten"){
              $output .='
                  <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#'.str_replace(' ', '', $row['level_name']).'" aria-expanded="false" aria-controls="collapseExample">
                      <div class="form-inline px-3 mx-2">'.$row['level_name'].'</div>
                  </button>
                
                  <div class="collapse mb-2" id="'.str_replace(' ', '', $row['level_name']).'">
                      <div class="card card-body">
                          
                              <div><b class="text-color-2">Tuition Fee:</b> '.$row['tutition_fee'].'L.E</div>
                              <div><b class="text-color-2">Placement Test:</b> '.$row['istest'].'</div>
                              <div><b class="text-color-2">Placement Test Fee:</b> '.$row['test_fee'].'</div>
                              <div><b class="text-color-2">Age Requirement</b> '.$row['age_from'].' - '.$row['age_to'].'</div>
                              <div><b class="text-color-2">Score Requirement:</b> '.$row['score'].'%</div>
                              <div><a href="app.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Apply</a></div>
                          
                      </div>
                    </div><!--/nusery-->
              ';
          }
      }
      // print closing
      $output .= '
          </div>
      </div>
      ';// 2 - kindergarten close

      // 3 - Primary
      // print opening
      $output .='
      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#primary" aria-expanded="false" aria-controls="collapseExample">
              <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">3</h5> Primary</div>
          </button>

          <div class="collapse mb-2" id="primary">
              <div class="card card-body color-3">
      ';

      // fetch levels
      foreach ($result as $row) {
          // check if its primary
          if($row['type'] == "Primary"){
              $output .='
                  <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#'.str_replace(' ', '', $row['level_name']).'" aria-expanded="false" aria-controls="collapseExample">
                      <div class="form-inline px-3 mx-2">'.$row['level_name'].'</div>
                  </button>
                
                  <div class="collapse mb-2" id="'.str_replace(' ', '', $row['level_name']).'">
                      <div class="card card-body">
                          
                              <div><b class="text-color-2">Tuition Fee:</b> '.$row['tutition_fee'].'L.E</div>
                              <div><b class="text-color-2">Placement Test:</b> '.$row['istest'].'</div>
                              <div><b class="text-color-2">Placement Test Fee:</b> '.$row['test_fee'].'</div>
                              <div><b class="text-color-2">Age Requirement</b> '.$row['age_from'].' - '.$row['age_to'].'</div>
                              <div><b class="text-color-2">Score Requirement:</b> '.$row['score'].'%</div>
                              <div><a href="app.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Apply</a></div>
                          
                      </div>
                    </div><!--/nusery-->
              ';
          }
      }
      // print closing
      $output .= '
          </div>
      </div>
      ';// 3 - Primary close

      // 4 - Prepratory
      // print opening
      $output .='
      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#prepratory" aria-expanded="false" aria-controls="collapseExample">
              <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">4</h5> Prepratory</div>
          </button>

          <div class="collapse mb-2" id="prepratory">
              <div class="card card-body color-3">
      ';

      // fetch levels
      foreach ($result as $row) {
          // check if its Prepratory
          if($row['type'] == "Prepratory"){
              $output .='
                  <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#'.str_replace(' ', '', $row['level_name']).'" aria-expanded="false" aria-controls="collapseExample">
                      <div class="form-inline px-3 mx-2">'.$row['level_name'].'</div>
                  </button>
                
                  <div class="collapse mb-2" id="'.str_replace(' ', '', $row['level_name']).'">
                      <div class="card card-body">
                          
                              <div><b class="text-color-2">Tuition Fee:</b> '.$row['tutition_fee'].'L.E</div>
                              <div><b class="text-color-2">Placement Test:</b> '.$row['istest'].'</div>
                              <div><b class="text-color-2">Placement Test Fee:</b> '.$row['test_fee'].'</div>
                              <div><b class="text-color-2">Age Requirement</b> '.$row['age_from'].' - '.$row['age_to'].'</div>
                              <div><b class="text-color-2">Score Requirement:</b> '.$row['score'].'%</div>
                              <div><a href="app.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Apply</a></div>
                          
                      </div>
                    </div><!--/nusery-->
              ';
          }
      }
      // print closing
      $output .= '
          </div>
      </div>
      ';// 4 - Prepratory close

      // 5 - Secondary
      // print opening
      $output .='
      <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#secondary" aria-expanded="false" aria-controls="collapseExample">
              <div class="form-inline"><h5 class="color-4 p-2 px-3 mx-2 rounded-circle step-active">5</h5> Secondary</div>
          </button>

          <div class="collapse mb-2" id="secondary">
              <div class="card card-body color-3">
      ';

      // fetch levels
      foreach ($result as $row) {
          // check if its Secondary
          if($row['type'] == "Secondary"){
              $output .='
                  <button type="button" style="border-width:5px;" class="btn btn-light w-100 p-0 py-2 mb-2 border-top-0 border-bottom-0 border-dark rounded-0" data-toggle="collapse" data-target="#'.str_replace(' ', '', $row['level_name']).'" aria-expanded="false" aria-controls="collapseExample">
                      <div class="form-inline px-3 mx-2">'.$row['level_name'].'</div>
                  </button>
                
                  <div class="collapse mb-2" id="'.str_replace(' ', '', $row['level_name']).'">
                      <div class="card card-body">
                          
                              <div><b class="text-color-2">Tuition Fee:</b> '.$row['tutition_fee'].'L.E</div>
                              <div><b class="text-color-2">Placement Test:</b> '.$row['istest'].'</div>
                              <div><b class="text-color-2">Placement Test Fee:</b> '.$row['test_fee'].'</div>
                              <div><b class="text-color-2">Age Requirement</b> '.$row['age_from'].' - '.$row['age_to'].'</div>
                              <div><b class="text-color-2">Score Requirement:</b> '.$row['score'].'%</div>
                              <div><a href="app.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Apply</a></div>
                          
                      </div>
                    </div><!--/nusery-->
              ';
          }
      }
      // print closing
      $output .= '
          </div>
      </div>
      ';// 5 - Secondary close

      if ($schoolProgID == 0){
          $output = "";
      }
      echo $output;

      closeConnection($conn);



    }
}
