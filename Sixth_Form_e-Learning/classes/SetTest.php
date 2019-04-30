<?php

Class SetTest {

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
	
	
	//get all the tests from the table as all id's are above '0'
	public function gettests() {
		
		$test = DB::getInstance()->get('tbl_test', array('t_id', '>', '0'));
		
		if(!$test->count()) {
			$tests[0] = 'No tests were found';
		} else {
			$i = 0;
			
			foreach($test->results() as $test) {
				$tests[$i] = array(
					$test->t_id,
					$test->test_name,
					$test->study_level
				);
				$i = $i + 1;
			}
		}
		
		return $tests;
		
	}
	
	//insert information about a set task into 'tbl_settest'
	public function settask($setdata) {
	
		$set = DB::getInstance()->insert('tbl_settest', array(
			'cl_id' => $setdata[0],
			'teacher' => $setdata[1],
			't_id' => $setdata[2],
			'date_set' => date("Y-m-d"),
			'due' => $setdata[3]
		));
		
		return true;
	
	}
	
	//get all settests in 'tbl_settest'
	public function getsettest() {
	
		$settest = DB::getInstance()->get('tbl_settest', array('st_id', '>', '0'));
		
		if(!$settest->count()) {
			$settests[0][0] = 'No classes were found';
		} else {
			$i = 0;
			
			foreach($settest->results() as $settest) {
				$settests[$i] = array(
					$settest->st_id,
					$settest->cl_id,
					$settest->teacher,
					$settest->t_id,
					$settest->due,
					$settest->date_set
				);
				$i = $i + 1;
			}
		}
		
		return $settests;
	
	}
	
	//find a class and the students in it by passing in the class id
	public function getstudents($cl_id) {
	
		$student = DB::getInstance()->get('tbl_class', array('cl_id', '=', $cl_id));
		
		if(!$student->count()) {
			$students = 'No classes were found with that id';
		} else {
			foreach($student->results() as $student) {
				$students = $student->students;
			}
		}
		
		return $students;
	
	}
	
	//get the id of a test by passing in the id of the set test
	public function gettestid($st_id) {
	
		$settest = DB::getInstance()->get('tbl_settest', array('st_id', '=', $st_id));
		
		if(!$settest->count()) {
			$t_id = 'No set test found';
		} else {
			foreach($settest->results() as $settest) {
				$t_id = $settest->t_id;
			}
		}
		
		return $t_id;
	
	}
	
	//get the due date of a test by passing in the set test id
	public function getdue($st_id) {
	
		$settest = DB::getInstance()->get('tbl_settest', array('st_id', '=', $st_id));
		
		if(!$settest->count()) {
			$due = 'No set test found';
		} else {
			foreach($settest->results() as $settest) {
				$due = $settest->due;
			}
		}
		
		return $due;
	
	}
	
	//get the data of a specific test by passing in the set test id
	public function gettestdata($st_id) {
	
		$t_id = $this->gettestid($st_id);
		$due = $this->getdue($st_id);
		
		$data = DB::getInstance()->get('tbl_test', array('t_id', '=', $t_id));
		
		if(!$data->count()) {
			$tdata[0] = 'No test was found';
		} else {
			$i = 0;
			foreach($data->results() as $data) {
				$tdata = array(
					$data->t_id,
					$data->test_name,
					$data->test_description,
					$due
				);
				$i++;
			}
		}
		
		return $tdata;
	
	}
	
	//get the last date that the test was taken by that user
	public function getdatetaken($u_id, $t_id) {
		
		$sql = DB::getInstance()->get('tbl_test_scores', array('u_id', '=', $u_id));
		
		if(!$sql->count()) {
			$datetaken = 'No test was found';
		} else {
			$i = 0;
			foreach($sql->results() as $sql) {
				if($sql->t_id == $t_id) {
					$datetaken = array(
									$sql->date_taken,
									$sql->t_id,
									$sql->u_id
									);
					$i++;
				} else {
					$i++;
				}
			}
			
		}
		
		return $datetaken;
		
	}

}