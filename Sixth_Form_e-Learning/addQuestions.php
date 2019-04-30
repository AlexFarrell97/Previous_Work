<?php

//include a file but checks if it has already been included
require_once 'core/init.php';

//initiate the class 'User()'
$user = new User();

//check if the user is logged in
if(!$user->isLoggedIn() || $user->data()->account_type !== '2') {
	Redirect::to("index.php");
} else {

	$test = new Test();
	
	//check if the submit button was pressed on the previous form
	if(isset($_POST['addques'])) {
	
		$t_id = Input::get('t_id');
	
		for($i = 0; $i < 10; $i++) {
		
			$q[$i] = Input::get('q' . $i);
			$a[$i] = Input::get('a' . $i);
			$b[$i] = Input::get('b' . $i);
			$c[$i] = Input::get('c' . $i);
			
			//check if variables are empty
			if(empty($q[$i]) || empty($a[$i]) || empty($b[$i]) || empty($c[$i])) {
			
			} else {
			
			DB::getInstance()->insert('tbl_question', array(
				't_id' => $t_id,
				'question' => $q[$i],
				'correct_ans' => $a[$i],
				'wrong_ans1' => $b[$i],
				'wrong_ans2' => $c[$i]
			));
		
			}
			
		}
		
		Redirect::to('index.php');
	
	}

}