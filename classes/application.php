<?php
class Application{

    // static functions

    // user use this function
    public static function printDynamic($schoolID){
        $output = file_get_contents("school-apps/".$schoolID.".php");
        // remove delete button from it
        $output = str_replace('<button class="btn btn-sm btn-color-2 mt-2 btn-delete">X Remove control</button>', '', $output);
        echo $output;
    }

    // school admin use this function
    public static function generateApp($dynamic){
        // get school id from session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // create application file
        $myfile = fopen("school-apps/".$_SESSION['school']->id.".php", "w") or die("Unable to open file!");
        $txt = $dynamic;
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
?>