<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {


//----------------------------------------------------------------------------------------------------------------------------

	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url(), 'refresh');
		}
	}
//generate_result student result function

public function generate_result($p1="",$p2=""){
	$id		 =	$this->session->userdata('id');
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

//end of student model class bracket
}