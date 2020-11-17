
<?php
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('students' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$course_id=$this->db->get_where('students' , array('login_id'=>$id))->row()->student_course;
$dept_id       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->dept_id;
$dpt_name       =	$this->db->get_where('departments' , array('dept_id'=>$dept_id))->row()->department_name;
$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;


$where="assigned_school=".$assigned_school."";
$this->db->select('*');
$this->db->from('lecturers');
$this->db->order_by('date_registered','desc');
$this->db->where($where);
$count_lecs=$this->db->count_all_results()


?>
 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Lecturers</h2>
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

                                                <!--<h4>Primary</h4>-->

                                                <ul class="nav nav-tabs primary">
                                                    <li class="active">
                                                        <a href="#home-1" data-toggle="tab">
                                                            <i class="fa fa-users"></i> Lectures  (<?php echo $count_lecs; ?>)
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <div class="table-responsive">
                                                             <?PHP if($count_lecs!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/print_lecs/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($assigned_school))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                                                <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Lecturer Name</th>
                                                                            <th>Phone Number</th>
                                                                            <th>Email</th>
                                                                            <th>Units Assigned</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        $where="assigned_school=".$assigned_school."";
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
																					
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo ucwords($lecturer_name)?></td>
                                                                            <td><?php echo $lecturer_phone;?></td>
                                                                            <td><?php echo $lecturer_email;?></td>
                                                                            <td width="26%">
                                                                            	<?php
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
                                                                                                $unit_name=$row['unit_name'];
																								echo "
                                                                                                <div class=' col-md-4 bottom10'><a href='#' rel='tooltip' data-color-class = '' data-animate=' animated fadeIn' data-toggle='tooltip' data-original-title='".$unit_name."' data-placement='top'><u class='text-dark'><span class='badge badge-info'> ".$unit_code."</span></u></a></div>
                                                                                                ";
																								endforeach;
																								}
																				?>
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
                      
                      
                      
                     
 