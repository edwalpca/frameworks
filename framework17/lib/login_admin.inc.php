<?php
# Cargando configuración
require_once('config/config.inc.php');
require_once('lib/util.inc.php');
require_once('lib/db.inc.php');
# Activando la sessión
session_start();
# Parámetros para la plantilla de ingreso
$msj_login = '';
# Este archivo funciona como medio de validación para incluir en cualquier archivo
$_POST['verifica_admin'] = $_SESSION['Ncode'] = 1;

if (!isset($_COOKIE['id_administrador'])){
    if ($_SESSION['activa_admin'] != 1){
        if ((isset($_POST["frmauthsend"])) and ($_POST['frmauthsend'] == 1)){
            if ($_POST['verifica_admin'] == $_SESSION['Ncode']){
                # Verificando si el usuario transmitido existe registrado en la base de datos
                # Se limpian los datos con mysql_real_escape_string para hacer los datos mas seguros y evitar SQL inyection
                $sent = sprintf("SELECT id_administrador, login, clave, nombre, foto_perfil FROM `%s` WHERE `estado` = 'ACTIVO' AND `login` = '%s' AND `clave` = '%s' LIMIT 1",
                mysql_real_escape_string(CONFIG_LOGIN_TABLA),
                mysql_real_escape_string($_POST["usuario"]),
                mysql_real_escape_string($_POST["password"]));
                $cons = sql($sent);
                if (sql_num_rows($cons) == 1){
                    $reg = sql_fetch_array($cons);
                    # Creando las variables de session
                    $_SESSION["activa_admin"] = 1;
                    $_SESSION["usuario"] = $reg["login"];
                    $_SESSION["id_usuario"] = $reg["id_administrador"];
                    $_SESSION["permisos"] = $reg["permisos"];
                    $_SESSION["email"] = $reg["email"];
                    $_SESSION["foto_perfil"] = $reg["foto_perfil"];
                    $_SESSION["script_name"] = basename($_SERVER['SCRIPT_NAME'],'.php');
                    $update = "UPDATE administrador SET ultimo_acceso = NOW(), ip_address = '".gethostbyaddr($_SERVER['REMOTE_ADDR'])."'  WHERE id_administrador = '".$_SESSION["id_usuario"]."' LIMIT 1";
                    $cons = sql($update);	
                    if ($_POST['recordarme'] == 'si'){
                        setcookie('id_administrador',$reg['id_administrador']);
                    }
                }else{
                    $msj_login = "Usuario o contrase&ntilde;a incorrectos";
                    include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
                    exit;
                }# end if (sql_num_rows($cons)
            }else{
                $msj_login = "C&oacute;digo de verificaci&oacute;n no es correcto";
                include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
                exit;
            }# end if ($_POST['verifica_admin']
        }else if ((isset($_POST["frmauthsend"])) and ($_POST['frmauthsend'] == 2)){
            $sent = sprintf("SELECT id_administrador, login, clave, nombre FROM `%s` WHERE `estado` = 'ACTIVO' AND `email` = '%s' LIMIT 1",
            mysql_real_escape_string(CONFIG_LOGIN_TABLA),
            mysql_real_escape_string($_POST["email"]));
            $cons = sql($sent);
            if (sql_num_rows($cons) == 1){
                $reg = sql_fetch_array($cons);

                $html = 'Su usario es '.$reg['login'].' y su contrase&ntilde;a es: '.$reg['clave'];

                $mail = new phpmailer();
                $mail->Host = '';
                $mail->From = 'info@cyberfuel.com';
                $mail->Username = '';
                $mail->Password = '';		
                $mail->FromName = 'Informaci&oacute;n'; 
                $mail->IsHTML(true);
                $mail->ClearAddresses();
                $mail->Subject = 'Reenvio de contrase&ntilde;a';
                $mail->Sender = 'info@cyberfuel.com';
                $mail->ReplyTo = 'info@cyberfuel.com';
                $mail->WordWrap = 50;
                $mail->AddAddress($_POST["email"]);
                $mail->Body = $html;
                if ($mail->Send()){
                    $msj_login_correcto = "Correo enviado correctamente";
                    include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
                    exit; 
                }else{
                    $msj_login = "Se ha presentado un error al enviar el correo";
                    include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
                    exit; 
                }
            }else{
                $msj_login = "Email incorrecto";
                include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
                exit; 
            }
        }else{
            # Primer ingreso que hace el usuario al sitio web, debe autenticarse.
            include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
            exit;
        }# end if (isset($_POST["frmauthsend"]
    }
}else{
    if ($_SESSION['activa_admin'] != 1){
        $sent = sprintf("SELECT id_administrador, login, clave, nombre, foto_perfil FROM `%s` WHERE `estado` = 'ACTIVO' AND `id_administrador` = '%s' LIMIT 1",
        mysql_real_escape_string(CONFIG_LOGIN_TABLA),
        mysql_real_escape_string($_COOKIE['id_administrador']));
        $cons = sql($sent);
        if (sql_num_rows($cons) == 1){
            $reg = sql_fetch_array($cons);
            # Creando las variables de session
            $_SESSION["activa_admin"] = 1;
            $_SESSION["usuario"] = $reg["login"];
            $_SESSION["id_usuario"] = $reg["id_administrador"];
            $_SESSION["permisos"] = $reg["permisos"];
            $_SESSION["email"] = $reg["email"];
            $_SESSION["foto_perfil"] = $reg["foto_perfil"];
            $_SESSION["script_name"] = basename($_SERVER['SCRIPT_NAME'],'.php');
            $update = "UPDATE administrador SET ultimo_acceso = NOW(), ip_address = '".gethostbyaddr($_SERVER['REMOTE_ADDR'])."'  WHERE id_administrador = '".$_SESSION["id_usuario"]."' LIMIT 1";
            $cons = sql($update);
        }else{
            $msj_login = "Usuario o contrase&ntilde;a incorrectos";
            include(CONFIG_PATH_TPL_ADMIN.'login.tpl.php');
            exit;
        }# end if (sql_num_rows($cons)
    }
}
# Se continua con la carga normal de los archivos
?>