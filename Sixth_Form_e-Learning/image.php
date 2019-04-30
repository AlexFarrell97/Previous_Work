<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();
$data = $user->data();
$id = $data->u_id;
$pic = $data->profile_pic;

//check if the profile picture is default or unique
if ($pic == 'profile/default.png') {
	$user->profilepic($id);
} else {
	//delete the current file
	if (!unlink($pic)) {
		print '<script type="text/javascript">'; 
		print 'alert("There was an error deleting the file.")'; 
		print '</script>';
	} else {
		//change the profile picture
		$user->profilepic($id);
	}
}

?>