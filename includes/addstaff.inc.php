<?php

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    if(staffExists($conn,$username)){
        
        header("location: ../addstaff.php?error=staffexists");
        exit();
    }
    createStaff($conn,$name,$username,$password);
}
else{
    header("location: ../adminhome.php");
}