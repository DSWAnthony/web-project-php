<?php
require_once '../../views/layouts/header.php';
require_once '../../models/crud_zapato.php';

// Instancia del modelo
$modeloZapato = new CRUDZapato();

// Obtener los zapatos desde la base de datos
$zapatillas = $modeloZapato->ListarZapatillas();
?>
<link rel="stylesheet" href="../../../public/css/style.css">

<div class="container mt-5">
    <h1><i class="fas fa-shoe-prints"></i> Listado de Zapatillas</h1>

    <nav>
        <div class="d-flex justify-content-center mb-4">
            <div class="btn-group" role="group" aria-label="Botones Zapatillas">
                <button
                    type="button"
                    class="btn btn-outline-primary btn-zapato-registrar"
                    data-url="registrar_zapato.php"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Registrar una nueva zapatilla">
                    <i class="fas fa-plus"></i> Registrar
                </button>

                <button
                    type="button"
                    class="btn btn-outline-primary btn-zapato-consultar"
                    data-url="consultar_zapato.php"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Consultar zapatillas">
                    <i class="fas fa-search"></i> Consultar
                </button>

                <button
                    type="button"
                    class="btn btn-outline-primary btn-zapato-filtrar"
                    data-url="filtrar_zapato.php"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Filtrar zapatillas">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
        </div>
    </nav>

    <!-- Tabla de zapatillas -->
    <div class="d-flex justify-content-center">
        <div class="table-responsive" style="min-width: 800px;">
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Color</th>
                        <th>Precio</th>
                        <th>SKU</th>
                        <th>Talla</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zapatillas as $zapato): ?>
                        <tr>
                            <td><?= $zapato->zapato_id ?></td>
                            <td><?= $zapato->color ?></td>
                            <td>$<?= number_format($zapato->precio_comercial, 2) ?></td>
                            <td><?= $zapato->sku ?></td>
                            <td><?= $zapato->talla ?></td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-outline-info btn-sm btn-zapato-info btn-modal"
                                    data-id="<?= $zapato->zapato_id ?>"
                                    data-url="mostrar_zapato.php">
                                    <i class="fas fa-info"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-outline-success btn-sm btn-zapato-editar btn-modal"
                                    data-id="<?= $zapato->zapato_id ?>"
                                    data-url="editar_zapato.php">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <!-- Botón Eliminar -->
                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm btn-zapato-eliminar"
                                    data-id="<?= $zapato->zapato_id ?>"
                                    data-url="eliminar_zapato.php">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <!-- Aquí se cargará el formulario de edición -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (para AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluir script JS -->
<script>
    // Script para cargar contenido dinámico en el modal
    $(document).on('click', '.btn-modal', function() {
        const url = $(this).data('url'); // Obtener la URL del archivo a cargar
        const id = $(this).data('id'); // Obtener el ID del zapato (si existe)

        // Cargar el contenido del modal desde el archivo correspondiente
        $('#modalContent').load(url, {
            id: id
        });
    });
</script>

<script src="../../../public/js/zapato.js"></script>


</body>

</html>