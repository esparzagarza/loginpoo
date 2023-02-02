<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Conexion
{

    public function BD()
    {
        try {
            $servername = "localhost"; // Change it to your servername
            $username = "root";   // Change it to your database username 
            $password = "";   // Change it to your database password
            $db = "php_login_system";         // Change it to your database name

            $conexion = new PDO('mysql:host=' . $servername . ';dbname=' . $db . '', $username, $password);
            return $conexion;
        } catch (PDOException $e) {
            die("Connection failed: $e");
        }
    }
}
