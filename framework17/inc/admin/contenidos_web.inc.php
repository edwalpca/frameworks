<?php
	# Cuando el usuario da Enter al formulario se postea el nombre del campo a buscar.
	if (isset($_POST['buscar_nombre'])){
		header("Location: admin.php?action=contenidos_web&nombre=" . $_POST['buscar_nombre']);
	}
	
	if ((isset($_GET['lstorderby'])) && (isset($_GET['lstordertype']))){
		$order = " ORDER BY ". $_GET['lstorderby'] . " " .$_GET['lstordertype']; 
	}
	
	if(isset($_GET['nombre'])){
		$where = " WHERE nombre_seccion_espanol LIKE '%".$_GET['nombre']."%'";
		$m_empresas =  recordset("sql_listar_contenidos_web.sql",2,true,$where,$order);
	}else{		
		$m_empresas =  recordset("sql_listar_contenidos_web.sql",2,true,$where,$order);

	}	
	
	$_pagi_sql = $m_empresas;
	$_pagi_cuantos = CONFIG_GUI_PAGINACION;
	$cant = mysql_query($_pagi_sql);
	$total = mysql_num_rows($cant);
	include(CONFIG_PATH_LIB.'paginacion.inc.php');
	include(CONFIG_PATH_TPL_ADMIN.$_GET['action'].'.tpl.php');
?>