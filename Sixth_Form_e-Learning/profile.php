<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn()) {
	Redirect::to("index.php");
} else {
	$data = $user->data();
	$form = array (
		$data->forename,
		$data->surname,
		$data->DOB,
		$data->study_level
	);
}

//if there has been input in the form
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		//perform the validation
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'forename' => array(
				'required' => true
			),
			'surname' => array(
				'required' => true
			),
			'DOB' => array(
				'required' => true
			)
		));
		
		if($validation->passed()) {
			
			try {
				//update user details
				$user->update(array(
					'forename' => Input::get('forename'),
					'surname' => Input::get('surname'),
					'DOB' => Input::get('DOB'),
					'study_level' => Input::get('study_level')
				));
				
				print '<script type="text/javascript">'; 
				print 'alert("Your details have been updated. You will now be redirected back to the home page.")'; 
				print '</script>';
				echo "<script>setTimeout(\"location.href = 'index.php';\");</script>";
								
			} catch(Exception $e) {
				die($e->getMessage());
				echo 'hello';
			}
			
		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
		
	}
}

?>
<html>
	<header>
	<title>RevBase - Profile Manager</title>
			
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/profile.css">
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
		<div id = 'form'>
			<form action="" method="post">
				<div class="field">
					<div id = 'forename_lbl'><label for="forename">Forename: </label></div>
					<div id = 'forename_in'><input type="text" name="forename" value="<?php echo $form[0]; ?>"></div>
					<div id = 'surname_lbl'><label for="surname">Surname: </label></div>
					<div id = 'surname_in'><input type="text" name="surname" value="<?php echo $form[1]; ?>"></div>
					<div id = 'DOB_lbl'><label for="DOB">Date of Birth: </label></div>
					<div id = 'DOB_in'><input type="date" name="DOB" value="<?php echo $form[2]; ?>"></div>
					<?php
					if($data->account_type == '3') {
					?>
					<div id = 'study_lbl'><label for="study_level">Study Level: </label></div>
					<div id = 'study_in'><select name="study_level" value="<?php echo $form[3]; ?>">
						<option value = 'GCSE'>GCSE</option>
						<option value = 'BTEC'>BTEC</option>
						<option value = 'ALevel'>ALevel</option>
					</select></div>
					<?php
					}
					?>
					<div id = 'submit'><input type="submit" value="Update Details"></div>
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				</div>
			</form>
		</div>