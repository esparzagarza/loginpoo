<?php
    session_start();
    include_once '../config/db.php';
    // Check If User Logged In
    if(!isset($_SESSION['logged_in'])){
        header('Location: ../logout.php');
    }
    // Check If User Role is Admin
    elseif(isset($_SESSION['role']) && $_SESSION['role'] != '1'){
        header('Location: ../logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    
    <!-- Title Page-->
    <title>Users</title>

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
        // Delete User Code Starting
        if(isset($_GET['delu'])){
            $userId = base64_decode($_GET['delu']);
            $query = "DELETE FROM `users` WHERE `users`.`id` = '$userId'";
            $runQuery = mysqli_query($conn, $query);
            
            if($runQuery){
                $message = "User Deleted Successfully";
            }
            
        }
        // Delete User Code Ending
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Users</h2>
                                    
                                </div>
                            </div>
                        </div>
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
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <div class="">'.$message.'</div> 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
                        }
                    ?>   
                        
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="table-responsive m-b-40">
                                   <?php
                                    $query = "SELECT * FROM `users`";
                                    $runQuery = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($runQuery) > 0){
                                            
                                    
                                    ?>
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            $sr = 1;
                                           while($row = mysqli_fetch_array($runQuery)){
                                                $id = $row['id'];
                                                $email = $row['email'];
                                                $password = $row['password'];
                                                $role = $row['role'];
                                                $status = $row['status'];
                                         
                                    ?>
                                            <tr>
                                                <td><?php if(isset($sr)){echo $sr; }?></td>
                                                <td><?php if(isset($email)){echo $email; }?></td>
                                                <td>
                                                   <?php if(isset($role) && $role == 1){
                                                        echo '<span class="badge badge-info">Admin</span>'; 
                                                    }
                                                    else{
                                                        echo '<span class="badge badge-warning">Member</span>'; 
                                                    }?>
                                                </td>
                                                <td>
                                                    <?php if(isset($status) && $status == 1){
                                                        echo '<span class="badge badge-success">Active</span>'; 
                                                    }
                                                    else{
                                                        echo '<span class="badge badge-danger">In Active</span>'; 
                                                    }?>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        
                                                        <a href="edit-user.php?editu=<?php if(isset($id)){echo base64_encode($id); }?>" title="Edit">
                                                            <i class="zmdi zmdi-edit zmdi-hc-lg"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>    
                                                       <div class="table-data-feature">       
                                                        <a href="users.php?delu=<?php if(isset($id)){echo base64_encode($id); }?>" title="Delete">
                                                            <i class="zmdi zmdi-delete zmdi-hc-lg"></i>
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                $sr++;
                                                    }
                                               
                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <?php
                                     }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php include_once 'inc/footer.php'; ?>
                    </div>
                </div>
            </div>
            <!--Main Contents Ending-->
        </div>
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