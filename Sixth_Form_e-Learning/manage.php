<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '1') {
	Redirect::to("index.php");
} else {

	$manage = new Manage();
	
	?>
	
	<html>
		<header>
		<title>RevBase - Profile Manager</title>
				
		<link rel="stylesheet" type="text/css" href="style/temp.css">
		<link rel="stylesheet" type="text/css" href="style/manage.css">
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
				<a href = 'prmanage.php'>
				<div id = "prmanage">
					Profile Manager
				</div>
				</a>
				<a href = 'teregister.php'>
				<div id = "teregister">
					Register a Teacher
				</div>
				</a>
			</div>
			
	<?php
	
	if(isset($_POST['changepass'])) {
	
		$u_id = $_POST['user'];
	
		?>
			
			<div id = 'form'>
			<form name = 'changepass' method = 'post' action = 'manage2.php'>
			
				<div id = 'pass_lbl'>New password:</div>
				<div id = 'pass_in'><input type = 'password' name = 'pass'></div>
				<input type = 'hidden' name = 'u_id' value = '<?php echo $u_id; ?>'>
				<div id = 'pass_sub'><input type = 'submit' name = 'changepass' value = 'Change Password'></div>
			
			</form>
			</div>
		
		<?php
	
	} else if(isset($_POST['delete'])) {
	
		$u_id = $_POST['user'];
	
		$bool = $manage->delete($u_id);
	
	} else if(isset($_POST['account'])) {
	
		$u_id = $_POST['user'];
	
	?>
			<div id = 'form'>
			<form name = 'account' method = 'post' action = 'manage2.php'>
			
				<div id = 'acc_lbl'>Select the new account permission for the user:</div>
				<div id = 'acc_in'>
				<select name = 'account_type'>
					<option value = ''>--- Select account ---</option>
					<option value = '1'>Administrator</option>
					<option value = '2'>Teacher</option>
					<option value = '3'>Student</option>
				</select>
				</div>
				<input type = 'hidden' name = 'u_id' value = '<?php echo $u_id; ?>'>
				<div id = 'acc_sub'><input type = 'submit' name = 'account' value = 'Change Account'></div>
			
			</form>
			</div>
		
		<?php
	
	} else {
		echo "<script>setTimeout(\"location.href = 'prmanage.php';\");</script>";
	}
	
}