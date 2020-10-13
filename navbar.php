
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <ul class="nav justify-content-end">
          <?php
            if(isset($_SESSION["userid"])){
              echo "<li class='nav-item '>";
              echo "<a class='nav-link '> ".$_SESSION["name"]." </a>";
              echo "</li>";
              echo "<li class='nav-item '>";
              echo "<a class='nav-link' href='includes/logout.inc.php'> Logout</a>";
              echo "</li>";
            }
            else{
              echo "<a class='nav-link' href='login.php'> Admin Login</a>";
              echo "<a class='nav-link' href='stafflogin.php'>Staff Login</a>";
            }
          ?>
          </ul>
    </nav>