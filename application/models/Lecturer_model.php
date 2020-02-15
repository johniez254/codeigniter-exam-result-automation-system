<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecturer_model extends CI_Model {
	
//----------------------------------------------------------------------------------------------------------------------------
//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url(), 'refresh');
		}
	}
//results function model operations
function result_crud($p1="",$p2=null){
	//post results to db
	if($p1=="add"){
		$course=$this->input->post('s2example-7');
		$unit=$this->input->post('s2example-8');
		$ac_year=$this->input->post('s2example-6');
		$Student_id=$this->input->post('name');
		$cat=$this->input->post('cat');
		$final=$this->input->post('final');
		$total=$this->input->post('total');
		$grade=$this->input->post('grade');
		$lecturer_id=$this->input->post('lect_id');
		$d_added=strtotime($this->input->post('d_added'));
		$result_code=$rand=substr(md5(microtime()),rand(0,26),6);
		
		
		for($i=0; $i<count($Student_id); $i++) {
				$da =array();
					$da[$i] = array(
           				'student_id' => $Student_id[$i], 
           				'course_id' => $course, 
           				'unit_id' => $unit,
           				'cat_marks'=>$cat[$i],
						'final_marks'=>$final[$i],
						'total_marks'=>$total[$i],
						'grade'=>$grade[$i],
						'lecturer_id'=>$lecturer_id,
						'semester_id'=>$ac_year,
						'date_added'=>$d_added,
						'result_code'=>$result_code,
           			);		   
			$this->db->insert_batch('results', $da);
			}
			return true;
	}
	//updatestudent
	if($p1=="update"){
		$course=$this->input->post('course_id');
		$unit=$this->input->post('s2example-8');
		$ac_year=$this->input->post('s2example-6');
		$Student_id=$this->input->post('name');
		$cat=$this->input->post('cat');
		$final=$this->input->post('final');
		$total=$this->input->post('total');
		$grade=$this->input->post('grade');
		$result_id=$this->input->post('r_id');
			for($s=0; $s<count($result_id); $s++) {
			$data=array();
			$data[$s] = array(
						'result_id'=>$result_id[$s],
           				'course_id'=>$course, 
						'unit_id'=>$unit, 
						'semester_id'=>$ac_year,
						'cat_marks'=>$cat[$s],
						'final_marks'=>$final[$s],
						'total_marks'=>$total[$s],
						'grade'=>$grade[$s],    
						);			
			$this->db->update_batch('results',$data,'result_id');
			}
			return true;
		
	}
	//fetch Student 
	if($p1=="fetchStudentData"){
		if($p2) {
			$sql = "SELECT * FROM students WHERE student_course = ?";
			$query = $this->db->query($sql, array($p2));
			return $query->row_array();
		} 
		else {
			$sql = "SELECT * FROM students";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
	}
}
//----------------------------------------------------------------------------------------------------------------------------
//add attendance data to db
public function attendance_crud($p1="",$p2=""){
	//if add
	if($p1=="add"){
		$course=$this->input->post('s2example-7');
		$unit=$this->input->post('s2example-8');
		$ac_year=$this->input->post('s2example-6');
		$Student_id=$this->input->post('name');
		$lecturer_id=$this->input->post('lect_id');
		$att=$this->input->post('att');
		$att_code=$rand=substr(md5(microtime()),rand(0,26),6);
		
		
		for($i=0; $i<count($Student_id); $i++) {
				$da =array();
					$da[$i] = array(
           				'student_id' => $Student_id[$i], 
           				'course_id' => $course, 
           				'unit_id' => $unit,
						'lecturer_id'=>$lecturer_id,
						'semester_id'=>$ac_year,
						'a_percentage'=>$att[$i],
						'a_code'=>$att_code,
           			);		   
			$this->db->insert_batch('attendances', $da);
			}
			return true;
	}//end add
	
}//end attendance crud function
//-----------------------------------------------------------------------------------------------------------------------------
function generate_result($p1){
	$result_code=$this->db->get_where('results', array('result_code' => $p1));
	foreach($result_code->result() as $row):
	$result_id=$row->result_id;
	$result_code=$row->result_code;
	$student_id=$row->student_id;
	$course_id=$row->course_id;
	$unit_id=$row->unit_id;
	$lecturer_id=$row->lecturer_id;
	$semester_id=$row->semester_id;
	$date_added=$row->date_added;
	endforeach;
	$lecturer_name       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$lecturer_id))->row()->lecturer_name;
	$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
	$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
	$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
	$sem_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
	$sem_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
	
	$assigned_school       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$lecturer_id))->row()->assigned_school;
	$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
	$output = '
				 <table width="100%" cellspacing="0" style="font-size:small;">
                                                            	<tr>
                                                                	<td><strong>RESULT ID:</strong></td>
                                                                    <td>'.$p1.'</td>
                                                                    <td><strong>COURSE:</strong></td>
                                                                    <td>'.$course_name.'</td>
                                                                </tr>
                                                                
                                                            	<tr>
                                                                	<td><strong>UNIT:</strong></td>
                                                                    <td>'.$unit_name.' ('.$unit_code.')</td>
                                                                    <td><strong>ACADEMIC YEAR:</strong></td>
                                                                    <td>'.$sem_year.'<br>Year: <b>'.substr($sem_name,0,1).'</b> Semester: <b>'.substr($sem_name,2).'</b>('.$sem_name.')</td>
                                                                </tr>
                                                                
                                                            	<tr>
                                                                	<td><strong>DATE ADDED:</strong></td>
                                                                    <td>'.date('d/m/Y',$date_added).'</td>
                                                                    <td><strong>LECTURER:</strong></td>
                                                                    <td>'.ucwords($lecturer_name).'</td>
                                                                </tr>
                                                            </table>
															<hr style="border:1px solid #000;" />
															 <table width="100%" cellspacing="0" style=" font-size:small;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold; width:5%;">No.</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold; width:40%;">Student Name</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold;">Cat Marks (30%)</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold;">Final Marks (70%)</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold;">Total Marks (100%)</td>
                                                                                        <td style="border:1px solid #000; padding:5px; font-weight:bold; text-align:center;">Grade</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
															';
															
															$where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
																					$this->db->select('*');
																					$this->db->from('results');
																					$this->db->where($where);
																					$count_result	=	$this->db->count_all_results();
																				
																				//get total cat marks for all students who  sat for the cat
																					$where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
																					$this->db->select_sum('cat_marks');
																					$this->db->from('results');
																					$this->db->where($where);
																					$desc=$this->db->get()->result_array();
																					$cat_total=0;
																					foreach($desc as $row):
																					$cat_total+=$row['cat_marks'];
																					endforeach;
																				
																				//get total marks for the final exxam
																					$where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
																					$this->db->select_sum('final_marks');
																					$this->db->from('results');
																					$this->db->where($where);
																					$desc=$this->db->get()->result_array();
																					$final_total=0;
																					foreach($desc as $row):
																					$final_total+=$row['final_marks'];
																					endforeach;
																				
																				//get total marks of final scores of students
																				$all_total=$cat_total+$final_total;
																				
																				//get average total
																				$ave_total=$all_total/$count_result;
																				
																				//get average grade
																				$round_ave_total=round($ave_total);
																				//get average grade
																				$where="".$round_ave_total." BETWEEN start_mark AND end_mark";
                                                								$this->db->select('grade');
																				$this->db->from('grades');
																				$this->db->where($where);
																				$desc	=	$this->db->get()->result_array();
																				foreach($desc as $row):
																				$ave_grade= $row['grade'];
																				endforeach;
																				
																						$where=array("lecturer_id"=>$lecturer_id,"result_code"=>$result_code);
																						$this->db->select('*');
																						$this->db->from('results');
																						$this->db->where($where);
																						$this->db->join('students', 'students.student_id = results.student_id');
																						$this->db->order_by('total_marks','desc');
																						$desc	=	$this->db->get()->result_array();
																						$r=1;
																						foreach($desc as $row):
																							$student_name=$row['student_name'];
                                                                                   			$cat_marks=$row['cat_marks'];
                                                                                   			$final_marks=$row['final_marks'];
                                                                                   			$total_marks=$row['total_marks'];
                                                                                   			$grade=$row['grade'];
																							$adm_no       =	$this->db->get_where('login' , array('name'=>$student_name))->row()->username;
																							$output.='<tr>
                                                                                        <td style="border:1px solid #000; padding:5px;">'.$r++.'.</td>
                                                                                        <td style="border:1px solid #000; padding:5px;">'.ucwords($student_name).' ('.$adm_no.')</td>
                                                                                        <td style="border:1px solid #000; padding:5px; text-align:right;">'.$cat_marks.'</td>
                                                                                        <td style="border:1px solid #000; padding:5px; text-align:right;">'.$final_marks.'</td>
                                                                                        <td style="border:1px solid #000; padding:5px; text-align:right;">'.$total_marks.'</td>
                                                                                        <td style="border:1px solid #000; padding:5px; text-align:center;">'.$grade.'</td>
                                                                                    </tr>';
                                                                                    endforeach;
                                                                                     $output.='<tr>
                                                                                        <td style=" padding:5px; text-align:right;" colspan="2"><strong>Total</strong></td>
                                                                                        <td style=" padding:5px; text-align:right;"><strong>'.$cat_total.'</strong></td>
                                                                                        <td style=" padding:5px; text-align:right;"><strong>'.$final_total.'</strong></h4></td>
                                                                                        <td style=" padding:5px; text-align:right;"><strong>'.$all_total.'</strong></td>
                                                                                        <td style=" padding:5px; text-align:right;"></td>
                                                                                    </tr>
                                                                                     <tr>
                                                                                        <td style=" padding:5px; text-align:right;" colspan="2"><strong>M.S.S</strong></td>
                                                                                        <td style="padding:5px; text-align:right;"><strong>'.round($cat_total/$count_result,2).'</strong></td>
                                                                                        <td style="padding:5px; text-align:right;"><strong>'.round($final_total/$count_result,2).'</strong></td>
                                                                                        <td style="padding:5px; text-align:right;"><strong>'.round($all_total/$count_result,2).'</strong></td>
                                                                                        <td style=" padding:5px; text-align:center;"><strong>'.$ave_grade.'</strong></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>';
		return $output;
}//end
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
		
		//checking school logo image
		if($type=='school'){
        if (file_exists('uploads/' . $type . '_image/'.$id.'.jpg'))
            $image_url = base_url() . 'uploads/'.$type.'_image/'. $id .'.jpg';
        else
            $image_url = base_url() . 'uploads/temp_school.png';

        return $image_url;
		}
    }

//end of Lecturer model class bracket
}