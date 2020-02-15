<?php foreach($result_code->result() as $row):
$result_id=$row->result_id;
$result_code=$row->result_code;
$student_id=$row->student_id;
$course_id=$row->course_id;
$unit_id=$row->unit_id;
$lecturer_id=$row->lecturer_id;
$semester_id=$row->semester_id;
$date_added=$row->date_added;
endforeach;
$school_name       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$lecturer_id))->row()->assigned_school;
$course_name       =	$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_name;
$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$unit_id))->row()->unit_code;
$sem_year       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_year;
$sem_name       =	$this->db->get_where('semesters' , array('semester_id'=>$semester_id))->row()->semester_name;

$assigned_school       =	$this->db->get_where('lecturers' , array('lecturer_id'=>$lecturer_id))->row()->assigned_school;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name;
?>

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">View Result</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_close fa fa-times"></i>
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
                                                            <i class="fa fa-home"></i> Overview
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-edit"></i> Edit Results 
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                              <!-- start -->

                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                     <h4><strong>School : <?php echo $school_name;?></strong></h4>
                                            <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                            	<div class="col-lg-12">
                                                	<div class="row">
                                                    	<div class="col-md-6">
                                                                        <h3>Results summary</h3>
                                                         </div>
                                                         <div class="col-md-6">
                                                                        <h3 class="text-right"><a href="<?php echo base_url()?>lecturer/print_result/<?php echo$result_code;?>" title="Print Results in PDF format" target="_blank" class="btn btn-info btn-lg"><i class="fa fa-print"></i> &nbsp; Print</a></h3>
                                                         </div>
                                                    </div>
                                                </div>
                                                                        <div class="invoice-head">
                                                                            
                                                                            <div class="col-md-12 col-sm-12 col-xs-12 invoice-head-info">
                                                                            <span>
                                                                            	<table class="table invoice-table">
                                                                                	<tr>
                                                                                    	<td class="no-line" style="padding-left:15px;"><strong>Result ID:</strong></td>
                                                                                        <td class="no-line"><?php echo $result_code; ?></td>
                                                                                    	<td style="padding-left:15px;"><strong>Course:</strong></td>
                                                                                        <td><?php  echo $course_name;?></td>
                                                                                    </tr>
                                                                                	<tr>
                                                                                    	<td style="padding-left:15px;"><strong>Unit:</strong></td>
                                                                                        <td><?php echo $unit_name;?> (<?php echo $unit_code; ?>)</td>
                                                                                        <td style="padding-left:15px;"><strong>Academic Year:</strong></td>
                                                                                        <td><?php echo $sem_year;?></strong> 
                                                                           <br /> <?php echo 'Year: <b>'.substr($sem_name,0,1).'</b>';?> Semester: <?php echo '<b>'.substr($sem_name,2).'</b>';?> (<?php echo $sem_name?>)</td>
                                                                                    </tr>
                                                                                	<tr>
                                                                                    	<td style="padding-left:15px;"><strong>Date Added:</strong></td>
                                                                                        <td><?php echo date('d'.'/'.'m'.'/'.'Y',$date_added); ?></td>
                                                                                    </tr>
                                                                                </table>
                                                                              </span>
                                                                                
                                                                            </div>
                                                                            
                                                                            
                                                                        </div>
                                                                    </div>
                        
                                                                    <div class="clearfix"></div><br>
                        
                                                                </div>
                        
                                                                <div class="row">
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover  invoice-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td>#</td>
                                                                                        <td class="text-left">Student Name</td>
                                                                                        <td class="text-center">Cat Marks (30%)</td>
                                                                                        <td class="text-center">Final Marks (70%)</td>
                                                                                        <td class="text-center">Total Marks (100%)</td>
                                                                                        <td class="text-center">Grade</td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php
																				//get count of total student who sat for this exam
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
																					?>
                                                                                    <tr>
                                                                                        <td width="10%"><strong><?php echo $r++?></strong></td>
                                                                                        <td class="text-left" width="40%"><strong><?php echo ucwords($student_name)?> (<?php echo $adm_no; ?>)</strong></td>
                                                                                        <td class="text-center" width="10%"><strong><?php echo $cat_marks?></strong></td>
                                                                                        <td class="text-center" width="10%"><strong><?php echo $final_marks?></strong></td>
                                                                                        <td class="text-center text-danger" width="10%"><strong><?php echo $total_marks?></strong></td>
                                                                                        <td class="text-center text-info" width="10%"><strong><?php echo $grade?></strong></td>
                                                                                    </tr>
                                                                                    <?php endforeach ?>
                                                                                     <tr style="border-top-color:#fff;">
                                                                                        <td class="thick-line"></td>
                                                                                        <td class="thick-line text-right"><h4><strong>Total</strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4><strong><?php echo $cat_total;?></strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4><strong><?php echo $final_total;?></strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4 class="text-danger"><strong><?php echo $all_total;?></strong></h4></td>
                                                                                        <td class="thick-line text-center"></td>
                                                                                    </tr>
                                                                                     <tr style="border-top-color:#fff;">
                                                                                        <td class="thick-line"></td>
                                                                                        <td class="thick-line text-right"><h4><strong>M.S.S</strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4><strong><?php echo round($cat_total/$count_result,2);?></strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4><strong><?php echo round($final_total/$count_result,2);?></strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4 class="text-danger"><strong><?php echo round($all_total/$count_result,2);?></strong></h4></td>
                                                                                        <td class="thick-line text-center"><h4 class="text-info"><strong><?php echo $ave_grade;?></strong></h4></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                        
                        
                        
                                                                <div class="clearfix"></div><br>
                        
                        
                                                                <!-- end -->



                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="profile-1">
                                                    
                                                                     <h4><strong>School : <?php echo $school_name;?></strong></h4>
                                            <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                                     <div class="success-messages"></div>
                                                    <form action ="<?php echo base_url()?>lecturer/result_crud/update/<?php echo $result_code;?>" method="post" id="updateResultForm">
                                                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

                                                        <div class="row">
                                                        <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">

                                                            <div class="form-group">
                                                        		<label class="col-sm-2 control-label">Course Name: </label>
                                            
                                            					<div class="col-sm-10">
                                                                <input type="text" name="course" value="<?php echo $course_name ?>" readonly="readonly" class="form-control" />
                                                                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
                                                                    </div>
                                                            </div>
                                                            <br />
                                                            <div class="form-group">
                                                            	<label class="col-sm-2 control-label">Select Unit :</label>
                                            
                                            					<div class="col-sm-10">
                                                                 <select name="s2example-8" id="s2example-8">
                                                                      <?php 
                                                                        
																		$where="lecturer_id=".$lecturer_id."";
																		$this->db->select('*');
																		$this->db->from('manage_units');
																		//$this->db->order_by('posted_date','desc');
																		$this->db->where($where);
																		$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
																		$s	=	$this->db->get()->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['unit_id'];?>" <?php if($unit_id==$row['unit_id']){echo "selected";}?>>
                                                                            <?php echo $row['unit_name'];?> (<?php echo $row['unit_code'];?>)
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                            </div>
                                                            <br />
                                                            <div class="form-group">
                                                            	<label class="col-sm-2 control-label">Academic Year :</label>
                                            
                                            					<div class="col-sm-10">
                                                                <select name="s2example-6" id="s2example-6" >
                                                                      <?php 
                                                                        $s = $this->db->get('semesters')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['semester_id'];?>" <?php if($semester_id==$row['semester_id']){echo "selected";} ?>>
                                                                            <?php echo $row['semester_year'];?> <i class="fa fa-angle-double-right"></i> <?php echo 'Year: '.substr($row['semester_name'],0,2);?> Semester: <?php echo substr($row['semester_name'],3);?> (<?php echo $row['semester_name']?>)
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
                                                                    </div>
                                                                
                                                            </div>
                                                      	</div>
                                                   </div>
                                                   
                                                   <!--begin result table-->
                                                   <div class="row">
                                                        <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">
                                                        
                                                            <div class="table-responsive">
                                                                <table class="table" id="UpdateResultTable">
                                                                    <thead>
                                                                    	<tr>
                                                                        	<th>No.</th>			  			
                                                                            <th>Student</th>
                                                                            <th>Cat (30%)</th>
                                                                            <th>Final (70%)</th>
                                                                            <th>Total (100%)</th>
                                                                            <th>Grade</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                        $where=array("result_code"=>$result_code);
                                                                        $this->db->select('*');
                                                                        $this->db->from('results');
                                                                        //$this->db->order_by('date_registered','desc');
                                                                        $this->db->where($where);
                                                                        $desc	=	$this->db->get()->result_array();
																		$x=1; $cat=1;$total=1;$gt=1;$gf=1;$final=1;$grade=1;$delete=1;$tr=1;$sg=1;
                                                                        foreach($desc as $row){
                                                                                    $r_id=$row['result_id'];
                                                                                    $c_m=$row['cat_marks'];
                                                                                    $f_m=$row['final_marks'];
																					$t_m=$row['total_marks'];
																					$g=$row['grade'];
																					$st_id=$row['student_id'];
																		$s_name       =	$this->db->get_where('students' , array('student_id'=>$st_id))->row()->student_name;
																		$adm_no       =	$this->db->get_where('login' , array('name'=>$s_name))->row()->username;
																		
																	?>
                                                                    <tr id="tr<?php echo $tr++; ?>">
                                                                        <td>
                                                                            <input type="button" class="form-control" value="<?php echo $x++ ?>." disabled="true" />
                                                                            <input type="hidden" name="r_id[]" value="<?php echo $r_id ?>" />
                                                                        </td>
                                                                        <td width="35%">
                                                                            <select name="name[]" class="form-control" required="required">
                                                                                <option value="<?php echo $st_id ?>"><?php echo $s_name?> (<?php echo $adm_no?>)</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" name="cat[]" onkeyup="getTotal(<?php echo $gt++?>)"  id="cat<?php echo $cat++?>" autocomplete="off" class="form-control"  placeholder="Cat Mark" required="required" min="0" max="30" value="<?php echo $c_m;?>"/>
                                                                        </td>
                                                                        <td>  
                                                                           <input type="number" name="final[]" onkeyup="getTotal(<?php echo $gf++?>)"  id="final<?php echo $final++?>" autocomplete="off" class="form-control" placeholder="Final Mark" required="required" min="0" max="70" value="<?php echo $f_m;?>"/>
                                                                        </td>
                                                                        <td>
                                                                           <input type="text" name="total[]"  id="total<?php echo $total++?>" autocomplete="off" class="form-control"  placeholder="(Cat + Final)"  readonly="readonly" value="<?php echo $t_m;?>"/>
                                                                        </td>
                                                                        <td width="5%">
                                                                            <input type="text" name="grade[]"  id="grade<?php  echo $grade++?>" autocomplete="off" class="form-control" readonly="readonly"  value="<?php echo $g;?>"/>
                                                                             <input type="hidden" name="sgrade[]"  id="sgrade<?php echo $sg++?>"/>
                                                                         </td>
                                                                    </tr>
                                                                        
																	<?php
                                                                        }
																	?>
                                                                    </tbody>
                                                                </table>
                                                            <hr size="2" noshade>
                                                            </div>
                                                            
                                                            
                                                            </div>
                                                         </div>
                                                   <!--end result table-->
                                                   
                                                   <!--begin Buttons-->
                                                   
                                                   <div class="row"> 
                                                        <div class="col-sm-12">
                                                        <div id="orderbuttonsdisabled">
                                                            <button class="btn btn-primary disabled" type="button" id=""><i class="fa fa-check-circle"></i> Update Result</button>
                                                            <button type="button" class="btn btn-warning disabled"><i class="fa fa-eraser"></i> Reset</button> 
                                                            </div>
                                                            <div id="orderbuttons" style="display:none;">
                                                            <?php /*?><button type="button" class="btn btn-success removeStudentRowBtn" onclick="addResultRow()" id="addSudentRowBtn" data-loading-text="<i class='fa fa-plus-circle'></i> Adding..."><i class="fa fa-plus-circle"></i> Add Row</button> <?php */?>
                                                            <button class="btn btn-primary removeProductRowBtn" type="submit" onclick="validateUpdateResult()" id="createResultBtn" data-loading-text="<i class='fa fa-check-circle'></i> Adding..."/><i class="fa fa-check-circle"></i> Update Result</button>
                                                            <button type="reset" onclick="presetOrderForm()" class="btn btn-warning removeProductRowBtn"><i class="fa fa-eraser"></i> Reset</button> 
                                                            </div>
                                                        </div> 
                                                        
                                                        </div>
                                                        
                                                        <!--end buttons-->
                                                        
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
                      
                      
                      
                      