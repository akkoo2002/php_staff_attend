<?php include "header.php"  ?>
    <link href="src/css/signin.css" rel="stylesheet">
    <form action="includes/applyattendence.inc.php" class="form-signin" method="post">
    </form>
    <h1 class="h3 mb-3 font-weight-normal">Confirm Attendence</h1>
    <table class="table table-striped table-dark" style="width:100%">
  <thead>
    <tr >
      <th scope="col" class="col-1">Date</th>
      <th scope="col" class="col-1">Name</th>
      <th scope="col" class="col-1">Time</th>
      <th scope="col" class="col-6">Visual</th>
      <th scope="col" class="col-1">Present</th>
      <th scope="col" class="col-1">Half Day</th>
      <th scope="col" class="col-1">Absent</th>
    </tr>
  </thead>
  <tbody>
    <?php
        require_once "includes/dbh.inc.php";
        require_once "includes/functions.inc.php";
        $records = getAllPendingAttendance($conn);
        foreach($records as $rec){
            $date = strtotime($rec['att_time'])+((60*60)*5.5);  
            $hour =floatval( number_format(date("H",$date)));
            $minute = floatval(number_format(date("m",$date)));
            $time = $hour+($minute/60);
            if($time<10)$time=10;
            if($time>20)$time=20;
            $time = 20-$time;
            $time = $time*10;
            
            echo "<tr staffid='".$rec["id"]."' att_date='".$rec["att_date"]."'>";
            echo "    <th scope='row'>".$rec['att_date']."</th>";
            echo "    <td>".$rec['name']."</td>";
            echo "    <td>".$hour.":".$minute."</td>";


            echo "    <td><div class='progress'>";
            if($time>50){
            echo "    <div class='progress-bar bg-success' role='progressbar' style='width: ".$time."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>";
            }
            else if($time>30){
                echo "    <div class='progress-bar bg-warning' role='progressbar' style='width: ".$time."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>";
            }
            else{
                echo "    <div class='progress-bar bg-danger' role='progressbar' style='width: ".$time."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>";
            }
            echo "    </div></td>";
            
            echo "    <td att_state='P'>"."<button type='button' class='btn btn-success'>Present</button>"."</td>";
            echo "    <td att_state='H'>"."<button type='button' class='btn btn-warning'>HalfDay</button>"."</td>";
            echo "    <td att_state='A'>"."<button type='button' class='btn btn-danger'>Absent</button>"."</td>";
            echo "</tr>";

            // echo($rec['att_date'].' ');
            // echo($rec['name'].' ');
            // echo " hour ".$time;
            // echo "   Time ".$hour;
            // echo ":".$minute;
            // echo "<br>";
        }
    ?>
    </tbody>
  </table>
  <script src='src/js/jquery/jquery3.js'></script>
  <script type="text/javascript">
    $(document).ready(function(){
      
      $('button').click(function(event){
        var staffid = $( event.target ).parent().parent().attr("staffid");
        var att_date = $( event.target ).parent().parent().attr("att_date");
        var att_state = $( event.target ).parent().attr("att_state");
        
        var person = {
          staffid: staffid,
          att_date:att_date,
          att_state:att_state
        }

        $.ajax({
            url: 'includes/saveattendance.inc.php',
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                alert("Success\n"+JSON.stringify(data));
            },
            error:function(error){
                alert("Some Error\n"+JSON.stringify(error));
            },
            data: JSON.stringify(person)
        });

      });
    });
  </script>
<?php include "footer.php"  ?>