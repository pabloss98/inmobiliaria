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
      <a href="propiedades.php">Propiedades</a>
      <a href="favoritos.php">Favoritos</a>
      <a href="contactos.php">Contacto</a>
    </nav>
  </header>

  <div class="filters">
    <button>Todos</button>
    <button>Comprar</button>
    <button>Alquilar</button>
    <button>Favoritos</button>
  </div>

  <div class="grid">
    <div class="card">
      <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7" alt="Propiedad 1">
      <div class="card-body">
        <h4>Casa en las afueras <span class="fav">♡</span></h4>
        <p>Compra - $250,000 · 4 hab · 3 baños · 250 m²</p>
      </div>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1572120360610-d971b9d7767c" alt="Propiedad 2">
      <div class="card-body">
        <h4>Departamento en el centro <span class="fav">♡</span></h4>
        <p>Alquiler - $1,200/mes · 2 hab · 2 baños · 120 m²</p>
      </div>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" alt="Propiedad 3">
      <div class="card-body">
        <h4>Ático con vista al mar <span class="fav">♡</span></h4>
        <p>Compra - $320,000 · 3 hab · 2 baños · 180 m²</p>
      </div>
    </div>

    <div class="card">
      <img src="https://images.unsplash.com/photo-1600585153881-19c3e08a8b3e" alt="Propiedad 4">
      <div class="card-body">
        <h4>Casa moderna suburbana <span class="fav">♡</span></h4>
        <p>Alquiler - $1,800/mes · 4 hab · 3 baños · 210 m²</p>
      </div>
    </div>

    <div class="card">
  <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914" alt="Propiedad 5">
  <div class="card-body">
    <h4>Loft industrial <span class="fav">♡</span></h4>
    <p>Compra - $210,000 · 2 hab · 1 baño · 95 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1600047509350-0e0d2e97f34b" alt="Propiedad 6">
  <div class="card-body">
    <h4>Casa con piscina <span class="fav">♡</span></h4>
    <p>Alquiler - $2,400/mes · 5 hab · 4 baños · 320 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1613977257363-bf3f71bbdc20" alt="Propiedad 7">
  <div class="card-body">
    <h4>Departamento minimalista <span class="fav">♡</span></h4>
    <p>Compra - $185,000 · 1 hab · 1 baño · 70 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1625813571953-b4f91ae0f2be" alt="Propiedad 8">
  <div class="card-body">
    <h4>Casa rústica en montaña <span class="fav">♡</span></h4>
    <p>Compra - $275,000 · 3 hab · 2 baños · 200 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1559599189-8c3e3d76a9f2" alt="Propiedad 9">
  <div class="card-body">
    <h4>Casa estilo colonial <span class="fav">♡</span></h4>
    <p>Alquiler - $1,500/mes · 4 hab · 3 baños · 220 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1507089947368-19c1da9775ae" alt="Propiedad 10">
  <div class="card-body">
    <h4>Ático en la ciudad <span class="fav">♡</span></h4>
    <p>Compra - $295,000 · 2 hab · 2 baños · 150 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1588854337236-f44aa2c71ba3" alt="Propiedad 11">
  <div class="card-body">
    <h4>Residencia de lujo <span class="fav">♡</span></h4>
    <p>Compra - $950,000 · 6 hab · 5 baños · 500 m²</p>
  </div>
</div>

<div class="card">
  <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be" alt="Propiedad 12">
  <div class="card-body">
    <h4>Estudio céntrico <span class="fav">♡</span></h4>
    <p>Alquiler - $850/mes · 1 hab · 1 baño · 60 m²</p>
  </div>
</div>

  </div>

  

  <footer>
    © 2025 ModernHouse - Todos los derechos reservados.
  </footer>

</body>
</html>
