<div class="row">
    <div class="col-xs-12">
        <div class="tabbable">
            <div class="tab-content no-border no-padding">
                <div class="tab-pane in active">
                    <div class="message-container">
                        <div id="id-message-list-navbar" class="message-navbar align-center clearfix">
                            <div class="message-bar">
                                <div class="message-infobar" id="id-message-infobar">
                                    <span class="blue bigger-150">Buz&oacute;n de entrada</span>
                                    <span class="grey bigger-110">(<span id="cantidad_sin_leer"><?=$sin_leer[0]['cantidad'];?></span> mensajes sin leer)</span>
                                </div>
                                <div class="message-toolbar hide">
                                    <div class="inline position-relative align-left">
                                        <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <span class="bigger-110">Acciones</span>
                                            <i class="icon-caret-down icon-on-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125"><!--
                                            <li>
                                                <a href="#"><i class="icon-mail-reply blue"></i>&nbsp; Reply</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-mail-forward green"></i>&nbsp; Reenviar</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-folder-open orange"></i>&nbsp; Archive</a>
                                            </li>
                                            <li class="divider"></li>-->
                                            <li>
                                                <a href="#" id="marca_todos_leidos"><i class="icon-eye-open blue"></i>&nbsp; Marcar como le&iacute;do</a>
                                            </li>
                                            <li>
                                                <a href="#" id="marca_todos_no_leidos"><i class="icon-eye-close green"></i>&nbsp; Marca como no le&iacute;do</a>
                                            </li><!--
                                            <li>
                                                <a href="#"><i class="icon-flag-alt red"></i>&nbsp; Flag</a>
                                            </li>-->
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" class="eliminar_todos"><i class="icon-trash red bigger-110"></i>&nbsp; Eliminar</a>
                                            </li>
                                        </ul>
                                    </div><!--
                                    <div class="inline position-relative align-left">
                                        <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-folder-close-alt bigger-110"></i>
                                            <span class="bigger-110">Move to</span>
                                            <i class="icon-caret-down icon-on-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                                            <li>
                                                <a href="#"><i class="icon-stop pink2"></i>&nbsp; Tag#1</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-stop blue"></i>&nbsp; Family</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-stop green"></i>&nbsp; Friends</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-stop grey"></i>&nbsp; Work</a>
                                            </li>
                                        </ul>
                                    </div>  -->
                                    <a href="#" class="btn btn-xs btn-message eliminar_todos">
                                        <i class="icon-trash bigger-125"></i>
                                        <span class="bigger-110">Eliminar</span>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div class="messagebar-item-left">
                                    <label class="inline middle"><input type="checkbox" id="id-toggle-all" class="ace" /><span class="lbl"></span></label>&nbsp;
                                    <div class="inline position-relative">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-caret-down bigger-125 middle"></i></a>
                                        <ul class="dropdown-menu dropdown-lighter dropdown-100">
                                            <li><a id="id-select-message-all" href="#">Todos</a></li>
                                            <li><a id="id-select-message-none" href="#">Ninugno</a></li>
                                            <li class="divider"></li>
                                            <li><a id="id-select-message-unread" href="#">Sin leer</a></li>
                                            <li><a id="id-select-message-read" href="#">Le&iacute;dos</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="messagebar-item-right">
                                    <div class="inline position-relative">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">Ordenar &nbsp;<i class="icon-caret-down bigger-125"></i></a>
                                        <ul class="dropdown-menu dropdown-lighter pull-right dropdown-100">
                                            <?php 
                                            if ($_GET['lstorderby'] == 'asunto'){
                                                $active[0] = 'invisible';
                                                $active[1] = 'invisible';
                                                $active[2] = 'green';
                                            }else if ($_GET['lstorderby'] == 'nombre'){
                                                $active[0] = 'invisible';
                                                $active[1] = 'green';
                                                $active[2] = 'invisible';
                                            }else{
                                                $active[0] = 'green';
                                                $active[1] = 'invisible';
                                                $active[2] = 'invisible';
                                            }
                                            ?>
                                            <li><a href="admin.php?action=<?=$_GET['action']?>&lstorderby=id_form&lstordertype=DESC"><i class="icon-ok <?=$active[0];?>"></i>Fecha</a></li>
                                            <li><a href="admin.php?action=<?=$_GET['action']?>&lstorderby=nombre&lstordertype=ASC"><i class="icon-ok <?=$active[1];?>"></i>Remitente</a></li>
                                            <li><a href="admin.php?action=<?=$_GET['action']?>&lstorderby=asunto&lstordertype=ASC"><i class="icon-ok <?=$active[2];?>"></i>Asunto</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="nav-search minimized">
                                    <form class="form-search" id="buscar" name="buscar" action="admin.php" method="GET">
                                        <input type="hidden" id="action" name="action" value="mensajes"/>
                                        <span class="input-icon">
                                            <input type="text" id="parametro" value="<?=$_GET['parametro'];?>" name="parametro" class="input-small nav-search-input" placeholder="Buscar ..." />
                                            <i class="icon-search nav-search-icon"></i>
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="id-message-item-navbar" class="hide message-navbar align-center clearfix">
                            <div class="message-bar">
                                <div class="message-toolbar">
                                    <div class="inline position-relative align-left">
                                        <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <span class="bigger-110">Acciones</span>
                                            <i class="icon-caret-down icon-on-right"></i>
                                        </a>
					<ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125"><!-- 
                                            <li><a href="#"><i class="icon-mail-reply blue"></i>&nbsp; Reply</a></li> -->
                                            <li><a href="#" class="reenviar_button"><i class="icon-mail-forward green"></i>&nbsp; Reenviar</a></li> <!--
                                            <li><a href="#"><i class="icon-folder-open orange"></i>&nbsp; Archive</a></li> -->
                                            <li class="divider"></li>
                                            <li><a href="#" class="marca_leido_individual"><i class="icon-eye-open blue"></i>&nbsp; Marcar como le&iacute;do</a></li>
                                            <li><a href="#" class="marca_no_leido_individual"><i class="icon-eye-close green"></i>&nbsp; Marcar como no le&iacute;do</a></li><!--
                                            <li><a href="#"><i class="icon-flag-alt red"></i>&nbsp; Flag</a></li> -->
                                            <li class="divider"></li>
                                            <li><a href="#" class="elimina_individual"><i class="icon-trash red bigger-110"></i>&nbsp; Eliminar</a></li>
                                        </ul>
                                    </div>
                                    <!--
                                    <div class="inline position-relative align-left">
                                        <a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-folder-close-alt bigger-110"></i>
                                            <span class="bigger-110">Move to</span>
                                            <i class="icon-caret-down icon-on-right"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
                                            <li><a href="#"><i class="icon-stop pink2"></i>&nbsp; Tag#1</a></li>
                                            <li><a href="#"><i class="icon-stop blue"></i>&nbsp; Family</a></li>
                                            <li><a href="#"><i class="icon-stop green"></i>&nbsp; Friends</a></li>
                                            <li><a href="#"><i class="icon-stop grey"></i>&nbsp; Work</a></li>
                                        </ul>
                                    </div> -->
                                    <a href="#" class="btn btn-xs btn-message elimina_individual">
                                        <i class="icon-trash bigger-125"></i>
                                        <span class="bigger-110">Eliminar</span>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div class="messagebar-item-left">
                                    <a href="#" class="btn-back-message-list">
                                        <i class="icon-arrow-left blue bigger-110 middle"></i>
                                        <b class="bigger-110 middle">Atras</b>
                                    </a>
                                </div>
                                <!-- <div class="messagebar-item-right">
                                    <i class="icon-time bigger-110 orange middle"></i>
                                    <span class="time grey">Today, 7:15 pm</span>
                                </div> -->
                            </div>
                        </div>
                        <div id="id-message-new-navbar" class="hide message-navbar align-center clearfix">
                            <div class="message-bar"><!--
                                <div class="message-toolbar">
                                    <a href="#" class="btn btn-xs btn-message">
                                        <i class="icon-save bigger-125"></i>
                                        <span class="bigger-110">Save Draft</span>
                                    </a>
                                    <a href="#" class="btn btn-xs btn-message">
                                        <i class="icon-remove bigger-125"></i>
                                        <span class="bigger-110">Discard</span>
                                    </a>
                                </div>-->
                            </div>
                            <div class="message-item-bar">
                                <div class="messagebar-item-left">
                                    <a href="#" class="btn-back-message-list no-hover-underline">
                                        <i class="icon-arrow-left blue bigger-110 middle"></i>
                                        <b class="middle bigger-110">Atras</b>
                                    </a>
                                </div>
                                <div class="messagebar-item-right">
                                    <span class="inline btn-send-message">
                                        <button type="button" class="btn btn-sm btn-primary no-border enviar-correo">
                                            <span class="bigger-110">Enviar</span>
                                            <i class="icon-arrow-right icon-on-right"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="message-list-container">
                            <?php if ($total > 0){ ?>
                            <div class="message-list" id="message-list"> 
                                <form id="actualiza_todos" name="actualiza_todos"/>
                                <input type="hidden" id="accion" name="accion" value="3"/> 
                                <input type="hidden" id="estado" name="estado" value=""/> <?php
                                while ($a_usr = mysql_fetch_array($_pagi_result)){
                                    if (date('Ymd') == date('Ymd', strtotime($a_usr['id_form']))){
                                        $hora = date('H:i', strtotime($a_usr['id_form']));
                                        $fecha = 'Hoy '.$hora;
                                    }else{
                                        $fecha = date('d M Y, H:i', strtotime($a_usr['id_form']));
                                        $hora = date('d M', strtotime($a_usr['id_form']));
                                    }
                                    if ($a_usr['estado'] == 'no leido'){
                                        $class = 'message-unread';
                                        $estado = 'data-estado="no"';
                                    }else{
                                        $class = '';
                                        $estado = 'data-estado="si"';
                                    }?> 
                                    <div class="message-item <?=$class;?>" id="id_message-<?=$a_usr['id_mensaje'];?>">
                                        <input type="hidden" name="correo" id="correo-<?=$a_usr['id_mensaje']?>" value="<?=$a_usr['email']?>"/>
                                        <label class="inline"><input type="checkbox" class="ace" name="id_mensaje[]" id="id_mensaje" value="<?=$a_usr['id_mensaje']?>"/><span class="lbl"></span></label>
                                        <span class="sender" id="sender-<?=$a_usr['id_mensaje']?>" title="<?=$a_usr['nombre']?>"><?=$a_usr['nombre']?></span>
                                        <span class="time"><?=$hora;?></span>
                                        <span class="summary">
                                            <span class="text" data="<?=$a_usr['id_mensaje']?>" <?=$estado;?>><?=$a_usr['asunto']?></span>
                                        </span>
                                    </div>

                                    <div class="hide message-content" id="message-content-<?=$a_usr['id_mensaje']?>">
                                        <div class="message-header clearfix">
                                            <div class="pull-left">
                                                <span class="blue bigger-125" id="summary-<?=$a_usr['id_mensaje']?>"><?=$a_usr['asunto']?></span>
                                                <div class="space-4"></div>
                                                <a href="#" class="sender"><?=$a_usr['nombre']?></a>&nbsp;
                                                <i class="icon-time bigger-110 orange middle"></i>
                                                <span class="time"><?=$fecha;?></span>
                                            </div>
                                            <div class="action-buttons pull-right">
                                                <!-- <a href="#"><i class="icon-reply green icon-only bigger-130"></i></a> -->
                                                <a href="#" class="reenviar_button"><i class="icon-mail-forward blue icon-only bigger-130"></i></a>
                                                <a href="#" class="elimina_individual"><i class="icon-trash red icon-only bigger-130"></i></a>
                                            </div>
                                        </div>
                                        <div class="hr hr-double"></div>
                                        <div class="message-body" id="message-body-<?=$a_usr['id_mensaje']?>">
                                            <?=$a_usr['descripcion']?>
                                        </div>
                                        <div class="hr hr-double"></div>
                                    </div><!-- /.message-content -->

                                    <div class="hide message-content" id="message-content-error">
                                        <div class="message-header clearfix">
                                            <div class="pull-left">
                                                <span class="blue bigger-125">No hay un contenido para este item.</span>
                                            </div>
                                        </div>
                                        <div class="message-body"></div>
                                        <div class="hr hr-double"></div>
                                    </div><!-- /.message-content -->     
                            <?php } ?>
                            </form>
                            </div>
                        <?php }else{?>
                            <div class="message-item">
                                <label class="inline"></label>
                                <span class="sender"></span>
                                <span class="time"></span>
                                <span class="summary2">
                                    <span class="text" data="test">No hay mensajes disponibles</span>
                                </span>
                            </div>
                        <?php } ?>
                        </div><!-- /.message-list-container -->
                        <div class="message-footer clearfix">
                            <div class="pull-left">Total de mensajes <?=$todos[0]['cantidad'];?></div>
                            <div class="pull-right">
                                <!-- <div class="inline middle"> page 1 of 16 </div>&nbsp; &nbsp; -->
                                <ul class="pagination middle">                                    
                                    <?php echo $_pagi_navegacion; ?> <!--
                                    <li class="disabled"><span><i class="icon-step-backward middle"></i></span></li>
                                    <li class="disabled"><span><i class="icon-caret-left bigger-140 middle"></i></span></li>
                                    <li><span><input value="1" maxlength="3" type="text" /></span></li>
                                    <li><a href="#"><i class="icon-caret-right bigger-140 middle"></i></a></li>
                                    <li><a href="#"><i class="icon-step-forward middle"></i></a></li> -->
				</ul>
                            </div>
                        </div>
                        <div class="hide message-footer message-footer-style2 clearfix">
                            <!-- <div class="pull-left"> simpler footer </div>
                            <div class="pull-right">
                                <div class="inline middle"> message 1 of 151 </div>&nbsp;&nbsp;
                                <ul class="pagination middle">
                                    <li class="disabled"><span><i class="icon-angle-left bigger-150"></i></span></li>
                                    <li><a href="#"><i class="icon-angle-right bigger-150"></i></a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div><!-- /.message-container -->
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-content -->
        </div><!-- /.tabbable -->
        <form id="id-message-form" class="hide form-horizontal message-form col-xs-12">
            <input type="hidden" name="accion" id="accion" value="2"/>
            <input type="hidden" name="correo_original" id="correo_original" value=""/>
            <input type="hidden" name="message" id="message" value=""/>
            <div class="">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-recipient">Para:</label>
                    <div class="col-sm-9">
                        <span class="input-icon">
                            <input type="email" name="recipient" id="form-field-recipient" data-value="" value="" placeholder="Para" class="valid" /><i class="icon-user"></i>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-recipient">De:</label>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-icon block col-xs-12 no-padding">
                            <input maxlength="100" type="text" class="col-xs-12" name="info-original" id="info-original" placeholder="De" readonly=""/><i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="hr hr-18 dotted"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-subject">Asunto:</label>
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-icon block col-xs-12 no-padding">
                            <input maxlength="100" type="text" class="col-xs-12" name="subject" id="form-field-subject" placeholder="Asunto" /><i class="icon-comment-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="hr hr-18 dotted"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"><span class="inline space-24 hidden-480"></span>Message:</label>
                    <div class="col-sm-9"><div class="wysiwyg-editor" id="wysiwyg-message"></div></div>
                </div>
                <div class="hr hr-18 dotted"></div>
                <div class="space"></div>
            </div>
        </form>
    </div><!-- /.col -->
