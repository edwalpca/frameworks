<?php
if (isset($_POST['buscar_nombre'])){
    header("Location: admin.php?action=sistema&nombre=" . $_POST['buscar_nombre']);
}
if ((isset($_GET['lstorderby'])) && (isset($_GET['lstordertype']))){
    $order = " ORDER BY ". $_GET['lstorderby'] . " " .$_GET['lstordertype']; 
}
if(isset($_GET['nombre'])){
    $where = " WHERE nombre like '%".$_GET['nombre']."%' AND tipo = 'usuario'";
    $m_datos =  recordset("sql_lista_parametros.sql",2,true,$where,$order);
}else{		
    $where = " WHERE tipo = 'usuario'";
    $m_datos =  recordset("sql_lista_parametros.sql",2,true,$where,$order);
}
$_pagi_sql = $m_datos;
$_pagi_cuantos = CONFIG_GUI_PAGINACION;
$cant = mysql_query($_pagi_sql);
$total = mysql_num_rows($cant);
include(CONFIG_PATH_LIB.'paginacion.inc.php');
include(CONFIG_PATH_TPL_ADMIN."sistema.tpl.php");
?>