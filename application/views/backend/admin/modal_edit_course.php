
<script src="<?php echo base_url(); ?>components/customs/courses.js"></script>
<?php foreach($course_id->result() as $row):
$school_id=$row->school_id;
$course_id=$row->course_id;
$dept_id=$row->dept_id;
$course_name=$row->course_name;
$p_type=$row->programme_type;

$dept_name       =	$this->db->get_where('departments' , array('dept_id'=>$dept_id))->row()->department_name;
$school_name       =	$this->db->get_where('schools' , array('school_id'=>$school_id))->row()->school_name;
?>
<?php endforeach;?>
<center><blockquote><b>Edit Course : <?php echo $course_name; ?></b></blockquote></center>
 <?php $attributes = array("name" => "form", 'id'=>'courseUpdateForm');
            echo form_open("admin/course_crud/update/".$course_id, $attributes);?> 
            
            												<div id="courseUpdateMessage"></div>
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select name="u_school" id="u_school" class="form-control"  onchange="return select_department(this.value)">
                                                                      <?php 
                                                                        $s = $this->db->get('schools')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['school_id'];?>" <?php if($school_id==$row['school_id']){echo "selected";}?>>
                                                                            <?php echo $row['school_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Select Department</label>
                                                                    <select name="u_dpt" id="u_dpt" class="form-control" >
                                                                          <div id="active_option">
                                                                                <option value="<?php echo $dept_id?>"><?php echo $dept_name;?></option>
                                                                            </div>
                                                                    </select>
    
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Select Programme Type:</label>
                                                                    <select name="u_p_type" id="u_p_type" class="form-control" >
                                                                        <option value="1" <?php if($p_type==1){echo "selected";}?>>
                                                                            Diploma
                                                                        </option>
                                                                        
                                                                        <option value="2" <?php if($p_type==2){echo "selected";}?>>
                                                                            Degree
                                                                        </option>
                                                                        
                                                                        <option value="3" <?php if($p_type==3){echo "selected";}?>>
                                                                            Masters
                                                                        </option>
                                                                        
                                                                        
                                                                        <option value="4" <?php if($p_type==4){echo "selected";}?>>
                                                                            PHP
                                                                        </option>
                                                                    </select> 
                                                                    </div> 
                                                                    
                                                                 <div class="form-group">
                                                                    <label for="u_c_name">Course Name</label>
                                                                        <textarea placeholder="Add course name" name="u_c_name" class="form-control autogrow" cols="5" id="u_c_name"><?php echo $course_name;?></textarea>
                                                                        
                                                                        <input type="hidden" name="p_dpt" value="<?php echo $dept_id?>" />
                                                                </div>            
                                                                    
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Update Course</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                    
                                                            </form>
 <script>
	//get course
	function select_department(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/course_crud/update_select_department/' + id ,
            success: function(response)
            {
				$("#active_option").remove();
                jQuery('#u_dpt').html(response);
            }
        });

    }
	</script>   