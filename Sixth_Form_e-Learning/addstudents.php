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
	$class = new AddClass();
	$classes = $class->getclasses($teacher);
	$max = count($classes);
}

?>

<html>
<header>
	<title> Revbase - Add Students </title>
	
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/addstudents.css">
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
	
	//any code below is an object
	ob_start();	
	<div id = 'form'>
	<?php
	echo "<div id = 'info'>Select the class you want to add students to:</div>";
	?>
	<form name = "choose_class" method = "post" action = "">
	<div id = 'class'>
	<select name = "class_name" required>
		<option value = "" hidden>--- Select a class ---</option>
		<?php
		
			$i = 0;
			
			while ($i < $max) {
				?>
				
					<option value = "<?php echo $classes[$i]; ?>"><?php echo $classes[$i]; ?></option>
				
				<?php
				$i = $i + 1;
			}
		
		?>
	</select>
	</div>
	
	<div id = 'submit'>
	<input type = "Submit" name = "class" value = "Choose Class">
	</div>
	
	</form>
	
	</div>
	
	<?php
	
	//check if the submit button is pressed on the form
	if(isset($_POST['class'])) {
		
		$class_name = $_POST['class_name'];
		$study_level = $class->getstudylevel($class_name);
		
		$students = $class->getstudents($study_level);
		$max = count($students);
		
		//clean the code from 'ob_start()' to this point
		ob_end_clean();
		
		ob_start();
		
		?>
			<div id = 'form2'>
			<form name = "addstudents" method = "post" action = "addStudents.php">
			
				<table>
					<tr>
						<th><u>Student</u></th>
						<th><u>Select</u></th>
					</tr>
					
					<?php
					
						$i = 0;
					
						while($i<$max){
							echo "<tr>";
								echo "<td>";
									echo $students[$i][1];
								echo "</td>";
								echo "<td>";
									?>
										<input type = "checkbox" name = "student[]" value = "<?php echo $students[$i][0]; ?>">
									<?php
								echo "</td>";
							echo "</tr>";
							$i = $i + 1;
						}
					
					?>
					
				</table>
				<br>
				<input type = "submit" name = "addstudents" value = "Add Students">
				<input type = "hidden" name = "classname" value = "<?php echo $class_name; ?>">
			
			</form>
			</div>
		
		<?php
	
	}










