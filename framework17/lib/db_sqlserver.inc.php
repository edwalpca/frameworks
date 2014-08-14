<?php


	// Conexión con la base de datos
	if(!@mssql_connect(CONFIG_DATABASE_HOST.','.CONFIG_DATABASE_PORT,CONFIG_DATABASE_USER,CONFIG_DATABASE_PASS)){
		echo $tag_error_inicio."No hay conexión con la base de datos: ".mssql_error().$tag_error_final;
		exit;
	}
	
	// Seleccionando la base de datos
	if(!@mssql_select_db(CONFIG_DATABASE_NAME)){
		echo $tag_error_inicio."No se logró seleccionar la base de datos: ".sql_error().$tag_error_final;
		exit;
	}
	
	function sql($sent){
	
		if ($cons = @mssql_query($sent)){
			return $cons;
		}else{
			echo $tag_error_inicio."Error en sentencia SQL: ".mssql_error().$tag_error_final;
			exit;
		} // if
		
	} // function

	function sql_query($sent){
	
		if ($cons = @mssql_query($sent)){
			return $cons;
		}else{
			echo $tag_error_inicio."Error en sentencia SQL: ".sql_error().$tag_error_final;
			exit;
		} // if
		
	} // function
	
	
	function sql_info(){
		return mssql_info();
	}
	
	
	function sql_fetch_array($res,$tipo = 'mssql_ASSOC'){
		return @mssql_fetch_assoc($res);
	}
	
	
	function sql_insert_id(){
		return mssql_insert_id();
	}
	
	function sql_affected_rows(){
		return mssql_rows_affected();
	}
	
	function sql_num_rows($res){
		return mssql_num_rows($res);
	}
	
	
	function sql_num_fields($res){
		return @mssql_num_fields($res);
	}
	
	
	function sql_field_name($res1,$res2){
		return mssql_field_name($res1,$res2);
	}
	
	function sql_error(){
		return mssql_get_last_message();
	}
	
	
	function sql_describe_enum_field($tabla,$campo){
		$cons = sql_query("describe $tabla $campo");
		if(!$cons){
			echo "Error describiendo campo ENUM: ".mssql_error();
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