<?php
class Paciente {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerPorCurp($curp) {
        $query = "SELECT id_paciente, nombre, apellido_paterno FROM pacientes WHERE curp = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$curp]);
        return $stmt->fetch();
    }
}