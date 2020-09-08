<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {


//----------------------------------------------------------------------------------------------------------------------------



	/*
	*-------------------------------------------
	* ADMIN STATUSES
	*-------------------------------------------
	*/

	//----------DASHBOARD-----------

	public function countTotalSchools(){
		return $this->db->count_all('schools');
	}

	public function countTotalDepartments($attr=null, $schoolId=null){
		if($attr=="assigned"){
			$where=array("added_course"=>0);
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			return $this->db->count_all_results();
		}
		if($schoolId){
			$where="school_id=".$schoolId."";
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			return $this->db->count_all_results();
		}
		return $this->db->count_all('departments');
	}

	public function countTotalLecturers($lecId=null, $schoolId=null){
		if($schoolId){
			$where="assigned_school=".$schoolId."";
			$this->db->select('*');
			$this->db->from('lecturers');
			$this->db->where($where);
			return $this->db->count_all_results();
		}
		return $this->db->count_all('lecturers');
	}

	public function countTotalStudents($studId=null, $schoolId=null){
		if($schoolId){
			$cs="assigned_school=".$schoolId."";
			$this->db->select('*');
			$this->db->from('students');
			$this->db->where($cs);
			return	$this->db->count_all_results();
		}
		return $this->db->count_all('students');
	}

	public function countTotalUnits($attr=null, $unitId=null){
		if($attr=="assigned"){
			$where=array("assigned_to_lec"=>0);
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			return $this->db->count_all_results();
		}
		if($unitId){
			$where="school_id=".$unitId."";
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			return $this->db->count_all_results();
		}
		return $this->db->count_all('units');
	}

	public function countTotalSemesters(){
		return $this->db->count_all("semesters");
	}

	public function countTotalCourses(){
		return $this->db->count_all("courses");
	}

	public function countTotalGrades(){
		return $this->db->count_all("grades");
	}

	/*
	*-------------------------------------------
	* QUERIES
	*-------------------------------------------
	*/

	//----------SCHOOL-----------
	public function schoolQuery($schoolId=null){
		if($schoolId){
			$where=array('school_id'=>$schoolId);
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			return $this->db->get()->result_array();
		}
        $this->db->select('*');
        $this->db->from('schools');
        return $this->db->get()->result_array();
	}

	//----------DEPARTMENTS-----------
	public function departmentQuery(){
		$this->db->select('*');
		$this->db->from('departments');
		$this->db->order_by('dept_id','desc');
		$this->db->join('schools', 'schools.school_id = departments.school_id');
		return $this->db->get()->result_array();
	}

	public function unitsQuery($unitId=null, $schoolId=null, $param=""){
		if($schoolId){
			$where=array('school_id'=>$schoolId);
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			return $this->db->get()->result_array();
		}
		if($param=="lec"){
			$where="lecturer_id=".$this->get_lecturer_id()."";
			$this->db->select('*');
			$this->db->from('manage_units');
			$this->db->where($where);
			$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
			return $this->db->get()->result_array();
		}
		$this->db->select('*');
		$this->db->from('units');
		$this->db->order_by('posted_date','desc');
		return $this->db->get()->result_array();
	}

	public function lecturersQuery($lectId=null, $schoolId=null){
		if($schoolId){
			$where="assigned_school=".$schoolId."";
			$this->db->select('*');
			$this->db->from('lecturers');
			$this->db->order_by('date_registered','desc');
			$this->db->where($where);
			$this->db->join('login', 'login.login_id = lecturers.login_id');
			return	$this->db->get()->result_array();
		}
		$this->db->select('*');
		$this->db->from('lecturers');
		$this->db->order_by('date_registered','desc');
		$this->db->join('login', 'login.login_id = lecturers.login_id');
		return $this->db->get()->result_array();
	}

	public function studentsQuery($studId=null, $schoolId=null){
		if($schoolId){
			$where="assigned_school=".$schoolId."";
			$this->db->select('*');
			$this->db->from('students');
			$this->db->order_by('date_registered','desc');
			$this->db->where($where);
			$this->db->join('login', 'login.login_id = students.login_id');
			return $this->db->get()->result_array(); 
		}
		$this->db->select('*');
		$this->db->from('students');
		$this->db->order_by('date_registered','desc');
		$this->db->join('login', 'login.login_id = students.login_id');
		return $this->db->get()->result_array();
	}

	public function coursesQuery($courseId=null, $param=null){
		if($param=="lec"){
			$where="school_id=".$this->get_lecturer_school_id()."";
			$this->db->select('*');
			$this->db->from('courses');
			$this->db->order_by('course_name','asc');
			$this->db->where($where);
			return $this->db->get()->result_array();
		}
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->order_by('course_id','desc');
		$this->db->join('departments', 'departments.dept_id = courses.dept_id');
		return	$this->db->get()->result_array();
	}

	public function semestersQuery($semId=null){
		$this->db->select('*');
		$this->db->from('semesters');
		$this->db->order_by('semester_id','asc');
		return $this->db->get()->result_array();
	}

	public function gradesQuery($gradeId=null){
		$this->db->select('*');
		$this->db->from('grades');
		$this->db->order_by('grade_id','asc');
		return $this->db->get()->result_array();
	}



	/*
	*-------------------------------------------
	* LECTURER STATUSES
	*-------------------------------------------
	*/

	function get_lecturer_id(){
		$session_id=$this->session->userdata('id');
		return $this->db->get_where('lecturers' , array('login_id'=>$session_id))->row()->lecturer_id;
	}

	function get_lecturer_school_id(){
		$session_id=$this->session->userdata('id');
		return $this->db->get_where('lecturers' , array('login_id'=>$session_id))->row()->assigned_school;
	}

	function get_school_name(){
		$session_id=$this->session->userdata('id');
		return $this->db->get_where('schools' , array('school_id'=>$this->get_lecturer_school_id()))->row()->school_name;
	}

	public function countLecturerUploadedResults(){
		$where=array('lecturer_id'=>$this->get_lecturer_id());
		$this->db->select('*');
		$this->db->from('results');
		$this->db->where($where);
		$this->db->group_by('result_code');
		return	$this->db->count_all_results();
	}

	public function countLecturerCourses(){
		$where="school_id=".$this->get_lecturer_school_id()."";
		$this->db->select('*');
		$this->db->from('courses');
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	public function countLecturerUnits(){
		$where="lecturer_id=".$this->get_lecturer_school_id()."";
		$this->db->select('*');
		$this->db->from('manage_units');
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	//-------------------QUERIES------------------

	public function resultsQuery(){
		$where=array("lecturer_id"=>$this->get_lecturer_id());
		$this->db->select('*');
		$this->db->from('results');
		$this->db->where($where);
		$this->db->group_by('result_code');
		$this->db->limit('2');
		$this->db->order_by('date_added','asc');
		$this->db->join('units', 'units.unit_id = results.unit_id');
		return $this->db->get()->result_array();
	}

//end of STATUS model class bracket
}