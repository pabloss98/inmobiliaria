<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$propiedad_id = $_POST['propiedad_id'] ?? null;

if (!$propiedad_id) {
    die("Propiedad no especificada.");
}

// Evitar duplicados
$existe = $conexion->prepare("SELECT id FROM favoritos WHERE usuario_id = ? AND propiedad_id = ?");
$existe->bind_param("ii", $usuario_id, $propiedad_id);
$existe->execute();
$existe->store_result();

if ($existe->num_rows === 0) {
    $guardar = $conexion->prepare("INSERT INTO favoritos (usuario_id, propiedad_id, fecha_guardado) VALUES (?, ?, NOW())");
    $guardar->bind_param("ii", $usuario_id, $propiedad_id);
    $guardar->execute();
    $guardar->close();
}

$existe->close();

header("Location: propiedades.php");
exit();
?>
