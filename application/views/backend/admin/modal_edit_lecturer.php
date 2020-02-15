 
<script src="<?php echo base_url(); ?>components/customs/lecturers.js"></script>
<?php foreach($lecturer_id->result() as $row):
$lecturer_id=$row->lecturer_id;
$lecturer_name=$row->lecturer_name;
$lecturer_phone=$row->lecturer_phone;
$lecturer_idno=$row->lecturer_idno;
$lecturer_address=$row->lecturer_address;
$lecturer_email=$row->lecturer_email;
$lecturer_gender=$row->lecturer_gender;
$assigned_school=$row->assigned_school;
$login_id=$row->login_id;
$reg_no       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;
?>
<?php endforeach;?>
<center><blockquote><b>Edit Lecturer : <?php echo $lecturer_name; ?></b></blockquote></center>

 <div id="lecturerUpdateMessage"></div>
 <?php $attributes = array("name" => "form", 'id'=>'lecturerUpdateForm');
            echo form_open("admin/lecturers_crud/update/".$lecturer_id, $attributes);?>
            	
                <div class="col-lg-12"> 
            
																<div class="col-lg-12">
                                                                	<h4><strong>Personal Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="u_l_name">Lecturer Name *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_l_name" class="form-control" id="u_l_name" value="<?php echo $lecturer_name;?>">
                                                                        </div>
                                                                    </div>                    
                                                                    <div class="form-group">
                                                                        <label for="u_l_phone">Phone Number *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_l_phone" class="form-control" id="u_l_phone" value="<?php echo $lecturer_phone?>">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="u_address">Lecturer Address *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_address" class="form-control" id="u_address" value="<?php echo $lecturer_address?>">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                </div>
                                                                <!--line-->
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="u_idno">Lecturer's IDNO *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" class="form-control" name="u_idno" id="u_idno" value="<?php echo $lecturer_idno?>" data-mask="99999999">
                                                                        </div>
                                                                    </div>                    
                                                                    <div class="form-group">
                                                                        <label for="u_email">Email *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_email" class="form-control" id="u_email" value="<?php echo $lecturer_email?>">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="u_gender">Gender *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="u_gender" id="u_gender" class="form-control">
                                                                            	<option value="">Select Gender</option>
                                                                                <option value="1" <?php if($lecturer_gender==1){echo "selected";}?>>MALE</option>
                                                                                <option value="2" <?php if($lecturer_gender==2){echo "selected";}?>>FEMALE</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>                    
                                                                </div>
                                                                <!------------------------------------------------------------------------------->
                                                                
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                	<h4><strong>School Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="u_reg_no">Lecturer's Reg No *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_reg_no" class="form-control" id="u_reg_no" style=" text-transform:uppercase;" readonly="readonly" value="<?php echo $reg_no?>" />
                                                                        </div>
                                                                    </div>
                                                                                         
                                                                    <div class="form-group">
                                                                        <label for="u_school">School *</label>
                                                                        
                                                                        <select name="u_school" id="u_school" class="form-control" >
                                                                        <option value="">Select School</option>
                                                                          <?php 
                                                                            $s = $this->db->get('schools')->result_array();
                                                                            foreach($s as $row):
                                                                          ?>
                                                                            <option value="<?php echo $row['school_id'];?>"  <?php if($assigned_school==$row['school_id']){echo "selected";}?>>
                                                                                <?php echo $row['school_name'];?>
                                                                            </option>
                                                                            <?php
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    
                                                                                       
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="u_school">Assigned units</label>
                                                                        
                                                                        <select multiple="multiple" name="s2example-5[]" id="s2example-5" class="form-control">
                                                                          <?php 
                                                                            //select units
																			$where="lecturer_id=".$lecturer_id."";
																			$this->db->select('*');
																			$this->db->from('manage_units');
																		    $this->db->where($where);
																			//$this->db->join('units', 'units.unit_id = manage_units.lecturer_unit_id');
									
																			$desc	=	$this->db->get()->result_array();
																			foreach($desc as $row):
																				$m_unit_id=$row['lecturer_unit_id'];
																				$unit_name       =	$this->db->get_where('units' , array('unit_id'=>$m_unit_id))->row()->unit_name;
																				$unit_code       =	$this->db->get_where('units' , array('unit_id'=>$m_unit_id))->row()->unit_code;
                                                                          ?>
                                                                            <option value="<?php echo $m_unit_id;?>" selected>
                                                                                <?php echo $unit_name;?> (<?php echo $unit_code;?>)
                                                                            </option>
                                                                            <?php
                                                                            endforeach;
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    
                                                                                       
                                                                </div>                    
                                                                                       
                                                                </div>
                                                                
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                	<button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Update lecturer</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                                </div>
                                                                
                                                                <div class="clearfix"></div>
                                                                
 </form>
 </div>
                                                                    <br />
         
