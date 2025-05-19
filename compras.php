<?php
// comprar.php

$conexion = new mysqli("localhost", "root", "", "inmobiliaria");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$usuario_id = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $propiedad_id = intval($_POST['propiedad_id']);

    $stmt = $conexion->prepare("SELECT precio FROM propiedades WHERE id = ?");
    $stmt->bind_param("i", $propiedad_id);
    $stmt->execute();
    $stmt->bind_result($precio);
    $stmt->fetch();
    $stmt->close();

    if ($precio !== null) {
        $stmt = $conexion->prepare("INSERT INTO compras (propiedad_id, comprador_id, precio_final) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $propiedad_id, $usuario_id, $precio);
        if ($stmt->execute()) {
            $mensaje = "<p class='exito'>¡Compra realizada con éxito!</p>";
        } else {
            $mensaje = "<p class='error'>Error al realizar la compra.</p>";
        }
        $stmt->close();
    } else {
        $mensaje = "<p class='error'>Propiedad no válida.</p>";
    }
}

$resultado = $conexion->query("SELECT id, titulo, precio, imagen_url FROM propiedades");
$propiedades = [];
while ($row = $resultado->fetch_assoc()) {
    $propiedades[] = $row;
}
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprar Propiedad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: white;
            padding: 20px;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        select, button {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .imagen-container {
            margin-top: 20px;
        }
        .imagen-container img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .exito {
            color: green;
            font-weight: bold;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Comprar una Propiedad</h2>
    <?= isset($mensaje) ? $mensaje : '' ?>

    <form method="POST" action="comprar.php">
        <label for="propiedad_id">Seleccione una propiedad:</label>
        <select name="propiedad_id" id="propiedad_id" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($propiedades as $p): ?>
                <option value="<?= $p['id'] ?>" data-img="<?= $p['imagen_url'] ?>">
                    <?= htmlspecialchars($p['titulo']) ?> - <?= number_format($p['precio'], 2) ?> €
                </option>
            <?php endforeach; ?>
        </select>

        <div class="imagen-container" id="imagen-container" style="display: none;">
            <img id="imagen-propiedad" src="" alt="Imagen de la propiedad">
        </div>

        <button type="submit">Comprar</button>
    </form>

    <script>
        const selector = document.getElementById("propiedad_id");
        const contenedorImagen = document.getElementById("imagen-container");
        const imagen = document.getElementById("imagen-propiedad");

        selector.addEventListener("change", function() {
            const selectedOption = selector.options[selector.selectedIndex];
            const imgUrl = selectedOption.getAttribute("data-img");

            if (imgUrl) {
                imagen.src = imgUrl;
                contenedorImagen.style.display = "block";
            } else {
                contenedorImagen.style.display = "none";
                imagen.src = "";
            }
        });
    </script>

</body>
</html>
