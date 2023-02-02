<?
class ModelLogin
{

    private $Conexion;

    function __construct()
    {
        $this->Conexion = new Conexion();
    }

    public function activateAccount($idUserActivateAccount)
    {
        try {

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $query = $db->prepare("UPDATE users SET status = '1' WHERE users.id = :id");
            $query->bindParam(':id', $idUserActivateAccount);

            if (!$query->execute()) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "Congratulation Your account has been activated successfully."];
            
        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }

    public function changePassword($userId, $newPwd)
    {
        try {

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $newPwd = password_hash($newPwd, PASSWORD_DEFAULT);

            $query = $db->prepare("UPDATE users SET password = :password_ WHERE users.id = :id");
            $query->bindParam(':id', $userId, PDO::PARAM_INT);
            $query->bindParam(':password_', $newPwd, PDO::PARAM_STR);

            if (!$query->execute()) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "Password Changed Successfully!"];
            
        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }

    public function changeResetPassword($idUserAccount, $pwd)
    {
        try {

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $newPwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = $db->prepare("UPDATE users SET password = :password_ WHERE users.id = :id");
            $query->bindParam(':id', $idUserAccount, PDO::PARAM_INT);
            $query->bindParam(':password_', $newPwd, PDO::PARAM_STR);

            if (!$query->execute()) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "Password Updated Successfully!"];
            
        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }

}