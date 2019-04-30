<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn()) {
	Redirect::to('login.php');
}else{
	Redirect::to('home.php');
}