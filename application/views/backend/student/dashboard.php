<?php
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('students' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$course_id=$this->db->get_where('students' , array('login_id'=>$id))->row()->student_course;
$dept_id       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->dept_id;
$dpt_name       =	$this->db->get_where('departments' , array('dept_id'=>$dept_id))->row()->department_name;
$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
//echo $dept_id;
?>

<div class="col-lg-12">

                        <section class="box nobox">
                            <div class="content-body">

                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-institution icon-md icon-rounded icon-primary'></i>
                                            <div class="stats">
                                                <h4><strong>School</strong></h4>
                                                <span><?php echo $school_name ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-building icon-md icon-rounded icon-purple'></i>
                                            <div class="stats">
                                                <h4><strong>Department</strong></h4>
                                                <span><?php echo $dpt_name; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-lightbulb-o icon-md icon-rounded icon-orange'></i>
                                            <div class="stats">
                                                <h4><strong>Course</strong></h4>
                                                <span><?php echo $course_name ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php /*?><div class="col-md-4 col-sm-8 col-xs-12">
                                        <div class="r4_counter db_box">
                                            <i class='pull-left fa fa-book  icon-md icon-rounded icon-purple'></i>
                                            <div class="stats">
                                                <h4><strong><?php echo $count_units;?></strong></h4>
                                                <span>Total Units</span>
                                            </div>
                                        </div>
                                    </div><?php */?>
                                    
                                </div> <!-- End .row --> 

                                
                            </div>
                        </section>
                        
                      </div>