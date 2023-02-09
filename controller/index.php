<?php
session_start();
include 'ControllerRegister.php';
include 'ControllerLogin.php';
include 'ControllerUser.php';
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
        // --- Admin
    case 'updateUser':
        $ControllerUser->updateUser();
        break;
    case 'deleteUser':
        $ControllerUser->deleteUser();
        break;
    case 'updateTableUsers':
        $ControllerUser->updateTableUsers();
        break;
    default:
        echo "Error...";
        break;
}
