<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '3') {
	Redirect::to("index.php");
} else {
	
	$data = $user->data();
	$u_id = $data->u_id;
	
	$SetTest = new SetTest();
	$settests = $SetTest->getsettest();
	$maxsettests = count($settests);
	
	$i = 0;
	//initiate a new stack
	$stack = new SplStack();
	
	while ($i < $maxsettests) {
	
		$st_id = $settests[$i][0];
		$last = $SetTest->getdatetaken($u_id, $settests[$i][3]);
		if($last == 'No test was found') {
			$last = '0000-00-00';
		}
		$set = $settests[$i][5];
		$last = $last[0];
		$set = (string)$set;
		$last = (string)$last;
		$set = strtotime($set);
		$last = strtotime($last);
		$class = $settests[$i][1];
		$students = $SetTest->getstudents($class);
		
		//split the string into an array, split by ',' as the delimiter
		$students = explode(",", $students);
		
		//check if the user id is in the students array
		if(in_array($u_id, $students)) {
			if($last<$set) {
				//add value to the stack
				$stack->push($st_id);
			}
		}
		
		$i++;
	}
	
	//reverse the order of the stack
	$stack->rewind();
	$i = 0;
	
	//while the position is still within the range of the stack
	while($stack->valid()) {
		//current position open in stack
		$test[$i] = $stack->current();
		$tdata[$i] = $SetTest->gettestdata($test[$i]);
		//get next value in the stack
		$stack->next();
		$i++;
	}
	
	$resrows = count($tdata);
	
}

?>

	<html>
		<header>
		<title>RevBase - My Tasks</title>
				
		<link rel="stylesheet" type="text/css" href="style/temp.css">
		<link rel="stylesheet" type="text/css" href="style/tasks.css">
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
	<form method = 'post' action = 'loadtest.php'>
		<table>
			<tr>
				<th>Test Name</th>
				<th>Test Description</th>
				<th>Date Due</th>
				<th>Take Test</th>
			</tr>
			<?php 
				$i = 0;
				while($i < $resrows) {
					?>
					<tr>
						<td><?php echo $tdata[$i][1]; ?></td>
						<td><?php echo $tdata[$i][2]; ?></td>
						<td><?php echo $tdata[$i][3]; ?></td>
						<td>
							<input type = 'radio' name = 'name' value = '<?php echo $tdata[$i][0]; ?>'>
						</td>
					</tr>
					<?php
					$i = $i + 1;
				}
			?>
		</table>
		<br>
		<input type = 'submit' name = 'submit' value = 'Take Test'>
	</form>
	</div>