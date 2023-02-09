<?
class ModelRegister
{

    private $Conexion;

    function __construct()
    {
        $this->Conexion = new Conexion();
    }

    public function registerUser($firstName, $lastName, $email, $password, $encPassword, $userRole, $status, $createdAt)
    {
        try {

            $firstName = strtolower($firstName);
            $lastName = strtolower($lastName);

            $db = $this->Conexion->BD();
            $db->beginTransaction();

            $query = $db->prepare("INSERT INTO users (first_name, last_name, email, password, role, status, created_at) VALUES (:first_name, :last_name, :email, :_password, :_role, :_status, :created_at)");
            $query->bindParam(':first_name', $firstName);
            $query->bindParam(':last_name', $lastName);
            $query->bindParam(':email', $email);
            $query->bindParam(':_password', $encPassword);
            $query->bindParam(':_role', $userRole);
            $query->bindParam(':_status', $status);
            $query->bindParam(':created_at', $createdAt);

            if (!$query->execute()) {
                throw new PDOException('Internal server error if the problem persists contact the system administrator.');
            }

            // --- Send email of confirmer
            $uid = base64_encode($db->lastInsertId());
            $activationLink = "http://$_SERVER[HTTP_HOST]/" . "login?activate_user=" . $db->lastInsertId();
            
            $subject = "User Registration Activation Email";
            $msg = "Hello " . $firstName . "," . "\r\nThanks for Signing Up. Your Account has been Created Successfully. Please Verify your Email Address by Clicking the Following Link within 24 Hours.\r\n" . $activationLink . "\r\n\r\nBest Regards\r\n" . $_SESSION['siteName'];

            $noReplyEmail = $_SESSION['noreply'];
            $headers = "From: $noReplyEmail" . "\r\n";

            // if (!mail($email, $subject, $msg, $headers)) {
            //     throw new PDOException('Oops! Something Went Wrong.');
            // }

            $db->commit();
            return (object)["estado" => true, "mensaje" => "We have sent you verification link. Please check your email Inbox/Junk Folder."];
            
        } catch (PDOException $e) {
            $db->rollBack();
            return (object)["estado" => false, "mensaje" => $e->getMessage()];
        }
    }
}
