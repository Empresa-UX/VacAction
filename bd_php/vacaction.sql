-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2024 a las 15:49:27
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
-- Base de datos: `vacaction`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `admin_id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`admin_id`, `fullName`, `email`, `password`, `role`) VALUES(1, 'Matías Josué Sirpa Mamani', 'matiassirpasirpa@gmail.com', 'SDFSDFMSDHFU', 'Desarrollador');
INSERT INTO `administradores` (`admin_id`, `fullName`, `email`, `password`, `role`) VALUES(2, 'Oscar Mauricio Vargas Céspedes', '1ro3ravargasmauricio@gmail.com', 'EWRJWE9ORDF', 'Desarrollador');
INSERT INTO `administradores` (`admin_id`, `fullName`, `email`, `password`, `role`) VALUES(3, 'Nina Quispe Haberth Jefferson', 'hebertjeffersonn@gmail.com', 'UREHTGEIDRGF', 'Desarrollador');
INSERT INTO `administradores` (`admin_id`, `fullName`, `email`, `password`, `role`) VALUES(4, 'Marupa Aro Maiky Joseph', 'maikymarupa@gmail.com', 'EIRSIDFSFISTGSDT', 'Desarrollador');
INSERT INTO `administradores` (`admin_id`, `fullName`, `email`, `password`, `role`) VALUES(5, 'Cristian Ronald Chejo Aruquipa', 'cristianchejo55@gmail.com', 'SODJDSIJFDSIGSG', 'Desarrollador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_vacaciones`
--

CREATE TABLE `historial_vacaciones` (
  `history_id` int(11) NOT NULL,
  `vacation_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `previous_status` varchar(20) NOT NULL,
  `new_status` varchar(20) NOT NULL,
  `change_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_vacaciones`
--

INSERT INTO `historial_vacaciones` (`history_id`, `vacation_id`, `admin_id`, `previous_status`, `new_status`, `change_date`) VALUES(1, 3, 5, 'Approved', 'Approved', '2024-10-17 12:25:47');
INSERT INTO `historial_vacaciones` (`history_id`, `vacation_id`, `admin_id`, `previous_status`, `new_status`, `change_date`) VALUES(2, 4, 5, 'Approved', 'Approved', '2024-10-17 12:25:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `birth` date DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `remember` tinyint(1) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `fullName`, `email`, `password`, `birth`, `phone`, `remember`, `role`, `status`) VALUES(28, 'Nadia Carlo', 'nadiacarlo@gmail.com', 'DFIJGDJIGE', NULL, NULL, 1, 'employee', 1);
INSERT INTO `usuarios` (`user_id`, `fullName`, `email`, `password`, `birth`, `phone`, `remember`, `role`, `status`) VALUES(29, 'ronald quenallata', 'ronaldquenallata@gmail.com', 'ENYUTGFHIO', NULL, NULL, 0, 'employee', 1);
INSERT INTO `usuarios` (`user_id`, `fullName`, `email`, `password`, `birth`, `phone`, `remember`, `role`, `status`) VALUES(32, 'sdfsfsfsf', 'sfsdfsf@gmail.com', '1231231', '0000-00-00', '123123123', 1, 'admin', 0);
INSERT INTO `usuarios` (`user_id`, `fullName`, `email`, `password`, `birth`, `phone`, `remember`, `role`, `status`) VALUES(33, 'gfdgdgdg', '123dgfdgdgdg@gmail.com', '123123', '3433-03-12', '', 1, 'admin', 0);
INSERT INTO `usuarios` (`user_id`, `fullName`, `email`, `password`, `birth`, `phone`, `remember`, `role`, `status`) VALUES(34, 'Bautista Roberto Almara De la Vega', 'bautistaalmara37@gmail.com', '$2y$10$fc6k14.XPAO2ACCg9IFGFe5', '2005-03-12', '1138293392', 1, 'admin', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `vacation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`vacation_id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `request_date`) VALUES(1, 29, '2024-10-02', '2024-10-30', NULL, 'Approved', '2024-10-01 23:38:24');
INSERT INTO `vacaciones` (`vacation_id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `request_date`) VALUES(2, 28, '2024-10-06', '2024-10-24', NULL, 'Rejected', '2024-10-01 23:38:24');
INSERT INTO `vacaciones` (`vacation_id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `request_date`) VALUES(3, 29, '2023-03-15', '2023-03-30', NULL, 'Approved', '2023-03-15 12:20:12');
INSERT INTO `vacaciones` (`vacation_id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `request_date`) VALUES(4, 29, '2024-01-01', '2023-01-15', NULL, 'Approved', '2023-01-01 12:20:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indices de la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `vacation_id` (`vacation_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`vacation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `vacation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historial_vacaciones`
--
ALTER TABLE `historial_vacaciones`
  ADD CONSTRAINT `historial_vacaciones_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `administradores` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historial_vacaciones_ibfk_2` FOREIGN KEY (`vacation_id`) REFERENCES `vacaciones` (`vacation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `vacaciones_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla administradores
--

--
-- Metadatos para la tabla historial_vacaciones
--

--
-- Metadatos para la tabla usuarios
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES('root', 'vacaction', 'usuarios', '[]', '2024-10-01 22:49:46');

--
-- Metadatos para la tabla vacaciones
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES('root', 'vacaction', 'vacaciones', '{\"sorted_col\":\"`vacaciones`.`request_date` DESC\"}', '2024-10-03 00:26:15');

--
-- Metadatos para la base de datos vacaction
--

--
-- Volcado de datos para la tabla `pma__pdf_pages`
--

INSERT INTO `pma__pdf_pages` (`db_name`, `page_descr`) VALUES('vacaction', 'Diagrama BD');

SET @LAST_PAGE = LAST_INSERT_ID();

--
-- Volcado de datos para la tabla `pma__table_coords`
--

INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('vacaction', 'administradores', @LAST_PAGE, 386, 310);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('vacaction', 'historial_vacaciones', @LAST_PAGE, 619, 338);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('vacaction', 'usuarios', @LAST_PAGE, 622, 82);
INSERT INTO `pma__table_coords` (`db_name`, `table_name`, `pdf_page_number`, `x`, `y`) VALUES('vacaction', 'vacaciones', @LAST_PAGE, 966, 222);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
