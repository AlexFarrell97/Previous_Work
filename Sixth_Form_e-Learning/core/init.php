<?php

/* starts the session */
session_start();

/* Creates an array. */
$GLOBALS['config'] = array(

	/* Array generated for the details needed to establish database connection. */
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'farrella_revbase'
	),
	
	/* Array generated for the details needed for a coookie to be generated. */
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
	),
	
	/* Array generated for the details regarding the session. */
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);

/* Creates a queue of autoload functions, and runs through each of them in the order they are defined. */
spl_autoload_register(function($class) {
	require_once 'classes/' . $class . '.php';
});

/* Checks if the 'sanitize.php' file has been included and if not, will include it. */
require_once 'functions/sanitize.php';

/* If a cookie exists based on the variables 'cookie_name' and 'session_name'... */
if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	
	/* ... A hash is generated with the value of 'cookie_name' */
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	
	/* $hashCheck is assigned the value of $hash in the 'tbl_user_session' table. */
	$hashCheck = DB::getInstance()->get('tbl_user_session', array('hash', '=', $hash));
	
	/* If $hashCheck has values... */
	if($hashCheck->count()) {
	
		/* $user equals the 'u_id' of the first record in the $hashCheck array. */
		$user = new User($hashCheck->first()->u_id);
		
		/* Initiates the 'login()' function */
		$user->login();
	}
}