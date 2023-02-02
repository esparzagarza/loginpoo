<?php
    session_start();
    include_once '../config/db.php';
    // Check If User Logged In
    if(!isset($_SESSION['logged_in'])){
        header('Location: ../logout.php');
    }
    // Check If User Role is Admin
    elseif(isset($_SESSION['role']) && $_SESSION['role'] != '2'){
        header('Location: ../logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    
    <!-- Title Page-->
    <title>Change Password</title>

    <link href="assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="assets/css/all.min.css" rel="stylesheet" media="all">
    <link href="assets/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="assets/css/animsition.min.css" rel="stylesheet" media="all">
    <link href="assets/css/animate.css" rel="stylesheet" media="all">
    <link href="assets/css/theme.css" rel="stylesheet" media="all">
</head>

<body class="animsition">
    <?php
        // Fetch User Id for Change Password Code Starting
        if(isset($_GET['cpwd'])){
            $userId = base64_decode($_GET['cpwd']);
            $query = "SELECT * FROM `users` WHERE id = '$userId'";
            $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) > 0){
                $row = mysqli_fetch_array($runQuery);
                $dbId = $row['id'];
                $dbEmail = $row['email'];
                $dbPassword = $row['password'];
                $dbRole = $row['role'];
                $dbStatus = $row['status'];
                
            }
            
        }
        // Fetch User Id for Change Password Code Ending
        
        // Update Password Code Starting
        if(isset($_POST['upd_pwd_btn'])){
            $userId = $_POST['user-id'];
            $pwd = md5($_POST['pwd']);
            $newPwd = $_POST['new-pwd'];
            $confirmPwd = $_POST['confirm-pwd'];
            
            if($pwd != $dbPassword){
                $error = "Oops! Invalid Old Password.";
            }
            elseif($newPwd != $confirmPwd){
                $error = "Oops! Password & Confirm not match.";
            }
            else{
                $confirmPwd = md5($confirmPwd);
                $query = "UPDATE `users` SET `password` = '$confirmPwd' WHERE `users`.`id` = '$userId'";
                $runQuery = mysqli_query($conn, $query);
            
                if($runQuery){
                    $message = "Password Changed Successfully!";
                }
                else{
                    $error = "Oops! Something Went Wrong.";
                }
                
            }
            
            
            
        }
        // Update Password Code Ending
    ?>

    <!--Page Wrapper Starting-->
    <div class="page-wrapper">
        <!--Mobile Header Starting-->
        <?php include_once 'inc/mobile-header.php'; ?>
        <!--Mobile Header Ending-->

        <!--Sidebar Starting-->
        <?php include_once 'inc/sidebar.php'; ?>
        <!--Sidebar Ending-->

        <!--Page Container Starting-->
        <div class="page-container">
            <!--Main Header Starting-->
            <?php include_once 'inc/main-header.php'; ?>
            <!--Main Header Ending-->

            <!--Main Contents Starting-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col-md-6">
                               <?php
                                    if(isset($message)){
                                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                                  <div class="">'.$message.'</div> 
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>';
                                    }
                                ?>
                                <?php
                                if(isset($error)){
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <div class="">'.$error.'</div> 
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                                }
                            ?>
                                <div class="card">
                                    <div class="card-header">Change Password</div>
                                    <div class="card-body">
                                        
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="" class="control-label mb-1">Old Password</label>
                                                <input name="pwd" type="password" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label mb-1">New Password</label>
                                                <input name="new-pwd" type="password" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="control-label mb-1">Confirm Password</label>
                                                <input name="confirm-pwd" type="password" required class="form-control">
                                            </div>
                                            
                                            <input type="hidden" name="user-id" value="<?php if(isset($userId)){echo $userId; }?>">
                                            
                                            
                                            <div>
                                                <button type="submit" name="upd_pwd_btn" class="btn btn-lg btn-info btn-block">
                                                    <i class="fas fa-exchange-alt fa-lg"></i>&nbsp;
                                                    <span>Update Password</span>
                                                    
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php include_once 'inc/footer.php'; ?>
                    </div>
                </div>
            </div>
            <!--Main Contents Ending-->
        </div>
        <!--Page Container Ending-->
    </div>
    <!--Page Wrapper Ending-->
    
    <!--Required Js Files Starting-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/animsition.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!--Required Js Files Ending-->
    
</body>
</html>