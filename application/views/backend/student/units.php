
<?php
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('students' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$course_id=$this->db->get_where('students' , array('login_id'=>$id))->row()->student_course;
$dept_id       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->dept_id;
$dpt_name       =	$this->db->get_where('departments' , array('dept_id'=>$dept_id))->row()->department_name;
$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;

$cs="course_id=".$course_id."";
$this->db->select('*');
$this->db->from('units');
$this->db->where($cs);
$count_units	=	$this->db->count_all_results();
?>
 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Units</h2>
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
                                                            <i class="fa fa-newspaper-o"></i> All Units (<?php echo $count_units;?>)
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <div class="table-responsive">
                                                             <?PHP if($count_units!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/student_units/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($course_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm btn-disabled  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Unit Code</th>
                                                    <th>Unit Name</th>
                                                    <?php /*?><th>Action</th><?php */?>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                $where="course_id=".$course_id."";
                                                $this->db->select('*');
                                                $this->db->from('units');
                                                //$this->db->order_by('posted_date','desc');
                                                $this->db->where($where);
												//$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															$unit_id=$row['unit_id'];
															$u_name=$row['unit_name'];
															$u_code=$row['unit_code'];
															$posted=$row['posted_date'];
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><?php echo $u_code?></td>
                                                    <td><?php echo $u_name?></td>
                                                   
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
                      
                      
                      
                      