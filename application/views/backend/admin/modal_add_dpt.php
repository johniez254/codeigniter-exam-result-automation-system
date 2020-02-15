
<script src="<?php echo base_url(); ?>components/customs/departments.js"></script>
<?php foreach($dept_id->result() as $row):
$dept_id=$row->dept_id;
$dept_name=$row->department_name;
$s_id=$row->school_id;
?>
<?php endforeach;?>
<center><blockquote><b>Add Course.</b></blockquote></center>
 <?php $attributes = array("name" => "form", 'id'=>'dptAddForm');
            echo form_open("admin/department_crud/update_course/".$dept_id, $attributes);?> 
            
            												<div id="dptAddMessage"></div>
                                                                <input type="hidden" name="m_a_school" value="<?php echo $s_id;?>" />
                                                                <div class="form-group">
                                                                    <label>Department Name:</label>
                                                                    <input type="text" name="u_a_name" class="form-control" value="<?php echo $dept_name;?>" id="u_a_name" readonly="readonly" placeholder="Input department name">                                           						</div>
                                                                 <div class="form-group">
                                                                        <label for="p_type">Programme Type *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="p_a_type" id="p_a_type" class="form-control">
                                                                                <option value="1">Diploma</option>
                                                                                <option value="2">Degree</option>
                                                                                <option value="3">Masters</option>
                                                                                <option value="4">PHD</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                 <div class="form-group">
                                                                    <label for="c_a_name">Course Name*</label>
                                                                    <span class="desc"></span>
                                                                    <div class="controls">
                                                                        <textarea placeholder="Add course name" name="c_a_name" class="form-control autogrow" cols="5" id="c_a_name"></textarea>
                                                                    </div>
                                                                </div>
                    
                    
                                                                <div class="form-group">
                                                                    
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Assign Course</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                                    </div>
                    
                                                            </form>