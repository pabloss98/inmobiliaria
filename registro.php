<?php include 'includes/header.php'; ?>

<h2 class="mb-4">Registro de Usuario</h2>

<form class="row g-3" action="#" method="POST">
    <div class="col-md-6">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" required>
    </div>
    <div class="col-md-6">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com" required>
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