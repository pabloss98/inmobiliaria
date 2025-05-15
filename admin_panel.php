<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel de Administración | ModernHouse</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; margin: 0; }
    header, footer {
      background-color: #0d6efd; color: white; padding: 20px; text-align: center;
    }
    main { max-width: 1000px; margin: 40px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #0d6efd; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
    th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    form.inline { display: inline; }
    button { background: #0d6efd; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; }
    button.danger { background: #dc3545; }
    button.success { background: #28a745; }
  </style>
</head>
<body>

<header>
  <h1>Panel de Administración</h1>
</header>

<main>
  <!-- Aprobar o Rechazar Propiedades -->
  <h2>Propiedades Pendientes</h2>
  <?php
  $res = $conexion->query("SELECT * FROM propiedades WHERE estado = 'pendiente'");
  if ($res->num_rows > 0):
  ?>
  <table>
    <tr><th>Título</th><th>Acciones</th></tr>
    <?php while ($p = $res->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($p['titulo']) ?></td>
        <td>
          <form class="inline" method="POST" action="acciones_admin.php">
            <input type="hidden" name="accion" value="aprobar_propiedad">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button class="success">Aprobar</button>
          </form>
          <form class="inline" method="POST" action="acciones_admin.php">
            <input type="hidden" name="accion" value="rechazar_propiedad">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button class="danger">Rechazar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  <?php else: echo "<p>No hay propiedades pendientes.</p>"; endif; ?>

  <!-- Activar/Desactivar Usuarios -->
  <h2>Gestión de Usuarios</h2>
  <?php
  $res = $conexion->query("SELECT * FROM usuarios WHERE rol_id = 'usuario'");
  ?>
  <table>
    <tr><th>Nombre</th><th>Email</th><th>Estado</th><th>Acción</th></tr>
    <?php while ($u = $res->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($u['nombre']) ?></td>
        <td><?= htmlspecialchars($u['email']) ?></td>
        <td><?= $u['estado'] ?></td>
        <td>
          <form class="inline" method="POST" action="acciones_admin.php">
            <input type="hidden" name="accion" value="cambiar_estado_usuario">
            <input type="hidden" name="id" value="<?= $u['id'] ?>">
            <input type="hidden" name="nuevo_estado" value="<?= $u['estado'] === 'activo' ? 'inactivo' : 'activo' ?>">
            <button><?= $u['estado'] === 'activo' ? 'Desactivar' : 'Activar' ?></button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <!-- Eliminar Propiedades -->
  <h2>Eliminar Propiedades</h2>
  <?php
  $res = $conexion->query("SELECT * FROM propiedades WHERE estado = 'aprobado'");
  ?>
  <table>
    <tr><th>Título</th><th>Acción</th></tr>
    <?php while ($p = $res->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($p['titulo']) ?></td>
        <td>
          <form method="POST" action="acciones_admin.php">
            <input type="hidden" name="accion" value="eliminar_propiedad">
            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <button class="danger">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
</main>

<footer>
  &copy; 2025 ModernHouse - Panel de administrador
</footer>

</body>
</html>
