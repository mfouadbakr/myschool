<?php
require_once('dbconn.php');
require_once('user.php');
require_once('schoolAdmin.php');
require_once('systemAdmin.php');
require_once('school.php');

class Account{
    // attributes
    public $fname;
    public $lname;
    public $email;
    public $type;
    public $country;

    // static functions
    public static function login($mail,$pass){
        // open connection
        $conn = getConnection();
        // select query
        $sql = 'select * from account where email = "'.$mail.'" and password = "'.$pass.'"';
        // execute query
        $result = selectQuery($conn,$sql);
        // fetch result in 1 row (need to validate that)
        $row = $result->fetch();
        //validate if its a user
        if ($row['type'] == "user"){
            // create user object and assign values to it
            $userOBJ = new User();
            $userOBJ->userID=$row['user_id'];
            $userOBJ->fname=$row['fname'];
            $userOBJ->lname=$row['lname'];
            $userOBJ->type=$row['type'];
            $userOBJ->country=$row['country'];

            // open account session and assign obj to it
            session_start();
            $_SESSION["account"] = $userOBJ;

            // go to user profile page
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!empty($_SESSION['school'])){
                $url="school.php?id=".$_SESSION['school']->id;
            }
            else{
                $url="user-profile.php";
            }
            header( "Location: $url" );
        }
        else if ($row['type'] == "admin"){
            // create admin object and assign values to it
            $adminOBJ = new SystemAdmin();
            $adminOBJ->fname=$row['fname'];
            $adminOBJ->lname=$row['lname'];
            $adminOBJ->type=$row['type'];
            $adminOBJ->country=$row['country'];

            // open account session and assign obj to it
            session_start();
            $_SESSION["account"] = $adminOBJ;

            // go to user profile page
            $url="system-signups.php";
            header( "Location: $url" );
        }
        else if ($row['type'] == "school"){
            // create school admin object and assign values to it
            $sadminOBJ = new SchoolAdmin();
            $sadminOBJ->fname=$row['fname'];
            $sadminOBJ->lname=$row['lname'];
            $sadminOBJ->type=$row['type'];
            $sadminOBJ->country=$row['country'];

            $schoolOBJ = School::createSchoolObj($row['school_id']);

            session_start();
            $_SESSION["account"] = $sadminOBJ;
            $_SESSION["school"] = $schoolOBJ;

            // go to school advising page
            $url="school-advising.php";
            header( "Location: $url" );
        }

