<?php
require_once '../../config/conexion.php'; 


$id = $_GET['id'];

$conexion = new Conexion();
$conn = $conexion->Conectar();

// Usar una consulta preparada con PDO
$sql = "DELETE FROM categoria WHERE categoria_id = :id";
$stmt = $conn->prepare($sql);

// Vinculamos el parámetro de la consulta (de tipo entero)
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {

    header("Location: indexCategoria.php"); 
    exit();
} else {
    // Si ocurre un error, lo mostramos
    echo "Error al eliminar: " . $stmt->errorInfo()[2];
}

// Cerramos la conexión
$conn = null;
?>
