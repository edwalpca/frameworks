<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CONFIG_TITULO_APLICACION; ?></title>

<link type="text/css" rel="stylesheet" href="<?php echo CONFIG_PATH_CSS; ?>jquery_themes/redmond/jquery-ui-1.8.17.custom.css" />	
<script type="text/javascript" src="<?php echo CONFIG_PATH_JS; ?>jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo CONFIG_PATH_JS; ?>jquery_ui/jquery-ui-1.8.17.custom.min.js"></script>
<!--[if lt IE 7]><link type="text/css" rel="stylesheet" href="<?php echo CONFIG_PATH_CSS; ?>ie6blocker/ie6blocker.css" /><![endif]-->
</head>

<body>
<h1 align="center">

<a href="#" onclick="return false;"><?=CONFIG_TITULO_APLICACION?></a>
</h1>

<div id="content">
	<?=$salida?>
</div>
<div align="center"><a href="admin.php">admin</a></div>
</body>
</html>
