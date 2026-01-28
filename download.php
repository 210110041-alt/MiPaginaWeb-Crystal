<?php
session_start();

// 1. Verificar si el usuario tiene una sesión activa
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, enviar un error de "No autorizado" y salir.
    header('HTTP/1.1 403 Forbidden');
    die('Acceso denegado. Por favor, inicie sesión para descargar archivos.');
}

// 2. Lista blanca de archivos permitidos para descargar
$allowed_files = [
    'CineGestor.exe' => 'Descargas/Cine.exe',
    'Calculadora.java' => 'Descargas/Calculadora.java',
    'Aprendizaje_Mantenimiento.pdf' => 'Descargas/Reporte Final-SC 4-2.pdf',
    'Reporte_Estancia_Promexfrut.pdf' => 'Descargas/Reporte de Estancia-Promexfrut.pdf'
];

$filename_key = isset($_GET['file']) ? $_GET['file'] : '';

// 3. Validar que el archivo solicitado está en la lista blanca
if (array_key_exists($filename_key, $allowed_files)) {
    $filepath = $allowed_files[$filename_key];

    // 4. Verificar que el archivo realmente existe en el servidor
    if (file_exists($filepath)) {
        // 5. Enviar las cabeceras correctas para forzar la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename_key) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Limpiar el buffer de salida y enviar el archivo
        flush(); 
        readfile($filepath);
        exit;
    }
}

// Si el archivo no existe o no está permitido, mostrar un error 404.
header('HTTP/1.1 404 Not Found');
die('Archivo no encontrado.');
?>