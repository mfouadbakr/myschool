<?php
require_once('account.php');
class SchoolAdmin extends Account{

    // non-static functions
    public function onoffAdvising($schoolID){
        $conn = getConnection();
        $sql="select * from school where id = ".$schoolID;
        $result = selectQuery($conn,$sql);

        $row = $result->fetch();
        $input;
        if($row['advising_status'] == 0){
            $input = 1;
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['school']->advisingStatus=1;
        }
        else{
            $input = 0;
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['school']->advisingStatus=0;
        }

        $sql = "update school set advising_status = ".$input." where id = ".$schoolID;
        execQuery($conn,$sql);

        closeConnection($conn);
    }

    public function printRequests($schoolProgID){
        $conn = getConnection();
        $sql="
        SELECT request.id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname) as student, level_name,dob,father_job,mother_job
        FROM request,level 
        where request.level_id = level.id and appointment_date is null and result is null 
        and school_prog_id = ".$schoolProgID;
        $result = selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $date = new DateTime($row['dob']);
            $now = new DateTime('2019/05/01'); // this is temporary fix since its next october
            $age = $now->diff($date)->y; // got age difference here
            echo '
            <tr>
                <td class="form-inline">
                    <a href="school-appointment.php?request='.$row["id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/buttons/accept.svg" height="20" width="20"></a>
                    <a href="school-appointment.php?request='.$row["id"].'&answer=no" class="btn btn-sm btn-action"><img src="images/buttons/reject.svg" height="20" width="20"></a>
                </td>
                <td>'.$row["student"].'</td>
                <td>'.$row["level_name"].'</td>
                <td>'.$age.'</td>
                <td>'.$row["father_job"].'</td>
                <td>'.$row["mother_job"].'</td>
            </tr>
            ';
        }

        closeConnection($conn);
    }

    public function printAppointments($isAttended,$schoolID){
        $conn = getConnection();
        $sql="
        SELECT request.id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname) as student, level_name,appointment_date
        FROM request,level 
        where request.level_id = level.id and appointment_date is not null and result is null 
        and request.school_id = ".$schoolID." and isattended = ".$isAttended;
        $result = selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // validation will be needed later
            if ($isAttended == 0){
            echo '
            <tr>
                <td class="form-inline">
                    
                </td>
                <td>Unattended</td>
                <td>'.$row["student"].'</td>
                <td>'.$row["level_name"].'</td>
                <td>'.$row["appointment_date"].'</td>
            </tr>
            ';
            }
            else{
            echo '
            <tr>
                <td class="form-inline">
                    <a href="school-app.php?appcode='.$row["id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/buttons/application.svg" height="20" width="20"></a>
                </td>
                <td>'.$row["id"].'</td>
                <td>'.$row["student"].'</td>
                <td>'.$row["level_name"].'</td>
                <td>'.$row["appointment_date"].'</td>
            </tr>
            ';
            }
            
        }

        closeConnection($conn);
    }

    public function printAcceptRejectRequests($result,$schoolID){
        $conn = getConnection();
        $sql="
        SELECT request.id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname) as student, level_name,result
        FROM request,level 
        where request.level_id = level.id and result is not null 
        and request.school_id = ".$schoolID." and result = ".$result;
        $result = selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // validation will be needed later
            $isaccepted;
            if ($row["result"] == 0){
                $isaccepted = "No";
            }
            else{
                $isaccepted = "Yes";
            }
            
            echo '
            <tr>
                <td class="form-inline">
                    <a href="school-app.php?appcode='.$row["id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/buttons/application.svg" height="20" width="20"></a>
                </td>
                <td>'.$row["id"].'</td>
                <td>'.$row["student"].'</td>
                <td>'.$row["level_name"].'</td>
                <td>'.$isaccepted.'</td>
            </tr>
            ';
        }

        closeConnection($conn);
    }

    public function printSchoolProg($schoolID,$printType){
        // open connection
        $conn = getConnection();
        $sql="select school_program.id,first_lang,program_name from school_program, program where program.id = school_program.prog_ID and school_ID = ".$schoolID;
        $result= selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($printType == 1){
                echo '<option value="'.$row['id'].'">'.$row['program_name'].' - '.$row['first_lang'].'</option>';
            }
            else if($printType == 2){
                echo '<tr><td>'.$row['program_name'].' - '.$row['first_lang'].'</td></tr>';
            }
        }
        closeConnection($conn);
    }

    public function createSchoolProgram($schoolID,$progID,$lang){
        $conn = getConnection();
        // check if program exist first
        $sql="select count(*) from school_program, program where program.id = school_program.prog_ID and school_ID = ".$schoolID." and prog_ID = ".$progID." and first_lang = '".$lang."'";
        $resultNum = selectQuery($conn,$sql)->fetchColumn();

        if ($resultNum == 0){
            // insert school program
            $sql = "insert into school_program(school_ID,prog_ID,first_lang) values(".$schoolID.",".$progID.",'".$lang."')";
            execQuery($conn,$sql);

            // get school program id
            $sql = "select LAST_INSERT_ID()";
            $resultNum = selectQuery($conn,$sql)->fetchColumn(); // id

            // create all levels of the school programs
            $sql = "
            insert into level(level_name,type,type_no,school_prog_id,school_id)
            values
            ('Nursery','Preschool',1,".$resultNum.",".$schoolID."),
            ('Reception','Preschool',1,".$resultNum.",".$schoolID."),
            ('KG 1','Kindergarten',2,".$resultNum.",".$schoolID."),
            ('KG 2','Kindergarten',2,".$resultNum.",".$schoolID."),
            ('Primary 1','Primary',3,".$resultNum.",".$schoolID."),
            ('Primary 2','Primary',3,".$resultNum.",".$schoolID."),
            ('Primary 3','Primary',3,".$resultNum.",".$schoolID."),
            ('Primary 4','Primary',3,".$resultNum.",".$schoolID."),
            ('Primary 5','Primary',3,".$resultNum.",".$schoolID."),
            ('Primary 6','Primary',3,".$resultNum.",".$schoolID."),
            ('Prepratory 1','Prepratory',4,".$resultNum.",".$schoolID."),
            ('Prepratory 2','Prepratory',4,".$resultNum.",".$schoolID."),
            ('Prepratory 3','Prepratory',4,".$resultNum.",".$schoolID."),
            ('Secondary 1','Secondary',5,".$resultNum.",".$schoolID."),
            ('Secondary 2','Secondary',5,".$resultNum.",".$schoolID."),
            ('Secondary 3','Secondary',5,".$resultNum.",".$schoolID.")
            ";

            execQuery($conn,$sql);
            echo '<script type="text/javascript">alert("Success: School Program added successfully.")</script>';
        }
        else{
            echo '<script type="text/javascript">alert("Invalid: School program already exist")</script>';
        }

        closeConnection($conn);
    }

    // must be called using ajax
    public function printLevels($schoolProgID){
        $conn = getConnection();
        $sql="select * from level where school_prog_id = ".$schoolProgID;
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
                                <div><a href="school-level.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Edit</a></div>
                            
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
                                <div><a href="school-level.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Edit</a></div>
                            
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
                                <div><a href="school-level.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Edit</a></div>
                            
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
                                <div><a href="school-level.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Edit</a></div>
                            
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
                                <div><a href="school-level.php?id='.$row['id'].'" class="btn btn-color-2 float-right rounded-0">Edit</a></div>
                            
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

    public function getLevelInfo($lvlID){
        $conn = getConnection();
        $sql="select * from level where id = ".$lvlID;
        $result= selectQuery($conn,$sql);
        $row = $result->fetch();

        $isTest;
        if($row["istest"] == 1){
            $isTest = "Yes";
        }
        else{
            $isTest = "No";
        }

        $isActive;
        if($row["isactive"] == 1){
            $isActive = "Yes";
        }
        else{
            $isActive = "No";
        }

        $output = '
        <h6>Level: '.$row["level_name"].'</h6>
        <h6>Tuition fee: '.$row["tutition_fee"].'L.E</h6>
        <h6>Placement test fee: '.$row["test_fee"].'L.E</h6>
        <h6>Placement test: '.$isTest.'</h6>
        <h6>Age requirement: '.$row["age_from"].' - '.$row["age_to"].' Years</h6>
        <h6>Score requriement: '.$row["score"].'%</h6>
        <h6>Active: '.$isActive.'</h6>
        ';

        echo $output;

        closeConnection($conn);

    }

    public function updateLevel($lvlID,$levelName,$fee,$testFee,$isTest,$ageFrom,$ageTo,$score,$isActive){
        $conn = getConnection();
        $sql="
        update level
        set
        level_name = '".$levelName."',
        tutition_fee = '".$fee."',
        test_fee = '".$testFee."',
        istest = ".$isTest.",
        age_from = '".$ageFrom."',
        age_to = '".$ageTo."',
        score = '".$score."',
        isactive = ".$isActive."
        where id = ".$lvlID;
        execQuery($conn,$sql);

        closeConnection($conn);
    }

    public function makeAppointment($requestID,$appointmentDate){
        $conn = getConnection();
        $sql ="
        update request
        set appointment_date = '".$appointmentDate."'
        where id = " .$requestID;
        execQuery($conn,$sql);
        closeConnection($conn);
        header("Location: school-advising.php");
    }

    public function acceptRequest($requestID){
        $conn = getConnection();
        $sql ="
        update request
        set result = 1
        where id = " .$requestID;
        execQuery($conn,$sql);
        closeConnection($conn);
        header("Location: school-advising.php");
    }

    public function rejectRequest($requestID){
        $conn = getConnection();
        $sql ="
        update request
        set result = 0
        where id = " .$requestID;
        execQuery($conn,$sql);
        closeConnection($conn);
        header("Location: school-advising.php");
    }

    public function submitAppCode($appCode,$schoolID){
        $conn = getConnection();
        $sql="select count(*) from request where id = ".$appCode." and school_id = ".$schoolID;
        // check it
        $resultNum = selectQuery($conn,$sql)->fetchColumn();
        if($resultNum == 1){
            $sql = "update school set applies = applies+1 where id = ".$schoolID;
            execQuery($conn,$sql);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['school']->applies++;
            
            $sql = "
        update request
        set isattended = 1
        where id = ".$appCode." and school_id = ".$schoolID;
        execQuery($conn,$sql);
        }
        else{
            echo '<script type="text/javascript">alert("Sorry this appcode is invalid")</script>';
            header("Location: school-advising.php");
        }

        
        closeConnection($conn);
    }

    public function addInterest($interestID,$schoolID){
        $conn = getConnection();

        // check if it exist first
        $sql = "
        select count(*) from school_interest
        where interest_id = ".$interestID." and school_id = ".$schoolID;
        $resultNum = selectQuery($conn,$sql)->fetchColumn();
        if($resultNum == 0){
        $sql = "
        insert into school_interest(interest_id,school_id)
        values(".$interestID.",".$schoolID.")
        ";
        execQuery($conn,$sql);
        }
        else{
            echo '<script type="text/javascript">alert("Invalid: School interest already exist")</script>';
        }
        
        closeConnection($conn);
    }

    public function printBills($schoolID){
        $conn = getConnection();
        $sql = "select * from transaction where school_id = ".$schoolID;
        $result = selectQuery($conn,$sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <tr>
            <td>'.$row['trans_name'].'</td>
            <td>'.$row['amount'].'L.E</td>
            <td>'.$row['trans_datetime'].'</td>
            </tr>
            ';
        }

        closeConnection($conn);

    }

    public function editBio($schoolID,$bio){
        $conn = getConnection();
        $sql = "update school set bio = '".$bio."' where id = ".$schoolID;
        execQuery($conn,$sql);
        closeConnection($conn);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['school']->bio=$bio;
    }
}
?>