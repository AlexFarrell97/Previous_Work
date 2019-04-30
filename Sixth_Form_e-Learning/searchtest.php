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
		
?>
			
	<html>
		<header>
			<title> Revbase - Search Test </title>
			
			<link rel="stylesheet" type="text/css" href="style/temp.css">
			<link rel="stylesheet" type="text/css" href="style/searchtest.css">
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
	
	<?
	ob_start();

	$tdata = new Test();
	$test = $tdata->gettestselect('GCSE');
	$testrows = count($test);
	
	echo "<div id = 'form'>";
	
	echo "<form name = 'searchtest' method = 'post' action = ''>";
	
		echo "<div id = 'test_name_lbl'>Test name:</div>";
		?>
		<div id = 'test_name_in'>
		<select name = 'test_name'>
		
			<option value = ''>--- Select test ---</option>
			
			<?php
			
			$i = 0;
			while($i < $testrows) {
				
				?>
				<option value = '<?php echo $test[$i]; ?>'> <?php echo $test[$i]; ?> </option>
				<?php
				
				$i = $i + 1;
			
			}
		echo "</select></div>";
		
		echo "<div id = 'submit'><input type = 'submit' name = 'search' value = 'Search'></div>";
	
	echo "</form></div>";
	
	if(isset($_POST['search'])) {
	
		$testname = $_POST['test_name'];
		
		$result = $tdata->testsearch($testname);
		$resrows = count($result);
		$i = 0;
		
		ob_end_clean();
		
		if (empty($result)) {
		
		echo "<div id = 'no'>No tests were found that matched the description</div>";
		
		} else {
		
		?>
		<div id = 'form2'>
			<form method = 'post' action = 'loadtest.php'>
			<table>
			  <tr>
			    <th>Test Name</th>
			    <th>Test Description</th>
			    <th>Take Test</th>
			  </tr>
			  <?php 
			  while($i < $resrows) {
			  ?>
			  <tr>
			    <td><?php echo $result[$i][1]; ?></td>
			    <td><?php echo $result[$i][2]; ?></td>
			    <td>
			        <input type = 'radio' name = 'name' value = '<?php echo $result[$i][0]; ?>'>
			    </td>
			  </tr>
			  <?php
			  $i = $i + 1;
			  }
			  ?>
			</table>
			<br><br>
			<div id = 'button1'><input type = 'submit' name = 'submit' value = 'Take Test'></div>
			<br>
			</form>
		</div>
		<a href="searchtest.php">
		<div id = 'button2'>
			Search Again
		</div>
		</a>
		<?php
		
		}
		
	}

}

?>