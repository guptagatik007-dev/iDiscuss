<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_dbconnect.php";
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 0){
        if($password==$cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `user_email`, `user_password`, `user_time`)
             VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql); 
            if($result){
                header("location: index.php?show=success");
                exit();
            }
        }
        else{
            header("location: index.php?show=passwords_unmatch");
        }
    }
    else{
        header("location: index.php?show=user_exists");
    }
    


}
?>