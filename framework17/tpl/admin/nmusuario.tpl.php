<div class="row">
    <form class="form-horizontal" id="frm_usuario" method="post" name="frm-usuario" enctype="multipart/form-data" action="<?php url_actual();?>">    
        <div class="col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4>Datos del Usuario</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main no-padding">
                    <?php controles_form_manager($prefijo,$tabla);?>
                    <!-- <legend>Form</legend> -->
                        <div class="space-4"></div>
                        <div class="form-group">
                            <label for="frm_nombre" class="col-sm-3 control-label no-padding-right"> Nombre: </label>
                            <div class="col-sm-9">
                                <input type="text" class="col-xs-10 col-sm-5" placeholder="Nombre Completo" id="frm_nombre" name="frm_nombre" value="<?=$_POST["frm_nombre"]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Email: </label>
                            <div class="col-sm-9">
                                <input type="text" class="col-xs-10 col-sm-5" placeholder="Correo Electr&eacute;nico" id="frm_email" name="frm_email" value="<?=$_POST["frm_email"]?>">
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Usuario: </label>
                            <div class="col-sm-9">
                                <input type="text" class="col-xs-10 col-sm-5" placeholder="Usuario" id="frm_login" name="frm_login" value="<?=$_POST["frm_login"]?>">
                            </div>
                        </div>                                                       
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Clave: </label>
                            <div class="col-sm-9">
                                <input type="text" class="col-xs-10 col-sm-5" placeholder="Contraseña" id="frm_clave" name="frm_clave" value="<?=$_POST["frm_clave"]?>" >
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Estado en Sistema </label>
                            <div class="col-sm-9">
                                <input name="frm_estado" type="radio" <?php echo $prtp = ($_POST['frm_estado'] == "ACTIVO")?"checked='checked'":"";?> id="frm_estado2" value="activo" /> Activo
                                <input name="frm_estado" type="radio" <?php echo $prtp = ($_POST['frm_estado'] == "INACTIVO")?"checked='checked'":"";?> id="frm_estado2" value="inactivo" /> Inactivo
                            </div>
                        </div>            
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Foto de perfil:</label>
                            <div class="col-sm-4">
                                <?php if(isset($_GET['id'])){ ?>
                                    <span class="profile-picture">
                                        <img id="avatar" class="editable img-responsive" alt="<?php echo $_SESSION['usuario'];?>" src="<?=$_SESSION["foto_perfil"].'_small';?>" />
                                    </span>
                                <?php } ?>
                                <input type="file" id="id-input-file-3" name="frm_foto_perfil" id="frm_foto_perfil"/>
                            </div>
                        </div>
                        <div class="form-actions center">
                            <button class="btn btn-sm btn-inverse" type="button" onclick="location.href='admin.php?action=usuarios'">Cancelar<i class="icon-ban-circle align-top bigger-110"></i></button>
                            <button class="btn btn-sm btn-primary" type="submit">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  							
</div>
<script>
jQuery(function($) {
   $('#id-input-file-3').ace_file_input({
                        style:'well',
                        btn_choose:'Drop files here or click to choose',
                        btn_change:null,
                        no_icon:"icon-picture",
                        droppable:true,
                        thumbnail:'small'//large | fit
                        //,icon_remove:null//set null, to hide remove/reset button
                        /**,before_change:function(files, dropped) {
                                //Check an example below
                                //or examples/file-upload.html
                                return true;
                        }*/
                        /**,before_remove : function() {
                                return true;
                        }*/,
                        before_change : function(files, dropped) {
                            var allowed_files = [];
                            for(var i = 0 ; i < files.length; i++) {
                                var file = files[i];
                                if(typeof file === "string") {
                                    //IE8 and browsers that don't support File Object
                                    if(!(/\.(jpe?g|png|gif|bmp)$/i).test(file)) 
                                        return false;
                                }else{
                                    var type = $.trim(file.type);
                                    if(( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )|| ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name)))//for android's default browser which gives an empty string for file.type 
                                        continue;//not an image so don't keep this file
                                }
                                allowed_files.push(file);
                            }
                            if(allowed_files.length == 0) return false;
                            return allowed_files;
                        },
                        preview_error : function(filename, error_code) {
                                //name of the file that failed
                                //error_code values
                                //1 = 'FILE_LOAD_FAILED',
                                //2 = 'IMAGE_LOAD_FAILED',
                                //3 = 'THUMBNAIL_FAILED'
                                //alert(error_code);
                        }
    }).on('change', function(){
        //console.log($(this).data('ace_input_files'));
        //console.log($(this).data('ace_input_method'));
    });
});
</script>