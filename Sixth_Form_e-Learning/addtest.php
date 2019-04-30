<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {

	$test = new Test();

}

?>

<header>
	<title> Revbase - Add a Test </title>
	
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/addtest.css">
</header>

<div id="main">

	<div id="banner-top">
		<a href="index.php">
			<div id="home" title="-- Home --">
			</div>
		</a>
		<div id="time">
			<iframe src="http://free.timeanddate.com/clock/i4fb5ikm/n301/tluk/fn6/fce0e0e0/tct/pct/ftbi/tt0/tw1/tm1/th1/tb4" frameborder="0" width="126" height="36" allowTransparency="true"></iframe>
		</div>
		<a href="logout.php">
			<div id="logout" title="-- Log Out --">
			</div>
		</a>
	</div>
	<div id = "hyperlinks">
		<a href = 'settasks.php'>
		<div id = "settest">
			Set Test
		</div>
		</a>
		<a href = 'addtest.php'>
		<div id = "testmanager">
			Test Manager
		</div>
		</a>
		<a href = 'manageclasses.php'>
		<div id = "classes">
			Manage Classes
		</div>
		</a>
		<a href = 'progress.php'>
		<div id = "progress">
			Monitor Student Progress
		</div>
		</a>
	</div>
	
	<div id = 'form'>
		<form name = 'test' method = 'post' action  = 'addquestions.php'>
		
			<div id = 'test_name_lbl'>Name of test:</div>
			<div id = 'test_name_in'><input type = 'text' name = 'test_name' required></div>
			<div id = 'test_description_lbl'>Description of test:</div>
			<div id = 'test_description_in'><textarea name = 'test_description' cols = '40' rows = '5' style = "resize: none;" required></textarea></div>
			<div id = 'study_lbl'>Study Level:</div>
			<div id = 'study_in'>
			<select name = 'study_level'>
				<option value = '' hidden>--- Choose study level ---</option>
				<option value = 'GCSE'>GCSE</option>
				<option value = 'BTEC'>BTEC</option>
				<option value = 'ALevel'>A Level</option>
			</select>
			</div>
			<div id = 'submit'><input type = 'submit' name = 'addtest' value = 'Add Test'></div>
		
		</form>
	</div>
	
</div>