<?php
   session_start();
	function randomText($length) {
		$pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i=0;$i<$length;$i++) {
		  $key .= $pattern{rand(0,35)};
		}
		return $key;
	}

	$_SESSION['Ncode'] = randomText(4);
	$captcha = imagecreatefromgif("images/admin/bgcaptcha.gif");
	$colText = imagecolorallocate($captcha, 255, 255, 255);
	imagestring($captcha, 10, 16, 7, $_SESSION['Ncode'], $colText);
	header("Content-type: image/gif");
	imagegif($captcha);
	exit;
?>