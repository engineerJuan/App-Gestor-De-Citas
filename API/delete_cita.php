<?php
require_once '../config/db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_cita'])) {
    $database = new Database();
    $db = $database->getConnection();

    try {
        $query = "DELETE FROM citas WHERE id_cita = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $data['id_cita']);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo borrar"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID no proporcionado"]);
}
?>