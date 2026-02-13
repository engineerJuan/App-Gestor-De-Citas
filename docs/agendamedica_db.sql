-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2026 a las 04:19:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendamedica_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id_cita` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `motivo_consulta` text NOT NULL,
  `estado_cita` enum('Pendiente','Confirmada','Completada','Cancelada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id_cita`, `id_paciente`, `id_doctor`, `fecha_cita`, `hora_inicio`, `motivo_consulta`, `estado_cita`) VALUES
(1, 1, 1, '2026-02-15', '09:00:00', 'Chequeo', 'Confirmada'),
(2, 2, 2, '2026-02-16', '10:30:00', 'Gripe', 'Pendiente'),
(3, 3, 3, '2026-02-17', '12:00:00', 'Arritmia', 'Confirmada'),
(4, 4, 4, '2026-02-18', '16:00:00', 'Manchas', 'Completada'),
(5, 5, 5, '2026-02-19', '08:30:00', 'Control', 'Pendiente'),
(6, 6, 6, '2026-02-20', '11:00:00', 'Miopía', 'Confirmada'),
(7, 7, 7, '2026-02-21', '09:30:00', 'Dieta', 'Completada'),
(8, 8, 8, '2026-02-22', '17:00:00', 'Estrés', 'Cancelada'),
(9, 9, 9, '2026-02-23', '15:00:00', 'Dolor', 'Pendiente'),
(10, 10, 10, '2026-02-24', '13:00:00', 'Esguince', 'Confirmada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int(11) NOT NULL,
  `cedula_profesional` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `cedula_profesional`, `nombre`, `apellido_paterno`, `apellido_materno`, `id_especialidad`, `estado`) VALUES
(1, 'CED-101', 'Pilar', 'García', 'López', 1, 1),
(2, 'CED-102', 'Elena', 'Rodríguez', 'Pérez', 2, 1),
(3, 'CED-103', 'Carlos', 'Martínez', 'Sánchez', 3, 1),
(4, 'CED-104', 'Ana', 'Hernández', 'Díaz', 4, 1),
(5, 'CED-105', 'Roberto', 'Gómez', 'Ruiz', 5, 1),
(6, 'CED-106', 'Lucía', 'Fernández', 'Torres', 6, 1),
(7, 'CED-107', 'Miguel', 'Álvarez', 'Vargas', 7, 1),
(8, 'CED-108', 'Sofía', 'Castro', 'Mendoza', 8, 1),
(9, 'CED-109', 'Javier', 'Reyes', 'Ortiz', 9, 1),
(10, 'CED-110', 'Beatriz', 'Morales', 'Jiménez', 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `nombre_especialidad` varchar(100) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id_especialidad`, `nombre_especialidad`, `descripcion`) VALUES
(1, 'Medicina General', 'Atención integral'),
(2, 'Pediatría', 'Cuidado infantil'),
(3, 'Cardiología', 'Salud del corazón'),
(4, 'Dermatología', 'Cuidado piel'),
(5, 'Ginecología', 'Salud mujer'),
(6, 'Oftalmología', 'Salud visual'),
(7, 'Nutrición', 'Hábitos sanos'),
(8, 'Psicología', 'Salud mental'),
(9, 'Odontología', 'Salud bucal'),
(10, 'Traumatología', 'Huesos y músculos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `curp` char(18) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `genero` enum('Masculino','Femenino','Otro') NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ultima_atencion` datetime DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `curp`, `nombre`, `apellido_paterno`, `apellido_materno`, `edad`, `genero`, `telefono`, `email`, `ultima_atencion`, `fecha_registro`) VALUES
(1, 'ROMA950312HDFRRA01', 'Ricardo', 'Olvera', 'Mendieta', 28, 'Masculino', '7220001010', 'ric@mail.com', NULL, '2026-02-13 03:14:18'),
(2, 'GAMA880520MDFLLN02', 'Gabriela', 'Mendoza', 'Aguirre', 35, 'Femenino', '7220001011', 'gaby@mail.com', NULL, '2026-02-13 03:14:18'),
(3, 'SALA021015HDFRRL03', 'Saúl', 'López', 'Arriaga', 21, 'Masculino', '7220001012', 'saul@mail.com', NULL, '2026-02-13 03:14:18'),
(4, 'VEMA991201MDFSSB04', 'Verónica', 'Silva', 'Bustamante', 24, 'Femenino', '7220001013', 'vero@mail.com', NULL, '2026-02-13 03:14:18'),
(5, 'HEFA700814HDFXXC05', 'Héctor', 'Flores', 'Casas', 53, 'Masculino', '7220001014', 'hec@mail.com', NULL, '2026-02-13 03:14:18'),
(6, 'COML050130MDFZZA06', 'Claudia', 'Montero', 'Luna', 19, 'Femenino', '7220001015', 'clau@mail.com', NULL, '2026-02-13 03:14:18'),
(7, 'PARE820411HDFRRG07', 'Pablo', 'Reyes', 'Guerra', 41, 'Masculino', '7220001016', 'pablo@mail.com', NULL, '2026-02-13 03:14:18'),
(8, 'MORA920625MDFSSM08', 'Mónica', 'Ramos', 'Mejía', 31, 'Femenino', '7220001017', 'moni@mail.com', NULL, '2026-02-13 03:14:18'),
(9, 'AVED771103HDFNNP09', 'Arturo', 'Velasco', 'Duarte', 46, 'Masculino', '7220001018', 'art@mail.com', NULL, '2026-02-13 03:14:18'),
(10, 'LARL940218MDFRRK10', 'Laura', 'Ríos', 'Lara', 30, 'Femenino', '7220001019', 'lau@mail.com', NULL, '2026-02-13 03:14:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `nombre`, `apellido_paterno`, `apellido_materno`, `email`, `ultimo_acceso`, `fecha_registro`) VALUES
(1, 'juan', '12345', 'Juan Pablo', 'Mercado', 'Arizmendi', 'juan@mediagenda.mx', NULL, '2026-02-13 03:14:18'),
(2, 'luis', '678910', 'Luis', 'Yañez', 'Sánchez', 'luis@mediagenda.mx', NULL, '2026-02-13 03:14:18'),
(3, 'michael', '111213', 'Michael', 'Lopez', 'Pérez', 'michael@mediagenda.mx', NULL, '2026-02-13 03:14:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`),
  ADD UNIQUE KEY `cedula_profesional` (`cedula_profesional`),
  ADD KEY `id_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `curp` (`curp`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`) ON DELETE CASCADE,
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_ibfk_1` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id_especialidad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;