<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

//if data has been input, perform validation
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		//set the validation rules for each of the fields
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6
			),
			'password_new' => array(
				'required' => true,
				'min' => 6
			),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
			)
		));
		
		if($validation->passed()) {
			
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Your current password is wrong.';
			} else {
				$salt = Hash::salt(32);
				$user->update(array(
					'password' => Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
				));
				
				Session::flash('home', 'Your password has been changed!');
				Redirect::to('index.php');
				
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
	<title>RevBase - Change Password</title>
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/changepass.css">
</header>

<body>
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
	<div id="changepass">
		<form action="" method="post">
			<div id = "current_lbl"><label for="password_current">Current Password: </label></div>
			<div id = "current_txt"><input type="password" name="password_current" id="password_current"></div>
			
			<div id = "new_lbl"><label for="password_new">New Password: </label></div>
			<div id = "new_txt"><input type="password" name="password_new" id="password_new"></div>
			
			<div id = "new2_lbl"><label for="password_new_again">New Password Again: </label></div>
			<div id = "new2_txt"><input type="password" name="password_new_again" id="password_new_again"></div>
			
			<div id = "submit"><input type="submit" value="Change"></div>
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		</form>
	</div>
                            