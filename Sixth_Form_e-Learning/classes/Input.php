<?php
class Input {

	//check if an input exists or not
	public static function exists($type = 'post') {
		switch($type) {
			case 'post' :
				return(!empty($_POST)) ? true : false;
			break;
			case 'get' :
				return(!empty($_GET)) ? true : false;
			break;
			default:
				return false;
			break;
		}
	}
	
	//gets the value of an object from a form
	public static function get($item) {
		if(isset($_POST[$item])) {
			return $_POST[$item];
		} else if(isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}
}                                
                            
                            
                            
                            