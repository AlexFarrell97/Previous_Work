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
	$users = $manage->getusers();
}

?>

<html>
	<header>
	<title>RevBase - Profile Manager</title>
			
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/prmanage.css">
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

		<div id = 'form'>
		<form name = 'search_user' method = 'post' action = ''>
		
			<div id = 'string_lbl'>Search name:</div>
			<div id = 'string_in'><input type = 'text' name = 'string'></div>
			<div id = 'submit'><input type = 'submit' name = 'search' value = 'Search'></div>
			
		</form>
		</div>
		
		<?php
		
		if(isset($_POST['search'])) {
		
			$string = $_POST['string'];
			if(empty($string)) {
				$string = " ";
			}
			
			//initiate a new stack
			$stack = new SplStack();
			
			for($i = 0; $i < count($users); $i++) {
			
				$pos = strpos($users[$i][1], $string);
				
				if($pos === false) {
					
				} else {
					//add a variable to the stack
					$stack->push($i);
				}
			
			}
			
			//reverse the order of the stack
			$stack->rewind();
			
			?>
			
			<div id = 'form2'>
			<form name = 'user' method = 'post' action = 'manage.php'>
			
			<table>
			
				<tr><th><u>Name of User</u></th><th><u>Action</u></th></tr>
				
				<?php
					
					//while the position is still within the limits of the stack
					while( $stack->valid() ) {
						?><tr><td><?php
						//current row open within the stack
						$i = $stack->current();
						echo $users[$i][1];
						?></td><td><input type = 'radio' name = 'user' value = '<?php echo $users[$i][0]; ?>'></td></tr><?php
						//get the next row of the stack
						$stack->next();
					}
				
				?>
			
			</table>
			
			<br>
			
			<input type = 'submit' name = 'changepass' value = 'Change Password'>&nbsp
			<input type = 'submit' name = 'delete' value = 'Delete User'>&nbsp
			<input type = 'submit' name = 'account' value = 'Change Account Type'>
			
			</form>
			</div>
			
			<?php

}