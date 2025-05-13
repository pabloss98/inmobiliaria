<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contacto | ModernHouse</title>
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
      max-width: 600px;
      margin: 60px auto;
      padding: 40px 30px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .section h2 {
      margin-bottom: 20px;
      font-size: 26px;
      color: #0d6efd;
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    input, textarea {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      width: 100%;
    }

    textarea {
      resize: vertical;
      min-height: 120px;
    }

    button {
      background-color: #0d6efd;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #084edb;
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
      <a href="#">Contacto</a>
    </nav>
  </header>

  <section class="section">
    <h2>Contáctanos</h2>
    <form action="#" method="post">
      <input type="text" name="nombre" placeholder="Tu nombre" required />
      <input type="email" name="email" placeholder="Tu correo electrónico" required />
      <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
      <button type="submit">Enviar mensaje</button>
    </form>
  </section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
