<?php
include_once dirname(__DIR__, 1) . '/model/db.php';
include dirname(__DIR__, 1) . '/model/ModelUser.php';
class ControllerUser
{

    private $Conexion;
    private $tipoError;
    private $ModelUser;

    function __construct()
    {
        $this->Conexion = new Conexion();
        $this->tipoError = "validaciones";
        $this->ModelUser = new ModelUser();
    }

    public function updateTableUsers()
    {

        try {

            $db = $this->Conexion->BD();
            $update = @trim($_POST["update"]);

            $url = "";
            if ($update) {
                $url = "../";
            }

            $query = $db->prepare("SELECT id, email, password, role, status FROM users");
            $query->execute();

            $arrayRow = $query->fetchAll(PDO::FETCH_ASSOC);
            include $url . 'view/admin/userView/tableUserView.php';
        } catch (PDOException $e) {
            $error = $e->getMessage();
            include $url . 'view/admin/userView/alert-danger-activate-account.php';
        }
    }

    // --- Update user
    public function updateUser()
    {

        try {

            $db = $this->Conexion->BD();
            $role = trim($_POST["role"]);
            $status = trim($_POST["status"]);
            $idUser = trim($_POST["user-id"]);

            // --- Validaciones

            $query = $db->prepare("SELECT id FROM users WHERE id = :id");
            $query->bindParam(':id', $idUser);
            $query->execute();

            if (!$query->fetch(PDO::FETCH_ASSOC)) {
                throw new PDOException('User does not exist.');
            }

            // --- Update user
            $stateUpdate = $this->ModelUser->updateUser($role, $status, $idUser);
            if (!$stateUpdate->estado) {
                throw new PDOException($stateUpdate->mensaje);
            }

            print_r(json_encode(array("estado" => "success", "mensaje" => $stateUpdate->mensaje)));
        } catch (PDOException $e) {
            print_r(json_encode(array("estado" => "warnign", "mensaje" => $e->getMessage())));
        }
    }

    // --- Delete user
    public function deleteUser()
    {

        try {

            $db = $this->Conexion->BD();
            $idUser = trim($_POST["idUser"]);

            // --- Validaciones

            if ($idUser == 1) {
                throw new PDOException('Cannot remove super admin.');
            }

            $query = $db->prepare("SELECT id FROM users WHERE id = :id");
            $query->bindParam(':id', $idUser);
            $query->execute();

            if (!$query->fetch(PDO::FETCH_ASSOC)) {
                throw new PDOException('User does not exist.');
            }

            // --- Update user
            $stateUpdate = $this->ModelUser->deleteUser($idUser);
            if (!$stateUpdate->estado) {
                throw new PDOException($stateUpdate->mensaje);
            }

            print_r(json_encode(array("estado" => "success", "mensaje" => $stateUpdate->mensaje)));
        } catch (PDOException $e) {
            print_r(json_encode(array("estado" => "warnign", "mensaje" => $e->getMessage())));
        }
    }
}

$ControllerUser = new ControllerUser();
