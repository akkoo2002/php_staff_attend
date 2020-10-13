<?php
    session_start();

if(isset($_POST["submit"])){
    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    $date =date("Y-m-j");//"2020-10-13";// 

    if(checkAttenddence($conn,$_SESSION['userid'],$date)!==false){
        header("location: ../applyattendence.php?success=alreadyapplied");
        exit();
    }
    applyAttendence($conn,$_SESSION['userid'],$date);
}
else{
    header("location: ../adminhome.php");
}