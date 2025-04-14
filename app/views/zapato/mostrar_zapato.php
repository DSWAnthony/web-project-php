<?php
require_once '../../models/crud_zapato.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $zapato_id = $_POST['id'];

    // Instancia del modelo
    $modeloZapato = new CRUDZapato();

    // Obtener los datos del zapato por ID
    $zapato = $modeloZapato->BuscarZapatoPorId($zapato_id);

    // Verificar si se encontró el zapato
    if ($zapato): ?>
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
                <p><strong>Modelo:</strong> <?= htmlspecialchars($zapato->modelo_nombre) ?></p>
            </div>
        </div>
    <?php else: ?>
        <p>No se encontró el zapato con el ID proporcionado.</p>
    <?php endif;
} else {
    echo '<p>No se proporcionó un ID válido para el zapato.</p>';
}
?>