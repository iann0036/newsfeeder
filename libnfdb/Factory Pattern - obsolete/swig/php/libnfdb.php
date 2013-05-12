<?php namespace nfdb;

/* ----------------------------------------------------------------------------
 * This file was automatically generated by SWIG (http://www.swig.org).
 * Version 1.3.40
 * 
 * This file is not intended to be easily readable and contains a number of 
 * coding conventions designed to improve portability and efficiency. Do not make
 * changes to this file unless you know what you are doing--modify the SWIG 
 * interface file instead. 
 * ----------------------------------------------------------------------------- */

// Try to load our extension if it's not already loaded.
if (!extension_loaded('libnfdb')) {
  if (strtolower(substr(PHP_OS, 0, 3)) === 'win') {
    if (!dl('php_libnfdb.dll')) return;
  } else {
    // PHP_SHLIB_SUFFIX gives 'dylib' on MacOS X but modules are 'so'.
    if (PHP_SHLIB_SUFFIX === 'dylib') {
      if (!dl('libnfdb.so')) return;
    } else {
      if (!dl('libnfdb.'.PHP_SHLIB_SUFFIX)) return;
    }
  }
}



/* PHP Proxy Classes */
class DateTime {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($rhs=null) {
		if (is_resource($rhs) && get_resource_type($rhs) === '_p_DateTime') {
			$this->_cPtr=$rhs;
			return;
		}
		$this->_cPtr=$r;
		switch (func_num_args()) {
		case 0: $this->_cPtr=new_DateTime(); break;
		default: $this->_cPtr=new_DateTime($rhs);
		}
	}

	public function ExportToMySQL() {
		return DateTime_ExportToMySQL($this->_cPtr);
	}

	public function ImportFromMySQL($source) {
		DateTime_ImportFromMySQL($this->_cPtr,$source);
	}

	public function ParseFromString($source) {
		DateTime_ParseFromString($this->_cPtr,$source);
	}

	public function GetSecond() {
		return DateTime_GetSecond($this->_cPtr);
	}

	public function GetMinute() {
		return DateTime_GetMinute($this->_cPtr);
	}

	public function GetHour() {
		return DateTime_GetHour($this->_cPtr);
	}

	public function GetDay() {
		return DateTime_GetDay($this->_cPtr);
	}

	public function GetMonth() {
		return DateTime_GetMonth($this->_cPtr);
	}

	public function GetYear() {
		return DateTime_GetYear($this->_cPtr);
	}

	public function SetSecond($sec) {
		DateTime_SetSecond($this->_cPtr,$sec);
	}

	public function SetMinute($min) {
		DateTime_SetMinute($this->_cPtr,$min);
	}

	public function SetHour($h) {
		DateTime_SetHour($this->_cPtr,$h);
	}

	public function SetDay($d) {
		DateTime_SetDay($this->_cPtr,$d);
	}

	public function SetMonth($m) {
		DateTime_SetMonth($this->_cPtr,$m);
	}

	public function SetYear($y) {
		DateTime_SetYear($this->_cPtr,$y);
	}

	public function Set($y,$n,$d,$h,$m,$s) {
		DateTime_Set($this->_cPtr,$y,$n,$d,$h,$m,$s);
	}

	public function SetTimeOffset($h,$m=0,$s=0) {
		DateTime_SetTimeOffset($this->_cPtr,$h,$m,$s);
	}

	public function SetDateOffset($d,$m=0,$y=0) {
		DateTime_SetDateOffset($this->_cPtr,$d,$m,$y);
	}
}

class User {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_User') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_User();
	}
}

class Sheet {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_Sheet') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_Sheet();
	}
}

class Feed {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_Feed') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_Feed();
	}
}

abstract class ISheetController {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}
	function __construct($h) {
		$this->_cPtr=$h;
	}

	public function GetSheetById($id) {
		$r=ISheetController_GetSheetById($this->_cPtr,$id);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new Sheet($r);
			}
			return new $c($r);
		}
		return $r;
	}

	public function UpdateSheet($sheet) {
		ISheetController_UpdateSheet($this->_cPtr,$sheet);
	}

	public function AddSheet($sheet) {
		ISheetController_AddSheet($this->_cPtr,$sheet);
	}
}

abstract class IUserController {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}
	function __construct($h) {
		$this->_cPtr=$h;
	}

	public function GetUserById($id) {
		$r=IUserController_GetUserById($this->_cPtr,$id);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new User($r);
			}
			return new $c($r);
		}
		return $r;
	}

	public function GetUserByUsername($username) {
		$r=IUserController_GetUserByUsername($this->_cPtr,$username);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new User($r);
			}
			return new $c($r);
		}
		return $r;
	}

	public function UpdateUser($user) {
		IUserController_UpdateUser($this->_cPtr,$user);
	}

	public function AddUser($user) {
		IUserController_AddUser($this->_cPtr,$user);
	}
}

abstract class IFeedController {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}
	function __construct($h) {
		$this->_cPtr=$h;
	}

	public function GetFeedById($id) {
		$r=IFeedController_GetFeedById($this->_cPtr,$id);
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new Feed($r);
			}
			return new $c($r);
		}
		return $r;
	}

	public function UpdateFeed($feed) {
		IFeedController_UpdateFeed($this->_cPtr,$feed);
	}

	public function AddFeed($feed) {
		IFeedController_AddFeed($this->_cPtr,$feed);
	}
}

class DBFactory {
	public $_cPtr=null;
	protected $_pData=array();

	function __set($var,$value) {
		if ($var === 'thisown') return swig_libnfdb_alter_newobject($this->_cPtr,$value);
		$this->_pData[$var] = $value;
	}

	function __isset($var) {
		if ($var === 'thisown') return true;
		return array_key_exists($var, $this->_pData);
	}

	function __get($var) {
		if ($var === 'thisown') return swig_libnfdb_get_newobject($this->_cPtr);
		return $this->_pData[$var];
	}

	static function GetFeedController() {
		$r=DBFactory_GetFeedController();
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new IFeedController($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function GetSheetController() {
		$r=DBFactory_GetSheetController();
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new ISheetController($r);
			}
			return new $c($r);
		}
		return $r;
	}

	static function GetUserController() {
		$r=DBFactory_GetUserController();
		if (is_resource($r)) {
			$c=substr(get_resource_type($r), (strpos(get_resource_type($r), '__') ? strpos(get_resource_type($r), '__') + 2 : 3));
			if (!class_exists($c)) {
				return new IUserController($r);
			}
			return new $c($r);
		}
		return $r;
	}

	public function __construct($res=null) {
		if (is_resource($res) && get_resource_type($res) === '_p_DBFactory') {
			$this->_cPtr=$res;
			return;
		}
		$this->_cPtr=new_DBFactory();
	}
}


?>