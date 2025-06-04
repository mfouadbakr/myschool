<?php
require_once('account.php');
class SystemAdmin extends Account{

    // non-static functions
    public function printSignupRequests(){
        // open connection
        $conn = getConnection();
        // select query
        $sql = 'select * from school,school_contact where school.id = school_contact.school_id and issignup = 0';
        // execute query
        $result = selectQuery($conn,$sql);

        // print result
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $output = '
            <tr>
                <td class="form-inline">
                  <a href="system-school.php?request='.$row["id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/buttons/request.svg" height="20" width="20"></a>
                  </td>
                <td>'.$row["school_name"].'</td>
                <td>'.$row["address"].'</td>
                <td>'.$row["fname"].' '.$row["lname"].'</td>
                <td>'.$row["job_title"].'</td>
                <td>'.$row["mobile_phone"].'</td>
              </tr>
            ';

            echo $output;
        }

        closeConnection($conn);
    }

    public function printSignupSchool($schoolID){
        // open connection
        $conn = getConnection();
        // select query
        $sql = 'select * from school,school_contact where school.id = school_contact.school_id and issignup = 0 and school_id = '.$schoolID.'';
        // execute query
        $result = selectQuery($conn,$sql);
        $row = $result->fetch();

        // print output
        $output='
        <h5>School </h5>'.$row["school_name"].' </br></br>
        <h5>Address</h5>'.$row["address"].'
        ';

        echo $output;

        closeConnection($conn);
    }

    public function acceptSignup($schoolID,$city,$area,$longitude,$latitude){
        // open connection
        $conn = getConnection();
        // update school query
        $sql = 'update school set isaccepted = 1, city = "'.$city.'", area="'.$area.'",longitude= '.$longitude.', latitude= '.$latitude.' where id = '.$schoolID.'';
        // execute query
        execQuery($conn,$sql);
        // update school-contact query
        $sql = 'update school_contact set issignup = 1 where id = '.$schoolID.'';
        // execute query
        execQuery($conn,$sql);

        // insert a transaction
        $now = new DateTime();
        $this->doTrans($schoolID,"First-time activation","School Year",2000,$now->format('Y-m-d H:i:s'),$conn);

        closeConnection($conn);

        // create application file
        $myfile = fopen("school-apps/".$schoolID.".php", "w") or die("Unable to open file!");
        $txt = "No application to preview.";
        fwrite($myfile, $txt);
        fclose($myfile);

        // go to user profile page
        $url="system-signups.php";
        header( "Location: $url" );
    }

    public function rejectSignup($schoolID){

    }

    public function doTrans($schoolID,$transName,$transType,$amount,$transDatetime,$conn){
        $sql='insert into transaction(school_id,trans_name,trans_type,amount,trans_datetime)
        values('.$schoolID.',"'.$transName.'","'.$transType.'",'.$amount.',"'.$transDatetime.'")
        ';
        execQuery($conn,$sql);
    }
}
?>