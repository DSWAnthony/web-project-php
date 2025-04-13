<?php
require_once '../../config/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos
    $contenedor = trim($_POST['contenedor']);
    $estante = trim($_POST['estante']);
    $pasillo = trim($_POST['pasillo']);

    // Conectar usando la clase Conexion
    $conexion = new Conexion();
    $pdo = $conexion->Conectar();

    try {
        // Preparar la consulta usando PDO
        $sql = "INSERT INTO ubicacion_almacen (contenedor, estante, pasillo) VALUES (:contenedor, :estante, :pasillo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':contenedor', $contenedor);
        $stmt->bindParam(':estante', $estante);
        $stmt->bindParam(':pasillo', $pasillo);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al registrar la ubicación.";
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
    <title>Registrar Ubicación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2>Registrar Nueva Ubicación</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="contenedor" class="form-label">Contenedor</label>
            <input type="text" name="contenedor" id="contenedor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="estante" class="form-label">Estante</label>
            <input type="text" name="estante" id="estante" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pasillo" class="form-label">Pasillo</label>
            <input type="text" name="pasillo" id="pasillo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>
