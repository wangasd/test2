<?php 
/**
* mysqli
*/
class qi
{
	private static $sqli=null;
	private $res;
	function __construct()
	{
		$myres=new mysqli('127.0.0.1:3306','root','jkm','test');
		$this->res=$myres;
	}

	public static function getmysqli()
	{
		if (self::$sqli==null) {
			self::$sqli=new self;
		}
		return self::$sqli;
		
	}
	private function __clone(){}
	public function __get($getname){
		if(isset($this->$getname)){
			return $this->$getname;
		}
		return null;
	}
}
 ?>