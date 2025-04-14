<?php
require_once '../../views/layouts/header.php';
require_once '../../models/crud_zapato.php';

// Instancia del modelo
$modeloZapato = new CRUDZapato();

// Obtener todos los zapatos
$zapatillas = $modeloZapato->ListarZapatillas();
?>
<link rel="stylesheet" href="../../../public/css/style.css">

<div class="container mt-5">
    <h1><i class="fas fa-shoe-prints"></i> Listado de Zapatillas</h1>

    <nav>
        <div class="d-flex justify-content-center mb-4">
            <div class="btn-group" role="group" aria-label="Botones Zapatillas">
                <!-- Botón Registrar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-registrar" 
                    data-url="registrar_zapato.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Registrar un nuevo zapato">
                    <i class="fas fa-plus"></i> Registrar
                </button>

                <!-- Botón Consultar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-consultar" 
                    data-url="consultar_zapato.php" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Consultar un zapato">
                    <i class="fas fa-search"></i> Consultar
                </button>

                <!-- Botón Filtrar -->
                <button 
                    type="button" 
                    class="btn btn-outline-primary btn-filtrar" 
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
                        <th>Modelo</th>
                        <th>Precio Venta</th>
                        
                        <th>Talla</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($zapatillas as $zapato): ?>
                        <tr>
                            <td><?= $zapato->zapato_id ?></td>
                            <td><?= $zapato->modelo_nombre ?></td>
                            <td>$<?= number_format($zapato->precio, 2) ?></td>
                            
                            <td><?= $zapato->talla ?></td>
                            <td>
                                <!-- Botón Información -->
                                <button 
                                    type="button" 
                                    class="btn btn-outline-info btn-sm btn-modal" 
                                    data-id="<?= $zapato->zapato_id ?>" 
                                    data-url="mostrar_zapato.php">
                                    <i class="fas fa-info"></i>
                                </button>

                                <!-- Botón Editar -->
                                <button 
                                    type="button" 
                                    class="btn btn-outline-success btn-sm btn-editar" 
                                    data-id="<?= $zapato->zapato_id ?>" 
                                    data-url="editar_zapato.php">
                                    <i class="fa-solid fa-pen"></i>
                                </button>

                                <!-- Botón Eliminar -->
                                <button 
                                    type="button" 
                                    class="btn btn-outline-danger btn-sm btn-modal" 
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

<!-- Modal principal -->
<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">
            <!-- El contenido del modal se cargará dinámicamente -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery (necesario para AJAX) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="../../../public/js/zapato.js"></script>
<script>
    $(document).on('click', '.btn-modal', function () {
        const url = $(this).data('url'); // Obtener la URL del archivo a cargar
        const id = $(this).data('id'); // Obtener el ID del zapato (si existe)

        // Cargar el contenido del modal desde el archivo correspondiente
        $('#modalContent').load(url, { id: id });
    });
</script>
</body>
</html>