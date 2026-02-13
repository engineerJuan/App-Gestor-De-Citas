<?php
class Cita {
    private $conn;
    private $table = "citas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verificarDisponibilidad($id_doctor, $fecha, $inicio, $fin) {
        $query = "SELECT COUNT(*) FROM " . $this->table . " 
                  WHERE id_doctor = ? AND fecha_cita = ? 
                  AND (? < hora_fin AND ? > hora_inicio) 
                  AND estado != 'Cancelada'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_doctor, $fecha, $inicio, $fin]);
        return $stmt->fetchColumn() == 0;
    }

    public function agendar($data) {
        $query = "INSERT INTO " . $this->table . " 
                  SET id_paciente = :id_p, id_doctor = :id_d, fecha_cita = :fecha, 
                      hora_inicio = :h_ini, hora_fin = :h_fin, motivo = :motivo";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':id_p' => $data['id_paciente'],
            ':id_d' => $data['id_doctor'],
            ':fecha' => $data['fecha_cita'],
            ':h_ini' => $data['hora_inicio'],
            ':h_fin' => $data['hora_fin'],
            ':motivo' => $data['motivo']
        ]);
    }
}