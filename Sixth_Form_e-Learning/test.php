<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '3') {
	Redirect::to("index.php");
} else {
	
	$tdata = new Test();
	$t_id = $tdata->gettestid();
	$test = $tdata->gettest($t_id);
	$ques = $tdata->getquestions($t_id);
	
	?>
	<html>
		<header>
		<title>RevBase - <?php echo $test[1]; ?></title>
				
		<link rel="stylesheet" type="text/css" href="style/temp.css">
		<link rel="stylesheet" type="text/css" href="style/test.css">
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
	<?php
	
	echo '<form name = "test" method = "post" action = "marktest.php">';
	?>
	<input type = 'hidden' name = 't_id' value = '<?php echo $t_id; ?>'>
	<?php
	
	$i = 0;
	
	while ($i < 10) {
	
		$q = $ques[$i][1];
		$ans = array(
			$ques[$i][2],
			$ques[$i][3],
			$ques[$i][4]
		);
		//shuffle the order of the answers
		shuffle($ans);
		echo "<div id = 'question'>";
			echo "<div id = 'q'>";
			echo $i + 1 . ". " . $q;
			echo "<input type = 'hidden' name = 'question" . $i . "' value = '" . $q . "'>";
			echo "</div>";
			?>
			<div id = 'a'><input type = 'hidden' name = '<?php echo "correct" . $i; ?>' value = '<?php echo $ques[$i][2]; ?>'>
			<input type = 'radio' name = '<?php echo "ans" . $i; ?>' value = '<?php echo $ans[0]; ?>'>
			<?php
			echo $ans[0];
			?></div>
			<div id = 'b'><input type = 'radio' name = '<?php echo "ans" . $i; ?>' value = '<?php echo $ans[1]; ?>'>
			<?php
			echo $ans[1];
			?></div>
			<div id = 'c'><input type = 'radio' name = '<?php echo "ans" . $i; ?>' value = '<?php echo $ans[2]; ?>'>
			<?php
			echo $ans[2];
			echo "</div>";
		echo "</div><br>";
		
		$i++;
		$j++;
		
	}
	
	echo '<div id = "submit">---------- End of Test ----------<br><input type = "submit" name = "submit" value = "Mark Test"></div>';
	echo '</form><br></div>';
}