<?php
$host = 'fdb1028.awardspace.net';
$usuario = '4597186_inmobiliaria';
$clave = 'casa12345';
$base_de_datos = '4597186_inmobiliaria';

$conexion = new mysqli($host, $usuario, $clave, $base_de_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
