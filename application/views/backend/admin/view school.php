<?php
foreach($school_id->result() as $row):
$sch_id=$row->school_id;
$school_name=$row->school_name;
endforeach;

$cs="school_id=".$sch_id."";
$this->db->select('*');
$this->db->from('departments');
$this->db->where($cs);
$count_dept	=	$this->db->count_all_results();

$cs="school_id=".$sch_id."";
$this->db->select('*');
$this->db->from('units');
$this->db->where($cs);
$count_units	=	$this->db->count_all_results();

$cs="assigned_school=".$sch_id."";
$this->db->select('*');
$this->db->from('lecturers');
$this->db->where($cs);
$count_lec	=	$this->db->count_all_results();

$cs="assigned_school=".$sch_id."";
$this->db->select('*');
$this->db->from('students');
$this->db->where($cs);
$count_stud	=	$this->db->count_all_results();

?>

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">School: <?php echo $school_name;?></h2>
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

                                                <ul class="nav nav-tabs nav-justified primary">
                                                    <li class="active">
                                                        <a href="#home-1" data-toggle="tab">
                                                            <i class="fa fa-building"></i> Departments (<?php echo $count_dept?>)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-book"></i> Units (<?php echo $count_units?>)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#messages-1" data-toggle="tab">
                                                            <i class="fa fa-users"></i> Lecturers (<?php echo $count_lec?>)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#settings-1" data-toggle="tab">
                                                            <i class="fa fa-graduation-cap"></i> Students (<?php echo $count_stud?>)
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <div class="table-responsive">
                                                             <?PHP if($count_dept!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/departments/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sch_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example2" class="table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Department Name</th>
                                                    <th>Course</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                $where=array('school_id'=>$sch_id);
                                                $this->db->select('*');
                                                $this->db->from('departments');
                                                //$this->db->order_by('date_added','desc');
                                                $this->db->where($where);
												//$this->db->join('courses', 'courses.dept_id = departments.dept_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															//$school_id=$row['school_id'];
															$dept_name=$row['department_name'];
															$added_course=$row['added_course'];
															$dept_id=$row['dept_id'];
															//$posted=$row['date_added'];
															
															
															if($added_course==0){
																$course_name='<span class="badge badge-md badge-danger"><i class="fa fa-times"></i> Course Unavailable</span> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; 
															<a onclick="showAjaxModal('."'".''.base_url()."admin/department_crud/add_course/".$dept_id.''."'".')" class="btn btn-info btn-xs" href="#" rel="tooltip" data-color-class = "info" data-animate=" animated fadeIn " data-toggle="tooltip" data-original-title="Add Course"><u class="text-white"><i class="fa fa-plus"></i></u></a>';
															}else{
																	$course_name="
																		<span class='badge badge-md badge-success'><i class='fa fa-check'></i> ". 
																		$this->db->get_where('courses' , array('school_id'=>$sch_id))->row()->course_name
																		."</span>";
															}
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><?php echo $dept_name?></td>
                                                    <td><?php echo $course_name?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                        <!-- ********************************************** -->
										</div>


                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="profile-1">

                                                        <div class="table-responsive">
                                                             <?PHP if($count_units!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/units/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sch_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example3" class="table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Unit Name</th>
                                                    <th>Unit Code</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                $where=array('school_id'=>$sch_id);
                                                $this->db->select('*');
                                                $this->db->from('units');
                                                //$this->db->order_by('date_added','desc');
                                                $this->db->where($where);
												//$this->db->join('courses', 'courses.dept_id = departments.dept_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															//$school_id=$row['school_id'];
															$unit_name=$row['unit_name'];
															$unit_code=$row['unit_code'];
															//$posted=$row['date_added'];
															//$course_name       =	$this->db->get_where('courses' , array('school_id'=>$sch_id))->row()->course_name;
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><?php echo $unit_name?></td>
                                                    <td><?php echo $unit_code?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                        <!-- ********************************************** -->
										</div>

                                                    </div>
                                                    <div class="tab-pane fade" id="messages-1">

                                                        <div class="table-responsive">
                                                             <?PHP if($count_lec!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/lecturers/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sch_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                                                <table id="example4" class="table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Registration Number</th>
                                                                            <th>Lecturer Name</th>
                                                                            <th>Phone Number</th>
                                                                            <th>IDNO</th>
                                                                            <th>Email</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        $where="assigned_school=".$sch_id."";
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
                                                                                    $req_number=$row['username'];
                                                                                    //$lecturer_idno=$row['lecturer_idno'];
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo strtoupper($req_number)?></td>
                                                                            <td><?php echo ucwords($lecturer_name)?></td>
                                                                            <td><?php echo $lecturer_phone;?></td>
                                                                            <td><?php echo $lecturer_idno?></td>
                                                                            <td><?php echo $lecturer_email?></td>
                                                                            <td>
                                                                                 <?php /*?><div class="col-md-12 col-sm-12 col-xs-12 btn-iconic">
                                                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/edit/<?php echo $unit_id;?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                                                                    <button type="button" onclick="confirm_modal('<?php echo base_url();?>admin/units_crud/delete/<?php echo $unit_id;?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                                                </div><?php */?>
                                                                                <div class="btn-group">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                                                            Action
                                                                                            <span class="caret"></span>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/lecturers_crud/edit/<?php echo $lecturer_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/lecturers_crud/delete/<?php echo $lecturer_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div><!-- /btn-group -->
                        
                        
                                                                            </td>
                                                                        </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                                <!-- ********************************************** -->
                                                                </div>

                                                    </div>

                                                    <div class="tab-pane fade" id="settings-1">

                                                        <div class="table-responsive">
                                                             <?PHP if($count_stud!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/students/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sch_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                                                <table id="example5" class=" table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Student Name</th>
                                                                            <th>Registration Number</th>
                                                                            <th>Phone Number</th>
                                                                            <th>IDNO</th>
                                                                            <th>Email</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        $where="assigned_school=".$sch_id."";
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
                                                                                    //$student_idno=$row['student_idno'];
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo ucwords($student_name)?></td>
                                                                            <td><?php echo strtoupper($req_number)?></td>
                                                                            <td><?php echo $student_phone;?></td>
                                                                            <td><?php echo $student_idno?></td>
                                                                            <td><?php echo $student_email?></td>
                                                                            <td>
                                                                                 <?php /*?><div class="col-md-12 col-sm-12 col-xs-12 btn-iconic">
                                                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/edit/<?php echo $unit_id;?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                                                                    <button type="button" onclick="confirm_modal('<?php echo base_url();?>admin/units_crud/delete/<?php echo $unit_id;?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                                                </div><?php */?>
                                                                                <div class="btn-group">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                                                            Action
                                                                                            <span class="caret"></span>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/students_crud/edit/<?php echo $student_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/students_crud/delete/<?php echo $student_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div><!-- /btn-group -->
                        
                        
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
                                            <div class="clearfix"><br></div>
                                            </div>
                                            
                                            
                                            
                                         </div>
                                     </div>
                                </div>
                          </section>
                      </div>
                      
                      
                   
                      
                       
