
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h4><strong>Select student course, unit, and semester to view results</strong></h4>
    <hr style="border:1px solid rgba(31, 181, 172, 1);" />
</div>                                    
<div class="row">
        <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">
            <?php $attributes = array("name" => "form", 'id'=>'resultsForm');
                                        echo form_open("download/unit_results", $attributes);?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Select Course: </label>

                <div class="col-sm-10">

                <select name="course_id" id="s2example-7" onchange="return select_unit(this.value)">
                    <option></option>
                      <?php 
                        //$where="school_id=".$assigned_school."";
                        $this->db->select('*');
                        $this->db->from('courses');
                        //$this->db->group_by('posted_date','desc');
                        //$this->db->where($where);
                        $s  =   $this->db->get()->result_array();
                        foreach($s as $row):
                      ?>
                        <option value="<?php echo $row['course_id'];?>">
                            <?php echo $row['course_name'];?>
                        </option>
                        <?php
                        endforeach;
                        ?>
                    </select>

                    <div id="display_warning" style="display: none;">
                        <p class="text-danger"><small><b>Warning! No units available under this course. <a href="<?php echo base_url()?>admin/courses">Click here to add new unit.</a></b></small></p>
                    </div>
                    </div>
            </div>
            <br /><br />
            <?php /*?><div id="displayUnit" style="display:none;"><?php */?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Select Unit :</label>

                <div class="col-sm-10">
                        <select name="unit_id" id="s2example-8" class="">
                                    <option></option>
                                    </select>
                </div>

                

            </div>
            <?php /*?></div><?php */?>
            <br />
            <?php /*?><div id="displayYear" style="display:none;"><?php */?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Academic Year :</label>

                <div class="col-sm-10">
                <select name="sem_id" id="s2example-6"  onchange="return select_student_results(this.value)">
                    <option></option>
                      <?php 
                        $s = $this->db->get('semesters')->result_array();
                        foreach($s as $row):
                      ?>
                        <option value="<?php echo $row['semester_id'];?>">
                            <?php echo $row['semester_year'];?> <i class="fa fa-angle-double-right"></i> <?php echo 'Year: '.substr($row['semester_name'],0,2);?> Semester: <?php echo substr($row['semester_name'],3);?> (<?php echo $row['semester_name']?>)
                        </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    </div>
                
            </div>
          <?php /*?></div><?php */?>
        </div>
   </div>


   <!--begin result input table-->
    <div class="row">
    <div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">
    
        <div class="table-responsive">
            <table class="table" id="resultTable">
                <thead>
                    <tr>
                        <th>No.</th>                        
                        <th>Student</th>
                        <th>Cat (30%)</th>
                        <th>Final (70%)</th>
                        <th>Total (100%)</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody class="display1">
                </tbody>
            </table>
        <hr size="2" noshade>
        </div>
        
        
        </div>
     </div>
    <!--end result input table-->

    
                                                                
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="display:none;" id="pdf_button">
                <button type="submit" class="btn btn-danger btn-md"><i class="fa fa-file-pdf-o"></i> &nbsp; Download Result in PDF Format </button>
            </div>
        </div>
    
    </form>


   <script>
    //select unit

    //var sem_id = $("#s2example-6").val();
    var unit_id = $("#s2example-8").val();
    function select_unit(id) {

        $.ajax({
            url: '<?php echo base_url()?>lecturer/units_crud/select_unit/' + id ,
            success: function(response)
            {
                jQuery('#s2example-8').html(response);
            }
        });

    }
    //select results
    function select_student_results(id, unit_id=null) {

    var unit_id = $("#s2example-8").val();

        if(unit_id){
            $.ajax({
                url: '<?php echo base_url()?>admin/units_crud/select_student_results/' + id + '/' +unit_id,
                success: function(response)
                {
                    jQuery('.display1').html(response);
                }
            });

        }

    }
    </script> 