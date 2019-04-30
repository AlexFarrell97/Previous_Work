<?php
	//define variables and set to empty values
	$forename = $surname = $dob = $email = null;
	$errors = array();
	$datas = array();
	
	//check inputs from form and changeto html entities to protect against SQL injection
	function escape ($string) {
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}
	
	//get the form data
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$forename = escape($_POST["forename"]);
		$surname = escape($_POST["surname"]);
		$dob = escape($_POST["dob"]);
		$email = escape($_POST["email"]);
	
		//validate the form data
			
		//validate forename
		if (ctype_alpha(str_replace(' ', '', $forename)) === false) {
			$errors['forename'] = "Forename: Your first name must contain letters and spaces only.";
		}
		
		//validate surname
		if (ctype_alpha(str_replace(' ', '', $surname)) === false) {
			$errors['surname'] = "Surname: Your last name must contain letters and spaces only.";
		}
		
		//validate dob
		$date2 = date("d-m-Y");
		
		$date1 = new DateTime($dob);
		$date2 = new DateTime($date2);
		
		$interval = $date1->diff($date2);
		
		$age = $interval->y;
		
		if ($age < 18) {
			$errors['dob'] = "Date of Birth: You must be 18 to sign up to the mailing list.";
		}
		
		//validate email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) {
			$errors['email'] = "Email: You have not provided a valid email address.";
		}
	}
	
	if(!empty($errors)) {
		$datas['success'] = false;
		$datas['message'] = $errors;
	} else {
		$datas['success'] = true;
		$datas['message'] = '';
	}
	
	echo json_encode($datas);

?>