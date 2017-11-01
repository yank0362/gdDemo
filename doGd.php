<?php 

//1、创建画布

$width = 480;
$height = 320;

$img_handler = imagecreatetruecolor($width, $height);//返回图像标识符

//2、创建颜色

$gray = imagecolorallocate($img_handler,108,109,105);

$blue = imagecolorallocate($img_handler, 168,193,221);

$green = imagecolorallocate($img_handler, 0,152,0);





//3、开始绘画
imagechar($img_handler, 5, 10, 10, 'B', $blue);//水平绘制一个字符

//4、输入或保存图像
header("content-type:image/png");
imagepng($img_handler);


//5、销毁资源

imagedestroy($img_handler);
 ?>