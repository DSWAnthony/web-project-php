<?php

require_once '../../config/conexion.php'; // filepath: c:\xampp\htdocs\entregable\web-project-php\app\models\crud_categoria.php

class CRUDCategoria extends Conexion {

    // Función para listar todas las categorías
    public function ListarCategorias() {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM categoria";
        $query = $cn->prepare($sql);
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $categorias;
    }

    // Función para buscar una categoría por su ID
    public function BuscarCategoriaPorId($id) {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM categoria WHERE categoria_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        $categoria = $stm->fetch(PDO::FETCH_OBJ);
        $cn = null;
        return $categoria;
    }
    
    // Función para filtrar categorías por nombre
    public function FiltrarCategoriasPorNombre($nombre) {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM categoria WHERE nombre LIKE :nombre";
        $stm = $cn->prepare($sql);
        $nombre = '%' . $nombre . '%';
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->execute();
        $categorias = $stm->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $categorias;
    }

    // Función para registrar una nueva categoría
    public function RegistrarCategoria($nombre)
{
    try {
        $conn = $this->Conectar();
        $sql = "INSERT INTO categoria (nombre) VALUES (:nombre)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al registrar categoría: " . $e->getMessage());
        return false;
    }
}


    // Función para actualizar una categoría
    public function ActualizarCategoria($id, $nombre, $descripcion) {
        try {
            $conn = $this->Conectar(); // ← cambio hecho aquí
            $sql = "UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE categoria_id = :id";
            $stmt = $conn->prepare($sql); // ← y aquí
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar categoría: " . $e->getMessage());
            return false;
        }
    }
    

    // Función para eliminar una categoría
    public function EliminarCategoria($id) {
        $cn = $this->Conectar();
        $sql = "DELETE FROM categoria WHERE categoria_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado = $stm->execute();
        $cn = null;
        return $resultado;
    }
}
?>
