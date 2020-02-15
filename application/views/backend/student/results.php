<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
$username      =	$this->db->get_where('login' , array('login_id'=>$id))->row()->username;
$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>
 <?php $student_id=$this->db->get_where('students', array('login_id' => $id)); ?>
									 
									    <?php foreach($student_id->result() as $row):
										$fn=$row->student_name;
										$email=$row->student_email;
										$phone=$row->student_phone;
										$address=$row->student_address;
										$idno=$row->student_idno;
										$assigned_school=$row->assigned_school;
										$student_course=$row->student_course;
									endforeach;?>
 <?php
  $school       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$dept_id       =	$this->db->get_where('departments' , array('school_id'=>$assigned_school))->row()->dept_id;

$course_name       =	$this->db->get_where('courses' , array('course_id'=>$student_course))->row()->course_name;
 
 ?>

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">View Result</h2>
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
												
                                                <!--start form-->
                                                
                                                <form action="<?php echo base_url()?>student/pdf" method="post" target="_blank">
                                                <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                                                	<div class="form-group">
                                                        		<label class="col-sm-2 control-label">Academic year: </label>
                                            
                                            					<div class="col-sm-10">

                                                                <select name="s2example-6" id="s2example-6"  onchange="return get_semester(this.value)">
                                                                    <option></option>
                                                                      <?php 
                                                                        //$where="school_id=".$assigned_school."";
																		$this->db->select('*');
																		$this->db->from('semesters');
																		$this->db->group_by('semester_year');
																		//$this->db->order_by('posted_date','desc');
																		//$this->db->where($where);
																		$s	=	$this->db->get()->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['semester_id'];?>">
                                                                            <?php echo $row['semester_year'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                            </div>
                                                            <br /><br />
                                                            <div class="form-group">
                                                            	<label class="col-sm-2 control-label">Select Semester :</label>
                                            
                                            					<div class="col-sm-10">
                                                                 <select name="s2example-1" id="s2example-1" onchange="return get_result(this.value)">
                                                                    <option></option>
                                                                      
                                                                    </select>
                                                                    </div>
                                                            </div>
                                                            <br />
                                                            <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                                            <div class="table-responsive">
                                                            <table class="table table-striped">
                                                            	<tr>
                                                                	<td><strong>NAME:</strong></td>
                                                                    <td><strong><?php echo ucwords($name);?></strong></td>
                                                                    <td><strong>REG NO:</strong></td>
                                                                    <td><?php echo $username;?></td>
                                                                </tr>
                                                                
                                                            	<tr>
                                                                	<td><strong>SCHOOL OF:</strong></td>
                                                                    <td><?php echo $school;?></td>
                                                                    <td><strong>COURSE:</strong></td>
                                                                    <td><?php echo $course_name;?></td>
                                                                </tr>
                                                            </table>
                                                            <br />
                                                                <table class="table table-hover table-condensed table-bordered" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="15%">Unit Code</th>
                                                                            <th>Unit Name</th>
                                                                            <th width="15%">Grades</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody class="result">
                                                                    
                                                                    </tbody>
                                                                </table>
                                                                <!-- ********************************************** -->
                                                                </div>
                                                                <hr style="border:1px solid #000;" />
                                                                <div class="row">
                                                                	<div class="col-md-6">
                                                                    	<table style="border:none; width:60%;">
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
                                                                    <div class="col-md-6">
                                                                    	<table style="border:none; width:60%;">
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
                                                                
                                                                <div class="row">
                                                                	<div class="col-md-12 col-sm-12 col-xs-12 text-center" style="display:none;" id="pdf_button">
                                                                    	<button type="submit" target="_blank" class="btn btn-danger btn-md"><i class="fa fa-file-pdf-o"></i> &nbsp; Download Result in PDF Format </button>
                                                                    </div>
                                                                </div>
                                                            
                                                </form>

                                                <!--end form-->

                                            </div>
                                            <div class="clearfix"><br></div>
                                            </div>
                                            
                                            
                                            
                                         </div>
                                     </div>
                                </div>
                          </section>
                      </div>
                      
                      
                      
                      