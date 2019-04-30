<?php

class Test {
	
	//add test data to 'tbl_test'
	public function addtest($testname, $testdescr, $study) {
	
		$addtest = DB::getInstance()->insert('tbl_test', array(
			'test_name' => $testname,
			'test_description' => $testdescr,
			'study_level' => $study
		));
		
		$test = DB::getInstance()->get('tbl_test', array('t_id', '>', '0'));
		
		foreach($test->results() as $test) {
			$t_id = $test->t_id;
		}
		
		return $t_id;
	
	}
	
	//get the name of a test from 'tbl_test'
	public function gettestselect($val) {
		
		$tselect = DB::getInstance()->get('tbl_test', array('study_level', '=', $val));
		$max = $tselect->count();
		
		if($max > 0) {
		
			$i = 0;
			
			foreach($tselect->results() as $tselect) {
			
				$tname[$i] = $tselect->test_name;
				
				$i = $i + 1;
			
			}
		
		}
		
		return $tname;
	
	}
	
	//search for a test by the specified test name
	public function testsearch($testname) {
		
		if(empty($testname)) {
			$search = DB::getInstance()->get('tbl_test', array('study_level', '=', 'GCSE'));
		} else {
			$search = DB::getInstance()->get('tbl_test', array('test_name', '=', $testname));
		}
		
		if(!$search->count()) {
		
			//$result[0] = "0 tests found";
		
		} else {
		
			$i = 0;
		
			foreach($search->results() as $search) {
			
				$result[$i] = array(
					$search->t_id,
					$search->test_name,
					$search->test_description
				);
				
				$i = $i + 1;
			
			}
		
		}
		
		return $result;
	
	}
	
	//get the id of a current test for that user
	public function gettestid() {
	
		$user = new User();
		$data = $user->data();
		$u_id = $data->u_id;
		
		$ct = DB::getInstance()->get('tbl_current_test', array('u_id', '=', $u_id));
		
		if(!$ct->count()) {
		
			Redirect::to("home.php");
		
		} else {
		
			foreach($ct->results() as $ct) {
			
				$t_id = $ct->t_id;
			
			}
			
			return $t_id;
		
		}
	
	}
	
	//get all test data for the specified test id
	public function gettest($t_id) {
	
		$tdata = DB::getInstance()->get('tbl_test', array('t_id', '=', $t_id));
	
		if(!$tdata->count()) {
		
			$test = "0";
			
		} else {
			
			foreach($tdata->results() as $tdata) {
			
			$test = array(
				$tdata->t_id,
				$tdata->test_name,
				$tdata->test_description,
				$tdata->study_level
			);
		
			}

		}
		
		return $test;
	
	}
	
	//get all questions relating to the specified test id
	public function getquestions($t_id) {
		
		$tques = DB::getInstance()->get('tbl_question', array('t_id', '=', $t_id));
		
		if(!$tques->count()) {
		
			$ques = "0";
			
		} else {
			
			$i = 0;
			
			foreach($tques->results() as $tques) {
			
				$ques[$i] = array(
					$tques->q_id,
					$tques->question,
					$tques->correct_ans,
					$tques->wrong_ans1,
					$tques->wrong_ans2
				);
				
				$i = $i + 1;
			
			}
			
			shuffle($ques);
		
		}
		
		return $ques;
	
	}
	
}