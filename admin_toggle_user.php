<?php
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nuevo_estado = $_POST['nuevo_estado'];

    // Validar valores permitidos
    if (!in_array($nuevo_estado, ['activo', 'inactivo'])) {
        die('Estado no válido');
    }

    // Actualizar el estado del usuario
    $stmt = $conexion->prepare("UPDATE usuarios SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $nuevo_estado, $id);
    $stmt->execute();

    header('Location: admin_panel.php#usuarios');
    exit();
}
