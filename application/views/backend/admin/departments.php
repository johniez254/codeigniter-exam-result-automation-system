<?php
$id		 =	$this->session->userdata('id');
?>



 <div class="col-lg-8">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">All Departments (<?PHP echo $this->db->count_all("departments");?>)</h2>
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
                                        <?PHP if($this->db->count_all("departments")!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/departments" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                        <?php }?>
                                        <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Department</th>
                                                    <th>School</th>
                                                    <th>Assigned<br />Course</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                             <?php
                                                //$where="unit_id='0'";
                                                $this->db->select('*');
                                                $this->db->from('departments');
                                                $this->db->order_by('dept_id','desc');
                                                //$this->db->where($where);
												$this->db->join('schools', 'schools.school_id = departments.school_id');
                                                $desc	=	$this->db->get()->result_array();
												$i=1;
												foreach($desc as $row):
															$dept_id=$row['dept_id'];
															$dpt_name=$row['department_name'];
															$posted=$row['date_added'];
															$school_name=$row['school_name'];
															$school_id=$row['school_id'];
															$added_c=$row['added_course'];
												
												?>
                                                <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><strong><?php echo $dpt_name?></strong></td>
                                                    <td><?php echo $school_name?></td>
                                                    <td class="text-center"><?php if($added_c=="0"){echo "<span class='badge badge-warning'>Unassigned</span>
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
                                                                <?php if ($added_c=="0"){?>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/department_crud/add_course/<?php echo $dept_id;?>')"><small><i class="fa fa-plus"></i> Add Course</small></a></li>
                                                                <?php }?>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/department_crud/edit/<?php echo $dept_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/department_crud/delete/<?php echo $dept_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
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
                                <h2 class="title pull-left">Add Department</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    
                                    
                                                            
                                                              <?php $attributes = array("name" => "form", 'id'=>'deptForm');
            echo form_open("admin/department_crud/add", $attributes);?> 
            
            												<div id="deptMessage"></div>
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select name="s2example-2" id="s2example-2" >
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
                                                                    <label>Department Name:</label>
                                                                    <input type="text" name="d_name" class="form-control" value="" id="d_name" placeholder="Input department name">
                                                                     <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
                                                                </div>
                    
                                                                <?php /*?><div class="form-group">
                                                                    <label>Unit Name:</label>
                                                                    <input type="text" name="u_name" value="" class="form-control" id="u_name" placeholder="Input Unit Name">
                                                                    <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
                                                                </div><?php */?>
                    
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Add Department</button>
                                                                    <button type="button" onclick="clearForm()" class="btn btn-warning" id="reset"><i class="fa fa-eraser"></i> Reset</button>
                                                                    </div>
                    
                                                            </form>
                                    
                                    
                                  
                                  	</div>
                                  </div>
                               </div>
                           </section>
                      </div>
                       <!--col-lg-4 end_-->  
