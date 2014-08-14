<?php
  define("_PHP_VALIDO", true);
  require_once("funciones.php");
  
  session_start();
  
  $msg = '';
  
  error_reporting(E_ALL);
  define("DS", DIRECTORY_SEPARATOR);
  define("BASE", dirname(__FILE__));
  define("DROPBASE", str_replace('setup', '', BASE));
  
  $script_path = str_replace('/setup', '', dirname($_SERVER['SCRIPT_NAME']));
  
  $_SERVER['REQUEST_TIME'] = time();
  
  $paso = !isset($_GET['paso']) ? 0 : (int)$_GET['paso'];
  
  if (isset($_GET['config'])) {
	  if (isset($_GET['h']) && isset($_GET['u']) && isset($_GET['p']) && isset($_GET['n'])) {
		  header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=config.inc.php");
	     echo configuracionSegura($_GET['h'], $_GET['u'], $_GET['p'], $_GET['n']);
	  }
	  else{
	  	  return 'Error al obtener la información del archivo.';
	  }
  }
  
  if (isset($_POST['db_action'])) {
      $err = false;
      
      if (!$_POST['dbhost'])
          $err[] = 1;
      
      if (!$_POST['dbuser'])
          $err[] = 2;
      
      if (!$_POST['dbname'])
          $err[] = 3;
      
      if (!$_POST['admin_username'])
          $err[] = 4;
      
      if (!$_POST['admin_password'])
          $err[] = 5;
      
      if ($_POST['admin_password'] != $_POST['admin_password2'])
          $err[] = 6;

      if (!$err) {
			
          $link = mysql_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd']);
          
          $error = false;

          if (!$link) {
              $error = true;
              $msg = 'No se pudo conectar al servidor MySQL: ' . mysql_error() . '<br />';
          }
          
          if (!mysql_select_db($_POST['dbname'], $link)) {
              $error = true;
              $msg .= 'No se pudo seleccionar la base de datos ' . limpiar($_POST['dbname']) . ': ' . mysql_error();
          }

          /** Escribiendo a la base de datos **/
          if (!$error) {
              mysql_query("CREATE DATABASE `" . $_POST['dbname'] . "`;");
              mysql_select_db($_POST['dbname']);
              
              $success = true;
              ejecutar_script_mysql("sql/estructura.sql");
              
              if ($success)
                  escribirArchivoConfig($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']);

              if ($script_path == "/")
                  $script_path = "";
             
          }
        
          if (!$error && isset($_POST['install_data'])) {
              $success = true;
              ejecutar_script_mysql("sql/datos_muestra.sql");
              if (!$success) {
                  $msg = "Error al agregar datos de muestra<br />
						<em>La instalación podrá continuar, pero el sitio estará vacio, sin ninguna información inicial.</em>";
              }
          }
       
          $user = (isset($_POST['admin_username'])) ? $_POST['admin_username'] : "";
          $pass = (isset($_POST['admin_password'])) ? limpiar($_POST['admin_password']) : "";
          $url = (isset($_POST['site_url'])) ? $_POST['site_url'] : "";
          $sitename = (isset($_POST['site_name'])) ? $_POST['site_name'] : "";
		    $company = (isset($_POST['company'])) ? $_POST['company'] : "";
         
          mysql_query("INSERT INTO `administrador` (`id_administrador`,`id_form`,`login`,`clave`,`nombre`,`email`,`tipo_usuario`,`estado`,`ultimo_acceso`,`ip_address`)
            VALUES (NULL,NOW(),'" . limpiar($user) . "','" . limpiar($pass) . "','Administrador','@','1','ACTIVO','','')");
          
          mysql_close($link);
         
          if (!$error) {
				 cyber_Header();
				 include("plantillas/finalizacion.tpl.php");
				 cyber_Footer();
				 exit;
          }
      }
  }
?>
<?php cyber_Header(); ?>
<?php
  if (!$paso){
    clearstatcache(); // Se borra informacion en cache sobre archivos
	 include("plantillas/pre_instalar.tpl.php");
	 }
  else if ($paso == '1'){
    include("plantillas/licencia.tpl.php");}
  else if ($paso == '2'){
    include("plantillas/configuracion.tpl.php");}
  else{
	 echo 'Paso incorrecto. Por favor siga las instrucciones de instalación.';}
?>
<?php cyber_Footer(); ?>