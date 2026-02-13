<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Sin datos"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

try {
    $db->beginTransaction();

    $qPaciente = "INSERT INTO pacientes (curp, nombre, apellido_paterno, apellido_materno, edad, genero, telefono, email) 
                  VALUES (:curp, :nom, :ap, :am, :edad, 'Masculino', :tel, :mail)
                  ON DUPLICATE KEY UPDATE nombre=:nom, telefono=:tel";
    $stmtP = $db->prepare($qPaciente);
    $stmtP->execute([
        ':curp' => $data['curp'],
        ':nom'  => $data['nombre'],
        ':ap'   => $data['apellido_p'],
        ':am'   => $data['apellido_m'],
        ':edad' => $data['edad'],
        ':tel'  => $data['telefono'],
        ':mail' => $data['email']
    ]);

    $id_paciente = $db->lastInsertId();
    if (!$id_paciente) {
        $stmtId = $db->prepare("SELECT id_paciente FROM pacientes WHERE curp = ?");
        $stmtId->execute([$data['curp']]);
        $id_paciente = $stmtId->fetchColumn();
    }

    $qCita = "INSERT INTO citas (id_paciente, id_doctor, fecha_cita, hora_inicio, motivo_consulta, estado_cita) 
              VALUES (:idp, :idd, :fecha, :hora, 'Consulta General', 'Pendiente')";
    $stmtC = $db->prepare($qCita);
    $stmtC->execute([
        ':idp'   => $id_paciente,
        ':idd'   => $data['id_doctor'],
        ':fecha' => $data['fecha_cita'],
        ':hora'  => $data['hora_inicio']
    ]);

    $db->commit();
    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    $db->rollBack();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>