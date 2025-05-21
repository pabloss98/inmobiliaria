<?php
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);
  $accion = $_POST['accion'];

  // Define el nuevo estado
  $estado = ($accion === 'aceptar') ? 'aprobado' : 'rechazado';

  // Actualiza la base de datos
  $stmt = $conexion->prepare("UPDATE propiedades SET estado = ? WHERE id = ?");
  $stmt->bind_param("si", $estado, $id);
  $stmt->execute();

  // Redirige al panel
  header("Location: admin_panel.php");
  exit();
}
