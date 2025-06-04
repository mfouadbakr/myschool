<?php
require_once('account.php');
class User extends Account{
    // attributes
    public $userID;


    // non-static functions

    public function printRequests(){
        // input is $userID from session
        $sql = "
        SELECT request.school_id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname)as student_name,school.school_name as school, concat( program.program_name,'-',school_program.first_lang) as program ,level.level_name as stage, request.issue_date 
        FROM school inner join request on school.id = request.school_id inner join level on request.level_id=level.id inner join school_program on level.school_prog_id = school_program.id inner join program on school_program.prog_ID = program.id 
        where appointment_date is null and result is null and request.user_id=".$this->userID;

        // open connection
        $conn = getConnection();
        // execute select query
        $result= selectQuery($conn,$sql);

        // print result
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $output = '
            <tr>
                        <td class="form-inline">
                            <a href= "school.php?id='.$row["school_id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/logo.svg" height="20" width="20"></a>
                          </td>
                      <td>'.$row["student_name"].'</td>
                      <td>'.$row["school"].'</td>
                      <td>'.$row["program"].'</td>
                      <td>'.$row["stage"].'</td>
                      <td>'.$row["issue_date"].'</td>
                    </tr>
            ';

            echo $output;
        }

        // close connection
        closeConnection($conn);
        
    }

    public function printAppointments(){
        // input is $userID from session
        $sql = "
        SELECT longitude, latitude, appointment_date, request.school_id, request.id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname)as student_name,school.address as school, concat( program.program_name,'-',school_program.first_lang) as program ,level.level_name as stage, request.issue_date 
        FROM school inner join request on school.id = request.school_id inner join level on request.level_id=level.id inner join school_program on level.school_prog_id = school_program.id inner join program on school_program.prog_ID = program.id 
        where appointment_date is not null and result is null and request.user_id=".$this->userID;

        // open connection
        $conn = getConnection();
        // execute select query
        $result= selectQuery($conn,$sql);

        // print result
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $output = '
            <tr>
                      <td class="form-inline">
                      <a href= "school.php?id='.$row["school_id"].'" class="btn btn-sm mr-1 btn-action"><img src="images/logo.svg" height="20" width="20"></a>
                        </td>
                        <td>'.$row["id"].'</td>
                    <td>'.$row["student_name"].'</td>
                    <td>'.$row["school"].'</td>
                    <td>'.$row["stage"].'</td>
                    <td>'.$row["appointment_date"].'</td>
                  </tr>
            ';

            echo $output;
        }

        // close connection
        closeConnection($conn);
        
    }

    public function printAcceptRejectRequests(){
        // input is $userID from session
        $sql = "
        SELECT result, request.school_id, CONCAT (fname,' ',mname1,' ',mname2,' ',lname)as student_name,school.school_name as school, concat( program.program_name,'-',school_program.first_lang) as program ,level.level_name as stage, request.issue_date 
        FROM school inner join request on school.id = request.school_id inner join level on request.level_id=level.id inner join school_program on level.school_prog_id = school_program.id inner join program on school_program.prog_ID = program.id 
        where result is not null and request.user_id=".$this->userID;

        // open connection
        $conn = getConnection();
        // execute select query
        $result= selectQuery($conn,$sql);

        // print result
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $output = '
            <tr>
                      <td>'.$row["student_name"].'</td>
                      <td>'.$row["school"].'</td>
                      <td>'.$row["stage"].'</td>
            ';

            if ($row["result"] == 1){
                $output .='<td>Accepted</td></tr>';
            }
            else{
                $output .='<td>Rejected</td></tr>';
            }
            

            echo $output;
        }

        // close connection
        closeConnection($conn);
    }
}
?>