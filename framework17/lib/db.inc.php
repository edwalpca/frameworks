<?php

	// Conexión con la base de datos
	
	if(!@mysql_connect(CONFIG_DATABASE_HOST.':'.CONFIG_DATABASE_PORT,CONFIG_DATABASE_USER,CONFIG_DATABASE_PASS)){
		echo "No hay conexión con la base de datos: ".mysql_error();
		exit;
	}
	
	// Seleccionando la base de datos
	if(!@mysql_query('USE `'.CONFIG_DATABASE_NAME.'`')){
		echo "No se logró seleccionar la base de datos: ".mysql_error();
		exit;
	}
	
	
	function sql($sent){
	
		if ($cons = @mysql_query($sent)){
			return $cons;
		}else{
			echo "Error en sentencia SQL: ".mysql_error();
			exit;
		} // if
		
	} // function

	function sql_query($sent){
	
		if ($cons = @mysql_query($sent)){
			return $cons;
		}else{
			echo "Error en sentencia SQL: ".mysql_error();
			exit;
		} // if
		
	} // function
	
	
	function sql_info(){
		return mysql_info();
	}
	
	
	function sql_fetch_array($res,$tipo = MYSQL_ASSOC){
		return @mysql_fetch_array($res,$tipo);
	}
	
	
	function sql_insert_id(){
		return mysql_insert_id();
	}
	
	function sql_affected_rows(){
		return mysql_affected_rows();
	}
	
	function sql_num_rows($res){
		return mysql_num_rows($res);
	}
	
	
	function sql_num_fields($res){
		return @mysql_num_fields($res);
	}
	
	
	function sql_field_name($res1,$res2){
		return mysql_field_name($res1,$res2);
	}
	
	function sql_error(){
		return mysql_error();
	}
	
	
	function sql_describe_enum_field($tabla,$campo){
		$cons = sql_query("describe $tabla $campo");
		if(!$cons){
			echo "Error describiendo campo ENUM: ".mysql_error();
			exit;
		}
		if (sql_num_rows($cons) == 1) {
			$reg = sql_fetch_array($cons);
			$reg = $reg['Type'];
			$reg = str_replace('enum(','',$reg);
			$reg = str_replace(')','',$reg);
			$reg = str_replace("'","",$reg);
			$reg = split(',',$reg);
			$c = 1;
			foreach($reg as $dato){
				$ret[$c++] = $dato;
			}
			return $ret;
		}else{
			echo "Campo Enum no localizado";
			exit;
		}
	} // Function
	
	
	
?>