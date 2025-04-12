<?php
class Database {
    private $host = 'localhost:3306';
    private $db_name = 'inventario';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        echo "Conexión exitosa a la base de datos: " . $this->db_name;
        return $this->conn;
    }
}

// $cn = new Database();
// $cn->getConnection();