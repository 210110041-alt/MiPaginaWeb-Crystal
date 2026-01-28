<?php
$host = "sql201.infinityfree.com";
$user = "if0_41010556";
$pass = "N5KGb3yvbTKQ";
$db   = "if0_41010556_portafolio_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
