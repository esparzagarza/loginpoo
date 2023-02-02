<?
class ModelUser
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

    public function updateUser($role, $status, $idUser)
    {
        try {

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $query = $db->prepare("UPDATE users SET role = :role_, status = :status_  WHERE users.id = :id");
            $query->bindParam(':role_', $role);
            $query->bindParam(':status_', $status);
            $query->bindParam(':id', $idUser);

            if (!$query->execute()) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "User updated successfully."];
        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }

    public function deleteUser($idUser)
    {
        try {

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $query = $db->prepare("DELETE FROM users WHERE users.id = :id");
            $query->bindParam(':id', $idUser);

            if (!$query->execute()) {
                throw new PDOException('Oops! Something Went Wrong.');
            }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "User deleted successfully."];

        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }
}
