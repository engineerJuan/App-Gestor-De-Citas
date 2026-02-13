<div class="modal fade" id="modalCita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold">Nueva Cita Médica</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCita">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-bold">CURP del Paciente</label>
                            <input type="text" name="curp" class="form-control" placeholder="CURP a 18 dígitos" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Apellido Paterno</label>
                            <input type="text" name="apellido_p" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Apellido Materno</label>
                            <input type="text" name="apellido_m" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Edad</label>
                            <input type="number" name="edad" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Teléfono</label>
                            <input type="tel" name="telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Doctor Especialista</label>
                            <select name="id_doctor" id="id_doctor" class="form-select" required></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Hora de Consulta</label>
                            <input type="time" name="hora_inicio" class="form-control" required>
                        </div>
                        <input type="hidden" name="fecha_cita" id="fecha_cita">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">Confirmar Agendado</button>
                </div>
            </form>
        </div>
    </div>
</div>