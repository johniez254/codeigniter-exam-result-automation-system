<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Admin_model','adm');
		$this->load->model('Status_model','status');
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
		$page_data=array(

	        'page_name'  => 'dashboard',
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'dashboard',//page title;
	        'total_schools' => $this->status->countTotalSchools(),
	        'total_departments' => $this->status->countTotalDepartments(),
	        'assigned_departments' => $this->status->countTotalDepartments('assigned'),
	        'total_lecturers' => $this->status->countTotalLecturers(),
	        'total_students' => $this->status->countTotalStudents(),
	        'total_units' => $this->status->countTotalUnits(),
	        'assigned_units' => $this->status->countTotalUnits('assigned'),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load lecturers page
	public function lecturers(){
		$page_data=array(
	        'page_name' => 'lecturers',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'lecturers',//page title;
	        'total_lecturers' => $this->status->countTotalLecturers(),
	        'lecturersQuery' => $this->status->lecturersQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load students page
	public function students(){
		$page_data=array(
	        'page_name'  => 'students',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'students',//page title;
	        'total_students' => $this->status->countTotalStudents(),
	        'studentsQuery' => $this->status->studentsQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load schools page
	public function schools(){
		$page_data=array(
			'page_name'  => 'schools',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
        	'page_title' => 'schools',//page title;
	        'total_schools' => $this->status->countTotalSchools(),
	        'school_query' => $this->status->schoolQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	//load view students page
	public function view_school($p1=""){
		//encrypt and decrypt url
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p1))))))));
		$page_data=array(
			'school_id'=> $this->db->get_where('schools', array('school_id'=>$encrypt)),
        	'page_name'  => 'view school',
			'crumb'  => '2',
			'page_crumb'  => 'Schools',
			'function'  => 'schools',
        	'page_title' => 'View School',

	        'departments' => $this->status->countTotalDepartments('',$encrypt),
	        'units' => $this->status->countTotalUnits('',$encrypt),
	        'lecturers' => $this->status->countTotalLecturers('',$encrypt),
	        'students' => $this->status->countTotalStudents('',$encrypt),
	        'schoolQuery' => $this->status->schoolQuery($encrypt),
	        'unitsQuery' => $this->status->unitsQuery('',$encrypt),
	        'lecturersQuery' => $this->status->lecturersQuery('',$encrypt),
	        'studentsQuery' => $this->status->studentsQuery('',$encrypt),
        );
        $this->load->view('index', $page_data,'refresh');
	}
	
	//load view student results page
	public function view_result($p1=""){
		//encrypt and decrypt url
				$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p1))))))));
		$page_data['student_id']=$this->db->get_where('students', array('student_id'=>$encrypt));
        	$page_data['page_name']  = 'view result';
			$page_data['crumb']  = '2';
			$page_data['page_crumb']  = 'Students';
			$page_data['function']  = 'students';
        	$page_data['page_title'] = 'View Result';
        	$this->load->view('index', $page_data,'refresh');
	}
	
	//load departments page
	public function departments(){
		$page_data=array(
        	'page_name'  => 'departments',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
        	'page_title' => 'departments',//page title;
	        'total_departments' => $this->status->countTotalDepartments(),
	        'departmentsQuery' => $this->status->departmentQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load semesters page
	public function semesters(){
		$page_data = array(
	        'page_name'  => 'semesters',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'semesters',//page title;
	        'semestersQuery' => $this->status->semestersQuery(),
	        'total_semesters' => $this->status->countTotalSemesters(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load units page
	public function units(){
		$page_data=array(
        	'page_name'  => 'units',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
        	'page_title' => 'units',//page title;
	        'total_units' => $this->status->countTotalUnits(),
	        'unitsQuery' => $this->status->unitsQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load courses page
	public function courses(){
		$page_data=array(
	        'page_name'  => 'courses',//page name
			'crumb'  => '1',//number of breadcrumbs in header section
	        'page_title' => 'courses',//page title;
	        'total_courses' => $this->status->countTotalCourses(),
	        'coursesQuery' => $this->status->coursesQuery(),
		);
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//load grades page
	public function grades(){
		$page_data=array(
	        'page_name' => 'grades',//page name
			'crumb' => '1',//number of breadcrumbs in header section
	        'page_title' => 'grades',//page title;
	        'total_grades' => $this->status->countTotalGrades(),
	        'gradesQuery' => $this->status->gradesQuery(),
		);
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
	
	//load settings page
	public function settings(){
        $page_data['page_name']  = 'settings';//page name
		$page_data['crumb']  = '1';//number of breadcrumbs in header section
        $page_data['page_title'] = 'settings';//page title;
        $this->load->view('index', $page_data,'refresh');//load index
	}
	
	//validate profile form
	public function validate_unit(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 's2example-2',
				'label' => 'School',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Select the %s!',
				)
			),
			array(
				'field' => 's_course',
				'label' => 'Course',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Select %s!',
				)
			),
			array(
				'field' => 'u_code',
				'label' => 'Unit Code',
				'rules' => 'required|callback__check_code',
				'errors' => array(
					'required' => 'The %s field is required!',
				)
			),
			array(
				'field' => 'u_name',
				'label' => 'Unit Name',
				'rules' => 'required|callback__check_unit',
				'errors' => array(
					'required' => 'This %s field is required!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->units_crud('add');

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Unit Added Successfully!";
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
	
	//------------------------------------------------------------------------------------------------------------
	
	//schools crud operations
	public function schools_crud($p1='',$p2=''){
		// add school
		if($p1=="add"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 's_name',
				'label' => 'School Name',
				'rules' => 'required|is_unique[schools.school_name]',
				'errors' => array(
					'is_unique' => 'This %s already exists!',
				)
			),
			
			array(
				'field' => 'abbr',
				'label' => 'School Abbreviation',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->schools_crud('add');

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "School Added Successfully!";
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
		
		// edit school
		if($p1=="edit"){
			$data['school_id']=$this->db->get_where('schools', array('school_id' => $p2));
			$this->load->view('backend/admin/modal_edit_schools.php',$data);
		}
		
		// update school
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_s_name',
				'label' => 'School Name',
				'rules' => 'required',
				'errors' => array(
					'is_unique' => 'This %s already exists!',
				)
			),
			
			array(
				'field' => 'u_abbr',
				'label' => 'School Abbreviation',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->schools_crud('update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "School Updated Successfully!";
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
		
		//if delete school
		if($p1=='delete'){
			$this->db->where('school_id',$p2);
			$this->db->delete('schools');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> School Deleted Successfully!');
			redirect ('admin/schools','refresh');
		}
		
	}//end schools crud
	
	//-----------------------------------------------------------------------------------------------------------------------------
	
	//department crud operations
	public function department_crud($p1='',$p2=''){
		//add departments
		if($p1=="add"){
			
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 's2example-2',
				'label' => 'School',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Please select %s!',
				)
			),
			
			array(
				'field' => 'd_name',
				'label' => 'Department',
				'rules' => 'required|is_unique[departments.department_name]',
				'errors' => array(
					'is_unique' => 'This %s already exists!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->department_crud('add');

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Department Added Successfully!";
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
		
		//edit dept
		if($p1=="edit"){
			$data['dept_id']=$this->db->get_where('departments', array('dept_id' => $p2));
			$this->load->view('backend/admin/modal_edit_dpt.php',$data);
		}
		//update
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_school',
				'label' => 'School',
				'rules' => 'required',
			),
			array(
				'field' => 'u_d_name',
				'label' => 'Department Name',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->department_crud('update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Department Updated Successfully!";
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
		
		//if add course for selected department
		if($p1=="add_course"){
			$data['dept_id']=$this->db->get_where('departments', array('dept_id' => $p2));
			$this->load->view('backend/admin/modal_add_dpt.php',$data);
		}
		//if update_course
		if($p1=="update_course"){
		
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_a_name',
				'label' => 'Department Name',
				'rules' => 'required',
			),
			array(
				'field' => 'p_a_type',
				'label' => 'Programme Type',
				'rules' => 'required',
			),
			array(
				'field' => 'c_a_name',
				'label' => 'Course Name',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->department_crud('update_course',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Course Added Successfully!";
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
		}//end update dept
		
		//if delete dept
		if($p1=='delete'){
			$this->db->where('dept_id',$p2);
			$this->db->delete('departments');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Department Deleted Successfully!');
			redirect ('admin/departments','refresh');
		}
		
	}//departments crud
	
	//-----------------------------------------------------------------------------------------------------------------------------
	//courses crud operations function
	public function course_crud($p1="",$p2=""){
		//add course
		if($p1=="add"){
			//validate form posted data
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'dpt',
				'label' => 'Department',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Please select %s!',
				)
			),
			
			array(
				'field' => 'p_type',
				'label' => 'Programme Type',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Please Select %s!',
				)
			),
			
			array(
				'field' => 'c_name',
				'label' => 'Course Name',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Add %s!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
		//if true
		if($this->form_validation->run() === true) {
			
			//add data

			$posting = $this->adm->courses_crud('add');
			//if posted to db
			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Course Added Successfully!";
			}	
			//otherwise
			else {
				$validator['success'] = false;
				$validator['messages'] = "There was an error while posting your data.";
			} 
		}
		//form data contains one or more errors and return error to display to user
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);			
			} // /else
		}
		echo json_encode($validator);
		}//end add course
		
		//edit unit
		if($p1=="edit"){
			$data['course_id']=$this->db->get_where('courses', array('course_id' => $p2));
			$this->load->view('backend/admin/modal_edit_course.php',$data,'refresh');
		}
		//update course
		if($p1=="update"){
			
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'u_dpt',
				'label' => 'Department',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Please select %s!',
				)
			),
			
			array(
				'field' => 'u_p_type',
				'label' => 'Programme Type',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Please Select %s!',
				)
			),
			
			array(
				'field' => 'u_c_name',
				'label' => 'Course Name',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Add %s!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->courses_crud('update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Course Updated Successfully!";
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
		}//end update course
		
		//if delete dept
		if($p1=='delete'){
			$this->db->where('course_id',$p2);
			$this->db->delete('courses');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Course Deleted Successfully!');
			redirect ('admin/courses','refresh');
		}
		
		//select course based on programme type
		if($p1=="select_course"){
			$where="school_id=".$p2."";
			$this->db->select('*');
			$this->db->from('courses');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				//echo '<option value="">No Courses available under this school!</option>';
			}else{
				$course = $this->db->get_where('courses' , array('school_id' => $p2))->result_array();
					echo '<option value=""></option>';
				foreach ($course as $row) {
					echo '<option value="' .$row['course_id'] . '">' .$row['course_name'].'</option>';
				}
			}
		}
		
		//select course based on programme type
		if($p1=="select_department"){
			$where="school_id=".$p2."";// AND added_course=0
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '<option value="">No departments available under this school!</option>';
			}else{
				$course = $this->db->get_where('departments' , array('school_id' => $p2))->result_array();
				foreach ($course as $row) {
				echo '<option value="' .$row['dept_id'] . '">' .$row['department_name'].'</option>';
				}
			}
			
		}
		
		//select department based on programme type
		if($p1=="update_select_department"){
			$where="school_id=".$p2."";
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '<option value="">No departments available under this school!</option>';
			}else{
				$course = $this->db->get_where('departments' , array('school_id' => $p2))->result_array();
				foreach ($course as $row) {
				echo '<option value="' .$row['dept_id'] . '">' .$row['department_name'].'</option>';
				}
			}
			
		}
		
	}//end course function
		//-----------------------------------------------------------------------------------------------------------------------------
	
	
	//semesters crud operations function
	public function semester_crud($p1="",$p2=""){
		//add course
		if($p1=="add"){
			
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'yr',
				'label' => 'Academic Year',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Input %s!',
				)
			),
			
			array(
				'field' => 's2example-1',
				'label' => 'Semester Name',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Select %s!',
				)
			),
			
			array(
				'field' => 's_m',
				'label' => 'Semester Period',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Add %s!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->semester_crud('add');

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Semester Added Successfully!";
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
		}//end add semester
		
		//if edit semester
		if($p1=="edit"){
			$data['semester_id']=$this->db->get_where('semesters', array('semester_id' => $p2));
			$this->load->view('backend/admin/modal_edit_sem.php',$data);
		}
		
		//if update semester
		if($p1=="update"){
			
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'ac_year',
				'label' => 'Academic Year',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Input %s!',
				)
			),
			
			array(
				'field' => 'm_sem',
				'label' => 'Semester Name',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Select %s!',
				)
			),
			
			array(
				'field' => 'd_range',
				'label' => 'Semester Period',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Add %s!',
				)
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->semester_crud('update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Semester Updated Successfully!";
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
		}//end update
		
		//if delete
		if($p1=="delete"){
			$this->db->where('semester_id',$p2);
			$this->db->delete('semesters');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Semester Deleted Successfully!');
			redirect ('admin/semesters','refresh');
		}//end delete
		
	}//end semester function
		//-----------------------------------------------------------------------------------------------------------------------------
		
		
	//grades crud operations function
	public function grades_crud($p1="",$p2=""){
		//add course
		if($p1=="add"){
			
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'grade',
				'label' => 'Grade',
				'rules' => 'required|is_unique[grades.grade]',
				'errors' => array(
					'is_unique' => 'This %s already exists!',
				)
			),
			
			array(
				'field' => 's_mark',
				'label' => 'Starting Mark',
				'rules' => 'required',
			),
			
			array(
				'field' => 'e_mark',
				'label' => 'End Mark',
				'rules' => 'required',
			),
			
			array(
				'field' => 'g_description',
				'label' => 'Grade Description',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->grades_crud('add');

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Grade Added Successfully!";
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
		}//end add grade
		
		//if delete dept
		if($p1=='delete'){
			$this->db->where('grade_id',$p2);
			$this->db->delete('grades');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Grade Deleted Successfully!');
			redirect ('admin/grades','refresh');
		}
		
		//if update
		if($p1=="update_grades"){
			$valid['success'] = array('success' => false, 'messages' => array(), 'flash_message' => array(),);
			if($this->adm->grades_crud('update')){
				$valid['success'] = true;
				$valid['messages'] = "Grades Updated Successfully.";
				echo json_encode($valid);
			}
			else{
			}
		}
		
	}//end grade function
	
	
	//-----------------------------------------------------------------------------------------------------------------------------
	//units crud operations function
	public function units_crud($p1='',$p2=''){
		//select course based on programme type
		if($p1=="select_unit"){
			$where="course_id=".$p2." AND assigned_to_lec='0'";
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				//echo '<option>No Units available!</option>';
			}else{
				$course = $this->db->get_where('units' , array('course_id' => $p2,"assigned_to_lec"=>'0'))->result_array();
				foreach ($course as $row) {
				echo '<option value="' .$row['unit_id'] . '">' .$row['unit_name'].'</option>';
				}
			}
		}
		//edit unit
		if($p1=="edit"){
			$data['unit_id']=$this->db->get_where('units', array('unit_id' => $p2));
			$this->load->view('backend/admin/modal_edit_units.php',$data,'refresh');
		}
		
		//update
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'm_u_code',
				'label' => 'Unit Code',
				'rules' => 'required',
			),
			array(
				'field' => 'm_u_name',
				'label' => 'Unit Name',
				'rules' => 'required',
			),
			array(
				'field' => 'm_u_school',
				'label' => 'School Name',
				'rules' => 'required',
			),
			array(
				'field' => 'm_u_course',
				'label' => 'School Name',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->units_crud('update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Unit Updated Successfully!";
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
		
		//if delete unit
		if($p1=='delete'){
			$this->db->where('unit_id',$p2);
			$this->db->delete('units');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Unit Deleted Successfully!');
			redirect ('admin/units','refresh');
		}
		
		//modal assign units to lecturers
		if($p1=="assign"){
			$data['unit_id']=$this->db->get_where('units', array('unit_id' => $p2));
			$this->load->view('backend/admin/modal_assign.php',$data,'refresh');
		}//end assign
		
		//assign unit function
		if($p1=="unit_assign_update"){
			$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'm_lecturer',
				'label' => 'Lecturer',
				'rules' => 'required',
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {

			$posting = $this->adm->units_crud('unit_assign_update',$p2);

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Unit Assigned Successfully!";
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
		
		//if unassign unit from the lecturer
		if($p1=="unassign"){
			//delete assigned unit
			$this->db->where('lecturer_unit_id',$p2);
			$delete=$this->db->delete('manage_units');
			
			$cs="lecturer_unit_id=".$p2."";
			$this->db->select('*');
			$this->db->from('manage_units');
			$this->db->where($cs);
			$count_units	=	$this->db->count_all_results();
			
			if($count_units=="0"){
				//update units to defaults
				$data=array(
					"assigned_to_lec"=>0,
				);
				$this->db->where("unit_id",$p2);
				$update=$this->db->update("units",$data);
			}
			
			//if true
			if($delete){
				$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Unit Unassigned Successfully!');
				redirect ('admin/units','refresh');
			}
		}//end unassign
	}
	
	//----------------------------------------------------------------------------------------------------------------------
	
	///begin students crud function
	public function students_crud($p1="",$p2=""){
		
		//add student
		if($p1=="add"){
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 's_name',
					'label' => 'Student Name',
					'rules' => 'required|min_length[3]',
				),
				array(
					'field' => 's_phone',
					'label' => 'Phone Number',
					'rules' => 'required|is_unique[students.student_phone]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'required',
				),
				array(
					'field' => 'idno',
					'label' => 'Student IDNO',
					'rules' => 'required|is_numeric|is_unique[students.student_idno]|min_length[8]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
						'is_numeric' => 'Please input a complete valid %s!',
					)
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|is_unique[students.student_email]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required',
				),
				array(
					'field' => 'reg_no',
					'label' => 'Student Registration Number',
					'rules' => 'required|is_unique[login.username]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 's2example-2',
					'label' => 'School',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
				array(
					'field' => 'p_type',
					'label' => 'Programme Type',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
				array(
					'field' => 's2example-3',
					'label' => 'Course',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->students_crud('add');
	
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Student Added Successfully!";
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
		
		//edit student
		if($p1=="edit"){
			$data['student_id']=$this->db->get_where('students', array('student_id' => $p2));
			$this->load->view('backend/admin/modal_edit_student.php',$data,'refresh');
		}
		
		//update student
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'u_s_name',
					'label' => 'Student Name',
					'rules' => 'required|min_length[3]',
				),
				array(
					'field' => 'u_s_phone',
					'label' => 'Phone Number',
					'rules' => 'required',
				),
				array(
					'field' => 'u_address',
					'label' => 'Address',
					'rules' => 'required',
				),
				array(
					'field' => 'u_idno',
					'label' => 'Student IDNO',
					'rules' => 'required|is_numeric|min_length[8]',
					'errors' => array(
						'is_numeric' => 'Please input a complete valid %s!',
					)
				),
				array(
					'field' => 'u_email',
					'label' => 'Email',
					'rules' => 'required|valid_email',
				),
				array(
					'field' => 'u_gender',
					'label' => 'Gender',
					'rules' => 'required',
				),
				array(
					'field' => 'u_reg_no',
					'label' => 'Student Registration Number',
					'rules' => 'required',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'u_school',
					'label' => 'School',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
				array(
					'field' => 'u_p_type',
					'label' => 'Programme Type',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
				array(
					'field' => 'u_course',
					'label' => 'Course',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->students_crud('update',$p2);
	
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Student Updated Successfully!";
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
		
		//if delete student
		if($p1=='delete'){
			$login_id       =	$this->db->get_where('students' , array('student_id'=>$p2))->row()->login_id;
			//delete student data
			$this->db->where('student_id',$p2);
			$delete_student=$this->db->delete('students');
			//delete student login credentials
			$this->db->where('login_id',$login_id);
			$delete_login=$this->db->delete('login');
			
			//if true
			if($delete_student && $delete_login){
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Student Deleted Successfully!');
			redirect ('admin/students','refresh');
			}else{
			$this->session->set_flashdata('error_message' , '<i class="fa fa-check"></i> Student was not deleted!');
			redirect ('admin/students','refresh');
			}
		}
		
	}//end student crud
	
	//----------------------------------------------------------------------------------------------------------------------
	// ADMIN VIEW STUDENT RESULT FUNCTION
	//----------------------------------------------------------------------------------------------------------------------
	public function result_crud($p1="",$p2="",$p3=""){
		//get results function
		if($p1=="get_result"){
			$login_id=$p3;
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
		
		//download student result function param
		if($p1=="student_pdf"){
			$login_id=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($p2))))))));;
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
			
			$html_content = '<p align="center"><img src="'.$this->adm->get_image_url($s,$l).'" width="15%" height="15%"/></p>
							<h4 align="center">'.$institution.'</h4>
							 <h5 align="center">'.$sname.'</h5>
							 <h5 align="center">PROVISIONAL TRANSCRIPT</h5>
							 <h5 align="center">UNDERGRADUATE</h5>
							 <hr style="border:1px solid #000;" />';
			$html_content .= $this->adm->generate_result($student_id,$semester_id,$login_id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			//$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			//$canvas->page_text(250,750,"Header: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("".$name.".pdf", array("Attachment"=>0));
		}//end student pdf
	}
	//----------------------------------------------------------------------------------------------------------------------
	// END ADMIN VIEW STUDENT RESULT FUNCTION
	//----------------------------------------------------------------------------------------------------------------------
	
	///begin lecturers crud function
	public function lecturers_crud($p1="",$p2=""){
		if($p1=="select_course"){
			$where="school_id=".$p2."";
			$this->db->select('*');
			$this->db->from('courses');
			$this->db->where($where);
			$count=$this->db->count_all_results();
			if($count=="0"){
				echo '<option value="">No Courses available under this school!</option>';
			}else{
				$course = $this->db->get_where('courses' , array('school_id' => $p2))->result_array();
				foreach ($course as $row) {
					echo '<option value="' .$row['course_id'] . '">' .$row['course_name'].'</option>';
				}
			}
		}
		
		//add lecturer
		if($p1=="add"){
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'l_name',
					'label' => 'Lecturer Name',
					'rules' => 'required|min_length[3]',
				),
				array(
					'field' => 'l_phone',
					'label' => 'Phone Number',
					'rules' => 'required|is_unique[students.student_phone]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'address',
					'label' => 'Address',
					'rules' => 'required',
				),
				array(
					'field' => 'idno',
					'label' => 'Lecturer IDNO',
					'rules' => 'required|is_numeric|is_unique[lecturers.lecturer_idno]|min_length[8]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
						'is_numeric' => 'Please input a complete valid %s!',
					)
				),
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|is_unique[students.student_email]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'gender',
					'label' => 'Gender',
					'rules' => 'required',
				),
				array(
					'field' => 'reg_no',
					'label' => 'Lecturer Registration Number',
					'rules' => 'required|is_unique[login.username]',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 's2example-2',
					'label' => 'School',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),//
				array(
					'field' => 's2example-3',
					'label' => 'Course',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),//
				array(
					'field' => 's2example-5',
					'label' => 'Units',
					'rules' => 'callback_validate_multiselect',
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->lecturers_crud('add');
	
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Lecturer Added Successfully!";
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
		
		//edit lecturer
		if($p1=="edit"){
			$data['lecturer_id']=$this->db->get_where('lecturers', array('lecturer_id' => $p2));
			$this->load->view('backend/admin/modal_edit_lecturer.php',$data,'refresh');
		}
		
		//update lecturer
		if($p1=="update"){
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'u_l_name',
					'label' => 'Lecturer Name',
					'rules' => 'required|min_length[3]',
				),
				array(
					'field' => 'u_l_phone',
					'label' => 'Phone Number',
					'rules' => 'required',
				),
				array(
					'field' => 'u_address',
					'label' => 'Address',
					'rules' => 'required',
				),
				array(
					'field' => 'u_idno',
					'label' => 'Lecturer IDNO',
					'rules' => 'required|is_numeric|min_length[8]',
					'errors' => array(
						'is_numeric' => 'Please input a complete valid %s!',
					)
				),
				array(
					'field' => 'u_email',
					'label' => 'Email',
					'rules' => 'required|valid_email',
				),
				array(
					'field' => 'u_gender',
					'label' => 'Gender',
					'rules' => 'required',
				),
				array(
					'field' => 'u_reg_no',
					'label' => 'Lecture Reg. No.',
					'rules' => 'required',
					'errors' => array(
						'is_unique' => 'This %s is already taken!',
					)
				),
				array(
					'field' => 'u_school',
					'label' => 'School',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please select %s!',
					)
				),
			);
			
			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');
	
			if($this->form_validation->run() === true) {
	
				$posting = $this->adm->lecturers_crud('update',$p2);
	
				if($posting === true) {
					$validator['success'] = true;
					$validator['messages'] = "Lecturer Updated Successfully!";
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
		
		//if delete lecturer
		if($p1=='delete'){
			$login_id       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$p2))->row()->login_id;
			//delete student data
			$this->db->where('lecturer_id',$p2);
			$delete_lecturer=$this->db->delete('lecturers');
			//delete student login credentials
			$this->db->where('login_id',$login_id);
			$delete_login=$this->db->delete('login');
			
			//select unit id
	    	$where="lecturer_id=".$p2."";
            $this->db->select('*');
            $this->db->from('manage_units');
            $this->db->where($where);
            $desc	=	$this->db->get()->result_array();
            foreach($desc as $row):
				$unit_id=$row['lecturer_unit_id'];
				
				$update_units=array(
									"assigned_to_lec"=>0,
								   );
			//update units to defaults
			$this->db->where('unit_id',$unit_id);
			$update=$this->db->update('units',$update_units);
				
			endforeach;
			//delete units managed by lecturer
			$this->db->where('lecturer_id',$p2);
			$delete_units=$this->db->delete('manage_units');
			
			//if true
			if($delete_lecturer && $delete_login && $delete_units && $update){
				$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Lecturer Deleted Successfully!');
				redirect ('admin/lecturers','refresh');
			}else{
				$this->session->set_flashdata('error_message' , '<i class="fa fa-check"></i> Lecturer was not deleted!');
				redirect ('admin/lecturers','refresh');
			}
		}
		
	}//end lecturer crud
	//----------------------------------------------------------------------------------------------------------------------
	//check if unit is already assigned to course or not functions
	//check unit name
	public function _check_unit(){
		$unit_name=$this->input->post('u_name');
		$course_id=$this->input->post('s_course');
		
		$validate = $this->adm->check_unit_name_status($unit_name,$course_id);
		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('_check_unit', 'This Unit Name is already assigned to selected course!');
			return false;			
		} // /else
	}
	
	//check Unit Code
	public function _check_code(){
		$unit_code=$this->input->post('u_code');
		$course_id=$this->input->post('s_course');
		
		$validate = $this->adm->check_unit_code_status($unit_code,$course_id);
		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('_check_code', 'This Unit Code is already assigned to selected course!');
			return false;			
		} // /else
	}
	
	//-----------------------------------------------------------------------------------------------------------------------
	// validate form inputs in the settings page
	public function validate_setting(){
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'sname',
				'label' => 'System Name',
				'rules' => 'required'
			),
			array(
				'field' => 'institution',
				'label' => 'Institution Name',
				'rules' => 'required'
			),
			array(
				'field' => 'abr',
				'label' => 'System Abbreviation',
				'rules' => 'required'
			),
			array(
				'field' => 'address',
				'label' => 'System Address',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'valid_email' => 'Please input a valid %s address',
				)
			),
			array(
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'required'
			),
		);
		
		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if($this->form_validation->run() === true) {//form inputs have passed all the validation test

			$posting = $this->adm->settings_post();//post data to model with function setting_post

			if($posting === true) {
				$validator['success'] = true;
				$validator['messages'] = "Settings Updated Successfully!";
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
	}//end setting function
	
	
		//validate profile form
	public function validate_profile(){
		$userId = $this->session->userdata('id');
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|alpha_dash'
			),
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required',
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

			$posting = $this->adm->profile_post($userId);

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

			$posting = $this->adm->password_post($userId);

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
		$validate = $this->adm->password_validate($this->input->post('oldpass'));

		if($validate === true) {
			return true;
		} 
		else {
			$this->form_validation->set_message('validate_pass', 'This Old Password is incorrect!');
			return false;			
		} // /else
	} // /validate password function
	
	//admin update/upload profile piicture
	public function update_image(){
		$userId = $this->session->userdata('id');
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/user_image/' . $userId . '.jpg');			 
			$this->session->set_flashdata('flash_message' , '<i class="fa fa-check"></i> Picture Updated Successfully!');
			redirect ('admin/profile','refresh');
	}
	
	//upload logo image
	public function update_logo(){
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo_image/logo.jpg');			 
			$this->session->set_flashdata('flash_message' , 'Logo Updated Successfully!');
			redirect ('admin/settings','refresh');
	}
	
	//upload school logo image
	public function school_logo(){
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/school_image/logo.jpg');			 
			$this->session->set_flashdata('flash_message' , 'University Logo Updated Successfully!');
			redirect ('admin/settings','refresh');
	}
	
	//Back up/restore data
	public function data_manager($p1="",$p2=""){
		if ($p1 == 'create') {
			$this->adm->create_backup($p2);
		}
	}
	
	//validate unit multiselect
	function validate_multiselect($data){

		if(!empty($data) && count($data)>0) {
			return false;
		} 
		else {
			$this->form_validation->set_message('validate_multiselect', 'You have not Selected any Unit!');
			return true;			
		} // /else
		
	}
	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
//end of admin class bracket
}