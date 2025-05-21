<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'] ?? '';
  $descripcion = $_POST['descripcion'] ?? '';
  $habitaciones = (int)($_POST['habitaciones'] ?? 0);
  $banos = (int)($_POST['banos'] ?? 0);
  $metros = (int)($_POST['metros'] ?? 0);
  $precio = (float)($_POST['precio'] ?? 0);
  $tipo_operacion = $_POST['tipo_operacion'] ?? 'venta';
  $usuario_id = $_SESSION['usuario_id'];

  // Procesar imagen
  $imagen_url = '';
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombre_archivo = time() . "_" . basename($_FILES["imagen"]["name"]);
    $ruta_destino = "imagenes/" . $nombre_archivo;

    $ext = strtolower(pathinfo($ruta_destino, PATHINFO_EXTENSION));
    $ext_permitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($ext, $ext_permitidas)) {
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_destino);
      $imagen_url = $ruta_destino;
    }
  }

  // Insertar en tabla propiedades_pendientes
  $stmt = $conexion->prepare("INSERT INTO propiedades_pendientes (titulo, descripcion, habitaciones, banos, metros_cuadrados, precio, tipo_operacion, imagen_url, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssiiiissi", $titulo, $descripcion, $habitaciones, $banos, $metros, $precio, $tipo_operacion, $imagen_url, $usuario_id);
  $stmt->execute();

  echo "<script>
          alert('Tu propiedad ha sido enviada para revisión. Será publicada una vez aprobada por un administrador.');
          window.location.href='propiedades.php';
        </script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Publicar Propiedad</title>
    <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }
    form {
      background: white;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #0d6efd;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      width: 100%;
      background-color: #0d6efd;
      color: white;
      border: none;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #084cd6;
    }
  </style>
</head>
<body>

  <form method="POST" enctype="multipart/form-data">
    <h2>Publicar Propiedad</h2>

    <label for="titulo">Título</label>
    <input type="text" name="titulo" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" rows="5" required></textarea>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" name="habitaciones" min="0" required>

    <label for="banos">Baños</label>
    <input type="number" name="banos" min="0" required>

    <label for="metros">Metros Cuadrados</label>
    <input type="number" name="metros" min="0" required>

    <label for="precio">Precio (€)</label>
    <input type="number" name="precio" min="0" step="0.01" required>

    <label for="tipo_operacion">Tipo de operación</label>
    <select name="tipo_operacion" required>
      <option value="venta">Venta</option>
      <option value="alquiler">Alquiler</option>
    </select>

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" accept="image/*" required>

    <button type="submit">Enviar para revisión</button>
  </form>

</body>
</html>
