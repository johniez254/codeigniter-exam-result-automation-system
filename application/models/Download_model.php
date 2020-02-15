<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download_model extends CI_Model {
	
	//get schools
	function get_schools(){
		$this->db->select('*');
        $this->db->from('schools');
        $count_schools	=	$this->db->count_all_results();
		$output = '
		<h3 align="center">All Schools ('.$count_schools.')</h3>
		<table width="100%" cellspacing="0" style="font-size:small;">
					 <thead>
                         <tr>
                             <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
                             <th style="border:1px solid #000; padding:5px;">School Name</th>
                             <th style="border:1px solid #000; padding:5px;">School Abbreviation</th>
                         </tr>
					 </thead>
					 <tbody>';
					 	$this->db->select('*');
                        $this->db->from('schools');
                        $this->db->order_by('school_name','asc');
                        $desc	=	$this->db->get()->result_array();
						$i=1;
							foreach($desc as $row):
							$school_id=$row['school_id'];
							$school_name=$row['school_name'];
							$abbr=$row['school_abbr'];
							$posted=$row['date_added'];
							
							$output .= '<tr>
										<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
										<td style="border:1px solid #000; padding:5px; width:76%;">'.$school_name.'</td>
										<td style="border:1px solid #000; padding:5px;">'.$abbr.'</td>
									</tr>';
								
							endforeach;
					 $output .= '</tbody>
				</table>';
		
		return $output;
	}
	//-----------------------------------------------------------------------------------------------------------------------------
	
		//get departments
	function get_departments($id=""){
		if($id){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$s_name=$this->db->get_where('schools' , array('school_id'=>$encrypt))->row()->school_name;
			
			$where=array('school_id'=>$encrypt);			
			$this->db->select('*');
			$this->db->from('departments');
			$this->db->where($where);
			$count_dept	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">SCHOOL: ' .$s_name.'</h3>
			<h3 align="center">Departments : (' .$count_dept.')</h3>
			<table width="100%" cellspacing="0" style="font-size:x-small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Department Name</th>
								 <th style="border:1px solid #000; padding:5px;">Course</th>
							 </tr>
						 </thead>
						 <tbody>';
							$where=array('school_id'=>$encrypt);			
							$this->db->select('*');
							$this->db->from('departments');
							$this->db->where($where);
							$desc	=	$this->db->get()->result_array();
							$i=1;
								foreach($desc as $row):
								$dept_name=$row['department_name'];
								$added_course=$row['added_course'];
								if($added_course==0){
									$c_name="Course Unavailable";
								}else{
									$c_name=$this->db->get_where('courses' , array('school_id'=>$encrypt))->row()->course_name;
								}
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$dept_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$c_name.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}else{
			$this->db->select('*');
			$this->db->from('departments');
			$count_dept	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">All Departments ('.$count_dept.')</h3>
			<table width="100%" cellspacing="0" style="font-size:x-small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Department</th>
								 <th style="border:1px solid #000; padding:5px;">School</th>
								 <th style="border:1px solid #000; padding:5px;">Assigned Course</th>
							 </tr>
						 </thead>
						 <tbody>';
							$this->db->select('*');
							$this->db->from('departments');
							$this->db->order_by('school_name','asc');
							$this->db->join('schools', 'schools.school_id = departments.school_id');
							$desc	=	$this->db->get()->result_array();
							$i=1;
								foreach($desc as $row):			
								$dept_id=$row['dept_id'];
								$dpt_name=$row['department_name'];
								$posted=$row['date_added'];
								$school_name=$row['school_name'];
								$school_id=$row['school_id'];
								$added_c=$row['added_course'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$dpt_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$school_name.'</td>
											<td style="border:1px solid #000; padding:5px;">';
												if($added_c=="0"){
													$output.='Unassigned';
												}else{
													$output.='Assigned';
												}
											$output.='</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}
		
		return $output;
	}
	//-----------------------------------------------------------------------------------------------------------------------------
	
	
	//get courses
	function get_courses($id=""){
		if($id){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$s_name=$this->db->get_where('schools' , array('school_id'=>$encrypt))->row()->school_name;
			
			$where="school_id=".$encrypt."";
			$this->db->from('courses');
			//$this->db->order_by('course_name','asc');
			$this->db->where($where);
			$count_courses	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">School: ('.$s_name.')</h3>
			<h3 align="center">All Courses ('.$count_courses.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Courses</th>
								 <th style="border:1px solid #000; padding:5px;">Programme Type</th>
								 <th style="border:1px solid #000; padding:5px;">Total Students</th>
							 </tr>
						 </thead>
						 <tbody>';
							  $where="school_id=".$encrypt."";
							  $this->db->select('*');
							  $this->db->from('courses');
							  $this->db->order_by('course_name','asc');
							  $this->db->where($where);
							 // $this->db->join('departments', 'departments.dept_id = courses.dept_id');
							  $desc	=	$this->db->get()->result_array();
								$i=1;
								foreach($desc as $row):
									$course_id=$row['course_id'];
									//$dpt_name=$row['department_name'];
									$p_type=$row['programme_type'];
									$course_name=$row['course_name'];
									//$school_id=$row['school_id'];
									
									$cs="student_course=".$course_id."";
									$this->db->select('*');
									$this->db->from('students');
									$this->db->where($cs);
									$count_students	=	$this->db->count_all_results();
																
									//$school_name       =	$this->db->get_where('schools' , array('school_id'=>$school_id))->row()->school_name;
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:54%;">'.$course_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:25%;">';
											if($p_type=="1"){$output .='Diploma';}
											if($p_type=="2"){$output .='Degree';}
											if($p_type=="3"){$output .='Masters';}
											if($p_type=="4"){$output .='PHD';}
											$output.='</td>
											<td style="border:1px solid #000; padding:5px; text-align:right;">'.$count_students.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}else{
			$this->db->select('*');
			$this->db->from('courses');
			$count_courses	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">All Courses ('.$count_courses.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Courses</th>
								 <th style="border:1px solid #000; padding:5px;">Department</th>
								 <th style="border:1px solid #000; padding:5px;">Programme Type</th>
							 </tr>
						 </thead>
						 <tbody>';
							//$where="unit_id='0'";
							  $this->db->select('*');
							  $this->db->from('courses');
							  $this->db->order_by('course_id','desc');
							//$this->db->where($where);
							  $this->db->join('departments', 'departments.dept_id = courses.dept_id');
							  $desc	=	$this->db->get()->result_array();
								$i=1;
								foreach($desc as $row):
									$course_id=$row['course_id'];
									$dpt_name=$row['department_name'];
									$p_type=$row['programme_type'];
									$course_name=$row['course_name'];
									$school_id=$row['school_id'];
																
									$school_name       =	$this->db->get_where('schools' , array('school_id'=>$school_id))->row()->school_name;
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:38%;">'.$course_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:38%;">'.$dpt_name.'</td>
											<td style="border:1px solid #000; padding:5px;">';
											if($p_type=="1"){$output .='Diploma';}
											if($p_type=="2"){$output .='Degree';}
											if($p_type=="3"){$output .='Masters';}
											if($p_type=="4"){$output .='PHD';}
											$output.='</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}
		return $output;
	}
	//-----------------------------------------------------------------------------------------------------------------------------
	
	//get semesters
	function get_semesters(){
		$this->db->select('*');
        $this->db->from('semesters');
        $count_sem	=	$this->db->count_all_results();
		$output = '
		<h3 align="center">All Semesters ('.$count_sem.')</h3>
		<table width="100%" cellspacing="0" style="font-size:small;">
					 <thead>
                         <tr>
                             <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
                             <th style="border:1px solid #000; padding:5px;">Semester</th>
                             <th style="border:1px solid #000; padding:5px;">Year</th>
                             <th style="border:1px solid #000; padding:5px;">Duration</th>
                         </tr>
					 </thead>
					 <tbody>';
					 	 //$where="unit_id='0'";
                                                $this->db->select('*');
                                                $this->db->from('semesters');
                                                $this->db->order_by('semester_name','asc');
                                                //$this->db->where($where);
												//$this->db->join('schools', 'schools.school_id = semesters.school_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
													$sem_id=$row['semester_id'];
													$sem_name=$row['semester_name'];
													$sem_year=$row['semester_year'];
													$duration_from=$row['duration_from'];
													$duration_to=$row['duration_to'];
							
							$output .= '<tr>
										<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
										<td style="border:1px solid #000; padding:5px;;">'.$sem_name.'</td>
										<td style="border:1px solid #000; padding:5px; width:38%;">'.$sem_year.'</td>
										<td style="border:1px solid #000; padding:5px; width:38%">('.$duration_from.'-'.$duration_to.')</td>
									</tr>';
								
							endforeach;
					 $output .= '</tbody>
				</table>';
		
		return $output;
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------
	
	//get units
	function get_units($id=""){
		if($id){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$s_name=$this->db->get_where('schools' , array('school_id'=>$encrypt))->row()->school_name;
			
			$where=array('school_id'=>$encrypt);
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($where);
			$count_units	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">School : '.$s_name.'</h3>
			<h3 align="center">Attached Units : ('.$count_units.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit Name</th>
								 <th style="border:1px solid #000; padding:5px;">Unit Code</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													$where=array('school_id'=>$encrypt);
													$this->db->select('*');
													$this->db->from('units');
													$this->db->order_by('posted_date','desc');
													$this->db->where($where);
													$desc	=	$this->db->get()->result_array();
													$i=1;
													foreach($desc as $row):
																$u_name=$row['unit_name'];
																$u_code=$row['unit_code'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$u_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:44%;">'.$u_code.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}else{
			$this->db->select('*');
			$this->db->from('units');
			$count_units	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">All Units ('.$count_units.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit Code</th>
								 <th style="border:1px solid #000; padding:5px;">Unit Name</th>
								 <th style="border:1px solid #000; padding:5px;">Assigned Course</th>
								 <th style="border:1px solid #000; padding:5px;">Assigned/Unassigned<br> to lecturer</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													//$where="unit_id='0'";
													$this->db->select('*');
													$this->db->from('units');
													$this->db->order_by('posted_date','desc');
													//$this->db->where($where);
													$desc	=	$this->db->get()->result_array();
													$i=1;
													foreach($desc as $row):
																$unit_id=$row['unit_id'];
																$u_name=$row['unit_name'];
																$u_code=$row['unit_code'];
																$posted=$row['posted_date'];
																$school_id=$row['school_id'];
																$course_id=$row['course_id'];
																$assigned=$row['assigned_to_lec'];
																$course=$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:15%;">'.$u_code.'</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$u_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:30%">'.$course.'</td>
											<td style="border:1px solid #000; padding:5px;">';
												if($assigned=="0"){$output.='Unassigned';}else{$output.='Assigned';}
											$output.='</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}
		return $output;
	}
		//-----------------------------------------------------------------------------------------------------------------------------
	
	//get grades
	function get_grades(){
		$this->db->select('*');
        $this->db->from('grades');
        $count_grades	=	$this->db->count_all_results();
		$output = '
		<h3 align="center">All Grades ('.$count_grades.')</h3>
		<table width="100%" cellspacing="0" style="font-size:small;">
					 <thead>
                         <tr>
                             <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
                             <th style="border:1px solid #000; padding:5px;">Grades</th>
                             <th style="border:1px solid #000; padding:5px;">Marks (%)</th>
                             <th style="border:1px solid #000; padding:5px;">Grade Description</th>
                         </tr>
					 </thead>
					 <tbody>';
					 	 
                                                
												//$where="unit_id='0'";
                                                  $this->db->select('*');
                                                  $this->db->from('grades');
                                                  $this->db->order_by('grade','asc');
                                                 //$this->db->where($where);
                                                   $desc	=	$this->db->get()->result_array();
                                                      $i=1;
                                                      foreach($desc as $row):
                                                          $grade_id=$row['grade_id'];
                                                          $grade=$row['grade'];
                                                          $start_mark=$row['start_mark'];
                                                          $end_mark=$row['end_mark'];
                                                          $grade_description=$row['grade_description'];
							
							$output .= '<tr>
										<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
										<td style="border:1px solid #000; padding:5px;;">'.$grade.'</td>
										<td style="border:1px solid #000; padding:5px;">('.$start_mark.'-'.$end_mark.')</td>
										<td style="border:1px solid #000; padding:5px; width:30%">'.$grade_description.'</td>
									</tr>';
								
							endforeach;
					 $output .= '</tbody>
				</table>';
		
		return $output;
	}
	//-----------------------------------------------------------------------------------------------------------------------------
	
	//get lecturers
	function get_lecturers($id=""){
		if($id){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$s_name=$this->db->get_where('schools' , array('school_id'=>$encrypt))->row()->school_name;
			
			
			
			$where=array('assigned_school'=>$encrypt);
			$this->db->select('*');
			$this->db->from('lecturers');
			$this->db->where($where);
			$count_lecs	=	$this->db->count_all_results();
			$output = '
			
			<h3 align="center">School : '.$s_name.'</h3>
			<h3 align="center">All Lecturers ('.$count_lecs.')</h3>
			
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Lecturer Name</th>
								 <th style="border:1px solid #000; padding:5px;">Reg Number</th>
								 <th style="border:1px solid #000; padding:5px;">Phone Number</th>
								 <th style="border:1px solid #000; padding:5px;">IDNO</th>
								 <th style="border:1px solid #000; padding:5px;">Email</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													
													  $where="assigned_school=".$encrypt."";
                                                      $this->db->select('*');
													  $this->db->from('lecturers');
													  $this->db->order_by('date_registered','desc');
													  $this->db->where($where);
													  $this->db->join('login', 'login.login_id = lecturers.login_id');
													 $desc	=	$this->db->get()->result_array();
													 $i=1;
														foreach($desc as $row):
														   //$lecturer_id=$row['lecturer_id'];
														   $lecturer_name=$row['lecturer_name'];
														   $lecturer_idno=$row['lecturer_idno'];
														   $lecturer_phone=$row['lecturer_phone'];
														   $lecturer_email=$row['lecturer_email'];
														   $req_number=$row['username'];
														   //$login_id=$row['login_id'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px;;">'.ucwords($lecturer_name).'</td>
											<td style="border:1px solid #000; padding:5px;">'.strtoupper($req_number).'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_phone.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_idno.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_email.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}else{
			$this->db->select('*');
			$this->db->from('lecturers');
			$count_lecs	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">All Lecturers ('.$count_lecs.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Lecturer Name</th>
								 <th style="border:1px solid #000; padding:5px;">Reg Number</th>
								 <th style="border:1px solid #000; padding:5px;">Phone Number</th>
								 <th style="border:1px solid #000; padding:5px;">IDNO</th>
								 <th style="border:1px solid #000; padding:5px;">Email</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													
													 $this->db->select('*');
													 $this->db->from('lecturers');
													 $this->db->order_by('date_registered','desc');
													 //$this->db->where($where);
													 $this->db->join('login', 'login.login_id = lecturers.login_id');
													 $desc	=	$this->db->get()->result_array();
													 $i=1;
														foreach($desc as $row):
														   //$lecturer_id=$row['lecturer_id'];
														   $lecturer_name=$row['lecturer_name'];
														   $lecturer_idno=$row['lecturer_idno'];
														   $lecturer_phone=$row['lecturer_phone'];
														   $lecturer_email=$row['lecturer_email'];
														   $req_number=$row['username'];
														   //$login_id=$row['login_id'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px;;">'.ucwords($lecturer_name).'</td>
											<td style="border:1px solid #000; padding:5px;">'.strtoupper($req_number).'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_phone.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_idno.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$lecturer_email.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}
		return $output;
	}
	
		//-----------------------------------------------------------------------------------------------------------------------------
		//get_lecturers_units
	function get_lecturers_units($id=""){
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$cs="lecturer_id=".$encrypt."";
			$this->db->select('*');
			$this->db->from('manage_units');
			$this->db->where($cs);
			$count_units	=	$this->db->count_all_results();
							
			$output = '
			<h3 align="center">Assigned Units : ('.$count_units.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit Name</th>
								 <th style="border:1px solid #000; padding:5px;">Unit Code</th>
							 </tr>
						 </thead>
						 <tbody>';
							$where="lecturer_id=".$encrypt."";
							$this->db->select('*');
							 $this->db->from('manage_units');
							 //$this->db->order_by('posted_date','desc');
							 $this->db->where($where);
							 $this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
							 $desc	=	$this->db->get()->result_array();
							 $i=1;
								foreach($desc as $row):
								//$unit_id=$row['unit_id'];
								$u_name=$row['unit_name'];
								$u_code=$row['unit_code'];
								//$posted=$row['posted_date'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$u_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:44%;">'.$u_code.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
					
					return $output;
			
	}
		//-----------------------------------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------------------------------
		//get_student_units
	function get_student_units($id=""){
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$cs="course_id=".$encrypt."";
			$this->db->select('*');
			$this->db->from('units');
			$this->db->where($cs);
			$count_units	=	$this->db->count_all_results();
							
			$output = '
			<h3 align="center">My Units : ('.$count_units.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit Name</th>
								 <th style="border:1px solid #000; padding:5px;">Unit Code</th>
							 </tr>
						 </thead>
						 <tbody>';
                                                $where="course_id=".$encrypt."";
                                                $this->db->select('*');
                                                $this->db->from('units');
                                                //$this->db->order_by('posted_date','desc');
                                                $this->db->where($where);
												//$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															$unit_id=$row['unit_id'];
															$u_name=$row['unit_name'];
															$u_code=$row['unit_code'];
															$posted=$row['posted_date'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:50%;">'.$u_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:44%;">'.$u_code.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
					
					return $output;
			
	}
		//-----------------------------------------------------------------------------------------------------------------------------
	
	//get students
	function get_students($id=""){
		if($id){
			$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$s_name=$this->db->get_where('schools' , array('school_id'=>$encrypt))->row()->school_name;
			
			
			
			$where=array('assigned_school'=>$encrypt);
			$this->db->select('*');
			$this->db->from('students');
			$this->db->where($where);
			$count_studs	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">School : '.$s_name.'</h3>
			<h3 align="center">All Students ('.$count_studs.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Student Name</th>
								 <th style="border:1px solid #000; padding:5px;">Registration Number</th>
								 <th style="border:1px solid #000; padding:5px;">Phone Number</th>
								 <th style="border:1px solid #000; padding:5px;">IDNO</th>
								 <th style="border:1px solid #000; padding:5px;">Email</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													
													  $where="assigned_school=".$encrypt."";
													  $this->db->select('*');
													  $this->db->from('students');
													  $this->db->order_by('date_registered','desc');
													  $this->db->where($where);
													  $this->db->join('login', 'login.login_id = students.login_id');
													 $desc	=	$this->db->get()->result_array();
													 $i=1;
														foreach($desc as $row):
															 $student_id=$row['student_id'];
															 $student_name=$row['student_name'];
															 $student_phone=$row['student_phone'];
															 $student_idno=$row['student_idno'];
															 $student_email=$row['student_email'];
															 $student_course=$row['student_course'];
															 $req_number=$row['username'];
															 $login_id=$row['login_id'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.ucwords($student_name).'</td>
											<td style="border:1px solid #000; padding:5px;">'.strtoupper($req_number).'</td>
											<td style="border:1px solid #000; padding:5px; width:17%;">'.$student_phone.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$student_idno.'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$student_email.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}else{
			$this->db->select('*');
			$this->db->from('students');
			$count_studs	=	$this->db->count_all_results();
			$output = '
			<h3 align="center">All Students ('.$count_studs.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Student Name</th>
								 <th style="border:1px solid #000; padding:5px;">Registration Number</th>
								 <th style="border:1px solid #000; padding:5px;">Phone Number</th>
								 <th style="border:1px solid #000; padding:5px;">IDNO</th>
								 <th style="border:1px solid #000; padding:5px;">Email</th>
							 </tr>
						 </thead>
						 <tbody>';
							 
													
													 $this->db->select('*');
													 $this->db->from('students');
													 $this->db->order_by('date_registered','desc');
													 //$this->db->where($where);
													 $this->db->join('login', 'login.login_id = students.login_id');
													 $desc	=	$this->db->get()->result_array();
													 $i=1;
														foreach($desc as $row):
															 $student_id=$row['student_id'];
															 $student_name=$row['student_name'];
															 $student_phone=$row['student_phone'];
															 $student_idno=$row['student_idno'];
															 $student_email=$row['student_email'];
															 $student_course=$row['student_course'];
															 $req_number=$row['username'];
															 $login_id=$row['login_id'];
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.ucwords($student_name).'</td>
											<td style="border:1px solid #000; padding:5px;">'.strtoupper($req_number).'</td>
											<td style="border:1px solid #000; padding:5px; width:17%;">'.$student_phone.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$student_idno.'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$student_email.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
		}
		return $output;
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------
		//get_student attendances
	function get_attendances($id=""){
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$where="lecturer_id=".$encrypt."";
			$this->db->select('*');
			$this->db->from('attendances');
			//$this->db->order_by('date_registered','desc');
			$this->db->where($where);
			$this->db->group_by('a_code');
			$count_attendance=$this->db->count_all_results();
							
			$output = '
			<h3 align="center">All Attendances : ('.$count_attendance.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit</th>
								 <th style="border:1px solid #000; padding:5px;">Academic Year</th>
								 <th style="border:1px solid #000; padding:5px;">Course</th>
								 <th style="border:1px solid #000; padding:5px;">Added Date</th>
							 </tr>
						 </thead>
						 <tbody>';
							 $where="lecturer_id=".$encrypt."";
							 $this->db->select('*');
							 $this->db->from('attendances');
							 //$this->db->order_by('date_registered','desc');
							 $this->db->where($where);
							 $this->db->group_by('a_code');
							 $desc	=	$this->db->get()->result_array();
							 	$col=1;
								 foreach($desc as $row):
								  $at_id=$row['attendance_id'];
								  $student_id=$row['student_id'];
								  $unit_id=$row['unit_id'];
								  $course_id=$row['course_id'];
								  $semester_id=$row['semester_id'];
								  $date_added=$row['date_added'];
								  $a_code=$row['a_code'];
								  
								  $course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
								  $semester_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
								  $semester_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
								  $unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
								  $unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$col++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$unit_name.' ('.$unit_code.')</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$semester_year.' ('.$semester_name.')</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$course_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$date_added.'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
					
					return $output;
			
	}
		//-----------------------------------------------------------------------------------------------------------------------------
		//get_course general results
	function get_results($id=""){
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
			
			$where="lecturer_id=".$encrypt."";
			$this->db->select('*');
			$this->db->from('results');
			//$this->db->order_by('date_registered','desc');
			$this->db->where($where);
			$this->db->group_by('result_code');
			$count_result=$this->db->count_all_results();
							
			$output = '
			<h3 align="center">All Uploaded Results : ('.$count_result.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Unit</th>
								 <th style="border:1px solid #000; padding:5px;">Academic Year</th>
								 <th style="border:1px solid #000; padding:5px;">Course</th>
								 <th style="border:1px solid #000; padding:5px;">Added Date</th>
							 </tr>
						 </thead>
						 <tbody>';
							 $where="lecturer_id=".$encrypt."";
							 $this->db->select('*');
							$this->db->from('results');
							//$this->db->order_by('date_registered','desc');
							$this->db->where($where);
							$this->db->group_by('result_code');
							 $desc	=	$this->db->get()->result_array();
							 	$col=1;
								 foreach($desc as $row):
								  $result_id=$row['result_id'];
								  $student_id=$row['student_id'];
								  $unit_id=$row['unit_id'];
								  $course_id=$row['course_id'];
								  $semester_id=$row['semester_id'];
								  $date_added=$row['date_added'];
								  $r_code=$row['result_code'];
								  
								  $course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
								  $semester_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
								  $semester_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
								  $unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
								  $unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
								
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$col++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$unit_name.' ('.$unit_code.')</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$semester_year.' ('.$semester_name.')</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$course_name.'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.date('d/m/Y',$date_added).'</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
					
					return $output;
			
	}
		//-----------------------------------------------------------------------------------------------------------------------------
		
		//-----------------------------------------------------------------------------------------------------------------------------
		//generate downloadable file for view student attendances
function view_attendances($id){
	$id=$this->db->get_where('attendances', array('a_code' => $id));
	foreach($id->result() as $row):
	$id_code=$row->a_code;
	$lecturer_id=$row->lecturer_id;
	$course_id=$row->course_id;
	$unit_id=$row->unit_id;
	$semester_id=$row->semester_id;
	$date_added=$row->date_added;
	endforeach;
		$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
		$semester_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
		$semester_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
		$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
		$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
		$lec_name       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$lecturer_id))->row()->lecturer_name;
	$output = '
						<h4 align="center" style="text-decoration:underline;";>
													STUDENTS ATTENDANCE REPORT
						</h4>
				 <table width="100%" cellspacing="0" style="font-size:small;">
                                                            	<tr>
                                                                	<td><strong>ATTENDANCE ID:</strong></td>
                                                                    <td>'.$id_code.'</td>
                                                                    <td><strong>COURSE:</strong></td>
                                                                    <td>'.$course_name.'</td>
                                                                </tr>
                                                                
                                                            	<tr>
                                                                	<td><strong>UNIT:</strong></td>
                                                                    <td>'.$unit_name.' ('.$unit_code.')</td>
                                                                    <td><strong>ACADEMIC YEAR:</strong></td>
                                                                    <td>'.$semester_year.'('.$semester_name.')</td>
                                                                </tr>
                                                                
                                                            	<tr>
                                                                	<td><strong>DATE ADDED:</strong></td>
                                                                    <td>'.date('d/m/Y',$date_added).'</td>
                                                                    <td><strong>LECTURER:</strong></td>
                                                                    <td>'.ucwords($lec_name).'</td>
                                                                </tr>
                                                            </table>
															<hr style="border:1px solid #000;" />
															 <table width="100%" cellspacing="0" style=" font-size:small;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold; width:5%;">No.</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold; width:70%;">Student Name</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold;">Attendance (%)</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
															';
															$r=1;
															$is=$this->db->get_where('attendances', array('a_code' => $id_code));
															foreach($is->result() as $row):
															$student_id=$row->student_id;
															$a_perc=$row->a_percentage;
															$login_id       =	$this->db->get_where('students' , array('student_id'=>$student_id))->row()->login_id;
															$student_name       =	$this->db->get_where('students' , array('student_id'=>$student_id))->row()->student_name;
															$reg_number       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;
															
															$output.='<tr>
																<td style="border:1px solid #000; padding:5px;">'.$r++.'.</td>
																<td style="border:1px solid #000; padding:5px;">'.ucwords($student_name).' ('.$reg_number.')</td>
																<td style="border:1px solid #000; padding:5px;">'.$a_perc.'</td>
															</tr>';
															endforeach;
															$output.='
														</tbody>
													</table>';
		return $output;
}//end
//----------------------------------------------------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------------------------------------
		//student print lecturers and the units assigned to them function
	function print_lecs($id=""){
		$encrypt=urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode(urldecode(base64_decode($id))))))));
		$where="assigned_school=".$encrypt."";
		$this->db->select('*');
		$this->db->from('lecturers');
		//$this->db->order_by('date_registered','desc');
		$this->db->where($where);
		$count_lecs=$this->db->count_all_results();
		
		$output = '
			<h3 align="center">Lecturers : ('.$count_lecs.')</h3>
			<table width="100%" cellspacing="0" style="font-size:small;">
						 <thead>
							 <tr>
								 <th style="border:1px solid #000; padding:5px; text-align:center;"><strong>#</strong></th>
								 <th style="border:1px solid #000; padding:5px;">Lecturer Name</th>
								 <th style="border:1px solid #000; padding:5px;">Phone Number</th>
								 <th style="border:1px solid #000; padding:5px;">Email</th>
								 <th style="border:1px solid #000; padding:5px;">Units Assigned</th>
							 </tr>
						 </thead>
						 <tbody>';
							$where="assigned_school=".$encrypt."";
							$this->db->select('*');
							$this->db->from('lecturers');
							$this->db->order_by('date_registered','desc');
							$this->db->where($where);
							$this->db->join('login', 'login.login_id = lecturers.login_id');
							$desc	=	$this->db->get()->result_array();
							$i=1;
                                 foreach($desc as $row):
								 $lecturer_id=$row['lecturer_id'];
								 $lecturer_name=$row['lecturer_name'];
								 $lecturer_phone=$row['lecturer_phone'];
								 $lecturer_idno=$row['lecturer_idno'];
								 $lecturer_email=$row['lecturer_email'];
								 $login_id=$row['login_id'];
								 $unit_id=$this->db->get_where('manage_units' , array('lecturer_id'=>$lecturer_id))->row()->lecturer_unit_id;
								$output .= '<tr>
											<td style="border:1px solid #000; padding:5px; text-align:center; width:6%;"><strong>'.$i++.'</strong>.</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.ucwords($lecturer_name).'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">'.$lecturer_phone.'</td>
											<td style="border:1px solid #000; padding:5px; width:30%;">'.$lecturer_email.'</td>
											<td style="border:1px solid #000; padding:5px; width:20%;">';
											
												$ol="lecturer_id=".$lecturer_id."";
												$this->db->select('*');
												$this->db->from('manage_units');
												$this->db->where($ol);
												$count_units	=	$this->db->count_all_results();
                                                                                    
                                                     if($count_units!='0'){
														 $where="lecturer_id=".$lecturer_id."";
														 $this->db->select('*');
														 $this->db->from('manage_units');
														 //$this->db->group_by('lecturer_id');
														 $this->db->where($where);
														 $this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
																$desc	=	$this->db->get()->result_array();
																//$i=1;
																foreach($desc as $row):
																	$unit_code=$row['unit_code'];
																	$output .= '<span style="background-color:#000000; font-weight:bold; padding:5px; color:#fff;"> '.$unit_code.'</span> ';
																endforeach;
														}
											
											$output .='</td>
										</tr>';
									
								endforeach;
						 $output .= '</tbody>
					</table>';
					
					return $output;
	}

	
	 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
		//$this->check_session();
		if($type=='user'){
		//check whether file exists
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else//if not, replace with a temporary image
            $image_url = base_url() . 'uploads/temp.jpg';

        return $image_url;
		}
		
		//checking logo image
		if($type=='logo'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/temp_logo.png';

        return $image_url;
		}
		
		//checking school logo image
		if($type=='school'){
        if (file_exists('uploads/' . $type . '_image/'.$id.'.jpg'))
            $image_url = base_url() . 'uploads/'.$type.'_image/'. $id .'.jpg';
        else
            $image_url = base_url() . 'uploads/temp_school.png';

        return $image_url;
		}
    }


}//end download model