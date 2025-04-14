<?php
require_once '../../models/crud_zapato.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se recibió un filtro de color
    if (isset($_POST['color']) && !empty($_POST['color'])) {
        $color = $_POST['color'];

        // Instancia del modelo
        $modeloZapato = new CRUDZapato();

        // Obtener los zapatos que coincidan con el color
        $zapatillas = $modeloZapato->FiltrarZapatosPorColor($color);

        // Verificar si se encontraron resultados
        if (!empty($zapatillas)) {
            // Generar la tabla con los resultados
            echo '<table class="table table-bordered">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>ID</th>';
            echo '<th>Color</th>';
            echo '<th>Costo</th>';
            echo '<th>Precio</th>';
            echo '<th>SKU</th>';
            echo '<th>Talla</th>';
            echo '<th>Modelo</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($zapatillas as $zapato) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($zapato->zapato_id) . '</td>';
                echo '<td>' . htmlspecialchars($zapato->color) . '</td>';
                echo '<td>$' . number_format($zapato->costo, 2) . '</td>';
                echo '<td>$' . number_format($zapato->precio, 2) . '</td>';
                echo '<td>' . htmlspecialchars($zapato->sku) . '</td>';
                echo '<td>' . htmlspecialchars($zapato->talla) . '</td>';
                echo '<td>' . htmlspecialchars($zapato->modelo_nombre) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            // Mostrar mensaje si no se encontraron resultados
            echo '<div class="alert alert-warning">No se encontraron zapatillas con el color ingresado.</div>';
        }
    } else {
        // Mostrar mensaje si no se proporcionó un filtro de color
        echo '<div class="alert alert-danger">Por favor, ingrese un color para filtrar.</div>';
    }
    exit;
}
?>

<!-- Modal para ingresar el filtro de color -->
<div class="modal-header">
    <h5 class="modal-title">Filtrar Zapatillas por Color</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
</div>
<div class="modal-body">
    <form id="formFiltrarZapato">
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control" id="color" name="color" placeholder="Ingrese parte del color (ej. 'roj')" required>
        </div>
    </form>
    <div id="resultadosFiltro" class="mt-4">
        <!-- Aquí se mostrarán los resultados de la tabla -->
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-primary" id="btnFiltrarZapato">Filtrar</button>
</div>