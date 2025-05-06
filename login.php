<?php include 'includes/header.php'; ?>

<h2 class="mb-4">Iniciar Sesión</h2>

<form class="row g-3" action="#" method="POST">
    <div class="col-md-12">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com" required>
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
