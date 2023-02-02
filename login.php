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

    <title>Login - <?php echo $siteName; ?></title>
  </head>
<body>
<?php
    // Login Code Starting
    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $encPassword = md5($password);

        $query = "SELECT * FROM `users` WHERE email = '$email'";
        $runQuery = mysqli_query($conn, $query);

        $countResults = mysqli_num_rows($runQuery);
        if($countResults == 0){
             $error = "User Email doesn't Exist.".mysqli_error($conn);
         }
        else{
            $row = mysqli_fetch_array($runQuery);
            $dbId = $row['id'];
            $dbFirstName = $row['first_name'];
            $dbLastName = $row['last_name'];
            $dbEmail = $row['email'];
            $dbPassword = $row['password'];
            $dbRole = $row['role'];
            $dbStatus = $row['status'];
                
            if($encPassword == $dbPassword && $dbStatus == 1){
                if($dbRole == 1){
                    $_SESSION["logged_in"] = 1;
                    $_SESSION['id'] = $dbId;
                    $_SESSION['first_name'] = $dbFirstName;
                    $_SESSION['last_name'] = $dbLastName;
                    $_SESSION['email'] = $dbEmail;
                    $_SESSION['role'] = $dbRole;
                    $_SESSION['status'] = $dbStatus;
                ?>
                    <script>
                        window.location.href="admin/index.php";
                    </script>
                <?php
                }
                elseif($dbRole == 2){
                    $_SESSION["logged_in"] = 1;
                    $_SESSION['id'] = $dbId;
                    $_SESSION['first_name'] = $dbFirstName;
                    $_SESSION['last_name'] = $dbLastName;
                    $_SESSION['email'] = $dbEmail;
                    $_SESSION['role'] = $dbRole;
                    $_SESSION['status'] = $dbStatus;
                ?>
                    <script>
                        window.location.href="member/index.php";
                    </script>
                <?php
                }
            }  
            else{
                $error = "Invalid Password or Inactive User";
            }
        }        
    }
    // Login Code Starting
    
    // Activate User Code Starting
    if(isset($_REQUEST['activate_user'])){
        $userId = $_REQUEST['activate_user'];
        $uId = base64_decode($userId);
        
        $query = "SELECT * FROM `users` WHERE id = '$uId'";
        $runQuery = mysqli_query($conn, $query);
          if(mysqli_num_rows($runQuery) >0 ){
              $row = mysqli_fetch_array($runQuery);
              $createdTime = $row['created_at'];
          
              $curTime  = time();
              $validateTime = $curTime + 86400;
          
              if($validateTime >= $createdTime){
                $updUserQuery = "UPDATE `users` SET `status` = '1' WHERE `users`.`id` = '$uId'";
                $runQuery1 = mysqli_query($conn, $updUserQuery);
                    if($runQuery1){
                        $message = "Congratulation Your account has been activated successfully.";
                    }
                    else{
                        $error = "Oops! Something Went Wrong.";
                    }
              }
              else{
                        $error = "Oops! Verification Link is Expired.";
                    }
                }
            }
    // Activate User Code Ending  
    
    ?>
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-12">
                <img src="assets/img/logo.png" alt="Logo" width="200">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 40rem;">
                <div class="card-header bg-clr txt-clr">Login Form</div>
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
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <div class="col-md-12">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" required>
                  </div>
                </div>
            </div> <br>
            <div class="row">
                <div class="col-md-12">
                   <button class="btn btn-custom txt-clr btn-block" type="submit" name="login_btn">LOGIN</button>  
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-md-12">
                    <a href="register.php"> Don't have an account? </a>  |  <a href="forget-password.php"> Forget Password? </a>
                </div>
            </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>