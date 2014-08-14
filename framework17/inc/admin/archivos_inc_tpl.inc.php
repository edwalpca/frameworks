<?
	if (isset($_POST['buscar_nombre'])){
		header("Location: admin.php?action=archivso_inc_tpl&nombre=" . $_POST['buscar_nombre']);
	}
	
	
	if ((isset($_GET['lstorderby'])) && (isset($_GET['lstordertype']))){
		$order = " ORDER BY ". $_GET['lstorderby'] . " " .$_GET['lstordertype']; 
	}	

	if(isset($_GET['nombre'])){
		$where = " WHERE CONCAT(path,' ',nombre) like '%".$_GET['nombre']."%'";
		$m_datos =  recordset("sql_inc_tpl.sql",2,true,$where,$order);

	}else{		
		
		  $m_datos =  recordset("sql_inc_tpl.sql",2,true,$where,$order);
	}	
	
	$_pagi_sql = $m_datos;
	$_pagi_cuantos = CONFIG_GUI_PAGINACION;
	$cant = mysql_query($_pagi_sql);
	$total = mysql_num_rows($cant);
	include(CONFIG_PATH_LIB.'paginacion.inc.php');
   include(CONFIG_PATH_TPL_ADMIN."archivos_inc_tpl.tpl.php")
?>