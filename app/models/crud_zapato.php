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
        $cn = $this->Conectar();
        $sql = "SELECT * FROM zapato";
        $query = $cn->prepare($sql);
        $query->execute();
        $zapatillas = $query->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $zapatillas;
    }

    public function BuscarZapatoPorId($id) {
        $sql = "SELECT * FROM zapato WHERE zapato_id = :zapato_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':zapato_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Filtrar zapatillas por color
    public function FiltrarZapatillasPorColor($color)
    {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM zapato WHERE color LIKE :color";
        $stm = $cn->prepare($sql);
        $color = '%' . $color . '%';
        $stm->bindParam(':color', $color, PDO::PARAM_STR);
        $stm->execute();
        $zapatillas = $stm->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $zapatillas;
    }

    public function RegistrarZapato($color, $precio, $sku, $talla, $modelo_id)
    {
        try {
            $cn = $this->Conectar();
            $sql = "INSERT INTO zapato (color, precio_comercial, sku, talla, modelo_id) 
                    VALUES (:color, :precio, :sku, :talla, :modelo_id)";
            $stm = $cn->prepare($sql);
            $stm->bindParam(':color', $color, PDO::PARAM_STR);
            $stm->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stm->bindParam(':sku', $sku, PDO::PARAM_STR);
            $stm->bindParam(':talla', $talla, PDO::PARAM_STR);
            $stm->bindParam(':modelo_id', $modelo_id, PDO::PARAM_INT);

            // Verificar si se insertó correctamente
            if ($stm->execute()) {
                return true;
            } else {
                throw new Exception("No se pudo registrar el zapato.");
            }
        } catch (PDOException $e) {
            // Error en la ejecución de la consulta
            return ['success' => false, 'message' => 'Error de base de datos: ' . $e->getMessage()];
        } catch (Exception $e) {
            // Error general
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function ActualizarZapato($id, $color, $precio_comercial, $sku, $talla, $modelo_id) {
        try {
            // SQL para actualizar el zapato
            $sql = "UPDATE zapato SET color = :color, precio_comercial = :precio_comercial, sku = :sku, talla = :talla, modelo_id = :modelo_id WHERE zapato_id = :zapato_id";

            // Preparar la consulta
            $stmt = $this->conn->prepare($sql);

            // Enlazar los parámetros
            $stmt->bindParam(':color', $color, PDO::PARAM_STR);
            $stmt->bindParam(':precio_comercial', $precio_comercial, PDO::PARAM_STR); // Para el tipo decimal
            $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
            $stmt->bindParam(':talla', $talla, PDO::PARAM_STR); // Para el tipo decimal
            $stmt->bindParam(':modelo_id', $modelo_id, PDO::PARAM_INT);
            $stmt->bindParam(':zapato_id', $id, PDO::PARAM_INT);

            // Ejecutar la consulta
            return $stmt->execute(); // Retorna true si la actualización fue exitosa

        } catch (PDOException $e) {
            // Si ocurre un error, puedes manejarlo aquí, por ejemplo, devolviendo false o logueando el error
            error_log($e->getMessage()); // Loguea el error para debug
            return false; // En caso de error, retornamos false
        }
    }
    
    

    // Eliminar zapato
    public function EliminarZapato($id)
    {
        $cn = $this->Conectar();
        $sql = "DELETE FROM zapato WHERE zapato_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado = $stm->execute();
        $cn = null;
        return $resultado;
    }
}
