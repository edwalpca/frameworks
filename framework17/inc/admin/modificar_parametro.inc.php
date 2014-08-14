<?php

if (!is_object($obj_parametros )){
  class_builder("parametros");
  $obj_parametros = new class_parametros();
}

$obj_parametros->set_id_parametros($_GET['id']);
if ($_POST['accept']){
	$obj_parametros->get_data();
	$obj_parametros->set_nombre($_POST["frm_nombre"]);
	$obj_parametros->set_valor($_POST["frm_valor"]);
	$obj_parametros->sql_update_data();
	header('Location: ?action=sistema');	
}
#$obj_parametros->view_class();
$obj_parametros->get_data();

$_POST["frm_nombre"]= $obj_parametros->get_nombre();
$_POST["frm_valor"] = $obj_parametros->get_valor();
include(CONFIG_PATH_TPL_ADMIN."modificar_parametro.tpl.php");
?>
