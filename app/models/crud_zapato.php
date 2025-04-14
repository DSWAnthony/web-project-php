<?php

require_once '../../config/conexion.php'; // Asegúrate de que esta ruta sea correcta

class CRUDZapato extends Conexion
{
    private $conn;

    // Constructor para obtener la conexión
    public function __construct() {
        $this->conn = (new Conexion())->Conectar();
    }

    // Listar todos los zapatos
   
public function ListarZapatillas()
{
    // Realizar un JOIN para obtener el nombre del modelo en lugar del ID
    $sql = "SELECT z.zapato_id, z.color, z.costo, z.porcentaje_ganancia, z.precio, z.sku, z.talla, 
                   m.nombre AS modelo_nombre
            FROM zapato z
            INNER JOIN modelo m ON z.modelo_id = m.modelo_id";
    $query = $this->conn->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ); // Asegúrate de que devuelve un arreglo de objetos
}

// Buscar zapato por ID
public function BuscarZapatoPorId($id)
{
    $sql = "SELECT z.zapato_id, z.color, z.costo, z.porcentaje_ganancia, z.precio, z.sku, z.talla, z.modelo_id
            FROM zapato z
            WHERE z.zapato_id = :zapato_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':zapato_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}

    // Registrar un nuevo zapato
  
public function RegistrarZapato($color, $costo, $porcentaje_ganancia, $sku, $talla, $modelo_id)
{
    try {
        // Calcular el precio basado en el costo y el porcentaje de ganancia
        $precio = $costo + ($costo * ($porcentaje_ganancia / 100));

        // Consulta SQL para insertar un nuevo zapato
        $sql = "INSERT INTO zapato (color, costo, porcentaje_ganancia, precio, sku, talla, modelo_id) 
                VALUES (:color, :costo, :porcentaje_ganancia, :precio, :sku, :talla, :modelo_id)";
        $stmt = $this->conn->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':costo', $costo, PDO::PARAM_STR);
        $stmt->bindParam(':porcentaje_ganancia', $porcentaje_ganancia, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindParam(':talla', $talla, PDO::PARAM_STR);
        $stmt->bindParam(':modelo_id', $modelo_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        return $stmt->execute();
    } catch (PDOException $e) {
        // Registrar el error en el log
        error_log("Error al registrar zapato: " . $e->getMessage());
        return false;
    }
}

    // Actualizar un zapato existente
    public function ActualizarZapato($id, $color, $costo, $porcentaje_ganancia, $sku, $talla, $modelo_id)
    {
        try {
            $sql = "UPDATE zapato 
                    SET color = :color, costo = :costo, porcentaje_ganancia = :porcentaje_ganancia, 
                        sku = :sku, talla = :talla, modelo_id = :modelo_id 
                    WHERE zapato_id = :zapato_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':color', $color, PDO::PARAM_STR);
            $stmt->bindParam(':costo', $costo, PDO::PARAM_STR);
            $stmt->bindParam(':porcentaje_ganancia', $porcentaje_ganancia, PDO::PARAM_STR);
            $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
            $stmt->bindParam(':talla', $talla, PDO::PARAM_STR);
            $stmt->bindParam(':modelo_id', $modelo_id, PDO::PARAM_INT);
            $stmt->bindParam(':zapato_id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Eliminar un zapato
    public function EliminarZapato($id)
    {
        try {
            $sql = "DELETE FROM zapato WHERE zapato_id = :zapato_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':zapato_id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Filtrar zapatillas por color
public function FiltrarZapatillasPorColor($color)
{
    try {
        $sql = "SELECT zapato_id, color, costo, porcentaje_ganancia, precio, sku, talla, modelo_id 
                FROM zapato 
                WHERE color LIKE :color";
        $stmt = $this->conn->prepare($sql);
        $color = '%' . $color . '%';
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    }
}

public function ListarModelos()
{
    $sql = "SELECT modelo_id, nombre FROM modelo";
    $query = $this->conn->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}
}