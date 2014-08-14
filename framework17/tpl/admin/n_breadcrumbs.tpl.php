<script type="text/javascript">
    $(document).ready(function(){
        $.fn.submitForm = function(){
            $('#frm_contenido_espanol_html').val($('#editor').html());
            $.post('<?php echo url_actual();?>&flw=on', $('#frm_secciones_web').serialize(),function(resp){
                alert('Almacenado');
                window.location = 'admin.php?action=contenidos_web';
            });
        }
    });
</script>
<?php 
    if (isset($_GET['id'])){
        $where = ' AND id_breadcrumbs != '.$_GET['id'];
    }else{
        $where = '';
    }
    $padres = recordset('sql_select.sql',0,true,' * ',' breadcrumbs WHERE fk_id_breadcrumbs = 0 '.$where);
?>
<div class="row">
    <form class="form-horizontal" id="frm_secciones_web" method="post" name="frm_secciones_web" enctype="multipart/form-data" action="<?php echo url_actual();?>">    
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4>Usted puede agregar o modificar la informacion mediante el siguiente formulario</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                    <?php controles_form_manager($prefijo,$tabla);?>
                    <!-- <legend>Form</legend> -->
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label for="frm_nombre" class="col-sm-3 control-label no-padding-right">Action:</label>
                            <div class="col-sm-9">
                                <input name="frm_action"  class="col-xs-10 col-sm-5"  placeholder="Nombre del action" type="text" id="frm_action" value="<?php echo $_POST['frm_action'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Titulo:</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" placeholder="Alias de la p&aacute;gina" name="frm_breadcrumbs" type="text" id="frm_breadcrumbs" value="<?php echo $_POST['frm_breadcrumbs'];?>" />
                            </div>
                        </div>                                                                                                                              
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Descripci&oacute;n:</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" placeholder="Palabras Claves" name="frm_descripcion" type="text" id="frm_descripcion"  value="<?php echo $_POST['frm_descripcion'];?>" />
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Palabras Claves:</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" placeholder="Palabras Claves" name="frm_tags" type="text" id="frm_tags"  value="<?php echo $_POST['frm_tags'];?>" />
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Padre:</label>
                            <div class="col-sm-9">
                                <select id="frm_fk_id_breadcrumbs" name="frm_fk_id_breadcrumbs">
                                    <option value="0">Ninguno</option>
                                <?php foreach ($padres as $key => $padre) {?>
                                    <option value="<?=$padre['id_breadcrumbs']?>" <?php if ($_POST['frm_fk_id_breadcrumbs'] == $padre['id_breadcrumbs']){echo 'selected=""';}?>><?=$padre['breadcrumbs'].' - '.$padre['action']?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions center">
                            <button class="btn btn-sm btn-inverse" type="button" onclick="location.href='admin.php?action=breadcrumbs'">Cancelar<i class="icon-ban-circle align-top bigger-110"></i></button>
                            <button class="btn btn-sm btn-primary" type="submit" value="accept" name="accept" id="accept">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
                            <!-- <button onclick="$(this).submitForm();" class="btn btn-sm btn-primary" type="button">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  							
</div>
<script src="assets/js/bootstrap-tag.min.js"></script>
<script>
jQuery(function($){
    var tag_input = $('#frm_tags');
    if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) {
        tag_input.tag({
            placeholder:tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            //source: ace.variable_US_STATES,//defined in ace.js >> ace.enable_search_ahead
        });
    }else{
        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
        tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
        //$('#form-field-tags').autosize({append: "\n"});
    }
});
</script>
         

