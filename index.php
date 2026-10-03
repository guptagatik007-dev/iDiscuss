<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iDiscuss</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <!-- getting navbar and connecting to database -->
  <?php require 'partials/_dbconnect.php' ;
        require 'partials/_nav.php' ;
  ?>
  
  <!-- setting Alert  -->
  <!-- Alerts need to be set using session later  -->
  <?php 
  if(isset($_GET['show'])){
    $alert=$_GET['show'];
    if($alert == "success"){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You have created an account
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else if($alert == "passwords_unmatch"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>Error!</strong> Passwords do not match. Type carefully
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else if($alert == "user_exists"){
      echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
      <strong>warning!</strong> User already exists try another usernmae
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else if($alert == "wrong_pass"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>warning!</strong> Wrong Password Please try again
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else if($alert == "wrong_email"){
      echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
      <strong>warning!</strong> Wrong username Please try again
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    else if($alert == "logged_in"){
      echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
      <strong>Success!</strong> You have been successfully logged in.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    
}
  ?>

  <!-- slider starts here -->
  <div class="container-fluid p-0">
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="static/Image 1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="static/Image 2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="static/Image 3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- slider ends here -->
  

  <!-- heading of forums -->
  <h2 class="text-center my-4">iDiscuss -Categories</h2>
  
  <!-- container containing all the category cards -->
  <div class="container my-3" >
    <div class="row p-0">
      
    <?php

      # getting all rows
        $sql = 'SELECT * FROM `categories`';
        $result = mysqli_query($conn,$sql);

        # getting data from each row and setting varialbles
        while($row = mysqli_fetch_assoc($result)){
          $cat_id = $row['category_id'];
          $cat_name = $row['category_name'];
          $desc = $row['category_description'];
          
          # putting the variables into the cards
          echo '
            <div class="col-md-4 my-4" style=" display: flex; justify-content: center;  align-items: center;">
              <div class="card" style="width: 18rem;">
                <img src="https://picsum.photos/300/200?'. $cat_id. '" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">'.$cat_name.'</h5>
                  <p class="card-text">'. substr($desc,0,90) .'...</p>
                  <a href="threads_list.php?cat_id='. $cat_id. '" class="btn btn-primary">View Threads</a>
                </div>
              </div>
            </div>';
          }
      ?>


    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>

</html>