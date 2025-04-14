<?php
require_once '../../models/crud_zapato.php';

$crud = new CRUDZapato();

// Verificar si se pasó el ID del zapato
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $zapato = $crud->BuscarZapatoPorId($id);  // Obtener los datos del zapato por ID

    // Si se encuentra el zapato, mostramos sus detalles
    if ($zapato) {
        ?>
        <div class="modal-header">
            <h5 class="modal-title">Detalles del Zapato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <p><strong>Color:</strong> <?= $zapato->color ?></p>
            <p><strong>Precio Comercial:</strong> $<?= number_format($zapato->precio_comercial, 2) ?></p>
            <p><strong>SKU:</strong> <?= $zapato->sku ?></p>
            <p><strong>Talla:</strong> <?= $zapato->talla ?></p>
            <!-- Eliminamos la visualización del modelo_id porque está fijo -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        <?php
    } else {
        echo "<p>No se encontró el zapato con ID $id.</p>";
    }
}
?>
