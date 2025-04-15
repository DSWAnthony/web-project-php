<?php
require_once '../../models/crud_almacen.php';

$crudAlmacen = new CRUDAlmacen();

try {
    // Verificar si se recibió una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['id'])) {
            $id = intval($_POST['id']); // Convertir el ID a un entero

            // Llamar al método para eliminar la ubicación
            $resultado = $crudAlmacen->EliminarUbicacion($id);

            if ($resultado) {
                // Respuesta en formato JSON indicando éxito
                echo json_encode([
                    'success' => true,
                    'message' => 'La ubicación ha sido eliminada correctamente.'
                ]);
            } else {
                // Respuesta en formato JSON indicando error
                echo json_encode([
                    'success' => false,
                    'message' => 'No se pudo eliminar la ubicación. Por favor, inténtelo de nuevo.'
                ]);
            }
        } else {
            // Respuesta en formato JSON indicando que falta el ID
            echo json_encode([
                'success' => false,
                'message' => 'El ID de la ubicación es obligatorio.'
            ]);
        }
    } else {
        // Respuesta en formato JSON indicando que no es una solicitud POST
        echo json_encode([
            'success' => false,
            'message' => 'Solicitud inválida. Solo se permiten solicitudes POST.'
        ]);
    }
} catch (Exception $e) {
    // Capturar cualquier excepción y devolver un mensaje de error
    echo json_encode([
        'success' => false,
        'message' => 'Error en el servidor: ' . $e->getMessage()
    ]);
}