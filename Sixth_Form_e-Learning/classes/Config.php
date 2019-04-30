<?php
class Config {
	public static function get($path = null) {
		if($path) {
		
			/* The variable $config is set to 'config' from the $GLOBALS array. */
			$config = $GLOBALS['config'];
			
			/* explode returns the variable $path formed by spliting it on the boundaries formed by the delimeter '/' */
			$path = explode('/', $path);
			
			foreach($path as $bit) {
			
				/* If $config[$bit] is set... */
				if(isset($config[$bit])) {
				
					/* ... $config is set to $config[$bit]. */
					$config = $config[$bit];
				}
			}
			
			/* Returns the variable $config. */
			return $config;
		}
		
		/* Returns false if the if statement paraemter is false */
		return false;
	}
}                                
                            