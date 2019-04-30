<?php
class Token {

	//generate a unique token
	public static function generate() {
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}
	
	//check if a token exists and if so, delete it
	public static function check($token) {
		$tokenName = Config::get('session/token_name');
		
		if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
		
		return false;
	}
}