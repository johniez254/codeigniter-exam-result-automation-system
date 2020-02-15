
<script src="<?php echo base_url(); ?>components/customs/schools.js"></script>
<?php foreach($school_id->result() as $row):
$school_id=$row->school_id;
$s_name=$row->school_name;
$s_abbr=$row->school_abbr;
?>
<?php endforeach;?>
<center><blockquote><b>Edit School : <?php echo $s_name; ?></b></blockquote></center>
 <div id="schoolUpdateMessage"></div>
 <?php $attributes = array("name" => "form", 'id'=>'schoolUpdateForm');
            echo form_open("admin/schools_crud/update/".$school_id, $attributes);?> 
            
                                                                <div class="form-group">
                                                                    <label>School Name:</label>
                                                                    <input type="text" name="u_s_name" class="form-control" value="<?php echo $s_name?>" id="u_s_name" placeholder="Input school name">
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label>School Abbreviation:</label>
                                                                    <input type="text" name="u_abbr" class="form-control" value="<?php echo $s_abbr;?>" id="u_abbr" placeholder="Input dean of school name">                                           </div>
                    
                    
                                                                <div class="form-group">
                                                                    
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Update School</button>
                                                                    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                                    </div>
                    
                                                            </form>