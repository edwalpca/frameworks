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
    <div class="col-xs-6">
        <button class="btn btn-primary" id="btn_agregar" onclick="location.href='admin.php?action=n_breadcrumbs'">[+] Nuevo BreadCrumb</button>
        <button class="btn btn-primary" id="btn_mostrar" onclick="location.href='admin.php?action=breadcrumbs'">Mostar Todos</button>          
    </div>
    <div class="col-xs-8">
        <span>&nbsp;</span>
    </div>
</div> 
<form name="frm_empresa" id="frm_empresa" method="get" action="" enctype="multipart/form-data" >
    <div class="row">
        <div class="space-6"></div>    
        <div class="col-xs-9">
            <span>Valores en el sistema: <strong><?php echo $total; ?></strong> registros</span>
        </div>
        <div class="col-xs-3">
            <div class="input-group">
                <input type="text" placeholder="Escriba aquí..." class="form-control search-query" name="buscar_nombre" id="buscar_nombre" value="<?php echo $valor =(!isset($_GET['nombre'])?"":$_GET['nombre']);?>">
                <span class="input-group-btn">
                    <button class="btn btn-purple btn-sm" type="button" onclick="location.href='admin.php?action=breadcumbs&nombre='+document.frm_empresa.buscar_nombre.value" id="btn_buscar_usuarios">Buscar<i class="icon-search icon-on-right bigger-110"></i></button>
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
                    <th scope="col"><?=listado_encabezado('Action','action')?></th>
                    <th scope="col"><?=listado_encabezado('Breadcrumbs','breadcrumbs')?></th>
                    <th scope="col"><?=listado_encabezado('Tags','tags')?></th>
                    <th scope="col"><a href="#">Opciones</a></th>
                </tr>
            </thead>
            <tbody>
        <?php
        if ($total > 0){
            while ($a_usr = mysql_fetch_array($_pagi_result)){ ?>        
                <tr>
                    <td><?=$a_usr["action"];?></td>
                    <td><?=htmlspecialchars($a_usr["breadcrumbs"]);?></td>
                    <td><?=htmlspecialchars($a_usr["tags"]);?></td>
                    <td width="25%">
                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                            <a class="green" href="admin.php?action=n_breadcrumbs&op=2&id=<?php echo $a_usr['id_breadcrumbs'];?>"><i class="icon-pencil bigger-130"></i></a>
                            <a class="red" href="admin.php?action=n_breadcrumbs&op=3&id=<?php echo $a_usr['id_breadcrumbs'];?>"><i class="icon-trash bigger-130"></i></a>
                        </div>
                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-caret-down icon-only bigger-120"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li>
                                        <a href="admin.php?action=n_breadcrumbs&op=2&id=<?php echo $a_usr['id_breadcrumbs'];?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                            <span class="green"><i class="icon-edit bigger-120"></i></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="admin.php?action=n_breadcrumbs&op=3&id=<?php echo $a_usr['id_breadcrumbs'];?>" class="tooltip-error" data-rel="tooltip" title="Eliminar">
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