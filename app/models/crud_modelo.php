<?php

require_once '../../config/conexion.php';

class CRUDModelo extends Conexion {

    // Función para listar todos los modelos
    
    public function ListarModelos() {
        $cn = $this->Conectar();
        $sql = "SELECT 
                    m.modelo_id, 
                    m.nombre, 
                    m.genero, 
                    c.nombre AS categoria, 
                    ma.nombre AS marca
                FROM modelo m
                INNER JOIN categoria c ON m.categoria_id = c.categoria_id
                INNER JOIN marca ma ON m.marca_id = ma.marca_id";
        $stmt = $cn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Devuelve todos los resultados como objetos
    }

    // Función para buscar un modelo por su ID
    
public function BuscarModeloPorId($id) {
    $cn = $this->Conectar();
    $sql = "SELECT 
                m.modelo_id, 
                m.nombre AS nombre_modelo, 
                m.genero, 
                m.categoria_id, 
                m.marca_id, 
                c.nombre AS nombre_categoria, 
                ma.nombre AS nombre_marca
            FROM modelo m
            INNER JOIN categoria c ON m.categoria_id = c.categoria_id
            INNER JOIN marca ma ON m.marca_id = ma.marca_id
            WHERE m.modelo_id = :id";
    $stm = $cn->prepare($sql);
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_OBJ); // Devuelve un único resultado como objeto
}
    

    // Función para filtrar modelos por nombre
    public function FiltrarModelosPorNombre($nombre) {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM modelo WHERE nombre LIKE :nombre";
        $stm = $cn->prepare($sql);
        $nombre = '%' . $nombre . '%';
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->execute();
        $modelos = $stm->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $modelos;
    }

    // Función para registrar un nuevo modelo
    

    // Función para actualizar un modelo
    public function ActualizarModelo($id, $nombre, $genero, $categoria_id, $marca_id) {
        try {
            $cn = $this->Conectar();
            $sql = "UPDATE modelo SET 
                        nombre = :nombre, 
                        genero = :genero, 
                        categoria_id = :categoria_id, 
                        marca_id = :marca_id 
                    WHERE modelo_id = :id";
            $stm = $cn->prepare($sql);
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stm->bindParam(':genero', $genero, PDO::PARAM_STR);
            $stm->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            $stm->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
            return $stm->execute();
        } catch (PDOException $e) {
            die("Error al actualizar el modelo: " . $e->getMessage());
        }}

    // Función para eliminar un modelo
    public function EliminarModelo($id) {
        $cn = $this->Conectar();
        $sql = "DELETE FROM modelo WHERE modelo_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado = $stm->execute();
        $cn = null;
        return $resultado;
    }


    
    public function ObtenerCategorias() {
        $cn = $this->Conectar(); // Conexión a la base de datos
        $sql = "SELECT categoria_id, nombre FROM categoria"; // Consulta SQL
        $stm = $cn->prepare($sql); // Preparar la consulta
        $stm->execute(); // Ejecutar la consulta
        return $stm->fetchAll(PDO::FETCH_OBJ); // Devolver los resultados como objetos
    }
    public function ObtenerMarcas() {
        $cn = $this->Conectar(); // Conexión a la base de datos
        $sql = "SELECT marca_id, nombre FROM marca"; // Consulta SQL
        $stm = $cn->prepare($sql); // Preparar la consulta
        $stm->execute(); // Ejecutar la consulta
        return $stm->fetchAll(PDO::FETCH_OBJ); // Devolver los resultados como objetos
    }
    
public function RegistrarModelo($nombre, $genero, $categoria_id, $marca_id) {
    try {
        $cn = $this->Conectar(); // Conexión a la base de datos
        $sql = "INSERT INTO modelo (nombre, genero, categoria_id, marca_id) 
                VALUES (:nombre, :genero, :categoria_id, :marca_id)";
        $stm = $cn->prepare($sql); // Preparar la consulta
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->bindParam(':genero', $genero, PDO::PARAM_STR);
        $stm->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stm->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
        $resultado = $stm->execute(); // Ejecutar la consulta
        $cn = null; // Cerrar la conexión
        return $resultado; // Retornar el resultado de la ejecución
    } catch (PDOException $e) {
        die("Error al registrar el modelo: " . $e->getMessage());
    }
}}
?>