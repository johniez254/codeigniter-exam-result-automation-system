<?php
$id		 =	$this->session->userdata('id');
$assigned_school       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
$lecturer_id       =	$this->db->get_where('lecturers' , array('login_id'=>$id))->row()->lecturer_id;


$where="lecturer_id=".$lecturer_id."";
$this->db->select('*');$this->db->from('results');
//$this->db->order_by('date_registered','desc');
$this->db->where($where);
$this->db->group_by('result_code');
$count_results=$this->db->count_all_results()
?>

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Manage Results</h2>
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
                                                            <i class="fa fa-home"></i> Added Results (<?php echo $count_results;?>)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-plus"></i> Add Result 
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>
                                                        
                                            
                                                        <h4><strong>School : <?php echo $school_name;?></strong></h4>
                                                        <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                                        <div class="table-responsive">
                                                             <?PHP if($count_results!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/results/'.<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($lecturer_id))))))))?>.'" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm pull-right"onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                                                <table id="example2" class="table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Unit</th>
                                                                            <th>Academic Year</th>
                                                                            <th>Course</th>
                                                                            <th>Date Added</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        $where="lecturer_id=".$lecturer_id."";
                                                                        $this->db->select('*');
                                                                        $this->db->from('results');
                                                                        //$this->db->order_by('date_registered','desc');
                                                                        $this->db->where($where);
																		$this->db->group_by('result_code');
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $col=1;
                                                                        foreach($desc as $row):
                                                                                    $result_id=$row['result_id'];
                                                                                    $student_id=$row['student_id'];
																					$unit_id=$row['unit_id'];
                                                                                    $course_id=$row['course_id'];
                                                                                    $semester_id=$row['semester_id'];
                                                                                    $date_added=$row['date_added'];
                                                                                    $result_code=$row['result_code'];
																		$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
																		$semester_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;
																		$semester_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
																		$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
																		$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $col++;?>.</td>
                                                                            <td><?php echo $unit_name . ' ('.$unit_code .')';  ?></td>
                                                                            <td><strong><?php echo $semester_year;?></strong> 
                                                                            <br /> <?php echo 'Year: <b>'.substr($semester_name,0,2).'</b>';?> Sem: <?php echo '<b>'.substr($semester_name,3).'</b>';?> (<?php echo $semester_name?>)</td>
                                                                            <td><?php echo $course_name;?></td>
                                                                            <?php /*?><td><?php echo $student_idno?></td><?php */?>
                                                                            <td><?php echo date('d'.'/'.'m'.'/'.'Y',$date_added);?></td>
                                                                            <td>
                                                                                 <?php /*?><div class="col-md-12 col-sm-12 col-xs-12 btn-iconic">
                                                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/edit/<?php echo $unit_id;?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                                                                    <button type="button" onclick="confirm_modal('<?php echo base_url();?>admin/units_crud/delete/<?php echo $unit_id;?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                                                </div><?php */?>
                                                                                        <a href="<?php echo base_url();?>lecturer/result_crud/view/<?php echo $result_code;?>" class="btn btn-primary btn-xs"> View More</a>
                                                                                            <?php /*?><li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/students_crud/delete/<?php echo $student_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li><?php */?>
                        
                        
                                                                            </td>
                                                                        </tr>
                                                                        <?php endforeach ?>
                                                                    </tbody>
                                                                </table>
                                                                <!-- ********************************************** -->
                                                                </div>


                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="profile-1">

                                                        <div class="success-messages"></div>
                                                    <form action ="<?php echo base_url()?>lecturer/result_crud/add" method="post" id="createResultForm">
                                                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                                                    <input type="hidden" name="lect_id" value="<?php echo $lecturer_id;?>" />
                                                    <input type="hidden" name="d_added" value="<?php echo date('Ymd');?>" />

                                                            
                                                <div class="row">
                                                        <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">

                                                            <div class="form-group">
                                                        		<label class="col-sm-2 control-label">Select Course: </label>
                                            
                                            					<div class="col-sm-10">

                                                                <select name="s2example-7" id="s2example-7">
                                                                    <option></option>
                                                                      <?php 
                                                                        $where="school_id=".$assigned_school."";
																		$this->db->select('*');
																		$this->db->from('courses');
																		//$this->db->group_by('posted_date','desc');
																		$this->db->where($where);
																		$s	=	$this->db->get()->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['course_id'];?>">
                                                                            <?php echo $row['course_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                            </div>
                                                            <br />
                                                            <?php /*?><div id="displayUnit" style="display:none;"><?php */?>
                                                            <div class="form-group">
                                                            	<label class="col-sm-2 control-label">Select Unit :</label>
                                            
                                            					<div class="col-sm-10">
                                                                 <select name="s2example-8" id="s2example-8">
                                                                    <option></option>
                                                                      <?php 
                                                                        
																		$where="lecturer_id=".$lecturer_id."";
																		$this->db->select('*');
																		$this->db->from('manage_units');
																		//$this->db->group_by('lecturer_id');
																		$this->db->where($where);
																		$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
																		$s	=	$this->db->get()->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['unit_id'];?>">
                                                                            <?php echo $row['unit_name'];?> (<?php echo $row['unit_code'];?>)
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                            </div>
                                                            <?php /*?></div><?php */?>
                                                            <br />
                                                            <?php /*?><div id="displayYear" style="display:none;"><?php */?>
                                                            <div class="form-group">
                                                            	<label class="col-sm-2 control-label">Academic Year :</label>
                                            
                                            					<div class="col-sm-10">
                                                                <select name="s2example-6" id="s2example-6"  onchange="return get_students(this.value)">
                                                                    <option></option>
                                                                      <?php 
                                                                        $s = $this->db->get('semesters')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['semester_id'];?>">
                                                                            <?php echo $row['semester_year'];?> <i class="fa fa-angle-double-right"></i> <?php echo 'Year: '.substr($row['semester_name'],0,2);?> Semester: <?php echo substr($row['semester_name'],3);?> (<?php echo $row['semester_name']?>)
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                                
                                                            </div>
                                                          <?php /*?></div><?php */?>
                                                      	</div>
                                                   </div>
                                                        
                                                        <!--begin result input table-->
                                                        <div class="row">
                                                        <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">
                                                        
                                                            <div class="table-responsive">
                                                                <table class="table" id="resultTable">
                                                                    <thead>
                                                                    	<tr>
                                                                        	<th>No.</th>			  			
                                                                            <th>Select Student</th>
                                                                            <th>Cat (30%)</th>
                                                                            <th>Final (70%)</th>
                                                                            <th>Total (100%)</th>
                                                                            <th>Grade</th>			  			
                                                                            <th>Delete</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="display">
                                                                    </tbody>
                                                                </table>
                                                            <hr size="2" noshade>
                                                            </div>
                                                            
                                                            
                                                            </div>
                                                         </div>
                                                        <!--end result input table-->
                                                        
                                                         <!--end of nested col-lg-6 right-->
                                                         <div class="row"> 
                                                        <div class="col-sm-12">
                                                        <div id="orderbuttonsdisabled">
                                                            <button class="btn btn-primary disabled" type="button" id=""><i class="fa fa-check-circle"></i> Add Result</button>
                                                            <button type="button" class="btn btn-warning disabled"><i class="fa fa-eraser"></i> Reset</button> 
                                                            </div>
                                                            <div id="orderbuttons" style="display:none;">
                                                            <?php /*?><button type="button" class="btn btn-success removeStudentRowBtn" onclick="addResultRow()" id="addSudentRowBtn" data-loading-text="<i class='fa fa-plus-circle'></i> Adding..."><i class="fa fa-plus-circle"></i> Add Row</button> <?php */?>
                                                            <button class="btn btn-primary removeProductRowBtn" type="submit" onclick="validateResult()" id="createResultBtn" data-loading-text="<i class='fa fa-check-circle'></i> Adding..."/><i class="fa fa-check-circle"></i> Add Result</button>
                                                            <button type="reset" onclick="presetOrderForm()" class="btn btn-warning removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                                            </div>
                                                        </div> 
                                                        
                                                        </div>
                                                        <!--end of class nested row-->
                                                        
                                                        
                                                        
                                                            
                                                        </form>

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


                      
                      
                      
                      