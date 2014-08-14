<?php
	# PHP compresión es un excelente método de conservación de ancho de banda y reduciendo los tiempos de descarga del cliente
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
	
   # Se busca el archivo 'config.inc.php' y en caso de NO encontrarse, entonces se ejecuta el Instalador.
	$mainPath = str_replace("index.php", "", realpath(__FILE__));
   $configFile = $mainPath . "config/config.inc.php";
   if (!file_exists($configFile)) {
      header("Location: setup/");
   }
  
	include('inc/public/action.inc.php');
	
?>