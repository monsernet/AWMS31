<?php
	class Users_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
 
		public function login($email, $password){
			$logged = FALSE;
			$username = '';
			$name = '';
			$userId = '';
			$query = $this->db->get_where('users', array('email'=>$email));
			if($row  = $query->row()) {
				if (password_verify($password, $row->password))
				{
					$logged = TRUE;
					$username = $row->username;
					$name = $row->fullName;
					$userId = $row->id;
				}
			}
			$userData = array (
				'username' => $username,
				'name' => $name,
				'userId' => $userId,
				'logged' => $logged
			);
			return $userData;
		}
		
		
		
 
	}
?>