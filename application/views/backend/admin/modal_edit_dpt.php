
<script src="<?php echo base_url(); ?>components/customs/departments.js"></script>
<?php foreach($dept_id->result() as $row):
$dept_id=$row->dept_id;
$dept_name=$row->department_name;
$s_id=$row->school_id;
?>
<?php endforeach;?>
<center><blockquote><b>Edit Department : <?php echo $dept_name; ?></b></blockquote></center>
 <?php $attributes = array("name" => "form", 'id'=>'dptUpdateForm');
            echo form_open("admin/department_crud/update/".$dept_id, $attributes);?> 
            
            												<div id="dptUpdateMessage"></div>
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select name="u_school" id="u_school" class="form-control" >
                                                                      <?php 
                                                                        $s = $this->db->get('schools')->result_array();
                                                                        foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['school_id'];?>" <?php if($s_id==$row['school_id']){echo "selected";}?>>
                                                                            <?php echo $row['school_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
    
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>Department Name:</label>
                                                                    <input type="text" name="u_d_name" class="form-control" value="<?php echo $dept_name;?>" id="u_d_name" placeholder="Input department name">                                           </div>
                    
                    
                                                                <div class="form-group">
                                                                    
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Update Department</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                                    </div>
                    
                                                            </form>