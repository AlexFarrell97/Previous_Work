<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn()) {
	Redirect::to("login.php");
} else {
	$data = $user->data();
	$u_id = $data->u_id;
	$type = $data->account_type;
	//output different html depending on the account type of the user
	switch($type) {
		case "3":
			if(empty($data->forename) || empty($data->surname) || empty($data->DOB) || empty($data->study_level)) {
				print "<script type=\"text/javascript\">"; 
				print "alert('Your profile details are not yet complete. You will be redirected to the profile manager.')"; 
				print "</script>";
				print "<script>setTimeout(\"location.href = 'profile.php';\");</script>";
			}
		break;
		default:
			if(empty($data->forename) || empty($data->surname) || empty($data->DOB)) {
				print "<script type=\"text/javascript\">"; 
				print "alert('Your profile details are not yet complete. You will be redirected to the profile manager.')"; 
				print "</script>";
				print "<script>setTimeout(\"location.href = 'profile.php';\");</script>";
			}
		break;
	}
}
?>

<html>

<header>

	<title>RevBase - Home</title>
	
	<link rel="stylesheet" type="text/css" href="style/temp.css">
	<link rel="stylesheet" type="text/css" href="style/home.css">
	<link rel="stylesheet" type="text/css" href="style/adhome.css">
	<link rel="stylesheet" type="text/css" href="style/tehome.css">
	<link rel="stylesheet" type="text/css" href="style/sthome.css">
	
</header>

<body>

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
	<?php
	$join  = str_split($data->joined);
	$i = 1;
	$joined = $join[0];
	while ($i < 10) {
		$joined = $joined . $join[$i];
		$i++;
	}
        ?>
        
        <div id="profile">
        	<div id="name">
        		<u>Name</u>:<br>
        		<?php echo $data->forename . " " . $data->surname; ?>
        	</div>
        	<div id="DOB">
        		<u>Date of Birth</u>:<br>
        		<?php echo $data->DOB; ?>
        	</div>
        	<div id="joined">
        		<u>Joined</u>:<br>
        		<?php echo $joined; ?>
        	</div>
        	<?php
        	switch ($type) {
        		case "3":
        		?>
	        	<div id="study">
	        		<u>Study Level</u>:<br>
	        		<?php echo $data->study_level; ?>
	        	</div>
        		<?php
        		break;
        	}
        	?>
		<div id="pic">
		<a href = "image1.php">
		<img src = "<?php echo $data->profile_pic;?>" height = "120px" width = "100px" title = "Change profile picture">
		</a>
		</div>
		<div id="changepass">
			<a href = "changepassword.php">
				<input type="button" id="button-changepass" value="Change Password">
			</a>
		</div>
		<div id="edit">
			<a href = "profile.php">
				<input type="button" id="button-edit" value="Edit Profile">
			</a>
		</div>
	</div>
	
<?php

switch ($type) {

	case "1":
    
    	?>
    	
    	<div id="links">
		&nbsp&nbsp&nbspChoose a section:
	</div>
	
	<a href = 'prmanage.php'>
		<div id="manager">
			<center>Profile Manager</center>
		</div>
	</a>
	
	<a href = 'teregister.php'>
	<div id="addteacher">
		<center>Add Teacher</center>
	</div>
	</a>
    	
    	<?php
        
	break;
        
	case "2":
    
    	?>
    	
    	<div id="links">
		&nbsp&nbsp&nbspChoose a section:
	</div>
	
	<a href="settasks.php">
	<div id="ttasks">
		<center>Set Tasks</center>
	</div>
	</a>
	<a href = 'addtest.php'>
	<div id="testmanage">
		<center>Test Manager</center>
	</div>
	</a>
	
	<a href = 'manageclasses.php'>
	<div id="classes">
		<center>Manage Classes</center>
	</div>
	</a>
	
	<a href = 'progress.php'>
	<div id="progress">
		<center>Monitor Student Progress</center>
	</div>
	</a>
    	
    	<?php
        
        break;
        
	case "3":
	
	$progress = new Progress();
	$testscores = $progress->gettestscores($u_id);
	$count = count($testscores);
	$count = $count - 1;
	$recentscore = $testscores[$count];
	$test = $recentscore[0];
	$test = $progress->gettestname($test);
	
	?>
	
	<div id="links">
		&nbsp&nbsp&nbspClick here to complete survey: <a href="https://www.surveymonkey.com/s/KQQGHF3" target="_blank" style="color: #00EE00;">User Testing Servey</a>
	</div>
	
	<div id="recenttest">
		<center><u><?php echo $test; ?></u><br><?php echo $recentscore[1]; ?></center>
	</div>
	
	<div id="school">
		<center><u>School logo</u></center>
	</div>
	
	<a href="searchtest.php">
	<div id="test">
		<center>Tests</center>
	</div>
	</a>
	
	<a href="tasks.php">
	<div id="tasks">
		<center>My Tasks</center>
	</div>
	</a>
	
	<a href = 'myprogress.php'>
	<div id="achieve">
		<center>My History</center>
	</div>
	</a>
	
	<?php
        
        break;
        
}

?>

</div>
<div id="overlay"></div>
</body>
</html>