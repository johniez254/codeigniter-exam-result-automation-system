
<script src="<?php echo base_url(); ?>components/customs/units.js"></script>
<?php foreach($unit_id->result() as $row):
$unit_id=$row->unit_id;
$u_name=$row->unit_name;
$u_code=$row->unit_code;
$s_id=$row->school_id;
$c_id=$row->course_id;
?>
<?php endforeach;?>
<center><blockquote class="text-blue"><b>Edit Unit : <?php echo $u_name; ?></b></blockquote></center>
	<div id="updateUnitMessage"></div>
<form action="<?php echo base_url().'admin/units_crud/update/'.$unit_id?>" id="updateUnitForm" method="post" >
 
                                                                <div class="form-group">
                                                                    <label>Select School</label>
                                                                    <select name="m_u_school" id="m_u_school" class="form-control" onchange="return select_course(this.value)">
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
                                                                    <label>Select Course</label>
                                                                    <select name="m_u_course" id="m_u_course" class="form-control">
                                                                    <div  id="initial">
                                                                      <?php
																		$e = $this->db->get_where('courses' , array('school_id' => $s_id))->result_array();
																		foreach ($e as $row) {
																			$course_id=$row['course_id'];
																			$course_name=$row['course_name'];
																	?>
																		<option value="<?php echo $course_id?>" <?php if($c_id==$course_id){echo "selected";}?>><?php echo $course_name;?></option>
																			
																		<?php }?>
                                                                        </div>
                                                                    </select>
    
                                                                </div>
                                                                <div class="form-group">
    	<label>Unit Code</label>
    	<input type="text" name="m_u_code" id="m_u_code" class="form-control" value="<?php echo $u_code?>" />
    
    </div>
	 <div class="form-group">
    	<label>Unit Name</label>
    	<input type="text" name="m_u_name" id="m_u_name" class="form-control" value="<?php echo $u_name; ?>" />
    
    </div>
    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Update Unit</button>
    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
</form>

<script>
	//get shift
	function select_course(id) {

    	$.ajax({
            url: '<?php echo base_url()?>admin/course_crud/select_course/' + id ,
            success: function(response)
            {
				$("#initial").remove();
                jQuery('#m_u_course').html(response);
            }
        });

    }
</script>