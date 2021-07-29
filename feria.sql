-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2017 a las 07:24:44
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `feria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `nombre` varchar(30) DEFAULT NULL,
  `codigoprograma` varchar(3) NOT NULL,
  `codigo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`nombre`, `codigoprograma`, `codigo`) VALUES
('Base de datos', '115', '5605'),
('calculo I', '116', '0101'),
('Seminario integrador', '115', '5609');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL,
  `idevaluador` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `idcriterio` int(11) NOT NULL,
  `observacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterioevaluacion`
--

CREATE TABLE `criterioevaluacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterioevaluacion`
--

INSERT INTO `criterioevaluacion` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Creatividad y Diseño', 'El evaluador debe determinar si presenta una organización y diseño que faciliten la presentación del proyecto de aula.'),
(2, 'Puntualidad y responsabilidad', 'Todos los participantes deben estar presentes en la evaluacion'),
(3, 'Pertinencia', 'Adecuacion de los objetivos a las necesidades de la asignatura impartida'),
(4, 'Participación', 'Se evidencia la participación del docente en el seguimiento al proyecto de aula'),
(5, 'Utilidad', 'Grado de aprovechamiento pedagogico de las experiencias y resultados del proyecto.'),
(6, 'Programacion', 'Capacidad para organizar y racionalizar todos los pasos preestablecidos.'),
(7, 'Metodologia', 'El equipo de trabajo adopto una metodologia de desarrollo del proyecto.'),
(8, 'Gestion', 'Ejecucion de las acciones dentro del marco de una programacion determinada'),
(9, 'Trabajo en equipo', 'Se evidencia la apropacion de la tematica por parte de todos los miembros del equipo de trabajo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterioferia`
--

CREATE TABLE `criterioferia` (
  `id` int(11) NOT NULL,
  `idcriterioevaluacion` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `idferia` int(11) NOT NULL,
  `idtipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterioferia`
--

INSERT INTO `criterioferia` (`id`, `idcriterioevaluacion`, `valor`, `idferia`, `idtipo`) VALUES
(1, 1, 10, 1, 1),
(2, 2, 10, 1, 1),
(3, 3, 10, 1, 2),
(4, 4, 10, 1, 2),
(5, 5, 20, 1, 2),
(6, 6, 10, 1, 2),
(7, 7, 10, 1, 2),
(8, 8, 10, 1, 2),
(9, 9, 10, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `nombre` varchar(30) NOT NULL,
  `codigo` varchar(4) NOT NULL,
  `codigoprograma` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`nombre`, `codigo`, `codigoprograma`) VALUES
('Rene Angarita', '1234', '115'),
('Pilar Rojas', '2345', '115');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoproyecto`
--

CREATE TABLE `estadoproyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadoproyecto`
--

INSERT INTO `estadoproyecto` (`id`, `nombre`, `descripcion`) VALUES
(1, 'inscripcion', 'Proyecto esta inscrito en una feria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `codigo` varchar(4) NOT NULL,
  `documento` varchar(13) NOT NULL,
  `contrasenia` varchar(8) NOT NULL,
  `codigoprograma` varchar(3) NOT NULL,
  `validarregistro` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `correo`, `codigo`, `documento`, `contrasenia`, `codigoprograma`, `validarregistro`) VALUES
(64, 'Juan David Sanchez Mancilla', 'palo1494@gmail.com', '1308', '1090505893', 'd9a1oo30', '116', NULL),
(65, 'Leabiv', 'leabiv@gmail.com', '1310', '1234', '12345', '115', 'bb16092ac181c6d02aba5a5cc1d49f2c'),
(67, 'Juan David Sanchez Mancilla', 'juandavidsm@ufps.edu.co', '1308', '1090505894', '1234567', '115', NULL),
(68, 'laura', 'lauridani1@hotmail.com', 'laur', 'laura1261', 'laura126', '115', 'dfff79e318ef82430062887915a4d0ed'),
(69, 'juan ñoño', 'palo1493@hotmail.com', '1390', '1090505897', 'd9a1oo30', '115', 'faac7afd976232de30639971c0418e8f'),
(70, 'luis alexander', 'alexanderpenaloza@gmail.com', '1151', '1090494143', 'asd', '115', '88fff171fa39603147b953534436dee6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluador`
--

CREATE TABLE `evaluador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `correo` varchar(15) NOT NULL,
  `documento` varchar(13) NOT NULL,
  `contrasenia` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluadorferia`
--

CREATE TABLE `evaluadorferia` (
  `id` int(11) NOT NULL,
  `idevaluador` int(11) NOT NULL,
  `idferia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluadorproyecto`
--

CREATE TABLE `evaluadorproyecto` (
  `id` int(11) NOT NULL,
  `idevaluadorferia` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feria`
--

CREATE TABLE `feria` (
  `id` int(11) NOT NULL,
  `fechainicio` date DEFAULT NULL,
  `resumen` text,
  `nombre` varchar(50) DEFAULT NULL,
  `fechalimiteinscripcion` date DEFAULT NULL,
  `fechafinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `feria`
--

INSERT INTO `feria` (`id`, `fechainicio`, `resumen`, `nombre`, `fechalimiteinscripcion`, `fechafinal`) VALUES
(1, NULL, 'En el marco de las asignaturas de la carrera de Ingeniería de Sistemas guiadas en el semestre, los estudiantes de la carrera desarrollan proyectos de aula, en los cuales integran sus habilidades y conocimientos adquiridos en las demás asignaturas a lo largo del semestre y de la carrera.', 'Feria de testing', '2017-10-31', NULL),
(2, NULL, 'Feria de prueba para cards', 'Feria proyectos de a', '2017-10-20', NULL),
(6, NULL, 'Feria de prueba para cards', 'Feria proyectos III', '2017-10-18', NULL),
(7, NULL, 'Feria de prueba para cards', 'Feria proyectos de proyectos de aula III', '2017-10-18', NULL),
(8, NULL, 'En el marco de las asignaturas de la carrera de Ingeniería de Sistemas guiadas en el semestre, los estudiantes de la carrera desarrollan proyectos de aula, en los cuales integran sus habilidades y conocimientos adquiridos en las demás asignaturas a lo largo del semestre y de la carrera.', 'Feria proyectos de proyectos de aula IV', '2017-10-18', NULL),
(9, NULL, 'En el marco de las asignaturas de la carrera de Ingeniería de Sistemas guiadas en el semestre, los estudiantes de la carrera desarrollan proyectos de aula, en los cuales integran sus habilidades y conocimientos adquiridos en las demás asignaturas a lo largo del semestre y de la carrera.', 'Muestra de proyectos de aula', '2017-10-18', NULL),
(10, NULL, 'En el marco de las asignaturas de la carrera de Ingeniería de Sistemas guiadas en el semestre, los estudiantes de la carrera desarrollan proyectos de aula, en los cuales integran sus habilidades y conocimientos adquiridos en las demás asignaturas a lo largo del semestre y de la carrera.', 'Muestra de proyectos de aula II', '2017-10-18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `feriapatrocinador`
--

CREATE TABLE `feriapatrocinador` (
  `idferia` int(11) NOT NULL,
  `idpatrocinador` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `feriapatrocinador`
--

INSERT INTO `feriapatrocinador` (`idferia`, `idpatrocinador`, `id`) VALUES
(1, 1, 1),
(1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Ingeniería del Software', 'La ingeniería de software es la aplicación de un enfoque sistemático, disciplinado y cuantificable al desarrollo, operación y mantenimiento de software, y el estudio de estos enfoques, es decir, el estudio de las aplicaciones de la ingeniería al software.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinador`
--

CREATE TABLE `patrocinador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `logo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `patrocinador`
--

INSERT INTO `patrocinador` (`id`, `nombre`, `logo`) VALUES
(1, 'docuxer', '2.png'),
(2, 'TKSIS LTDA', '1.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `nombre` varchar(30) DEFAULT NULL,
  `codigo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`nombre`, `codigo`) VALUES
('Ingenieria de sistemas', '115'),
('Ingenieria mecanica', '116');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `idferia` int(11) NOT NULL,
  `idlinea` int(11) NOT NULL,
  `idestado` int(11) NOT NULL,
  `titulo` varchar(30) DEFAULT NULL,
  `resumen` text NOT NULL,
  `validarunion` varchar(120) DEFAULT NULL,
  `idlider` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `idferia`, `idlinea`, `idestado`, `titulo`, `resumen`, `validarunion`, `idlider`) VALUES
(17, 1, 1, 1, 'Proyecto Prueba', 'Este proyecto es un proyecto creado para probar el metodo de registrar proyecto                ', 'b4a3220d43e2eb28dfd7f7a68a292e42', 67),
(18, 1, 1, 1, 'Proyecto de prueba', 'Este proyecto es de prueba papu                ', NULL, 67),
(21, 1, 1, 1, 'Feria proyectos de a', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', NULL, 67),
(23, 1, 1, 1, 'select * from estudi', 'select * from estudiante*#', NULL, 67),
(24, 1, 1, 1, 'proyecto para prueba asdasdasd', 'resumend e proyecto para prueba asdasdasd', '3708f7999c23c06a69dc8fe8ec5e9c76', 64);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectoestudiante`
--

CREATE TABLE `proyectoestudiante` (
  `id` int(11) NOT NULL,
  `idestudiante` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectoestudiante`
--

INSERT INTO `proyectoestudiante` (`id`, `idestudiante`, `idproyecto`) VALUES
(7, 64, 17),
(10, 64, 24),
(1, 67, 17),
(2, 67, 18),
(8, 67, 21),
(9, 67, 23),
(11, 67, 24),
(3, 70, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectotutoria`
--

CREATE TABLE `proyectotutoria` (
  `id` int(11) NOT NULL,
  `idproyecto` int(11) NOT NULL,
  `idtutoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyectotutoria`
--

INSERT INTO `proyectotutoria` (`id`, `idproyecto`, `idtutoria`) VALUES
(3, 17, 3),
(5, 17, 4),
(4, 18, 3),
(6, 21, 3),
(9, 23, 3),
(10, 23, 6),
(11, 24, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocriterio`
--

CREATE TABLE `tipocriterio` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipocriterio`
--

INSERT INTO `tipocriterio` (`id`, `descripcion`) VALUES
(1, 'Presentacion'),
(2, 'Proyecto de aula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutoria`
--

CREATE TABLE `tutoria` (
  `id` int(11) NOT NULL,
  `codigodocente` varchar(4) NOT NULL,
  `codigoasignatura` varchar(4) NOT NULL,
  `codigoprogramaasignatura` varchar(3) NOT NULL,
  `codigoprogramadocente` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tutoria`
--

INSERT INTO `tutoria` (`id`, `codigodocente`, `codigoasignatura`, `codigoprogramaasignatura`, `codigoprogramadocente`) VALUES
(7, '1234', '0101', '116', '115'),
(3, '1234', '5605', '115', '115'),
(4, '1234', '5609', '115', '115'),
(6, '2345', '5609', '115', '115');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`codigo`,`codigoprograma`),
  ADD UNIQUE KEY `uniquemateria` (`nombre`,`codigoprograma`),
  ADD KEY `fkprogramaasignatura_idx` (`codigoprograma`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquecriterioevaluador` (`idevaluador`,`idcriterio`),
  ADD KEY `fkevaluadorcalificacion_idx` (`idevaluador`),
  ADD KEY `fkcriteriocalificacion_idx` (`idcriterio`);

--
-- Indices de la tabla `criterioevaluacion`
--
ALTER TABLE `criterioevaluacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `criterioferia`
--
ALTER TABLE `criterioferia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquecriterioferia` (`idcriterioevaluacion`,`idferia`,`idtipo`),
  ADD KEY `fkcriterioevaluacion_idx` (`idcriterioevaluacion`),
  ADD KEY `fkcriterioferia_idx` (`idferia`),
  ADD KEY `fktipocriterio_idx` (`idtipo`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`codigo`,`codigoprograma`),
  ADD UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  ADD KEY `fkdocenteprograma_idx` (`codigoprograma`);

--
-- Indices de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`),
  ADD UNIQUE KEY `programa_codigo_UNIQUE` (`codigoprograma`,`codigo`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD KEY `fkestudianteprograma_idx` (`codigoprograma`);

--
-- Indices de la tabla `evaluador`
--
ALTER TABLE `evaluador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evaluadorferia`
--
ALTER TABLE `evaluadorferia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueferiaevaluador` (`idevaluador`,`idferia`),
  ADD KEY `fkevaluadorferia_idx` (`idevaluador`),
  ADD KEY `fkferiaevaluador_idx` (`idferia`);

--
-- Indices de la tabla `evaluadorproyecto`
--
ALTER TABLE `evaluadorproyecto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueproyectoevaluador` (`idevaluadorferia`),
  ADD KEY `fkevaluadorproyecto_idx` (`idevaluadorferia`),
  ADD KEY `fkproyectoevaluador_idx` (`idproyecto`);

--
-- Indices de la tabla `feria`
--
ALTER TABLE `feria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `feriapatrocinador`
--
ALTER TABLE `feriapatrocinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkferiapatrocinador_idx` (`idferia`),
  ADD KEY `fkpatrocinadorferia_idx` (`idpatrocinador`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `patrocinador`
--
ALTER TABLE `patrocinador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueproyecto` (`idferia`,`titulo`),
  ADD KEY `idferiaproyecto_idx` (`idferia`),
  ADD KEY `fklineaproyecto_idx` (`idlinea`),
  ADD KEY `fKestadoproyecto_idx` (`idestado`),
  ADD KEY `fkliderproyecto` (`idlider`);

--
-- Indices de la tabla `proyectoestudiante`
--
ALTER TABLE `proyectoestudiante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueproyectoestudiante` (`idestudiante`,`idproyecto`),
  ADD KEY `fkproyectoestudiante_idx` (`idproyecto`);

--
-- Indices de la tabla `proyectotutoria`
--
ALTER TABLE `proyectotutoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueproyectotutoria` (`idproyecto`,`idtutoria`),
  ADD KEY `fktutoriaproyecto_idx` (`idtutoria`);

--
-- Indices de la tabla `tipocriterio`
--
ALTER TABLE `tipocriterio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniquedocenteasignatura` (`codigodocente`,`codigoasignatura`,`codigoprogramaasignatura`,`codigoprogramadocente`),
  ADD KEY `fkasignaturatutoria_idx` (`codigoprogramaasignatura`,`codigoasignatura`),
  ADD KEY `fkdocentetutoria_idx` (`codigodocente`,`codigoprogramadocente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `criterioevaluacion`
--
ALTER TABLE `criterioevaluacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `criterioferia`
--
ALTER TABLE `criterioferia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `estadoproyecto`
--
ALTER TABLE `estadoproyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `evaluador`
--
ALTER TABLE `evaluador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluadorferia`
--
ALTER TABLE `evaluadorferia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `evaluadorproyecto`
--
ALTER TABLE `evaluadorproyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `feria`
--
ALTER TABLE `feria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `feriapatrocinador`
--
ALTER TABLE `feriapatrocinador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `patrocinador`
--
ALTER TABLE `patrocinador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `proyectoestudiante`
--
ALTER TABLE `proyectoestudiante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `proyectotutoria`
--
ALTER TABLE `proyectotutoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tipocriterio`
--
ALTER TABLE `tipocriterio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tutoria`
--
ALTER TABLE `tutoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fkprogramaasignatura` FOREIGN KEY (`codigoprograma`) REFERENCES `programa` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fkcriteriocalificacion` FOREIGN KEY (`idcriterio`) REFERENCES `criterioferia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkevaluadorcalificacion` FOREIGN KEY (`idevaluador`) REFERENCES `evaluadorproyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `criterioferia`
--
ALTER TABLE `criterioferia`
  ADD CONSTRAINT `fkcriterioevaluacion` FOREIGN KEY (`idcriterioevaluacion`) REFERENCES `criterioevaluacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkcriterioferia` FOREIGN KEY (`idferia`) REFERENCES `feria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fktipocriterio` FOREIGN KEY (`idtipo`) REFERENCES `tipocriterio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fkdocenteprograma` FOREIGN KEY (`codigoprograma`) REFERENCES `programa` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fkestudianteprograma` FOREIGN KEY (`codigoprograma`) REFERENCES `programa` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluadorferia`
--
ALTER TABLE `evaluadorferia`
  ADD CONSTRAINT `fkevaluadorferia` FOREIGN KEY (`idevaluador`) REFERENCES `evaluador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkferiaevaluador` FOREIGN KEY (`idferia`) REFERENCES `feria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluadorproyecto`
--
ALTER TABLE `evaluadorproyecto`
  ADD CONSTRAINT `fkevaluadorproyecto` FOREIGN KEY (`idevaluadorferia`) REFERENCES `evaluadorferia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkproyectoevaluador` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `feriapatrocinador`
--
ALTER TABLE `feriapatrocinador`
  ADD CONSTRAINT `fkferiapatrocinador` FOREIGN KEY (`idferia`) REFERENCES `feria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkpatrocinadorferia` FOREIGN KEY (`idpatrocinador`) REFERENCES `patrocinador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fKestadoproyecto` FOREIGN KEY (`idestado`) REFERENCES `estadoproyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkidferiaproyecto` FOREIGN KEY (`idferia`) REFERENCES `feria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkliderproyecto` FOREIGN KEY (`idlider`) REFERENCES `estudiante` (`id`),
  ADD CONSTRAINT `fklineaproyecto` FOREIGN KEY (`idlinea`) REFERENCES `linea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyectoestudiante`
--
ALTER TABLE `proyectoestudiante`
  ADD CONSTRAINT `fkestudianteproyecto` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkproyectoestudiante` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyectotutoria`
--
ALTER TABLE `proyectotutoria`
  ADD CONSTRAINT `fkproyectotutoria` FOREIGN KEY (`idproyecto`) REFERENCES `proyecto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fktutoriaproyecto` FOREIGN KEY (`idtutoria`) REFERENCES `tutoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutoria`
--
ALTER TABLE `tutoria`
  ADD CONSTRAINT `fkasignaturatutoria` FOREIGN KEY (`codigoprogramaasignatura`,`codigoasignatura`) REFERENCES `asignatura` (`codigoprograma`, `codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkdocentetutoria` FOREIGN KEY (`codigodocente`,`codigoprogramadocente`) REFERENCES `docente` (`codigo`, `codigoprograma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
