<?php

class AddClass {
	
	//get the name of all the classes assigned to that teacher by passing in '$teacher'
	public function getclasses($teacher) {
	
		$class = DB::getInstance()->get('tbl_class', array('teacher', '=', $teacher));
		if(!$class->count()) {
			$classes[0] = 'No classes found'; //string assigned to first record in the '$classes' array to ensure a string is output rather than individual characters
		} else {
			$i = 0;
			
			foreach($class->results() as $class) {
				$classes[$i] = $class->class_name; //class name assigned to new record in the '$classes' array
				$i = $i + 1;
			}
		}
		
		return $classes;
	
	}
	
	//get the study level of a class by passing in '$class_name'
	public function getstudylevel($class_name) {
	
		$study_level = DB::getInstance()->get('tbl_class', array('class_name', '=', $class_name));
		if(!$study_level->count()) {
			$studylevel = 'No class under that name was found';
		} else {
			foreach($study_level->results() as $study_level) {
				$studylevel = $study_level->study_level;
			}
		}
		
		return $studylevel;
	
	}
	
	//get all students who match the study level which is assigned by passing in '$study_level'
	public function getstudents($study_level) {
	
		$student = DB::getInstance()->get('tbl_user', array('study_level', '=', $study_level));
		if(!$student->count()) {
			$students[0] = 'No students found';
		} else {
		
			$i = 0;
		
			foreach($student->results() as $student) {
			
				$students[$i][0] = $student->u_id;
				$students[$i][1] = $student->forename . " " . $student->surname;
				
				$i = $i + 1;
			
			}
		
		}
		
		return $students;
	
	}
	
	//get the 'u_id' of a student by passing in '$name'
	public function getstudentid($name) {
		$student = explode(" ", $name); //split the string into words by using " " as the delimiter //Necessary due to 'forename' and 'surname' being stored seperately in table
		$studentid = DB::getInstance()->get('tbl_user', array('forename', '=', $student[0]), array('surname', '=', $student[1]));
		if(!$studentid->count()) {
			$student_id = 'No student was found with that name';
		} else {
			foreach($studentid->results() as $studentid) {
				$student_id = $studentid->u_id;
			}
		}
		
		return $student_id;
	
	}
	
	//get the id of a class by passing in '$class_name'
	public function getclassid($class_name) {
	
		$classid = DB::getInstance()->get('tbl_class', array('class_name', '=', $class_name));
		if(!$classid->count()) {
			$cl_id = 'No class was found with that name';
		} else {
			foreach($classid->results() as $classid) {
				$cl_id = $classid->cl_id;
			}
		}
		
		return $cl_id;
	
	}
	
	//add students to the record corresponding to '$id' of the class
	public function addstudents($class_name, $fields = array(), $idname = 'cl_id') {
		
		$id = $this->getclassid($class_name);
		
		if(!DB::getInstance()->update('tbl_class', $idname, $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

}