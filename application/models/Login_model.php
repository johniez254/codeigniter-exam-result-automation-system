<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	public function login($username = null, $password = null) 
	{
		if($username && $password) {
			
			$q=$this->db->get_where('login', array('username' => $username))->result_array();
				foreach($q as $row):
					$fetched_pass=$row['password'];
				endforeach;
			
			if(password_verify($password,$fetched_pass)){
				$sql = "SELECT * FROM login WHERE username = ?";
				$query = $this->db->query($sql, array($username));
				$result = $query->row_array();

			return ($query->num_rows() === 1 ? $result['login_id'] : false);
			}
			else {
				return false;
			}
		}
	}
	
	public function validate_username($username = null)
	{
		if($username) {			
			// die($username);
			$sql = "SELECT * FROM login WHERE username = ?";
			$query = $this->db->query($sql, array($username));
			$result = $query->row_array();
			
			return ($query->num_rows() === 1 ? true : false);			
		}	
		else {
			return false;
		}
	} // /validate username function
	
		
//end bracket for login model	
}