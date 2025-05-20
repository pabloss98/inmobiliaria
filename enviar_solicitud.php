<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  // Solo usuarios logueados pueden solicitar
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $propiedad_id = $_POST['propiedad_id'] ?? null;
  $tipo_operacion = $_POST['tipo_operacion'] ?? null;
  $usuario_id = $_SESSION['usuario_id'];

  if ($propiedad_id && in_array($tipo_operacion, ['venta', 'alquiler'])) {
    $stmt = $conexion->prepare("INSERT INTO solicitudes (propiedad_id, tipo_operacion, usuario_id) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $propiedad_id, $tipo_operacion, $usuario_id);
    if ($stmt->execute()) {
      // Redirigir con mensaje éxito
      header("Location: propiedades.php?mensaje=solicitud_enviada");
      exit();
    } else {
      echo "Error al enviar la solicitud.";
    }
  } else {
    echo "Datos inválidos.";
  }
} else {
  header("Location: propiedades.php");
  exit();
}
