<?php

function dmm_listado($param = array()){

/*
	Para facilitar la configuración del listado:

	$param = array();
	$param['registros_por_pagina'] = 10;
	$param["campos"] = '*';
	$param['tabla'] = 'usuario';
	$param['condicion'] = 'estado = 1';
	$param['ordenar_por_predeterminado'] = 'id_usuario';
	$param['tipo_orden_predeterminado'] = 'ASC';
	$param['plantilla'] = 'tpl/usuarios_lst.tpl.php';
	
*/

	#Parámetros del listado
	$registros_por_pagina = $param['registros_por_pagina'];
	$campos = $param["campos"];
	$tabla = $param['tabla'];
	$condicion = $param['condicion'];
	$ordenar_por_predeterminado = $param['ordenar_por_predeterminado'];
	$tipo_orden_predeterminado = $param['tipo_orden_predeterminado'];
	$plantilla = $param['plantilla'];
	$argumentos = $param['argumento_get'];	


	# Parámetros recibidos Vía GET
	$pagina_seleccionada = (isset($_GET['lstpag'])?$_GET['lstpag']:'1');
	$ordenar_por = (isset($_GET['lstorderby'])?$_GET['lstorderby']:$ordenar_por_predeterminado);
	$tipo_orden = (isset($_GET['lstordertype'])?$_GET['lstordertype']:$tipo_orden_predeterminado);


	# Parámetros obtenidos en base a la sentencia del listado
	$sent = "select count(*) as cantidad from $tabla".($condicion != ""?" WHERE $condicion":"");
	$cons = sql($sent);
	$cantidad_total_registros = sql_fetch_array($cons); 
	$cantidad_total_registros = $cantidad_total_registros['cantidad'];
	$cantidad_total_paginas = ceil($cantidad_total_registros / $registros_por_pagina);


	#############################################
	# Cadena para mostrar el control de paginas #
	if ($cantidad_total_registros > 0){
		//$query_string = $_SERVER['QUERY_STRING']; 
		$str_paginacion = "Pág: <select style=\"font-size:9px;\" name=\"page_selector\" onchange=\"window.location = '".$_SERVER['SCRIPT_NAME']."?action=".$_GET['action']."&lstpag='+ this[this.selectedIndex].value+'&$argumentos';\">";
		$primero = true;
		for ($c = 1; $c <= $cantidad_total_paginas; $c++){
			
			//if ($primero){	$primero = false;	}else{	$str_paginacion .= " | ";	}
			
			//if ($c != $pagina_seleccionada){
				
				//$query_str = var_get($query_string,'lstpag',$c);
				$str_paginacion .= "<option value=\"$c\" ".($_GET['lstpag']==$c?'selected':'').">".$c."</option>";
			//}else{
				//$str_paginacion .= $c;
			//} // if 
			
		}// for
		$str_paginacion .= '</select>';
	}else{
		$str_paginacion .= 'No hay información que mostrar';
	}
	# Fin de la cadena para el control de la paginación #
	#####################################################
	




	# Validando el número de pagina seleccionado
	if( $pagina_seleccionada < 0){
		$pagina_seleccionada = 1;
	}else{
		if ($pagina_seleccionada > $cantidad_total_paginas){
			$pagina_seleccionada = $cantidad_total_paginas;
		}
	}
	
	# Ejecutando la sentencia principal
	$sent = "select $campos from $tabla ".
			($condicion != ""?" WHERE $condicion":"").
			' ORDER BY `'.$ordenar_por.'` '.$tipo_orden.
			' LIMIT '.(($pagina_seleccionada-1)*$registros_por_pagina).','.$registros_por_pagina;
	if ($cantidad_total_registros > 0){
		$consulta_listado = sql($sent);
	}
	
	include($plantilla);

} // function


function listado_encabezado($etiqueta,$campo){

	$query_string = $_SERVER['QUERY_STRING']; 
	$query_string = var_get($query_string,'lstorderby',$campo);
	$query_string = var_get($query_string,'lstordertype',(isset($_GET['lstordertype'])?  ($_GET['lstordertype']=='ASC'?'DESC':'ASC') : 'ASC' ));
	$str = '<a class="listado_encabezado" href="'.$_SERVER['SCRIPT_NAME'].'?'.$query_string.'">'.htmlentities($etiqueta, ENT_COMPAT | ENT_XHTML, "UTF-8").'</a>';
	return $str;
	
}// function



?>