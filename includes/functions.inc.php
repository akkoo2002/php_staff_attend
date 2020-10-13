<?php
function adminExists($conn,$username){
    $sql =  "select * from admin_master where username=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php:error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function loginAdmin($conn,$username,$password){
  $adminExists = adminExists($conn,$username);
  if($adminExists===false){
    header("location: ../login.php?error=loginfailed");
    exit();
  }
  if($adminExists["password"]!==$password){
    header("location: ../login.php?error=loginfailed");
    exit();
  }
  else{
      session_start();
      $_SESSION["userid"]=$adminExists["id"];
      $_SESSION["username"]=$adminExists["username"];
      $_SESSION["name"]=$adminExists["name"];
      $_SESSION["role"]="admin";
      header("location: ../adminhome.php");
      exit();
  }
}
function staffExists($conn,$username){
    $sql =  "select * from staff_master where username=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php:error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function loginStaff($conn,$username,$password){
    $staffExists = staffExists($conn,$username);
    if($staffExists===false){
      header("location: ../stafflogin.php?error=loginfaileduser");
      exit();
    }
    if($staffExists["password"]!==$password){
      header("location: ../stafflogin.php?error=loginfailedpass");
      exit();
    }
    else{
        session_start();
        $_SESSION["userid"]=$staffExists["id"];
        $_SESSION["username"]=$staffExists["username"];
        $_SESSION["name"]=$staffExists["name"];
        $_SESSION["role"]="staff";
        header("location: ../staffhome.php");
        exit();
    }
  }
function createStaff($conn,$name,$username,$password){
    $sql =  "INSERT INTO staff_master (username, password, name) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss",$username,$password,$name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../addstaff.php?success=staffadded");
    exit();
}

function checkAttenddence($conn,$staffid,$date){
    $sql =  "select * from staff_attendence where staff_id=? and att_date=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$staffid,$date);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function applyAttendence($conn,$staffid,$date){
    
    $sql =  "INSERT INTO staff_attendence (staff_id, att_date,att_state) VALUES (?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php?error=stmtfailed");
        exit();
    }
    $att_state = "PENDING";
    mysqli_stmt_bind_param($stmt,"sss",$staffid,$date,$att_state);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../applyattendence.php?success=attapplieda");
    exit();
}

function getAllPendingAttendance($conn){
    
    $sql =  "SELECT * FROM staff_attendence left outer join staff_master on staff_master.id = staff_attendence.staff_id where staff_attendence.att_state='PENDING' order by staff_id;";//  
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $resultArray=array();
    while($row = mysqli_fetch_assoc($resultData)){
        //$row['att_time']=date('H', strtotime($row['att_time']))
        array_push($resultArray,$row);
    }
    mysqli_stmt_close($stmt);
    return $resultArray;
}

function saveAttendence($conn,$att_date,$staffid,$att_state){
    $sql =  "update staff_attendence set att_state=? where att_date=? and  staff_id=?;";//
    // $sql =  "update staff_attendence set att_state=? where att_date = ?;";//
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        return false;
        exit();
    }
    // $att_date = "2020-10-11";
    // mysqli_stmt_bind_param($stmt,"ss",$att_state,$att_date);
    mysqli_stmt_bind_param($stmt,"sss",$att_state,$att_date,$staffid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}

function getAttendanceReport($conn,$date){
    $year = floatval(date("Y",$date));
    $month = floatval(date("m",$date));
    $day = 1;
    $startDate = strtotime($year.'-'.$month.'-'.$day);
    $endDate = strtotime($year.'-'.($month+1).'-'.$day);

     $sql = '    select staff_id , name'; 
     $sql =$sql.',count(case when att_state ="A"  then 1 end) as a_count ';
     $sql =$sql. ',count(case when att_state ="P" then 1 end) as p_count ';
     $sql =$sql.  ',count(case when att_state ="H" then 1 end) as h_count ';
     $sql =$sql. ',count(distinct att_date) as t_count ';
     $sql =$sql.' from staff_attendence ';
     $sql =$sql.' left outer join staff_master on staff_master.id = staff_attendence.staff_id';
     $sql =$sql.' where att_date between ? and ? ';
     $sql =$sql.'group ' ;
     $sql =$sql.'by staff_id ';

    $startstr = date("Y-m-d",$startDate);
    $endstr = date("Y-m-d",$endDate);
    // echo "start Date ".$startstr;
    // echo "End Date ".$endstr;
    
    
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../error.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$startstr,$endstr);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $resultArray=array();
    while($row = mysqli_fetch_assoc($resultData)){
        //$row['att_time']=date('H', strtotime($row['att_time']))
        array_push($resultArray,$row);
    }
    mysqli_stmt_close($stmt);
    return $resultArray;
}

function countDays($year, $month) {

    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
    $workDays = 0;
    $myTime = mktime(0, 0, 0, $month, 1, $year);
    
    while($daysInMonth > 0)
    {
        $day = date("D", $myTime); // Sun - Sat
        if($day != "Sun" && $day != "Sat")
            $workDays++;
    
        $daysInMonth--;
        $myTime += 86400; // 86,400 seconds = 24 hrs.
    }
    return $workDays;
    



    // $count = 0;
    // $counter = mktime(0, 0, 0, $month, 1, $year);
    // while (date("n", $counter) == $month) {
    //     if (in_array(date("w", $counter), 0) == false) {
    //         $count++;
    //     }
    //     $counter = strtotime("+1 day", $counter);
    // }
    // return $count;
}