<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_cita']) && isset($data['estado'])) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE citas SET estado_cita = :est WHERE id_cita = :id";
    $stmt = $db->prepare($query);
    
    if ($stmt->execute([':est' => $data['estado'], ':id' => $data['id_cita']])) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
?>