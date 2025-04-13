<?php
require_once '../../config/conexion.php'; 

// Obtener el ID de la URL
$id = $_GET['id'];

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$conn = $conexion->Conectar();

// Usar una consulta preparada con PDO
$sql = "DELETE FROM ubicacion_almacen WHERE ubicacion_id = :id";
$stmt = $conn->prepare($sql);

// Vinculamos el parámetro de la consulta (de tipo entero)
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Ejecutamos la consulta
if ($stmt->execute()) {
    // Si la ejecución fue exitosa, redirigimos al usuario
    header("Location: index.php");
    exit();
} else {
    // Si ocurre un error, lo mostramos
    echo "Error al eliminar: " . $stmt->errorInfo()[2];
}

// Cerramos la conexión (no es estrictamente necesario en PDO)
$conn = null;
?>
