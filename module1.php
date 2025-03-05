<?php
session_start();
$username = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Module Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('./images/mod1.png'); /* Add your image path here */
      background-size: cover; /* Ensure the background covers the full page */
      background-position: center; /* Center the background image */
      height: 100vh; /* Full viewport height */
      margin: 0;
    }
    .content-box {
      background-color: rgba(32, 201, 151, 0.5); /* Add transparency to the content box */
      color: black;
      padding: 5px;
      border: 3px solid black;
      margin-top: 10px;
      position: absolute;
      right: 20px;
      width: auto;
    }
    .logout-btn {
      position: absolute;
      top: 20px;
      left: 20px;
    }
  </style>
</head>
<body>
  <div class="container text-left">

  <div class="btn-group dropstart" style="position:absolute; top: 20px; right: 40px;">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-image: url('images/LOGO_Icon.png'); background-size: 100% 100%; background-position: center; background-repeat: no-repeat; width: 80px; height: 80px; border: none;">
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Forward</a></li>
    <li><a class="dropdown-item" href="#">Previous</a></li>
  </ul>
</div>



  <a href="selection.php" class="logout-btn btn btn-danger">Back</a>
    <div class="content-box mt-2" style="top:20%">
      <h4>Owned by CEO with C-Suite</h4>
    </div>
    <div class="content-box mt-2" style="top:30% ">
      <h4>Deployed 1 page plans for executive</h4>
    </div>
    <div class="content-box mt-2" style="top:40%">
      <h4>Empowerment & Support</h4>
    </div>
    <div class="content-box mt-2 " style="top:50%">
      <h4>SPEED in Communication</h4>
    </div>
    <div class="content-box mt-2" style="top:60%">
      <h4>Ability & Efficiency</h4>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

