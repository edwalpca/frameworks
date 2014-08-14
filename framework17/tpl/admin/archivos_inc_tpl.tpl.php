<script>
$(document).ready(function(){				
	$("a.paginacion").click(function(){
		//alert('Me dieron click');			
		var this_url = $(this).attr("href");
		this_url = this_url + "&flw=y";
		 $.post(this_url,{}, function(data){
		$("div#tablas_paginacion").html(data);
		});
		return false;				
	});
});
</script>
	
<form action="" name="frm_sistema" method="post" enctype="multipart/form-data">
  <h2>Mantenimiento del Archivos INC &amp; TPL</h2>
  <p class="p_guia_opciones"><a href="admin.php?action=archivos_inc_tpl" class="guia_opciones">Mostar Todos</a></p>
  <p class="p_guia_opciones">Valores en el sistema:<?php echo $total; ?> registros</p>
  <div style="width:1000px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabla_listados">
    <tr>
      <td colspan="4">
        <div class="left"><a href="admin.php?action=nm_archivos_inc_tpl" >[+] Nuevo Registro</a></div>
        <div class="right">Buscar Archivos:
           <input type="text" name="buscar_nombre" />
           <input type="button" value="Buscar" onclick="location.href='admin.php?action=archivos_inc_tpl&nombre='+document.frm_sistema.buscar_nombre.value" />
        </div>
      </td>
    </tr>
    <tr>
      <th scope="col"><?=listado_encabezado('Archivo INC','nombre_inc')?></th>
      <th scope="col"><?=listado_encabezado('Archivo TPL','nombre_tpl')?></th>
      <th scope="col"><?=listado_encabezado('Fecha Creación','ultima_actualizacion')?></th>
      <th scope="col"><a href="#">Opciones</a></th>
    </tr>
    <?php
      if ($total > 0){
        while ($a_usr = mysql_fetch_array($_pagi_result)){
		  ?>
          <tr>
            <td><?=$a_usr["nombre_inc"];?></td>
            <td><?=$a_usr["nombre_tpl"];?></td>
            <td><?=$a_usr["ultima_actualizacion"];?></td>
            <td>
              <a class="listado_opciones" href="<?=$_SERVER['SCRIPT_NAME'].'?action=nm_archivos_inc_tpl&op=2&id='.$a_usr['id_archivos_inc_tpl'];?>">Editar</a>
            </td>
          </tr>
          <?php
        } // end while

      } //end if ($total > 0){
    ?>
    <tr>
      <td colspan="4" style="text-align:center;"><?=$_pagi_navegacion?>&nbsp;</td>
    </tr>
  </table>
  </div>
</form>

