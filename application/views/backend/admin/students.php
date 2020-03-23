

 <div class="col-lg-12">

 
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Manage Students</h2>
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
                                                            <i class="fa fa-graduation-cap"></i> All Students  (<?PHP echo $this->db->count_all("students");?>)
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-plus"></i> Add Student 
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>
                                                                    
                                                     <?PHP if($this->db->count_all("students")!='0'){;?>
                                                    <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="<?php echo base_url()?>download/students" target="_blank" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right"><i class="fa fa-print"></i> Print</a>
                                                    </div>
                                                    <?php }else{?>
                                                    <div style=" overflow:visible; display:block; position:relative;">                                        	<a href="#" style="margin-bottom:-25px;"  class="btn btn-info btn-sm  pull-right" onclick="showErrorMessage('Ops! No Data Available!')"><i class="fa fa-print"></i> Print</a>
                                                    </div>
                                                    <?php }?>

                                                            <?php /*?><div class="table-responsive"><?php */?>
                                                                <table id="example2" class="display table table-hover table-condensed table-bordered invoice-table " cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th></th>
                                                                            <th>Student Name</th>
                                                                            <th>Registration Number</th>
                                                                            <th>Phone Number</th>
                                                                            <th>IDNO</th>
                                                                            <th>Email</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                        
                                                                    <tbody>
                                                                     <?php
                                                                        //$where="unit_id='0'";
                                                                        $this->db->select('*');
                                                                        $this->db->from('students');
                                                                        $this->db->order_by('date_registered','desc');
                                                                        //$this->db->where($where);
																		$this->db->join('login', 'login.login_id = students.login_id');
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $i=1;
                                                                        foreach($desc as $row):
                                                                                    $student_id=$row['student_id'];
                                                                                    $student_name=$row['student_name'];
                                                                                    $student_phone=$row['student_phone'];
                                                                                    $student_idno=$row['student_idno'];
                                                                                    $student_email=$row['student_email'];
                                                                                    $student_course=$row['student_course'];
                                                                                    $req_number=$row['username'];
                                                                                    $login_id=$row['login_id'];
                                                                        
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i++;?>.</td>
                                                                            <td><img src="<?php echo $this->adm->get_image_url('user',$login_id);?>" alt="user-image" class="img-circle img-inline" width="40px" height="40px;"></td>
                                                                            <td><?php echo ucwords($student_name)?></td>
                                                                            <td><?php echo strtoupper($req_number)?></td>
                                                                            <td><?php echo $student_phone;?></td>
                                                                            <td><?php echo $student_idno?></td>
                                                                            <td><?php echo $student_email?></td>
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
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="showCustomAjaxModal('<?php echo base_url();?>admin/students_crud/edit/<?php echo $student_id;?>')"><small><i class="fa fa-edit"></i> Edit</small></a></li>
                                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url().'admin/view_result/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($student_id)))))))).'' ?>"><small><i class="fa fa-eye"></i> View Result</small></a></li>
                                                                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>admin/students_crud/delete/<?php echo $student_id;?>')"><small><i class="fa fa-trash"></i> Delete</small></a></li>
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
                                                    <div class="tab-pane fade" id="profile-1">

                                                        <!--add student form start-->
                                                            
                                                             <?php $attributes = array("name" => "form", 'id'=>'studentForm');
            echo form_open("admin/students_crud/add", $attributes);?> 
            
            												<div id="studentMessage"></div>

																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                	<h4><strong>Personal Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                                                </div>

                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="s_name">Student Name *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="s_name" class="form-control" id="s_name">
                                                                        </div>
                                                                    </div>                    
                                                                    <div class="form-group">
                                                                        <label for="s_phone">Phone Number *</label>
                                                                        <span class="desc">e.g +254 7xx xxxxxx</span>
                                                                        <div class="controls">
                                                                            <input type="text" name="s_phone" class="form-control" id="s_phone" data-mask="+254 799 999999">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="address">Student Address *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="address" class="form-control" id="address">
                                                                        </div>
                                                                    </div>
                                                                                        
                                                                </div>
                                                                <!--line-->
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label for="idno">Student's IDNO *</label>
                                                                        <span class="desc">Will be used as student's login password.</span>
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
                                                                        <label for="reg_no">Student's Registration Number *</label>
                                                                        <span class="desc">e.g abcd/1234/<?php echo date('Y');?></span>
                                                                        <div class="controls">
                                                                            <input type="text" name="reg_no" class="form-control" id="reg_no" style=" text-transform:uppercase;" data-mask="aaaa/99999/y"/>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                                        
                                                                    <div class="form-group">
                                                                        <label for="p_type">Programme Type *</label>
                                                                        <span class="desc"></span>
                                                                        <div class="controls">
                                                                        	<select name="p_type" id="p_type" class="form-control" >
                                                                            	<option value="">Select Programme type</option>
                                                                                
                                                                                <option value="1">Diploma</option>
                                                                                <option value="2">Degree</option>
                                                                                <option value="3">Masters</option>
                                                                                <option value="4">PHD</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    
                                                                    
                                                                                       
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                         
                                                                    <div class="form-group">
                                                                        <label for="school">School *</label>
                                                                        
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
                                                                                         
                                                                    <div class="form-group">
                                                                        <label for="course">Course *</label>
                                                                        
                                                                        <select name="s2example-3" id="s2example-3" class="">
                                                                        <option></option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                
                                                                        
                                                                        <input type="hidden" name="date_reg" id="date_reg" value="<?php echo date('dMY');?>" />
                                                                                       
                                                                                       
                                                                </div>
                                                                
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                	<button type="submit" class="btn btn-primary "><i class="fa fa-plus-circle"></i> Add Student</button>
                                                                    <button type="button" onclick="clearForm()" class="btn btn-warning" id="reset"><i class="fa fa-eraser"></i> Reset</button>
                                                                </div>
                                                                
                                                                <div class="clearfix"></div>
                                                                </form>

                                                            
                                                            <!--add student end-->

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
 
