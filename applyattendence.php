<?php include "header.php"  ?>
    <link href="src/css/signin.css" rel="stylesheet">
    <?php
        for ($x = -5; $x <= 5; $x++) {
            $timestamp = time()+(60*60*5.5)+((60*60*24)*$x);
            $date = date('Y-m-d', $timestamp);
            echo "  <a class='badge badge-primary' href='applyattendence.php?date=".$date."'>";
            echo date('d-M', $timestamp);
            echo "  </a>";
            // echo "<button type='button' class='btn btn-lg btn-primary form-control' disabled>already Applied</button>";
        }

    ?>
    <form action="includes/applyattendence.inc.php" class="form-signin" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Apply Attendence </h1>
        <?php
            require_once "includes/dbh.inc.php";
            require_once "includes/functions.inc.php";
            $timestamp = time()+((60*60)*5.5);
            $date = date('Y-m-d', $timestamp);
            if(isset($_GET["date"])){
                $date = $_GET["date"];
            }
            echo '<input type="text"  class="form-control" value='.$date.' disabled>';
            echo '<input type="hidden"  class="form-control" name="date" value='.$date.' >';

            if(checkAttenddence($conn,$_SESSION['userid'],$date)!==false){
                echo "<button type='button' class='btn btn-lg btn-primary form-control' disabled>already Applied</button>";
            }
            else{
                echo "<button class='btn btn-lg btn-primary btn-block form-control' type='submit' name=submit>Apply Attendance</button>";
            }
        ?>
    </form>
<?php include "footer.php"  ?>