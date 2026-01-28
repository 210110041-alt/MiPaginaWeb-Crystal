<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
require 'conexion.php';

// Leer datos JSON del frontend
$input = file_get_contents("php://input");
$data = json_decode($input);

// Verificar que llegue JSON válido
if ($data === null) {
    echo json_encode([
        "success" => false,
        "message" => "No se recibieron datos en formato JSON"
    ]);
    exit;
}

// Validar campos
if (
    !isset($data->username) ||
    !isset($data->password) ||
    !isset($data->email)
) {
    echo json_encode([
        "success" => false,
        "message" => "Datos incompletos"
    ]);
    exit;
}

$username = trim($data->username);
$password = trim($data->password);
$email    = trim($data->email);

// Validaciones básicas
if ($username === "" || $password === "" || $email === "") {
    echo json_encode([
        "success" => false,
        "message" => "Todos los campos son obligatorios"
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "success" => false,
        "message" => "Correo electrónico no válido"
    ]);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode([
        "success" => false,
        "message" => "La contraseña debe tener al menos 6 caracteres"
    ]);
    exit;
}

// Verificar usuario existente
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE username = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error en consulta username"]);
    exit;
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "El nombre de usuario ya está en uso"
    ]);
    exit;
}
$stmt->close();

// Verificar email existente
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error en consulta email"]);
    exit;
}
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "message" => "El correo electrónico ya está registrado"
    ]);
    exit;
}
$stmt->close();

// Insertar usuario
$password_hash = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare(
    "INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)"
);
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error al preparar INSERT"]);
    exit;
}
$stmt->bind_param("sss", $username, $email, $password_hash);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Usuario registrado con éxito"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Error al registrar usuario"
    ]);
}

$stmt->close();
$conn->close();
?>
