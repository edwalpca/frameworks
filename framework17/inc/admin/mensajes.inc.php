<?php

if ((isset($_POST['accion'])) && ($_POST['accion'] == '1')){
    $actualiza = recordset('sql_update.sql',-2,true,' mensaje ',' estado = "'.$_POST['estado'].'" WHERE id_mensaje = '.$_POST['id']);
    echo $actualiza;
    exit();
}

if ((isset($_POST['accion'])) && ($_POST['accion'] == '2')){
    $mail = new phpmailer();
    $mail->Host = $host_email;
    $mail->SMTPDebug = 2;
    $mail->IsQmail(); 
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->From = $_POST['correo_original'];
    $mail->IsHTML(true);
    $mail->ClearAddresses();
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['message'];
    $mail->WordWrap = 50;
    $mail->AddAddress($_POST['recipient']);
    if ($mail->Send()){
        echo 1;
    }else{
        echo 0;
    }
    exit();
}

if ((isset($_POST['accion'])) && ($_POST['accion'] == '3')){
    $error = 1;
    foreach ($_POST['id_mensaje'] as $key => $id){
        $actualiza = recordset('sql_update.sql',-2,true,' mensaje ',' estado = "'.$_POST['estado'].'" WHERE id_mensaje = '.$id);
        if ($actualiza == 0){
            $error = 0;
        }
    }
    echo $error;
    exit();
}

if ((isset($_GET['lstorderby'])) && (isset($_GET['lstordertype']))){
    $order = " ORDER BY ". $_GET['lstorderby'] . " " .$_GET['lstordertype']; 
}else{
    $order = " ORDER BY id_form DESC";
}
if(isset($_GET['parametro'])){
    $where = " WHERE CONCAT_WS(' ',nombre,email,asunto) like '%".$_GET['parametro']."%'";
    $m_datos =  recordset("sql_select.sql",2,true,' * ',' mensaje '.$where.$order);
}else{	
    $m_datos =  recordset("sql_select.sql",2,true,' * ',' mensaje WHERE estado <> "borrado"'.$order);
}
$_pagi_sql = $m_datos;
$_pagi_cuantos = 10;
$cant = mysql_query($_pagi_sql);
$total = mysql_num_rows($cant);
include(CONFIG_PATH_LIB.'paginacion.inc.php');

$sin_leer = recordset('sql_select.sql',0,true,' count(*) as cantidad ',' mensaje WHERE estado = "no leido"');
$todos = recordset('sql_select.sql',0,true,' count(*) as cantidad ',' mensaje WHERE estado != "borrado"');
include(CONFIG_PATH_TPL_ADMIN.$_GET['action'].".tpl.php");
?>