<?php
$id		 =	$this->session->userdata('id');
?>
 <div class="col-lg-8">

 
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Manage Profile</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                    <i class="box_close fa fa-times"></i>
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
                                                            <i class="fa fa-bars"></i> Manage Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-unlock-alt"></i> Change Password 
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            
                                                            <!--manage profile form start-->
                                                            
                                                            <?php $setting_id=$this->db->get_where('login', array('login_id' => $id)); ?>
									 
															<?php foreach($setting_id->result() as $row):
                                                                $id=$row->login_id;
                                                                $pass=$row->password;
                                                                $names=$row->name;
                                                                $role=$row->role;
                                                                $em=$row->username;
                                                                
                                                                endforeach
                                                            
                                                            ?>
                                                            
                                                              <?php $attributes = array("name" => "form", 'id'=>'nameForm');
            echo form_open("admin/validate_profile", $attributes);?> 
            
            												<div id="nameMessage"></div>
                                                                <div class="form-group">
                                                                    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                                                                    <label>Name:</label>
                                                                    <input type="text" name="name" class="form-control" value="<?php echo $names?>" id="name" placeholder="Enter your full names">
                                                                </div>
                    
                                                                <div class="form-group">
                                                                    <label>Username:</label>
                                                                    <input type="text" name="username" value="<?php echo $em?>" class="form-control" id="username" placeholder="Enter your username">
                                                                </div>
                    
                                                                <div class="form-group">
                                                                    <label>Role:</label>
                                                                    <input type="text" name="role" class="form-control" id="role" readonly="readonly" value="<?php echo $role?>">
                                                                </div>
                    
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary namesubmit">Save</button>
                                                                    <button type="button" onclick="resetForm()" class="btn btn-warning">Reset</button>
                                                                    </div>
                    
                                                            </form>
                                                            <!--manage profile form end-->


                                                            


                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="profile-1">

                                                         <!--password-->
                                        
                                         		<?php $attributes = array("name" => "form", 'id' => 'passwordForm');
            echo form_open("admin/validate_password", $attributes);?>
            
                                                            <div id="passwordMessage"></div>
                                                            <div class="form-group">
                                                          
                                                                <label>Current Password :</label>
                 												<?php 
																$data=array(
																'name'=> 'oldpass',
																'type'=>'password',
																'placeholder'=>'current password',
																'class'=>'form-control',
																'id'=>'oldpass',
																'value'=>set_value('oldpass'),
																
																);
																echo form_input($data);
																							
																 ?>
                                      
                                                            </div>
                                                           
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>New Password :</label>
                 												<?php 
																	$data=array(
																	'name'=> 'newpass',
																	'type'=>'password',
																	'placeholder'=>'new password',
																	'class'=>'form-control',
																	'id'=>'newpass',
																	'value'=>set_value('newpass'),
																	
																	);
																	echo form_input($data);
																								
								 								?>
                                      
                                                            </div>
                                                           
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>Confirm Password :</label>
														 <?php 
                                                                        $data=array(
                                                                        'name'=> 'confpass',
                                                                        'type'=>'password',
                                                                        'placeholder'=>'confirm password',
                                                                        'class'=>'form-control',
                                                                        'id'=>'confpass',
                                                                        'value'=>set_value('confpass'),
                                                                        
                                                                        );
                                                                        echo form_input($data);
                                                                                                    
								 							?>
                                      
                                                            </div>
                                                           
                                                            
                                                              <?php
														   $data=array(
														   'type'=>'hidden',
														   'name'=>'username',
														   'value'=>$em,
														   );
														   echo form_input($data);
														    ?>
                                                            
                                                         
                                                            <?php 
																$data=array(
																'type'=>'submit',
																'class'=>'btn btn-primary',
																'value'=>'Change Password',
																
																);
																echo form_submit($data);
																?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->

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
                      
                      
                      <!--col-lg-4_start-->
                      <div class="col-lg-4">
                      	 <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Upload Picture</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="team-member ">
                                                    <div class="team-img">
                                                        <img class="img-responsive" src="<?php echo $this->adm->get_image_url('user',$id);?>" alt="admin image">
                                                    </div>
                                                    <div class="team-info">
                                                         <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'admin/update_image', $at);?>
                                                            <div class="form-group">
                                                                <label>Chose a New Picture</label>
                              
                                                                <?php
                                                                $dat=array(
																'type'=>'file',
																'name'=> 'userfile',
																'accept'=>'image/*',
																'id'=>'userfile',
																'required'=>'required'
																
																);
																echo form_input($dat);
																
																 ?>
																								<p class="help-block"><i class="fa fa-warning"></i> Formats (jpg, png, gif, JPG, PNG, GIF)</p>
															  <?php
																								$dat=array(
																'type'=>'submit',
																'value'=>'upload',
																'class'=>'btn btn-primary btn-corner btn-block',
																'id'=>'submit'
																
																);
																echo form_input($dat);
																
																 ?>
                                                            </div>
                                                        <?php echo form_close()?>

                                                </div>
                                        
                                    </div>
                                  </div>
                               </div>
                           </section>
                      </div>
                       <!--col-lg-4 end_-->
                      
                      

 
