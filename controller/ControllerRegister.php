<?php
include_once dirname(__DIR__, 1) . '/model/db.php';
include dirname(__DIR__, 1) . '/model/ModelRegister.php';
class ControllerRegister extends ModelRegister
{

    private $Conexion;
    private $tipoError;
    private $ModelRegister;

    function __construct()
    {
        $this->Conexion = new Conexion();
        $this->ModelRegister = new ModelRegister();
        $this->tipoError = "validaciones";
    }

    public function validarCorreoExistencia()
    {
        try {

            /**
             * 
             * ---- Inputs form
             * 
             */
            $firstName = trim($_POST['first-name']);
            $lastName = trim($_POST['last-name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm-password']);
            $encPassword = password_hash($password, PASSWORD_DEFAULT);
            $num1 = trim($_POST['num1']);
            $num2 = trim($_POST['num2']);
            $humanVerifier = trim($_POST['human-verifier']);
            $userRole = 2;
            $status = 0;
            $createdAt = $_SERVER['REQUEST_TIME'];

            /**
             * 
             * --- Validations
             * 
             */
            if (empty($firstName) || is_numeric($firstName)) {
                throw new PDOException("The name cannot be empty and/or the entered value is incorrect.");
            }

            if (empty($lastName) || is_numeric($lastName)) {
                throw new PDOException("The lastname cannot be empty and/or the entered value is incorrect.");
            }

            if (empty($password)) {
                throw new PDOException("The password cannot be empty.");
            }

            if ($password != $confirmPassword) {
                throw new PDOException("Password & Confirm Password did not match.");
            }

            if (($num1 + $num2) != $humanVerifier) {
                throw new PDOException("Incorrect Human Verifier");
            }

            $db = $this->Conexion->BD();

            // --- Query to see if email exists
            $query = $db->prepare("SELECT id FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            if ($query->fetch(PDO::FETCH_ASSOC)) {
                throw new PDOException('This Email is already Registered.');
            }

            // --- Register user.
            $stateRegister = $this->ModelRegister->registerUser($firstName, $lastName, $email, $password, $encPassword, $userRole, $status, $createdAt);
            $message = $stateRegister->mensaje;

            if (!$stateRegister->estado) {
                throw new PDOException($message);
            }

            include '../view/registerView/alert-success-register.php';

        } catch (PDOException $e) {
            $error = $e->getMessage();
            include '../view/registerView/alert-danger-register.php';
        }
    }
}

$ControllerRegister = new ControllerRegister();
