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

    button.operation-btn {
      margin-top: 15px;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
    }
    button.buy {
      background-color: #0d6efd;
      color: white;
    }
    button.rent {
      background-color: #ffc107;
      color: black;
    }

    /* Estilo para mostrar el nombre del usuario */
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
  </style>
</head>
<body>

  <header>
    <h1>ModernHouse</h1>
    <nav>
      <a href="#">Inicio</a>
      <a href="propiedades.php">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="contactos.php">Contacto</a>
    </nav>

    <!-- Verificar si el usuario está logueado y mostrar su nombre o los botones de login/registro -->
    <div class="user-info">
      <?php
      session_start();
      if (isset($_SESSION['usuario_id'])) {
        echo 'Hola, ' . htmlspecialchars($_SESSION['nombre']);
        echo ' <a href="logout.php">Cerrar sesión</a>';
      } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="registro.php">Registrarse</a>';
      }
      ?>
    </div>
  </header>

  <section class="detalle">
  <img src="<?= htmlspecialchars($prop['imagen_url']) ?>" alt="<?= htmlspecialchars($prop['titulo']) ?>">
  <h2><?= htmlspecialchars($prop['titulo']) ?></h2>
  <p><?= htmlspecialchars($prop['descripcion']) ?></p>
  <p><?= $prop['habitaciones'] ?> hab · <?= $prop['banos'] ?> baños · <?= $prop['metros_cuadrados'] ?> m²</p>
  <p><strong><?= number_format($prop['precio'], 0, ',', '.') ?> €</strong></p>

<?php if (isset($prop['tipo_operacion'])): ?>
  <?php if (isset($_SESSION['usuario_id'])): ?>
    <form action="enviar_solicitud.php" method="POST">
      <input type="hidden" name="propiedad_id" value="<?= $prop['id'] ?>">
      <input type="hidden" name="tipo_operacion" value="<?= $prop['tipo_operacion'] ?>">
      <button type="submit" name="solicitar" class="operation-btn <?= $prop['tipo_operacion'] === 'venta' ? 'buy' : 'rent' ?>">
        <?= $prop['tipo_operacion'] === 'venta' ? 'Comprar' : 'Alquilar' ?>
      </button>
    </form>
  <?php else: ?>
    <p style="margin-top: 15px; font-weight: bold; color: #dc3545;">
      Debes iniciar sesión para <?= $prop['tipo_operacion'] === 'venta' ? 'comprar' : 'alquilar' ?> esta propiedad.
    </p>
    <a href="login.php" style="display:inline-block; margin-top:10px; padding:10px 20px; background-color:#0d6efd; color:white; border-radius:8px; text-decoration:none;">
      Iniciar sesión
    </a>
  <?php endif; ?>
<?php endif; ?>


  <a href="propiedades.php" class="back-link">← Volver a Propiedades</a>
</section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
