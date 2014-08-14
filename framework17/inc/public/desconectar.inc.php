<?php

	session_start();
	$_SESSION["activa"] = 0;
	session_unset();
	session_destroy();
	header('Location: index.php');
	exit;
?>
<script>
	parent.window.location = 'index.php';
</script>