<?php
echo $_GET['params'];
echo "<HR>";
$_GET['params'] =  base64_decode($_GET['params']);
echo "<HR>";
$arreglo = split("&",$_GET['params']);

$_GET = $arreglo;
echo "<HR>";

ver_variable($_GET );
echo $_GET['idc'];

?>