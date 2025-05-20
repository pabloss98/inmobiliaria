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

    .user-info {
      color: white;
      font-size: 16px;
      margin-left: auto;
      display: flex;
      align-items: center;
    }

    .user-info a {
      color: #fff;
      font-weight: bold;
      margin-left: 10px;
      text-decoration: none;
    }

    .user-info a:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .hero h2 {
        font-size: 28px;
      }

      nav {
        margin-top: 10px;
        width: 100%;
        text-align: center;
      }

      nav a {
        display: inline-block;
        margin: 10px;
      }
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
      <a href="propiedades.php">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="contactos.php">Contacto</a>
    </nav>

    <!-- Verificar si el usuario está logueado y mostrar su nombre o los botones de login/registro -->
    <div class="user-info">
      <?php
if (isset($_SESSION['usuario_id'])) {
  echo 'Hola, ' . htmlspecialchars($_SESSION['nombre']);
  echo ' <a href="logout.php">Cerrar sesión</a>';
} else {
  echo '<a href="login.php">Login</a>';
  echo '<a href="registro.php">Registrarse</a>';
}
?>

  </header>



  <div class="grid">
    <?php while ($prop = $result->fetch_assoc()): ?>
  <div style="position: relative;">
    <?php if ($usuario_id): ?>
      <form action="guardar_favorito.php" method="POST" style="position: absolute; top: 10px; right: 10px; z-index: 2;">
        <input type="hidden" name="propiedad_id" value="<?= $prop['id'] ?>">
        <button type="submit" class="fav" style="background:none; border:none; font-size: 24px; color:<?= in_array($prop['id'], $favoritos) ? '#f44336' : '#ccc' ?>;">
          <?= in_array($prop['id'], $favoritos) ? '♥' : '♡' ?>
        </button>
      </form>
    <?php endif; ?>
    
    <a href="detalle_propiedad.php?id=<?= $prop['id'] ?>" style="text-decoration:none; color:inherit;">
      <div class="card">
        <img src="<?= htmlspecialchars($prop['imagen_url']) ?>" alt="<?= htmlspecialchars($prop['titulo']) ?>">
        <div class="card-body">
          <h4><?= htmlspecialchars($prop['titulo']) ?></h4>
          <p>
            <?= htmlspecialchars($prop['descripcion']) ?><br>
            <?= $prop['habitaciones'] ?> hab · <?= $prop['banos'] ?> baños · <?= $prop['metros_cuadrados'] ?> m²<br>
            <?= number_format($prop['precio'], 0, ',', '.') ?> €
          </p>
        </div>
      </div>
    </a>
  </div>
<?php endwhile; ?>

  </div>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>
</body>
</html>
