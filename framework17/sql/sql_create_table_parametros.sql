
CREATE TABLE IF NOT EXISTS `parametros` (
  `id_parametros` int(11) NOT NULL auto_increment,
  `id_form` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `nombre` varchar(45) NOT NULL default '',
  `valor` text NOT NULL,
  `descripcion` text NOT NULL COMMENT 'descripcion de su declaracion',
  `tipo_campo` varchar(32) NOT NULL,
  PRIMARY KEY  (`id_parametros`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `parametros`
--

INSERT INTO `parametros` (`id_parametros`, `id_form`, `nombre`, `valor`, `descripcion`, `tipo_campo`) VALUES
(1, '2009-08-06 21:06:34', 'CONFIG_TITULO_APLICACION', 'Mini Web apps', '', 'texto_plano'),
(2, '2009-08-06 21:06:34', 'CONFIG_GUI_PAGINACION', '15', '', 'texto_plano'),
(18, '2009-08-06 21:06:34', 'CONFIG_CODE_GOOGLE_ANALYTICS', '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>\r\n<script type="text/javascript">\r\n_uacct = "UA-2722755-1";\r\nurchinTracker();\r\n</script>\r\n', '', 'texto_plano'),
(19, '2009-08-06 21:06:34', 'CONFIG_PATH_SQL', 'sql/', '', 'texto_plano'),
(20, '2009-08-06 21:06:34', 'CONFIG_PATH_TPL_ADMIN', 'tpl/admin/', 'tpl/admin/', 'texto_plano'),
(21, '2009-08-06 21:06:34', 'CONFIG_PATH_TPL_PUB', 'tpl/pub/', '', 'texto_plano'),
(22, '2009-08-06 21:06:34', 'CONFIG_PATH_TPL_PUBLIC', 'tpl/public/', '', 'texto_plano'),
(23, '2009-08-06 21:06:34', 'CONFIG_PATH_INC_ADMIN', 'inc/admin/', '', 'texto_plano'),
(24, '2009-08-06 21:06:34', 'CONFIG_PATH_INC_PUB', 'inc/pub/', '', 'texto_plano'),
(25, '2009-08-06 21:06:34', 'CONFIG_PATH_INC_PUBLIC', 'inc/public/', '', 'texto_plano'),
(26, '2009-08-06 21:06:34', 'CONFIG_PATH_LIB', 'lib/', '', 'texto_plano'),
(27, '2009-08-06 21:06:34', 'CONFIG_PATH_PKG', 'pkgs/', '', 'texto_plano'),
(28, '2009-08-06 21:06:34', 'CONFIG_PATH_CALENDAR', 'calendar/', '', 'texto_plano'),
(29, '2009-08-06 21:06:34', 'CONFIG_MODO_DEPURACION', '1', '', 'texto_plano'),
(30, '2009-08-06 21:06:34', 'CONFIG_PATH_CSS', 'css/', '', 'texto_plano'),
(31, '2009-08-06 21:06:34', 'CONFIG_PATH_JS', 'js/', '', 'texto_plano'),
(32, '2009-08-06 21:06:34', 'CONFIG_PATH_IMAGES', 'images/', '', 'texto_plano'),
(33, '2009-08-06 21:06:34', 'CONFIG_LOGIN_TABLA', 'administrador', '', 'texto_plano'),
(34, '2009-08-06 21:06:34', 'CONFIG_LOGIN_TABLA_USER', 'cliente', '', 'texto_plano'),
(35, '2009-08-06 21:06:34', 'CONFIG_SMS_GATEWAY', '192.168.0.59', '', 'texto_plano'),
(36, '2009-08-06 21:06:34', 'CONFIG_SMS_GATEWAY_PORT', '8800', '', 'texto_plano'),
(37, '2009-08-06 21:06:34', 'CONFIG_MERCHAT_ID_GOOGLECHECKOUT', '', '', 'texto_plano'),
(38, '2009-08-06 21:06:34', 'CONFIG_MERCHAT_KEY_GOOGLECHECKOUT', '', '', 'texto_plano'),
(39, '2009-08-06 21:06:34', 'CONFIG_SERVER_TYPE_GOOGLECHECKOUT', '', '', 'texto_plano'),
(40, '2009-08-06 21:06:34', 'CONFIG_CURRENCY_GOOGLECHECKOUT', 'USD', '', 'texto_plano'),
(41, '2009-08-06 21:06:34', 'CONFIG_EDITCARTURL_GOOGLECHECKOUT', '', '', 'texto_plano'),
(42, '2009-08-06 21:06:34', 'CONFIG_CONTINUESHOPPINGURL_GOOGLECHECKOUT', '', '', 'texto_plano'),
(43, '2009-08-06 21:06:34', 'CONFIG_GUI_PAGINACION_PUB', '5', '', 'texto_plano');
