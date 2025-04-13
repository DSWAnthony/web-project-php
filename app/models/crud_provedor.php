<?php

require_once '../../config/conexion.php';// filepath: c:\xampp\htdocs\entregable\web-project-php\app\models\crud_proveedor.php
class CRUDProveedor extends Conexion {

    // Función para listar todos los proveedores
    public function ListarProveedores() {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM proveedor";
        $query = $cn->prepare($sql);
        $query->execute();
        $proveedores = $query->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $proveedores;
    }

    // Función para buscar un proveedor por su ID
    public function BuscarProveedorPorId($id) {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM proveedor WHERE proveedor_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        $proveedor = $stm->fetch(PDO::FETCH_OBJ);
        $cn = null;
        return $proveedor;
    }

    // Función para filtrar proveedores por nombre
    public function FiltrarProveedoresPorNombre($nombre) {
        $cn = $this->Conectar();
        $sql = "SELECT * FROM proveedor WHERE nombre LIKE :nombre";
        $stm = $cn->prepare($sql);
        $nombre = '%' . $nombre . '%';
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->execute();
        $proveedores = $stm->fetchAll(PDO::FETCH_OBJ);
        $cn = null;
        return $proveedores;
    }

    // Función para registrar un nuevo proveedor
    public function RegistrarProveedor($contacto, $direccion, $email, $nombre, $telefono, $ruc) {
        $cn = $this->Conectar();
        $sql = "INSERT INTO proveedor (contacto, direccion, email, nombre, telefono, ruc) 
                VALUES (:contacto, :direccion, :email, :nombre, :telefono, :ruc)";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':contacto', $contacto, PDO::PARAM_STR);
        $stm->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stm->bindParam(':email', $email, PDO::PARAM_STR);
        $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stm->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stm->bindParam(':ruc', $ruc, PDO::PARAM_STR);
        $resultado = $stm->execute();
        $cn = null;
        return $resultado;
    }

    // Función para actualizar un proveedor
    public function ActualizarProveedor($id, $nombre, $contacto, $direccion, $email, $telefono, $ruc) {
    $cn = $this->Conectar();
    $sql = "UPDATE proveedor SET 
                nombre = :nombre, 
                contacto = :contacto, 
                direccion = :direccion, 
                email = :email, 
                telefono = :telefono, 
                ruc = :ruc 
            WHERE proveedor_id = :id";
    $stm = $cn->prepare($sql);
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    $stm->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stm->bindParam(':contacto', $contacto, PDO::PARAM_STR);
    $stm->bindParam(':direccion', $direccion, PDO::PARAM_STR);
    $stm->bindParam(':email', $email, PDO::PARAM_STR);
    $stm->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stm->bindParam(':ruc', $ruc, PDO::PARAM_STR);
    return $stm->execute();
}

    // Función para eliminar un proveedor
    public function EliminarProveedor($id) {
        $cn = $this->Conectar();
        $sql = "DELETE FROM proveedor WHERE proveedor_id = :id";
        $stm = $cn->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado = $stm->execute();
        $cn = null;
        return $resultado;
    }
}
?>