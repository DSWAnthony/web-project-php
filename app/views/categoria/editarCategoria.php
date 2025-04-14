<?php
include '../../config/conexion.php'; 

$conexion = new Conexion();
$pdo = $conexion->Conectar();

$id = $_GET['id'] ?? null;

// Validar que haya un ID
if (!$id) {
    echo "ID no proporcionado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE categoria 
            SET nombre = :nombre, descripcion = :descripcion 
            WHERE categoria_id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: indexCategoria.php"); // CORREGIDO
        exit();
    } else {
        echo "Error al actualizar.";
    }
} else {
    // Obtener datos actuales para mostrar en el formulario
    $sql = "SELECT * FROM categoria WHERE categoria_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();

    if (!$row) {
        echo "Registro no encontrado.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Editar Categoría</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($row['descripcion']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="indexCategoria.php" class="btn btn-secondary">Cancelar</a> <!-- CORREGIDO -->
    </form>
</div>
</body>
</html>
