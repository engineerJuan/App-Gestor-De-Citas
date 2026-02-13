<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediAgenda - Sistema Hospitalario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/styles.css">
    <style>
        :root { --hosp-blue: #0d6efd; --hosp-dark: #004085; }
        .navbar { background: var(--hosp-dark) !important; padding: 1rem 0; }
        .navbar-brand { font-size: 1.5rem; letter-spacing: 1px; }
        .welcome-text { color: #ffffff !important; font-size: 0.95rem; margin-right: 25px; }
        
        .btn-logout { 
            color: #ffffff; 
            border: 1.5px solid rgba(255,255,255,0.4); 
            background: transparent;
            font-weight: 600; padding: 0.5rem 1.3rem; border-radius: 10px; transition: all 0.3s ease;
            text-decoration: none;
        }
        .btn-logout:hover { background: #dc3545; border-color: #dc3545; color: white; transform: scale(1.05); }

        .status-badge, .btn-delete-pro { 
            width: 140px; height: 40px; display: inline-flex; align-items: center; 
            justify-content: center; font-weight: 600; border-radius: 8px; border: none;
        }
        .bg-confirmada { background-color: #d1e7dd; color: #0f5132; }
        .bg-completada { background-color: #cfe2ff; color: #084298; }
        .bg-pendiente { background-color: #fff3cd; color: #856404; }
        .bg-cancelada { background-color: #f8d7da; color: #842029; }
        
        .btn-delete-pro { background-color: #f8d7da; color: #842029; transition: all 0.3s; cursor: pointer; }
        .btn-delete-pro:hover { background-color: #842029; color: white; }
    </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <i class="bi bi-hospital-fill me-2"></i> MediAgenda
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link px-3 text-white" href="index.php">Agenda</a></li>
                <li class="nav-item"><a class="nav-link px-3 text-white" href="admin.php">Panel Administrativo</a></li>
            </ul>
            <div class="navbar-nav align-items-center">
                <?php if(isset($_SESSION['user_name'])): ?>
                    <span class="welcome-text">Bienvenido, <b><?php echo $_SESSION['user_name']; ?></b></span>
                    <a href="../api/logout.php" class="btn btn-logout btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i> SALIR
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-light btn-sm fw-bold px-4 rounded-pill shadow-sm">
                        <i class="bi bi-person-fill me-1"></i> INICIAR SESIÓN
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container py-4">