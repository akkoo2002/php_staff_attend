

              <?php
                if(isset($_SESSION["userid"])){
        echo '<nav class="col-md-2 d-none d-md-block bg-light sidebar">';
        echo '<div class="sidebar-sticky">';
        echo '<ul class="nav flex-column"> ';
                  if($_SESSION["role"]==='admin'){
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='adminhome.php'>";
                    echo "    Home";
                    echo "  </a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='addstaff.php'>";
                    echo "    Add New Staff";
                    echo "  </a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='confirmattendance.php'>";
                    echo "    Confirm Attandance";
                    echo "  </a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='attendancereport.php'>";
                    echo "    Attandance Report";
                    echo "  </a>";
                    echo "</li>";
                  }
                  else{
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='staffhome.php'>";
                    echo "    Home";
                    echo "  </a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "  <a class='nav-link active' href='applyattendence.php'>";
                    echo "    Add Attendence";
                    echo "  </a>";
                    echo "</li>";
                  }
                }
                // else{
                //   echo "<li class='nav-item'>";
                //   echo "  <a class='nav-link active' href='index.php'>";
                //   echo "    Home";
                //   echo "  </a>";
                //   echo "</li>";
                // }
                echo '  </ul>';
                echo ' </div>';
                echo '</nav>';
              ?>