<?php
session_start(); // Iniciar la sesión
header('Content-Type: application/json');
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email) || !isset($data->password)) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}


$email = $data->email;
$pass = $data->password;

// Usar consultas preparadas para evitar inyección SQL
$stmt = $conn->prepare("SELECT id, username, password FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $db_user = $result->fetch_assoc();
    // Verificar la contraseña hasheada
    if (password_verify($pass, $db_user['password'])) {
        // Contraseña correcta: Iniciar sesión
        $_SESSION['user_id'] = $db_user['id'];
        $_SESSION['username'] = $db_user['username'];
        echo json_encode(["success" => true, "message" => "Bienvenido, " . htmlspecialchars($db_user['username'])]);
    } else {
        // Contraseña incorrecta
        echo json_encode(["success" => false, "message" => "Correo o contraseña incorrectos."]);
    }
} else {
    // Usuario no encontrado
    echo json_encode(["success" => false, "message" => "Correo o contraseña incorrectos."]);
}
$stmt->close();
$conn->close();
?>