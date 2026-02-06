<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    // 1. Usamos REQUEST_URI que es más confiable
    // 2. Usamos '??' para evitar errores si la variable no está definida
    $url_actual = $_SERVER['REQUEST_URI'] ?? '/';


    return str_contains($url_actual, $path);
}


function is_auth() : bool {
    session_start();
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}


function is_admin() : bool {
    session_start();
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);

}