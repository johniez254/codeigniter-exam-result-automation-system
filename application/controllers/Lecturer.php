<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturer extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Lecturer_model','lec');
		$this->load->model('Status_model','status');
		
		$this->check_session();//check session

	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE)
            redirect(base_url(), 'refresh');
	}

	//load index
	public function index()
	{
		$this->dashboard();//call dashboard function
	}
	
	//load dashboard page
	public function dashboard(){
		$page_data=array(
        'page_name'  => 'dashboard',//page name
		'crumb'  => '1',//number of breadcrumbs in header section
        'page_title' => 'dashboard',//page title
        'countResults'=>$this->status->countLecturerUploadedResults(),
        'countCourses'=>$this->status->countLecturerCourses(),
        'countUnits'=>$this->status->countLecturerUnits(),
        'schoolAttached'=>$this->status->get_school_name(),
        'resultsQuery'=>$this->status->resultsQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	
	
	//load courses page
	public function courses(){
		$page_data=array(
			'page_name'  => 'courses',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'courses',//page title
        	'countCourses'=>$this->status->countLecturerCourses(),
        	'schoolAttached'=>$this->status->get_school_name(),
        	'schoolAttachedId'=>$this->status->get_lecturer_school_id(),
        	'coursesQuery'=>$this->status->coursesQuery('','lec'),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load view students page
	public function view_students($p1=""){
		//encrypt and decrypt url
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p1))))))));
		$page_data=array(
			'course_id'=>$this->db->get_where('students', array('student_course'=>$encrypt)),
        	'page_name'  => 'view student',
			'crumb' => '2',
			'page_crumb'  => 'Courses',
			'function'  => 'courses',
        	'page_title' => 'View Student',
        );
        $this->load->view('index', $page_data,'refresh');
	}
	
	//load units page
	public function units(){
		$page_data=array(
        	'page_name'  => 'units',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
        	'page_title' => 'units',//page title;
        	'countUnits'=>$this->status->countLecturerUnits(),
        	'lecturerId'=>$this->status->get_lecturer_id(),
        	'unitsQuery'=>$this->status->unitsQuery('','','lec'),
    	);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load units page
	public function attendance(){
        $page_data['page_name']  = 'student attendances';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'student attendances';//page title;
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load results page
	public function results(){
        $page_data['page_name']  = 'results';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'results';//page title;
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
		
	//load reports page
	public function reports(){
        $page_data['page_name']  = 'reports';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'reports';//page title;
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load profile page
	public function profile(){
        $page_data['page_name']  = 'profile';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'profile';//page title;
        $this->load->view('index', $page_data,'refresh');//load index
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

			$posting = $this->lec->profile_post($userId);

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
	
	//function results crud
	function result_crud($p1="",$p2="",$p3="",$p4=""){
		//add result row
		if($p1=="add_row"){
			if($p2) {
			$studentData = $this->lec->result_crud('fetchStudentData');
			//$descData = $this->crud->fetchDescData();
			
			$row = '
			<tr id="row'.$p2.'">
                <td>
                	<input type="button" value="'.$p2.'" disabled="true" class="form-control" />                  
                </td>
                <td>
						<select name="name[]" class="form-control"   id="name'.$p2.'" >
						<option value="">Select Student</option>';
						 foreach ($studentData as $key => $value) { 
	                      $row .= '<option value="'.$value["student_id"].'">'.$value['student_name'].'</option>';
	                    } 
	                  	$row .= '</select>                
                </td>
				<td>
					<input type="number" name="cat[]" onkeyup="getCat('.$p2.')"  id="cat'.$p2.'" autocomplete="off" class="autoNumeric form-control"  placeholder="Cat Mark"  max="30" min="0" required="required"/>
				</td>
				<td>  
                    <input type="number" name="final[]" onkeyup="getFinal('.$p2.')"  id="final'.$p2.'" autocomplete="off" class="autoNumeric form-control" placeholder="Final Mark"  max="70" min="0" required="required"/>
                </td>
				<td>
                   <input type="text" name="total[]" onkeyup="getTotal('.$p2.')"  id="total'.$p2.'" autocomplete="off" class="form-control"  placeholder="(Cat + Final)"  readonly="readonly"/>
                </td>
                <td>
                  <input type="text" name="grade[]" onkeyup="getGrade('.$p2.')"  id="grade'.$p2.'" autocomplete="off" class="form-control" readonly="readonly" />
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger  removeResultRowBtn" type="button" id="removeResultRowBtn" onclick="removeResultRow('.$p2.')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
                                                        </td>
                                                       
              </tr>
			';
			echo $row;
			}
		}
		//get student id
		if($p1=="get_student"){
			//if You leave other inputs empty
			If(!empty($p3)&& !empty($p4)){
			
			$where=array('semester_id'=>$p2,'course_id'=>$p3,'unit_id'=>$p4);
			//$where="school_id=".$assigned_school."";
			$this->db->select('*');
			$this->db->from('attendances');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				//echo '<option value="">No Students available under this course!</option>';
				echo '
				<tr>
					<td colspan="7"></td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="alert alert-warning alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Info:</strong> There is no attendance record available under this unit! Please <strong><a href="'.base_url().'lecturer/attendance">Click Here</a></strong> to add attendance record for the students assigned this unit.</div>
							 
					</td>
				</tr>';
			}else{
				//$course = $this->db->get_where('attendances' , array('student_course' => $p2,'a_percentage'=>'>=75'))->result_array();
				
			
			$where=array('semester_id'=>$p2,'course_id'=>$p3,'unit_id'=>$p4,'a_percentage >='=>75);
			//$where="school_id=".$assigned_school."";
			$this->db->select('*');
			$this->db->from('attendances');
			$this->db->where($where);
			$count_spec=$this->db->count_all_results();
			
			if($count_spec!="0"){
				
                  
				  //$where=array("student_course"=>$p2);
				  //$where="a_percentage>=75 AND semester_id=".$p2." AND course_id=".$p3." AND unit_id=".$p4."";
				  $where=array('semester_id'=>$p2,'course_id'=>$p3,'unit_id'=>$p4,'a_percentage >='=>75);
                  $this->db->select('*');
                  $this->db->from('attendances');
                  //$this->db->order_by('date_registered','desc');
                  $this->db->where($where);
				  //$this->db->join('students', 'students.student_course = attendances.course_id');
                  $desc	=	$this->db->get()->result_array();
                    $i=1;
				$x=1; $cat=1;$total=1;$gt=1;$gf=1;$final=1;$grade=1;$delete=1;$tr=1;$sg=1;
				foreach ($desc as $row) {
				//$adm_no       =	$this->db->get_where('login' , array('name'=>$row['student_name']))->row()->username;
				$student_name       =	$this->db->get_where('students' , array('student_id'=>$row['student_id']))->row()->student_name;
				$login_id       =	$this->db->get_where('students' , array('student_id'=>$row['student_id']))->row()->login_id;
				$reg_no       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;		
					echo '
						<tr id="tr'.$tr++.'">
							<td>
								<input type="button" value="'.$x++.'" disabled="true" class="form-control" />                  
							</td>
							<td width="35%">
								<select name="name[]" class="form-control" required="required">
									<option value="' .$row['student_id'] . '">' .$student_name.' ('.$reg_no.')</option>
								</select>
							</td>
							 <td>
                                <input type="number" name="cat[]" onkeyup="getTotal('.$gt++.')"  id="cat'.$cat++.'" autocomplete="off" class="form-control"  placeholder="Cat Mark" required="required" min="0" max="30"/>
                            </td>
                            <td>  
                               <input type="number" name="final[]" onkeyup="getTotal('.$gf++.')"  id="final'.$final++.'" autocomplete="off" class="form-control" placeholder="Final Mark" required="required" min="0" max="70"/>
                            </td>
                            <td>
                               <input type="text" name="total[]"  id="total'.$total++.'" autocomplete="off" class="form-control"  placeholder="(Cat + Final)"  readonly="readonly"/>
                            </td>
                            <td width="5%">
                                <input type="text" name="grade[]"  id="grade'.$grade++.'" autocomplete="off" class="form-control" readonly="readonly" />
								 <input type="hidden" name="sgrade[]"  id="sgrade'.$sg++.'"/>
                             </td>
							 
                             <td>
                             <button class="btn btn-danger  removeResultRowBtn" type="button" id="removeResultRowBtn" onclick="removeResultRow('.$delete++.')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
                            </td>
						</tr>
					';
					
					}
			}//end count spec
			else{
				//echo '<option value="">No Students available under this course!</option>';
				echo '
				<tr>
					<td colspan="7"></td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="alert alert-warning alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Info:</strong> There are no student eligible to be awarded marks Since their record of attendance for this unit is below 75%!</div>
							 
					</td>
				</tr>';
			}
					
			}
			}else{
				
				//echo '<option value="">No Students available under this course!</option>';
				echo '
				<tr>
					<td colspan="7"></td>
				</tr>
				<tr>
					<td colspan="7">
						<div class="alert alert-danger alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Error:</strong> You have not selected all the input fields.  <strong><a href="'.base_url().'lecturer/results">Click Here</a></strong> to refresh page and try again.</div>
							 
					</td>
				</tr>';
			}//
		}
		//get grade according to marks fed in result form
		if($p1=="get_grade"){
			$total = $this->input->post('total');
			$where="".$total." BETWEEN start_mark AND end_mark";
			$this->db->where($where);
			$query=$this->db->get('grades');
				if($query->num_rows()>0){
					$row = $query->row();
				}
			echo json_encode($row);

		}
		//add results to db
		if($p1=="add"){
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->lec->result_crud('add')){
				$valid['success'] = true;
				$valid['messages'] = "Result was added successfully.";
				echo json_encode($valid);
			}
			else{
				$valid['messages'] = "Not Added";
			}
		}
		//if view result
		if($p1=="view"){
			$page_data['result_code']=$this->db->get_where('results', array('result_code'=>$p2));
        	$page_data['page_name']  = 'view result';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Results';
			$page_data['function']  = 'results';
        	$page_data['page_title'] = 'View Result';
        	$this->load->view('index', $page_data,'refresh');
			
		}//end view
		//if update result
		if($p1=="update"){
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->lec->result_crud('update')){
				$valid['success'] = true;
				$valid['messages'] = "Results Updated Successfully.";
				echo json_encode($valid);
			}
			else{
			}
		}
		
	}//end result crud
	
	//units crud
	public function units_crud($p1="",$p2=""){
		//select course based on programme type
		if($p1=="select_unit"){
			$where="course_id=".$p2."";
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				//echo '<option>No Units available!</option>';
				echo'<script>
							document.getElementById("display_warning").style.display="block";
					</script>
					';
			}else{
				$course = $this->db->get_where('units' , array('course_id' => $p2))->result_array();
				echo '<option></option>';
				foreach ($course as $row) {
				echo '<option value="' .$row['unit_id'] . '">' .$row['unit_name'].'</option>';
				}
				echo'<script>
							document.getElementById("display_warning").style.display="none";
					</script>
					';
			}
		}
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------------------------
	
	public function attendance_crud($p1='',$p2='',$p3='',$p4='',$p5=''){
		
		//if get students
		if($p1=="get_student"){
		//count if there is any date in attendance
		//$ol=array('lecturer_id'=>$p5,'unit_id'=>$p4,'course_id'=>$p3,'semester_id'=>$p2);
        $this->db->select('*');
        $this->db->from('attendances');
        //$this->db->where($ol);
        $count_all_attendance	=	$this->db->count_all_results();
		
		$ol=array('lecturer_id'=>$p5,'unit_id'=>$p4,'course_id'=>$p3,'semester_id'=>$p2);
        $this->db->select('*');
        $this->db->from('attendances');
        $this->db->where($ol);
        $count_attendance_spec	=	$this->db->count_all_results();
			//echo $count_all_attendance;
			//echo $count_attendance_spec;
			if($count_attendance_spec=="0"){
				
				$course = $this->db->get_where('students' , array('student_course' => $p3))->result_array();
				$x=1; $cat=1;$total=1;$gt=1;$gf=1;$final=1;$grade=1;$delete=1;$tr=1;$sg=1;
				foreach ($course as $row) {
				$adm_no       =	$this->db->get_where('login' , array('name'=>$row['student_name']))->row()->username;
					
					echo '
						<tr id="tr'.$tr++.'">
							<td width="10%">
								<input type="button" value="'.$x++.'" disabled="true" class="form-control" />                  
							</td>
							<td width="35%">
								<select name="name[]" class="form-control" required="required">
									<option value="' .$row['student_id'] . '">' .$row['student_name'].' ('.$adm_no.')</option>
								</select>
							</td>
							 <td>
                                <input type="number" name="att[]" onkeyup="getPercentage('.$gt++.')"  id="att'.$cat++.'" autocomplete="off" class="form-control"  placeholder="Attendance percentage" required="required" min="0" max="100"/>
                            </td>
							 
                             <td>
                             <button class="btn btn-danger  removeResultRowBtn" type="button" id="removeResultRowBtn" onclick="removeResultRow('.$delete++.')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
                            </td>
						</tr>
					';
				}
			}
			
			else if($count_all_attendance>"0" && $count_attendance_spec>"0"){
				echo '
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="alert alert-danger alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Info:</strong> You have already added Students Attendance for this Unit Selected! Refresh page and Try again.</div>
							 
					</td>
				</tr>';
				
			}
			
			else{
				echo '
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4">
						<div class="alert alert-danger alert-dismissible fade in">
                         	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                             <strong>Info:</strong> No Data Available!</div>
							 
					</td>
				</tr>';
			}
		}//end
		if($p1=="add"){
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->lec->attendance_crud('add')){
				$valid['success'] = true;
				$valid['messages'] = "Student Unit Attendance was added successfully.";
				echo json_encode($valid);
			}
			else{
				$valid['messages'] = "Not Added";
			}
		}//end
		//view student attendances
		if($p1=="view"){
			$page_data['a_code']=$this->db->get_where('attendances', array('a_code'=>$p2));
        	$page_data['page_name']  = 'view attendance';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Attendances';
			$page_data['function']  = 'attendance';
        	$page_data['page_title'] = 'View Attendance';
        	$this->load->view('index', $page_data);
			
		}//end view
	}//end manage attendance
	
	//function print result pdf
	public function print_result($p1=''){
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
			
			$html_content = '<p align="center"><img src="'.$this->lec->get_image_url($s,$l).'" width="15%" height="15%"/></p>
							 <h4 align="center">'.$institution.'</h4>
							 <h5 align="center">'.$sname.'</h5>
							 <h5 align="center">STUDENT RESULTS</h5>
							 <hr style="border:1px solid #000;" />';
			$html_content .= $this->lec->generate_result($p1);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,750,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Result #".$p1.".pdf", array("Attachment"=>0));
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

			$posting = $this->lec->password_post($userId);

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
		$validate = $this->lec->password_validate($this->input->post('oldpass'));

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
		$this->load->view('backend/lecturer/modal_edit_image.php',$data,'refresh');
	}
	
	//lecturer update/upload profile piicture
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Picture Updated Successfully!');
			redirect ('lecturer/profile','refresh');
	}
	

	
	//destroy session
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
//end of lecturer class bracket
}