<?php
class Doctor {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listarActivos() {
        $query = "SELECT d.id_doctor, d.nombre, d.apellido_paterno, e.nombre_especialidad 
                  FROM doctores d
                  INNER JOIN especialidades e ON d.id_especialidad = e.id_especialidad
                  WHERE d.estado = 1";
        return $this->conn->query($query)->fetchAll();
    }
}