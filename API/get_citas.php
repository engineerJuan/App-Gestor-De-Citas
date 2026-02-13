<?php
require_once __DIR__ . '/../config/db.php';
header('Content-Type: application/json');

try {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT 
                c.id_cita as id, 
                CONCAT('Pac: ', p.nombre, ' / Dr. ', d.nombre) as title, 
                CONCAT(c.fecha_cita, 'T', c.hora_inicio) as start, 
                c.motivo_consulta as description,
                c.estado_cita as status
              FROM citas c
              INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
              INNER JOIN doctores d ON c.id_doctor = d.id_doctor";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($events);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}