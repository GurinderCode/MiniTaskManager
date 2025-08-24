<?php
$showMsg = false;
$showError = false;  
$exists = false; 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 include 'partials/_dbconnect.php';
 $name = $_POST["forename"];
 $username = $_POST["username"];
 $password = $_POST["password"];
 $cpassword = $_POST["cpassword"];
 $existUser = $db->users->findOne([
    'username' => $username,
  ]);

 if ($existUser) {
  $exists = true;
 }elseif($password == $cpassword && $exists == false){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $usersCollection = $db->users;
    $newUser = [
        'forename' => $name,
        'username' => $username,
        'password' => $hash, 
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];
 $insertResult = $usersCollection->insertOne($newUser);
    if ($insertResult->getInsertedCount() === 1) {
       $showMsg = true;
    } 
    } else {
      $showError = true;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SignUp</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  </head>
<body>

   <?php require 'partials/_nav.php' ?>
   <?php
       if ($showMsg) echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your account is created and you can now login.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       if ($showError) echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Passwords do not match.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
       </div>";
       if ($exists) echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Username already exists.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    ?>
<div class="signup_container">
  <h1 class = "text-center">SignUp to a Mini Task Manager</h1>
  <form action="/MiniTaskManager/signup.php" method="post">
    <div class="mb-3">
      <label for="forename" class="form-label">Name</label>
       <input type="text" class="form-control" id="forename" name="forename" aria-describedby="emailHelp">
     </div>
     <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
     </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
       <div class="mb-3">
         <label for="cpassword" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
          <div id="emailHelp" class="form-text">Make sure to type the same password</div>
       </div> 
        <button type="submit" class="btn btn-primary">SignUp</button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>