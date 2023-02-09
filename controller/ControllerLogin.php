<?php
include_once dirname(__DIR__, 1) . '/model/db.php';
include dirname(__DIR__, 1) . '/model/ModelLogin.php';
class ControllerLogin
{

    private $Conexion;
    private $tipoError;
    private $ModelLogin;

    function __construct()
    {
        $this->Conexion = new Conexion();
        $this->tipoError = "validaciones";
        $this->ModelLogin = new ModelLogin();
    }

    // --- Login
    public function login()
    {
        try {

            $db = $this->Conexion->BD();

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $estatus = 1;

            $query = $db->prepare("SELECT id, first_name, last_name, email, password, role, status FROM users WHERE email = :email AND status = :status_");
            $query->bindParam(':email', $email);
            $query->bindParam(':status_', $estatus);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                throw new PDOException("User Email doesn't Exist.");
            }

            $dbPassword = $row['password'];

            if (password_verify($password, $dbPassword)) {

                $dbId = $row['id'];
                $dbFirstName = $row['first_name'];
                $dbLastName = $row['last_name'];
                $dbEmail = $row['email'];
                $dbRole = $row['role'];
                $dbStatus = $row['status'];

                $urlRedirect = "admin";
                if ($dbRole == 2) {
                    $urlRedirect = "member";
                }

                $_SESSION["logged_in"] = 1;
                $_SESSION['id'] = $dbId;
                $_SESSION['first_name'] = $dbFirstName;
                $_SESSION['last_name'] = $dbLastName;
                $_SESSION['email'] = $dbEmail;
                $_SESSION['role'] = $dbRole;
                $_SESSION['status'] = $dbStatus;
            } else {
                throw new PDOException("Invalid Password or Inactive User.");
            }

            $message = "You logged in successfully.";
            include '../view/loginView/alert-success-login.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include '../view/loginView/alert-danger-activate-account.php';
        }
    }

    // --- Activate account
    public function activateAccount($idUserActivateAccount)
    {
        try {

            $db = $this->Conexion->BD();

            // --- Validar si existe el usuario
            $query = $db->prepare("SELECT created_at FROM users WHERE id = :id");
            $query->bindParam(':id', $idUserActivateAccount);
            $query->execute();

            $createdTime = $query->fetch(PDO::FETCH_ASSOC);
            if (!$createdTime) {
                throw new PDOException('Error when activating the account, it does not exist.');
            }

            $createdTime = $createdTime["created_at"];
            $curTime  = time();
            $validateTime = $curTime + 86400;

            // --- Activate account user.
            if ($validateTime >= $createdTime) {

                $stateRegister = $this->ModelLogin->activateAccount($idUserActivateAccount);
                $message = $stateRegister->mensaje;

                if (!$stateRegister->estado) {
                    throw new PDOException($message);
                }
            } else {
                throw new PDOException("Oops! Verification Link is Expired.");
            }

            include 'view/loginView/alert-success-activate-account.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include 'view/loginView/alert-danger-activate-account.php';
        }
    }

    // --- Change password
    public function changePassword()
    {
        try {

            $db = $this->Conexion->BD();
            $userId = $_SESSION['id'];

            // --- Validar si existe el usuario
            $query = $db->prepare("SELECT password FROM users WHERE id = :id");
            $query->bindParam(':id', $userId);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $pwd = trim($_POST["pwd"]);
            $newPwd = trim($_POST["new-pwd"]);
            $confirmPwd = trim($_POST["confirm-pwd"]);
            $passwordUser = $row["password"];

            if (!password_verify($pwd, $passwordUser)) {
                throw new PDOException('Oops! Invalid Old Password.');
            }

            if ($newPwd != $confirmPwd || (empty($newPwd) || empty($confirmPwd))) {
                throw new PDOException('Oops! Password & Confirm not match.');
            }

            // --- Activate account user.
            $stateRegister = $this->ModelLogin->changePassword($userId, $newPwd);
            $message = $stateRegister->mensaje;

            if (!$stateRegister->estado) {
                throw new PDOException($message);
            }

            include '../view/loginView/alert-success-activate-account.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include '../view/loginView/alert-danger-activate-account.php';
        }
    }

    // --- Reset password
    public function resetPassword()
    {
        try {

            $db = $this->Conexion->BD();
            $email = trim($_POST['email']);

            // --- Validar si existe el usuario
            $query = $db->prepare("SELECT id, first_name FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                throw new PDOException("Email doesn't Exist!");
            }

            $id = base64_encode($row["id"]);
            $firstName = $row["first_name"];

            // --- Send email
            // $activationLink = "http://$_SERVER[HTTP_HOST]" . "/change-password.php?change_pwd=" . $id;

            // $to = $email;
            // $subject = "User Registration Activation Email";

            // $msg = "Hello " . $firstName . "," . "\r\nWe have received your request to change your password. Please verify your email address and change password by clicking the following link.\r\n" . $activationLink . "\r\n\r\nBest Regards\r\n" . $siteName;

            // $noReplyEmail = $_SESSION['noreply'];
            // $headers = "From: $noReplyEmail" . "\r\n";

            // if (!mail($to, $subject, $msg, $headers)) {
            //     throw new PDOException("Oops! Server Error: Mail Sent Failed.");
            // }

            $message = "We have sent you Password Reset Link. Please check your Email Inbox/Junk Folder.";
            include '../view/loginView/alert-success-activate-account.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include '../view/loginView/alert-danger-activate-account.php';
        }
    }

    // --- Change reset password
    public function changeResetPassword()
    {
        try {

            $db = $this->Conexion->BD();
            $idUserAccount = $_SESSION["id"];

            // --- Validar si existe el usuario
            $query = $db->prepare("SELECT id FROM users WHERE id = :id");
            $query->bindParam(':id', $idUserAccount);
            $query->execute();

            $row = $query->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                throw new PDOException('User does not exist.');
            }

            $pwd = trim($_POST["pwd"]);
            $confirmPwd = trim($_POST["confirm-pwd"]);

            if ($pwd != $confirmPwd || (empty($pwd) || empty($confirmPwd))) {
                throw new PDOException('Password & Confirm Password did not match.');
            }

            // --- Activate account user.
            $stateRegister = $this->ModelLogin->changeResetPassword($idUserAccount, $pwd);
            $message = $stateRegister->mensaje;

            if (!$stateRegister->estado) {
                throw new PDOException($message);
            }

            include '../view/loginView/alert-success-activate-account.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include '../view/loginView/alert-danger-activate-account.php';
        }
    }
}

$ControllerLogin = new ControllerLogin();
