<?php
header('Content-Type: application/json');
require_once '../config/db.php';
require_once '../src/Models/Doctor.php';

$database = new Database();
$db = $database->getConnection();
$model = new Doctor($db);
echo json_encode($model->listarActivos());