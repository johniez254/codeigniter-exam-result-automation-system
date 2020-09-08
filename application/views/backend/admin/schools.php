
 <div class="col-lg-8">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">All Schools (<?PHP echo $total_schools;?>)</h2>
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
                            <?PHP if($total_schools!='0'){;?>
                                <div style=" overflow:visible; display:block; position:relative;">
                                    <a href="<?php echo base_url()?>download/schools" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right">
                                        <i class="fa fa-print"></i> Print
                                    </a>
                                </div>
                            <?php }else{?>
                                <div style=" overflow:visible; display:block; position:relative;">
                                    <a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print
                                    </a>
                                </div>
                            <?php }?>
                            <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>School Name</th>
                                        <th>Schools Abbreviation</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    foreach($school_query as $row):
                                        $school_id=$row['school_id'];
										$school_name=$row['school_name'];
										$abbr=$row['school_abbr'];
										$posted=$row['date_added'];
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?>.</td>
                                        <td><?php echo $school_name?></td>
                                        <td><?php echo $abbr?></td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="#" onclick="showAjaxModal('<?php echo base_url();?>admin/schools_crud/edit/<?php echo $school_id;?>')">
                                                                <small>
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </small>
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="<?php echo base_url().'admin/view_school/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($school_id)))))))).'' ?>">
                                                                <small>
                                                                    <i class="fa fa-eye"></i> View
                                                                </small>
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/schools_crud/delete/<?php echo $school_id;?>')">
                                                                <small>
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </small>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- /btn-group -->
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
            <h2 class="title pull-left">Add School</h2>
            <div class="actions panel_actions pull-right">
                <i class="box_toggle fa fa-chevron-down"></i>
            </div>
        </header>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php $attributes = array("name" => "form", 'id'=>'schoolForm');
            echo form_open("admin/schools_crud/add", $attributes);?> 
            <div id="schoolMessage"></div>
            <div class="form-group">
                <label>School Name:</label>
                <input type="text" name="s_name" class="form-control" value="" id="s_name" placeholder="Input school name">
                <input type="hidden" name="posted_date" value="<?php echo date("dMY");?>" />
            </div>
            <div class="form-group">
                <label>School Abbreviation:</label>
                <input type="text" name="abbr" class="form-control" value="" id="abbr" placeholder="Input school abbreviation">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary ">
                    <i class="fa fa-plus-circle"></i> Add School
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
