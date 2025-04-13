<?php
require_once '../../models/crud_provedor.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Caso 1: Procesar el registro
    if (isset($_POST['nombre'], $_POST['contacto'], $_POST['direccion'], $_POST['email'], $_POST['telefono'], $_POST['ruc'])) {
        $nombre = $_POST['nombre'];
        $contacto = $_POST['contacto'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $ruc = $_POST['ruc'];

        // Instanciar el CRUD y registrar el proveedor
        $crud = new CRUDProveedor();
        $resultado = $crud->RegistrarProveedor($contacto, $direccion, $email, $nombre, $telefono, $ruc);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Proveedor registrado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar el proveedor.']);
        }
        exit; // Detener la ejecución para evitar contenido adicional
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
        exit; // Detener la ejecución
    }
}

// Caso 2: Mostrar el formulario de registro
?>
<div class="modal-header">
    <h5 class="modal-title">Registrar Nuevo Proveedor</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form id="formRegistrarProveedor">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <textarea class="form-control" id="direccion" name="direccion" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono">
        </div>
        <div class="mb-3">
            <label for="ruc" class="form-label">RUC</label>
            <input type="text" class="form-control" id="ruc" name="ruc">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" id="btnRegistrarProveedor">Registrar</button>
</div>