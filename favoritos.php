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
      margin-top: 40px;
    }
  </style>
</head>
<body>

  <header>
    <h1>ModernHouse</h1>
    <nav>
      <a href="index.html">Inicio</a>
      <a href="propiedades.html">Propiedades</a>
      <a href="favoritos.html">Favoritos</a>
      <a href="#">Contacto</a>
    </nav>
  </header>

  <section class="section">
    <h2>Tus Propiedades Favoritas</h2>

    <div class="grid">
      <div class="card">
        <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be" alt="Favorito 1">
        <div class="card-body">
          <h4>Estudio céntrico</h4>
          <p>Alquiler - $850/mes · 1 hab · 1 baño · 60 m²</p>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1600585153881-19c3e08a8b3e" alt="Favorito 2">
        <div class="card-body">
          <h4>Casa moderna suburbana</h4>
          <p>Alquiler - $1,800/mes · 4 hab · 3 baños · 210 m²</p>
        </div>
      </div>

      <div class="card">
        <img src="https://images.unsplash.com/photo-1600047509350-0e0d2e97f34b" alt="Favorito 3">
        <div class="card-body">
          <h4>Casa con piscina</h4>
          <p>Alquiler - $2,400/mes · 5 hab · 4 baños · 320 m²</p>
        </div>
      </div>
    </div>

    <!-- Si no hay favoritos, muestra este mensaje -->
    <!-- <div class="empty">Aún no has agregado ninguna propiedad a tus favoritos.</div> -->

  </section>

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
