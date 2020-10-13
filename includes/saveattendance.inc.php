

<?php
    session_start();

 $obj = json_decode(file_get_contents('php://input'),true);

if($obj["staffid"]){
    $att_date = $obj["att_date"];
    $staffid = $obj["staffid"];
    $att_state = $obj["att_state"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    $result = saveAttendence($conn,$att_date,$staffid,$att_state);
    header('Content-Type: application/json');
    if($result===true){
        echo '{"result":"success"}';
    }
    else{
        echo '{"result":"failed"}';
    }
}
else{
    echo "error";
}
?>