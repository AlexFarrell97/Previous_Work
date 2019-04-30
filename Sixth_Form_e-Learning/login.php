<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

$user = new User();

if($user->isLoggedIn()) {
	Redirect::to("index.php");
}

//check if there has been input in the form
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		//perform the validation
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'email' => array('required' => true),
			'password' => array('required' => true)
		));
		
		if($validation->passed()) {
			$user = new User();
			
			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('email'), Input::get('password'), $remember);
			
			if($login) {
				Redirect::to('home.php');
			} else {
				print "<script type=\"text/javascript\">"; 
				print "alert('Sorry, login failed. Please try again.')"; 
				print "</script>"; 
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
	<title>
		RevBase - Login & Register
	</title>
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/login.css">
</header>
<body>
	<div id="main">
		<div id="banner-top">
			<div id="home" title="home">
			</div>
		<div id="time">
			<iframe src="http://free.timeanddate.com/clock/i4fb5ikm/n301/tluk/fn6/fce0e0e0/tct/pct/ftbi/tt0/tw1/tm1/th1/tb4" frameborder="0" width="126" height="36" allowTransparency="true"></iframe>
		</div>
		</div>
		
		<div id="logo">
		</div>
		
		<div id="login">
			<div id="title">
				Log in to your account:
			</div>
		<form action="" method="post">
			<div id="email">
				<input id="textbox" name= "email" autofocus = "autofocus" type="text" placeholder=" -- Email -- " required>
			</div>
			<div id="password">
				<input id="textbox" name="password" type="password" placeholder=" -- Password -- " required>
			</div>
			<div id="buttons">
				<div id="remember">
					<input type="checkbox" name="remember">Remember me
				</div>
				<div id="submit">
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input type="submit" id="button-login" value="Log in">
				</div>
			</div>
		</form>
		</div>
	</div>
</body>
</html>