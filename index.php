<?
session_start();
// --- Se obtien la URI
$url = filter_var(rtrim($_SERVER["REQUEST_URI"], "/"), FILTER_SANITIZE_URL);
$url = explode("?", $url)[0];
switch ($url) {
        // --- Página principal
    case '':
    case '/':
        include "view/index.php";
        break;
        // --- Login
    case '/login':
        // --- Validar cuenta
        $idUserActivateAccount = 0;
        if (!empty($_GET["activate_user"])) {
            $idUserActivateAccount = filter_var(trim($_GET["activate_user"]), FILTER_SANITIZE_NUMBER_INT);
        }
        // --- Validate session active
        if (@$_SESSION['role'] == 2) {
            header("Location: /member", true, 302);
        }
        if (@$_SESSION['role'] == 1) {
            header("Location: /admin", true, 302);
        }
        // --- View login
        include "view/login.php";
        break;
        // --- Login
    case '/register':
        include "view/register.php";
        break;
    case '/logout':
        include "controller/logout.php";
        break;
        // --- Recuperar contraseña
    case '/forget-password':
        include "view/forget-password.php";
        break;
    case '/change-password':
        $idUserAccount = 0;
        if (!empty($_GET["cpwd"])) {
            $idUserAccount = base64_decode(filter_var(trim($_GET["cpwd"]), FILTER_SANITIZE_SPECIAL_CHARS));
            if (is_numeric($idUserAccount)) {
                if (@$_SESSION['role'] == 2) {
                    include "view/member/change-password.php";
                }
                if (@$_SESSION['role'] == 1) {
                    include "view/admin/change-password.php";
                }
            }
        }
        break;
    case '/change-reset-password':
        $idUserAccount = 0;
        if (!empty($_GET["change_pwd"])) {
            $idUserAccount = filter_var(trim($_GET["change_pwd"]), FILTER_SANITIZE_SPECIAL_CHARS);
            if (is_numeric($idUserAccount)) {
                include "view/change-password.php";
                return;
            }
        }
        header("Location: /member", true, 302);
        break;
        // --- User login
    case '/member':
        $urlAdmin = "/member";
        include "view/member/index.php";
        break;
    case '/admin':
        $urlAdmin = "/admin";
        include "view/admin/index.php";
        break;
    case '/users':
        include "view/admin/users.php";
        break;
    default:
        echo "Error...";
        break;
}
