<?php
require_once '../../models/crud_almacen.php';

$crudAlmacen = new CRUDAlmacen();

try {
    // Verificar si se recibió una solicitud GET con el ID de la ubicación
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['id'])) {
        $id = intval($_GET['id']);

        // Buscar la ubicación por ID
        $ubicacion = $crudAlmacen->BuscarUbicacionPorId($id);

        if ($ubicacion) {
            // Mostrar los detalles de la ubicación en un card
            ?>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Detalles de la Ubicación</h5>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> <?= htmlspecialchars($ubicacion->ubicacion_id) ?></p>
                    <p><strong>Contenedor:</strong> <?= htmlspecialchars($ubicacion->contenedor) ?></p>
                    <p><strong>Estante:</strong> <?= htmlspecialchars($ubicacion->estante) ?></p>
                    <p><strong>Pasillo:</strong> <?= htmlspecialchars($ubicacion->pasillo) ?></p>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="alert alert-danger">No se encontró la ubicación con el ID proporcionado.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">El ID de la ubicación es obligatorio.</div>';
    }
} catch (Exception $e) {
    // Capturar cualquier excepción y mostrar un mensaje de error
    echo '<div class="alert alert-danger">Error en el servidor: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>

<script>
    $(document).on('click', '.btn-ver-detalles', function () {
    const id = $(this).data('id'); // Obtener el ID de la ubicación
    const url = 'mostrar_almacen.php'; // URL del archivo PHP que devuelve los detalles
    console.log('Cargando detalles para ID:', id);

    // Mostrar mensaje de carga en el modal
    $('#modalContentUbicacion').html('<p>Cargando detalles...</p>');

    // Realizar la solicitud AJAX para obtener los detalles
    $.ajax({
        url: url,
        method: 'GET',
        data: { id: id }, // Enviar el ID de la ubicación
        success: function (data) {
            // Cargar los datos recibidos en el modal
            $('#modalContentUbicacion').html(data);
        },
        error: function (xhr, status, error) {
            console.error('Error al cargar los detalles:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            $('#modalContentUbicacion').html('<p>Error al cargar los detalles. Por favor, inténtelo de nuevo.</p>');
        }
    });
});
</script>