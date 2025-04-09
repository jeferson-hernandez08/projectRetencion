-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2025 a las 23:44:46
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
(4, 'Daniel Duque', 'dani@gmail.com', '3127827845', '6', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `direccionamiento` varchar(60) NOT NULL,
  `fkIdCausa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `descripcion`, `direccionamiento`, `fkIdCausa`) VALUES
(1, 'Motivos EconÃ³micos', 'El aprendiz posee problemas econÃ³micos', 'Coordinador de formaciÃ³n', 1),
(3, 'Motivos Sociales', 'El aprendiz presenta problemas de discriminaciÃ³n en el SENA', 'Coordinador de formaciÃ³n', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa`
--

CREATE TABLE `causa` (
  `idCausa` int(11) NOT NULL,
  `causa` varchar(100) NOT NULL,
  `variables` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `causa`
--

INSERT INTO `causa` (`idCausa`, `causa`, `variables`) VALUES
(1, 'No cuento con recursos econÃ³micos para estudiar en el SENA', 'Necesidad del auto sostenimiento del aprendiz'),
(2, 'Tuve que dedicarme a trabajar por no contar con apoyo economico para dedicarme a estudiar', 'Necesidad del auto sostenimiento del aprendiz'),
(3, 'Me sentÃ­ discriminado por mis instructores o personal del SENA', 'RelaciÃ³n entre pares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_reporte`
--

CREATE TABLE `causa_reporte` (
  `fkIdReporte` int(11) NOT NULL,
  `fkIdCausa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(2, 'Orientar al aprendiz sobre las oportunidades a aplicar a apoyos socioeconÃ³micos.', 1),
(3, 'OrganizaciÃ³n de grupos focales o campaÃ±as con aprendices para orientaciÃ³n de herramientas o habilidades sociales y sana convivencia entre pares.', 3);

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
(11, '299200', 'Mixta', 'Presencial', 3);

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
(1, 'AnÃ¡lisis y Desarrollo de Software'),
(2, 'ElectrÃ³nica'),
(3, 'AutomatizaciÃ³n Industrial');

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
(3, '2025-03-30 09:30:00', 'Aprendiz con problemas actitudinales', 'Coordinador de formaciÃ³n', 'En proceso', 2, 3),
(4, '2025-03-31 10:45:00', 'Aprendiz con problemas acadÃ©micos', 'Coordinador acadÃ©mico', 'Registrado', 2, 1),
(6, '2025-03-20 09:05:00', 'Aprendiz es insoportable en clase', 'Coordinador acadÃ©mico', 'En proceso', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `idResultado` int(11) NOT NULL,
  `resultadocol` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(7, 'Vocero');

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
(1, 'Julian Salazar', 'julian@gmail.com', '123', '3245678978', 'No es coordinador', 1, 4),
(3, 'Oscar Aristizabal (Ofac)', 'ofac@gmail.com', '123', '3127827845', 'No es coordinador', 0, 4),
(4, 'Santiago Becerra', 'santiago@gmail.com', '123', '3127827845', 'Coordinador acadÃ©mico', 0, 5);

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
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `fkIdCausa` (`fkIdCausa`);

--
-- Indices de la tabla `causa`
--
ALTER TABLE `causa`
  ADD PRIMARY KEY (`idCausa`);

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
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`idResultado`);

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
  MODIFY `idAprendiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `causa`
--
ALTER TABLE `causa`
  MODIFY `idCausa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estrategias`
--
ALTER TABLE `estrategias`
  MODIFY `idEstrategias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `intervencion`
--
ALTER TABLE `intervencion`
  MODIFY `idIntervencion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programaformacion`
--
ALTER TABLE `programaformacion`
  MODIFY `idProgramaFormacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `idReporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `fkIdGrupo` FOREIGN KEY (`fkIdGrupo`) REFERENCES `grupo` (`idGrupo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fkIdCausa` FOREIGN KEY (`fkIdCausa`) REFERENCES `causa` (`idCausa`) ON UPDATE CASCADE;

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
