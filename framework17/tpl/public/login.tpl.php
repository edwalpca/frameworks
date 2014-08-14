<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=CONFIG_TITULO_APLICACION?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<form method="post" name="frmlogin" action="<?=url_actual()?>">
<p>
  <input type="hidden" name="frmauthsend" value="1" />
</p>

<table width="400" style="border-collapse:collapse; border-style:solid;" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <th colspan="3" align="center" class="td1"><strong>Control de Ingreso - Público</strong></th>
  </tr>
  <tr>
    <th colspan="3" align="center">
		
		<div id="msj_login"><?=$msj_login?></div>	</th>
  </tr>
  <tr>
    <th colspan="3" align="center">&nbsp;</th>
  </tr>
  <tr>
    <td rowspan="5"><div align="center"></div></td>
    <td><strong>Usuario:</strong></td>
    <td><input value="<?=$_POST["usuario"]?>" name="usuario" type="text" id="usuario" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Contraseña:</strong></td>
    <td><input name="password" type="password" id="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td><strong>Código de verificación:</strong></td>
    <td>
    	<img src="admin.php?action=captcha" border="0" /><br />
    	<input name="verifica" type="text" id="verifica" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    <input type="submit" class="bt" value="Ingresar" src="images/bt_ingresar.gif" width="118" height="26"/>
    </td>
    </tr>
</table>
</form>
</body>
</html>
