<?php
class Hash {

	//generates a hash message using the hashing algorithm stated (e.g. 'sha256')
	public static function make($string, $salt = '') {
		return hash('sha256', $string . $salt);
	}
	
	//create an initialisation vector in order to encrypt passwords
	public static function salt($length) {
	 return mcrypt_create_iv($length);
	}
	
	//generate a unique id
	public static function unique() {
	 return self::make(uniqid());
	}
}                                
                            