<?php 

	/**
	* 验证码类
	*/
	class Captcha
	{
		private $_fontfile ="";//字体文件
		private $_width = 120; //画布宽度
		private $_height = 40; //画布高度
		private $_size = 20;//字体大小
		private $_length = 4;//验证码长度
		private $_image = null;//画布资源
		private $_snow = 0;//雪花个数
		private $_pixel = 0;//像素个数
		private $_line = 0;//线段个数


		public function __construct($config = array())
		{
			if(is_array($config)&&count($config)>0){
				//初始化字体文件
				if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
					$this->_fontfile = $config['fontfile'];
				}
				//初始化画布宽度
				if(isset($config['width'])&&$config['width']>0){
					$this->_width = (int)$config['width'];
				}

				//初始化画布高度
				if(isset($config['height'])&&$config['height']>0){
					$this->_height = (int)$config['height'];
				}

				//初始化字体大小
				if(isset($config['size'])&&$config['size']>0){
					$this->_size = (int)$config['size'];
				}

				//初始化验证码长度
				if(isset($config['length'])&&$config['length']>0){
					$this->_length = (int)$config['length'];
				}	

				if(isset($config['snow'])&&$config['snow']>0){
					$this->_snow = (int)$config['snow'];
				}	

				if(isset($config['pixel'])&&$config['pixel']>0){
					$this->_pixel = (int)$config['pixel'];
				}	

				if(isset($config['line'])&&$config['line']>0){
					$this->_line = (int)$config['line'];
				}				
				$this->_image = imagecreatetruecolor($this->_width, $this->_height);
				return $this->_image;
			}else{
				return false;
			}
				
		}

		/**
		 * @return 验证码 string
		 */
		public function getCaptcha(){
			
			$bgcolor = imagecolorallocate($this->_image, 255, 255, 255);//白色背影色

			//填充背影色
			imagefilledrectangle($this->_image, 0, 0, $this->_width, $this->_height, $bgcolor);

			//生成验证码
			$str = $this->_generateStr();
			if(false === $str){
				return false;
			}

			//绘制验证码
			$fontfile = $this->_fontfile;
			for($i=0; $i<$this->_length; $i++){
				$size = $this->_size;
				$angle = mt_rand(-30,30);
				$x = ceil($this->_width/$this->_length)*$i+mt_rand(5,10);
				$y = ceil($this->_height/1.5);
				$color = $this->_getRandColor();
				$text = mb_substr($str, $i,1,'utf-8');
				//$text = $str[$i];
				imagettftext($this->_image, $size, $angle, $x, $y, $color, $fontfile, $text);
			}
			//绘制干扰元素
			if($this->_snow){
					$this->_getSnow();
			}else{
					if($this->_pixel){
						$this->_getPixel();
					}

					if($this->_line){
						$this->_getLine();
					}
			}
			header("content-type:image/png");
			imagepng($this->_image);
			imagedestroy($this->_image);
			return $str;

		}
		/**
		 * 产生验证码字符
		 * @param  integer
		 * @return string
		 */
		private function _generateStr($length = 4){

			if($length<1 || $length>30){
				return false;
			}

			$chars = array(
				'a','b','c','d','e','f','g','h','k','m','n','p','x','y','z',
				'A','B','C','D','E','F','G','H',"K",'M','N','P','X','Y','Z',
				1,2,3,4,5,6,7,8,9
			);

			$str = join('',array_rand(array_flip($chars),$length));
			return $str;
		}

		/**
		 * 获取随机颜色
		 * @return [type]
		 */
		private function _getRandColor(){
			return imagecolorallocate($this->_image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
		}

		/**
		 * 绘制干扰雪花
		 * @return void
		 */
		private function _getSnow(){
			for($i=0;$i<$this->_snow;$i++){
				imagestring($this->_image, mt_rand(1,5), mt_rand(0,$this->_width), mt_rand(0,$this->_height), '*', $this->_getRandColor());
			}

		}
		/**
		 * 绘制干扰像素
		 * @return void
		 */
		private function _getPixel(){

			for($i=0;$i<$this->_pixel;$i++){

				imagesetpixel($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
			}

		}
		/**绘制干扰线段
		 * @return void
		 */
		private function _getLine(){
			for($i=0;$i<$this->_line;$i++){
				imageline($this->_image, mt_rand(0,$this->_width), mt_rand(0,$this->_height), mt_rand(0,$this->_width), mt_rand(0,$this->_height), $this->_getRandColor());
			}

		}
	}
	
 ?>