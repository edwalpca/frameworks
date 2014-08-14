<?php

	session_start();
	$_SESSION["activa"] = 0;
	session_unset();
	session_destroy();
        setcookie('id_administrador',"",time() - 3600);
	header('Location: admin.php');
	exit;
?>
<script>
	parent.window.location = 'admin.php';
</script>