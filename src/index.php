<?php
    require_once("config.php");
    require_once("./classes/User.php");
    require_once("./classes/signin.php");
    require_once("./classes/helper.php");

    if(isset($_POST['action'])){
        $action=$_POST['action'];
        $userEmail=$_POST['userEmail'];
        $userPassword=$_POST['userPassword'];
        switch($action){
            case "signIn":
                Helper::signIn($userEmail,$userPassword);
                break;
        }
    }


?>

<!doctype html>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./assets/css/login.css" rel="stylesheet">
    <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    </head>

    <body class="text-center">
    
        <main class="form-signin">
          <form method="POST">
            <i class="bi bi-person-circle mb-4 login-icon"></i>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        
            <div class="form-floating mt-3">
              <input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
              <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password">
              <label for="userPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" name="action" value="signIn" type="submit">Sign in</button>
            <div class="mb-3 mt-4">
                <label>
                 Don't have an account <a href="signup.php">sign up</a>
                </label>
              </div>
              <a href="#">Forgot password</a>
          </form>
        </main>
        
    </body>
  

</html>