<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validar($user, $pass) {
        $query = "SELECT id_usuario, nombre, apellido_paterno FROM " . $this->table . " 
                  WHERE usuario = :user AND password = :pass LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}