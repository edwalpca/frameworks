<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
  <tr>
    <td width="50%"><img src="<?php echo CONFIG_PATH_IMAGES; ?>admin/frame_imgs_upd/top/top01.png" alt="" width="343" height="97" /><div id="version"><?php echo CONFIG_VERSION_APLICACION; ?></div></td>
    <td width="50%">
    
    <table width="546" border="0" cellspacing="0" cellpadding="0" align="right">
      <tr>
        <td width="39" rowspan="2"><img src="<?php echo CONFIG_PATH_IMAGES; ?>admin/frame_imgs_upd/top/top02.gif" alt="" width="39" height="97" /></td>
        <td width="507" valign="top"><img src="<?php echo CONFIG_PATH_IMAGES; ?>admin/frame_imgs_upd/top/top03.gif" alt="" width="507" height="77" /></td>
      </tr>
      <tr>
        <td class="td1a">
        
             <span><a href="http://<?php echo $_SERVER["SERVER_NAME"]; ?>/" target="_blank">Ir al Sitio Web</a></span>
             
             <span><a href="admin.php?action=nmusuario&op=2&id=<?php echo $_SESSION['id_usuario']; ?>">Cambiar Mi Clave</a></span>
             
             <span><a href="mailto:support@cyberfuel.com">Reportar Bug</a></span>
             
             <span><a href="admin.php?action=desconectar">Desconectar</a></span>
             
             <span></span>
        
        </td>
      </tr>
    </table>
    
    </td>
  </tr>
</table>

