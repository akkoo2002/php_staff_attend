<?php include "header.php"  ?>
<h1>Attendance Report</h1>

<table class="table table-striped table-dark" >
  <thead>
    <tr >
      <th scope="col" class="col-1">Name</th>
      <th scope="col" class="col-1">Present</th>
      <th scope="col" class="col-1">Half Day</th>
      <th scope="col" class="col-1">Absent</th>
      <th scope="col" class="col-6">Preview</th>
    </tr>
  </thead>
  <tbody>
    <?php
        require_once "includes/dbh.inc.php";
        require_once "includes/functions.inc.php";

        $timestamp = time()+((60*60)*5.5);
        $year = (date('Y', $timestamp));
        $month = (date('m', $timestamp));
        $workingDays = countDays($year,$month);

        $records = getAttendanceReport($conn,$timestamp);
        foreach($records as $rec){
            $pP = ($rec['p_count']/($workingDays/100));
            $pH = ($rec['h_count']/($workingDays/100));
            // $pH = (($workingDays*$rec['h_count'])/100);
            $pT = 100-($pP+$pH);
            echo "<tr>";
            echo "    <th scope='row'>".$rec['name']."</th>";
            echo "    <td>".$rec['p_count']."</td>";
            echo "    <td>".$rec['h_count']."</td>";
            $notabsent = number_format($rec['p_count']);
            $notabsent =  $notabsent+ number_format($rec['h_count']);
            echo "    <td>".($workingDays-$notabsent)."</td>";
            echo "    <td>";
            echo '  <div class="progress">';
            echo '  <div class="progress-bar bg-success" role="progressbar" style="width: '.$pP.'%" ></div>';
            echo '  <div class="progress-bar bg-warning" role="progressbar" style="width: '.$pH.'%"></div>';
            echo '  <div class="progress-bar bg-danger" role="progressbar" style="width: '.$pT.'%"></div>';
            echo "  </div></td></tr>";
        }
    ?>
    </tbody>
  </table>
<?php include "footer.php"  ?>