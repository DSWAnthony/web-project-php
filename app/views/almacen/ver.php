<?php

include '../../config/conexion.php'; 

// Obtener el ID de la URL
$id = $_GET['id'];

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$conn = $conexion->Conectar();

// Consulta preparada con PDO
$sql = "SELECT * FROM ubicacion_almacen WHERE ubicacion_id = :id";
$stmt = $conn->prepare($sql);

// Vincular el parámetro
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Ubicación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Detalles de la Ubicación</h2>
    <!-- Mostrar los detalles de la ubicación -->
    <p><strong>ID:</strong> <?= $row['ubicacion_id'] ?></p>
    <p><strong>Contenedor:</strong> <?= $row['contenedor'] ?></p>
    <p><strong>Estante:</strong> <?= $row['estante'] ?></p>
    <p><strong>Pasillo:</strong> <?= $row['pasillo'] ?></p>
    <!-- Botón para regresar -->
    <a href="index.php" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>
