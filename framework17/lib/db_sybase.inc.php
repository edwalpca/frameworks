<?php
// En este archivo se almacenan todas las funciones necesarias para realizar la mani-
// lación y extracción de los datos con el fin de hacer más fácil la migración de una
// base de datos a otra


function sql_connect($host,$port,$user,$pass){
	$dbLink = sybase_connect($host,$user,$pass);
	define("DB_LINK",$dbLink);
	return $dbLink;
}


function sql_info(){
	#return mysql_info();
}



function sql_query($sent,$dbLink){
	 return sybase_query($sent,$dbLink);
}



function sql_fetch_array($res){
	return sybase_fetch_array ($res);
}


function sql_insert_id(){
	#return mysql_insert_id();
}

function sql_affected_rows(){
	return sybase_affected_rows ();
}

function sql_num_rows($res){
	return sybase_num_rows ($res);
}


function sql_num_fields($res){
	return sybase_num_fields($res);
}


function sql_field_name($res1,$res2){
	return sybase_field_seek ($res1,$res2);
}

function sql_error(){
	#return mysql_error();
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