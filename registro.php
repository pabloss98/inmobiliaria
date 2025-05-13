<?php
session_start();
include 'includes/header.php';
require 'includes/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    if ($password !== $confirmar) {
        $mensaje = 'Las contraseñas no coinciden.';
    } else {
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = 'Este correo ya está registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $rol_id = 2; // 2 = cliente por defecto
            $estado = 1;

            $insert = $conexion->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol_id, estado) VALUES (?, ?, ?, ?, ?)");
            $insert->bind_param("sssii", $nombre, $email, $hash, $rol_id, $estado);

            if ($insert->execute()) {
                header("Location: login.php?registro=exitoso");
                exit();
            } else {
                $mensaje = 'Error al registrar. Intenta de nuevo.';
            }
        }
    }
}
?>

<h2 class="mb-4">Registro de Usuario</h2>

<?php if ($mensaje): ?>
    <div class="alert alert-danger"><?= $mensaje ?></div>
<?php endif; ?>

<form class="row g-3" method="POST">
    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="col-md-6">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="col-md-6">
        <label for="confirmar" class="form-label">Confirmar contraseña</label>
        <input type="password" class="form-control" id="confirmar" name="confirmar" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>
