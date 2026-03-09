<?php
$db = mysqli_connect(
    $_SERVER['DB_HOST'] ?? '',
    $_SERVER['DB_USER'] ?? '', 
    $_SERVER['DB_PASS'] ?? '', 
    $_SERVER['DB_NAME'] ?? ''
);

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}