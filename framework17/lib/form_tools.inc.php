<?php
function form_select($nombre,$tabla,$campo_id,$campo_valor,$filtro,$predeterminado,$ninguno = false){
    # Genera un control select en base a los parámetros proporcionados
    $r_cons = recordset("extrae_id_detalle.sql",0,true,$campo_id,$campo_valor,$tabla,$filtro);
    $retorna = "<select name='$nombre' class=formulario_select>\n";
    if ($ninguno){
        $retorna .= "\t<option value=''>Ninguno</option>\n";
    }
    if ($r_cons){
        //while ($result = mysql_fetch_array($r_cons)){
	foreach( $r_cons as $result ){
            if ($result["id"] == $predeterminado){
                $seleccionado = ' selected';
            }else{
                $seleccionado = '';
            }
            $retorna .= "\t<option value='".$result["id"]."' $seleccionado>";
            $retorna .= $result["valor"];
            $retorna .= "</option>\n";
        }
    }
    $retorna .= "</select>\n";
    return $retorna;
}
    
function id_form(){
    # Genera un número único aleatorio para evitar la duplicación de datos al ingresar
    # datos desde un formulario
    return date("YmdHis").rand(100,999);
}

function form_almacena($prefijo,$tabla){
    # Almacena el contenido del formulario en base al prefijo proporcionado
    # 1. Extrayendo los campos a almacenar por el prefijo en un nuevo arreglo
    foreach($_POST as $s_variable => $s_valor){
        if (substr($s_variable,0,strlen($prefijo) ) == $prefijo){
            $s_variable = substr($s_variable,strlen($prefijo));
            # Serializando los valores en caso que la variable a almacenar sea array()
            if (is_array($s_valor)){
                $s_valor = serialize($s_valor);
            }
            $a_datos[$s_variable] = $s_valor;
	}
    }
    # 2. Generando sentencia SQL de almacenamiento
    $s_sql = "INSERT INTO $tabla set ";
    $b_coma = false;
    foreach ($a_datos as $s_variable => $s_valor){
        if ($b_coma){
            $s_sql .= ", ";
        }else{
            $b_coma = true;
        }
        $s_sql .= $s_variable." = '".$s_valor."'";
    }
		
    $s_sql;
    if (!sql_query($s_sql)){
        return false;
    }else{
        $v_id_insercion = sql_insert_id();
	if (count($_FILES) > 0){
            ############# CARGA CLASE Y LIBRERIA PARA EL RESIZE ###############
            include('SimpleImage.inc.php');
            $image = new SimpleImage();
            
            foreach($_FILES as $v_nombre => $a_datos){
                if ($a_datos["error"] == 0){
                    ############# OBTIENE LA EXTENCION DEL ARCHIVO ###############
                    $extension = array_pop(explode('.', $a_datos['name']));
                    $extension = strtolower($extension);
                    ############# OBTIENE LA EXTENCION DE IMAGENES ###############
                    $extensiones_imagenes = explode(',',CONFIG_ARRAY_IMAGES_TYPE);
                    
                    $path = CONFIG_PATH_DOCUMENTS;
                    $tmp_name = $a_datos["tmp_name"];
                    ############# CREA EL ARCHIVO UNICO APARTIR DEL MD5 ###############
                    $name_md5 = md5_file($a_datos["tmp_name"]);
                    $name = $name_md5.'.'.$extension;
                    if (move_uploaded_file($tmp_name, $path.$name)){        
                        if (in_array($extension, $extensiones_imagenes)){
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_SMALL,CONFIG_IMAGE_HEIGHT_SMALL);
                            $image->save($path.$name_md5.'_small.'.$extension);
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_MEDIUM,CONFIG_IMAGE_HEIGHT_MEDIUM);
                            $image->save($path.$name_md5.'_medium.'.$extension);
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_LARGE,CONFIG_IMAGE_HEIGHT_LARGE);
                            $image->save($path.$name_md5.'_large.'.$extension);
                        }
                    }
                    $s_variable = substr($v_nombre,strlen($prefijo));
                    $sent_sql = "UPDATE $tabla SET $s_variable = '".$path.$name_md5.$extension."' where id_$tabla = $v_id_insercion";
                    if (!$result = sql_query($sent_sql)){
                        mensaje("Error en la sentencia de almacenamiento de imagen", "Error SQL");
                        exit;
                    };
                } // if error == 0
            } // foreach
        }// if count($_FILES)
        return true;
    }
}	

