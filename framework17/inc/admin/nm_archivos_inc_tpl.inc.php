<?php

# Parámetros
# ==========

$tabla = 'archivos_inc_tpl';
$prefijo = "frm_";
$form_name = CONFIG_PATH_TPL_ADMIN.'nm_archivos_inc_tpl.tpl.php';
$proc_script_retorno = 'admin.php?action=archivos_inc_tpl';
# Variable para recibir parámetros externos
if ($_POST['button']){
    
	
	#ver_variable($_POST);

	$contenido_inc = utf8_decode(file_get_contents("inc/admin/sis_inc.dat")); 
	$contenido_tpl = utf8_decode(file_get_contents("inc/admin/sis_tpl.dat")); 
 
 
	$filename_inc = $_POST['frm_nombre_inc'] . ".inc.php";
	$filename_tpl = $_POST['frm_nombre_inc'] . ".tpl.php";
	
	if (!file_exists($filename_inc))
	{
			$fh = fopen("inc/public/".$filename_inc, "w");
			if($fh==false)
				die("unable to create file");
			fputs ($fh,$contenido_inc);
			fclose ($fh);
			
			$fh = fopen("tpl/public/".$filename_tpl, "w");
			if($fh==false)
				die("unable to create file");
			fputs ($fh,$contenido_tpl);
			fclose ($fh);			
	}
	

 	$_POST['frm_nombre_inc'] = $filename_inc; 
 	$_POST['frm_nombre_tpl'] = $filename_tpl;
	$_POST['frm_ultima_actualizacion'] = date('Y-m-d H:i:s');
 
}





form_manager($tabla, $prefijo = "frm_", $form_name, $proc_script_retorno,$validacion,$validacion_solo_insercion);


?>