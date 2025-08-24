<?php
$login = false;
$showError = false;   
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $usersCollection = $db->users->findOne([
    'username' => $username,
 ]);

   if ($usersCollection && password_verify($password, $usersCollection['password'])) {
    $login = true;
    session_start(); 
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['forename'] = $usersCollection['forename'];
    header("location: welcome.php");
  } 
  else {
    $showError = true;
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
   <body>

      <?php require 'partials/_nav.php' ?>
      <?php
        if ($login) echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> You are logged in.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        if ($showError) echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Invalid Credentials
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
     ?>
  <div class="signup_container">
      <h1 class = "text-center">Login to a Mini Task Manager</h1>
   <form action="/MiniTaskManager/login.php" method="post">
     <div class="mb-3">
       <label for="username" class="form-label">Username</label>
       <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
     </div>
     <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
     </div>
     <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>