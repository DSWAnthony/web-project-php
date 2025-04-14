<?php 
require_once '../../config/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    // Conectar usando la clase Conexion
    $conexion = new Conexion();
    $pdo = $conexion->Conectar();

    try {
        // Preparar la consulta usando PDO
        $sql = "INSERT INTO categoria (nombre, descripcion) VALUES (:nombre, :descripcion)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        if ($stmt->execute()) {
            header("Location: indexCategoria.php"); // ✅ Corregido
            exit();
        } else {
            echo "Error al registrar la categoría.";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Categoría</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Registrar Nueva Categoría</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="indexCategoria.php" class="btn btn-secondary">Cancelar</a> <!-- ✅ Corregido -->
    </form>
</div>

</body>
</html>
