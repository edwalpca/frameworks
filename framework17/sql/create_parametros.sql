
--
-- Table structure for table `parametros`
--

CREATE TABLE IF NOT EXISTS `parametros` (
  `id_parametros` int(11) NOT NULL auto_increment,
  `id_form` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `nombre` varchar(45) NOT NULL default '',
  `valor` text NOT NULL,
  `tipo_campo` varchar(32) NOT NULL,
  PRIMARY KEY  (`id_parametros`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `parametros`
--

INSERT INTO `parametros` (`id_parametros`, `id_form`, `nombre`, `valor`, `tipo_campo`) VALUES
(1, '2008-11-02 20:34:55', 'titulo_aplicacion', 'titulo_aplicacion', ''),
(2, '2008-08-02 16:10:12', 'cantidad_datos_por_pagina', '10', 'texto_plano'),
(3, '2008-11-02 20:35:06', 'correo_remitente', 'info@correo_remitente.com', 'texto_plano'),
(4, '2008-08-02 16:44:20', 'texto_bienvenida', '<p>texto_bienvenida</p>', 'texto_html'),
(5, '2008-08-02 17:50:23', 'texto_pag_contactenos', '<h2>texto_pag_contactenos</h2>', 'texto_html'),
(6, '2008-10-04 18:13:47', 'mail_server', 'localhost', 'texto_plano'),
(7, '2008-11-02 20:35:22', 'from_mail_name_server', 'info@from_mail_name_server.com', 'texto_plano'),
(8, '2008-12-08 23:05:00', 'from_mail_contact_name_server', 'Contact Form WebSite.com', 'texto_plano'),
(9, '2008-09-14 14:03:52', 'from_mail_subject_notification_doc', 'Contactenos Web', 'texto_plano'),
(10, '2008-09-14 14:04:30', 'from_mail_signature_notification_doc', '<p>WebSite Signature</p>', 'texto_html'),
(11, '2008-10-30 22:00:07', 'texto_pagina_servicios', '<p>texto</p>', 'texto_html'),
(12, '2008-12-02 20:47:27', 'texto_recordar_clave_ingles', 'WebSite', 'texto_plano'),
(13, '2008-12-02 20:47:27', 'texto_recordar_clave_espanol', 'WebSite', 'texto_plano'),
(14, '2008-12-03 16:10:37', 'config_texto_bienvenida_ingles', 'Welcome to WebSite.com', 'texto_plano'),
(15, '2008-12-03 16:10:37', 'config_texto_bienvenida_espanol', 'Welcome to WebSite.com', 'texto_plano');