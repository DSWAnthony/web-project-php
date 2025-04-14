<?php
require_once '../../models/crud_zapato.php';

$crud = new CRUDZapato();

// Verificar si se pasó el ID del zapato
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $resultado = $crud->EliminarZapato($id);  // Eliminar el zapato

    // Enviar respuesta en formato JSON
    echo json_encode([
        'success' => $resultado,
        'message' => $resultado ? 'Zapato eliminado correctamente.' : 'Hubo un error al eliminar el zapato.'
    ]);
} else {
    // Si no se pasó el ID, enviamos un error
    echo json_encode([
        'success' => false,
        'message' => 'ID de zapato no proporcionado.'
    ]);
}
?>
