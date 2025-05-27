<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$usuario_id = $_SESSION['usuario_id'];

$query = "
  SELECT p.*
  FROM propiedades p
  INNER JOIN favoritos f ON p.id = f.propiedad_id
  WHERE f.usuario_id = ?
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Favoritos | ModernHouse</title>
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

    .section {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .section h2 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #0d6efd;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .card-body {
      padding: 15px;
    }

    .card-body h4 {
      margin-bottom: 10px;
      font-size: 20px;
    }

    .card-body p {
      font-size: 14px;
      color: #555;
    }

    .empty {
      text-align: center;
      padding: 60px 20px;
      color: #888;
      font-size: 18px;
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 530px;
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
      <a href="publicar.php">Publicar Propiedades</a>
    </nav>
  </header>

  <section class="section">
    <h2>Tus Propiedades Favoritas</h2>

    <?php if ($resultado->num_rows > 0): ?>
    <div class="grid">
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <div class="card">
          <img src="<?= htmlspecialchars($fila['imagen_url']) ?>" alt="<?= htmlspecialchars($fila['titulo']) ?>">
          <div class="card-body">
            <h4>
              <?= htmlspecialchars($fila['titulo']) ?>
              <form action="guardar_favorito.php" method="POST" style="display:inline;">
                <input type="hidden" name="propiedad_id" value="<?= $fila['id'] ?>">
                <button type="submit" class="fav" style="background:none; border:none; color:#f44336; font-size:20px; cursor:pointer;">
                  ♥
                </button>
              </form>
            </h4>

            <p>
              <?= htmlspecialchars($fila['descripcion']) ?><br>
              <?= $fila['habitaciones'] ?> hab · <?= $fila['banos'] ?> baños · <?= $fila['metros_cuadrados'] ?> m²<br>
              <?= number_format($fila['precio'], 0, ',', '.') ?> €
            </p>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <?php else: ?>
      <div class="empty">Aún no has agregado ninguna propiedad a tus favoritos.</div>
    <?php endif; ?>
  </section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>
</body>
</html>
