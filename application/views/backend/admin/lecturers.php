
<div class="col-lg-12">
    <section class="box purple">
        <header class="panel_header">
            <h2 class="title pull-left">Manage Lecturers</h2>
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
                        <!--<h4>Primary</h4>-->
                        <ul class="nav nav-tabs primary">
                            <li class="active">
                                <a href="#home-1" data-toggle="tab">
                                    <i class="fa fa-users"></i> All Lectures  (<?PHP echo $total_lecturers;?>)
                                </a>
                            </li>
                            <li>
                                <a href="#profile-1" data-toggle="tab">
                                    <i class="fa fa-plus"></i> Add Lecturer 
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content primary">
                            <div class="tab-pane fade in active" id="home-1">
                                <div>
                                    <?PHP if($total_lecturers!='0'){;?>
                                        <div style=" overflow:visible; display:block; position:relative;">
                                            <a href="<?php echo base_url()?>download/lecturers" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                        </div>
                                    <?php }else{?>
                                        <div style=" overflow:visible; display:block; position:relative;">
                                            <a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"onclick="showErrorMessage('Ops! No Data Available!')">
                                                <i class="fa fa-print"></i> Print
                                            </a>
                                        </div>
                                    <?php }?>
                                    <?php /*?><div class="table-responsive"><?php */?>
                                    <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Lecturer Name</th>
                                                <th>Reg Number</th>
                                                <th>Phone Number</th>
                                                <th>IDNO</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=1;
                                           foreach($lecturersQuery as $row):
                                            $lecturer_id=$row['lecturer_id'];
                                            $lecturer_name=$row['lecturer_name'];
                                            $lecturer_phone=$row['lecturer_phone'];
                                            $lecturer_idno=$row['lecturer_idno'];
                                            $lecturer_email=$row['lecturer_email'];
                                            $req_number=$row['username'];
                                            $login_id=$row['login_id'];

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?>.</td>
                                                <td>
                                                    <img src="<?php echo $this->adm->get_image_url('user',$login_id);?>" alt="user-image" class="img-circle img-inline" width="40px" height="40px">
                                                </td>
                                                <td><?php echo ucwords($lecturer_name)?></td>
                                                <td width="10%"><?php echo strtoupper($req_number)?></td>
                                                <td><?php echo $lecturer_phone;?></td>
                                                <td><?php echo $lecturer_idno?></td>
                                                <td><?php echo $lecturer_email?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                                Action
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#" onclick="showCustomAjaxModal('<?php echo base_url();?>admin/lecturers_crud/edit/<?php echo $lecturer_id;?>')">
                                                                        <small>
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </small>
                                                                    </a>
                                                                </li>
                                                                <li role="presentation">
                                                                    <a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/lecturers_crud/delete/<?php echo $lecturer_id;?>')">
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
                        </div>
                        <div class="tab-pane fade" id="profile-1">
                            <!--add lecturer form start-->
                            <?php $attributes = array("name" => "form", 'id'=>'lecturerForm');
                            echo form_open("admin/lecturers_crud/add", $attributes);?> 

                            <div id="lecturerMessage"></div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <h4><strong>Personal Information</strong></h4>
                               <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="l_name">Lecturer Name *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="text" name="l_name" class="form-control" id="l_name">
                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <label for="l_phone">Phone Number *</label>
                                    <span class="desc">e.g +254 7xx xxxxxx</span>
                                    <div class="controls">
                                        <input type="text" name="l_phone" class="form-control" id="l_phone" data-mask="+254 799 999999">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="l_address">Lecturer Address *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" id="address">
                                    </div>
                                </div>
                            </div>
                            <!--line-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="idno">Lecturer's IDNO *</label>
                                    <span class="desc">Will be used as lecturer's login password.</span>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="idno" id="idno" data-mask="99999999">
                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <span class="desc">e,g example@gmail.com</span>
                                    <div class="controls">
                                        <input type="text" name="email" class="form-control" id="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                       <select name="gender" id="gender" class="form-control">
                                           <option value="">Select Gender</option>
                                           <option value="1">MALE</option>
                                           <option value="2">FEMALE</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                            <!------------------------------------------------------------------------------->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4><strong>School Information</strong></h4>
                                <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <?php
                                        $rand=substr(md5(microtime()),rand(0,26),5);
                                    ?>
                                    <label for="reg_no">Lecturer's Registration Number *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="text" name="reg_no" class="form-control" id="reg_no" readonly="readonly" style=" text-transform:uppercase;" value="<?php echo $rand?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="school">Assigned School *</label>
                                    <select name="s2example-2" id="s2example-2" class="" onchange="return select_course(this.value)">
                                        <option></option>
                                        <?php
                                        $s = $this->db->get('schools')->result_array();
                                        foreach($s as $row):
                                        ?>
                                        <option value="<?php echo $row['school_id'];?>">
                                            <?php echo $row['school_name'];?>
                                        </option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4><strong>Lecturer Units Information</strong></h4>
                                <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                   <label for="">Select Course *</label>
                                   <span class="desc">Select school first to view courses. Then select course to view attached units.</span>
                                   <div class="controls">
                                        <select name="s2example-3" id="s2example-3" class="" onchange="return select_units(this.value)">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="s2example-5[]">Select Units *</label>
                                    <span class="desc">Select Course first inorder to view attached units. After Selecting, press <strong>Enter</strong> to add multiple units.</span>
                                    <div class="controls">
                                        <select id="s2example-5" name="s2example-5[]"  multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Add Lecturer</button>
                               <button type="button"  onclick="clearForm()" class="btn btn-warning" id="reset"><i class="fa fa-eraser"></i> Reset</button>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <!--add lecturer end-->
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
                      
                      
                      
                     
                               
<script>
	//get course
	function select_course(id) {

    	$.ajax({
			url: '<?php echo base_url()?>admin/course_crud/select_course/' + id ,
            success: function(response)
            {
                jQuery('#s2example-3').html(response);
            }
        });

    }
	</script>  
    
    
    <script>
	//get course
	function select_units(id) {

    	$.ajax({
			url: '<?php echo base_url()?>admin/units_crud/select_unit/'+id ,
            success: function(response)
            {
                jQuery('#s2example-5').html(response);
            }
        });

    }
	</script>       
 
