
<div class="col-lg-8">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">All Semesters (<?PHP echo $total_semesters;?>)</h2>
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

                       <!-- ********************************************** -->


                       <?php /*?><div class="table-responsive"><?php */?>
                       <?PHP if($total_semesters!='0'){;?>
                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/semesters" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    <?php }else{?>
                        <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                        </div>
                    <?php }?>
                    <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Semester</th>
                                <th>Year</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>weeks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                          <?php
                            function datediffInWeeks($date1, $date2)
                            {
                                if($date1 > $date2) return datediffInWeeks($date2, $date1);
                                $first = DateTime::createFromFormat('m/d/Y', $date1);
                                $second = DateTime::createFromFormat('m/d/Y', $date2);
                                return floor($first->diff($second)->days/7);
                            }

                            
                           $i=1;
                           foreach($semestersQuery as $row):
                             $sem_id=$row['semester_id'];
                             $sem_name=$row['semester_name'];
                             $sem_year=$row['semester_year'];
                             $duration_from=$row['duration_from'];
                             $duration_to=$row['duration_to'];

                             ?>
                             <tr>
                                <td><?php echo $i++;?>.</td>
                                <td><?php echo $sem_name?></td>
                                <td><?php echo $sem_year?></td>
                                <td>(<?php echo $duration_from?> - <?php echo $duration_to?>)</td>
                                <td>
                                   <?php 
                                   $today_date=date('m/d/Y');
                                   $start=new DateTime($today_date);
                                   $end=new DateTime($duration_to);
                                   $interval=$start->diff($end);
                                   $output=$interval->format('%R');
                                   if($output=="+"){ ?>
                                    <span class="badge badge-info"><i class='fa fa-clock-o'></i> In Progress</span>
                                <?php } else{ ?>
                                    <span class="badge badge-secondary"><i class='fa fa-check'></i> Finished</span>
                                <?php } ?>
                            </td>
                            <td><?php echo datediffInWeeks($duration_from, $duration_to);// 21 ?></td>
                            <td>
                                <div class="btn-group">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/semester_crud/edit/<?php echo $sem_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/semester_crud/delete/<?php echo $sem_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
                                        </ul>
                                    </div>
                                </div><!-- /btn-group -->


                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- ********************************************** -->
            <?php /*?></div><?php */?>


        </div>
        <div class="clearfix"><br></div>
    </div>



</div>
</div>
</div>
</section>
</div>
                     
                      
<!--col-lg-4_start-->
<div class="col-lg-4">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">Add Semester</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">    
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php $attributes = array("name" => "form", 'id'=>'semesterForm');
                echo form_open("admin/semester_crud/add", $attributes);?> 

              <div id="semesterMessage"></div>
              <div class="form-group">
               <?php $date=date('Y'); $next_yr=strtotime($date . '+1 year')?>
               <label>Academic Year</label><span class="desc">e.g. "<?php echo $date?> / <?php echo date('Y',$next_yr)?>"</span>
               <div class="controls">
                <input type="text" name="yr" id="yr" class="form-control" data-mask="y/y" placeholder="Input Academic Year">
            </div>
        </div>

        <div class="form-group">
            <label>Select Semester:</label>
            <select  class="" name="s2example-1"  id="s2example-1" >
              <option></option>
              <optgroup label="Firt Year">
                <option value="1.1">Year 1 Semester 1 (1.1)</option>
                <option value="1.2">Year 1 Semester 2 (1.2)</option>
            </optgroup>
            <optgroup label="Second Year">
                <option value="2.1">Year 2 Semester 1 (2.1)</option>
                <option value="2.2">Year 2 Semester 2 (2.2)</option>
            </optgroup>
            <optgroup label="Third Year">
                <option value="3.1">Year 3 Semester 1 (3.1)</option>
                <option value="3.2">Year 2 Semester 2 (3.2)</option>
            </optgroup>
            <optgroup label="Fourth Year">
                <option value="4.1">Year 4 Semester 1 (4.1)</option>
                <option value="4.2">Year 4 Semester 2 (4.2)</option>
            </optgroup>
        </select>
        <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
    </div>
    <div class="form-group">
        <label for="s_m">Semester Period</label>
        <div class="controls">
            <input type="text" name="s_m" id="s_m" class="form-control daterange">
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary ">
            <i class="fa fa-plus-circle"></i> Add Semester
        </button>
        <button type="button" onclick="clearForm()" class="btn btn-warning" id="reset">
            <i class="fa fa-eraser"></i> Reset
        </button>
    </div>
</form>



</div>
</div>
</div>
</section>
</div>
<!--col-lg-4 end_-->  
