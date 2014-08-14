<?php

# Parámetros
# ==========

$tabla = 'secciones_web';
$prefijo = "frm_";
$form_name = CONFIG_PATH_TPL_ADMIN.'n_contenido_web.tpl.php';
$proc_script_retorno = 'admin.php?action=contenidos_web';
# Variable para recibir parámetros externos

# Validaciones
# ============

$validacion = '
    $b_error = false;
';


$validacion_solo_insercion = '
    $b_error = false;
';


#include(CONFIG_PATH_PKG."ckeditor/ckeditor.php");
#require_once (CONFIG_PATH_JS . "ckeditor/ckeditor.php");
#require_once (CONFIG_PATH_JS . 'ckfinder/ckfinder.php'); 

form_manager($tabla, $prefijo = "frm_", $form_name, $proc_script_retorno,$validacion,$validacion_solo_insercion);
?>