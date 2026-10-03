<?php
session_start();
include '_signupmodal.php';
include '_loginmodal.php';
include '_notLoggedinModal.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">iDiscuss</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu">

                    <?php

                    # getting all rows
                    $sql = 'SELECT * FROM `categories`';
                    $result = mysqli_query($conn,$sql);

                    # getting data from each row and setting varialbles
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['category_id'];
                        $cat_name = $row['category_name'];
          
                        # putting the variables into the cards
                        echo '<li><a class="dropdown-item" href="threads_list.php?cat_id='.$cat_id.'">'.$cat_name.'</a></li>';
                    }
                    ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Contact</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="search.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_for" id="search_for">
                <button class="btn btn-success" type="submit">Search</button>
                <?php
               
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1){
                        echo '<a href="partials/_logout.php"><button type="button" class="btn btn-outline-success ms-4"> Logout</button></a>';
                }
                else{
                    echo '<button type="button" class="btn btn-outline-success ms-4" data-bs-toggle="modal" data-bs-target="#loginModal"> Login</button>
                    <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal"> Signup</button>';
                }
                
                
                ?>
                

            </form>
        </div>
    </div>
</nav>
