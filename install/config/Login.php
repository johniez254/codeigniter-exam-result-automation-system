<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	//Index Page for this login controller.
	 
	public function __construct(){
		//set errors to false
		error_reporting(0);
		//load default constructors
		parent:: __construct();
		$this->load->model('Login_model','lm');
	}
	
	public function index()
	{
		//set errors to false
		error_reporting(0);
		
		$this->load->dbutil();
		 	
			if ($this->dbutil->database_exists('%DATABASE%'))//modify this line to manually add your database name
				{
					$this->load->view('login');
				}
			else{
					redirect(base_url() . 'install/index.php?o=require', 'refresh');
			}
	}
	
	public function login()
	{
		$this->index();
	}
	
	//validate login
	public function validate(){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|callback_validate_username',
				
				'errors' => array(
					'required' => 'The Username/Reg. Number field is required!',
					)
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required',
				'errors' => array(
					'required' => 'The %s field is required!',
					)
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="help-block">','</p>');

		if($this->form_validation->run() === true) {			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$login = $this->lm->login($username, $password);

			if($login) {
				$user_data = array(
					'id' => $login,
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				
				//determine role
				$role=$this->db->get_where('login' , array('login_id'=>$login))->row()->role; 
				
				//if admin				
				if($role=='admin'){
					$validator['success'] = true;
					$validator['messages'] = "admin/dashboard";
				}
				// if user is lecturer
				else if($role=='lecturer'){
					$validator['success'] = true;
					$validator['messages'] = "lecturer/dashboard";
				}
				// if user is student
				else if($role=='student'){
					$validator['success'] = true;
					$validator['messages'] = "student/dashboard";
				}
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "<i class='ti-info-alt'></i> Your Password is Incorrect!";
			} // /else

		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	} // /validate function

	public function validate_username()
	{
		$validate = $this->lm->validate_username($this->input->post('username'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_username', 'This user does not exist!');
			return false;			
		} // /else
	} // /validate username function
	

	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
	
	
	// bracket for class controller
}
