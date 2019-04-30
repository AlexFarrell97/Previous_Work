<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {
	$class = new AddClass();
}

//check if the submit button was pressed on the previous form
if(!isset($_POST['addclass'])) {
	Redirect::to("addclass.php");
} else {

	$class_name = $_POST['class_name'];
	$study_level = $_POST['study_level'];
	$teacher = $_POST['teacher'];
	
	$cdata = DB::getInstance()->insert('tbl_class', array(
		'class_name' => $class_name,
		'study_level' => $study_level,
		'teacher' => $teacher
	));
	
	Redirect::to('index.php');

}












