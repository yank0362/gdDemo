<?php 

	require_once 'Captcha.class.php';

	$config = array(
		'fontfile' =>"fonts/msyh.ttf",
		'line'=>3,
		'pixel'=>40,

	 );
	$cap = new Captcha($config);
	$verifyCode = $cap->getCaptcha();
	session_start();
	$_SESSION['verifyCode'] = $verifyCode;

 ?>