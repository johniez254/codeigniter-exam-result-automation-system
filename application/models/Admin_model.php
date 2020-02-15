<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {


//----------------------------------------------------------------------------------------------------------------------------

	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url(), 'refresh');
		}
	}
//departments crud
public function department_crud($p1='',$p2=''){
	//add dpt data to db
	if($p1=="add"){
		$add_data = array(
				'department_name' => $this->input->post('d_name'),
				'school_id' => $this->input->post('s2example-2'),
				'date_added' => strtotime($this->input->post('posted_date')),
			);
				$status = $this->db->insert('departments', $add_data);		
				return ($status == true ? true : false);
	}
	
	//update dpt
		if($p1=="update"){
			$update_data = array(
				'department_name' => $this->input->post('u_d_name'),
				'school_id' => $this->input->post('u_school'),
			);
				$this->db->where('dept_id',$p2);
				$status = $this->db->update('departments', $update_data);		
				return ($status == true ? true : false);
		}
	//if add modal add course
	if($p1=="update_course"){
		$add_data = array(
				'dept_id' => $p2,
				'programme_type' => $this->input->post('p_a_type'),
				'course_name' => $this->input->post('c_a_name'),
				'school_id' => $this->input->post('m_a_school'),
			);
			
				$inserted_course = $this->db->insert('courses', $add_data);
				
					$update_department = array(
							'added_course' => 1,
						);
				
				$this->db->where('dept_id',$p2);
				
				$updated_department=$this->db->update('departments',$update_department);
						
				//return ($status == true ? true : false);
				if($inserted_course && $updated_department){
					return true;
				}
	}//end update course
}

//----------------------------------------------------------------------------------------------------------------------------

//school model functions
public function schools_crud($p1='',$p2=''){
	//add school data to db
	if($p1=="add"){
		$add_data = array(
				'school_name' => $this->input->post('s_name'),
				'school_abbr' => $this->input->post('abbr'),
				'date_added' => strtotime($this->input->post('posted_date')),
			);
				$status = $this->db->insert('schools', $add_data);		
				return ($status == true ? true : false);
	}
	
	//update school
		if($p1=="update"){
			$update_data = array(
				'school_name' => $this->input->post('u_s_name'),
				'school_abbr' => $this->input->post('u_abbr'),
			);
				$this->db->where('school_id',$p2);
				$status = $this->db->update('schools', $update_data);		
				return ($status == true ? true : false);
		}
}

//----------------------------------------------------------------------------------------------------------------------------

//grades model functions
public function grades_crud($p1='',$p2=''){
	//add grade data to db
	if($p1=="add"){
		$add_data = array(
				'grade' => strtoupper($this->input->post('grade')),
				'start_mark' => $this->input->post('s_mark'),
				'end_mark' => $this->input->post('e_mark'),
				'grade_description' => $this->input->post('g_description'),
			);
				$status = $this->db->insert('grades', $add_data);		
				return ($status == true ? true : false);
	}
	
	
	//if update
	if($p1=="update"){
			$gid=$this->input->post('ugid');
			$grade=$this->input->post('ugrade');
			$s_mark=$this->input->post('usmark');
			$e_mark=$this->input->post('uemark');
			$g_desc=$this->input->post('ugdesk');
			for($s=0; $s<count($gid); $s++) {
			$data=array();
			$data[$s] = array(
						'grade_id'=>$gid[$s],
           				'grade'=>$grade[$s], 
						'start_mark'=>$s_mark[$s], 
						'end_mark'=>$e_mark[$s],
						'grade_description'=>$g_desc[$s],  
						);			
			$this->db->update_batch('grades',$data,'grade_id');
			}
			return true;
	}
}

//-------------------------------------------------------------------------------------------------------------------



