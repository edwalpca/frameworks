<div class="inner-content">Revisión Pre-Instalación &raquo; Licencia &raquo; Configuración &raquo; <b>Finalización</b></div>
<h2 id="install"><img src="img/finish.png" alt="" />Instalacón Completa</h2>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td><h3>Resumen de instalación:</h3></td>
  </tr>
  <tr>
    <td class="item-desc">Se han completado la instalación y puede empezar a usar el Framework.<br />De forma opcional, una copia del archivo de configuración se puede descargar haciendo clic en el botón "Descargar config.inc.php". Usted debe subir ese archivo dentro del directorio <strong>config</strong> del Framework.<br />Una vez hecho eso se podrá iniciar sesión con las credenciales de administrador que usted proporcionó en el formulario anterior.
  </tr>
  <tr>
    <td><table width="100%" class="inner-content">
        <tr>
          <td width="150" class="elem">Instalación de la base de datos:</td>
          <td align="left"><?php if ($msg):?>
            <?php echo '<span class="no">Error durante la ejecución de las consultas en MySQL:</span><br />'; ?> <?php echo $msg; ?>
            <?php else : ?>
            <?php echo '<span class="yes">OK</span>'; ?>
            <?php endif; ?></td>
        </tr>
        <tr>
          <td class="elem">Archivo de Configuración</td>
          <td align="left"><span class="yes">Disponible para descargar</span><br />
            En caso que ocurriera algún problema al crear el archivo de configuración, usted debe guardar el archivo <em>config.inc.php</em> de forma local en su PC y luego subirlo al directorio <strong>config</strong>. Haga <a href="javascript:void(0);" onclick="if (document.getElementById('file_content').style.display=='block') { document.getElementById('file_content').style.display='none';} else {document.getElementById('file_content').style.display='block'}">clic aquí</a> para ver los contenidos del archivo config.inc.php.<br />
            <div style="margin: 10px 0; text-align: center;">
              <input type="button" onclick="document.location.href='install.php?config=true&h=<?php echo $_POST['dbhost'].'&u='.$_POST['dbuser'].'&p='.$_POST['dbpwd'].'&n='.$_POST['dbname'];?>';" value="Descargar config.inc.php" />
            </div></td>
        </tr>
        <tr>
          <td colspan="2"><div style="display:none;border: 1px solid #777; width: 650px; height: 400px; background-color: #ededed; padding:10px;overflow:auto;" id="file_content">
              <?php if (is_callable("highlight_string")):?>
              <?php highlight_string(configuracionSegura($_POST['dbhost'] , $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']));?>
              <?php endif;?>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="remove_install">Ahora DEBE remover por completo el directorio 'setup' del servidor.</div>
            <br />
          <div class="remove_install">Por razones de seguridad ejecute chmod con 0755 sobre el directorio /config/</div></td>
        </tr>
      </table></td>
  </tr>
</table>
<div class="btn lgn">
  <button type="button" onclick="history.go(-1);" name="check">Volver</button>
  &nbsp;&nbsp;
  <button type="button" onclick="document.location.href='../admin.php';" name="next" tabindex="3">Login Admin</button>
</div>