<?php
    include_once 'config/db.php';
    include_once 'config/settings.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap, Font Awesome, Custom CSS, Customize Bootstrap, Google Font -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom-bs.css">
    <link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">

    <title>Home - <?php echo $siteName; ?></title>
  </head>
<body>

<!-- Container Starting -->
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-12">
            <img src="assets/img/logo.png" alt="Logo" width="200">
        </div>
    </div>
    <br>
     <div class="row">
         <div class="col-md-6">
             <div class="form-group">
                <a href="login.php" class="btn btn-green btn-lg btn-block">LOGIN</a>
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-group">
                <a href="register.php" class="btn btn-green btn-lg btn-block">REGISTER</a>
             </div>
         </div>
     </div>
</div>
<!-- Container Ending -->
     
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>