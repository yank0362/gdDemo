<?php 
	
	/**
	*Cookie的设置、读取、更新、删除
	*/
	class MyCookie
	{
		static private $_instance = null;
		private $expire = 0;
		private $path = '';
		private $domain = '';
		private $secure = false;
		private $httponly = false;
		
		private function __construct(array $options = [])
		{
			# code...
			$this->setOptions($options);
		}

		private function setOptions(array $options = []){
			if(isset($options['expire'])){
				$this->expire = (int)$options['expire'];
			}

			if(isset($options['path'])){
				$this->path = $options['path'];
			}

			if(isset($options['domain'])){
				$this->domain = $options['domain'];
			}

			if(isset($options['secure'])){
				$this->secure = (bool)$options['secure'];
			}

			if(isset($options['httponly'])){
				$this->httponly = (bool)$options['httponly'];
			}
			return $this;
		}

		//单例模式返回实例
		public static function getInstance(array $options = []){
			if(is_null(self::$_instance)){
				$class = __CLASS__;
				self::$_instance = new $class($options);
			}
			return self::$_instance;
		}


		public function set($name,$val,$options = []){
			if(is_array($options)&&count($options)>0){
				$this->setOptions($options);
			}

			if(is_array($val)||is_object($val)){
				$val = json_encode($val,JSON_FORCE_OBJECT);				
			}
			setcookie($name,$val,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
		}

		public function get($name){
			if(isset($_COOKIE[$name])){
				return substr($_COOKIE[$name], 0, 1) == '{'?json_decode($_COOKIE[$name]):$_COOKIE[$name];
			}else{
				return null;
			}
		}

		public function delete($name,array $options = []){
			if(is_array($options) && count($options)>0){
				$this->setOptions($options);
			}
			if(isset($_COOKIE[$name])){
				setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
				unset($_COOKIE[$name]);	
			}

		}


		public function deleteAll($options = []){
			if(is_array($options) && count($options)>0){
				$this->setOptions($options);
			}

			foreach ($_COOKIE as $name => $value) {
				setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
				unset($_COOKIE[$name]);
			}
		}
	}


	$cookie = MyCookie::getInstance();
	// $cookie->set("username","damon");
	// $cookie->set("userinfo",["name"=>'damon',"age"=>32]);
	// $cookie->set("t3600",11,['expire'=>time()+3600]);

	// var_dump($cookie->get("t3600"));
	// print_r($cookie->get("userinfo"));

	//$cookie->delete("userinfo");
	$cookie->deleteAll();
 ?>