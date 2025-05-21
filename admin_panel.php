<?php
session_start();
require 'includes/conexion.php';

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
  header("Location: index.php");
  exit();
}

// Consultas
$sql = "SELECT s.id, s.estado, s.fecha_solicitud, s.tipo_operacion, p.titulo, u.nombre 
        FROM solicitudes s
        JOIN propiedades p ON s.propiedad_id = p.id
        LEFT JOIN usuarios u ON s.usuario_id = u.id
        ORDER BY s.fecha_solicitud DESC";
$result = $conexion->query($sql);

$pubs = $conexion->query("SELECT p.id, p.titulo, p.precio, p.estado, u.nombre 
                          FROM propiedades p 
                          LEFT JOIN usuarios u ON p.usuario_id = u.id 
                          WHERE p.estado = 'pendiente'
                          ORDER BY p.id DESC");


$users = $conexion->query("SELECT id, nombre, email, rol_id FROM usuarios ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Administración</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #0d6efd;
      color: white;
      padding: 20px 40px;
      text-align: center;
    }

    header h1 {
      margin: 0;
    }

    header div {
      margin-top: 10px;
    }

    header button {
      background-color: white;
      border: 2px solid #0d6efd;
      color: #0d6efd;
      padding: 8px 16px;
      margin: 5px;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    header button:hover {
      background-color: #0d6efd;
      color: white;
    }

    header form button {
      background-color: #dc3545;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      margin-left: 10px;
      transition: background-color 0.3s;
    }

    header form button:hover {
      background-color: #b52a33;
    }

    h2 {
      color: #333;
      text-align: center;
      margin-top: 30px;
      margin-bottom: 20px;
    }

    table {
      width: 95%;
      margin: 0 auto 40px auto;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #eaeaea;
    }

    th {
      background-color: #0d6efd;
      color: white;
      font-weight: 600;
    }

    tr:hover {
      background-color: #f0f8ff;
    }

    form {
      display: inline;
    }

    button[name="accion"][value="aceptar"] {
      background-color: #198754;
      color: white;
      border: none;
      padding: 6px 12px;
      margin: 0 4px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
    }

    button[name="accion"][value="rechazar"] {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 6px 12px;
      margin: 0 4px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      tr {
        margin-bottom: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        border-radius: 8px;
        padding: 10px;
        background: white;
      }

      th {
        display: none;
      }

      td {
        padding: 10px;
        border-bottom: none;
        position: relative;
      }

      td::before {
        content: attr(data-label);
        font-weight: bold;
        color: #555;
        display: block;
        margin-bottom: 5px;
      }
    }
  </style>
</head>
<body>

<header>
  <h1>Panel de Administración</h1>
  <div>
    <button onclick="mostrarSeccion('solicitudes')">Ventas/Alquileres</button>
    <button onclick="mostrarSeccion('publicaciones')">Publicaciones</button>
    <button onclick="mostrarSeccion('usuarios')">Usuarios</button>
    <form action="logout.php" method="POST" style="display:inline;">
      <button type="submit">Cerrar sesión</button>
    </form>
  </div>
</header>

<!-- SECCIÓN: Solicitudes -->
<div id="solicitudes" class="seccion">
  <h2>Solicitudes de Compra/Alquiler</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Propiedad</th>
        <th>Usuario</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($sol = $result->fetch_assoc()): ?>
        <tr>
          <td data-label="ID"><?= $sol['id'] ?></td>
          <td data-label="Propiedad"><?= htmlspecialchars($sol['titulo']) ?></td>
          <td data-label="Usuario"><?= htmlspecialchars($sol['nombre'] ?? 'Invitado') ?></td>
          <td data-label="Tipo"><?= ucfirst($sol['tipo_operacion']) ?></td>
          <td data-label="Estado"><?= isset($sol['estado']) ? ucfirst($sol['estado']) : '—' ?></td>
          <td data-label="Fecha"><?= $sol['fecha_solicitud'] ?></td>
          <td data-label="Acciones">
            <?php if (isset($sol['estado']) && $sol['estado'] === 'pendiente'): ?>
              <form action="procesar_solicitud.php" method="POST">
                <input type="hidden" name="id" value="<?= $sol['id'] ?>">
                <button name="accion" value="aceptar">Aceptar</button>
                <button name="accion" value="rechazar">Rechazar</button>
              </form>
            <?php else: ?>
              —
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- SECCIÓN: Publicaciones -->
<div id="publicaciones" class="seccion" style="display:none;">
  <h2>Publicaciones de Propiedades</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Precio</th>
        <th>Usuario</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($p = $pubs->fetch_assoc()): ?>
        <tr>
          <td data-label="ID"><?= $p['id'] ?></td>
          <td data-label="Título"><?= htmlspecialchars($p['titulo']) ?></td>
          <td data-label="Precio"><?= number_format($p['precio'], 2) ?> €</td>
          <td data-label="Usuario"><?= htmlspecialchars($p['nombre'] ?? 'Invitado') ?></td>
          <td data-label="Estado"><?= isset($p['estado']) ? ucfirst($p['estado']) : '—' ?></td>
          <td data-label="Acciones">
            <form action="aprobar_publicacion.php" method="POST" style="display:inline;">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <button name="accion" value="aceptar">Aceptar</button>
              <button name="accion" value="rechazar">Rechazar</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- SECCIÓN: Usuarios -->
<div id="usuarios" class="seccion" style="display:none;">
  <h2>Usuarios Registrados</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($u = $users->fetch_assoc()): ?>
        <tr>
          <td data-label="ID"><?= $u['id'] ?></td>
          <td data-label="Nombre"><?= htmlspecialchars($u['nombre']) ?></td>
          <td data-label="Email"><?= htmlspecialchars($u['email']) ?></td>
          <td data-label="Rol"><?= $u['rol_id'] == 1 ? 'Admin' : 'Usuario' ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script>
  function mostrarSeccion(id) {
    document.querySelectorAll('.seccion').forEach(seccion => {
      seccion.style.display = 'none';
    });
    document.getElementById(id).style.display = 'block';
  }
</script>

</body>
</html>
