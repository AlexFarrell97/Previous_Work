<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {
	$data = $user->data();
	$teacher = $data->u_id;
	$set = new SetTest();
	$classes = $set->getclasses($teacher);
	$maxclasses = count($classes);
	$tests = $set->gettests();
	$maxtests = count($tests);
}

?>

<html>
<header>
	<title> Revbase - Set Test </title>
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/settasks.css">
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
		<form name = "settest" method = "post" action = "">
		
			<div id = 'class_lbl'>Choose the class the test is for:</div>
			<div id = 'class_in'>
			<select name = "class">
				<?php
					$i = 0;
					echo "<option value = ''>--- Choose a class ---</option>";
					while ($i < $maxclasses) {
						?><option value = "<?php echo $classes[$i][0]; ?>"><?php echo $classes[$i][1]; ?></option><?php
						$i = $i + 1;
					}
				?>
			</select>
			</div>
			<input type = "hidden" name = "teacher" value = "<?php echo $teacher; ?>">
			<div id = 'test_lbl'>Choose the test:</div>
			<div id = 'test_in'>
			<select name = "test">
				<?php
					$i = 0;
					echo "<option value = ''>--- Choose a test ---</option>";
					while ($i < $maxtests) {
					?>
					<option value = "<?php echo $tests[$i][0]; ?>"><table><tr><td><?php echo $tests[$i][1] . " (" . $tests[$i][2] . ")"; ?></td></tr></table></option>
					<?php
					$i = $i  + 1;
					}
				?>
			</select>
			</div>
			<div id = 'date_lbl'>Choose the due date:</div>
			<div id = 'date_in'><input type = "date" name = "due"></div>
			<div id = 'submit'><input type = "submit" name = "settest" value = "Set Test"></div>
		
		</form>
	</div>
		
</div>

<?php

if(isset($_POST['settest'])) {

	$setdata = array(
		$_POST['class'],
		$_POST['teacher'],
		$_POST['test'],
		$_POST['due']
	);
	
	$isset = $set->settask($setdata);
	
	if($isset) {
		//output a message box
		print '<script type="text/javascript">'; 
		print 'alert("The test has been set. You will now be redirected.")'; 
		print '</script>';
		echo "<script>setTimeout(\"location.href = 'index.php';\");</script>";
	}

}










