<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';
require_once '../src/Models/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Usuario($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->usuario) && !empty($data->password)) {
    $user = $auth->validar($data->usuario, $data->password);
    if ($user) {
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nombre'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuario o clave incorrectos"]);
    }
}