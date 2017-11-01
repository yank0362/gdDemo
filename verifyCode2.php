<?php 

	//1.创建画布
	$width = 200;
	$height = 40;
	$img = imagecreatetruecolor($width, $height);
	$fontwidth = imagefontwidth(28);
	$fontheight = imagefontheight(28);


	//创建颜色

	$bgcolor = imagecolorallocate($img, 255, 255, 255);

	imagefilledrectangle($img, 0, 0, $width, $height, $bgcolor);


	$string = join("",array_merge(range(0,9),range('a','z'),range('A','Z')));

	//echo $string;

	function getRandColor($img)
	{
		# code...
		return imagecolorallocate($img, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	}

	$length = 4;


	//添加像素干扰

	for($i=0;$i<50;$i++){

		imagesetpixel($img, mt_rand(0,$width), mt_rand(0,$height), getRandColor($img));
	}

	//添加直线干扰元素

	for($i=0;$i<3;$i++){

		imageline($img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), getRandColor($img));
	}

	//添加圆弧干扰元素

	for($i=0;$i<2;$i++){

		imagearc($img, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width/2), mt_rand(0,$height/2), mt_rand(0,360), mt_rand(0,360), getRandColor($img));

	}


	for($i=0 ;$i<$length;$i++){
		$randcolor = getRandColor($img);
		$text = str_shuffle($string)[0];

		$size = mt_rand(20,28);

		$angle = mt_rand(-15,15);

		$x = ($width/$length)*$i + $fontwidth;
		//echo $height-$fontheight;
		$y = $height*0.75;
		//$y = mt_rand($fontheight+($height-$fontheight)/2,$height-10);

		$fontfile = "fonts/msyh.ttf";
		imagettftext($img, $size, $angle, $x, $y, $randcolor, $fontfile, $text);
	}

	header("content-type:image/png");

	imagepng($img);
	imagedestroy($img);

 ?>