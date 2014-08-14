<?php

  if (!defined("_PHP_VALIDO"))
      die('El acceso directo a este archivo no está permitido.');

  function getIniSettings($aSetting)
  {
	  $out = (ini_get($aSetting) == '1' ? 'ON' : 'OFF');
	  return $out;
  }

  function obtenerEscrituraDir($aDir)
  {
	  echo '<tr>';
	  echo '<td class="elem">'.$aDir .DS.'</td>';
	  echo '<td align="left">';
	  echo is_writable(DROPBASE.$aDir) ? '<span class="yes">Escribible</span>' : '<span class="no">No escribible</span>';
	  echo '</td>';
	  echo '</tr>';
  }

  function limpiar($string, $trim = false)
  {
	$string = filter_var($string, FILTER_SANITIZE_STRING); 
	$string = trim($string);
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = str_replace(array('‘','’','“','”'), array("'","'",'"','"'), $string);
	if($trim)
	$string = substr($string, 0, $trim);
	
	return $string;
  }

  function ejecutar_script_mysql($filename){
	  global $success,$msg;
	  $templine = '';
	  
	  $lines = file($filename);
	  foreach ($lines as $line_num => $line) {
		  if (substr($line, 0, 2) != '--' && $line != '') {
			  $templine .= $line;
			  if (substr(trim($line), -1, 1) == ';') {
				  if (!mysql_query($templine)) {
					  $success = false;
					  $msg = "<div class=\"qerror\">'".mysql_errno()." ".mysql_error()."' durante la siguiente consulta:</div> 
					  <div class=\"query\">{$templine} </div>";
				  }
				  $templine = '';
			  }
		  }
	  }
  }
  
  function escribirArchivoConfig($host, $username, $password, $name)
  {
      global $success;
      
      $content = configuracionSegura($host, $username, $password, $name);
      
      $confile = '../config/config.inc.php';
      if (is_writable('../config/')) {
          $handle = fopen($confile, 'w');
          fwrite($handle, $content);
          fclose($handle);
          $success = true;
      } else {
          $success = false;
      }
  }

  function configuracionSegura($host, $username, $password, $name)
  {
          $content = "<?php \n" 
		  . "\n"
		  . "if (basename(\$_SERVER['SCRIPT_NAME']) == 'xml.php'){\n" 
		  . "	error_reporting(0);\n"
		  . "}\n"
		  . "\n"
		  . "# MSSQL 2000\n"
		  . "# define('CONFIG_DATABASE_PORT','1433');\n"
		  . "\n" 
		  . "# MySQL\n"
		  . "define('CONFIG_DATABASE_HOST','".$host."');\n"
		  . "define('CONFIG_DATABASE_PORT','3306');\n"
		  . "define('CONFIG_DATABASE_USER','".$username."');\n"
		  . "define('CONFIG_DATABASE_PASS','".$password."');\n"
		  . "define('CONFIG_DATABASE_NAME','" . $name . "');\n"
		  . "define('CONFIG_PATH_SQL','sql/');\n"
		  . "define('CONFIG_PATH_LIB','lib/');\n"
		  . "\n" 
		  . "# Cargando las librerías\n" 
		  . "# Base de datos\n" 
		  . "# MySQL\n" 
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'db.inc.php');\n"
		  . "\n" 
		  . "# Generador de clases automatico en base a la estructura de las tablas\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'class_builder.inc.php');\n"
		  . "\n"
		  . "# Lectura de archivos con sentencias SQL en el directorio /sql/\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'recordset.inc.php');\n"
		  . "\n"
		  . "# Carga de Parametros en el sistema\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'carga_parametros.inc.php');\n"
		  . "\n"
		  . "# Generador de XML con base a la informacion de un recordset\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'recordset_to_xml.inc.php');\n"
		  . "\n"
		  . "# Formularios\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'form.inc.php');\n"
		  . "\n"
		  . "# Formularios FLEX\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'form_flex.inc.php');\n"
		  . "\n"
		  . "# Listados\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'listado.inc.php');\n"
		  . "\n"
		  . "# Utilidades varias\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'util.inc.php');\n"
		  . "\n"
		  . "# Funciones para la generacion del form manager\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'form_tools.inc.php');\n"
		  . "\n"
		  . "# AJAX Framework\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'Sajax.php');\n"
		  . "\n"
		  . "# Envio de mensajes SMS\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'sms.inc.php');\n"
		  . "\n"
		  . "# Lectura de XML's\n"
		  . "#require_once(\$BASE_DIR.CONFIG_PATH_LIB.'xml.inc.php');\n"
		  . "\n"
		  . "# Envio de correos\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'class.phpmailer.inc.php');\n"
		  . "\n"
		  . "# Envio de correos por SMTP\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'class.smtp.inc.php');\n"
		  . "\n"
		  . "# Libreria para la carga de archivos o imagenes al server\n"
		  . "require_once(\$BASE_DIR.CONFIG_PATH_LIB.'class.fileupload.inc.php');\n"
		  . "\n"
		  . "# Generacion de PDF's\n"
		  . "# require_once(\$BASE_DIR.CONFIG_PATH_LIB.'fpdf.inc.php');\n"
		  . "\n"
		  . "# Sybase"
		  . "# require_once(CONFIG_PATH_LIB.'db_sybase.inc.php');\n"
		  . "\n"
		  . "# SQL Server 2000"
		  . "# require_once(CONFIG_PATH_LIB.'db_sqlserver.inc.php');\n"
		  . "\n"
		  . "?>";
		  return $content;
  }
  
  function cyber_Header()
  {
      echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
      echo '<html xmlns="http://www.w3.org/1999/xhtml">';
      echo '<head>';
      echo '<title>Cyberfuel - Instalador Web</title>';
      echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
      echo '<link rel="stylesheet" type="text/css" href="style.css" />';
      echo '</head>';
      echo '<body>';
      echo '<div class="logo"></div><div id="installation">';
  }

  function cyber_Footer()
  {
      global $err;
      
      echo '</div>';
      echo '<div id="copyright">Cyberfuel.com &copy; ' . date("Y");
      echo '</div>';
      echo '<script type="text/javascript">';
      
      if ($err) {
          $j = 0;
          foreach ($err as $key => $i) {
              if ($i > 0) {
                  $first = ($j > 0) ? $i : '';
                  echo "document.getElementById('err{$i}').style.display = 'block';\n";
                  echo "document.getElementById('t{$i}').style.background = '#FFF8E3';\n";
                  $j++;
              }
          }
          echo "document.getElementById('t{$err[0]}').focus();\n";
      }
      
      echo '</script>';
      echo '</body>';
      echo '</html>';
  }
?>