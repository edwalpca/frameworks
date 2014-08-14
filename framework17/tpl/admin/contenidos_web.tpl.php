<script>
$(document).ready(function(){				
    $("a.paginacion").click(function(){
        var this_url = $(this).attr("href");
        this_url = this_url + "&flw=y";
        $.post(this_url,{}, function(data){
            $("#frm_empresa").html(data);
        });
        return false;				
    });
});
</script>
<div class="row">
    <div class="col-xs-4">
        <button class="btn btn-primary" id="btn_agregar" onclick="location.href='admin.php?action=n_contenido_web'">[+] Nueva Secci&oacute;n</button>
        <button class="btn btn-primary" id="btn_mostrar" onclick="location.href='admin.php?action=contenidos_web'">Mostar Todos</button>          
    </div>
    <div class="col-xs-8">
        <span>&nbsp;</span>
    </div>
</div> 
<form name="frm_empresa" id="frm_empresa" method="get" action="" enctype="multipart/form-data" >
    <div class="row">
        <div class="space-6"></div>    
        <div class="col-xs-9">
            <span>Secciones registrados  en el sistema: <strong><?php echo $total; ?></strong> registros</span>
        </div>
        <div class="col-xs-3">
            <div class="input-group">
                <input type="text" placeholder="Escriba aquí..." class="form-control search-query" name="buscar_nombre" id="buscar_nombre" value="<?php echo $valor =(!isset($_GET['nombre'])?"":$_GET['nombre']);?>">
                <span class="input-group-btn">
                    <button class="btn btn-purple btn-sm" type="button" onclick="location.href='admin.php?action=contenidos_web&nombre='+document.frm_empresa.buscar_nombre.value" id="btn_buscar_usuarios">Buscar<i class="icon-search icon-on-right bigger-110"></i></button>
                </span>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="space-6"></div> 
    <div class="col-xs-12">
        <div class="table-responsive">  
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col"><?=listado_encabezado('Página Web / Archivo','codigo_seccion')?></th>
                    <th scope="col"><?=listado_encabezado('Título','nombre_seccion_espanol')?></strong></th>
                    <th scope="col"><a href="#">Opciones</a></th>
                </tr>
            </thead>
            <tbody>
        <?php
        if ($total > 0){
            while ($a_usr = mysql_fetch_array($_pagi_result)){ ?>        
                <tr>
                    <td><?php echo $a_usr['codigo_seccion'];?></td>
                    <td><?php echo $a_usr['nombre_seccion_espanol'];?></td>
                    <td width="25%">
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="blue" href="<?php echo $a_usr['codigo_seccion'];?>"><i class="icon-zoom-in bigger-130"></i></a>
                            <a class="green" href="admin.php?action=n_contenido_web&op=2&id=<?php echo $a_usr['id_secciones_web'];?>"><i class="icon-pencil bigger-130"></i></a>
                            <a class="red" href="admin.php?action=n_contenido_web&op=3&id=<?php echo $a_usr['id_secciones_web'];?>"><i class="icon-trash bigger-130"></i></a>
                        </div>
                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="<?php echo $a_usr['codigo_seccion'];?>" class="tooltip-info" data-rel="tooltip" title="Visualizar">
                                            <span class="blue"><i class="icon-zoom-in bigger-120"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin.php?action=n_contenido_web&op=2&id=<?php echo $a_usr['id_secciones_web'];?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                            <span class="green"><i class="icon-edit bigger-120"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin.php?action=n_contenido_web&op=3&id=<?php echo $a_usr['id_secciones_web'];?>" class="tooltip-error" data-rel="tooltip" title="Eliminar">
                                            <span class="red"><i class="icon-trash bigger-120"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
        <?php 
            } //while ($a_usr = mysql_fetch_array($_pagi_result)){ 
        }//if ($total > 0){
    ?>      
            </tbody>
            </table>    
        </div>
    <!-- /.table-responsive --> 
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <ul class="pagination"><?=$_pagi_navegacion;?></ul>										
    </div>   
</div>
<!--
<form name="frm_empresa" id="frm_empresa" method="post" action="" enctype="multipart/form-data" >
  <h2>Catálogo de Contenidos de mi Sitio</h2>
  <p class="p_guia_opciones"><a href="?action=contenidos_web" class="guia_opciones">Mostar Todos</a></p>
  <p class="p_guia_opciones">Secciones registrados  en el sistema: <php echo $total; ?> registros.</p>
  <div style="width:1000px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabla_listados">
      <tr>
        <td colspan="3">
        <div class="left"><a href="admin.php?action=n_contenido_web" >[+] Nueva Sección</a></div>
        <div class="right">Buscar:
           <input type="text" name="buscar_nombre" />
           <input type="button" value="Buscar" onclick="location.href='admin.php?action=contenidos_web&nombre='+document.frm_empresa.buscar_nombre.value" />
        </div>
        </td>
      </tr>
      <tr>
        <th scope="col"><=listado_encabezado('Página Web / Archivo','codigo_seccion')?></th>
        <th scope="col"><=listado_encabezado('Título','nombre_seccion_espanol')?></strong></th>
        <th scope="col"><a href="#">Opciones</a></th>
      </tr>
      <php
        if ($total > 0){
          while ($a_usr = mysql_fetch_array($_pagi_result)){
            ?>    
            <tr>
              <td><php echo $a_usr[codigo_seccion];?></td>
              <td><php echo $a_usr[nombre_seccion_espanol];?></td>
              <td width="25%">
                <a href="admin.php?action=n_contenido_web&op=2&id=<php echo $a_usr[id_secciones_web];?>">Editar</a> | 
                <a href="<php echo $a_usr[codigo_seccion];?>" target="_blank">Visualizar</a> | 
                <a href="admin.php?action=n_contenido_web&op=3&id=<php echo $a_usr[id_secciones_web];?>">Eliminar</a>
              </td>
            </tr>
            <php
          } //end while
        }else{ ?>
          <td colspan="3" align="center">No hay registros en el sistema</td>
	  <php } ?>    
      <tr>
        <td colspan="3" style="text-align:center;"><=$_pagi_navegacion?>&nbsp;</td>
      </tr>
    </table>
  </div>
</form> -->