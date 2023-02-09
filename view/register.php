<?
if (empty($_SESSION['logged_in']) && empty($_SESSION['role'])) {
include_once dirname(__DIR__, 1) . '/controller/config/settings.php';
$num1 = rand(1, 10);
$num2 = rand(1, 5);
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
    <title>Register - <?= $siteName ?></title>
</head>

<body>
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
                    <form id="frmRegister" method="post">
                        <div class="row">
                            <div class="col-12 contenedor-alert"></div>
                        </div>
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
                                        <span class="input-group-text">
                                            <li class="fas fa-envelope"></li>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" required
                                        value="ramcruz1993@gmail.com">
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
                                <label for="password">Human Verifier : What is <?= $num1 . ' + ' . $num2 ?>?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                    </div>
                                    <input type="number" min="0" class="form-control" name="human-verifier" required>
                                </div>
                            </div>
                            <input type="hidden" name="num1" value="<?= $num1 ?>">
                            <input type="hidden" name="num2" value="<?= $num2 ?>">
                        </div> <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-custom txt-clr btn-block btnRegister"
                                    type="button">REGISTER</button>
                            </div>
                        </div>
                        <div class="row mt-10">
                            <div class="col-md-12">
                                <a href="/login"> Already have an account? </a> | <a href="/login"> Login </a>
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
    <script src="assets/modules/register.js"></script>
</body>

</html>
<?
} else {
    header("Location: /login", true, 302);
}
?>