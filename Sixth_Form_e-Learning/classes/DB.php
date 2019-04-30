<?php
class DB {
	//Declarin variables
	private static $_instance = null;
	private $_pdo,
		$_query,
		$_error = false,
		$_results,
		$_count = 0;
	
	//aquire a connection to the database using PDO (PHP Data Objects)
	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}
	
	//returns 'new DB()' and means that only one instance of that class can be created on one line of code
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	
	//creates the framework of the sql query
	public function query($sql, $params = array()) {
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			
			if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
		}
		
		return $this;
	}
	
	//writes the sql query in SQL so that it doesnt have to be written out every time in the code
	public function action($action, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=');
			
			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];
			
			if(in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
			
		}
		return false;
	}
	
	//allow the program to get values from the database
	public function get($table, $where) {
		return $this->action('SELECT *', $table, $where);
	}
	
	//allow the program to delete records from the database
	public function delete($table, $where) {
		return $this->action('DELETE', $table, $where);
	}
	
	//all of the program to insert records into the database
	public function insert($table, $fields = array()) {
		$keys = array_keys($fields);
		$values = '';
		$x = 1;
		
		foreach($fields as $field) {
			$values .= '?';
			if($x < count($fields)) {
				$values .= ', ';
			}
			$x++;
		}
		
		$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
			
		if(!$this->query($sql, $fields)->error()) {
			return true;
		}
		
		return false;
	}
	
	//allows the program to update records in the database
	public function update($table, $idname, $id, $fields) {
		$set = '';
		$x = 1;
		
		foreach($fields as $name => $value) {
			$set .= "{$name} = ?";
			if($x < count($fields)) {
				$set .= ', ';
			}
			$x++;
		}
		
		$sql = "UPDATE {$table} SET {$set} WHERE $idname = {$id}";
		
		if(!$this->query($sql, $fields)->error()) {
			return true;
		}
		
		return false;
	}
	
	//generate the results of an sql query
	public function results() {
		return $this->_results;
	}
	
	//get the first result of an sql query
	public function first() {
		return $this->results()[0];
	}
	
	//generate an error message
	public function error() {
		return $this->_error;
	}
	
	//count how many records were found from an sql query
	public function count() {
		return $this->_count;
	}
	
}
                            