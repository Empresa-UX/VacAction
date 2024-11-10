-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 10-11-2024 a las 18:26:43
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
-- Base de datos: `vacaction_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_vacaciones`
--

CREATE TABLE `configuracion_vacaciones` (
  `id` int(11) NOT NULL,
  `max_dias_anuales` int(11) DEFAULT 30,
  `min_dias_por_solicitud` int(11) DEFAULT 1,
  `max_dias_por_solicitud` int(11) DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_vacaciones`
--

CREATE TABLE `historial_vacaciones` (
  `id` int(11) NOT NULL,
  `vacaciones_id` int(11) DEFAULT NULL,
  `estado_anterior` enum('pendiente','aprobado','rechazado') DEFAULT NULL,
  `estado_nuevo` enum('pendiente','aprobado','rechazado') DEFAULT NULL,
  `cambiado_por` int(11) DEFAULT NULL,
  `fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp(),
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `id` int(11) NOT NULL,
  `rol` enum('admin','empleado') NOT NULL,
  `permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`id`, `rol`, `permiso`) VALUES
(1, 'admin', 'ver_vacaciones'),
(2, 'admin', 'aprobar_vacaciones'),
(3, 'empleado', 'ver_vacaciones'),
(4, 'empleado', 'solicitar_vacaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','empleado') DEFAULT 'empleado',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `fecha_registro`) VALUES
(8, 'Juan Perez', 'juan.perez@example.com', '$2y$10$Up6HDJC.17lu.ss2WPwMQewgOvK.sjcR0k9FG89CHWrLyrl1stB3O', 'admin', '2024-11-10 01:48:45'),
(9, 'Maria Lopez', 'maria.lopez@example.com', '$2y$10$SPwFWtGntiHs5O2MYapP7uqc76FyFr/oQDDpr/rWkCZeszlHTiUgG', 'empleado', '2024-11-10 01:48:45'),
(10, 'Carlos Garcia', 'carlos.garcia@example.com', '$2y$10$62FeO1VRUGzYy6od5sFDce/24AKg6za2EDL.fjDY2fVNPYCVqshja', 'empleado', '2024-11-10 01:48:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente',
  `comentario_admin` text DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`id`, `usuario_id`, `fecha_inicio`, `fecha_fin`, `estado`, `comentario_admin`, `fecha_solicitud`) VALUES
(1, 10, '2024-10-31', '2024-12-01', 'aprobado', 'Descansito bro', '2024-11-10 07:11:41'),
(2, 9, '2024-11-01', '2024-11-08', 'aprobado', 'Quiero descansar jefe.', '2024-11-10 08:15:45'),
(3, 9, '2024-11-21', '2024-11-28', '', 'Quiero más vacaciones, las que no tomé en el año.', '2024-11-10 08:16:38'),
(4, 9, '2024-12-01', '2025-01-01', 'rechazado', 'Vacaciones de verano jefe.', '2024-11-10 08:17:24'),
(5, 9, '2024-12-08', '2024-12-15', 'rechazado', 'estoy cansado jefe, cansado de laburar', '2024-11-10 12:46:05'),
(6, 9, '2024-11-01', '2024-11-02', 'rechazado', 'xdddddddddd', '2024-11-10 12:54:20'),
(7, 9, '2024-11-15', '2024-11-16', '', 'dasdadsadsd', '2024-11-10 12:55:48'),
(8, 9, '2024-11-16', '2024-11-17', '', 'qqqqqqqqqqqqqqqqqqq', '2024-11-10 13:01:30'),
(9, 9, '2024-11-23', '2024-11-24', 'rechazado', 'erhdfgfdgdfgdg', '2024-11-10 13:04:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion_vacaciones`
--
ALTER TABLE `configuracion_vacaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacaciones_id` (`vacaciones_id`),
  ADD KEY `cambiado_por` (`cambiado_por`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion_vacaciones`
--
ALTER TABLE `configuracion_vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  ADD CONSTRAINT `historial_vacaciones_ibfk_1` FOREIGN KEY (`vacaciones_id`) REFERENCES `vacaciones` (`id`),
  ADD CONSTRAINT `historial_vacaciones_ibfk_2` FOREIGN KEY (`cambiado_por`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
