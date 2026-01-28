<?php
session_start();

header('Content-Type: application/json');

// Devuelve 'true' si el usuario tiene una sesión activa, 'false' si no.
echo json_encode(['loggedIn' => isset($_SESSION['user_id'])]);
?>