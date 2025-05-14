<?php
session_start();
require 'includes/conexion.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;

// Obtener todas las propiedades
$sql = "SELECT * FROM propiedades";
$result = $conexion->query($sql);

// Obtener favoritos del usuario (si está logueado)
$favoritos = [];
if ($usuario_id) {
  $stmt = $conexion->prepare("SELECT propiedad_id FROM favoritos WHERE usuario_id = ?");
  $stmt->bind_param("i", $usuario_id);
  $stmt->execute();
  $res_fav = $stmt->get_result();
  while ($row = $res_fav->fetch_assoc()) {
    $favoritos[] = $row['propiedad_id'];
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Propiedades | ModernHouse</title>
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

    .filters {
      background-color: #fff;
      padding: 20px;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .filters button {
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .filters button:hover {
      background-color: #084edb;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
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

    .fav {
      float: right;
      font-size: 20px;
      color: #ccc;
      cursor: pointer;
    }

    .fav:hover {
      color: #f44336;
    }

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <header>
    <h1>ModernHouse</h1>
    <nav>
      <a href="index.php">Inicio</a>
      <a href="#">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="contactos.php">Contacto</a>
    </nav>
  </header>

  <div class="filters">
    <button>Todos</button>
    <button>Comprar</button>
    <button>Alquilar</button>
    <button onclick="location.href='favoritos.php'">Favoritos</button>
  </div>

  <div class="grid">
    <?php while ($prop = $result->fetch_assoc()): ?>
      <div class="card">
        <img src="<?= htmlspecialchars($prop['imagen_url']) ?>" alt="<?= htmlspecialchars($prop['titulo']) ?>">
        <div class="card-body">
          <h4>
            <?= htmlspecialchars($prop['titulo']) ?>
            <?php if ($usuario_id): ?>
              <form action="guardar_favorito.php" method="POST" style="display:inline;">
                <input type="hidden" name="propiedad_id" value="<?= $prop['id'] ?>">
                <button type="submit" class="fav" style="background:none; border:none; color:<?= in_array($prop['id'], $favoritos) ? '#f44336' : '#ccc' ?>;">
                  <?= in_array($prop['id'], $favoritos) ? '♥' : '♡' ?>
                </button>
              </form>
            <?php endif; ?>
          </h4>
          <p>
            <?= htmlspecialchars($prop['descripcion']) ?><br>
            <?= $prop['habitaciones'] ?> hab · <?= $prop['banos'] ?> baños · <?= $prop['metros_cuadrados'] ?> m²<br>
            <?= number_format($prop['precio'], 0, ',', '.') ?> €
          </p>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>
</body>
</html>
