<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>InmoFácil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="/css/estilos.css">
</head>
 <style>
  /* Forzar que el body ocupe toda la altura y use flex para ordenar contenido */
  html, body {
    height: 100%;
    margin: 0;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    font-family: Arial, sans-serif;
  }

  main {
    flex: 1; /* Esto hace que main tome todo el espacio disponible */
    padding: 20px;
  }

  footer {
    background-color: #1e90ff; /* azul */
    color: white;
    text-align: center;
    padding: 15px 10px;
    font-weight: bold;
    flex-shrink: 0; /* evita que se encoja */
  }

  /* Opcionales para el formulario */
  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
  }

  label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
  }

  input[type="email"], input[type="password"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  button.btn-primary {
    background-color: #1e90ff;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
  }

  button.btn-primary:hover {
    background-color: #1c86ee;
  }

  p.mt-3 {
    margin-top: 1rem;
  }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">ModernHouse</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container my-4">
