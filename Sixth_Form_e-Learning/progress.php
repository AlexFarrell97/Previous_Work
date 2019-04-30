<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {

	$id = $user->data()->u_id;
	
	$progress = new Progress();
	
	$classes = $progress->getclasses($id);
	$maxclasses = count($classes);
	
	
}

?>

<html>
<header>
	<title> Revbase - Student Progress </title>
	
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/progress.css">
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
		<form name = 'class' method = 'post' action = ''>
		
			<div id = 'class_lbl'>Choose a class:</div>
			<div id = 'class_in'>
			<select name = 'classes'>
				<option value = ''>--- Select class ---</option>
				<?php
				
				$i = 0;
				while($i < $maxclasses) {
					echo "<option value = " . $classes[$i][0] . ">" . $classes[$i][1] . "</option>";
					$i++;
				}
				
				?>
			</select>
			</div>
			<div id = 'submit'><input type = 'submit' name = 'class' value = 'Load Class'></div>
		
		</form>
	</div>

<?php

if(isset($_POST['class'])) {

	$class = $_POST['classes'];
	$students = explode(',', $progress->getstudents($class));
	$max = count($students);
	
	?>
	<div id = 'students'>
	
	<?php
	
	for($i = 0; $i < $max; $i++) {
	
		$scores[$i] = $progress->gettestscores($students[$i]);
		$maxscores = count($scores[$i]);
		$name[$i] = $progress->getstudentname($students[$i]);
		echo $name[$i];
		
		?>
		
		<table>
			<col width = '200px'>
			<col width = '50px'>
			<col width = '200px'>
			<tr>
				<th>Test</th><th>Score</th><th>Date Taken</th>
			</tr>
			<?php
			for($j = 0; $j < $maxscores; $j++) {
			
				$testname = $progress->gettestname($scores[$i][$j][0]);
			
				?><tr><td><?php echo $testname; ?></td><td><?php echo $scores[$i][$j][1]; ?></td><td><?php echo $scores[$i][$j][2]; ?></td></tr><?php
			
			}
			
		?></table><?php
		
		echo "<br>";
		
	}
	
	?></div><?php
	
}

