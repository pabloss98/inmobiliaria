<?php
session_start();
require 'includes/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT id, nombre, email, contraseña, rol_id, estado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (strtolower($usuario['estado']) !== 'activo') {
            $mensaje = 'Tu cuenta está desactivada.';
        } elseif (password_verify($password, $usuario['contraseña'])) {
            // Inicio de sesión exitoso
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol_id'] = $usuario['rol_id'];

            // Redirigir según el rol
            if ($usuario['rol_id'] == 1) {
                header("Location: admin_panel.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $mensaje = 'Contraseña incorrecta.';
        }
    } else {
        $mensaje = 'Correo no registrado.';
    }
}

// Ahora incluimos el header HTML (después de haber gestionado el POST)
include 'includes/header.php';
?>

<style>
    footer {
        background-color: #0d6efd;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 350px;
    }
</style>

<main class="container my-5">
    <h2 class="mb-4">Iniciar Sesión</h2>

    <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" class="row g-3">
        <div class="col-md-12">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="col-md-12">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        <div class="col-12">
            <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </form>
</main>

<footer>
    © 2025 ModernHouse - Todos los derechos reservados.
</footer>
</body>
</html>
