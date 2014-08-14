<?php
setcookie("CYBER_FRAMEWORK", "", time()-3600);

echo '<!DOCTYPE HTML><html><head><meta charset="utf-8"><title>Cyberfuel</title></head>';

/*
 * Busca el archivo config.inc.php dentro de la carpeta 'config'
 * Si ese archivo NO existe, entonces ejecuta el instalador.
 */
if (!file_exists("../config/config.inc.php")) {
	if (file_exists("install.php")) {
		 header("Location: install.php");
	}
	else {
		die("<div style='text-align:center'>" 
		. "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
		. "font-family: Arial; font-size: 0.9em; margin-left:auto; margin-right:auto; margin-top:50px; display:inline-block'>" 
		. "<strong>Atención: </strong>El archivo de configuración esta perdido y una nueva instalación no se puede llevar a cabo. El archivo <em>install.php</em> no puede ser encontrado.</span></div>    <body></body></html>");
	}
}
else {
	die("<div style='text-align:center'>" 
	  . "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
	  . "font-family: Arial; font-size: 0.9em; margin-left:auto; margin-right:auto; margin-top:50px; display:inline-block'>" 
	  . "<strong>Atención: </strong>El archivo <em>config.inc.php</em> ya existe!<br>Si usted realmente desea reinstalar el Framework de Cyberfuel primero debe borrar el archivo <em>config.inc.php</em> de la carpeta <em>/config/</em>.</span></div>    <body></body></html>");
}
?>