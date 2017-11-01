<?php 

	//创建画布
	$width = 400;
	$height = 50;
	$img = imagecreatetruecolor($width, $height);//创建画布

	//创建背景色
	$bgcolor = imagecolorallocate($img, 255, 255, 255);//白色背景

	//画笔颜色

	$fontcolor = imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));

	imagefilledrectangle($img, 0, 0, 400, 50, $bgcolor);

	$size = mt_rand(20,28);

	$angle = mt_rand(-15,15);
	$x = 50;
	$y = 30;

	$fontfile = "fonts/msyh.ttf";
	$text = mt_rand(1000,9999);
	imagettftext($img, $size, $angle, $x, $y, $fontcolor, $fontfile, $text);
	header("content-type:image/png");
	imagepng($img);
	imagedestroy($img);


 ?>