-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2025 a las 04:07:53
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
-- Base de datos: `retencion_cpic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `idAprendiz` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `trimestre` varchar(20) NOT NULL,
  `fkIdGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`idAprendiz`, `nombre`, `email`, `telefono`, `trimestre`, `fkIdGrupo`) VALUES
(2, 'Juan Jose Posada', 'juan@gmail.com', '3245678978', '7', 10),
(3, 'Juan Esteban Calle', 'juan@gmail.com', '3127827845', '5', 10),
(4, 'Daniel Duque', 'dani@gmail.com', '3127827845', '6', 11),
(6, 'Angie Rios', 'angie@gmail.com', '3245678978', '5', 11),
(7, 'Daniel Gallego', 'daniel@gmail.com', '3245678978', '8', 13),
(9, 'David Gonzales', 'david@gmail.com', '3245678978', '5', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `direccionamiento` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `descripcion`, `direccionamiento`) VALUES
(1, 'Motivos Económicos', 'El aprendiz posee problemas económicos', 'Coordinador académico'),
(3, 'Motivos Sociales', 'El aprendiz presenta problemas de discriminación en el SENA', 'Coordinador académico'),
(8, 'Motivos Familiares ', 'El aprendiz posee tristeza ', 'Coordinador de formación'),
(9, 'Motivos Laborales', 'Afecto de horario por su trabajo', 'Coordinador de formación'),
(10, 'Prueba', 'Prueba', 'Coordinador académico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa`
--

CREATE TABLE `causa` (
  `idCausa` int(11) NOT NULL,
  `causa` varchar(100) NOT NULL,
  `variables` varchar(100) NOT NULL,
  `fkIdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `causa`
--

INSERT INTO `causa` (`idCausa`, `causa`, `variables`, `fkIdCategoria`) VALUES
(1, 'No cuento con recursos económicos para estudiar en el SENA', 'Necesidad del auto sostenimiento del aprendiz', 1),
(2, 'Tuve que dedicarme a trabajar por no contar con apoyo economico para dedicarme a estudiar', 'Necesidad del auto sostenimiento del aprendiz', 1),
(3, 'Me sentí discriminado por mis instructores o personal del SENA', 'Relación entre pares', 3),
(11, 'No cuento con recursos económicos para estudiar en el SENA', 'Relación entre pares', 1),
(12, 'Mi trabajo no me deja tiempo para estudiar', 'Rol laboral', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_reporte`
--

CREATE TABLE `causa_reporte` (
  `fkIdReporte` int(11) NOT NULL,
  `fkIdCausa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `causa_reporte`
--

INSERT INTO `causa_reporte` (`fkIdReporte`, `fkIdCausa`) VALUES
(3, 1),
(3, 3),
(4, 3),
(3, 2),
(4, 1),
(6, 2),
(16, 1),
(16, 3),
(16, 12),
(16, 2),
(17, 1),
(17, 3),
(18, 1),
(19, 1),
(19, 3),
(20, 2),
(21, 1),
(22, 1),
(22, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estrategias`
--

CREATE TABLE `estrategias` (
  `idEstrategias` int(11) NOT NULL,
  `estrategia` varchar(255) NOT NULL,
  `fkIdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `estrategias`
--

INSERT INTO `estrategias` (`idEstrategias`, `estrategia`, `fkIdCategoria`) VALUES
(2, 'Orientar al aprendiz sobre las oportunidades a aplicar a apoyos socioeconómicos.', 1),
(3, 'Organización de grupos focales o campañas con aprendices para orientación de herramientas o habilidades sociales y sana convivencia entre pares.', 3),
(6, 'Organización de grupos focales o campañas con aprendices para orientación de herramientas o habilidades sociales y sana convivencia entre pares ', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `ficha` varchar(45) NOT NULL,
  `jornada` varchar(45) NOT NULL,
  `modalidad` varchar(45) NOT NULL,
  `fkIdProgramaFormacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `ficha`, `jornada`, `modalidad`, `fkIdProgramaFormacion`) VALUES
(10, '2873711', 'Diurna', 'Presencial', 1),
(11, '299200', 'Mixta', 'Presencial', 3),
(13, '2873456', 'Diurna', 'Presencial', 5),
(15, '299299', 'Diurna', 'Presencial', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intervencion`
--

CREATE TABLE `intervencion` (
  `idIntervencion` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `descripcion` text NOT NULL,
  `fkIdEstrategias` int(11) NOT NULL,
  `fkIdReporte` int(11) NOT NULL,
  `fkIdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `intervencion`
--

INSERT INTO `intervencion` (`idIntervencion`, `fechaCreacion`, `descripcion`, `fkIdEstrategias`, `fkIdReporte`, `fkIdUsuario`) VALUES
(1, '2025-04-16 07:09:00', 'Se habla con el aprendiz sobre el caso de los problemas económicos que tiene y tanto familiares.', 2, 4, 3),
(2, '2025-04-09 20:37:00', 'Se realiza atención psicológica al aprendiz por comportamientos de rabia y problemas mentales', 3, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programaformacion`
--

CREATE TABLE `programaformacion` (
  `idProgramaFormacion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `programaformacion`
--

INSERT INTO `programaformacion` (`idProgramaFormacion`, `nombre`) VALUES
(1, 'Análisis y Desarrollo de Software'),
(2, 'Electrónica'),
(3, 'Automatización Industrial'),
(5, 'Mantenimiento de Equipos Biomédicos'),
(6, 'Mecánica Industrial'),
(8, 'Motores Diesel'),
(9, 'Computación CNC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `idReporte` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `direccionamiento` varchar(60) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `fkIdAprendiz` int(11) NOT NULL,
  `fkIdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`idReporte`, `fechaCreacion`, `descripcion`, `direccionamiento`, `estado`, `fkIdAprendiz`, `fkIdUsuario`) VALUES
(3, '2025-03-30 09:30:00', 'Aprendiz con problemas actitudinales', 'Coordinador de formación', 'En proceso', 2, 3),
(4, '2025-03-31 10:45:00', 'Aprendiz con problemas académicos', 'Coordinador académico', 'Registrado', 2, 1),
(6, '2025-03-20 09:05:00', 'Aprendiz es insoportable en clase', 'Coordinador académico', 'En proceso', 3, 1),
(11, '2025-04-23 11:19:00', ' Aprendiz agrede físicamente a otro aprendiz dentro el ambiente de formación', 'Coordinador académico', 'En proceso', 7, 1),
(12, '2025-04-28 20:31:00', 'dfdsfdsfdsfddfdsfdsf', 'Coordinador académico', 'Registrado', 3, 3),
(13, '2025-04-28 21:24:00', 'hghgfhgfhf', 'Coordinador de formación', 'En proceso', 6, 1),
(14, '2025-04-28 21:25:00', 'hgjghjghjghjhgj', 'Coordinador de formación', 'En proceso', 4, 1),
(15, '2025-04-28 21:25:00', 'dfgdfgfdgdg', 'Coordinador de formación', 'En proceso', 2, 3),
(16, '2025-05-12 10:31:00', 'Prueba 1', 'Coordinador académico', 'En proceso', 3, 3),
(17, '2025-05-12 10:34:00', 'Prueba 2', 'Coordinador académico', 'Registrado', 2, 3),
(18, '2025-05-12 11:26:00', 'Prueba 3', 'Coordinador de formación', 'En proceso', 2, 4),
(19, '2025-05-14 19:44:00', 'Prueba 14-05', 'Coordinador académico', 'En proceso', 3, 3),
(20, '2025-05-14 20:45:00', 'Prueba 14-05 \"2\"', 'Coordinador académico', 'En proceso', 4, 1),
(21, '2025-05-14 20:47:00', 'Prueba 15-05 \"3\"', 'Coordinador académico', 'En proceso', 3, 1),
(22, '2025-05-14 20:59:00', 'Ultima prueba 14-05', 'Coordinador académico', 'En proceso', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
(4, 'Instructor'),
(5, 'Coordinador'),
(6, 'Profesional Bienestar'),
(9, 'Vocero'),
(18, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `tipoCoordinador` varchar(50) NOT NULL,
  `gestor` tinyint(4) DEFAULT NULL,
  `fkIdRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `email`, `password`, `telefono`, `tipoCoordinador`, `gestor`, `fkIdRol`) VALUES
(1, 'Julian Salazar', 'julian@gmail.com', '$2y$10$w6K3VVm2g04kjaBixy7sz.x1hZxiOpBlrQTCk/G.EMOWwQ36CCHSW', '3245678978', 'No es coordinador', 1, 4),
(3, 'Oscar Aristizabal (Ofac)', 'ofac@gmail.com', '$2y$10$7SU075MUw2xCKHirUYl.DOutJNXTRPgzE/sfRCjO.fH5zvZnbsLva', '3127827845', 'No es coordinador', 0, 4),
(4, 'Santiago Becerra', 'santiago@gmail.com', '$2y$10$oPu/Pp7A6Q1dRycMA1S2yutr5vDrnb8TnykdSLG7MPRDgbPutK6Yi', '3127827845', 'Coordinador académico', 0, 5),
(13, 'German Estrada', 'german@gmail.com', '$2y$10$ADHhAHdLpPrvqnLs.1sdPe.a73J9O.0YnHKaEp2PParaaFe94jaSy', '3245678978', 'No es coordinador', 0, 4),
(17, 'Daniela Isaza ', 'daniela@gmail.com', '$2y$10$0/MtpfaRbooSN0QXBaHfmOp9qJnTxv5eOujHgK0FxxzSqiNJeVeS2', '3127827845', 'No es coordinador', 0, 4),
(18, 'Esteban Reyes', 'reyes@gmail.com', '$2y$10$R8JK3N2RYhKpsDMyPvKFfuh5iXvM8zdtmf71X6Qs/HkL1JUt.mTei', '3124567867', 'No es coordinador', 0, 9),
(19, 'Mariana Carvajal ', 'mariana@gmail.com', '$2y$10$EIZaWwEWbDEnRn1ebIs6NeoP5/CbwtaqmWZiK7NC3SK3qrbxHIPKq', '3245678976', 'Coordinador de formación', 0, 6),
(20, 'Jeferson Hernandez', 'admin@gmail.com', '$2y$10$z8fF2TvCCWaZgcpdyWUqR.WvwOAcPINb1yQBCfAiTg1ypW6Ud78Ei', '3113975576', 'No es coordinador', 0, 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`idAprendiz`),
  ADD KEY `fkIdGrupo` (`fkIdGrupo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `causa`
--
ALTER TABLE `causa`
  ADD PRIMARY KEY (`idCausa`),
  ADD KEY `fk_causa_categoria` (`fkIdCategoria`);

--
-- Indices de la tabla `causa_reporte`
--
ALTER TABLE `causa_reporte`
  ADD KEY `fkIdReporte2` (`fkIdReporte`),
  ADD KEY `fkIdCausa2` (`fkIdCausa`);

--
-- Indices de la tabla `estrategias`
--
ALTER TABLE `estrategias`
  ADD PRIMARY KEY (`idEstrategias`),
  ADD KEY `fkIdCategoria` (`fkIdCategoria`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `fkIdProgramaFormacion` (`fkIdProgramaFormacion`);

--
-- Indices de la tabla `intervencion`
--
ALTER TABLE `intervencion`
  ADD PRIMARY KEY (`idIntervencion`),
  ADD KEY `fkIdEstrategias` (`fkIdEstrategias`),
  ADD KEY `fkIdReporte` (`fkIdReporte`),
  ADD KEY `fkIdUsuario3` (`fkIdUsuario`);

--
-- Indices de la tabla `programaformacion`
--
ALTER TABLE `programaformacion`
  ADD PRIMARY KEY (`idProgramaFormacion`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `fkIdAprendiz` (`fkIdAprendiz`),
  ADD KEY `fkIdUsuario2` (`fkIdUsuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fkIdRol` (`fkIdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  MODIFY `idAprendiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `causa`
--
ALTER TABLE `causa`
  MODIFY `idCausa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estrategias`
--
ALTER TABLE `estrategias`
  MODIFY `idEstrategias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `intervencion`
--
ALTER TABLE `intervencion`
  MODIFY `idIntervencion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `programaformacion`
--
ALTER TABLE `programaformacion`
  MODIFY `idProgramaFormacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `fkIdGrupo` FOREIGN KEY (`fkIdGrupo`) REFERENCES `grupo` (`idGrupo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `causa`
--
ALTER TABLE `causa`
  ADD CONSTRAINT `fk_causa_categoria` FOREIGN KEY (`fkIdCategoria`) REFERENCES `categoria` (`idCategoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `causa_reporte`
--
ALTER TABLE `causa_reporte`
  ADD CONSTRAINT `fkIdCausa2` FOREIGN KEY (`fkIdCausa`) REFERENCES `causa` (`idCausa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdReporte2` FOREIGN KEY (`fkIdReporte`) REFERENCES `reporte` (`idReporte`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estrategias`
--
ALTER TABLE `estrategias`
  ADD CONSTRAINT `fkIdCategoria` FOREIGN KEY (`fkIdCategoria`) REFERENCES `categoria` (`idCategoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fkIdProgramaFormacion` FOREIGN KEY (`fkIdProgramaFormacion`) REFERENCES `programaformacion` (`idProgramaFormacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `intervencion`
--
ALTER TABLE `intervencion`
  ADD CONSTRAINT `fkIdEstrategias` FOREIGN KEY (`fkIdEstrategias`) REFERENCES `estrategias` (`idEstrategias`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdReporte` FOREIGN KEY (`fkIdReporte`) REFERENCES `reporte` (`idReporte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdUsuario3` FOREIGN KEY (`fkIdUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `fkIdAprendiz` FOREIGN KEY (`fkIdAprendiz`) REFERENCES `aprendiz` (`idAprendiz`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkIdUsuario2` FOREIGN KEY (`fkIdUsuario`) REFERENCES `usuario` (`idUsuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fkIdRol` FOREIGN KEY (`fkIdRol`) REFERENCES `rol` (`idRol`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
