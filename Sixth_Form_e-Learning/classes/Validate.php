<?php
class Validate {

	//declaring variables
	private $_passed = false,
	$_errors = array(),
	$_db = null;
	
	//call the 'getInstance()' function from the DB class
	public function __construct() {
		$this->_db = DB::getInstance();
	}
	
	//validate the inputs of a form to check that they meet the rules set by the database
	public function check($source, $items = array()) {
		foreach($items as $item => $rules) {
			foreach($rules as $rule => $rule_value) {
				
				$value = trim($source[$item]);
				$item = escape($item);
				
				if($rule === 'required' && empty($value)) {
					$this->addError("{$item} is required");
				} else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError("{$item} must be a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError("{$item} must be a maximum of {$rule_value} characters.");
							}
						break;
						case 'matches':
							if($value != $source[$rule_value]) {
								$this->addError("{$rule_value} must match {$item}.");
							}
						break;
					}
				}
				
			}
		}
		
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		
		return $this;
	}
	
	//generate an error message
	private function addError($error) {
		$this->_errors[] = $error;
	}
	
	//return the errors to the destination page
	public function errors() {
	 return $this->_errors;
	}
	
	//return whether the validation has passed or not
	public function passed() {
		return $this->_passed;
	}
}                                
                            
                            
                            