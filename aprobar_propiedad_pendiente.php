<?php
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $accion = $_POST['accion'];

    if ($accion === 'aceptar') {
        $query = $conexion->prepare("SELECT * FROM propiedades_pendientes WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows === 1) {
            $prop = $resultado->fetch_assoc();

            $estado = 'aprobada';
            $fecha_publicacion = date('Y-m-d H:i:s');

            $insert = $conexion->prepare("INSERT INTO propiedades (
                titulo, descripcion, habitaciones, banos, metros_cuadrados, precio,
                tipo_operacion, imagen_url, usuario_id, fecha_publicacion, estado
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insert->bind_param(
                "ssiiidsssss",
                $prop['titulo'],
                $prop['descripcion'],
                $prop['habitaciones'],
                $prop['banos'],
                $prop['metros_cuadrados'],
                $prop['precio'],
                $prop['tipo_operacion'],
                $prop['imagen_url'],
                $prop['usuario_id'],
                $fecha_publicacion,
                $estado
            );

            $insert->execute();

            $delete = $conexion->prepare("DELETE FROM propiedades_pendientes WHERE id = ?");
            $delete->bind_param("i", $id);
            $delete->execute();
        }
    } elseif ($accion === 'rechazar') {
        $delete = $conexion->prepare("DELETE FROM propiedades_pendientes WHERE id = ?");
        $delete->bind_param("i", $id);
        $delete->execute();
    }

    header("Location: admin_panel.php");
    exit();
}
