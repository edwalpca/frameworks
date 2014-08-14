<?php

##########################################################################################
# 
# OBJETIVO:
# =========
#
# Ser un repositorio de todos las sentencias SQL que se ejecutan en el programa,
# para así facilitar el mantenimiento y migración de los sistemas.
#
# Parametros:
# ===========
#
# - Primer parámetro: Identificador del SQL  (Nombre)
#
# - Segundo parámetro: Tipo de tarea:
#	   -2 : Ejecutar la sentencia SQL retornando verdadero o falso por la ejecución
#	   -1 : Ejecutar la sentencia SQL retornando la cantidad de registros afectados o falso en error
#		0 : Retornar resultados de ejecución SQL en un arreglo o falso si no hay datos
#		1 : Retornar la cantidad de registros obtenidos por el SQL
#		2 : Retorna la sentencia SQL generada en base a los parámetros transmitidos
#
# - Tercer parámetro: Evaluar expresion (True o False): Determina si se debe o no 
#	evaluar las expresiones dentro de la sentencia SQL
#
# - Siguientes parámetros: 
#		Son el resto de parámetros que darán forma a cada SQL
#
#########################################################################################



Function recordset(){
	
	// Carácteres especiales
	$dolar = '$';
	$comilla = "'";
	$comillas = '"';

	// Verificando que se haya proporcionada la cantidad correcta de parámetros
	$numargs = func_num_args();
	if ( $numargs < 3 ){
		echo mensaje("No se proporcionó la cantidad de argumentos necesarios para la función recordset","Error en funci&oacute;n recordset");
		exit;
	}
	
	
	// Cargando los parámetros
	$rs_nombre = func_get_arg(0);
	$tipo_retorno = func_get_arg(1);
	$evalua_expresion = func_get_arg(2);
	for ($c = 3; $c < $numargs; $c++){
		// $param[] = addslashes(func_get_arg($c));
		$param[] = func_get_arg($c);
	}
	
	if (!$sent = @file_get_contents(CONFIG_PATH_SQL.$rs_nombre)){
		mensaje("El archivo SQL $rs_nombre no ha sido localizado","Archivo no existe");
		exit;
	} 
	if ($evalua_expresion){
		eval("\$sent = \"$sent\";");
	}
	
	if ($tipo_retorno == 2){
		// Retorna la sentencia SQL generada en base a los parámetros
		return $sent;
	}

	
	if( !$cons = sql_query( $sent ) ) {
		if (CONFIG_MODO_DEPURACION){
			echo mensaje("Error en la sentencia SQL del recordset $rs_nombre :".sql_error(),"Error SQL");
			exit;
		}else{
			echo mensaje("Se ha presentado un error, favor vuelva a intentar.  Si el problema persiste favor comunicarse con el administrador del sistema ","Error");
			exit;
		}
	}
	
	
	switch ($tipo_retorno){

		case -2:
			// Retorna verdadero se la sentencia se ejecutó correctamente
			return true;
		break;

		case -1:
			// Retorna la cantidad de registros afectados por la sentencia SQL
			return sql_affected_rows($cons);
		break;

		case 0:

			// Retornando los registros obtenidos por medio de un arreglo
			$cant_registros = sql_num_rows($cons);
			if ( $cant_registros > 0 ) {
				while ( $reg = sql_fetch_array($cons) ){
					$retorna[] = $reg;
				}

				#ver_variable($retorna);// Array Original
				# -------------------------------------------------------------------				
				# Analiza la expresion del SQL, para verificar si tiene codigo PHP que intepretar.
				# -------------------------------------------------------------------								
				reset($retorna);
				while(list($aKey,$a_datos) = each($retorna)){
					while(list($abKey,$aValue) = each($a_datos)){
					 if (strtoupper(substr($aValue,0,4)) == "@PHP"){
					   $expr = substr($aValue,4,strlen($aValue));
					   eval("\$valor = $expr;");
					   $retorna[$aKey][$abKey] = $valor;				   
					 }
					}//while(list($abKey,$aValue) = each($a_datos)){
				}//while(list($aKey,$a_datos) = each($retorna)){
				# -------------------------------------------------------------------				
				# Fin.
				# -------------------------------------------------------------------	
				reset($retorna);
				#ver_variable($retorna);							
				return $retorna;

			}else{
				return;
			}
			
			
			

		break;

		case 1:
		
			// Retorna la cantidad de registros obtenidos por un SELECT
			return sql_num_rows($cons);
			
		break;
		
		default:
			mensaje('Opción proporcionada en el RecordSet no existe','Error en RecordSet');
			exit;
		break;
	}
	
	
	
} // Function Recordset


?>