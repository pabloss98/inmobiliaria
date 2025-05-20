<?php
session_start();
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $accion = $_POST['accion'] ?? null;

  if ($id && in_array($accion, ['aceptar', 'rechazar'])) {
    $estado = $accion === 'aceptar' ? 'aceptada' : 'rechazada';

    // Actualizar el estado de la solicitud
    $stmt = $conexion->prepare("UPDATE solicitudes SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id);
    $stmt->execute();

    // Si es aceptada, registrar la transacción
    if ($accion === 'aceptar') {
      $stmt = $conexion->prepare("SELECT propiedad_id, usuario_id, tipo_operacion FROM solicitudes WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $solicitud = $result->fetch_assoc();

      if ($solicitud) {
        $propiedad_id = $solicitud['propiedad_id'];
        $usuario_id = $solicitud['usuario_id'];
        $tipo_operacion = $solicitud['tipo_operacion'];

        $stmt = $conexion->prepare("INSERT INTO transacciones (solicitud_id, propiedad_id, usuario_id, tipo_operacion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $id, $propiedad_id, $usuario_id, $tipo_operacion);
        $stmt->execute();
      }
    }

    header("Location: admin_panel.php");
    exit();
  }
}

header("Location: admin_panel.php");
exit();
