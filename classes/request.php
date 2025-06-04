<?php
class Request{

    // static functions
    public static function printRequestApp($requestID){
        $output = file_get_contents("requests/".$requestID.".php");
        $output = str_replace('<button class="btn btn-color-2 mb-5 rounded-0 float-right" id="finish">Finish</button>', '', $output);
        $output = str_replace('Make sure that information is correct', '', $output);
        
        echo $output;
    }

    public static function submitRequest($levelID, $schoolID, $dynamic, $fname, $mname1, $mname2, $lname, $gender,$dob,$birthPlace, $nationality, $religion, $address1, $address2, $hPhone, $last,$prep,$prim, $fJob, $mJob){
        // create record first then get its id to name the file
        // get user id from session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $userID = $_SESSION['account']->userID;
        $conn = getConnection();
        $sql = "
        insert into request(level_id,school_id,user_id,fname,mname1,mname2,lname,gender,dob,birth_pplace,nationality,religion,address1,address2,home_phone,last_school,prep_school,prim_school,father_job,mother_job,issue_date)
        values
        (".$levelID.",".$schoolID.",".$userID.",'".$fname."','".$mname1."','".$mname2."','".$lname."','".$gender."','".$dob."','".$birthPlace."','".$nationality."','".$religion."','".$address1."','".$address2."','".$hPhone."','".$last."','".$prep."','".$prim."','".$fJob."','".$mJob."','".date("Y/m/d")."')
        ";

        execQuery($conn,$sql);
        // create the file that contain all
        $sql = "select LAST_INSERT_ID()";
        $resultNum = selectQuery($conn,$sql)->fetchColumn(); // id

        // create request file
        $myfile = fopen("requests/".$resultNum.".php", "w") or die("Unable to open file!");
        $txt = $dynamic;
        fwrite($myfile, $txt);
        fclose($myfile);
        
        closeConnection($conn);
    }
}
?>