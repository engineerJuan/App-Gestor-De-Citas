<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
require_once '../src/views/layout/header.php';
require_once '../config/db.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT c.id_cita, p.nombre as paciente, d.nombre as doctor, c.fecha_cita, c.hora_inicio, c.estado_cita 
          FROM citas c JOIN pacientes p ON c.id_paciente = p.id_paciente 
          JOIN doctores d ON c.id_doctor = d.id_doctor ORDER BY c.id_cita DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h2 class="fw-bold mb-4 text-center text-dark">Panel Administrativo</h2>
    <div class="table-responsive shadow-sm bg-white p-4 rounded-4">
        <table class="table table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th><th>Paciente</th><th>Doctor</th><th>Horario</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($citas as $cita): 
                    $clase = strtolower($cita['estado_cita']);
                ?>
                <tr>
                    <td>#<?php echo $cita['id_cita']; ?></td>
                    <td class="fw-bold"><?php echo htmlspecialchars($cita['paciente']); ?></td>
                    <td>Dr. <?php echo htmlspecialchars($cita['doctor']); ?></td>
                    <td><?php echo $cita['fecha_cita'] . ' | ' . $cita['hora_inicio']; ?></td>
                    <td>
                        <select class="form-select form-select-sm status-badge bg-<?php echo $clase; ?> mx-auto border-0" 
                                style="text-align-last: center;"
                                onchange="cambiarEstado(<?php echo $cita['id_cita']; ?>, this.value)">
                            <option value="Pendiente" <?php if($cita['estado_cita'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                            <option value="Confirmada" <?php if($cita['estado_cita'] == 'Confirmada') echo 'selected'; ?>>Confirmada</option>
                            <option value="Completada" <?php if($cita['estado_cita'] == 'Completada') echo 'selected'; ?>>Completada</option>
                            <option value="Cancelada" <?php if($cita['estado_cita'] == 'Cancelada') echo 'selected'; ?>>Cancelada</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn-delete-pro fw-bold" onclick="eliminarCita(<?php echo $cita['id_cita']; ?>)">DELETE</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
async function cambiarEstado(id, est) {
    await fetch('../api/update_status.php', { method: 'POST', body: JSON.stringify({id_cita: id, estado: est}) });
    location.reload();
}
async function eliminarCita(id) {
    if(confirm('¿Seguro que quieres eliminar esta cita? se borrará de la agenda.')) {
        const res = await fetch('../api/delete_cita.php', { method: 'POST', body: JSON.stringify({id_cita: id}) });
        if((await res.json()).status === "success") location.reload();
    }
}
</script>
<?php require_once '../src/views/layout/footer.php'; ?>