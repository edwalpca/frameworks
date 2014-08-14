<?php 
    $op_sistema[] = 'usuarios';
    $op_sistema[] = 'nmusuario';
    $op_sistema[] = 'contenidos_web';
    $op_sistema[] = 'n_contenido_web';
    $op_sistema[] = 'sistema';
    $op_sistema[] = 'modificar_parametro';
    $op_sistema[] = 'breadcrumbs';
    $op_sistema[] = 'n_breadcrumbs';
    $op_sistema[] = 'respaldo';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo CONFIG_TITULO_APLICACION; ?></title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <!--[if IE 7]>
      <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" href="assets/css/chosen.css" />
    <!-- fonts -->
    <link rel="stylesheet" href="assets/css/ace-fonts.css" />
    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <!-- basic scripts -->
    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
    </script>
    <!-- <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
    </script>
    <![endif]-->
    <script type="text/javascript">
        if("ontouchend" in document) 
            document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script> 
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <!-- ace scripts -->
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        <?php 
        if (file_exists("scripts/".$_GET['action'].".inc.js")){
            include("scripts/".$_GET['action'].".inc.js"); 
        }?>
    </script>             
</head>
<body>
    <div class="navbar navbar-default" id="navbar">
        <script type="text/javascript">
            try{ace.settings.check('navbar' , 'fixed')}catch(e){}
        </script>
        <div class="navbar-container" id="navbar-container">
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small><?php echo CONFIG_TITULO_APLICACION; ?></small>
                </a><!-- /.brand -->
            </div><!-- /.navbar-header -->
            <div class="navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="grey">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-tasks"></i><span class="badge badge-grey">4</span>
                        </a>
                        <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header"><i class="icon-ok"></i>4 Tasks to complete</li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left">Software Update</span>
                                        <span class="pull-right">65%</span>
                                    </div>
                                    <div class="progress progress-mini "><div style="width:65%" class="progress-bar "></div></div>
                                </a>
                            </li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left">Hardware Upgrade</span>
					<span class="pull-right">35%</span>
                                    </div>
                                    <div class="progress progress-mini "><div style="width:35%" class="progress-bar progress-bar-danger"></div></div>
                                </a>
                            </li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left">Unit Testing</span>
					<span class="pull-right">15%</span>
                                    </div>
                                    <div class="progress progress-mini "><div style="width:15%" class="progress-bar progress-bar-warning"></div></div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left">Bug Fixes</span>
                                        <span class="pull-right">90%</span>
                                    </div>
                                    <div class="progress progress-mini progress-striped active"><div style="width:90%" class="progress-bar progress-bar-success"></div></div>
                                </a>
                            </li>
                            <li><a href="#">See tasks with details<i class="icon-arrow-right"></i></a></li>
                        </ul>
                    </li>
                    <li class="purple">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-bell-alt icon-animated-bell"></i><span class="badge badge-important">8</span>
                        </a>
                        <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header"><i class="icon-warning-sign"></i>8 Notifications</li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left"><i class="btn btn-xs no-hover btn-pink icon-comment"></i>New Comments</span>
                                        <span class="pull-right badge badge-info">+12</span>
                                    </div>
                                </a>
                            </li>
                            <li><a href="#"><i class="btn btn-xs btn-primary icon-user"></i>Bob just signed up as an editor ...</a></li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left"><i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>New Orders</span>
                                        <span class="pull-right badge badge-success">+8</span>
                                    </div>
                                </a>
                            </li>
                            <li><a href="#">
                                    <div class="clearfix">
                                        <span class="pull-left"><i class="btn btn-xs no-hover btn-info icon-twitter"></i>Followers</span>
                                        <span class="pull-right badge badge-info">+11</span>
                                    </div>
                                </a>
                            </li>
                            <li><a href="#">See all notifications<i class="icon-arrow-right"></i></a></li>
                        </ul>
                    </li>
                    <li class="green">
                        <?php 
                        $count_unread = recordset('sql_select.sql',0,true,' COUNT(*) as cantidad ',' mensaje WHERE estado = "no leido"');
                        $mensajes = recordset('sql_select.sql',0,true,' * ',' mensaje WHERE estado = "no leido" ORDER BY id_form DESC LIMIT 5');
                        ?>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-envelope icon-animated-vertical"></i><span class="badge badge-success"><?=$count_unread[0]['cantidad'];?></span></a>
                        <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header"><i class="icon-envelope-alt"></i><?=$count_unread[0]['cantidad'];?> Mensajes</li>
                            <?php
                            if (count($mensajes)>0){
                                foreach ($mensajes as $key => $mensaje){
                                    if (date('Ymd') == date('Ymd', strtotime($mensaje['id_form']))){
                                        $hora = date('H:i', strtotime($mensaje['id_form']));
                                        $fecha = 'Hoy '.$hora;
                                    }else{
                                        $hora = date('d M', strtotime($mensaje['id_form']));
                                    }?>
                                    <li><a href="admin.php?action=mensajes">
                                            <span class="msg-body">
                                                <span class="msg-title"><span class="blue"><?=$mensaje['nombre'];?>:</span><?=$mensaje['asunto'];?></span>
                                                <span class="msg-time"><i class="icon-time"></i><span><?=$hora?></span></span>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <li><a href="admin.php?action=mensajes">Ver todos los mensajes<i class="icon-arrow-right"></i></a></li> <?php
                                }else{//if (count($mensajes)>0){?>
                                    <li><a href="admin.php?action=mensajes">
                                        <span class="msg-body">
                                            <span class="msg-title"><span class="blue">No hay Mensajes</span>
                                            <span class="msg-time"><i class="icon-time"></i><span><?php echo date('H:i');?></span></span>
                                        </span>
                                        </a>
                                    </li>
                                <?php } ?>
                        </ul>
                    </li>
                    <li class="light-blue">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="<?php echo $_SESSION['foto_perfil'].'_small';?>" alt="<?php echo $_SESSION['usuario'];?>"/>
                            <span class="user-info"><small>Usuario,</small><?php echo $_SESSION['usuario'];?></span><i class="icon-caret-down"></i>
                        </a>
                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li><a href="#"><i class="icon-cog"></i>Herramientas</a></li>
                            <li>
                                <a href="admin.php?action=nmusuario&op=2&id=<?php echo $_SESSION['id_usuario'];?>"><i class="icon-user"></i>Mi Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="admin.php?action=desconectar"><i class="icon-off"></i>Salir</a></li>
                        </ul>
                    </li>
                </ul><!-- /.ace-nav -->
            </div><!-- /.navbar-header -->
        </div><!-- /.container -->
    </div>
    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>
        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#"><span class="menu-text"></span></a>
            <div class="sidebar" id="sidebar">
                <script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                </script>
                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success"><i class="icon-signal"></i></button>
                        <button class="btn btn-info"><i class="icon-pencil"></i></button>
                        <button class="btn btn-warning"><i class="icon-group"></i></button>
                        <button class="btn btn-danger"><i class="icon-cogs"></i></button>
                    </div>
                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>
                        <span class="btn btn-info"></span>
                        <span class="btn btn-warning"></span>
                        <span class="btn btn-danger"></span>
                    </div>
                </div><!-- #sidebar-shortcuts -->
                <ul class="nav nav-list">
                    <li <?php if ($_GET['action'] == 'admin_inicio'){echo 'class="active"';}?>>
                        <a href="admin.php"><i class="icon-dashboard"></i><span class="menu-text">Inicio</span></a>
                    </li>
                    <li  <?php if ($_GET['action'] == 'menu1'){echo 'class="active"';}?>>
                        <a href="admin.php?action=menu1"><i class="icon-tag"></i><span class="menu-text"> Menu 1 </span></a>
                    </li>
                    <li  <?php if ($_GET['action'] == 'menu2'){echo 'class="active"';}?>>
                        <a href="admin.php?action=menu2"><i class="icon-tag"></i><span class="menu-text"> Menu 2  </span></a>
                    </li>
                    <li  <?php if ($_GET['action'] == 'menu3'){echo 'class="active"';}?>>
                        <a href="admin.php?action=menu3"><i class="icon-tag"></i><span class="menu-text"> Menu 3 </span></a>
                    </li>                                                
                    <li  <?php if ($_GET['action'] == 'mensajes'){echo 'class="active"';}?>>
                        <a href="admin.php?action=mensajes"><i class="icon-envelope"></i><span class="menu-text"> Mensajes </span></a>
                    </li>                                                
                    <?php 
                    if (in_array($_GET['action'],$op_sistema)){
                        $class = 'class="active open"'; 
                    }else{
                        $class = '';
                    }
                    ?>
                    <li <?=$class;?>>
                        <a href="#" class="dropdown-toggle"><i class="icon-cogs"></i><span class="menu-text"> Sistema </span><b class="arrow icon-angle-down"></b></a>
                        <ul class="submenu">
                            <?php 
                            if (($_GET['action'] == 'usuarios') or ($_GET['action'] == 'nmusuario')){
                                $class = 'class="active"'; 
                            }else{
                                $class = '';
                            }?>
                            <li <?=$class?>>
                                <a href="admin.php?action=usuarios"><i class="icon-double-angle-right"></i>Usuarios de Acceso</a>
                            </li>   
                            <?php 
                            if (($_GET['action'] == 'contenidos_web') or ($_GET['action'] == 'n_contenido_web')){
                                $class = 'class="active"'; 
                            }else{
                                $class = '';
                            }?>
                            <li <?=$class;?>>
                                <a href="admin.php?action=contenidos_web"><i class="icon-double-angle-right"></i>Mis P&aacute;ginas Web</a>
                            </li>                                                              
                            <?php 
                            if (($_GET['action'] == 'sistema') or ($_GET['action'] == 'modificar_parametro')){
                                $class = 'class="active"'; 
                            }else{
                                $class = '';
                            }?>
                            <li <?=$class;?>>
                                <a href="admin.php?action=sistema"><i class="icon-double-angle-right"></i>Par&aacute;metros</a>
                            </li>
                            <?php 
                            if ($_GET['action'] == 'respaldo'){
                                $class = 'class="active"'; 
                            }else{
                                $class = '';
                            }?>
                            <li <?=$class;?>>
                                <a href="admin.php?action=respaldo"><i class="icon-double-angle-right"></i>Respaldar Informaci&oacute;n</a>
                            </li>
                            <?php 
                            if (($_GET['action'] == 'breadcrumbs') or ($_GET['action'] == 'n_breadcrumbs')){
                                $class = 'class="active"'; 
                            }else{
                                $class = '';
                            }?>
                            <li <?=$class;?>>
                                <a href="admin.php?action=breadcrumbs"><i class="icon-double-angle-right"></i>Breadcrumbs</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-briefcase"></i><span class="menu-text"> ToolKit - HTML </span>
                            <b class="arrow icon-angle-down"></b>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="kit-html/" target="_blank"><i class="icon-double-angle-right"></i>Galer&iacute;a HTML</a>
                            </li>                                                            
                            <li>
                                <a href="kit-html/docs/" target="_blank"><i class="icon-double-angle-right"></i>Documentaci&oacute;n  ToolKit - HTML</a>
                            </li>
                        </ul>
                    </li>                                                
                    <li>
                        <a href="admin.php?action=desconectar"><i class="icon-unlock"></i><span class="menu-text"> Salir </span></a>
                    </li>                                                    
                </ul><!-- /.nav-list -->
                <div class="sidebar-collapse" id="sidebar-collapse">
                    <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                </div>
                <script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                </script>
            </div>
            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                    <script type="text/javascript">
                        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                    </script>
                    <ul class="breadcrumb">
                        <li><i class="icon-home home-icon"></i><a href="admin.php">Inicio</a></li>
                        <?php 
                        if ($_GET['action'] != 'admin_inicio'){
                            $m_datos =  recordset("sql_select.sql",0,true,' * ',' breadcrumbs WHERE action = "'.$_GET['action'].'" LIMIT 1');
                            if ($m_datos[0]['fk_id_breadcrumbs'] != '0'){
                                $m_padre =  recordset("sql_select.sql",0,true,' * ',' breadcrumbs WHERE id_breadcrumbs = "'.$m_datos[0]['fk_id_breadcrumbs'].'" LIMIT 1');?>
                                <li><a href="admin.php?action=<?=$m_padre[0]['action'];?>"><?=$m_padre[0]['breadcrumbs'];?></a></li>
                                <li class="active"><?=$m_datos[0]['breadcrumbs'];?></li><?php
                            }else{?>
                                <li><?=$m_datos[0]['breadcrumbs'];?></li><?php                            
                            }
                        }
                        ?>
                    </ul><!-- .breadcrumb -->
                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                <i class="icon-search nav-search-icon"></i>
                            </span>
                        </form>
                    </div><!-- #nav-search -->
                </div>
                <div class="page-content">
                    <div class="page-header">
                         <?php 
                        if ($_GET['action'] != 'admin_inicio'){?>
                        <h1>
                            <?=$m_datos[0]['breadcrumbs'];?>
                            <small><i class="icon-double-angle-right"></i><?=$m_datos[0]['descripcion'];?></small>
                        </h1>
                        <?php } ?>
                    </div><!-- /.page-header -->
                    <div class="row">
                        <div class="col-xs-12"><!-- PAGE CONTENT BEGINS --><?php echo $salida; ?><!-- END PAGE CONTENT BEGINS --></div><!-- /.col -->  
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn"><i class="icon-cog bigger-150"></i></div>
                <div class="ace-settings-box" id="ace-settings-box">
                    <div>
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-skin="default" value="#438EB9">#438EB9</option>
                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div>
                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                    </div>
                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>
                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div>
                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                    </div>
                    <div>
                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                        <label class="lbl" for="ace-settings-add-container">Inside<b>.container</b></label>
                    </div>
                </div>
            </div><!-- /#ace-settings-container -->
        </div><!-- /.main-container-inner -->
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"><i class="icon-double-angle-up icon-only bigger-110"></i></a>
    </div><!-- /.main-container -->
</body>
</html>