<?php
class Session {
	
	
	//check if a session exists and returns true or false
	public static function exists($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}
	
	//create a session and return the name of the session
	public static function put($name, $value) {
		return $_SESSION[$name] = $value;
	}
	
	//get the name of a session
	public static function get($name) {
		return $_SESSION[$name];
	}
	
	//delete a session
	public static function delete($name) {
		if(self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}
	
	
	//flash up the name of the session
	public static function flash($name, $string = '') {
		if(self::exists($name)) {
			$session = self::get($name);
			self::delete($name);
			return $session;
		} else {
			self::put($name, $string);
		}
	}
}