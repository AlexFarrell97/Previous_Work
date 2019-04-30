<?php
class Cookie {

	/* Checks if a cookie exists or not. */
	public static function exists($name) {
		return (isset($_COOKIE[$name])) ? true : false;
	}
	
	/* Gets the name of the cookie. */
	public static function get($name) {
		return $_COOKIE[$name];
	}
	
	/* Sets the cookie so that when the user goes on the website again, their details are remembered. */
	public static function put($name, $value, $expiry) {
		if(setcookie($name, $value, time() + $expiry, '/')) {
			return true;
		}
		return false;
	}
	
	/* Deletes a cookie when the user signs out */
	public static function delete($name) {
		self::put($name, '', time() - 1);
	}
}                                
                            
                            