//post course data
public function courses_crud($p1="",$p2=""){
	//add course data to db
	if($p1=="add"){
		$add_data = array(
				'dept_id' => $this->input->post('dpt'),
				'programme_type' => $this->input->post('p_type'),
				'course_name' => $this->input->post('c_name'),
				'school_id' => $this->input->post('s2example-2'),
			);
			
				$inserted_course = $this->db->insert('courses', $add_data);
				
					$update_department = array(
							'added_course' => 1,
						);
				
				$this->db->where('dept_id',$this->input->post('dpt'));
				
				$updated_department=$this->db->update('departments',$update_department);
						
				//return ($status == true ? true : false);
				if($inserted_course && $updated_department){
					return true;
				}
	}
	//update course data to db
	if($p1=="update"){
		$selected_department=$this->input->post('u_dpt');
		$previous_department=$this->input->post('p_dpt');
		$update_data = array(
				'dept_id' => $selected_department,
				'programme_type' => $this->input->post('u_p_type'),
				'course_name' => $this->input->post('u_c_name'),
				'school_id' => $this->input->post('u_school'),
			);
				$this->db->where("course_id",$p2);
				$status = $this->db->update('courses', $update_data);
				
				if($selected_department==$previous_department){
					return true;
				}else{
						$update_previous_department = array(
								'added_course' => 0,
							);
				
							$this->db->where('dept_id',$previous_department);
						
						$updated_previous_department=$this->db->update('departments',$update_previous_department);
						
							$update_selected_department = array(
										'added_course' => 1,
									);
							
							$this->db->where('dept_id',$selected_department);
						
						$updated_selected_department=$this->db->update('departments',$update_selected_department);
				
					if($updated_previous_department && $updated_selected_department){
						return true;
					}
				
				}
						
				//return ($status == true ? true : false);
	}
}//end courses
//-------------------------------------------------------------------------------------------------------------------
	
//units crud post
	public function units_crud($p1="",$p2=""){
		//add units
		if($p1=="add"){
			$add_data = array(
				'unit_name' => $this->input->post('u_name'),
				'unit_code' => $this->input->post('u_code'),
				'school_id' => $this->input->post('s2example-2'),
				'course_id' => $this->input->post('s_course'),
				'posted_date' => strtotime($this->input->post('posted_date')),
			);
				$status = $this->db->insert('units', $add_data);		
				return ($status == true ? true : false);
	}
		//update units
		if($p1=="update"){
			
			$update_data = array(
				'unit_name' => $this->input->post('m_u_name'),
				'unit_code' => $this->input->post('m_u_code'),
				'school_id' => $this->input->post('m_u_school'),
				'course_id' => $this->input->post('m_u_course'),
			);
				$this->db->where('unit_id',$p2);
				$status = $this->db->update('units', $update_data);		
				return ($status == true ? true : false);
		}
		
		//assign unit to lecturer
		if($p1=="unit_assign_update"){
			$data=array(
				"lecturer_unit_id"=>$p2,
				"lecturer_id"=>$this->input->post('m_lecturer'),
			);
				$status = $this->db->insert('manage_units', $data);
				
				$update_data=array(
					"assigned_to_lec"=>1,
				);
				
				//update units
				$this->db->where("unit_id",$p2);
				$update=$this->db->update("units",$update_data);
				
				if($status && $update){		
				return true;
			}
		}
	}
	
	//---------------------------------------------------------------------------------------------------------------------
	
		
