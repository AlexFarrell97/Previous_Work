<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {

	$manage = new Manage();
	
	if(isset($_POST['changepass'])) {
	
		$u_id = $_POST['u_id'];
		$pass = $_POST['pass'];
		
		$manage->changepass($u_id, $pass);
	
	}
	
	if(isset($_POST['account'])) {
	
		$u_id = $_POST['u_id'];
		$account = $_POST['account_type'];
		
		$manage->account($u_id, $account);
	
	}
	
	echo "<script>setTimeout(\"location.href = 'index.php';\");</script>";
	
}