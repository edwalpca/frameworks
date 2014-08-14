<?php
function existe($dato,$arr,$en = 1 /* 1 = Valor, 0 = Llave*/ ){
    if (!is_array($arr)){
        return false;
    }
    foreach($arr as $llave=>$valor){
        if ($en == 1){
            if ($valor == $dato){
                return true;
            }
        }else{
            if ($llave == $dato){
                return true;
            } // if			
        } // if
    } // foreach
    // Valor no encontrado
    return false;
}

function var_get($str,$nomvar,$value){
    # Esta función descompone la sentencia GET para agregar las variables especificadas
    # en caso que la variable ya exista, será reemplazada con el nuevo valor asignado
    // Desarmando la sentencia GET proporcionada
    $varval = explode('&',$str);
    foreach( $varval as $datos ){
        list($variable,$valor) = explode('=',$datos);
        $arr[$variable] = $valor;
    }
		
    // Registrando el valor de la variable
    $arr[$nomvar] = $value;
    // Regenerando la sentencia
    $primero = true;
    $retorna = "";
    foreach ($arr as $variable => $valor){
        if ($primero){
            $primero = false;
        }else{
            $retorna .= "&";
        }
        $retorna .= $variable."=".$valor;
    }
    return $retorna;
} // var_get

function url_actual(){
    return $_SERVER['SCRIPT_NAME'].(count($_GET)>0?'?'.$_SERVER['QUERY_STRING']:'');
}

function mensaje($msj,$tit){?>
    <style>
            #tblmensaje {
                    border: solid black 1px;
                    background-color:#CCCCCC;
            }
            #tblmensaje th {
                    background-color:#336699;
                    color:white;
                    font-family:Verdana, Arial, Helvetica, sans-serif;
                    font-size:16px;
            }
            #tblmensaje td {
                    font-family:Verdana, Arial, Helvetica, sans-serif;
            }
    </style>
    <table id="tblmensaje" width="350" cellpadding="5" cellspacing="5" align="center" border="0">
        <tr>
            <th><?=$tit?></th>
        </tr>
        <tr>
            <td><?=$msj?></td>
        </tr>
    </table>
<?php
} // function mensaje

function ver_variable($varia){
    if (CONFIG_MODO_DEPURACION){
        echo "<pre>";
        print_r($varia);
        echo "</pre>";
    }
}

function ismail($e){
    $patron = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (preg_match($patron, $e)){
        return TRUE;
    }
    /* if(eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@[a-z0-9]+(-[a-z0-9]+)*(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $e)){
        return TRUE;
    }*/
    return FALSE;
}

function link_encoder($str){
    # Codifica los parametros que se utilizarán en una sentencia GET
    $t_rand = chr(rand(97,122)).rand(10,99).chr(rand(97,122)).rand(100,999).chr(rand(97,122)).rand(1000,9999).
              chr(rand(97,122)).rand(10000,99999).chr(rand(97,122)).rand(1000,9999).chr(rand(97,122)).
              rand(100,999).chr(rand(97,122)).rand(10,99).chr(rand(97,122)).rand(1,9);
	
    # Parámetros propios de cada link
    $str .= "&sidchk=".session_id();
    $str .= "&nmrchk=".$t_rand;
    $data = split("&",$str);
    $strfinal = "";
    foreach($data as $item){
        list($var,$val) = split("=",$item);
        $strfinal .= $var.$val;
    }
    // echo "xoxdis: ".$strfinal;
    return $str."&lnkchk=".(abs(crc32($strfinal))+CONFIG_LINK_ENCODER_ID);
}

function link_verify(){
    # Esta función verifica que los parámetros enviados via get no hayan sido variados
    if (count($_GET)>0){	
        $strfinal = "";
        foreach($_GET as $var => $val){
            if ($var != "lnkchk"){
                $strfinal .= $var.$val;
            } // if
        } // foreach
	if ( ((abs(crc32($strfinal)) + CONFIG_LINK_ENCODER_ID ) == $_GET["lnkchk"]) and ($_GET["sidchk"] == session_id()) ){
            return true;
        }else{
            /*echo $strfinal;
            ver_variable($_GET); 
            echo "(".abs(crc32($strfinal))." == ".$_GET["lnkchk"]." ) and (".$_GET["sidchk"]." == ".session_id().")";
            exit;*/
            return false;
        }
    }else{
        return true;	
    } // if count
} // end function

// Quote variable to make safe
function quote_smart($value){
    // Stripslashes
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Quote if not a number or a numeric string
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}

function formato_fecha($fecha,$sep = "/"){
    return substr($fecha,6,2).$sep.substr($fecha,4,2).$sep.substr($fecha,0,4);
}

function formato_fecha_guiones($fecha,$sep = "/"){
    return substr($fecha,8,2).$sep.substr($fecha,5,2).$sep.substr($fecha,0,4);
}

function formato_fecha_bd($fecha,$sep = "-"){
    return substr($fecha,0,4).$sep.substr($fecha,4,2).$sep.substr($fecha,6,2);
}
	
/* Funcion que Trunca una Cadena */
function truncartoSQL($cadena,$size){
    $tamanno = strlen($cadena);
    if ($tamanno > $size){
        $cadena_nueva = substr($cadena,0,$size);
        $cadena_nueva = $cadena_nueva;
        return $cadena_nueva;
    }else{
        return $cadena;
    } 
}	

if (!function_exists('scandir')){
    function scandir($path){
        // Example: $opendir = "/home/httpd/vhosts/cyberfuel.com/subdomains/desarrollos/httpdocs/selcyber/";
        $opendir = $path; 
        if ($dir = opendir($opendir)) { // Abre el directorio.
            $i = 0; // Inicializo i.
            while (($file = readdir($dir)) !== false) { // Leo cada Directorio, dentro del Directorio Colones.
                if (($file <> ".") && ($file <> "..")) {
                    $files[] = $file;
                }
            }//  while (($file = readdir($dir)) !== false).
            return $files;
            closedir($dir);// cierro directorio de Grafica de Colones.
        }else{
            return false;
        }
    }		
} // if !function_exists()
	
/**
* Si la directiva de PHP 'magic_quotes_gpc' esta activada, entonces por default ya se ejecuta addslashes() en todos los datos GET, POST y COOKIE.
* Pero si NO esta activada esa directiva, entonces realizamos de forma recursiva una limpieza en todos los datos de entrada.
*/
if (!ini_get('magic_quotes_gpc')) {
    function limpiar($data){
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[limpiar($key)] = limpiar($value);
            }
        }else{
            $data = addslashes($data);
        }
	return $data;
    }
    $_GET = limpiar($_GET);
    $_POST = limpiar($_POST);
    $_COOKIE = limpiar($_COOKIE);
}
        
function controles_form_manager($prefijo='',$tabla = ''){
    echo "<input type='hidden' name='".$prefijo."id_".$tabla."' value='".$_POST[$prefijo."id_".$tabla]."'>\n";
    echo "<input type='hidden' name='id' value='".$_GET["id"]."'>\n";
    echo "<input type='hidden' name='op' value='".$_GET["op"]."'>\n";
}        
?>