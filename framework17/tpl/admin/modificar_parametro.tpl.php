<div class="row">
    <form class="form-horizontal" id="frm_parametro" method="post" name="frm_parametro" enctype="multipart/form-data" action="<?php echo url_actual();?>">    
        <input type="hidden" name="accept" id="accept" value="1"/>
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4>Editar Par&aacute;metros del Sistema</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                    <!-- <legend>Form</legend> -->
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label for="frm_nombre" class="col-sm-3 control-label no-padding-right">Nombre del Par&aacute;metro:</label>
                            <div class="col-sm-9">
                                <input name="frm_nombre"  class="col-xs-10 col-sm-5" readonly="" placeholder="Nombre del par&aacute;metro" type="text" id="frm_nombre" value="<?php echo $_POST['frm_nombre'];?>" />
                            </div>
                        </div>                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Valor:</label>
                            <div class="col-sm-9">
                                <textarea name="frm_valor" id="frm_valor" cols="45" rows="5"><?=$_POST["frm_valor"]?></textarea>
                            </div>
                        </div>
                        <div class="form-actions center">
                            <button class="btn btn-sm btn-inverse" type="button" onclick="location.href='admin.php?action=contenidos-web'">Cancelar<i class="icon-ban-circle align-top bigger-110"></i></button>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
                            <!-- <button onclick="$(this).submitForm();" class="btn btn-sm btn-primary" type="button">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  							
</div>