<?php
include_once dirname(__DIR__, 1) . '/controller/config/settings.php';
if (empty($_SESSION['logged_in']) && empty($_SESSION['role'])) {
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

    <title>Login - <?= $siteName ?></title>
</head>

<body>
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
                    <form id="ControllerLogin" method="post">
                        <div class="row">
                            <div class="col-12 contenedor-alert">
                                <?
                                if ($idUserActivateAccount) {
                                    include_once dirname(__DIR__, 1) . '/controller/ControllerLogin.php';
                                    $ControllerLogin->activateAccount($idUserActivateAccount);
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="email">E-mail</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <li class="fas fa-envelope"></li>
                                        </span>
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
                                <button class="btn btn-custom txt-clr btn-block btnLogin" type="button">LOGIN</button>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-12">
                                <a href="/register"> Don't have an account? </a> | <a href="/forget-password"> Forget
                                    Password? </a>
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
    <script src="assets/modules/login.js"></script>
</body>

</html>
<?
} else {
    include '/';
}
?>