//semester crud post
	public function semester_crud($p1="",$p2=""){
		//add semester
		if($p1=="add"){
			//split dutration dates
			$duration_start=substr($this->input->post('s_m'),0,10);
			$duration_end=substr($this->input->post('s_m'),13);
			
			$add_data = array(
				'semester_year' => $this->input->post('yr'),
				'semester_name' => $this->input->post('s2example-1'),
				'duration_from' => $duration_start,
				'duration_to' => $duration_end,
			);
				$status = $this->db->insert('semesters', $add_data);		
				return ($status == true ? true : false);
	}
		//update semesters
		if($p1=="update"){
			$duration_start=substr($this->input->post('d_range'),0,10);
			$duration_end=substr($this->input->post('d_range'),13);
			$update_data = array(
				'semester_year' => $this->input->post('ac_year'),
				'semester_name' => $this->input->post('m_sem'),
				'duration_from' => $duration_start,
				'duration_to' => $duration_end,
			);
				$this->db->where('semester_id',$p2);
				$status = $this->db->update('semesters', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	//---------------------------------------------------------------------------------------------------------------------
	
	//start student crud post
	public function students_crud($p1="",$p2=""){
		
		if($p1=="add"){
		
			//encrypt password
			$encrypted_password=password_hash($this->input->post('idno'),PASSWORD_DEFAULT);
			$edited_regno=str_replace('_','',$this->input->post('reg_no'));
			
			//student login array
			$add_student_login_data = array(
				'username' => strtoupper($edited_regno),
				'name' => $this->input->post('s_name'),
				'password' => $encrypted_password,
				'role'=>'student',
			);
			
			 //post login
			 $added_student_login_data=$this->db->insert('login',$add_student_login_data);
			 
			 //get last id
			 $last_insert = $this->db->insert_id();
			
			//student reg array
			$add_student_data = array(
				'student_name' => $this->input->post('s_name'),
				'student_phone' => $this->input->post('s_phone'),
				'student_idno' => $this->input->post('idno'),
				'student_address'=>$this->input->post('address'),
				'student_email'=>$this->input->post('email'),
				'student_gender'=>$this->input->post('gender'),
				'assigned_school'=>$this->input->post('s2example-2'),
				'programme_type'=>$this->input->post('p_type'),
				'student_course'=>$this->input->post('s2example-3'),
				'date_registered'=>strtotime($this->input->post('date_reg')),
				'login_id'=>$last_insert,
			);
			
			$added_student_data=$this->db->insert('students',$add_student_data);
			
			if($added_student_data && $added_student_login_data){
				return true;
			}else{
				return false;
			}
		}//end add student
		
		//if update
		if($p1=="update"){
			//student login array
			$update_student_login_data = array(
				'username' => strtoupper($this->input->post('u_reg_no')),
				'name' => $this->input->post('u_s_name'),
			);
			
			 //update login
			 $this->db->where('login_id',$this->input->post('login_id'));
			 $updated_student_login_data=$this->db->update('login',$update_student_login_data);
			 
			
			//student reg array
			$update_student_data = array(
				'student_name' => $this->input->post('u_s_name'),
				'student_phone' => $this->input->post('u_s_phone'),
				'student_idno' => $this->input->post('u_idno'),
				'student_address'=>$this->input->post('u_address'),
				'student_email'=>$this->input->post('u_email'),
				'student_gender'=>$this->input->post('u_gender'),
				'assigned_school'=>$this->input->post('u_school'),
				'programme_type'=>$this->input->post('u_p_type'),
				'student_course'=>$this->input->post('u_course'),
			);
			
			$this->db->where('student_id',$p2);
			$updated_student_data=$this->db->update('students',$update_student_data);
			
			if($updated_student_data && $updated_student_login_data){
				return true;
			}else{
				return false;
			}
		}
			
	}//student crud post
	
	//---------------------------------------------------------------------------------------------------------------------
	//generate_result student result function

	public function generate_result($p1="",$p2="",$p3=""){
		$id		 =	$p3;
		$username      =	$this->db->get_where('login' , array('login_id'=>$id))->row()->username;
		$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
		
		//get attached school
		$student_id=$this->db->get_where('students', array('login_id' => $id));
				foreach($student_id->result() as $row):$assigned_school=$row->assigned_school;endforeach;
		//get school details
		$school       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
		$dept_id       =	$this->db->get_where('departments' , array('school_id'=>$assigned_school))->row()->dept_id;
		$course_id=$this->db->get_where('students' , array('login_id'=>$id))->row()->student_course;
		$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
		
		//get semester credentials
		$sem=$this->db->get_where('semesters', array('semester_id' => $p2));
				foreach($sem->result() as $row):$semester_year=$row->semester_year;$semester_name=$row->semester_name;endforeach;
		
		$where=array('semester_id'=>$p2,'student_id'=>$p1);
					$this->db->select('*');
					$this->db->from('results');
					$this->db->where($where);
					$this->db->join('units', 'units.unit_id = results.unit_id');
					$desc	=	$this->db->get()->result_array();
					
					$output = '
					 <table width="100%" cellspacing="0" style="font-size:small;">
																	<tr>
																		<td><strong>NAME:</strong></td>
																		<td>'.$name.'</td>
																		<td><strong>REG NO:</strong></td>
																		<td>'.$username.'</td>
																	</tr>
																	
																	<tr>
																		<td><strong>SCHOOL OF:</strong></td>
																		<td>'.$school.'</td>
																		<td><strong>COURSE:</strong></td>
																		<td>'.$course_name.'</td>
																	</tr>
																	
																	<tr>
																		<td><strong>ACADEMIC YEAR:</strong></td>
																		<td>'.$semester_year.'</td>
																		<td><strong>SEMESTER:</strong></td>
																		<td>'.$semester_name.'</td>
																	</tr>
																</table>
																<hr style="border:1px solid #000;" />
					<table width="100%" cellspacing="0" style="font-size:small;">
									<thead>
										<tr>
											<th width="15%" style="border:1px solid #000; padding:5px;">Unit Code</th>
											<th style="border:1px solid #000; padding:5px;">Unit Name</th>
											<th width="15%" style="border:1px solid #000; padding:5px;">Grades</th>
										</tr>
									</thead>
							
								   <tbody>';
					
						foreach($desc as $row):
							$unit_code=$row['unit_code'];
							$unit_name=$row['unit_name'];
							$grade=$row['grade'];
							
							$output .= '<tr>
											<td style="border:1px solid #000; padding:5px;">'.$unit_code.'</td>
											<td style="border:1px solid #000; padding:5px;">'.$unit_name.'</td>';
											if($grade=="E"){
											$output .= '<td style="border:1px solid #000; padding:5px;">'.$grade.' *</td>';
											}
											else{
												$output .= '<td style="border:1px solid #000; padding:5px;">'.$grade.'</td>';
											}
											endforeach;
										$output .= '</tr>';
										
										//count all those in attendance but did not reach the target attendance percentage
										$where=array('semester_id'=>$p2,'student_id'=>$p1,'a_percentage <'=>"75");
										$this->db->select('*');
										$this->db->from('attendances');
										$this->db->where($where);
										$count_a_attendance=$this->db->count_all_results();
										
										if($count_a_attendance!="0"){
											$where=array('semester_id'=>$p2,'student_id'=>$p1,'a_percentage <'=>"75");
											$this->db->select('*');
											$this->db->from('attendances');
											$this->db->where($where);
											$this->db->join('units', 'units.unit_id = attendances.unit_id');
											$desc	=	$this->db->get()->result_array();
												foreach($desc as $row):
													$a_unit_code=$row['unit_code'];
													$a_unit_name=$row['unit_name'];
													$output .= '
													<tr>
														<td style="border:1px solid #000; padding:5px;">'.$a_unit_code.'</td>
														<td style="border:1px solid #000; padding:5px;">'.$a_unit_name.'</td>
														<td style="border:1px solid #000; padding:5px;">**</td>
													</tr>
													';
											endforeach;
										}
										
										$output.='<tr style="padding:10px;">
											<td colspan="3"><hr style="border:1px solid #000;"></td>
										</tr>
										
										';
										
						
						$where=array('semester_id'=>$p2,'student_id'=>$p1);
						$this->db->select_sum('total_marks');
						$this->db->from('results');
						$this->db->where($where);
						$desc=$this->db->get()->result_array();
						$total=0;
							foreach($desc as $row):
								$total+=$row['total_marks'];
							endforeach;
							
						//count 
						$where=array('semester_id'=>$p2,'student_id'=>$p1);
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
							$output .='<tr>
								<td colspan="2"  style="padding:5px; text-align:right;">
									<strong>AVERAGE GRADE: </strong>
								</td>
								<td style="padding:5px;">
									<strong> '.$ave_grade.' </strong>
								</td>
							</tr>
							';
						
							$output .='<tr>
								<td colspan="2" style="padding:5px; text-align:right;">
									<strong>CLASS: </strong>
								</td>
								<td style="padding:5px;"><strong>';
								if($ave_grade=="A"){
								$output .='First Class</strong></td>';
								}
								if($ave_grade=="B"){
									$output .='<strong>Second Upper</strong></td>';
								}
								if($ave_grade=="C"){
									$output .='<strong>Second Lower</strong></td>';
								}
								if($ave_grade=="D"){
									$output .='<strong>Pass</strong></td>';
								}
								if($ave_grade=="E"){
									$output .='<strong>Fail *';
								}
							$output .='</strong></td></tr>
							';
									$output .='
							</tbody>';
							
						
						$output .= '</table>
						<hr style="border:1px solid #000;" />
						<div style="font-size:smaller">
						<div style="width:60%; float:left">
						<table cellspacing="0" style="border:none;  width:60%; font-size:small;">
																				<thead>
																					<tr>
																						<td colspan="2"><strong>KEY TO GRADING SYSTEM</strong></td>
																					</tr>
																				</thead>
																				<tbody>
																					<tr>
																						<td>70% and Above</td>
																						<td>A (Excellent)</td>
																					</tr>
																					
																					<tr>
																						<td>60% - 69%</td>
																						<td>B (Good)</td>
																					</tr>
																					
																					<tr>
																						<td>50% - 59%</td>
																						<td>C (Average)</td>
																					</tr>
																					
																					<tr>
																						<td>40% - 49%</td>
																						<td>D (Pass)</td>
																					</tr>
																					
																					<tr>
																						<td>39% and Below</td>
																						<td>E (Fail)</td>
																					</tr>
																				</tbody>
																			</table>
																	</div>
																	<div style="float:right;">
																	<table cellspacing="0" style="border:none; font-size:small; width:40%;">
																				<thead>
																					<tr>
																						<td colspan="2"><strong>KEY TO LETTERS</strong></td>
																					</tr>
																				</thead>
																				<tbody>
																					<tr>
																						<td><strong>*</strong></td>
																						<td>Supplemmentary</td>
																					</tr>
																					
																					<tr>
																						<td><strong>**</strong></td>
																						<td>Incomplete</td>
																					</tr>
																					
																					<tr>
																						<td>W</td>
																						<td>Withdrawal</td>
																					</tr>
																				</tbody>
																			</table>
																	</div>
																	</div>
						';
						return $output;
	}

//----------------------------------------------------------------------------------------------------------------------------

	//---------------------------------------------------------------------------------------------------------------------
	
	//start lecturer crud post
	public function lecturers_crud($p1="",$p2=""){
		
		if($p1=="add"){
		
			//encrypt password
			$encrypted_password=password_hash($this->input->post('idno'),PASSWORD_DEFAULT);
			$edited_regno=str_replace('_','',$this->input->post('reg_no'));
			
			//lecturer login array
			$add_lecturer_login_data = array(
				'username' => strtoupper($edited_regno),
				'name' => $this->input->post('l_name'),
				'password' => $encrypted_password,
				'role'=>'lecturer',
			);
			
			 //post login
			 $added_lecturer_login_data=$this->db->insert('login',$add_lecturer_login_data);
			 
			 //get last id
			 $last_insert = $this->db->insert_id();
			
			//student reg array
			$add_lecturer_data = array(
				'lecturer_name' => $this->input->post('l_name'),
				'lecturer_phone' => $this->input->post('l_phone'),
				'lecturer_idno' => $this->input->post('idno'),
				'lecturer_address'=>$this->input->post('address'),
				'lecturer_email'=>$this->input->post('email'),
				'lecturer_gender'=>$this->input->post('gender'),
				'assigned_school'=>$this->input->post('s2example-2'),
				'date_registered'=>strtotime($this->input->post('date_reg')),
				'login_id'=>$last_insert,
			);
			
			$added_lecturer_data=$this->db->insert('lecturers',$add_lecturer_data);
			
			//get id lecturer last id insert
			$last_lecturer_insert_id = $this->db->insert_id();
			
			//add units to be thought by lecturer
			
			$unit_id=$this->input->post('s2example-5');
			$lecturer_id=$last_lecturer_insert_id;
			$assigned_unit=1;
			
			if(!empty($unit_id)){
				for($s=0; $s<count($unit_id); $s++) {
					$data_unit=array();
					$data_unit[$s] = array(
								'unit_id'=>$unit_id[$s],
								'assigned_to_lec'=>$assigned_unit,  
								);			
					$this->db->update_batch('units',$data_unit,'unit_id');
					}
					
				foreach($unit_id as $unit){
					$data=array(
						"lecturer_unit_id"=>$unit,
						"lecturer_id"=>$lecturer_id,
					);
					$added_units_data=$this->db->insert('manage_units',$data);
				}
			}
			
			if($added_lecturer_data && $added_lecturer_login_data){
				return true;
			}else{
				return false;
			}
		}//end add student
		
		//if update
		if($p1=="update"){
			//lecturer login array
			$update_lecturer_login_data = array(
				//'username' => strtoupper($this->input->post('u_reg_no')),
				'name' => $this->input->post('u_l_name'),
			);
			
			 //update login
			 $this->db->where('login_id',$this->input->post('login_id'));
			 $updated_lecturer_login_data=$this->db->update('login',$update_lecturer_login_data);
			 
			
			//lecturer reg array
			$update_lecturer_data = array(
				'lecturer_name' => $this->input->post('u_l_name'),
				'lecturer_phone' => $this->input->post('u_l_phone'),
				'lecturer_idno' => $this->input->post('u_idno'),
				'lecturer_address'=>$this->input->post('u_address'),
				'lecturer_email'=>$this->input->post('u_email'),
				'lecturer_gender'=>$this->input->post('u_gender'),
				'assigned_school'=>$this->input->post('u_school'),
			);
			
			$this->db->where('lecturer_id',$p2);
			$updated_lecturer_data=$this->db->update('lecturers',$update_lecturer_data);
			
			if($updated_lecturer_data && $updated_lecturer_login_data){
				return true;
			}else{
				return false;
			}
		}
			
	}//lecturer crud post
	
	//---------------------------------------------------------------------------------------------------------------------
	
	//check whether the unit name to be added is already assigned to selected course
	function check_unit_name_status($unit_name,$course_id){
		$cs=array("unit_name"=>$unit_name,"course_id"=>$course_id);
		$this->db->select('*');
		$this->db->from('units');
		$this->db->where($cs);
		$count_units	=	$this->db->count_all_results();
		if($count_units=="0"){
			return true;
		}else{
			return false;
		}
	}
	
	//check whether the unit code to be added is already assigned to selected course
	function check_unit_code_status($unit_code,$course_id){
		$cs=array("unit_code"=>$unit_code,"course_id"=>$course_id);
		$this->db->select('*');
		$this->db->from('units');
		$this->db->where($cs);
		$count_units	=	$this->db->count_all_results();
		if($count_units=="0"){
			return true;
		}else{
			return false;
		}
	}
	
	//---------------------------------------------------------------------------------------------------------------------
	
	//update settings
	public function settings_post($settingsId='1'){
		if($settingsId){
			$update_data = array(
				'system_name' => $this->input->post('sname'),
				'system_abbr' => $this->input->post('abr'),
				'system_email' => $this->input->post('email'),
				'system_phone'=>$this->input->post('phone'),
				'system_address'=>$this->input->post('address'),
				'institution'=>$this->input->post('institution'),
			);
				$this->db->where('system_id', $settingsId);
				$status = $this->db->update('settings', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	//----------------------------------------------------------------------------------------------------------------
	
	//update personal profile	
	public function profile_post($userId=null){
		if($userId){
			$update_data = array(
				'username' => $this->input->post('username'),
				'name' => $this->input->post('name'),
			);
				$this->db->where('login_id', $userId);
				$status = $this->db->update('login', $update_data);		
				return ($status == true ? true : false);
		}
	}
	
	//-------------------------------------------------------------------------------------------------------------
	
	//update password function
	public function password_post($userId=null){
		if($userId){
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);			
				$data=array(
				'password'=>$newpass,
				);
				$this->db->where('login_id',$userId);
				$status=$this->db->update('login',$data);
				return ($status == true ? true : false);
			}
	}
	
	//validate pinputed password
	public function password_validate($password = null)
	{
		if($password) {
			$oldpass=$this->input->post('oldpass');
			$newpass=password_hash($this->input->post('newpass'),PASSWORD_DEFAULT);
			$username=$this->input->post('username');
			
			$query=$this->db->get_where('login', array('username' => $username))->result_array();
			foreach($query as $row):
				$fetched_pass=$row['password'];
			endforeach;
			
			if(password_verify($oldpass,$fetched_pass)){
				
				$this->db->where('username', $username);
				$this->db->where('password', $fetched_pass);
				$query=$this->db->get('login');
				
				return ($query->num_rows() === 1 ? true : false);
			}
		}	
		else {
			return false;
		}
	} // /validate password function
	
	 ////////IMAGE URL//////////
    function get_image_url($type = '', $id = '') {
		$this->check_session();
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
		
		//checking logo image
		if($type=='school'){
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/temp_school.png';

        return $image_url;
		}
    }
	
		/////////Backup Data SQL FILE//////////
	
	function create_backup($param2)

	{

		$this->load->dbutil();
		

		$options = array(

                'format'      => 'txt',             // gzip, zip, txt

                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file

                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file

                'newline'     => "\n"               // Newline character used in backup file

              );

		

		 

		if($param2 == 'all')

		{

			$tables = array('');

			$file_name	=	'system_backup';

		}

		else 

		{

			$tables = array('tables'	=>	array($param2));

			$file_name	=	'backup_'.$param2;

		}

		$backup =& $this->dbutil->backup(array_merge($options , $tables)); 


		//$this->load->helper('download');

		force_download($file_name.'.sql', $backup);

	}

function report_post(){
	$toa=$this->input->post('s2example-5');
			foreach($toa as $to){
				$data=array(
					"unit_id"=>$to,
					"lecturer_id"=>"1",
				);
				$insert=$this->db->insert('manage_units',$data);
			}
			
			if($insert){return true;}else{return false;}
}

//end of Admin model class bracket
}