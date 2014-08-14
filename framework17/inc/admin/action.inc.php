<?php
session_start();
 
if (!isset($_COOKIE['language'])) {
   $_COOKIE['lenguaje'] = 'espanol';   #Warning NO ELIMINAR
   $_COOKIE['language'] = "es/";			#Warning NO ELIMINAR
}

# Cargando las librerías
require_once('config/config.inc.php');

# Default del action.
$_GET['action'] = ($_GET['action'] == "")?"admin_inicio":$_GET['action'];
$_GET['action'] = ($_GET['action_db'] != '')?"respaldo": $_GET['action'];	

# Login
if ($_GET["action"] != 'captcha'){
	require_once(CONFIG_PATH_LIB.'login_admin.inc.php');
	if ($_SESSION['script_name'] != 'admin'){
		mensaje('Los permisos asignados a su usuario no permiten ingresar en esta sección','Acceso no autorizado al sistema');
		exit;
	}
}else{
	include(CONFIG_PATH_INC_ADMIN.'captcha.inc.php');
}

ob_start();
		
/*
if(link_verify() !== true){
  include(CONFIG_PATH_INC_ADMIN.'desconectar.inc.php'); 
}
*/
		
switch ($_GET["action"]){
	# Cuando la salida debe ser sin el include del archivo index.tpl.php
	case "imagethumb":    include(CONFIG_PATH_INC_ADMIN.'imagen_thumb.inc.php');	$salida = ob_get_contents();ob_clean();echo $salida; break;
	# Cuando la salida debe ser sin el include del archivo index.tpl.php
	case "barcode":	    include(CONFIG_PATH_INC_ADMIN.'barcode.inc.php');     	$salida = ob_get_contents();ob_clean();echo $salida; break;
	# FLEX proceso: Procesa el agregado de una nueva noticia.
	case "post_noticia":  include(CONFIG_PATH_INC_ADMIN.'post_noticia.inc.php');  $salida = ob_get_contents();ob_clean();echo $salida; break;
	default:
		include(CONFIG_PATH_INC_ADMIN.$_GET['action'].'.inc.php');
		$salida = ob_get_contents();
		ob_clean();
		if (!isset($_GET['flw'])){
			include(CONFIG_PATH_TPL_ADMIN.'index.tpl.php');
		}else{
			echo $salida; 
		}
		break;
}
	
?>