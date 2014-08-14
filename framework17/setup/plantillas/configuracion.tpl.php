<div class="inner-content"><a href="install.php">Revisión Pre-Instalación</a> &nbsp;&raquo;&nbsp; <a href="install.php?paso=1">Licencia</a> &nbsp;&raquo;&nbsp; <b>Configuración</b> &nbsp;&raquo;&nbsp; Finalización</div>
<h2 id="install"><img src="img/config.png" alt="" />Configuración General</h2>
<?php echo ($msg) ?  "<div class=\"error\">{$msg}</div>" : '';?>
<form action="install.php?paso=2" method="post">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3"><h3>1. Configuración base de datos MySQL:</h3></td>
    </tr>
    <tr>
      <td colspan="3" class="item-desc">Introduzca los datos necesarios para realizar la conexión con una base de datos MySQL.<br />Se recomienda instalar los datos de muestra (incluye la configuración inicial).</td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200">Host de MySQL:</td>
            <td><input type="text" name="dbhost" size="30" value="<?php echo isset($_POST['dbhost']) ? limpiar($_POST['dbhost']) : 'localhost'; ?>" id="t1" /></td>
            <td width="160"><div class="err" id="err1">Ingrese el Host de MySQL.</div></td>
          </tr>
          <tr>
            <td>Usuario de MySQL:</td>
            <td><input type="text" name="dbuser" size="30" value="<?php echo isset($_POST['dbuser']) ? limpiar($_POST['dbuser']) : ''; ?>" id="t2" /></td>
            <td width="160"><div class="err" id="err2">Ingrese el Usuario de MySQL.</div></td>
          </tr>
          <tr>
            <td>Contraseña de MySQL:</td>
            <td><input type="password" name="dbpwd" size="30" value="" /></td>
            <td width="160">&nbsp;</td>
          </tr>
          <tr>
            <td>Base de Datos de MySQL:</td>
            <td><input type="text" name="dbname" size="30" value="<?php echo isset($_POST['dbname']) ? limpiar($_POST['dbname']) : ''; ?>" id="t3"/></td>
            <td width="160"><div class="err" id="err3">Ingrese el nombre de la BBDD.</div></td>
          </tr>
          <tr>
            <td>Instalar datos de muestra:</td>
            <td><input type="checkbox" id="install_data" name="install_data" checked="checked" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="db_action" id="db_action" value="1" /></td>
    </tr>
    <tr>
      <td><h3>2. Configuración Común</h3></td>
    </tr>
    <tr>
      <td class="item-desc">Revise que la dirección URL del sitio web sea correcta. Complete los demás datos acerca de la identidad del sitio web.</td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200">URL:</td>
            <td><input type="text" name="site_url" value="http://<?php echo $_SERVER['SERVER_NAME'].$script_path;?>" size="30"/></td>
          </tr>
          <tr>
            <td>Nombre del Sitio:</td>
            <td><input type="text" name="site_name" value="Nombre de su sitio" size="30" onfocus="if(this.value == this.defaultValue) this.value = ''" /></td>
          </tr>
          <tr>
            <td>Nombre de la empresa:</td>
            <td><input type="text" name="company" value="Nombre de su empresa" size="30" onfocus="if(this.value == this.defaultValue) this.value = ''" /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><h3>3. Configuración del Administrador</h3></td>
    </tr>
    <tr>
      <td class="item-desc">Configure los datos de su cuenta de administrador. Esta información será utilizada para autenticarse en el panel de administración.</td>
    </tr>
    <tr>
      <td><table width="100%" class="inner-content">
          <tr>
            <td width="200">Usuario Administrador:</td>
            <td><input type="text" name="admin_username" value="<?php echo isset($_POST['admin_username']) ? limpiar($_POST['admin_username']) : 'admin'; ?>" size="30" id="t4" /></td>
            <td width="160"><div class="err" id="err4">Ingrese un nombre correcto.</div></td>
          </tr>
          <tr>
            <td>Contraseña Administrador:</td>
            <td><input type="password" name="admin_password" value="<?php echo isset($_POST['admin_password']) ? limpiar($_POST['admin_password']) : ''; ?>" size="30" id="t5" /></td>
            <td width="160"><div class="err" id="err5">Ingrese una contraseña.</div></td>
          </tr>
          <tr>
            <td>Contraseña Administrador [confirmar]:</td>
            <td><input type="password" name="admin_password2" value="" size="30" id="t6" /></td>
            <td width="160"><div class="err" id="err6">Las contraseñas no coinciden.</div></td>
          </tr>
        </table></td>
    </tr>
  </table>
  <div class="btn lgn">
    <button type="button" onclick="document.location.href='install.php?paso=1';" name="back">Volver</button>
    &nbsp;&nbsp;
    <button type="submit" name="next">Siguiente</button>
  </div>
</form>