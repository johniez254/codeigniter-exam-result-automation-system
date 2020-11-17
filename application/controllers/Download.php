<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Download_model','down');
		
		$this->check_session();//check session
	}
	
	//for session check
	function check_session(){
        if ($this->session->userdata('logged_in') == FALSE){
            redirect(base_url(), 'refresh');
		}
	}
	
	//function set header of the pdf
	function get_set_header(){
		 $setting_id=$this->db->get_where('settings', array('system_id' => 1)); 
				foreach($setting_id->result() as $row):
												$id=$row->system_id;
												$system_name=$row->system_name;
												$abbr=$row->system_abbr;
												$address=$row->system_address;
												$em=$row->system_email;
												$phone=$row->system_phone;
												$institution=$row->institution;



                                 		endforeach;
										$s='school';
										$l='logo';
			
			$output ='
				<div>
					<div style="float:left; width:auto; height:auto; padding-right:5px;">
						<img src="'.$this->down->get_image_url($s,$l).'" width="20%" height="20%"/>
					</div>
					<div style="text-transform:uppercase; font-size:x-small;">
						<p><strong>Institution: </strong>'.$institution.'</p>
						<p><strong>Address: </strong>'.$address.'</p>
						<p><strong>Email: </strong> <a href="mailto:'.$em.'">'.$em.'</a></p>
						<p><strong>Phone: </strong>'.$phone.'</p>
						<p><strong>Date: </strong>'.date('d/M/Y').'</p>
					</div>
				</div>
				<hr style="border:1px solid #000;" />';
				
				return $output;
	}
	
	//admin print schools datatable
	function schools(){
		
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			$html_content .= $this->down->get_schools();
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Schools.pdf", array("Attachment"=>0));
	}
	
	//admin print departments datatable
	function departments($id=""){
		
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
			if($id){		
				$html_content .= $this->down->get_departments($id);
			}else{
				$html_content .= $this->down->get_departments();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Departments.pdf", array("Attachment"=>0));
	}
	
	
	
	//admin print courses datatable
	function courses($id=""){
		
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			if($id){		
				$html_content .= $this->down->get_courses($id);
			}else{
				$html_content .= $this->down->get_courses();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Courses.pdf", array("Attachment"=>0));
	}
	
	//admin print semesters datatable
	function semesters(){
		
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			$html_content .= $this->down->get_semesters();
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Semesters.pdf", array("Attachment"=>0));
	}

//admin print units datatable
	function units($id=""){
		
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			if($id){		
				$html_content .= $this->down->get_units($id);
			}else{
				$html_content .= $this->down->get_units();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Units.pdf", array("Attachment"=>0));
	}
	
	//admin print grades datatable
	function grades(){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			$html_content .= $this->down->get_grades();
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Grades.pdf", array("Attachment"=>0));
	}
	
	//admin print lecturers datatable
	function lecturers($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
					
			if($id){		
				$html_content .= $this->down->get_lecturers($id);
			}else{
				$html_content .= $this->down->get_lecturers();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Lecturers.pdf", array("Attachment"=>0));
	}
	
	//lecturer print only the units assigned
	function lecturer_units($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
			$html_content .= $this->down->get_lecturers_units($id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Units.pdf", array("Attachment"=>0));
	}
	
	//lecturer print only the units assigned
	function student_units($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
			$html_content .= $this->down->get_student_units($id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Units.pdf", array("Attachment"=>0));
	}
	
	//student print lecturers assigned units
	function print_lecs($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
			$html_content .= $this->down->print_lecs($id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Lecturers.pdf", array("Attachment"=>0));
	}
	
	//admin print students datatable
	function students($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
							
			if($id){		
				$html_content .= $this->down->get_students($id);
			}else{
				$html_content .= $this->down->get_students();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Students.pdf", array("Attachment"=>0));
	}
	
	
		
	//lecturer print students attendances
	function attendances($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
							
			if($id){		
				$html_content .= $this->down->get_attendances($id);
			}else{
				$html_content .= $this->down->get_attendances();
			}
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Attendance.pdf", array("Attachment"=>0));
	}
	
	
	//lecturer print students attendances
	function view_attendance($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();		
			$html_content .= $this->down->view_attendances($id);
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Attendance.pdf", array("Attachment"=>0));
	}
	
	
		//lecturer print students results
	function results($id=""){
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
							
			$html_content .= $this->down->get_results($id);
			
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Results.pdf", array("Attachment"=>0));
	}
	
	
		//admin print students results
	function unit_results(){
		$sem_id=$this->input->post('sem_id');
		$unit_id=$this->input->post('unit_id');
		$course_id=$this->input->post('course_id');
		//set header
		$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
			$html_content=$this->get_set_header();
							
			$html_content .= $this->down->get_unit_results($sem_id,$unit_id,$course_id);
			
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$canvas=$this->pdf->get_canvas();
			//$font=Font_Metrics::get_font("helvetica","bold");
			$canvas->page_text(500,10,"".$system_name."","",5,array(0,0,0));
			$canvas->page_text(300,760,"Page: {PAGE_NUM} of {PAGE_COUNT}","",7,array(0,0,0));
			$this->pdf->stream("Unit_Results.pdf", array("Attachment"=>0));
	}
	
//end class download	
}