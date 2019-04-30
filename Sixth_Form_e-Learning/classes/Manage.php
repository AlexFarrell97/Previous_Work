<?php

Class Manage {

	//get all users from 'tbl_user'
	public function getusers() {
	
		$user = DB::getInstance()->get('tbl_user', array ('u_id', '>', '0'));
		
		if(!$user->count()) {
			$users[0][0] = 'No users were found';
		} else {
			$i = 0;
			
			foreach($user->results() as $user) {
				$users[$i] = array(
					$user->u_id,
					$user->forename . " " . $user->surname
				);
				$i++;
			}
		}
		
		return $users;
	
	}
	
	//change a users password by passing in the user id and the new password
	public function changepass($u_id, $pass) {
	
		$salt = Hash::salt(32); //setting a 32 bit salt
	
		try {
		
			DB::getInstance()->update('tbl_user', 'u_id', $u_id, $fields = array(
				'password' =>Hash::make($pass, $salt),
				'salt' => $salt
			));
								
		} catch(Exception $e) {
			die($e->getMessage());
			echo 'The password could not be changed'; //if the process cannot be completed, this error messae will show
		}
	
	}
	
	//delete a user by passing in the user id
	public function delete($u_id) {
	
		DB::getInstance()->delete('tbl_user', array('u_id', '=', $u_id));
	
	}
	
	//change the account type of a user by passing in the user id and the new account type
	public function account($u_id, $account) {
	
		try {
		
			DB::getInstance()->update('tbl_user', 'u_id', $u_id, $fields = array(
				'account_type' => $account
			));
		
		} catch(Exception $e) {
			die($e->getMessage());
		}
	
	}

}