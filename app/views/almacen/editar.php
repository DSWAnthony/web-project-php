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
    $contenedor = $_POST['contenedor'];
    $estante = $_POST['estante'];
    $pasillo = $_POST['pasillo'];

    $sql = "UPDATE ubicacion_almacen 
            SET contenedor = :contenedor, estante = :estante, pasillo = :pasillo 
            WHERE ubicacion_id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':contenedor', $contenedor);
    $stmt->bindParam(':estante', $estante);
    $stmt->bindParam(':pasillo', $pasillo);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar.";
    }
} else {
    // Obtener datos actuales para mostrar en el formulario
    $sql = "SELECT * FROM ubicacion_almacen WHERE ubicacion_id = :id";
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
    <title>Editar Ubicación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Editar Ubicación</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Contenedor</label>
            <input type="text" name="contenedor" value="<?= $row['contenedor'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Estante</label>
            <input type="text" name="estante" value="<?= $row['estante'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pasillo</label>
            <input type="text" name="pasillo" value="<?= $row['pasillo'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>