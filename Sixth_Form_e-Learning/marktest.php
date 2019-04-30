<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();
$data = $user->data();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '3') {
	Redirect::to("index.php");
} else {
	
	//check if the submit button was pressed on the previous form
	if(isset($_POST['submit'])) {
	
		$i = 0;
		$score = 0;
	
		while ($i < 10) {
			
			$ques[$i][0] = Input::get("question" . $i);
			$ques[$i][1] = Input::get("ans" . $i);
			$ques[$i][2] = Input::get("correct" . $i);
			
			if($ques[$i][1] == $ques[$i][2]) {
				$score = $score + 1;
			} else {
				$score = $score + 0;
			}
			
			$i = $i + 1;
		}
		
		$t_id = Input::get("t_id");
		
		$final_score = DB::getInstance()->insert('tbl_test_scores', array(
			'u_id' => $data->u_id,
			't_id' => $t_id,
			'score' => $score,
			'date_taken' => date('Y-m-d')
		));
		
		$delete = DB::getInstance()->delete('tbl_current_test', array('u_id', '=', $data->u_id));
	
	} else {
	
		Redirect::to("home.php");
	
	}

}

?>

<html>

<header>
	<title>RevBase - Results</title>
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/marktest.css">
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
	<div id = 'select'>
		<br><a href = 'index.php'><button style = 'width: 120px; background: #663399;'>Ok</button></a>
	</div>
	<div id = 'form'>
		<?php
		
			for($i = 0; $i < 10; $i++) {
				?>
				
				<div id = 'question'>
					<div id = 'ques'>
						<?php echo $ques[$i][0]; ?>
					</div>
					<div id = 'ans'>
						Your answer: <?php echo $ques[$i][1]; ?>
					</div>
					<div id = 'cor'>
						Correct answer: <?php echo $ques[$i][2]; ?>
					</div>
				</div>
				<br>
				
				<?php
			}
			
		?>
	</div>

</html>