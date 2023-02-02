<?
if (!empty($_SESSION['logged_in']) && !empty($_SESSION['role']) && $_SESSION['role'] == 2) {
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
                                <div class="card">
                                    <div class="card-header">Change Password</div>
                                    <div class="card-body">
                                        <form id="frmChangePassword" method="post">
                                            <div class="row">
                                                <div class="col-12 contenedor-alert"></div>
                                            </div>
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

                                            <input type="hidden" name="user-id" value="<?= $idUserAccount ?>">

                                            <div>
                                                <button type="button"
                                                    class="btn btn-lg btn-info btn-block btnChangePassword">
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
    <script src="assets/modules/login.js"></script>
    <!--Required Js Files Ending-->

</body>

</html>
<?
} else {
    include 'controller/logout.php';
}
?>