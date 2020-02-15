
<script src="<?php echo base_url(); ?>components/customs/students.js"></script>
<?php foreach($student_id->result() as $row):
$student_id=$row->student_id;
$student_name=$row->student_name;
$student_phone=$row->student_phone;
$student_idno=$row->student_idno;
$student_address=$row->student_address;
$student_email=$row->student_email;
$student_gender=$row->student_gender;
$assigned_school=$row->assigned_school;
$programme_type=$row->programme_type;
$student_course=$row->student_course;
$login_id=$row->login_id;
$reg_no       =	$this->db->get_where('login' , array('login_id'=>$login_id))->row()->username;
$course_name       =	$this->db->get_where('courses' , array('course_id'=>$student_course))->row()->course_name;
?>
<?php endforeach;?>
<center><blockquote><b>Edit Student : <?php echo $student_name; ?></b></blockquote></center>

 <div id="studentUpdateMessage"></div>
 <?php $attributes = array("name" => "form", 'id'=>'studentUpdateForm');
            echo form_open("admin/students_crud/update/".$student_id, $attributes);?>
            	
                <div class="col-lg-12"> 
            
																<div class="col-lg-12">
                                                                	<h4><strong>Personal Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="u_s_name">Student Name *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_s_name" class="form-control" id="u_s_name" value="<?php echo $student_name;?>">
                                                                        </div>
                                                                    </div>                    
                                                                    <div class="form-group">
                                                                        <label for="u_s_phone">Phone Number *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_s_phone" class="form-control" id="u_s_phone" value="<?php echo $student_phone?>" data-mask="+254 799 999999">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="u_address">Student Address *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_address" class="form-control" id="u_address" value="<?php echo $student_address?>">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                </div>
                                                                <!--line-->
                                                                <div class="col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="u_idno">Student's IDNO *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" class="form-control" name="u_idno" id="u_idno" value="<?php echo $student_idno?>" data-mask="99999999">
                                                                        </div>
                                                                    </div>                    
                                                                    <div class="form-group">
                                                                        <label for="u_email">Email *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_email" class="form-control" id="u_email" value="<?php echo $student_email?>">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="u_gender">Gender *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="u_gender" id="u_gender" class="form-control">
                                                                            	<option value="">Select Gender</option>
                                                                                <option value="1" <?php if($student_gender==1){echo "selected";}?>>MALE</option>
                                                                                <option value="2" <?php if($student_gender==2){echo "selected";}?>>FEMALE</option>
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
                                                                        <label for="u_reg_no">Student's Reg No *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="u_reg_no" class="form-control" id="u_reg_no" style=" text-transform:uppercase;" value="<?php echo $reg_no?>" data-mask="aaaa/99999/9999"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="u_p_type">Programme Type *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="u_p_type" id="u_p_type" class="form-control">
                                                                            	<option value="">Select Programme type</option>
                                                                                
                                                                                <option value="1" <?php if($programme_type==1){echo "selected";}?>>Diploma</option>
                                                                                <option value="2" <?php if($programme_type==2){echo "selected";}?>>Degree</option>
                                                                                <option value="3" <?php if($programme_type==3){echo "selected";}?>>Masters</option>
                                                                                <option value="4" <?php if($programme_type==4){echo "selected";}?>>PHD</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    
                                                                    
                                                                                       
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                         
                                                                    <div class="form-group">
                                                                        <label for="u_school">School *</label>
                                                                        
                                                                        <select name="u_school" id="u_school" class="form-control" onchange="return select_course(this.value)" >
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
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="course">Course *</label>
                                                                        
                                                                        <select name="u_course" id="u_course" class="form-control">
                                                                        	<div id="active_option">
                                                                            <option value="<?php echo $student_course?>"><?php echo $course_name;?></option>
                                                                            </div>
                                                                        </select>
                                                                        
                                                                        <input type="hidden" name="login_id" value="<?php echo $login_id ?>" />
                                                                        
                                                                    </div>
                                                                                       
                                                                                       
                                                                </div>
                                                                
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                	<button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Update Student</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                                </div>
                                                                
                                                                <div class="clearfix"></div>
                                                                
 </form>
 </div>
                                                                    <br />
                                                                    
<script>
	//get course
	function select_course(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/course_crud/select_course/' + id ,
            success: function(response)
            {
				$("#active_option").remove();
                jQuery('#u_course').html(response);
            }
        });

    }
	</script> 