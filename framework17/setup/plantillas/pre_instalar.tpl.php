<div class="inner-content"><b>Revisión Pre-Instalación</b> &nbsp;&raquo;&nbsp; Licencia &nbsp;&raquo;&nbsp; Configuración &nbsp;&raquo;&nbsp; Finalización</div>
<h2 id="install"><img src="img/pre-install.png" alt="" />Revisión Pre-Instalación</h2>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><h3>1. Configuración del Servidor</h3></td>
  </tr>
  <tr>
    <td class="item-desc">Si cualquiera de estos elementos aparece resaltado en rojo, debe tomar las medidas necesarias para corregirlo. En caso de no hacerlo, la instalación podría no funcionar correctamente.</td>
  </tr>
  <tr>
    <td><table width="100%" class="inner-content">
          <tr>
            <th width="35%" align="left"><b>Configuración de PHP</b></th>
            <th width="25%" align="left"><b>Configuración Actual</b></th>
            <th width="25%" align="left"><b>Configuración Requerida</b></th>
            <th width="15%" align="center"><b>Estado</b></th>
          </tr>
          <tr>
            <td>Versión de PHP:</td>
            <td><?php echo phpversion(); ?></td>
            <td>5.2+</td>
            <td align="center"><?php echo (phpversion() >= '5.0') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Register Globals:</td>
            <td><?php echo (ini_get('register_globals')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('register_globals')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Magic Quotes GPC:</td>
            <td><?php echo (ini_get('magic_quotes_gpc')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('magic_quotes_gpc')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>File Uploads:</td>
            <td><?php echo (ini_get('file_uploads')) ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo (ini_get('file_uploads')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>Session Auto Start:</td>
            <td><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></td>
            <td>Off</td>
            <td align="center"><?php echo (!ini_get('session_auto_start')) ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td><h3>2. Extensiones del Servidor</h3></td>
  </tr>
  <tr>
    <td class="item-desc">Las siguientes configuraciones de PHP se recomiendan con el fin de garantizar la plena compatibilidad con el Framework de Cyberfuel.</td>
  </tr>
  <tr>
    <td>            <table width="100%" class="inner-content">
          <tr>
            <th width="35%" align="left"><b>Extensión</b></th>
            <th width="25%" align="left"><b>Configuración Actual</b></th>
            <th width="25%" align="left"><b>Configuración Requerida</b></th>
            <th width="15%" align="center"><b>Estado</b></th>
          </tr>
          <tr>
            <td>MySQL:</td>
            <td><?php echo extension_loaded('mysql') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('mysql') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>GD:</td>
            <td><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('gd') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
          <tr>
            <td>ZIP:</td>
            <td><?php echo extension_loaded('zlib') ? 'On' : 'Off'; ?></td>
            <td>On</td>
            <td align="center"><?php echo extension_loaded('zlib') ? '<img src="img/yes.png" alt="Good" />' : '<img src="img/no.png" alt="Bad" />'; ?></td>
          </tr>
        </table></td>
  </tr>
  <tr>
    <td><h3>3. Permisos de Archivo &amp; Directorios</h3></td>
  </tr>
  <tr>
    <td class="item-desc">Con el fin de que el Framework funcione correctamente, éste debe ser capaz de acceder o escribir sobre ciertos archivos o directorios. En caso de aparecer "No escribible", será necesario cambiar los permisos necesarios para permitir la escritura.</td>
  </tr>
  <tr>
    <td>
        <table width="100%" class="inner-content">
        <?php
			obtenerEscrituraDir('config');
		?>
        <?php
			obtenerEscrituraDir('documents');
		?>
      </table>
    </td>
  </tr>
</table>
<div class="btn lgn">
  <button type="button" onclick="document.location.href='install.php';" name="check">Revisar de nuevo</button>
  &nbsp;&nbsp;
  <button type="button" onclick="document.location.href='install.php?paso=1';" name="next" tabindex="3" >Siguiente</button>
</div>