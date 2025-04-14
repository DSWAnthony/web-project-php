<?php
include '../../config/conexion.php'; 

// Validar que el ID exista
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no proporcionado.";
    exit();
}

$conexion = new Conexion();
$conn = $conexion->Conectar();

// Consulta preparada con PDO
$sql = "SELECT * FROM categoria WHERE categoria_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    echo "Categoría no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Categoría</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Detalles de la Categoría</h2>
    <p><strong>ID:</strong> <?= htmlspecialchars($row['categoria_id']) ?></p>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($row['nombre']) ?></p>
    <p><strong>Descripción:</strong> <?= htmlspecialchars($row['descripcion']) ?></p>
    <a href="indexCategoria.php" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
