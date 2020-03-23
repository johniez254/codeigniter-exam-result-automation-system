<?php
$id		 =	$this->session->userdata('id');
?>



 <div class="col-lg-8">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">All Units (<?PHP echo $this->db->count_all("units");?>)</h2>
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


                                         <?PHP if($this->db->count_all("units")!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/units" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Unit Code</th>
                                                    <th>Unit Name</th>
                                                    <th>Course</th>
                                                    <?php /*?><th>School</th><?php */?>
                                                    <th>Assigned/<br />Unassigned</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                //$where="unit_id='0'";
                                                $this->db->select('*');
                                                $this->db->from('units');
                                                $this->db->order_by('posted_date','desc');
                                                //$this->db->where($where);
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															$unit_id=$row['unit_id'];
															$u_name=$row['unit_name'];
															$u_code=$row['unit_code'];
															$posted=$row['posted_date'];
															$school_id=$row['school_id'];
															$course_id=$row['course_id'];
															$assigned=$row['assigned_to_lec'];
															$course=$this->db->get_where('courses' , array('course_id'=>$course_id))->row()->course_name;
															//$school=$this->db->get_where('schools' , array('school_id'=>$school_id))->row()->school_name;
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><?php echo $u_code?></td>
                                                    <td><?php echo $u_name?></td>
                                                    <td><?php echo $course?></td>
                                                    <?php /*?><td><?php echo $school?></td><?php */?>
                                                    <td class="text-center"><?php if($assigned=="0"){echo "<span class='badge badge-warning'>Unassigned</span>
";}else{echo"<span class='badge badge-info'>Assigned</span>
";}?></td>
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
                                                                <?php if($assigned=="0"){?>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/assign/<?php echo $unit_id;?>')"><small><i class="fa fa-check"></i> Assign</small></a></li>
                                                                <?php }else{?>
                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_unit_modal('<?php echo base_url();?>admin/units_crud/unassign/<?php echo $unit_id;?>')"><small><i class="fa fa-times"></i> Unassign</small></a></li>
                                                                <?php }?>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/edit/<?php echo $unit_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/units_crud/delete/<?php echo $unit_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
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
                                <h2 class="title pull-left">Add Unit</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                    
                                                            
                                                              <?php $attributes = array("name" => "form", 'id'=>'unitForm');
            echo form_open("admin/validate_unit", $attributes);?> 
            
            												<div id="unitMessage"></div>
                                                            
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select class="" name="s2example-2" id="s2example-2" onchange="return select_course(this.value)">
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
                                                                    <label>Select Course</label>
                                                                    <select class="form-control" name="s_course" id="s_course">
                                                                    <option value="">Select school first</option>
                                                                      
                                                                    </select>
    
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Unit Code:</label>
                                                                    <input type="text" name="u_code" class="form-control" value="" id="u_code" placeholder="Input unit code">
                                                                </div>
                    
                                                                <div class="form-group">
                                                                    <label>Unit Name:</label>
                                                                    <input type="text" name="u_name" value="" class="form-control" id="u_name" placeholder="Input Unit Name">
                                                                    <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
                                                                </div>
                    
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Add Unit</button>
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
	//select course
	function select_course(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/lecturers_crud/select_course/' + id ,
            success: function(response)
            {
                jQuery('#s_course').html(response);
            }
        });

    }
	</script>  
