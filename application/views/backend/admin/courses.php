<?php
$id		 =	$this->session->userdata('id');
?>



 <div class="col-lg-8">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">All Courses (<?PHP echo $this->db->count_all("courses");?>)</h2>
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

                                                 <!-- ********************************************** -->


                                        <?php /*?><div class="table-responsive"><?php */?>
                                        <?PHP if($this->db->count_all("courses")!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/courses" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm btn-disabled  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Courses</th>
                                                    <th>Department</th>
                                                    <?php /*?><th>School</th><?php */?>
                                                    <th>Programme<br />Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                //$where="unit_id='0'";
                                                $this->db->select('*');
                                                $this->db->from('courses');
                                                $this->db->order_by('course_id','desc');
                                                //$this->db->where($where);
												$this->db->join('departments', 'departments.dept_id = courses.dept_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															$course_id=$row['course_id'];
															$dpt_name=$row['department_name'];
															$p_type=$row['programme_type'];
															$course_name=$row['course_name'];
															$school_id=$row['school_id'];
															
															$school_name       =	$this->db->get_where('schools' , array('school_id'=>$school_id))->row()->school_name;
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><strong><?php echo $course_name?></strong></td>
                                                    <td><?php echo $dpt_name?></td>
                                                    <?php /*?><td><?php echo $school_name?></td><?php */?>
                                                    <td>
														<?php if($p_type=="1"){echo "Diploma";}?>
                                                        <?php if($p_type=="2"){echo "Degree";}?>
                                                        <?php if($p_type=="3"){echo "Masters";}?>
                                                        <?php if($p_type=="4"){echo "PHD";}?>
                                                    </td>
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
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/course_crud/edit/<?php echo $course_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/course_crud/delete/<?php echo $course_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- /btn-group -->


                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                        <!-- ********************************************** -->
										<?php /*?></div><?php */?>
                                                

                                            </div>
                                            <div class="clearfix"><br></div>
                                            </div>
                                            
                                            
                                            
                                         </div>
                                     </div>
                                </div>
                          </section>
                      </div>
                      
                      
       
                      
                      
                      <!--col-lg-4_start-->
                      <div class="col-lg-4">
                      	 <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Add Course</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                    
                                                            
                                                              <?php $attributes = array("name" => "form", 'id'=>'courseForm');
            echo form_open("admin/course_crud/add", $attributes);?> 
            
            												<div id="courseMessage"></div>
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select  class="" name="s2example-2"  id="s2example-2" onchange="return select_department(this.value)" >
                                                                    <option></option>
                                                                      <?php 
                                                                        $s = $this->db->get('schools')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['school_id'];?>">
                                                                            <?php echo $row['school_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
    
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                        <label for="course">Select Department *</label>
                                                                        
                                                                        <select name="dpt" id="dpt" class="form-control">
                                                                            	<option value="">Select School First</option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                
                                                                
                                                                
                                                                 <div class="form-group">
                                                                        <label for="p_type">Programme Type *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="p_type" id="p_type" class="form-control">
                                                                                <option value="1">Diploma</option>
                                                                                <option value="2">Degree</option>
                                                                                <option value="3">Masters</option>
                                                                                <option value="4">PHD</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                 <div class="form-group">
                                                                    <label for="c_name">Course Name*</label>
                                                                    <span class="desc"></span>
                                                                    <div class="controls">
                                                                        <textarea placeholder="Add course name" name="c_name" class="form-control autogrow" cols="5" id="c_name"></textarea>
                                                                    </div>
                                                                </div>

                    
                                                                <?php /*?><div class="form-group">
                                                                    <label>Unit Name:</label>
                                                                    <input type="text" name="u_name" value="" class="form-control" id="u_name" placeholder="Input Unit Name">
                                                                    <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
                                                                </div><?php */?>
                    
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Add Course</button>
                                                                    <button type="button" onclick="clearForm()" class="btn btn-warning" id="reset"><i class="fa fa-eraser"></i> Reset</button>
                                                                    </div>
                    
                                                            </form>
                                    
                                    
                                  
                                  	</div>
                                  </div>
                               </div>
                           </section>
                      </div>
                       <!--col-lg-4 end_-->
                       
  <script>
	//get course
	function select_department(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/course_crud/select_department/' + id ,
            success: function(response)
            {
                jQuery('#dpt').html(response);
            }
        });

    }
	</script>   
