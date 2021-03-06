<div class="col-lg-12">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">Courses</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">    
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Horizontal - start -->
                <div class="row">
                    <div class="col-md-12">

                        <ul class="nav nav-tabs primary">
                            <li class="active">
                                <a href="#home-1" data-toggle="tab">
                                    <i class="fa fa-building"></i> Courses (<?php echo $countCourses;?>)
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content primary">
                            <div class="tab-pane fade in active" id="home-1">

                                <div>

                                    <h4><strong>School : <?php echo $schoolAttached;?></strong></h4>
                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                    <div class="table-responsive">
                                        <?PHP if($countCourses!='0'){;?>
                                            <div style=" overflow:visible; display:block; position:relative;">
                                                <a href="<?php echo base_url()?>download/courses/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($schoolAttachedId))))))))?>" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                            </div>
                                        <?php }else{?>
                                            <div style=" overflow:visible; display:block; position:relative;">
                                                <a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                            </div>
                                        <?php }?>
                                        <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Course</th>
                                                    <th>Total Students</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                               <?php
                                               $i=1;
                                               foreach($coursesQuery as $row):
                                                 $dept_id=$row['dept_id'];
                                                 $course_id=$row['course_id'];
                                                 $course_name=$row['course_name'];
                                                 $p_type=$row['programme_type'];

                                                 $cs="student_course=".$course_id."";
                                                 $this->db->select('*');
                                                 $this->db->from('students');
                                                 $this->db->where($cs);
                                                 $count_students	=	$this->db->count_all_results();

                                                 ?>
                                                 <tr>
                                                    <td><?php echo $i++;?>.</td>
                                                    <td><?php echo $course_name?></td>
                                                    <td class="text-right" width="100px;"><?php echo $count_students?></td>
                                                    <td>
                                                    	<?php if($count_students!="0"){?>
                                                            <a role="menuitem" tabindex="-1" class="btn btn-default" href="<?php echo base_url().'lecturer/view_students/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($course_id)))))))).'' ?>"><small><i class="fa fa-eye"></i> View Students</small></a>
                                                        <?php }?>

                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <!-- ********************************************** -->
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                <div class="clearfix"><br></div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
                      
                      
                      
                      