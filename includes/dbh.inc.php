<?php

$serverName = "localhost";
$dbuserName = "root";
$dbpassword="";
$DatabaseName ="staff_mgmt_db";
$conn = mysqli_connect($serverName,$dbuserName ,$dbpassword,$DatabaseName);
if(!$conn){
    die("Connection Failed". mysqli_connect_error());
}