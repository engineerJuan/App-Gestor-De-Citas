<?php 
session_start(); // Permite mostrar el nombre (Juan Pablo) si el admin está navegando
require_once '../src/views/layout/header.php'; 
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="fw-bold m-0">Gestión de Citas Médicas</h2>
        <p class="text-muted">Haga clic en un día para agendar o en una cita existente para ver detalles.</p>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-white rounded-3">
            <div class="card-body py-2">
                <h6 class="fw-bold mb-2 text-primary">
                    <i class="bi bi-clock-history me-2"></i>Atención Hospitalaria
                </h6>
                <table class="table table-sm table-borderless m-0 small">
                    <tr>
                        <td>Lunes - Viernes:</td>
                        <td class="text-end fw-bold text-dark">07:00 - 20:00</td>
                    </tr>
                    <tr>
                        <td>Sábados:</td>
                        <td class="text-end fw-bold text-dark">08:00 - 14:00</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div id="calendar"></div>
    </div>
</div>

<?php 
// 1. Modal para AGENDAR nuevas citas (El blanquito con botones azules)
include '../src/views/modals/modal_cita.php'; 

// 2. NUEVO: Modal para VER y ACTUALIZAR citas existentes (La "pestañita bonita")
include '../src/views/modals/modal_ver_cita.php'; 

// Pie de página con los scripts (incluye calendar.js)
require_once '../src/views/layout/footer.php'; 
?>