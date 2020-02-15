
<script src="<?php echo base_url(); ?>components/customs/units.js"></script>
<?php foreach($unit_id->result() as $row):
$unit_id=$row->unit_id;
$u_name=$row->unit_name;
$u_code=$row->unit_code;
$s_id=$row->school_id;
?>
<?php endforeach;?>
<center><blockquote class="text-blue"><b>Edit Unit : <?php echo $u_name; ?></b></blockquote></center>
	<div id="assignUnitMessage"></div>
<form action="<?php echo base_url().'admin/units_crud/unit_assign_update/'.$unit_id?>" id="assignUnitForm" method="post" >
 
                                                                <div class="form-group">
                                                                    <label>Select Lecturer</label>
                                                                    <select name="m_lecturer" id="m_lecturer" class="form-control">
                                                                      <?php
																	  	$where=array("assigned_school"=>$s_id); 
                                                                         $this->db->select('*');
																		 $this->db->from('lecturers');
																		 $this->db->order_by('date_registered','desc');
																		$this->db->where($where);
																		$s	=	$this->db->get()->result_array();
																								foreach($s as $row):
                                                                      ?>
                                                                        <option value="<?php echo $row['lecturer_id'];?>">
                                                                            <?php echo $row['lecturer_name'];?>
                                                                        </option>
                                                                        <?php
                                                                        endforeach;
                                                                        ?>
                                                                    </select>
    
                                                                </div>
                                                                <div class="form-group">
    	<label>Unit</label>
    	<input type="text" readonly="readonly" name="m_unit" id="m_unit" class="form-control" value="<?php echo $u_name;?> (<?php echo $u_code?>)" />
    
    </div>
    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Assign Unit</button>
    <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
</form>