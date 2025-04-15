<?php
class Conexion {
    private $host = "localhost";
    private $db_nombre = "inventario"; 
    private $usuario = "root"; 
    private $contrasena = "Xboxlive123"; 
    private $charset = "utf8mb4";
    private $pdo;

    public function Conectar() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_nombre . ";charset=" . $this->charset;
            $this->pdo = new PDO($dsn, $this->usuario, $this->contrasena, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                 
            ]);
            
            return $this->pdo;
            
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}