        // close connection in all situations
        closeConnection($conn);
        
    }

    public static function signupUser($mail,$pass,$pass2,$fname,$lname,$country,$referral){
        $conn = getConnection();

        // validations
        $incorrect = 0;
        // check mail format
        if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
            echo '<script type="text/javascript">alert("Invalid: Email Format")</script>';
            $incorrect = 1;
        }

        //check password 1 and 2
        if($pass != $pass2){
            echo '<script type="text/javascript">alert("Invalid: Passwords")</script>';
            $incorrect = 1;
        }

        // check for numeric values
        if(ctype_alpha ($fname) == false){
            echo '<script type="text/javascript">alert("Invalid: First name contains numbers")</script>';
            $incorrect = 1;
        }

        // check for numeric values
        if(ctype_alpha ($lname) == false){
            echo '<script type="text/javascript">alert("Invalid: Last name contains numbers")</script>';
            $incorrect = 1;
        }
        
        if($incorrect == 0){
            // select query
        $sql = 'select count(*) from account where email = "'.$mail.'"';
        // execute query and get number of results
        $resultNum = selectQuery($conn,$sql)->fetchColumn();

        if ($resultNum == 0){
            // validation for parameters missing here

            // make new record in user table
            $sql = "INSERT INTO user values (null)"; // only 1 identity attribute
            execQuery($conn,$sql);
            $sql = "select LAST_INSERT_ID()";
            $resultNum = selectQuery($conn,$sql)->fetchColumn(); // id
            //echo '<script type="text/javascript">alert("'.$resultNum.'")</script>';
            // make new user account
            $sql = "insert into account(fname,lname,email,password,type,isactive,country,referral,user_id) 
            values('".$fname."','".$lname."','".$mail."','".$pass."','user',1,'".$country."','".$referral."',".$resultNum.")";
            execQuery($conn,$sql);

            // call login
            self::login($mail,$pass); // self refers to same class i am in
            
        }
        else{
            echo '<script type="text/javascript">alert("Invalid: Email already exist")</script>';
        }
        }
        

        closeConnection($conn);
    }

    public static function signupSchool($cfname,$clname,$job,$mphone,$fname,$lname,$mail,$pass,$pass2,$sname,$country,$address,$service,$sphone,$website,$method,$card,$referral){
        $conn = getConnection();

        // validations
        $incorrect = 0;

        // check for numeric values
        if(ctype_alpha ($cfname) == false){
            echo '<script type="text/javascript">alert("Invalid: Contact First name contains numbers")</script>';
            $incorrect = 1;
        }

        if(ctype_alpha ($clname) == false){
            echo '<script type="text/javascript">alert("Invalid: Contact Last name contains numbers")</script>';
            $incorrect = 1;
        }

        // check job
        if(ctype_alpha ($job) == false){
            echo '<script type="text/javascript">alert("Invalid: Job contains numbers")</script>';
            $incorrect = 1;
        }

        // check if numberic is true
        if(ctype_digit ($mphone) == false){
            echo '<script type="text/javascript">alert("Invalid: Mobile number contains text")</script>';
            $incorrect = 1;
        }

        if(ctype_digit ($card) == false){
            echo '<script type="text/javascript">alert("Invalid: Card number contain letters")</script>';
            $incorrect = 1;
        }

        if(ctype_digit ($sphone) == false){
            echo '<script type="text/javascript">alert("Invalid: School number contain letters")</script>';
            $incorrect = 1;
        }

        // check mail format
        if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
            echo '<script type="text/javascript">alert("Invalid: Email Format")</script>';
            $incorrect = 1;
        }

        //check password 1 and 2
        if($pass != $pass2){
            echo '<script type="text/javascript">alert("Invalid: Passwords")</script>';
            $incorrect = 1;
        }

        // check for numeric values
        if(ctype_alpha ($fname) == false){
            echo '<script type="text/javascript">alert("Invalid: First name contains numbers")</script>';
            $incorrect = 1;
        }

        // check for numeric values
        if(ctype_alpha ($lname) == false){
            echo '<script type="text/javascript">alert("Invalid: Last name contains numbers")</script>';
            $incorrect = 1;
        }
        
        
        if($incorrect == 0){
        // select query
        $sql = 'select count(*) from account where email = "'.$mail.'"';
        // execute query and get number of results
        $resultNum = selectQuery($conn,$sql)->fetchColumn();

        if ($resultNum == 0){
            // insert school
            $sql="insert into school(school_name,service_pakage,address) values ('".$sname."','".$service."','".$address."')";
            execQuery($conn,$sql);

            // get school id
            $sql = "select LAST_INSERT_ID()";
            $resultNum = selectQuery($conn,$sql)->fetchColumn(); // id

            // insert school contact
            $sql="
            insert into school_contact(school_id,fname,lname,mobile_phone,job_title,School_website,payment_method,card_no)
            values (".$resultNum.",'".$cfname."','".$clname."','".$mphone."','".$job."','".$website."','".$method."','".$card."')
            ";
            execQuery($conn,$sql);

            // insert into account
            $sql = "insert into account(fname,lname,email,password,type,isactive,country,referral,school_id) 
            values('".$fname."','".$lname."','".$mail."','".$pass."','school',1,'".$country."','".$referral."',".$resultNum.")";
            execQuery($conn,$sql);

            // call login function

        }
        else{
            echo '<script type="text/javascript">alert("Invalid: Email already exist")</script>';
        }
    }

        closeConnection($conn);
    }

    public static function logout(){
        session_start();
        session_unset();
        session_destroy();
    }
}
?>