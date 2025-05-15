<?php
require 'includes/conexion.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  header("Location: propiedades.php");
  exit();
}

$stmt = $conexion->prepare("SELECT * FROM propiedades WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
  echo "Propiedad no encontrada.";
  exit();
}

$prop = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($prop['titulo']) ?> | ModernHouse</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      color: #333;
    }

    header {
      background-color: #0d6efd;
      color: #fff;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    header h1 {
      font-size: 24px;
    }

    nav a {
      color: #fff;
      margin: 0 15px;
      text-decoration: none;
      font-weight: 500;
    }

    .detalle {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .detalle img {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .detalle h2 {
      font-size: 28px;
      color: #0d6efd;
      margin-bottom: 10px;
    }

    .detalle p {
      margin-bottom: 10px;
      font-size: 16px;
      line-height: 1.5;
    }

    .detalle strong {
      font-size: 20px;
      color: #333;
    }

    .back-link {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      color: #0d6efd;
      font-weight: bold;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

  <header>
    <h1>ModernHouse</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="propiedades.php">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="contactos.php">Contacto</a>
    </nav>
  </header>

  <section class="detalle">
    <img src="<?= htmlspecialchars($prop['imagen_url']) ?>" alt="<?= htmlspecialchars($prop['titulo']) ?>">
    <h2><?= htmlspecialchars($prop['titulo']) ?></h2>
    <p><?= htmlspecialchars($prop['descripcion']) ?></p>
    <p><?= $prop['habitaciones'] ?> hab · <?= $prop['banos'] ?> baños · <?= $prop['metros_cuadrados'] ?> m²</p>
    <p><strong><?= number_format($prop['precio'], 0, ',', '.') ?> €</strong></p>
    <a href="propiedades.php" class="back-link">← Volver a Propiedades</a>
  </section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
