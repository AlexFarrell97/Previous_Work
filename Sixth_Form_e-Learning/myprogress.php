<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '3') {
	Redirect::to("index.php");
} else {

	$id = $user->data()->u_id;
	
	$progress = new Progress();
	
	$scores = $progress->gettestscores($id);
	$maxscores = count($scores);
	
	?>
	
	<html>
		<header>
		<title>RevBase - My History</title>
				
		<link rel="stylesheet" type="text/css" href="style/temp.css">
		<link rel="stylesheet" type="text/css" href="style/myprogress.css">
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
				<a href = 'searchtest.php'>
				<div id = "tests">
					Tests
				</div>
				</a>
				<a href = 'tasks.php'>
				<div id = "mytasks">
					My Tasks
				</div>
				</a>
				<a href = 'myprogress.php'>
				<div id = "history">
					My History
				</div>
				</a>
			</div>
	<div id = 'form'>
	<table>
	
		<th>Test</th><th>Score</th><th>Date Taken</th>
		
		<?php
			for($j = 0; $j < $maxscores; $j++) {
			
				$testname = $progress->gettestname($scores[$j][0]);
			
			?><tr><td><?php echo $testname; ?></td><td><?php echo $scores[$j][1]; ?></td><td><?php echo $scores[$j][2]; ?></td></tr><?php
			
			}
			
		?>
	
	</table>
	</div>
	
	<?php
	
}