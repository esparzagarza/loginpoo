<?
if (!empty($_SESSION['logged_in']) && !empty($_SESSION['role']) && $_SESSION['role'] == 1) {
    include dirname(__DIR__, 2) . '/controller/ControllerUser.php';
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
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="table-responsive m-b-40">
                                    <?
                                        //  --- Table users
                                        $ControllerLogin->tableUsers();
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

    <div class="modal" id="modalEditUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="1">Admin</option>
                                <option value="2">Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="0">In Active</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <input type="hidden" name="user-id">
                        <div>
                            <button type="button" class="btn btn-lg btn-info btn-block">
                                <i class="fas fa-exchange-alt fa-lg"></i>&nbsp;
                                <span>Update User</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Required Js Files Starting-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/animsition.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/modules/user.js"></script>
    <!--Required Js Files Ending-->

</body>

</html>
<?
} else {
    include 'controller/logout.php';
}
?>