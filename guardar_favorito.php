<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$usuario_id = $_SESSION['usuario_id'];
$propiedad_id = $_POST['propiedad_id'] ?? null;

if ($propiedad_id) {
  // Verificar si ya es favorito
  $stmt = $conexion->prepare("SELECT * FROM favoritos WHERE usuario_id = ? AND propiedad_id = ?");
  $stmt->bind_param("ii", $usuario_id, $propiedad_id);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows > 0) {
    // Ya está en favoritos, eliminarlo
    $delete = $conexion->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND propiedad_id = ?");
    $delete->bind_param("ii", $usuario_id, $propiedad_id);
    $delete->execute();
  } else {
    // No está en favoritos, agregarlo
    $insert = $conexion->prepare("INSERT INTO favoritos (usuario_id, propiedad_id) VALUES (?, ?)");
    $insert->bind_param("ii", $usuario_id, $propiedad_id);
    $insert->execute();
  }
}

// Redirigir de vuelta a la página anterior
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
