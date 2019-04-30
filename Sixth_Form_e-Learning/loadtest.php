<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '3') {
	Redirect::to("index.php");
} else {
	
	$user = new User();
	$data = $user->data();
	$u_id = $data->u_id;
	$name = $data->forename . " " . $data->surname;
	
	//check if the submit button was pressed on the previous form
	if(isset($_POST['submit'])) {
	
		$t_id = $_POST['name'];
		
		$test = DB::getInstance()->insert('tbl_current_test', array(
			'u_id' => $u_id,
			't_id' => $t_id
		));
		
		Redirect::to("test.php");
	
	} else {
	
		Redirect::to("index.php");
	
	}

}