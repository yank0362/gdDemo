<?php 

	header("Content-type: image/jpeg");
	$im = imagecreatetruecolor(200,200);
	$bgcolor = imagecolorallocate($im,255,255,255);
	imagefilledrectangle($im, 0, 0, 200, 200,$bgcolor);
	$randColor = imagecolorallocate($im, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	$font = "fonts/msyh.ttf";
	imagettftext($im,20,0,20,30,$randColor,$font,"冉老板，请客~");
	imagettftext($im,20,80,80,180,$randColor,$font,"冉老板下午茶~");
	imagettftext($im,20,30,60,100,$randColor,$font,"冉老板呵呵哒~");
	imagejpeg($im);
	imagejpeg($im,"images/1.jpg");//保存图像到指定的目录
	imagedestroy($im);

 ?>