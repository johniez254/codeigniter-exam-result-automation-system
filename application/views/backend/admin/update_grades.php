<form class="form-horizontal" method="POST" action="<?php echo base_url().'admin/grades_crud/update_grades' ?>" id="updateGradesForm">
    <div class="success-mess"></div>
    <div class="table-responsive">
        <table class="table" id="updateGradeTable">
            <thead>
                <tr>
                 <th>No.</th>			  			
                 <th>Grade</th>
                 <th>Start Mark (%)</th>
                 <th>End Mark (%)</th>
                 <th>Grade Description</th>
             </tr>
         </thead>
         <tbody>
            <?php
            $arrar = 1;
            $p=1;
            $gradesQuery=$this->status->gradesQuery();
            foreach($gradesQuery as $row):
                $grade_id=$row['grade_id'];
                $grade=$row['grade'];
                $start_mark=$row['start_mark'];
                $end_mark=$row['end_mark'];
                $g_desc=$row['grade_description'];
            ?>
            <tr id="row<?php echo $p; ?>" class="<?php echo $arrar; ?>">
                <td>
                    <input type="button" class="form-control" disabled="true" value="<?php echo $p; ?>">
                    <input type="hidden" name="ugid[]" value="<?php echo $grade_id?>" id="ugid<?php echo $p;?>">
                </td>
                <td width="20px"><input type="text" name="ugrade[]" value="<?php echo $grade; ?>" class="form-control" id="ugrade<?php echo $p;?>">
                </td>
                <td>
                    <input type="text" name="usmark[]"  value="<?php echo $start_mark;?>" autocomplete="off" class="autoNumeric form-control" placeholder="" data-v-max="100" data-v-min="0" id="usmark<?php echo $p;?>">
                </td>
                <td>
                    <input  type="text" name="uemark[]" value="<?php echo $end_mark;?>" autocomplete="off" class="autoNumeric form-control" placeholder="" data-v-max="100" data-v-min="0" id="uemark<?php echo $p;?>">
                </td>
                <td>
                    <input type="text" name="ugdesk[]" value="<?php echo $g_desc;?>" autocomplete="off" class="form-control" id="ugdesk<?php echo $p;?>">
                </td>
            </tr>
                <?php
                $arrar++;
                $p++;
            endforeach; ?>
        </tbody>
    </table>
    <div id="ugradebuttons">
        <button class="btn btn-primary" type="submit" onclick="updateGradesForm()" id="updateBtn" data-loading-text="<i class='fa fa-check-circle'></i> Updating...">
            <i class="fa fa-check-circle"></i> Update Grades
        </button>
        <button type="reset" onclick="resetUpdateForm()" class="btn btn-warning">
            <i class="fa fa-eraser"></i> Reset
        </button>
    </div>
</div>
</form>
                                        