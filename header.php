<?php
    session_start();
    
    $requestUri = $_SERVER['REQUEST_URI'];
    $requestUri = str_replace("/demo","",$requestUri);

    if($requestUri==="/addstaff.php" ){
        if(isset($_SESSION["userid"])){
            if($_SESSION["role"]!=="admin"){
                header("location: staffhome.php");
                exit();
            }
        }
        else{
            header("location: login.php");
            exit();
        }
    }
    
    if($requestUri==="/login.php" ){
        if(isset($_SESSION["userid"])){
            if($_SESSION["role"]!=="admin"){
                header("location: adminhome.php");
                exit();
            }
            else{
                header("location: staffhome.php");
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Attendance Portal</title>

        <link href="src/css/site.css" rel="stylesheet">
        <link href="src/css/bootstrap/bootstrap.css" rel="stylesheet">
        <link href="src/css/header.css" rel="stylesheet">
        <link href="src/css/sticky-footer.css" rel="stylesheet">
    </head>
    <body>
    <div class="container-fluid"> 
        <div class="row">
            <div class="col">
                <?php include "navbar.php" ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php include "sidemenu.php" ?>
            </div>
            <div class="col-10">
                <div class="maindiv">