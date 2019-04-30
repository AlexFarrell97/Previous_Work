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
		$data->profile_pic
	);
}

?>
<html>
	<header>
	<title>RevBase - Profile Picture</title>
			
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/image.css">
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
			<form action="image.php" method="post" enctype="multipart/form-data">
				<div class="field">
					<div id = 'profile_lbl'><label for="fileToUpload">Change profile picture: </label></div>
					<div id = 'profile_in'><input type = "file" name = "fileToUpload" id = "fileToUpload" value = "<?php echo $form[0]; ?>" required></div>
					<div id = 'submit'><input type="submit" value="Change profile picture" name = "submit"></div>
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				</div>
			</form>
		</div>