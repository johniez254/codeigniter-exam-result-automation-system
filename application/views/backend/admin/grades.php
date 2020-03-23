<?PHP
 $total_grades= $this->db->count_all("grades");?>

 <div class="col-lg-8">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Manage Grades</h2>
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
                                                            <i class="fa fa-home"></i> All Grades (<?php echo $total_grades;?>)
                                                        </a>
                                                    </li>
                                                    <?php if($total_grades>=0):?>
                                                    <li>
                                                        <a href="#messages-1" data-toggle="tab">
                                                            <i class="fa fa-edit"></i> Edit Grades
                                                        </a>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <!-- ********************************************** -->


                                                                <?php /*?><div class="table-responsive"><?php */?>
                                                                <?PHP if($this->db->count_all("grades")!='0'){;?>
                                                                    <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/grades" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                                                    </div>
                                                                    <?php }else{?>
                                                                    <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm   pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                                                    </div>
                                                                    <?php }?>
                                                                <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Grades</th>
                                                                            <th>Marks (%)</th>
                                                                            <th>Grade Description</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        //$where="unit_id='0'";
                                                                        $this->db->select('*');
                                                                        $this->db->from('grades');
                                                                        //$this->db->order_by('date_added','desc');
                                                                        //$this->db->where($where);
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $i=1;
                                                                        foreach($desc as $row):
                                                                                    $grade_id=$row['grade_id'];
                                                                                    $grade=$row['grade'];
                                                                                    $start_mark=$row['start_mark'];
                                                                                    $end_mark=$row['end_mark'];
                                                                                    $grade_description=$row['grade_description'];
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><?php echo $grade;?></td>
                                                                            <td>(<?php echo $start_mark?> - <?php echo $end_mark?>)</td>
                                                                            <td><?php echo $grade_description;?></td>
                                                                            <td>
                                                                                 <?php /*?><div class="col-md-12 col-sm-12 col-xs-12 btn-iconic">
                                                                                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/units_crud/edit/<?php echo $unit_id;?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                                                                    <button type="button" onclick="confirm_modal('<?php echo base_url();?>admin/units_crud/delete/<?php echo $unit_id;?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                                                                </div><?php */?>
                                                                                <div class="btn-group">
                                                                                    <div class="dropdown">
                                                                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                                                            Action
                                                                                            <span class="caret"></span>
                                                                                        </button>
                                                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                                            <?php /*?><li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/grades_crud/edit/<?php echo $grade_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li><?php */?>
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/grades_crud/delete/<?php echo $grade_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
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

                                                    </div>
                                                    <div class="tab-pane fade" id="messages-1">

                                                        <?php include 'update_grades.php';?>

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
                      <!--------------------------------col-lg-8------------------------------------------------------------->
                       
  				<div class="col-lg-4">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Add Grade</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    	
                                        
                                        <?php $attributes = array("name" => "form", 'id'=>'gradeForm');
            echo form_open("admin/grades_crud/add", $attributes);?> 
            
            							<div id="gradeMessage"></div>
                                            <div class="form-group">
                                                <label for="grade">Grade:</label>
                                                <input type="text" class="form-control" name="grade" id="grade" placeholder="Enter grade…">
                                            </div>

                                            <div class="form-group">
                                                <label for="s_mark">Start Mark:</label>
                                                <span class="desc">In Percentage (%)</span>
                                                	<div class="controls"> 
                                                		<input type="text" class="autoNumeric form-control" name="s_mark" id="s_mark" placeholder="Enter starting mark" data-v-max="100" data-v-min="0">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="e_mark">End Mark:</label>
                                                <span class="desc">In Percentage (%)</span>
                                                	<div class="controls"> 
                                                		<input type="text" class="autoNumeric form-control" name="e_mark" id="e_mark" placeholder="Enter end mark" data-v-max="100" data-v-min="0">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="g_description">Grade Description:</label>
                                                <span class="desc"></span>
                                                	<div class="controls"> 
                                                		<input type="text" class="form-control" name="g_description" id="g_description" placeholder="Enter grade description">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary ">Add Grade</button>
                                                <button type="button" onclick="resetUpdateForm()" class="btn btn-warning">Reset</button>
                                            </div>

                                        </form>

                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                   </div>
