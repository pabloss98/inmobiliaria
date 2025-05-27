<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inmobiliaria ModernHouse</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
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

    .hero {
      background: url('https://images.unsplash.com/photo-1599423300746-b62533397364') no-repeat center center/cover;
      color: white;
      height: 60vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    }

    .hero h2 {
      font-size: 40px;
      text-align: center;
    }

    .section {
      padding: 40px 20px;
      max-width: 1200px;
      margin: auto;
    }

    .section h3 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #0d6efd;
    }

    .cards {
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

    footer {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }

    .buttons {
      margin-top: 10px;
    }

    .buttons a {
      background-color: #fff;
      color: #0d6efd;
      padding: 8px 16px;
      margin-left: 10px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .buttons a:hover {
      background-color: #e6e6e6;
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
      <a href="index.php">Inicio</a>
      <a href="propiedades.php">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="publicar.php">Publicar Propiedades</a>
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
    </div>
  </header>

  <section class="hero">
    <h2>Encuentra tu hogar ideal con facilidad</h2>
  </section>

  <section class="section">
    <h3>Propiedades Destacadas</h3>
    <div class="cards">
      <div class="card">
        <img src="imagenes/casa6.png" alt="Casa 1">
        <div class="card-body">
          <h4>Casa Familiar en las afueras</h4>
          <p>4 habitaciones · 3 baños · 250 m²</p>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1572120360610-d971b9d7767c" alt="Casa 2">
        <div class="card-body">
          <h4>Departamento moderno en el centro</h4>
          <p>2 habitaciones · 2 baños · 120 m²</p>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Casa 3">
        <div class="card-body">
          <h4>Ático con vista al mar</h4>
          <p>3 habitaciones · 2 baños · 180 m²</p>
        </div>
      </div>
    </div>
  </section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
