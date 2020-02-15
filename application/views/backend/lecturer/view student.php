<?php
foreach($course_id->result() as $row):
$co_i=$row->student_course;
$as_school=$row->assigned_school;
endforeach;

$cs="student_course=".$co_i."";
$this->db->select('*');
$this->db->from('students');
$this->db->where($cs);
$count_students	=	$this->db->count_all_results();
$course       =	$this->db->get_where('courses' , array('course_id'=>$co_i))->row()->course_name;

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
                                                            <i class="fa fa-home"></i> Students (<?php echo $count_students;?>)
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <div class="table-responsive">
                                                             <?PHP if($count_students!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/students/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($as_school))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm btn-disabled  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                                                <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Student Name</th>
                                                                            <th>Registration Number</th>
                                                                            <th>Phone Number</th>
                                                                            <th>Progamme Type</th>
                                                                            <th>Email</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                    <?php 
																	$i=1;
																	foreach($course_id->result() as $row):
																			$course_id=$row->student_course;
																			$student_id=$row->student_id;
																			$student_name=$row->student_name;
																			$student_phone=$row->student_phone;
																			$student_idno=$row->student_idno;
																			$student_address=$row->student_address;
																			$student_email=$row->student_email;
																			$student_gender=$row->student_gender;
																			$assigned_school=$row->assigned_school;
																			$programme_type=$row->programme_type;
																			$login_id=$row->login_id;
																			$date_added=$row->date_registered;
																			
																			$reg_number       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;
																			
																			
																			?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo ucwords($student_name)?></td>
                                                                            <td><?php echo strtoupper($reg_number)?></td>
                                                                            <td><?php echo $student_phone;?></td>
                                                                            <td><?php if($programme_type==1){echo "Masters";} ?><?php if($programme_type==2){echo "Degree";} ?><?php if($programme_type==3){echo "Diploma";} ?></td>
                                                                            <td><?php echo $student_email;?></td></td>
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
                      
                      
                      
                      