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

    <title>Register - <?php echo $siteName; ?></title>
  </head>
    <body>
     <?php 
        // Variables
        $num1 = rand(1, 10);
        $num2 = rand(1, 5);
        $sum = $num1 + $num2;
        $oldSum = $_SESSION['sum'];
        $_SESSION['sum'] = $sum;
        
        // User Register Code Starting
        if(isset($_POST['register_btn'])){
            $firstName = $_POST['first-name'];
            $lastName = $_POST['last-name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];
            $encPassword = md5($password);
            $humanVerifier = $_POST['human-verifier'];
            $userRole = 2;
            $status = 0;
            $createdAt = $_SERVER['REQUEST_TIME'];
            
            $query = "SELECT * FROM `users` WHERE email = '$email'";
            $runQuery = mysqli_query($conn, $query);
            $countResults = mysqli_num_rows($runQuery);
                if($countResults >= 1){
                    $error = "This Email is already Registered";
                }
         
                elseif($password != $confirmPassword){
                    $error = "Password & Confirm Password did not match.";
                }
                elseif($oldSum != $humanVerifier){
                    $error = "Incorrect Human Verifier";
                }
                else{
                    $query = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `created_at`) VALUES (NULL, '".strtolower($firstName)."', '".strtolower($lastName)."', '$email', '$encPassword', '$userRole', '$status', '$createdAt')";
                     
                    $runQuery = mysqli_query($conn, $query);
                    $lastId = mysqli_insert_id($conn);
                    $uid = base64_encode($lastId);
                    
                     if($runQuery){
                         $activationLink = "http://$_SERVER[HTTP_HOST]/"."login.php?activate_user=".$uid;
                         
                         $to = $email;
                         $subject = "User Registration Activation Email";
                         $msg = "Hello ".$firstName.","."\r\nThanks for Signing Up. Your Account has been Created Successfully. Please Verify your Email Address by Clicking the Following Link within 24 Hours.\r\n".$activationLink."\r\n\r\nBest Regards\r\n".$siteName;
                         
                         $noReplyEmail = $_SESSION['noreply'];
                         $headers = "From: $noReplyEmail"."\r\n";
                         
                         if(mail($to, $subject, $msg, $headers)){
                             $message = "We have sent you verification link. Please check your email Inbox/Junk Folder.";
                        }
                        else{
                            $error = "Oops! Something Went Wrong.";
                        }
                    }
                }
            }
        // User Register Code Ending
    ?>
    
    <!--Container Starting -->
    <div class="container mt-5">
       <div class="row text-center">
           <div class="col-md-12">
               <img src="assets/img/logo.png" alt="Logo" width="200">
           </div>
       </div>
       <br>
       <div class="d-flex justify-content-center">
        <div class="card" style="width: 40rem;">
            <div class="card-header bg-clr txt-clr">Registration Form</div>
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
                   <div class="col-md-6">
                      <label for="">First Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="first-name" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="email">Last Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="last-name" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="email">E-mail</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><li class="fas fa-envelope"></li></span>
                        </div>
                        <input type="email" class="form-control" name="email" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="password">Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="confirm_password">Confirm Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="confirm-password" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <label for="password">Human Verifier : What is <?php echo $num1 . ' + ' . $num2 . '?';?></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                        </div>
                        <input type="number" min="0" class="form-control" name="human-verifier" required>
                      </div>
                    </div>
                </div> <br>
                    <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-custom txt-clr btn-block" name="register_btn">REGISTER</button>  
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-md-12">
                            <a href="login.php"> Already have an account? </a>  |  <a href="login.php"> Login </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       </div>
    </div>
    <!--Container Ending -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>