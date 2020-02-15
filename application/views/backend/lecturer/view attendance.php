<?php
foreach($a_code->result() as $row):
$a_cod=$row->a_code;
$c_id=$row->course_id;
endforeach;
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$lecturer_id       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->lecturer_id;

$cs=array("a_code="=>$a_cod);
$this->db->select('*');
$this->db->from('attendances');
$this->db->where($cs);
$count_attendance	=	$this->db->count_all_results();

$course       =	$this->db->get_where('courses' , array('course_id'=>$c_id))->row()->course_name;
$where="lecturer_id=".$lecturer_id."";
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
	$course_id=$row['course_id'];$semester_id=$row['semester_id'];
	$date_added=$row['date_added'];
	//$at_code=$row['a_code'];
		$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
		$semester_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
		$semester_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
		$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
		$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
	endforeach;
?>
																			
 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Course: <?php echo $course;?></h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">



                                        <!-- Horizontal - start -->
                                        <div class="row">
                                            <div class="col-md-12">

                                                <ul class="nav nav-tabs primary">
                                                    <li class="active">
                                                        <a href="#home-1" data-toggle="tab">
                                                            <i class="fa fa-home"></i> Students (<?php echo $count_attendance;?>)
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>
                                                        <h4><strong>School : <?php echo $school_name;?></strong></h4>
                                            <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                            				<div class="col-lg-12">
                                                            	<div class="row">
                                                                	<div class="col-md-6">
                                                                        <h3>Attendance Summary</h3>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h3 class="text-right"><a href="<?php echo base_url()?>download/view_attendance/<?php echo $a_cod?>" class="btn btn-info btn-lg" title="download attendance in pdf format" target="_blank"><i class="fa fa-print"></i> Print</a></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                        <div class="invoice-head">
                                                                            
                                                                            <div class="col-md-12 col-sm-12 col-xs-12 invoice-head-info">
                                                                            <span>
                                                                            <div class="table-responsive">
                                                                            	<table class="table invoice-table">
                                                                                	<tr>
                                                                                    	<td class="no-line" style="padding-left:15px;"><strong>Attendance ID:</strong></td>
                                                                                        <td class="no-line"><?php echo $a_cod; ?></td>
                                                                                    	<td style="padding-left:15px;"><strong>Course:</strong></td>
                                                                                        <td><?php  echo $course_name;?></td>
                                                                                    </tr>
                                                                                	<tr>
                                                                                    	<td style="padding-left:15px;"><strong>Unit:</strong></td>
                                                                                        <td><?php echo $unit_name;?> (<?php echo $unit_code; ?>)</td>
                                                                                        <td style="padding-left:15px;"><strong>Academic Year:</strong></td>
                                                                                        <td><?php echo $semester_year;?></strong> 
                                                                           <br /> <?php echo 'Year: <b>'.substr($semester_name,0,1).'</b>';?> Semester: <?php echo '<b>'.substr($semester_name,2).'</b>';?> (<?php echo $semester_name?>)</td>
                                                                                    </tr>
                                                                                	<tr>
                                                                                    	<td style="padding-left:15px;"><strong>Date Added:</strong></td>
                                                                                        <td><?php echo date('d'.'/'.'m'.'/'.'Y',$date_added); ?></td>
                                                                                    </tr>
                                                                                </table>
                                                                                </div>
                                                                              </span>
                                                                                
                                                                            </div>
                                                                            
                                                                            
                                                                        </div>

                                                            <div class="table-responsive">
                                                                <table id="edited" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Student Name</th>
                                                                            <th>Attendance %</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                    <?php 
																	$i=1;
																	foreach($a_code->result() as $row):
																			//$course_id=$row->course_id;
																			$student_id=$row->student_id;
																			//$unit_id=$row->unit_id;
																			$a_perc=$row->a_percentage;
																			
																			$login_id       =	$this->db->get_where('students' , array('student_id'=>$student_id))->row()->login_id;
																			$student_name       =	$this->db->get_where('students' , array('student_id'=>$student_id))->row()->student_name;
																			
																			$reg_number       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;
																			
																			
																			?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo ucwords($student_name)?> (<?php echo strtoupper($reg_number)?>)</td>
                                                                            <td><?php if($a_perc>=75){echo '<span class="badge badge-md badge-success">'.$a_perc.'%</span>';}else{echo'<span class="badge badge-md badge-danger">'.$a_perc.'%</span>';}?>
</td>
                                                                        </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                                <!-- ********************************************** -->
                                                                </div>


                                                        </div>

                                                    </div>
                                                    

                                                    
                                                </div>

                                            </div>
                                            <div class="clearfix"><br></div>
                                            </div>
                                            
                                            
                                            
                                         </div>
                                     </div>
                                </div>
                          </section>
                      </div>
                      
                      
                      
                      