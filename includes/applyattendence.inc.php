<?php
    session_start();

if(isset($_POST["submit"])){
    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    $timestamp = time()+((60*60)*5.5);
    $date =$_POST["date"];//"2020-10-12";// date('d/M/Y', $timestamp);
    // echo $_POST["date"];
    if(checkAttenddence($conn,$_SESSION['userid'],$date)!==false){
        header("location: ../applyattendence.php?success=alreadyapplied");
        exit();
    }
    applyAttendence($conn,$_SESSION['userid'],$date);
}
else{
    header("location: ../adminhome.php");
}