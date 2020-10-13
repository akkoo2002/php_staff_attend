<?php include "header.php"  ?>
    <link href="src/css/signin.css" rel="stylesheet">
    <form action="includes/addstaff.inc.php" class="form-signin" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Add New Staff</h1>

        <label for="name" class="sr-only">Email address</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="" autofocus="">

        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Login ID" required="" autofocus="">
        
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name=password class="form-control" placeholder="Password" required="">

        <label for="confirmpassword" class="sr-only">Confirm Password</label>
        <input type="password" id="confirmpassword" name=confirmpassword class="form-control" placeholder="Confirm Password" required="">

        <button class="btn btn-lg btn-primary btn-block" type="submit" name=submit>Sign in</button>
    </form>
<?php include "footer.php"  ?>