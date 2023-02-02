<?php
session_start();
include 'ControllerRegister.php';
include 'ControllerLogin.php';
// --- Se obtien la URI
$url = filter_var($_POST["actionController"], FILTER_SANITIZE_URL);
switch ($url) {
        // ---Controller register
    case 'registerUser':
        $ControllerRegister->validarCorreoExistencia();
        break;
        // ---Controller activate account
    case 'login':
        $ControllerLogin->login();
        break;
        // ---Controller activate account
    case 'changePassword':
        $ControllerLogin->changePassword();
        break;
    case 'resetPassword':
        $ControllerLogin->resetPassword();
        break;
    case 'changeResetPassword':
        $ControllerLogin->changeResetPassword();
        break;
    default:
        echo "Error...";
        break;
}
