
<script src="<?php echo base_url(); ?>components/customs/semesters.js"></script>
<?php foreach($semester_id->result() as $row):
$semester_id=$row->semester_id;
$semester_year=$row->semester_year;
$semester_name=$row->semester_name;
$duration_from=$row->duration_from;
$duration_to=$row->duration_to;
?>
<?php endforeach;?>
<center><blockquote class="text-blue"><b>Edit Semester : <?php echo $semester_name; ?> (<?php echo $semester_year; ?>)</b></blockquote></center>
	<div id="updateSemesterMessage"></div>
<form action="<?php echo base_url().'admin/semester_crud/update/'.$semester_id?>" id="semesterUpdateForm" method="post" >
                                                                <div class="form-group">
                                                                    <label>Academic Year</label>
                                                                    <input type="text" name="ac_year" id="ac_year" class="form-control" value="<?php echo $semester_year;?>" />
                                                                
                                                                </div>
 
                                                                <div class="form-group">
                                                                    <label>Select Semester</label>
                                                                    <select  class="form-control" name="m_sem"  id="m_sem" >

                                                                     	<optgroup label="Firt Year">
                                                                        	<option value="1.1" <?php if($semester_name=="1.1"){echo "selected";}?>>Year 1 Semester 1 (1.1)</option>
                                                                        	<option value="1.2" <?php if($semester_name=="1.2"){echo "selected";}?>>Year 1 Semester 2 (1.2)</option>
                                                                        </optgroup>
                                                                        <optgroup label="Second Year">
                                                                        	<option value="2.1" <?php if($semester_name=="2.1"){echo "selected";}?>>Year 2 Semester 1 (2.1)</option>
                                                                        	<option value="2.2" <?php if($semester_name=="2.2"){echo "selected";}?>>Year 2 Semester 2 (2.2)</option>
                                                                        </optgroup>
                                                                        <optgroup label="Third Year">
                                                                        	<option value="3.1" <?php if($semester_name=="3.1"){echo "selected";}?>>Year 3 Semester 1 (3.1)</option>
                                                                        	<option value="3.2" <?php if($semester_name=="3.2"){echo "selected";}?>>Year 2 Semester 2 (3.2)</option>
                                                                        </optgroup>
                                                                        <optgroup label="Fourth Year">
                                                                        	<option value="4.1" <?php if($semester_name=="4.1"){echo "selected";}?>>Year 4 Semester 1 (4.1)</option>
                                                                        	<option value="4.2" <?php if($semester_name=="4.2"){echo "selected";}?>>Year 4 Semester 2 (4.2)</option>
                                                                        </optgroup>

                                                                     
                                                                     </select>
    
                                                                </div>
                                                                <div class="form-group">
                                                                </div><!-- Default Daterange Picker -->
                                            <div class='form-group bootstrap-timepicker'>
                                            	<label for="d_range">Select Duration</label>                                                <input type='text' value="<?php echo $duration_from; ?> - <?php echo $duration_to; ?>" class="form-control daterange" id="d_range" name="d_range" autocomplete="off"/>

                                            </div>
                                                                <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Update Semester</button>
                                                                <button type="button" onclick="resetUpdateForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
                                                            </form>