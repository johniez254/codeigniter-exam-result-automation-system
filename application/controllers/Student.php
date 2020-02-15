<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('student_model','stud');
		
		$this->check_session();//check session
	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url(), 'refresh');
		}
	}
	
	//load index
	public function index()
	{
		$this->dashboard();//call dashboard function
	}
	
	//load dashboard page
	public function dashboard(){
        $page_data['page_name']  = 'dashboard';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'dashboard';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
	//load results page
	public function results(){
        $page_data['page_name']  = 'results';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'results       ';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
		
	//load units page
	public function units(){
        $page_data['page_name']  = 'units';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'units';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
	//load lecturers page
	public function lecturers(){
        $page_data['page_name']  = 'lecturers';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'lecturers';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
	//load profile page
	public function profile(){
        $page_data['page_name']  = 'profile';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'profile';//page title;
        $this->load->view('index', $page_data);//load index
	}
	
	
	//result crud function for students
	public function result_crud($p1="",$p2=""){
		//select semester
		if($p1=="get_semester"){
			$where="semester_id=".$p2."";
			$this->db->select('*');
			$this->db->from('semesters');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '<option value="">No semester available under this academic year!</option>';
			}else{
				echo '<option value=""></option>';
				$chose_year = $this->db->get_where('semesters' , array('semester_id' => $p2))->result_array();
				foreach ($chose_year as $row) {
					$chosen_year=$row['semester_year'];
				}
				$sem = $this->db->get_where('semesters' , array('semester_year' => $chosen_year))->result_array();
				foreach ($sem as $row) {
				echo '<option value="' .$row['semester_id'] . '">Year: '.substr($row['semester_name'],0,1).' Semester: '.substr($row['semester_name'],2).' ('.$row['semester_name'].')</option>';
				}
			}
		}//get_semester end
		
		//get results function
		if($p1=="get_result"){
			$login_id=$this->session->userdata('id');
			$student_id=$this->db->get_where('students' , array('login_id'=>$login_id))->row()->student_id;
			
			$where=array('semester_id'=>$p2,'student_id'=>$student_id);
			$this->db->select('*');
			$this->db->from('results');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '
				<tr>
					<td colspan="3">
						<div class="alert alert-default alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Info:</strong> No results available under this semester you selected!</div>
							 
					</td>
				</tr>';
				echo'<script>
							document.getElementById("pdf_button").style.display="none";
					</script>
					';
			}else{
				$where=array('semester_id'=>$p2,'student_id'=>$student_id);
				$this->db->select('*');
				$this->db->from('results');
				$this->db->where($where);
				$this->db->join('units', 'units.unit_id = results.unit_id');
                $desc	=	$this->db->get()->result_array();
                	foreach($desc as $row):
						$unit_code=$row['unit_code'];
						$unit_name=$row['unit_name'];
						$grade=$row['grade'];
						
						echo '
						<tr>
							<td>'.$unit_code.'</td>
							<td>'.$unit_name.'</td>';
							if($grade=="E"){
							echo'<td>'.$grade.' *';'</td>';
							}else{
								echo'<td>'.$grade;'</td>';
							}
						echo'</tr>';
					
					endforeach;
					
					//count all those in attendance but did not reach the target attendance percentage
					$where=array('semester_id'=>$p2,'student_id'=>$student_id,'a_percentage <'=>"75");
					$this->db->select('*');
					$this->db->from('attendances');
					$this->db->where($where);
					$count_a_attendance=$this->db->count_all_results();
					
					if($count_a_attendance!="0"){
						$where=array('semester_id'=>$p2,'student_id'=>$student_id,'a_percentage <'=>"75");
						$this->db->select('*');
						$this->db->from('attendances');
						$this->db->where($where);
						$this->db->join('units', 'units.unit_id = attendances.unit_id');
						$desc	=	$this->db->get()->result_array();
							foreach($desc as $row):
								$a_unit_code=$row['unit_code'];
								$a_unit_name=$row['unit_name'];
								echo'
								<tr>
									<td>'.$a_unit_code.'</td>
									<td>'.$a_unit_name.'</td>
									<td>**</td>
								</tr>
								';
						endforeach;
					}

					
					$where=array('semester_id'=>$p2,'student_id'=>$student_id);
					$this->db->select_sum('total_marks');
					$this->db->from('results');
					$this->db->where($where);
					$desc=$this->db->get()->result_array();
					$total=0;
						foreach($desc as $row):
							$total+=$row['total_marks'];
						endforeach;
						
					//count 
					$where=array('semester_id'=>$p2,'student_id'=>$student_id);
					$this->db->select('*');
					$this->db->from('results');
					$this->db->where($where);
					$count_result	=	$this->db->count_all_results();
					
					//get average
					$total_average=$total/$count_result;
					
					//round the average to nearest whole number
					$round_total_average=round($total_average);
					
					//get average grade
					$where="".$round_total_average." BETWEEN start_mark AND end_mark";
                    $this->db->select('grade');
					$this->db->from('grades');
					$this->db->where($where);
						$desc	=	$this->db->get()->result_array();
							foreach($desc as $row):
								$ave_grade= $row['grade'];
							endforeach;
					
					//output data
						echo'<tr>
							<td colspan="2" class="text-right">
								<strong>Average Grade: </strong>
							</td>
							<td>
								<strong> '.$ave_grade.' </strong>
							</td>
						</tr>
						';
					
						echo'<tr>
							<td colspan="2" class="text-right">
								<strong>Class: </strong>
							</td>
							<td><strong>
							';
							if($ave_grade=="A"){
							echo'First Class</strong></td>';
							}
							if($ave_grade=="B"){
								echo'<strong>Second Upper</strong></td>';
							}
							if($ave_grade=="C"){
								echo'<strong>Second Lower</strong></td>';
							}
							if($ave_grade=="D"){
								echo'<strong>Pass</strong></td>';
							}
							if($ave_grade=="E"){
								echo'<strong>Fail *';
							}
						echo'</strong></td>
						</tr>
						';
						echo'<script>
							document.getElementById("pdf_button").style.display="block";
						</script>
						';
			}//end else
		}//end get result
	}
	
	//export result in pdf format
	public function pdf(){
			$login_id=$this->session->userdata('id');
	$name       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->name;
			$student_id=$this->db->get_where('students' , array('login_id'=>$login_id))->row()->student_id;
			$semester_id=$this->input->post('s2example-1');
			
			//set header
			 $setting_id=$this->db->get_where('settings', array('system_id' => 1)); 
				foreach($setting_id->result() as $row):
												$id=$row->system_id;
												$sname=$row->system_name;
												$abbr=$row->system_abbr;
												$address=$row->system_address;
												$em=$row->system_email;
												$phone=$row->system_phone;
												$institution=$row->institution;



                                 		endforeach;
			
										$s='school';
										$l='logo';
			
			$html_content = '<p align="center"><img src="'.$this->stud->get_image_url($s,$l).'" width="15%" height="15%"/></p>
							<h4 align="center">'.$institution.'</h4>
							 <h5 align="center">'.$sname.'</h5>
							 <h5 align="center">PROVISIONAL TRANSCRIPT</h5>
							 <h5 align="center">UNDERGRADUATE</h5>
							 <hr style="border:1px solid #000;" />';
			$html_content .= $this->stud->generate_result($student_id,$semester_id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			//$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			//$canvas->page_text(250,750,"Header: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("".$name.".pdf", array("Attachment"=>0));
	}
	
	
		//validate profile form
	public function validate_profile(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			),
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			),
			array(
				'field' => 'role',
				'label' => 'Role',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->stud->profile_post($userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Profile Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//validate passwords
	public function validate_password(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'oldpass',
				'label' => 'Old Password',
				'rules' => 'required|callback_validate_pass'
			),
			array(
				'field' => 'newpass',
				'label' => 'New Password',
				'rules' => 'required'
			),
			array(
				'field' => 'confpass',
				'label' => 'Confirm Password',
				'rules' => 'required|matches[newpass]'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->stud->password_post($userId);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Password Updated Successfully!";
			}	
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting the data!";
			} 
		}
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
	}
	
	//compare db password with user inputted password and return either true/false
	public function validate_pass()
	{
		$validate = $this->stud->password_validate($this->input->post('oldpass'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_pass', 'This Old Password is incorrect!');
			return false;			
		} // /else
	} // /validate password function
	
	function edit_image($p1=""){
		$data['image_id']=$this->db->get_where('login', array('login_id' => $p1));
		$this->load->view('backend/student/modal_edit_image.php',$data);
	}
	
	//student update/upload profile piicture
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Picture Updated Successfully!');
			redirect ('student/profile','refresh');
	}
	

	
	//destroy session
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
//end of student class bracket
}