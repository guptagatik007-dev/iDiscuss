<?php
$showError = false;
$showAlert=false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/_dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $exists = false;


  $sql = "select * from all_users where username='$username'";
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  if($num == 0){
    $exists = false;
  }
  else{
    $exists = true;
  }


  if(($password == $cpassword) && ($exists == false)){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `all_users` ( `Username`, `Password`, `Dt`) VALUES ('$username', '$hash', current_timestamp());";
    $result = mysqli_query($conn,$sql);
    $showAlert = true;
  }
  else if($exists){
    $showError=true;
    $error = "Username already exists";
  }
  else{
    $showError=true;
    $error = "passwords do not match";
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SignUp</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
  <?php require 'partials/_nav.php'?>
  <?php 
  if ($showAlert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your account is created you can login
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
          
          }
  
          
  if ($showError){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Warning!</strong> $error
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
          
          }        
  
  ?>
  
  <div class="container my-4">
    <h1>Signup to our website</h1>
    <form action="/LoginSystem/signup.php" method="post">
      <div class="mb-3 mx-10" >
        <label for="username" class="form-label">Username</label>
        <input type="text" maxlength="40" class="form-control" id="username" aria-describedby="emailHelp" name="username">

        <div class="mb-3 ">
          <label for="password" class="form-label">Password</label>
          <input type="password" maxlength="30" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
          <label for="cpassword" class="form-label">Confirm Password</label>
          <input type="password" maxlength="20" class="form-control" id="cpassoerd" name="cpassword">
        </div>
        <div id="emailHelp" class="form-text">Make sure you type the same password</div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>