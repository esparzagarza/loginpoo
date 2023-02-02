<?php
    session_start();
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

    <title>Change Password - <?php echo $siteName; ?></title>
</head>
  <body>
   <?php
      // Fetching User Id for Password Changing Code Starting
      if(isset($_GET['change_pwd'])){
          $userId = base64_decode($_GET['change_pwd']);
          $query = "SELECT * FROM `users` WHERE id = '$userId'";
          $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) > 0){
                $row = mysqli_fetch_array($runQuery);
                $id = $row['id'];
                $email = $row['email'];
                $password = $row['password'];
                $role = $row['role'];
                $status = $row['status']; 
            }
        }
      else{
            header("Location: login.php");
        }
      // Fetching User Id for Password Changing Code Ending
      
      // Change Password Code Starting
      if(isset($_POST['change_pwd_btn'])){
          $userId = $_POST['user-id'];
          $pwd = $_POST['pwd'];
          $confirmPwd = $_POST['confirm-pwd'];
          if($pwd != $confirmPwd){
              $error = "Password & Confirm Password did not match.";
          }
          else{
              $pwd = md5($pwd);
              $query = "UPDATE `users` SET `password` = '$pwd' WHERE `users`.`id` = '$userId'";
              $runQuery = mysqli_query($conn, $query);
              if($runQuery){
//                  $message = "Password Updated Successfully!";
                  ?>
                    <script>
                        alert("Password Updated Successfully!");
                        window.location.href = "login.php";
                    </script>
                  <?php
              }
              else{
                  $error = "Oops! Something Went Wrong.";
              }
          }
      }
      // Change Password Code Ending
      ?>
      
    <!--Container Starting-->  
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-12">
                <img src="assets/img/logo.png" alt="Logo" width="200">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
        <div class="card" style="width: 40rem;">
            <div class="card-header bg-clr txt-clr">Change Password Form</div>
            <div class="card-body">
              <?php
                    if(isset($error)){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <div class="">'.$error.'</div> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
                    }

                    if(isset($message)){
                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                  <div class="">'.$message.'</div> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
                    }
                ?>
               <form action="" method="post">
            <div class="row">
                <div class="col-md-12">
                  <label for="">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <li class="fas fa-unlock"></li> </span>
                    </div>
                    <input type="password" name="pwd" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="">Confirm Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <li class="fas fa-unlock"></li> </span>
                    </div>
                    <input type="password" name="confirm-pwd" class="form-control" required>
                  </div>
                </div>
                <input type="hidden" name="user-id" value="<?php if(isset($id)){echo $id; }?>">
                
                
            </div> <br>
            <div class="row">
                <div class="col-md-12">
                   <button class="btn btn-custom txt-clr btn-block" type="submit" name="change_pwd_btn">CHANGE PASSWORD</button>  
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-md-12">
                    <a href="register.php"> Don't have an account? </a>  |  <a href="login.php"> Login </a>
                </div>
            </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    <!--Container Ending-->
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>