<?php
session_start();
require 'includes/conexion.php';

if ($_SESSION['usuario_rol'] !== 'admin') {
  exit("No autorizado.");
}

$accion = $_POST['accion'] ?? null;
$id = intval($_POST['id'] ?? 0);

switch ($accion) {
  case 'aprobar_propiedad':
    $conexion->query("UPDATE propiedades SET estado = 'aprobado' WHERE id = $id");
    break;
  case 'rechazar_propiedad':
    $conexion->query("DELETE FROM propiedades WHERE id = $id");
    break;
  case 'eliminar_propiedad':
    $conexion->query("DELETE FROM propiedades WHERE id = $id");
    break;
  case 'cambiar_estado_usuario':
    $nuevo = $_POST['nuevo_estado'] === 'activo' ? 'activo' : 'inactivo';
    $conexion->query("UPDATE usuarios SET estado = '$nuevo' WHERE id = $id");
    break;
}

header("Location: admin_panel.php");
exit();
