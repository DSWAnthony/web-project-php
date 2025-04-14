<?php 
require_once '../../models/crud_categoria.php'; // Asegúrate de que esta ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'], $_POST['descripcion'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        try {
            // Conexión a la base de datos (ajustá estos datos a tu config real)
            $conn = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'usuario', 'contraseña');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insertar la categoría
            $stmt = $conn->prepare("INSERT INTO categoria (nombre, descripcion) VALUES (?, ?)");
            $resultado = $stmt->execute([$nombre, $descripcion]);

            if ($resultado) {
                echo "<div class='alert alert-success'>✅ Categoría registrada correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>❌ Error al registrar la categoría.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>❌ Error: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ Por favor completa todos los campos.</div>";
    }
}
?>

<!-- HTML del formulario -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow rounded">
            <div class="card-header">
                <h4>Registrar Nueva Categoría</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="#" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>