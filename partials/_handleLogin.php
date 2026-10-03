<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
       if(password_verify($password,$row['user_pass'])){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_email'] =$row['user_email'];
        header("location: ../index.php?show=logged_in");
       }
       else{
        header("location: ../index.php?show=wrong_pass");
       }
    }
    else{
        header("location: ../index.php?show=wrong_email");
       }
}
?>