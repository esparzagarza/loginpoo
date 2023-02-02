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

    <title>Forget Password - <?php echo $siteName; ?></title>
</head>
  <body>
    <?php
        // Reset Password Code Starting
        if(isset($_POST['reset_pwd_btn'])){
              $email = $_POST['email'];

              $query = "SELECT * FROM `users` WHERE email = '$email'";
              $runQuery = mysqli_query($conn, $query);
              $countResults = mysqli_num_rows($runQuery);
              if($countResults == 1){
                  $row = mysqli_fetch_array($runQuery);
                  $id = base64_encode($row['id']);
                  $firstName = $row['first_name'];
                  $email = $row['email'];

                  $activationLink = "http://$_SERVER[HTTP_HOST]"."/change-password.php?change_pwd=".$id;

                    $to = $email;
                    $subject = "User Registration Activation Email";

                    $msg = "Hello ".$firstName.","."\r\nWe have received your request to change your password. Please verify your email address and change password by clicking the following link.\r\n".$activationLink."\r\n\r\nBest Regards\r\n".$siteName;
                  
                    $noReplyEmail = $_SESSION['noreply'];
                    $headers = "From: $noReplyEmail" . "\r\n";

                    if(mail($to, $subject, $msg, $headers)){
                        $message = "We have sent you Password Reset Link. Please check your Email Inbox/Junk Folder.";
                      }
                     else{
                         $error = "Oops! Server Error: Mail Sent Failed.";
                    }
              }
              else{
                  $error = "Email doesn't Exist!";
              }
          }
        // Reset Password Code Ending
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
            <div class="card-header bg-clr txt-clr">Forget Password Form</div>
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
                  <label for="email">E-mail</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <li class="fas fa-envelope"></li> </span>
                    </div>
                    <input type="email" name="email" class="form-control" required>
                  </div>
                </div>
                
            </div> <br>
            <div class="row">
                <div class="col-md-12">
                   <button class="btn btn-custom txt-clr btn-block" type="submit" name="reset_pwd_btn">RESET PASSWORD
                   </button>  
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