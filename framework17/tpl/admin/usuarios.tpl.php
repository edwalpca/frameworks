<div class="row">
    <div class="col-xs-4">
        <button class="btn btn-primary" id="btn_agregar" >[+] Agregar</button>
        <button class="btn btn-primary" id="btn_mostrar" >Mostar Todos</button>          
    </div>
    <div class="col-xs-8">
        <span>&nbsp;</span>
    </div>
</div> 
<div class="row">
    <div class="space-6"></div>    
    <div class="col-xs-9">
        <span>Usuarios en el sistema: <strong><?php echo $total; ?></strong> registros</span>
    </div>
    <div class="col-xs-3">
        <div class="input-group">
            <input type="text" placeholder="Escriba aquí..." class="form-control search-query" name="buscar_nombre" id="buscar_nombre" value="<?php echo $valor =(!isset($_GET['nombre'])?"":$_GET['nombre']);?>">
            <span class="input-group-btn">
                <button class="btn btn-purple btn-sm" type="button" id="btn_buscar_usuarios">Buscar<i class="icon-search icon-on-right bigger-110"></i></button>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="space-6"></div> 
    <div class="col-xs-12">
        <div class="table-responsive">  
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo listado_encabezado('Login','login')?></th>
                    <th><?php echo listado_encabezado('Nombre','nombre')?></th>
                    <th class="hidden-480"><?php echo listado_encabezado('Último acceso','ultimo_acceso')?></th>
                    <th class="hidden-480">Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
        <?php
        if ($total > 0){
            while ($a_usr = mysql_fetch_array($_pagi_result)){ ?>        
                <tr>
                    <td><?php echo $a_usr["login"]?></td>
                    <td><?php echo $a_usr["nombre"]?></td>
                    <td class="hidden-480"><?php echo $a_usr["ultimo_acceso"]?></td>
                    <td class="hidden-480"><?=$a_usr["estado"]=='ACTIVO'?'activo':"inactivo"?></td>
                    <td>
                        <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            <div class="pull-right action-buttons">
                                <a class="blue" href="<?=$_SERVER['SCRIPT_NAME'].'?action=nmusuario&op=2&id='.$a_usr['id_administrador'];?>"><i class="icon-pencil bigger-130"></i></a>
                                <span class="vbar"></span>
                                <a class="red" href="<?=$_SERVER['SCRIPT_NAME'].'?action=nmusuario&op=3&id='.$a_usr['id_administrador'];?>"><i class="icon-trash bigger-130"></i></a>
                            </div>                          
                        </div>
                        <div class="visible-xs visible-sm hidden-md hidden-lg">
                            <div class="inline position-relative">
                                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown"> <i class="icon-cog icon-only bigger-110"></i> </button>
                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                    <li><a href="<?=$_SERVER['SCRIPT_NAME'].'?action=nmusuario&op=2&id='.$a_usr['id_administrador'];?>" class="tooltip-success" data-rel="tooltip" title="Editar"><span class="green"><i class="icon-edit bigger-120"></i></span></a></li>
                                    <li><a href="<?=$_SERVER['SCRIPT_NAME'].'?action=nmusuario&op=3&id='.$a_usr['id_administrador'];?>" class="tooltip-error" data-rel="tooltip" title="Eliminar"><span class="red"><i class="icon-trash bigger-120"></i></span></a></li>                
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