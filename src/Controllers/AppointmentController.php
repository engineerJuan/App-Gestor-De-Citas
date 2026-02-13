<?php
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../Models/Cita.php';

class AppointmentController {
    private $db;
    private $cita;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->cita = new Cita($this->db);
    }

    public function create($data) {
        if (empty($data['id_doctor']) || empty($data['fecha_cita'])) {
            return ['status' => 'error', 'message' => 'Datos incompletos'];
        }
        return $this->cita->agendar($data) 
                ? ['status' => 'success', 'message' => 'Cita creada'] 
                : ['status' => 'error', 'message' => 'Error al guardar'];
    }
}