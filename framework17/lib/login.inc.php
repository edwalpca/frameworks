<?php

	# Cargando configuración
	require_once('config/config.inc.php');
	require_once('lib/util.inc.php');
	require_once('lib/db.inc.php');
	
	# Activando la sessión
	session_start();
	
	# Parámetros para la plantilla de ingreso
	$msj_login = '';

	# Este archivo funciona como medio de validación para incluir en cualquier archivo
	$_POST['verifica'] = $_SESSION["verifica"];
	if ($_SESSION['activa'] != 1){
		if (isset($_POST["frmauthsend"])){
			
			
			if ($_POST['verifica'] == $_SESSION["verifica"]){
			
				# Verificando si el usuario transmitido existe registrado en la base de datos
				# Se limpian los datos con mysql_real_escape_string para hacer los datos mas seguros y evitar SQL inyection
				$sent = sprintf("SELECT id_usuario, usuario, permisos, email FROM `%s` WHERE `estado` = 1 AND `usuario` = '%s' AND `password` = '%s' LIMIT 1",
            	mysql_real_escape_string( CONFIG_LOGIN_TABLA ),
            	mysql_real_escape_string($_POST["usuario"]),
					mysql_real_escape_string($_POST["password"]));
				
				$cons = sql($sent);
				
				if (sql_num_rows($cons) == 1){
					
					$reg = sql_fetch_array($cons);
					
					# Creando las variables de session
					$_SESSION["activa"] = 1;
					$_SESSION["usuario"] = $reg["usuario"];
					$_SESSION["id_usuario"] = $reg["id_usuario"];
					$_SESSION["permisos"] = $reg["permisos"];
					$_SESSION["email"] = $reg["email"];
					$_SESSION["foto_perfil"] = $reg["foto_perfil"];
					$_SESSION["script_name"] = basename($_SERVER['SCRIPT_NAME'],'.php');
		
				}else{
					
					$msj_login = "Usuario o contraseña incorrectos";
					include('tpl/login.tpl.php');
					exit;
				
				} // if
			}else{
			
					$msj_login = "Código de verificación no es correcto";
					include('tpl/login.tpl.php');
					exit;
			}
			
		}else{
			
				# Primer ingreso
				include('tpl/login.tpl.php');
				exit;
			
		} // if 

	}
	# Se continua con la carga normal de los archivos

?>