<?php
class User {

	//declare variables
	private $_db,
		$_data,
		$_sessionName,
		$_cookieName,
		$_isLoggedIn;
	
	//check if a user is logged in
	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');
		
		if(!$user) {
			if(Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);
				
				if($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					// process Logout
				}
				
			}
		} else {
			$this->find($user);
		}
		
	}
	
	//update user details
	public function update($fields = array(), $idname = 'u_id', $id = null) {
	
		if(!$id && $this->isLoggedIn()) {
			$id = $this->data()->u_id;
		}
	
		if(!$this->_db->update('tbl_user', $idname, $id, $fields)) {
			print_r($fields);
			print_r($id);
			throw new Exception('There was a problem updating.');
		}
	}
	
	//create a user
	public function create($fields = array()) {
		if(!$this->_db->insert('tbl_user', $fields)) {
			throw new Exception('There was a problem creating an account');
		}else{
		print "<script type=\"text/javascript\">"; 
		print "alert('Account created.')"; 
		print "</script>";
		}
	}
	
	//find a user
	public function find($user = null) {
		if($user) {
			$field = (is_numeric($user)) ? 'u_id' : 'email';
			$data = $this->_db->get('tbl_user', array($field, '=', $user));
			
			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	
	//log a user in if their details are correct
	public function login($email = null, $password = null, $remember = false) {
		
		if(!$email && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->u_id);
		} else {
			$user = $this->find($email);
			
			if($user) {
				if($this->data()->password === Hash::make($password, $this->data()->salt)) {
					Session::put($this->_sessionName, $this->data()->u_id);
					
					if($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('tbl_user_session', array('u_id', '=', $this->data()->u_id));
						
						if(!$hashCheck->count()) {
							$this->_db->insert('tbl_user_session', array(
								'u_id' => $this->data()->u_id,
								'hash' => $hash
							));
						} else {
							$hash = $hashCheck->first()->hash;
						}
						
						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
						
					}
					
					return true;
				}
			}
		}
		
		return false;
	}
	
	//check the account type of a user
	/*public function hasPermission($key) {
		$type = $this->_db->get('tbl_user', array('account_type', '=', $this->data()->type));
		
		return false;
	}*/
	
	//return true or false if data is occupied or not
	public function exists() {
		return (!empty($this->_data)) ? true : false;
	}
	
	//log a user out and delete the session
	public function logout() {
	
		$this->_db->delete('tbl_user_session', array('u_id', '=', $this->data()->u_id));
	
		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}
	
	//return the user data
	public function data() {
		return $this->_data;
	}
	
	//return true or false if a suer is logged in or not
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
	
	//enable the suer to update their proile pic
	//picture stored in file directory
	//filepath is stored in 'tbl_user', 'profile_pic' field
	public function profilepic($id) {

		$target_dir = "profile/";
		$target_file = $target_dir . $id . ". " . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        print '<script type="text/javascript">'; 
			print 'alert("File is not an image.")'; 
			print '</script>';
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			print '<script type="text/javascript">'; 
			print 'alert("Sorry file already exists")'; 
			print '</script>';
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			print '<script type="text/javascript">'; 
			print 'alert("Sorry file is too large.")'; 
			print '</script>';
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			print '<script type="text/javascript">'; 
			print 'alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")'; 
			print '</script>';
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			print '<script type="text/javascript">'; 
			print 'alert("Sorry, your file was not uploaded")'; 
			print '</script>';
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			if(Input::exists()) {
				if(Token::check(Input::get('token'))) {
					$validate = new Validate();
					$validation = $validate->check($_POST, array(
						'profile_pic' => array(
						)
					));
					
					if($validation->passed()) {
						
						try {
							$this->update(array(
								'profile_pic' => $target_file
							));
							
							print '<script type="text/javascript">'; 
							print 'alert("Your details have been updated. You will now be redirected back to the home page.")'; 
							print '</script>';
							echo "<script>setTimeout(\"location.href = 'index.php';\");</script>";
											
						} catch(Exception $e) {
							die($e->getMessage());
						}
						
					} else {
						foreach($validation->errors() as $error) {
							echo $error, '<br>';
						}
					}
					
				}
			}
		    } else {
			print '<script type="text/javascript">'; 
			print 'alert("Sorry, there was an error uploading your file.")'; 
			print '</script>';
		    }
		}
		
	}
	
}
                            