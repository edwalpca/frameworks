<?php

function class_builder($nombre, $visualizar = false){
// Esta función crea una clase a partir del nombre de una tabla que se especifique, 
// la misma debe existir en la base de datos seleccionada, y además de los métodos 
// estándar de la clase, creará las funciones personalizadas definidas en el directorio
// SQL.


		// Cargando los parámetros para la generación de la clase
		$dolar = '$';
		$llave_primaria = '';
		
		// Ejecutando la consulta de extracción de los datos
		if (!$cons = sql_query("SHOW COLUMNS FROM `$nombre`")){
			mensaje("No se logró extraer los campos de la tabla $nombre",'Error SQL');
			exit;
		}
		
		// Verificando la cantidad de registros obtenidos de acuerdo a la cantidad de campos de la tabla
		if (sql_num_rows($cons) == 0 ){
			mensaje("La tabla $nombre no tiene campos definidos",'Error en la definición de la tabla '.$nombre);
			exit;
		}
		
		// Extrayendo los campos de la tabla en un arreglo
		while ($reg = sql_fetch_array($cons)){
			$a_campos[] = $reg["Field"];
			$a_campos_type[] = $reg["Type"];			
		
			// Tomando la llave primaria de la tabla
			if ($reg["Key"] == "PRI"){
				$llave_primaria = $reg["Field"];
			}
		}
		
		if ($llave_primaria == ''){
			mensaje ("La tabla $nombre no tiene definida la llave primaria",'Llave primaria no ha sido definida');
			exit;
		}
		
		$str = "
Class class_{$nombre}{
		
";
		$vis = "
Class class_{$nombre}{
		
";
		
		//Miembros de la Clase
		$vis .= "\n\n// Miembros de la clase\n";
		$str .= "\n\n// Miembros de la clase\n";
		for ($c = 0; $c < count($a_campos); $c++){
			$vis .= "\tvar  {$dolar}".$a_campos[$c].";\n";
			$str .= "\tvar  {$dolar}".$a_campos[$c].";\n";
		}
		

		// Métodos Get de la clase
		$str .= "\n\n// Métodos Get de la clase\n";
		$vis .= "\n\n// Métodos Get de la clase\n";
		for ($c = 0; $c < count($a_campos); $c++){
			$vis .= "\tfunction get_".$a_campos[$c]."()\n";
			$str .= "\tfunction get_".$a_campos[$c]."(){ return {$dolar}this->".$a_campos[$c].";}\n";
		}

		// Métodos Set de la Clase
		$str .= "\n\n// Métodos Set de la clase\n";
		$vis .= "\n\n// Métodos Set de la clase\n";
		for ($c = 0; $c < count($a_campos); $c++){
			$vis .= "\tfunction set_".$a_campos[$c]."({$dolar}var)\n";
			$str .= "\tfunction set_".$a_campos[$c]."({$dolar}var){ {$dolar}this->".$a_campos[$c]." = trim({$dolar}var);}\n";
		}
		
		// Función que realiza un Insert en la tabla
		
		$vis .= "
// Función que realiza un Insert en la tabla
	function sql_ins()\n"; 
		$str .= "
// Función que realiza un Insert en la tabla
	function sql_ins(){ 
		{$dolar}sqlstr = \"INSERT INTO $nombre set \n";
		$primero = true;
		for ($c = 0; $c < count($a_campos); $c++){
			if ($primero){ 
				$primero = false; 
			}else{
				$str .= ",\n";
			}
		
			$str .= "\t\t".$a_campos[$c]." = '\".{$dolar}this->".$a_campos[$c].".\"'"; 
		} // for
		
		$str .= "\"; 
		
		   if(!sql_query({$dolar}sqlstr)){
				mensaje('En la clase table_{$nombre}:'.sql_error(),'Error SQL');
				exit;
		   }
		   if (sql_affected_rows() == 0){
				return false;
			}else{
				return true;
			} 
		} // end function SqlIns
		
		
		";
		// Fin de la función Insert
		
		
		
		// Función que realiza un get de la tabla
		$vis .= "
// Función que realiza un get de la tabla
	function get_data()\n";
		$str .= "
		
// Función que realiza un get de la tabla
	function get_data(){ 
		{$dolar}sqlstr = \"SELECT * FROM `$nombre` where (`$llave_primaria` = '\".{$dolar}this->".$llave_primaria.".\"' ) \";
		if (!{$dolar}cons = sql_query( {$dolar}sqlstr ) ){
			mensaje('Función get_data de la clase table_{$nombre}'.sql_error(),'Error SQL');
			exit;
		}
		if (sql_num_rows({$dolar}cons) == 0){
			return false;
		}else{
			while({$dolar}reg = sql_fetch_array({$dolar}cons)){
	";
				for ($c = 0; $c < count($a_campos); $c++){
					$str .= "\t\t{$dolar}this->".$a_campos[$c]." = {$dolar}reg['".$a_campos[$c]."']; \n";
				}
		$str .= "
					} // while
				} // if
			} // end function get_data
		
		
		
		
		
		";
		// Fin de la función Get
		
		
		// Función que realiza un update
		
		$vis .= "
// Función que realiza un update
	function sql_update_data()\n";
		$str .= "
// Función que realiza un update
	function sql_update_data(){ 
				{$dolar}sqlstr = \"UPDATE $nombre set \n";
		$primero = true;
		for ($c = 0; $c < count($a_campos); $c++){
			if ($primero){ 
				$primero = false; 
			}else{
				if ($a_campos_type[$c] != "longblob"){				
				$str .= ",\n";
				}
			}
		
			
			// Para que no actualice campos en la base de dato de tipo objecto ya 
			// que estos se manejan de forma diferente.
			if ($a_campos_type[$c] != "longblob"){
			  $str .= "\t\t\t`".$a_campos[$c]."` = '\".{$dolar}this->".$a_campos[$c].".\"'"; 
			}
			
			
		} // for
		
		$str .= "\n\t\t\t WHERE `$llave_primaria` = '\".{$dolar}this->$llave_primaria.\"'\"; 
				if(!sql_query({$dolar}sqlstr)){
					mensaje('En la clase table_{$nombre}:'.sql_error(),'Error SQL');
					exit;
				}
			   if (sql_affected_rows() == 0){
					return false;
			   }else{
					return sql_affected_rows();
			   } 
			} // end function SqlIns
		
		
		
		";
		// Fin de la función sql_update_data
		
		
		$vis .=		"
	function sql_get_list_data()\n";
		$str .=
		"
	function sql_get_list_data(){
				{$dolar}sqlstr = \"SELECT * FROM `$nombre`\";
				{$dolar}rsql= sql_query({$dolar}sqlstr);
				if  (sql_num_rows({$dolar}rsql) == 0){
					return false;
				}else{
					while ({$dolar}rs = sql_fetch_array({$dolar}rsql)){
						{$dolar}matriz[{$dolar}rs['$llave_primaria']] = {$dolar}rs;
					}// end while
					return {$dolar}matriz;
				}//end del if
			}// end Function SqlGetListData
		
		
		
		";
		
		$vis .=	" 
	function sql_list_data_pag({$dolar}brec = 0,{$dolar}erec = 5000)\n";
		$str .=	" 
	function sql_list_data_pag({$dolar}brec = 0,{$dolar}erec = 5000){
				{$dolar}sqlstr = \"SELECT * FROM `$nombre` LIMIT {$dolar}brec,{$dolar}erec\";
				if  (sql_num_rows({$dolar}rsql) == 0){
					return false;
				}else{
					while ({$dolar}rs = sql_fetch_array({$dolar}rsql)){
						{$dolar}matriz[{$dolar}rs['$llave_primaria']] = {$dolar}rs;
					}// end while
					return {$dolar}matriz;
				}//end del if
			}// end Function sql_list_data_pag
		
		
		";
		
		$vis .= "
	function sql_delete()\n";
		$str .= "
	function sql_delete(){
				{$dolar}sqlstr = \"DELETE FROM `$nombre` WHERE (`$nombre`.`$llave_primaria` = '\".{$dolar}this->$llave_primaria.\"')\";
				{$dolar}query = sql_query({$dolar}sqlstr);
				if (sql_affected_rows({$dolar}query) == 0){
					return false;
				}else{
					return sql_affected_rows({$dolar}query);
				} 
			}// end Function sql_delete
		
		
		
		";
		
		$vis .= "
//Function para paginar los datos
	function sql_paginar()\n";
		$str .= "
//Function para paginar los datos
	function sql_paginar(){
				{$dolar}sqlstr = \"SELECT * FROM `$nombre`\";
				{$dolar}rsql= sql_query({$dolar}sqlstr);
				{$dolar}nrs = sql_num_rows({$dolar}rsql);
				return {$dolar}nrs;
			} // end function SqltoPaginar
		
		";
		
		$vis .= "
// Funcion Indica el Proximo Indice a Ingresar. << NEXT AUTOINCREMENT >>
	function get_next({$dolar}dbName)\n";
		$str .= "
// Funcion Indica el Proximo Indice a Ingresar. << NEXT AUTOINCREMENT >>
	function get_next({$dolar}dbName){
				{$dolar}sqlstr = \"SHOW TABLE STATUS FROM {$dolar}dbName LIKE '$nombre'\";
				{$dolar}rsql= sql_query({$dolar}sqlstr);
				{$dolar}nrs = sql_num_rows({$dolar}rsql);
				if  ({$dolar}nrs > 0 ){
					while ({$dolar}rs = sql_fetch_array({$dolar}rsql)){
						return {$dolar}rs['Auto_increment'];
					}
				}
			}	// end GetNext
		
		
		
		";
		
		$vis .= "
//Describe la Columna de Tipo SET  
	function sql_describe_column({$dolar}FIELD)\n";
		$str .= "
//Describe la Columna de Tipo SET  
	function sql_describe_column({$dolar}FIELD){
				{$dolar}sqlstr = \"DESCRIBE `$nombre` {$dolar}FIELD \";
				{$dolar}rsql= sql_query({$dolar}sqlstr);
				{$dolar}nrs = sql_num_rows({$dolar}rsql);
				if  ({$dolar}nrs > 0 ){
					while ({$dolar}rs = sql_fetch_array({$dolar}rsql)){
						{$dolar}Field = {$dolar}rs[Field];
						{$dolar}Type = {$dolar}rs[Type];
					}// end while
					{$dolar}Type = str_replace('(','',{$dolar}Type);
					{$dolar}Type = str_replace('set','',{$dolar}Type);
					{$dolar}Type = str_replace(')','',{$dolar}Type);
					{$dolar}Type = str_replace(\"'\",'',{$dolar}Type);
					{$dolar}arr  = split(',',{$dolar}Type);
					return {$dolar}arr;
				}//end del if
			}// end Function SqlDescColum
		
		
		";
		
		// Cargando métodos personalizados
		# Escaneando el directorio de sql's
		if (!$a_directorio = scandir(CONFIG_PATH_SQL)){
			mensaje('Error listando el directorio de los SQL (scandir)','Checkear versión PHP');
			exit;
		}

		// Inicializando variables para la creación de los nuevos métodos
		$personalizadas = false;
		$a_custom = array();
		$cont_datos = 0;
		
		// Recorriendo el arreglo con los archivos del directorio SQL
		for ($c = 0; $c < count($a_directorio); $c++){
			//echo $a_directorio[$c];
			$dat = array();
			list($ident,$tabla,$metodo,$tipo_sentencia,$valida_expresion,$arroba,$parametros,$extension,$extension2) = explode('\.',$a_directorio[$c]);

			# Verificando si el nombre de archivo inicia con la palabra class y si tiene el verificador @
			if (($ident == 'class') and ($tabla == $nombre) and ($arroba == '@') and ($extension == "sql") and ($extension2 != "LCK") )  {
				$a_datos = array();
				$personalizadas = true;
				
				# Datos del nuevo método de la clase
				$a_datos["nombre_archivo"] = $a_directorio[$c];
				$a_datos["tabla"] = $tabla;
				$a_datos["metodo"] = $metodo;
				$a_datos["tipo_sentencia"] = $tipo_sentencia;
				$a_datos["valida_expresion"] = $valida_expresion;
				if ($parametros != "sql"){
					$a_datos["parametros"] = explode('-',$parametros);
				}
				$a_custom[] = $a_datos;
			}
			
		} // for
		
		# En este sector del string se reemplazará con métodos para la visualización de sus partes
		$str .= "\n\n/* 123456789 */\n\n";
		
		# Si hay personalizadas se adjunta método a la función
		if ($personalizadas){
			$str .= "\n\n\t\t/*======================= CUSTOMIZE FUNCTIONS ===========================*/\n\n"; 
			$vis .= "\n\n\t\t/*======================= CUSTOMIZE FUNCTIONS ===========================*/\n\n"; 
			for ( $c = 0; $c < count($a_custom); $c++){
				$str .= "\tfunction ".$a_custom[$c]['metodo']." (";
				$vis .= "\tfunction ".$a_custom[$c]['metodo']." (";
				$coma = false;	
				
				# Imprimiendo variables de parámetro
				for ($i = 0; $i < count($a_custom[$c]["parametros"]); $i++){
					if (!$coma) {
						$coma = true;
					}else{
						$str .= ", ";
						$vis .= ", ";
					}
					$str .= "$dolar".$a_custom[$c]["parametros"][$i];
					$vis .= "$dolar".$a_custom[$c]["parametros"][$i];
				}
				$str .= "){\n\n";
				$vis .= ");\n\n";
				$str .= "\t\t\t// Ejecutando la sentencia\n";
				$str .= "\t\t\t{$dolar}a_informacion = recordset('".
					$a_custom[$c]["nombre_archivo"]."',".
					$a_custom[$c]["tipo_sentencia"].",".
					$a_custom[$c]["valida_expresion"];

				if (count($a_custom[$c]["parametros"]) > 0){
					$str .= ",\n\t\t\t\t#Parametros para el Recordset";
					// Poniendo los parámetros para la función recordset
					$coma = false;
					for ($i = 0; $i < count($a_custom[$c]["parametros"]); $i++){
						if (!$coma) {
							$coma = true;
						}else{
							$str .= ", ";
						}
						$str .= "\n\t\t\t\t$dolar".$a_custom[$c]["parametros"][$i];
					}
				}
				$str .= ");\n\n";
				$str .= "\t\t\t// Retornando el valor\n";
				$str .= "\t\t\treturn {$dolar}a_informacion;\n\n";
				
				$str .= "\t\t} // Fin function ".$a_custom[$c][metodo]."\n\n\n";

			} // for ( $c = 0; $c < count($a_custom); $c++)

		} // if ($personalizadas)
		
		
		$vis .= "\n\n} // Cierre de la clase table_{$nombre}";
		$str .= "} // Cierre de la clase table_{$nombre}";
		
		str_replace('"','\"',$str);
		$mas = "\tfunction view_class(){\n\n";
		$mas .= "\t\t\t{$dolar}all_code_class = '".$vis."\n\t\t\t ';\n";
		$mas .= "\t\t\thighlight_string(\"<?php \".{$dolar}all_code_class.\"\n?>\");\n\n";
		$mas .= "\t\t}";
		$str = str_replace("/* 123456789 */",$mas,$str);
		
		if ($visualizar){
			highlight_string("<?php\n".$str."\n?>");
		}
		eval($str);

} // Function Class Builder				 


?>