document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es', 
        buttonText: { today: 'Hoy', month: 'Mes', week: 'Semana', day: 'Día' },
        headerToolbar: { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek' },
        events: '../api/get_citas.php',

        // VER Y ACTUALIZAR CITA
        eventClick: function(info) {
            document.getElementById('ver_id_cita').value = info.event.id;
            document.getElementById('ver_titulo').value = info.event.title;
            document.getElementById('ver_fecha').value = info.event.startStr.split('T')[0];
            document.getElementById('ver_hora').value = info.event.startStr.split('T')[1].substring(0,5);
            document.getElementById('ver_motivo').value = info.event.extendedProps.description || "";

            const modalVer = new bootstrap.Modal(document.getElementById('modalVerCita'));
            modalVer.show();
        },

        // AGENDAR CITA NUEVA
        dateClick: function(info) {
            const fechaInput = document.getElementById('fecha_cita');
            if (fechaInput) fechaInput.value = info.dateStr;
            cargarDoctores();
            new bootstrap.Modal(document.getElementById('modalCita')).show();
        }
    });

    calendar.render();

    // LÓGICA DE ACTUALIZACIÓN (Actualizar Agendado)
    const formUpdate = document.getElementById('formActualizarCita');
    if (formUpdate) {
        formUpdate.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-grow spinner-grow-sm me-2"></span> Actualizando...';

            const data = Object.fromEntries(new FormData(formUpdate).entries());
            try {
                const res = await fetch('../api/update_cita_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if((await res.json()).status === "success") location.reload();
                else btn.disabled = false;
            } catch (error) { btn.disabled = false; }
        });
    }

    // LÓGICA DE CREACIÓN
    const formCita = document.getElementById('formCita');
    if (formCita) {
        formCita.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-grow spinner-grow-sm me-2"></span> Generando Cita...`;

            const data = Object.fromEntries(new FormData(formCita).entries());
            try {
                const res = await fetch('../api/create_cita.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if((await res.json()).status === "success") location.reload();
                else btn.disabled = false;
            } catch (error) { btn.disabled = false; }
        });
    }
});

async function cargarDoctores() {
    const select = document.getElementById('id_doctor');
    const res = await fetch('../api/get_doctores.php');
    const docs = await res.json();
    select.innerHTML = '<option value="">Elegir Especialista...</option>';
    docs.forEach(d => {
        select.innerHTML += `<option value="${d.id_doctor}">Dr. ${d.nombre} (${d.nombre_especialidad})</option>`;
    });
}