<?php

# Parametros
# ==========

$tabla = 'administrador';
$prefijo = "frm_";
$form_name = CONFIG_PATH_TPL_ADMIN.'nmusuario.tpl.php';
if ((!isset($_GET['id'])) and (!isset($_GET['op']))){
    $proc_script_retorno = 'admin.php?action=usuarios';
}else{
    $proc_script_retorno = 'admin.php?action=nmusuario&op=2&id='.$_GET['id'];
}
# Variable para recibir parámetros externos


# Validaciones
# ============

$validacion = '
	# Inicia validación de los valores ingresados en el formulario
	if ( !isset($_POST["frm_nombre"]) ){
		$a_errores[] = "Debe completar el campo nombre";
		$b_error = true;
	}
	if ( !isset($_POST["frm_email"]) OR !ismail($_POST["frm_email"]) ){
		$a_errores[] = "Debe indicar una dirección de correo válida";
		$b_error = true;
	}
	if ( !isset($_POST["frm_login"]) ){
		$a_errores[] = "Debe proporcionar el identificador de usuario";
		$b_error = true;
	}
	if ( !isset($_POST["frm_clave"]) ){
		$a_errores[] = "Debe indicar una contraseña de acceso";
		$b_error = true;
	}
';

$validacion_solo_insercion = '
	if (recordset("busca_registro.sql",1,true,$tabla,"login",$_POST["frm_login"]) > 0){
		$a_errores[] = "El identificador de usuario ya fue utilizado, intente con otro.";
		$b_error = true;
	}
';

form_manager($tabla, $prefijo = "frm_", $form_name, $proc_script_retorno,$validacion,$validacion_solo_insercion);

?>