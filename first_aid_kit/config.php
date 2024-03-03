<?php
    $db_server = "localhost";
    $db_username = "id21374954_dbms";
    $db_password = "Goku@2002";
    $db_name = "id21374954_dbms";

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
