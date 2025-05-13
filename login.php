<?php
session_start();
include 'includes/header.php';
require 'includes/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT id, nombre, contraseña, rol_id, estado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (!$usuario['estado']) {
            $mensaje = 'Tu cuenta está desactivada.';
        } elseif (password_verify($password, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['rol_id'] = $usuario['rol_id'];

            if ($usuario['rol_id'] === 1) {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: cliente/panel.php");
            }
            exit();
        } else {
            $mensaje = 'Contraseña incorrecta.';
        }
    } else {
        $mensaje = 'Correo no registrado.';
    }
}
?>

<h2 class="mb-4">Iniciar Sesión</h2>

<?php if ($mensaje): ?>
    <div class="alert alert-danger"><?= $mensaje ?></div>
<?php endif; ?>

<form class="row g-3" method="POST">
    <div class="col-md-12">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="col-md-12">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </div>
    <div class="col-12">
        <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</form>

<?php include 'includes/footer.php'; ?>
