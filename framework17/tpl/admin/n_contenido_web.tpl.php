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
                            <label for="frm_nombre" class="col-sm-3 control-label no-padding-right">Nombre de P&aacute;gina:</label>
                            <div class="col-sm-9">
                                <input name="frm_nombre_seccion_espanol"  class="col-xs-10 col-sm-5"  placeholder="Nombre de la p&aacute;gina" type="text" id="frm_nombre_seccion_espanol" value="<?php echo $_POST['frm_nombre_seccion_espanol'];?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Alias:</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" placeholder="Alias de la p&aacute;gina" name="frm_nombre_pagina_url_espanol_html" type="text" id="frm_nombre_pagina_url_espanol_html" value="<?php echo $_POST['frm_nombre_pagina_url_espanol_html'];?>" />
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Descripci&oacute;n de P&aacute;gina:</label>
                            <div class="col-sm-9">
                                <input name="frm_descripcion_espanol" class="col-xs-10 col-sm-5" placeholder="Usuario" type="text" id="frm_descripcion_espanol" value="<?php echo $_POST['frm_descripcion_espanol'];?>" />
                            </div>
                        </div>                                                       
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Palabras Claves:</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" placeholder="Palabras Claves" name="frm_keywords_espanol" type="text" id="frm_keywords_espanol"  value="<?php echo $_POST['frm_keywords_espanol'];?>" />
                            </div>
                        </div>                                                                        
                        <div class="form-group">
                            <label for="form-field-1" class="col-sm-3 control-label no-padding-right">Contenido HTML:</label>
                            <div class="col-sm-9">
                                <div id="editor" class="wysiwyg-editor"><?php echo $_POST['frm_contenido_espanol_html'];?></div>
                                <input type="hidden" name="frm_contenido_espanol_html" id="frm_contenido_espanol_html" value=""/>
                            </div>
                        </div>
                        <div class="form-actions center">
                            <button class="btn btn-sm btn-inverse" type="button" onclick="location.href='admin.php?action=contenidos-web'">Cancelar<i class="icon-ban-circle align-top bigger-110"></i></button>
                            <button class="btn btn-sm btn-primary" type="submit" value="accept" name="accept" id="accept">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>
                            <!-- <button onclick="$(this).submitForm();" class="btn btn-sm btn-primary" type="button">Guardar<i class="icon-arrow-right icon-on-right bigger-110"></i></button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>  							
</div>
<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
<script>
jQuery(function($){
    $('#editor').ace_wysiwyg({
        toolbar:[{
                    name:'font',
                    title:'Custom tooltip',
                    values:['Some Special Font!','Arial','Verdana','Comic Sans MS','Custom Font!']
                },
                null,
                {
                    name:'fontSize',
                    title:'Custom tooltip',
                    values:{1 : 'Size#1 Text' , 2 : 'Size#1 Text' , 3 : 'Size#3 Text' , 4 : 'Size#4 Text' , 5 : 'Size#5 Text'} 
                },
                null,
                {name:'bold', title:'Custom tooltip'},
                {name:'italic', title:'Custom tooltip'},
                {name:'strikethrough', title:'Custom tooltip'},
                {name:'underline', title:'Custom tooltip'},
                null,
                'insertunorderedlist',
                'insertorderedlist',
                'outdent',
                'indent',
                null,
                {name:'justifyleft'},
                {name:'justifycenter'},
                {name:'justifyright'},
                {name:'justifyfull'},
                null,
                {
                    name:'createLink',
                    placeholder:'Custom PlaceHolder Text',
                    button_class:'btn-purple',
                    button_text:'Custom TEXT'
                },
                {name:'unlink'},
                null,
                {
                    name:'insertImage',
                    placeholder:'Custom PlaceHolder Text',
                    button_class:'btn-inverse',
                    //choose_file:false,//hide choose file button
                    button_text:'Set choose_file:false to hide this',
                    button_insert_class:'btn-pink',
                    button_insert:'Insert Image'
                },
                null,
                {
                    name:'foreColor',
                    title:'Custom Colors',
                    values:['red','green','blue','navy','orange'],
                    /**
                        You change colors as well
                    */
                },
                /**null,
                {
                        name:'backColor'
                },*/
                null,
                {name:'undo'},
                {name:'redo'},
                null,
                'viewSource'
                ],
                //speech_button:false,//hide speech button on chrome
                'wysiwyg': {
                    hotKeys : {} //disable hotkeys
                }			
    }).prev().addClass('wysiwyg-style2');

    $('#frm_secciones_web').on('submit', function(){
	$('#frm_contenido_espanol_html').val($('#editor').html());
	return true;
    });

});
</script>
         

