<?php
include_once dirname(__DIR__, 1) . '/model/db.php';
include dirname(__DIR__, 1) . '/model/ModelUser.php';
class ControllerLogin
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

    public function tableUsers()
    {

        try {

            $db = $this->Conexion->BD();

            $query = $db->prepare("SELECT id, email, password, role, status FROM users");
            $query->execute();

            $arrayRow = $query->fetchAll(PDO::FETCH_ASSOC);
            include 'view/admin/userView/tableUserView.php';

        } catch (PDOException $e) {
            $error = $e->getMessage();
            include 'view/admin/userView/alert-danger-activate-account.php';
        }
    }
}

$ControllerLogin = new ControllerLogin();
