<!-- filepath: c:\xampp\htdocs\web-project-php\app\views\zapato\mostrar_zapato.php -->
<?php
require_once '../../models/crud_zapato.php';

// Verificar si se recibió el ID del zapato
if (isset($_POST['id']) && !empty($_POST['id'])) {
    $zapato_id = $_POST['id'];

    // Instancia del modelo
    $modeloZapato = new CRUDZapato();

    // Obtener los datos del zapato por ID
    $zapato = $modeloZapato->BuscarZapatoPorId($zapato_id);

    // Verificar si se encontró el zapato
    if ($zapato) {
        ?>
        <div class="modal-header">
            <h5 class="modal-title">Información del Zapato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Zapato ID: <?= htmlspecialchars($zapato->zapato_id) ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Color:</strong> <?= htmlspecialchars($zapato->color) ?></p>
                    <p><strong>Costo:</strong> $<?= number_format($zapato->costo, 2) ?></p>
                    <p><strong>Porcentaje de Ganancia:</strong> <?= htmlspecialchars($zapato->porcentaje_ganancia) ?>%</p>
                    <p><strong>Precio:</strong> $<?= number_format($zapato->precio, 2) ?></p>
                    <p><strong>SKU:</strong> <?= htmlspecialchars($zapato->sku) ?></p>
                    <p><strong>Talla:</strong> <?= htmlspecialchars($zapato->talla) ?></p>
                    <p><strong>Modelo ID:</strong> <?= htmlspecialchars($zapato->modelo_id) ?></p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        <?php
    } else {
        // Si no se encuentra el zapato
        ?>
        <div class="modal-header">
            <h5 class="modal-title">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>No se encontró el zapato con el ID proporcionado.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
        <?php
    }
} else {
    // Si no se recibe un ID válido
    ?>
    <div class="modal-header">
        <h5 class="modal-title">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <p>No se proporcionó un ID válido para el zapato.</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    </div>
    <?php
}
?>