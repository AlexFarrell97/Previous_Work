<?php

Class Progress {

	//get the name of all the classes assigned to that teacher by passing in '$teacher'
	public function getclasses($teacher) {
	
		$class = DB::getInstance()->get('tbl_class', array('teacher', '=', $teacher));
		
		if(!$class->count()) {
			$classes[0] = 'No classes found';
		} else {
			$i = 0;
			
			foreach($class->results() as $class) {
				$classes[$i] = array(
					$class->cl_id,
					$class->class_name
				);
				$i = $i + 1;
			}
		}
		
		return $classes;
	
	}
	
	//get the students that are stored in the record corresponding to the class id
	public function getstudents($class) {
	
		$student = DB::getInstance()->get('tbl_class', array('cl_id', '=', $class));
		
		if(!$student->count()) {
			$students = 'No students found';
		} else {
			foreach($student->results() as $student) {
				$students = $student->students;
			}
		}
		
		return $students;
	
	}
	
	//get the test scores of a student by passin in their user id
	public function gettestscores($student) {
	
		$score = DB::getInstance()->get('tbl_test_scores', array('u_id', '=', $student));
		
		if(!$score->count()) {
			$scores[0][0] = 'No scores found';
		} else {
			$i = 0;
			
			foreach($score->results() as $score) {
				$scores[$i] = array(
					$score->t_id,
					$score->score,
					$score->date_taken
				);
				
				$i++;
				
			}
		}
		
		return $scores;
	
	}
	
	//get the name of a student by passing in their user id
	public function getstudentname($student) {
	
		$names = DB::getInstance()->get('tbl_user', array('u_id', '=', $student));
		
		if(!$names->count()) {
			$name = 'No student found';
		} else {
			foreach($names->results() as $names) {
				$name = $names->forename . " " . $names->surname;
			}
		}
		
		return $name;
	
	}
	
	//get the name of a test by passing in the test id
	public function gettestname($t_id) {
	
		$test = DB::getInstance()->get('tbl_test', array('t_id', '=', $t_id));
		
		if(!$test->count()) {
			$testname = 'No test found';
		} else {
			foreach($test->results() as $test) {
				$testname = $test->test_name;
			}
		}
		
		return $testname;
	
	}

}