function form_actualiza($tabla,$id,$prefijo){
    # Actualiza un registro en la base de datos, de acuerdo a los campos $_POST definidos
    # en el formulario
    $llave = "id_".$tabla;
	 
    # 1. Extrayendo los campos a almacenar por el prefijo en un nuevo arreglo
    foreach($_POST as $s_variable => $s_valor){
        if (substr($s_variable,0,strlen($prefijo) ) == $prefijo){
            $s_variable = substr($s_variable,strlen($prefijo));
            # Serializando los valores en caso que la variable a almacenar sea array()
            if (is_array($s_valor)){
                $s_valor = serialize($s_valor);
            }
            $a_datos[$s_variable] = $s_valor;
        }
    }
	
    # 2. Generando sentencia SQL de almacenamiento
    $s_sql = "UPDATE $tabla set ";
    $b_coma = false;
    foreach ($a_datos as $s_variable => $s_valor){
        if ($b_coma){
            $s_sql .= ", ";
        }else{
            $b_coma = true;
        }
        $s_sql .= $s_variable." = '".$s_valor."'";
    }
    $s_sql .= " where $llave = '".$id."' limit 1";

    # 3. Ejecutando la sentencia SQL
    if (!sql_query($s_sql)){
        return false;
    }else{
        $v_id_insercion = $id;
        if (count($_FILES) > 0){
            ############# CARGA CLASE Y LIBRERIA PARA EL RESIZE ###############
            include('SimpleImage.inc.php');
            $image = new SimpleImage();
            
            foreach($_FILES as $v_nombre => $a_datos){
                if ($a_datos["error"] == 0){
                    ############# OBTIENE LA EXTENCION DEL ARCHIVO ###############
                    $extension = array_pop(explode('.', $a_datos['name']));
                    ############# OBTIENE LA EXTENCION DE IMAGENES ###############
                    $extensiones_imagenes = explode(',',CONFIG_ARRAY_IMAGES_TYPE);
                    
                    $path = CONFIG_PATH_DOCUMENTS;
                    $tmp_name = $a_datos["tmp_name"];
                    ############# CREA EL ARCHIVO UNICO APARTIR DEL MD5 ###############
                    $name_md5 = md5_file($a_datos["tmp_name"]);
                    $name = $name_md5.'.'.$extension;
                    if (move_uploaded_file($tmp_name, $path.$name)){        
                        if (in_array($extension, $extensiones_imagenes)){
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_SMALL,CONFIG_IMAGE_HEIGHT_SMALL);
                            $image->save($path.$name_md5.'.'.$extension.'_small');
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_MEDIUM,CONFIG_IMAGE_HEIGHT_MEDIUM);
                            $image->save($path.$name_md5.'.'.$extension.'_medium');
                            ############# SE REALIAZA EL RESIZE A LA IMAGEN Y SE GUARDA ###############
                            $image->load($path.$name);
                            $image->resize(CONFIG_IMAGE_WIDTH_LARGE,CONFIG_IMAGE_HEIGHT_LARGE);
                            $image->save($path.$name_md5.'.'.$extension.'_large');
                        }
                    }
                    $s_variable = substr($v_nombre,strlen($prefijo));
                    $_SESSION["foto_perfil"] = $path.$name_md5.'.'.$extension;
                    $sent_sql = "UPDATE $tabla SET $s_variable = '".$path.$name_md5.'.'.$extension."' where id_$tabla = $v_id_insercion";
                    if (!$result = sql_query($sent_sql)){
                        mensaje("Error en la sentencia de almacenamiento de imagen", "Error SQL");
                        exit;
                    };
                } // if error == 0
            } // foreach
        }// if count($_FILES)
        #exit();
        return true;
    }
}	

function carga_post($tabla,$id,$prefijo = 'frm_'){
    $llave = "id_".$tabla;
    if (recordset( "busca_registro.sql", 1, true, $tabla, $llave, $id ) == 1){
        # Extrayendo el valor de las variables del formulario
        $a_reg = recordset( "busca_registro.sql", 0, true, $tabla, $llave, $id );
        $reg = $a_reg[0];
        foreach( $reg as $variable => $valor ){
            // Verificando si el valor almacenado es serializado
            $tmp = unserialize($valor);
            if ($tmp){
                $valor = $tmp;
            }
            $_POST[$prefijo.$variable] = $valor;
        }
	return true;
    }else{
        return false;
    }
}
?>