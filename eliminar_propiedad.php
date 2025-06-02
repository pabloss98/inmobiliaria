<?php
session_start();
require 'includes/conexion.php';

// Solo administradores pueden eliminar
if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    die("Acceso no autorizado.");
}

// Verifica que se haya enviado el ID por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Eliminar la propiedad
    $stmt = $conexion->prepare("DELETE FROM propiedades WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_panel.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar la propiedad.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Solicitud no válida.";
}
?>
