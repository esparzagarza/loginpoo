<?php

    $servername = 'localhost';      // Change it to your servername
    $username = 'root';             // Change it to your database username 
    $password = 'toor';             // Change it to your database password
    $db = 'php_login_system';       // Change it to your database name

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>