<?php
require_once('classes/account.php');
require_once('classes/application.php');
require_once('classes/request.php');
require_once('classes/school.php');
require_once('classes/systemAdmin.php');
require_once('classes/schoolAdmin.php');
require_once('classes/user.php');

session_start();

// ajax call the php function
	
if(isset($_POST['function2call']) && !empty($_POST['function2call'])) {
    $function2call = $_POST['function2call'];
	//$arg = $_POST['arguments'];
    switch($function2call) {
        case 'ajaxLogout' : Account::logout();break;
        case 'ajaxGetLevels' : $_SESSION["account"]->printLevels($_POST['schoolProgID']);break;
        case 'ajaxGetLevelsUser' : $_SESSION["school"]->printLevels($_POST['schoolProgID']);break;
        case 'ajaxGenerateApp' : Application::generateApp($_POST['dynamic']);break;
        case 'ajaxSubmitRequest' : Request::submitRequest($_POST['xlvlid'], $_SESSION['school']->id, $_POST['xfinal'], $_POST['xfname'], $_POST['xmname1'], $_POST['xmname2'], $_POST['xlname'], $_POST['xgender'],$_POST['xdob'],$_POST['xpob'], $_POST['xnationality'], $_POST['xreligion'], $_POST['xaddress1'], $_POST['xaddress2'], $_POST['xhphone'], $_POST['xlschool'],$_POST['xprepschool'],$_POST['xprimschool'], $_POST['xfjob'], $_POST['xmjob']);break;
        case 'ajaxPrintRequests' : $_SESSION["account"]->printRequests($_POST['schoolProgID']);break;
        case 'ajaxPrintAppointments' : $_SESSION["account"]->printAppointments($_POST['isAttended'],$_SESSION['school']->id);break;
        case 'ajaxPrintAccept' : $_SESSION["account"]->printAcceptRejectRequests($_POST['result'],$_SESSION['school']->id);break;

    }
}
?>