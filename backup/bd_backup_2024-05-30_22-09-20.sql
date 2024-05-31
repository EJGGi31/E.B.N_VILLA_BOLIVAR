

-- Estructura de la tabla `alumno`
CREATE TABLE `alumno` (
  `ci_escolar` varchar(15) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `fecha_nac` date NOT NULL,
  `lugar_nac` varchar(150) NOT NULL,
  PRIMARY KEY (`ci_escolar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `alumno`


-- Estructura de la tabla `cortes`
CREATE TABLE `cortes` (
  `cod_corte` int(15) NOT NULL,
  `lapso` varchar(3) NOT NULL,
  `resumen` text NOT NULL,
  PRIMARY KEY (`cod_corte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `cortes`


-- Estructura de la tabla `nivel`
CREATE TABLE `nivel` (
  `cod_nivel` int(15) NOT NULL,
  `grado` varchar(3) NOT NULL,
  `seccion` varchar(1) NOT NULL,
  `matricula` int(10) NOT NULL,
  PRIMARY KEY (`cod_nivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `nivel`
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('1', '1er', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('2', '1er', 'B', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('3', '2do', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('4', '2do', 'B', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('5', '3er', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('6', '3er', 'B', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('7', '4to', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('8', '4to', 'B', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('9', '5to', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('10', '5to', 'B', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('11', '6to', 'A', '30');
INSERT INTO `nivel` (`cod_nivel`, `grado`, `seccion`, `matricula`) VALUES ('12', '6to', 'B', '30');


-- Estructura de la tabla `preguntas_seguridad`
CREATE TABLE `preguntas_seguridad` (
  `cod_pregunta` int(4) NOT NULL,
  `1era_seguridad` varchar(150) NOT NULL,
  `respuesta_1` varchar(150) NOT NULL,
  `2da_seguridad` varchar(150) NOT NULL,
  `respuesta_2` varchar(150) NOT NULL,
  PRIMARY KEY (`cod_pregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `preguntas_seguridad`


-- Estructura de la tabla `tipo_usuario`
CREATE TABLE `tipo_usuario` (
  `rol_user` varchar(50) NOT NULL,
  PRIMARY KEY (`rol_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `tipo_usuario`
INSERT INTO `tipo_usuario` (`rol_user`) VALUES ('Control De Estudio');
INSERT INTO `tipo_usuario` (`rol_user`) VALUES ('Director');
INSERT INTO `tipo_usuario` (`rol_user`) VALUES ('Soporte Técnico');


-- Estructura de la tabla `usuario`
CREATE TABLE `usuario` (
  `nacionalidad` varchar(2) NOT NULL,
  `ci` varchar(12) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `contrasena` varchar(8) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`ci`),
  KEY `tipo_usuario` (`tipo_usuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


-- Datos de la tabla `usuario`
