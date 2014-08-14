<?php


function form_manager_flex($tabla, $prefijo = "frm_"){


//ver_variable($_POST);

$activar_reenvio = true;


	/*
	Función form_manager:
	======= =============
	
	Esta función permite la administración de un formulario de una manera más sencilla
	Simplemente se debe de crear los formularios sin definir las etiquetas form en un
	archivo aparte.
	
	
		# Inicia validación de los valores ingresados en el formulario
		if ($_POST["frm_detalle"] == ""){
			$a_errores[] = "Debe completar la descripción del semestre";
			$b_error = true;
		}
	
			Estados GET["op"] = $op
			======= ===
			
				1 = Insert
				2 = Update
				3 = Delete                                                   */
	
	
	
	
	###############################
	#    P A R A M E T R O S      #
	###############################
	
	
	# Nombre del archivo en ejecución
	$file_name = basename($_SERVER['SCRIPT_NAME'],".php");
	
	# Inicialización de variables
	$b_error = false;
	$GLOBALS['b_finaliza'] = false;
	$form_modifica = false;
	
	
	
	
	
	
	###############################
	#    E L I M I N A C I O N    #
	#   D E   R E G I S T R O S   #
	###############################
	
	
	if ($_GET['op'] == 3 ){
		if( !recordset("elimina_registro.sql",-1,true,$tabla,"id_".$tabla,$_GET["id"]) == 1 ){
			//mensaje('No se logró eliminar el registro '.$_GET["id"]." de la tabla $tabla","Error");
			//$GLOBALS['b_finaliza'] = true;
		}else{
			//mensaje("El registro ".$_GET["id"]." fue eliminado exitosamente","Registro eliminado");
			// $GLOBALS['b_finaliza'] = true;
		}
		$GLOBALS['b_finaliza']= true;
		if ($activar_reenvio){
			/*echo "\n<script>
			window.location = '$proc_script_retorno';
			</script>\n";*/
		}
	}
	
	
	
	
	
	
	########################################
	#  BUSQUEDA DEL REGISTRO A MODIFICAR   #
	########################################
	
	# Localizando registro en caso que se una modificación y 
	# cargando la variable global POST con los datos
	
	if ( isset($_GET['id']) and $_GET["op"] == 2 and !isset($_POST['op']) and !$GLOBALS['b_finaliza'] ){
	
		if ( !carga_post($tabla, $_GET["id"], $prefijo) ){
			mensaje("No se ha localizado el registro seleccionado en la tabla ".$tabla,"Registro no existe");
			$GLOBALS['b_finaliza'] = true;
		}
		
	} // if ( isset($_GET['id']) and $_GET["op"] == 2 and !$GLOBALS['b_finaliza'] ){
	
	
	
	#############################################
	#   IDENTIFICACION DEL  TIPO DE FORMULARIO  #
	#############################################
	
	// Identificando si el formulario es para modificación
	if ($_GET["op"] == 2 or $_POST["op"] == 2){
		$form_modifica = true;
	}
	
	
	// Validando y actualizando\almacenando formulario
	if( isset($_POST["op"]) and !$GLOBALS['b_finaliza']){
	
		#############################################
		#  VALIDACIONES DE INSERCIÓN Y MODIFICACION #
		#############################################
		
		#eval($validacion);
	
	
	
		// Validación exclusiva para inserción de datos
		if (!$form_modifica){
	
	
	
			################################
			#  VALIDACIONES DE INSERCIONES #
			################################
			
			#eval($validacion_solo_insercion);
			
			
	
		} # if (!$form_modifica){
	
	
	
	
	
	
	
	
	
	
		
			#######################################
			#            E R R O R E S            #
			#######################################
		
		# Mostrando errores de ingreso en caso que los hubiera
		if ($b_error){
	
			# Preparando string de salida de mensaje de error
			$s_titulo = "Datos requeridos";
			$s_mensaje = "Por favor verifique los siguientes detalles:<br>";
			foreach ($a_errores as $s_valor){
				$s_mensaje .= "&nbsp; - ".$s_valor."<br>";
			}
			mensaje($s_mensaje,$s_titulo);
	
		}else{
			
		
	
	

			######################################################
			#    A L M A C E N A M I E N T O   D E   D A T O S   #
			######################################################
		
			# Almacenando los datos en la base de datos
			if ($form_modifica){
	
	
				# ACTUALIZANDO: los datos en la base de datos
				# ============ 
				
				if (form_actualiza($tabla,$_POST["id"],$prefijo)){
					$mensaje_resultado_script = "Los datos han sido actualizados";
				}else{
					mensaje("No se lograron actualizar los datos: ".sql_error(),"Error");
				}// if (form_actualiza($prefijo,$tabla)){
	
				// Retornando al archivo especificado
				$GLOBALS['b_finaliza']= true;
				
				
				
				if ($activar_reenvio){
					/*echo "\n<script>
					window.location = '$proc_script_retorno';
					</script>\n";*/
				}
				

	
			}else{
			
	
				# INSERTANDO los datos en la base de datos
				# ==========
				if (form_almacena($prefijo,$tabla)){
					$mensaje_resultado_script = "Los datos han sido almacenados";
				}else{
					mensaje("No se lograron almacenar los datos: ".sql_error(),"Error");
				} // if (form_almacena($prefijo,$tabla)){
	
				$GLOBALS['b_finaliza']= true;
				
				
				if ($activar_reenvio){
					/*echo "\n<script>
					window.location = '$proc_script_retorno';
					</script>\n";*/
				}

	
				
			} //  if ($form_modifica){
	
		}
		
	
	
	
	}else{ // if(isset($_POST["frm_form_id"]))
	
	
	
		#############################################
		#    I D E N T I F I C A D O R    D E L     #
		#            F O R M U L A R I O            #
		#############################################
	
		# Generando el id de formulario
		$_POST["frm_id_form"] = id_form();
	
	
		
	}
	
	
	
	#############################################
	#  I N T E R F A Z   G R A F I C A   D E L  #
	#              U S U A R I O                #
	#############################################
	
	// Presentando la GUI del usuario
	if(!$GLOBALS['b_finaliza']){
		echo "<form name='frm_{$tabla}' method='post' action='".url_actual()."' enctype='multipart/form-data'>\n";
		echo "<input type=hidden name=frm_id_form value='".$_POST[frm_id_form]."'>\n";
		if ($form_modifica){
			//echo "<input type=hidden name='".$prefijo."id_".$tabla."' value='".$_POST[$prefijo."id_".$tabla]."'>\n";
			echo "<input type=hidden name='id' value='".$_GET["id"]."'>\n";
			echo "<input type=hidden name='op' value='2'>\n";
		}else{
			echo "<input type='hidden' name='op' value='1'/>\n";
		}
		
		# Insertando el formulario personalizado del usuario
		#include($form_name);
		
		echo "</form>\n";
	
	}

} // function


?>