<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '1') {
	Redirect::to("index.php");
}

//check if there has been input in the form
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		//perform validation
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'email' => array(
				'required' => true,
				'min' => 2,
				'max' => 50,
				'unique' => 'tbl_user'
			)
		));
		
		if($validation->passed()) {
			$user = new User();
			
			$salt = Hash::salt(32);
			
			try {
				//create the user
				$user->create(array(
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'joined' => date('Y-m-d H:i:s'),
					'account_type' => Input::get('accounttype'),
					'profile_pic' => 'profile/default.png'
				));
			} catch(Exception $e) {
				die($e->getMessage());
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
	<title>RevBase - Register a Teacher</title>
			
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/register.css">
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
			</a>
		</div>
	
	<div id="register">
		<form action="" method="post">
			<div id="regtitle">
				<center>Register a Teacher:<center>
			</div>
			<div id="email">
				<input type="email" name="email" id="textbox" placeholder="-- Email --" autocomplete="off">
				<input type="hidden" name="password" id="password" value="password">
				<input type="hidden" name="accounttype" id="account_type" value="2">
			</div>
			<div id="send">
			<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
			<input type="submit" id="button-register" value="Register">
			</div>
		</form>
	</div>
</div>
</body>
</html>