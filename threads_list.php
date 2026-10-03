<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
        }

        .cnt {
            background-color: rgb(226, 229, 241);
            max-width: 120vh;
            min-height: 25vh;
            margin: auto;
            border-radius: 10px;
            padding: 2%;
        }

        .forum_heading,
        .button_thread,
        .forum_desc {
            margin: 10px;
            max-width: 95%;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>

    <!-- getting navbar and connecting to database -->
    <?php 
        require 'partials/_dbconnect.php' ;
        require 'partials/_nav.php' ;
        require 'partials/_new_question_modal.php';
        ?>

    <!-- getting data from table and setting forum category,desc  -->
    <?php 
        $id = $_GET['cat_id'];
        $sql = 'SELECT * FROM `categories` WHERE `category_id` = '.$id.';';
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
            $cat_name = $row['category_name'];
            $desc = $row['category_description'];
        }

        // setting modal and checking loggedin 
        $loggedin = false;
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1){
            $loggedin = true;
            $modal = "newQuestionModal";
        }
        else{
            $modal = "notLoggedinModal";
        }
        

        // Adding the thread into table 
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST' && $loggedin == true){
            $thread_title = $_POST['thread_title'];
            $thread_desc = $_POST['thread_desc'];
            $user_id = $_SESSION['user_id'];

            $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_user_id`, `thread_cat_id`, `thread_time`)
            VALUES ( '$thread_title' , '$thread_desc', '$user_id', '$id', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            $showAlert = true;
        }
        if ($showAlert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Success!</strong> Your thread is created! please wait for community to responsd
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div> ";
                  
                  }
          
    ?>

    <!-- Category heading and desc container  -->
    <div class="container cnt my-4">
        <h1 class="forum_heading">Welcome to
            <?php echo $cat_name; ?> Form
        </h1>
        <p class="forum_desc">
            <?php echo $desc; ?>
        </p>
        <hr width="50%">
        <p class="forum_desc">This is where you can share your thoughts.
            Warn About Adult Content
            Do not spam.
            Do Not Post About Commercial Products.
            Do Not Create Multiple Accounts (Sockpuppets).
        </p>
        <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#<?php echo $modal;?>">Start a discussion </button>
    </div>

    <!-- Post  container -->
    <div class="container my-5" style=" max-width:120vh; min-height:40vh">
        <h1>Browse Questions</h1>

        <!-- forum questions  -->
        <?php

            $sql = 'SELECT * FROM `threads` WHERE thread_cat_id = '.$id.'';
            $result = mysqli_query($conn,$sql);
            $noResult = true;

            while($row = mysqli_fetch_assoc($result)){

                $noResult = false;
                $thread_id = $row['thread_id'];
                $thread_title = $row['thread_title'];
                $thread_desc = $row['thread_desc'];

                $thread_title = str_replace("<","&lt",$thread_title);
                $thread_title = str_replace("<","&gt",$thread_title);

                $thread_desc = str_replace("<","&lt",$thread_desc);
                $thread_desc = str_replace("<","&gt",$thread_desc);
                $user_id = $row['thread_user_id'];

                // just temporarily need to be changed after completely setting up 
                if($user_id == 0){
                    $user_id = 1;
                }

                $sql2 = 'SELECT user_email FROM `users` WHERE user_id = '.$user_id.'';
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $user = $row2['user_email'];

                echo '
                <div class="container">
                    <img class="mx-2 my-2" src="static/default_user.png" width="50px" style="float:left;" alt="">
                    <h5><a href="thread.php?thread_id='. $thread_id. '" class="text-dark">'.$thread_title.'</a></h5>
                    <h6>By: '.$user.'</h6>
                    <p>'.$thread_desc.'</p>
                </div>';

            }
            if($noResult){
                echo'<div class="container cnt">
                <h2>No results found</h2>
                <h5>Be the first one to ask</h5>
                <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#'.$modal.'">Start here </button>
            </div>';

            }
        ?>

    </div>
    </div>




    <?php require 'partials/_footer.php' ;?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>