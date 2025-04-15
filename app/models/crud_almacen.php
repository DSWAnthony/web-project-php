<?php

require_once '../../config/conexion.php'; // Asegúrate de que este archivo contiene la clase para conectar a la base de datos

class CRUDAlmacen extends Conexion
{
    // Crear una nueva ubicación en el almacén
    
   
  
public function CrearUbicacion($contenedor, $estante, $pasillo)
{
    // Verificar si ya existe una ubicación con los mismos valores
    $sqlCheck = "SELECT COUNT(*) FROM ubicacion_almacen WHERE contenedor = :contenedor AND estante = :estante AND pasillo = :pasillo";
    $stmtCheck = $this->Conectar()->prepare($sqlCheck);
    $stmtCheck->bindParam(':contenedor', $contenedor, PDO::PARAM_STR);
    $stmtCheck->bindParam(':estante', $estante, PDO::PARAM_STR);
    $stmtCheck->bindParam(':pasillo', $pasillo, PDO::PARAM_STR);
    $stmtCheck->execute();

    if ($stmtCheck->fetchColumn() > 0) {
        // Ya existe una ubicación con los mismos valores
        return false;
    }

    // Insertar la nueva ubicación
    $sql = "INSERT INTO ubicacion_almacen (contenedor, estante, pasillo) VALUES (:contenedor, :estante, :pasillo)";
    $stmt = $this->Conectar()->prepare($sql);
    $stmt->bindParam(':contenedor', $contenedor, PDO::PARAM_STR);
    $stmt->bindParam(':estante', $estante, PDO::PARAM_STR);
    $stmt->bindParam(':pasillo', $pasillo, PDO::PARAM_STR);
    return $stmt->execute();
}
    // Leer todas las ubicaciones del almacén
    public function ListarUbicaciones()
    {
        $sql = "SELECT * FROM ubicacion_almacen";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Buscar una ubicación por ID
    public function BuscarUbicacionPorId($id)
    {
        $sql = "SELECT * FROM ubicacion_almacen WHERE ubicacion_id = :id";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Actualizar una ubicación en el almacén
    
    public function ActualizarUbicacion($id, $contenedor, $estante, $pasillo)
    {
        $sql = "UPDATE ubicacion_almacen SET contenedor = :contenedor, estante = :estante, pasillo = :pasillo WHERE ubicacion_id = :id";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':contenedor', $contenedor, PDO::PARAM_STR);
        $stmt->bindParam(':estante', $estante, PDO::PARAM_STR);
        $stmt->bindParam(':pasillo', $pasillo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Eliminar una ubicación del almacén
    public function EliminarUbicacion($id)
    {
        $sql = "DELETE FROM ubicacion_almacen WHERE ubicacion_id = :id";
        $stmt = $this->Conectar()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Filtrar ubicaciones por nombre del contenedor
    public function FiltrarUbicacionesPorContenedor($contenedor)
    {
        $sql = "SELECT * FROM ubicacion_almacen WHERE contenedor LIKE :contenedor";
        $stmt = $this->Conectar()->prepare($sql);
        $contenedor = '%' . $contenedor . '%'; // Agregar comodines para búsqueda parcial
        $stmt->bindParam(':contenedor', $contenedor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Devolver un arreglo de objetos
    }
}