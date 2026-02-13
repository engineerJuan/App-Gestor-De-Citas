<div class="modal fade" id="modalVerCita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header bg-primary text-white border-0" style="border-radius: 20px 20px 0 0;">
                <h5 class="modal-title fw-bold">Detalles de la Cita</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="formActualizarCita">
                <div class="modal-body p-4 bg-white text-start">
                    <input type="hidden" name="id_cita" id="ver_id_cita">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-primary small">Paciente</label>
                        <input type="text" id="ver_titulo" class="form-control bg-light border-0" readonly>
                    </div>
                    <div class="row g-3">
                        <div class="col-6"><label class="small fw-bold">Fecha</label><input type="date" name="fecha_cita" id="ver_fecha" class="form-control border-2"></div>
                        <div class="col-6"><label class="small fw-bold">Hora</label><input type="time" name="hora_inicio" id="ver_hora" class="form-control border-2"></div>
                        <div class="col-12"><label class="small fw-bold">Notas / Motivo</label><textarea name="motivo" id="ver_motivo" class="form-control border-2" rows="2"></textarea></div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3">
                    <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4 rounded-pill">Actualizar Agendado</button>
                </div>
            </form>
        </div>
    </div>
</div>