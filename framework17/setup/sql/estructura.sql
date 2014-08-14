-- 
-- ================================================================
-- Cyberfuel - Estructura de la base de datos
-- ================================================================

--
-- Estructura de la tabla `administrador`
-- 
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` varchar(32) NOT NULL DEFAULT '',
  `login` varchar(32) NOT NULL DEFAULT '',
  `clave` varchar(32) NOT NULL DEFAULT '',
  `nombre` varchar(72) NOT NULL DEFAULT '',
  `email` varchar(72) NOT NULL,
  `tipo_usuario` varchar(12) NOT NULL DEFAULT '',
  `estado` set('ACTIVO','INACTIVO') NOT NULL DEFAULT '',
  `ultimo_acceso` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(25) NOT NULL DEFAULT '',
  `foto_perfil` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_administrador`),
  UNIQUE INDEX `id_administrador` USING BTREE (`id_administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- 
-- Volcado de datos para la tabla `administrador`
-- 
INSERT INTO `administrador` (`id_administrador`,`id_form`,`login`,`clave`,`nombre`,`email`,`tipo_usuario`,`estado`,`ultimo_acceso`,`ip_address`) VALUES 
 (NULL,NOW(),'cyberfuel','cyberfuel','Administrador','info@cyberfuel.com','1','ACTIVO','','');

-- 
-- Estructura de la tabla `parametros`
-- 
DROP TABLE IF EXISTS `parametros`;
CREATE TABLE `parametros` (
  `id_parametros` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nombre` varchar(45) NOT NULL DEFAULT '',
  `valor` text NOT NULL,
  `descripcion` text NOT NULL COMMENT 'descripcion de su declaracion',
  `tipo_campo` varchar(32) NOT NULL,
  `tipo` set('sistema','usuario') NOT NULL DEFAULT 'sistema' COMMENT 'Define si los parametros son propios del sistema o modificables',
  PRIMARY KEY (`id_parametros`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- 
-- Volcado de datos para la tabla `parametros`
-- 
INSERT INTO `parametros` (`id_parametros`,`id_form`,`nombre`,`valor`,`descripcion`,`tipo_campo`,`tipo`) VALUES 
 (NULL,NOW(),'CONFIG_TITULO_APLICACION','E-PHP FrameWork Versión 2.0 2014','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_VERSION_APLICACION','1.6','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_GUI_PAGINACION','5','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_CODE_GOOGLE_ANALYTICS','','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_PATH_SQL','sql/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_TPL_ADMIN','tpl/admin/','tpl/admin/','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_TPL_PUB','tpl/pub/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_TPL_PUBLIC','tpl/public/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_INC_ADMIN','inc/admin/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_INC_PUB','inc/pub/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_INC_PUBLIC','inc/public/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_LIB','lib/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_PKG','pkgs/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_CALENDAR','calendar/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_MODO_DEPURACION','1','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_CSS','css/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_JS','js/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_PATH_IMAGES','images/','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_LOGIN_TABLA','administrador','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_LOGIN_TABLA_USER','cliente','','texto_plano','sistema'),
 (NULL,NOW(),'CONFIG_GUI_PAGINACION_PUB','5','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_COMPANY_NAME','Cyberfuel S.A','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_ARRAY_IMAGES_TYPE','png,jpeg,jpg,gif','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_PATH_DOCUMENTS','documents/','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_HEIGHT_SMALL','250','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_WIDTH_SMALL','250','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_HEIGHT_MEDIUM','768','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_WIDTH_MEDIUM','768','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_HEIGHT_LARGE','1024','','texto_plano','usuario'),
 (NULL,NOW(),'CONFIG_IMAGE_WIDTH_LARGE','1024','','texto_plano','usuario');

-- 
-- Volcado de datos para la tabla `archivos_inc_tpl`
-- 
/* NADA TODAVIA */

-- 
-- Estructura de la tabla `noticias`
-- 
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `id_noticias` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` varchar(32) NOT NULL,
  `titulo_noticia` varchar(255) NOT NULL,
  `resumen_noticia` text NOT NULL,
  `contenido_noticia` text NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `foto_principal` varchar(255) NOT NULL,
  PRIMARY KEY (`id_noticias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
 
-- 
-- Estructura de la tabla `secciones_web`
-- 
DROP TABLE IF EXISTS `secciones_web`;
CREATE TABLE `secciones_web` (
  `id_secciones_web` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` varchar(10) NOT NULL,
  `codigo_seccion` varchar(32) NOT NULL,
  `nombre_seccion_espanol` varchar(255) NOT NULL COMMENT 'Nombre de la pagina',
  `nombre_pagina_url_espanol_html` text NOT NULL COMMENT 'nombre que debe mostrarse en el url address bar, se utilizar como nombre del link',
  `nombre_opt_menu_espanol` varchar(32) NOT NULL COMMENT 'Nombre de la opcion de menu en Espanol',
  `contenido_espanol_html` text NOT NULL COMMENT 'Cuerpo_pagina',
  `descripcion_espanol` text NOT NULL COMMENT 'utilizado para SEO en el codigo fuente',
  `keywords_espanol` text NOT NULL COMMENT 'SEO utilizado para el codigo fuente',
  `nombre_seccion_ingles` text NOT NULL COMMENT 'nombre del Web PageTittle',
  `nombre_pagina_url_ingles_html` text NOT NULL COMMENT 'nombre que debe mostrarse en el url address bar, se utilizar como nombre del link',
  `nombre_opt_menu_ingles` varchar(32) NOT NULL COMMENT 'nombre de la opcion del Menu en Ingles',
  `contenido_ingles_html` text NOT NULL COMMENT 'Cuerpo_pagina',
  `descripcion_ingles` text NOT NULL COMMENT 'utilizado para SEO en el codigo fuente',
  `keywords_ingles` text NOT NULL COMMENT 'SEO utilizado para el codigo fuente',
  PRIMARY KEY (`id_secciones_web`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Estructura de tabla para la tabla `breadcrumbs`
--

DROP TABLE IF EXISTS `breadcrumbs`;
CREATE TABLE IF NOT EXISTS `breadcrumbs` (
  `id_breadcrumbs` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) DEFAULT NULL,
  `breadcrumbs` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `fk_id_breadcrumbs` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_breadcrumbs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `breadcrumbs` VALUES (NULL, 'n_breadcrumbs', 'Editar Titulos', 'titulos, pantallas', 2, 'Mantenimiento de Titulos');
INSERT INTO `breadcrumbs` VALUES (NULL, 'breadcrumbs', 'Títulos', '', 0, 'Listado de titulos');
INSERT INTO `breadcrumbs` VALUES (NULL, 'usuarios', 'Usuarios Sistema', 'usuario, usuarios, listado usuarios', 0, 'Catálogo de usuario');
INSERT INTO `breadcrumbs` VALUES (NULL, 'nmusuario', 'Editar usuario', 'mantenimiento usuarios', 3, 'Mantenimiento de usuario');
INSERT INTO `breadcrumbs` VALUES (NULL, 'sistema', 'Configuración', '', 0, 'Mantenimiento de parámetros de sistema');
INSERT INTO `breadcrumbs` VALUES (NULL, 'modificar_parametro', 'Configuración', '', 5, 'Editar Parámetros');
INSERT INTO `breadcrumbs` VALUES (NULL, 'contenidos_web', 'Mis Páginas Web', '', 0, 'Mantenimiento de páginas');
INSERT INTO `breadcrumbs` VALUES (NULL, 'n_contenido_web', 'Mis Páginas Web', '', 7, 'Edición de Mi página Web');
INSERT INTO `breadcrumbs` VALUES (NULL, 'mensajes', 'Mensajes', 'mensajes', 0, 'Registro de mensajería');




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE IF NOT EXISTS `mensaje` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `asunto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `ip` varchar(19) DEFAULT NULL,
  `navegador` varchar(255) DEFAULT NULL,
  `estado` set('leido','no leido','borrado') DEFAULT 'no leido',
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;