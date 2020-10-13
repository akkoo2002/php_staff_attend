<?php include "header.php"  ?>
    <link href="src/css/signin.css" rel="stylesheet">
    <form action="includes/stafflogin.inc.php" class="form-signin" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Staff Login</h1>

        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="UserName" required="" autofocus="">

        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name=password class="form-control" placeholder="Password" required="">

        <button class="btn btn-lg btn-primary btn-block" type="submit" name=submit>Sign in</button>
    </form>
<?php include "footer.php"  ?>