</div><!-- /.row -->
<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery(function($){
    //handling tabs and loading/displaying relevant messages and forms
    //not needed if using the alternative view, as described in docs
    var prevTab = 'inbox'
    $('#inbox-tabs a[data-toggle="tab"]').on('show.bs.tab',function(e){
        var currentTab = $(e.target).data('target');
        if(currentTab == 'write'){
            Inbox.show_form();
        }else{
            if(prevTab == 'write')
                Inbox.show_list();
		//load and display the relevant messages 
        }
        prevTab = currentTab;
    });
    //basic initializations
    $('.message-list .message-item input[type=checkbox]').removeAttr('checked');
    $('.message-list').delegate('.message-item input[type=checkbox]' , 'click', function() {
        $(this).closest('.message-item').toggleClass('selected');
        if(this.checked){
            Inbox.display_bar(1);//display action toolbar when a message is selected
        }else{
            Inbox.display_bar($('.message-list input[type=checkbox]:checked').length);
            //determine number of selected messages and display/hide action toolbar accordingly
        }		
    });
    //check/uncheck all messages
    $('#id-toggle-all').removeAttr('checked').on('click', function(){
        if(this.checked){
            Inbox.select_all();
        }else{
            Inbox.select_none();
        }
    });
    //select all
    $('#id-select-message-all').on('click', function(e) {
        e.preventDefault();
        Inbox.select_all();
    });
    //select none
    $('#id-select-message-none').on('click', function(e) {
        e.preventDefault();
        Inbox.select_none();
    });
    //select read
    $('#id-select-message-read').on('click', function(e) {
        e.preventDefault();
        Inbox.select_read();
    });
    //select unread
    $('#id-select-message-unread').on('click', function(e) {
        e.preventDefault();
        Inbox.select_unread();
    });
    /////////
    //display first message in a new area
    $('.message-list .message-item .text').on('click', function() {
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        var id = $(this).attr('data');
        var estado = $(this).attr('data-estado');
        var message_container = $(this);
        $.post('admin.php?action=mensajes&flw=on',{id:id,estado:'leido',accion:'1'}, function (result){
            if (result==1){
                if (estado == 'no'){
                    var cantidad = Number($('#cantidad_sin_leer').html());
                    if (cantidad > 0){
                        cantidad = cantidad - 1;
                        $('#cantidad_sin_leer').html(cantidad);
                    }
                }
                $('.reenviar_button').attr('data-estado','si');
                $('#id_message-'+id).removeClass('message-unread');
                $('.reenviar_button').attr('data',id);
                $('.marca_leido_individual').attr('data',id);
                $('.marca_no_leido_individual').attr('data',id);
                $('.elimina_individual').attr('data',id);
                //show the loading icon
                $('.message-inline-open').removeClass('message-inline-open').find('.message-content').remove();
                var message_list = message_container.closest('.message-list');
                //hide everything that is after .message-list (which is either .message-content or .message-form)
                message_list.next().addClass('hide');
                $('.message-container').find('.message-loading-overlay').remove();
                //close and remove the inline opened message if any!
                //hide all navbars
                $('.message-navbar').addClass('hide');
                //now show the navbar for single message item
                $('#id-message-item-navbar').removeClass('hide');
                //hide all footers
                $('.message-footer').addClass('hide');
                //now show the alternative footer
                $('.message-footer-style2').removeClass('hide');
                //move .message-content next to .message-list and hide .message-list
                //message_list.addClass('hide').after($('.message-content')).next().removeClass('hide');
                if ( $('#message-content-'+id).length > 0){
                    message_list.addClass('hide').after($('#message-content-'+id)).next().removeClass('hide');
                }else{
                    message_list.addClass('hide').after($('#message-content-error')).next().removeClass('hide');
                }
            }else{
                bootbox.alert("Error al abrir el mensaje.", function(){
                    $('.message-container').find('.message-loading-overlay').remove();
                });
            }
        });
    });
    /*
    //display second message right inside the message list
    $('.message-list .message-item:eq(1) .text').on('click', function(){
        //alert(this);
        var message = $(this).closest('.message-item');
	//if message is open, then close it
        if(message.hasClass('message-inline-open')) {
            message.removeClass('message-inline-open').find('.message-content').remove();
            return;
        }
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        setTimeout(function() {
            $('.message-container').find('.message-loading-overlay').remove();
            message.addClass('message-inline-open').append('<div class="message-content" />');
            var content = message.find('.message-content:last').html( $('#id-message-content').html() );
            content.find('.message-body').slimScroll({
                height: 200,
                railVisible:true
            });
        }, 500 + parseInt(Math.random() * 500));	
    }); */
    //back to message list
    $('.btn-back-message-list').on('click', function(e) {
        e.preventDefault();
        Inbox.show_list();
        $('#inbox-tabs a[data-target="inbox"]').tab('show'); 
    });
    //hide message list and display new message form
    /**
    $('.btn-new-mail').on('click', function(e){
        e.preventDefault();
        Inbox.show_form();
    });*/
    var Inbox = {
        //displays a toolbar according to the number of selected messages
        display_bar : function (count) {
            if(count == 0) {
                $('#id-toggle-all').removeAttr('checked');
                $('#id-message-list-navbar .message-toolbar').addClass('hide');
                $('#id-message-list-navbar .message-infobar').removeClass('hide');
            }else{
                $('#id-message-list-navbar .message-infobar').addClass('hide');
                $('#id-message-list-navbar .message-toolbar').removeClass('hide');
            }
        },
        select_all : function() {
            var count = 0;
            $('.message-item input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });
            $('#id-toggle-all').get(0).checked = true;
            Inbox.display_bar(count);
        },
        select_none : function() {
            $('.message-item input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
            $('#id-toggle-all').get(0).checked = false;
            Inbox.display_bar(0);
        },
        select_read : function() {
            $('.message-unread input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
            var count = 0;
            $('.message-item:not(.message-unread) input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });
            Inbox.display_bar(count);
        },
        select_unread : function() {
            $('.message-item:not(.message-unread) input[type=checkbox]').removeAttr('checked').closest('.message-item').removeClass('selected');
            var count = 0;
            $('.message-unread input[type=checkbox]').each(function(){
                this.checked = true;
                $(this).closest('.message-item').addClass('selected');
                count++;
            });					
            Inbox.display_bar(count);
        }
    }
    //show message list (back from writing mail or reading a message)
    Inbox.show_list = function() {
        $('.message-navbar').addClass('hide');
        $('#id-message-list-navbar').removeClass('hide');
        $('.message-footer').addClass('hide');
        $('.message-footer:not(.message-footer-style2)').removeClass('hide');
        $('.message-list').removeClass('hide').next().addClass('hide');
        //hide the message item / new message window and go back to list
    }
    //show write mail form
    Inbox.show_form = function() {
        if($('.message-form').is(':visible')){ 
            return
        };
        if(!form_initialized) {
            initialize_form();
        }
	var message = $('.message-list');
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
	setTimeout(function() {
            message.next().addClass('hide');
            $('.message-container').find('.message-loading-overlay').remove();					
            $('.message-list').addClass('hide');
            $('.message-footer').addClass('hide');
            $('.message-form').removeClass('hide').insertAfter('.message-list');			
            $('.message-navbar').addClass('hide');
            $('#id-message-new-navbar').removeClass('hide');
            //reset form??
            $('.message-form .wysiwyg-editor').empty();
            $('.message-form .ace-file-input').closest('.file-input-container:not(:first-child)').remove();
            $('.message-form input[type=file]').ace_file_input('reset_input');
            $('.message-form').get(0).reset();	
        }, 300 + parseInt(Math.random() * 300));
    }
    var form_initialized = false;
    function initialize_form() {
        if(form_initialized){
            return;
        }
        form_initialized = true;
        //intialize wysiwyg editor
        $('.message-form .wysiwyg-editor').ace_wysiwyg({
            toolbar:[
                        'bold',
                        'italic',
                        'strikethrough',
                        'underline',
                        null,
                        'justifyleft',
                        'justifycenter',
                        'justifyright',
                        null,
                        'createLink',
                        'unlink',
                        null,
                        'undo',
                        'redo']
        }).prev().addClass('wysiwyg-style1');
	//file input
        $('.message-form input[type=file]').ace_file_input()
        //and the wrap it inside .span7 for better display, perhaps
        .closest('.ace-file-input').addClass('width-90 inline').wrap('<div class="row file-input-container"><div class="col-sm-7"></div></div>');
        //the button to add a new file input
        $('#id-add-attachment').on('click', function(){
            var file = $('<input type="file" name="attachment[]" />').appendTo('#form-attachments');
            file.ace_file_input();
            file.closest('.ace-file-input').addClass('width-90 inline').wrap('<div class="row file-input-container"><div class="col-sm-7"></div></div>')
            .parent(/*.span7*/).append('<div class="action-buttons pull-right col-xs-1">\
                <a href="#" data-action="delete" class="middle">\
                    <i class="icon-trash red bigger-130 middle"></i>\
                </a></div>').find('a[data-action=delete]').on('click', function(e){
                    //the button that removes the newly inserted file input
                    e.preventDefault();			
                    $(this).closest('.row').hide(300, function(){
                        $(this).remove();
                    });
            });
        });
    }//initialize_form
    //turn the recipient field into a tag input field!
    /**	
    var tag_input = $('#form-field-recipient');
    if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) 
        tag_input.tag({placeholder:tag_input.attr('placeholder')});


    //and add form reset functionality
    $('.message-form button[type=reset]').on('click', function(){
        $('.message-form .message-body').empty();
        $('.message-form .ace-file-input:not(:first-child)').remove();
        $('.message-form input[type=file]').ace_file_input('reset_input');
        var val = tag_input.data('value');
        tag_input.parent().find('.tag').remove();
        $(val.split(',')).each(function(k,v){
            tag_input.before('<span class="tag">'+v+'<button class="close" type="button">&times;</button></span>');
        });
    });
    */		
    $('.reenviar_button').on('click', function(e){
        var id = $(this).attr('data');
        if($('.message-form').is(':visible')){ 
            return
        };
        if(!form_initialized) {
            initialize_form();
        }
	var message = $('.message-list');
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
	setTimeout(function() {
            message.next().addClass('hide');
            $('.message-container').find('.message-loading-overlay').remove();					
            $('.message-list').addClass('hide');
            $('.message-footer').addClass('hide');
            $('.message-form').removeClass('hide').insertAfter('.message-list');			
            $('.message-navbar').addClass('hide');
            $('#id-message-new-navbar').removeClass('hide');
            //reset form??
            $('.message-form .wysiwyg-editor').empty();
            $('.message-form .ace-file-input').closest('.file-input-container:not(:first-child)').remove();
            $('.message-form input[type=file]').ace_file_input('reset_input');
            $('.message-form').get(0).reset();	
            $('.wysiwyg-editor').html($('#message-body-'+id).html());
            $('#form-field-subject').val($('#summary-'+id).html());
            $('#info-original').val($('#sender-'+id).html()+' <'+$('#correo-'+id).val()+'>');
            $('#correo_original').val($('#correo-'+id).val());
        }, 300 + parseInt(Math.random() * 300));
    });
    
    $(".elimina_individual").on(ace.click_event, function(){
        var id = $(this).attr('data');
        bootbox.confirm("\xBFEsta seguro de eliminar este mensaje?", function(result) {
            if(result) {
                $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
                $.post('admin.php?action=mensajes&flw=on',{id:id,estado:'borrado',accion:'1'}, function (result){
                    if (result==1){
                        bootbox.alert("Mensaje eliminado correctamente.", function(){
                            $('#id_message-'+id).remove();
                            $('#message-content-'+id).remove();
                            $('.message-container').find('.message-loading-overlay').remove();
                            $('.btn-back-message-list').click();
                        });
                    }else{
                        bootbox.alert("Error al eliminar el mensaje.", function(){
                            $('.message-container').find('.message-loading-overlay').remove();
                        });
                    }
                });
            }
        });
    });
    
    $('.marca_leido_individual').on(ace.click_event, function(){
        var id = $(this).attr('data');
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        $.post('admin.php?action=mensajes&flw=on',{id:id,estado:'leido',accion:'1'}, function (result){
            if (result==1){
                var cantidad = Number($('#cantidad_sin_leer').html());
                if (cantidad > 0){
                    cantidad = cantidad - 1;
                }
                $('#cantidad_sin_leer').html(cantidad);
                $('#id_message-'+id).removeClass('message-unread');
                $('.message-container').find('.message-loading-overlay').remove();
                $('.btn-back-message-list').click();
            }else{
                bootbox.alert("Error al marca el mensaje como leido.", function(){
                    $('.message-container').find('.message-loading-overlay').remove();
                });
            }
        });
    });
    
    $('.marca_no_leido_individual').on(ace.click_event, function(){
        var id = $(this).attr('data');
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        $.post('admin.php?action=mensajes&flw=on',{id:id,estado:'no leido',accion:'1'}, function (result){
            if (result==1){
                var cantidad = Number($('#cantidad_sin_leer').html());
                cantidad = cantidad + 1;
                $('#cantidad_sin_leer').html(cantidad);
                $('.reenviar_button').attr('data-estado','no');
                $('#id_message-'+id).addClass('message-unread');
                $('.message-container').find('.message-loading-overlay').remove();
                $('.btn-back-message-list').click();
            }else{
                bootbox.alert("Error al marca el mensaje como no leido.", function(){
                    $('.message-container').find('.message-loading-overlay').remove();
                });
            }
        });
    });
    
    $('.enviar-correo').on(ace.click_event, function(){
        if(!$('#id-message-form').valid()){
            return false;
        }else{
            $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
            $('#message').val($('#wysiwyg-message').html());
            $.post('admin.php?action=mensajes&flw=on',$('#id-message-form').serialize(),function (data){
                if (data==1){
                    bootbox.alert("Correo reenviado correctamente.", function(){
                        $('.message-container').find('.message-loading-overlay').remove();
                        $('.btn-back-message-list').click();
                    });
                }else{
                    bootbox.alert("Error al reenviar el correo.", function(){
                        $('.message-container').find('.message-loading-overlay').remove();
                    });
                }
           });
       }
    });
    
    $('#marca_todos_leidos').on(ace.click_event, function(){
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        $('#estado').val('leido');
        $.post('admin.php?action=mensajes&flw=on',$('#actualiza_todos').serialize(), function (result){
            if (result==1){
                window.location.reload();
            }else{
                bootbox.alert("Error al marca los mensajes como leidos.", function(){
                    $('.message-container').find('.message-loading-overlay').remove();
                });
            }
        });
    });
    
    $('#marca_todos_no_leidos').on(ace.click_event, function(){
        $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
        $('#estado').val('no leido');
        $.post('admin.php?action=mensajes&flw=on',$('#actualiza_todos').serialize(), function (result){
            if (result==1){
                window.location.reload();
            }else{
                bootbox.alert("Error al marca los mensajes como no leidos.", function(){
                    $('.message-container').find('.message-loading-overlay').remove();
                });
            }
        });
    });
    
    $('.eliminar_todos').on(ace.click_event, function(){
        bootbox.confirm("\xBFEsta seguro de eliminar los mensajes?", function(result) {
            if(result) {
                $('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
                $('#estado').val('borrado');
                $.post('admin.php?action=mensajes&flw=on',$('#actualiza_todos').serialize(), function (result){
                    if (result==1){
                        window.location.reload();
                    }else{
                        bootbox.alert("Error al eliminar los mensajes.", function(){
                            $('.message-container').find('.message-loading-overlay').remove();
                        });
                    }
                });
            }
        });
    });
});
</script>