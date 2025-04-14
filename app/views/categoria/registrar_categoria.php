<?php 
require_once '../../models/crud_categoria.php';
require_once '../../config/conexion.php'; // Ajustá el path según tu estructura real

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nombre'], $_POST['descripcion'])) {
        $nombre = trim($_POST['nombre']);
        $descripcion = trim($_POST['descripcion']);

        try {
            $conexion = new Conexion();
            $conn = $conexion->Conectar();

            $stmt = $conn->prepare("INSERT INTO categoria (nombre, descripcion) VALUES (?, ?)");
            $resultado = $stmt->execute([$nombre, $descripcion]);

            if ($resultado) {
                echo "<div class='alert alert-success'>✅ Categoría registrada correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>❌ Error al registrar la categoría.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>❌ Error: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ Por favor completa todos los campos.</div>";
    }
}
?>

<!-- Modal HTML -->
<div class="modal-header">
    <h5 class="modal-title">Registrar Nueva Categoría</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form method="POST" id="formRegistrarCategoria">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Registrar</button>
</div>
    </form>
