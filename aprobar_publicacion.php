<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
  header("Location: index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['accion'])) {
  $id = (int) $_POST['id'];
  $accion = $_POST['accion'];

  if ($accion === 'aceptar') {
    $estado = 'aprobado';
  } elseif ($accion === 'rechazar') {
    $estado = 'rechazado';
  } else {
    header("Location: admin.php");
    exit();
  }

  $stmt = $conexion->prepare("UPDATE propiedades SET estado = ? WHERE id = ?");
  $stmt->bind_param("si", $estado, $id);
  $stmt->execute();
}

header("Location: admin.php");
exit();
