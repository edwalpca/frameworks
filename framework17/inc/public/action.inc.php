<?php
session_start();
 
if (!isset($_COOKIE['language'])) {
   $_COOKIE['lenguaje'] = 'espanol';   	#Warning NO ELIMINAR
   $_COOKIE['language'] = "es/";			#Warning NO ELIMINAR
}

# Cargando las librerías
require_once('config/config.inc.php');
 		
# default del action.
$_GET['action'] = ($_GET['action'] == "")?"inicio":$_GET['action'];		

			
ob_start();
switch ($_GET["action"]){
   # Cuando la salida debe ser sin el include del archivo index.tpl.php
   case "imagethumb":include(CONFIG_PATH_INC_PUBLIC.'imagen_thumb.inc.php');		$salida = ob_get_contents();ob_clean();echo $salida; break;
   # Cuando la salida debe ser sin el include del archivo index.tpl.php
   case "barcode":   include(CONFIG_PATH_INC_PUBLIC.'barcode.inc.php');     		$salida = ob_get_contents();ob_clean();echo $salida; break; 
   # Cuando la salida debe llevar el include del archivo index.tpl.php
   default:          include(CONFIG_PATH_INC_PUBLIC.$_GET['action'].'.inc.php');	$salida = ob_get_contents();ob_clean();include(CONFIG_PATH_TPL_PUBLIC.'index.tpl.php');break; 
}

?>