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

}