
<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
$username      =	$this->db->get_where('login' , array('login_id'=>$id))->row()->username;
$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>
 <?php $lecturer_id=$this->db->get_where('lecturers', array('login_id' => $id)); ?>
									 
									    <?php foreach($lecturer_id->result() as $row):
										$fn=$row->lecturer_name;
										$email=$row->lecturer_email;
										$phone=$row->lecturer_phone;
										$address=$row->lecturer_address;
										$idno=$row->lecturer_idno;
										$assigned_school=$row->assigned_school;
									endforeach;?>
 <?php $school       =	$this->db->get_where('schools' , array('school_id'=>$assigned_school))->row()->school_name; ?>

                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <div class="uprofile-image">
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url()?>lecturer/edit_image/<?php echo $id?>')"><img src="<?php echo $this->lec->get_image_url('user',$id);?>" class="img-responsive"></a>
                                        </div>
                                           
                                        
                                        <div class="uprofile-buttons">
                                            <a href="#" onclick="showAjaxModal('<?php echo base_url()?>lecturer/edit_image/<?php echo $id?>')" class="btn btn-md btn-primary">Edit Image</a>
                                        </div>
                                        <div class="uprofile-name">
                                        <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                            <h3>
                                                <strong><?php echo ucwords($name) ?></strong>
                                                <!-- Available statuses: online, idle, busy, away and offline -->
                                                <span class="uprofile-status online"></span>
                                            </h3>
                                            <?php /*?><p class="uprofile-title"><?php echo ucwords($role) ?></p><?php */?>
                                            <span class="badge badge-lg" badge-md><?php echo ucwords($role) ?></span>

                                        <hr style="border:1px solid rgba(31, 181, 172, 1);" />
                                         
                                        
                                        </div>
                                        <div class="uprofile-info">
                                            <address class="margin-bottom-20 margin-top-10">
                                            <strong><abbr title="Phone">P:</abbr> <?php echo $phone?></strong><br><br>
                                            <i class='fa fa-user'></i> <?php echo $email?><br /><br>
                                            <i class='fa fa-suitcase'></i> <?php echo $address?><br>
                                            
                                        </address>

                                        </div>
                                         

                                    </div>
                                    <div class="col-md-9 col-sm-8 col-xs-12">

                                        <div class="uprofile-content">
                                        
                                        
                                        <div class="col-lg-12">

 
                                        <section class="box ">
                                            
                                            <div class="content-body">    
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                
                
                
                                                        <!-- Horizontal - start -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                
                                                                <ul class="nav nav-tabs nav-justified primary">
                                                                    <li class="active">
                                                                        <a href="#home-1" data-toggle="tab">
                                                                            <i class="fa fa-home"></i> Profile Details
                                                                        </a>
                                                                    </li>
                                                                    <!--<li>
                                                                        <a href="#profile-1" data-toggle="tab">
                                                                            <i class="fa fa-user"></i> Edit Profile 
                                                                        </a>
                                                                    </li>-->
                                                                    <li>
                                                                        <a href="#messages-1" data-toggle="tab">
                                                                            <i class="fa fa-unlock-alt"></i> Change Password
                                                                        </a>
                                                                    </li>
                                                                    
                                                                </ul>
                
                                                                <div class="tab-content primary">
                                                                    <div class="tab-pane fade in active" id="home-1">
                
                                                                        <div>
                                                                        
                                                                        <h4><strong>Personal Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />



                
                                                                            <table class="table table-striped">
                                                                                <tbody>
                                                                                    <tr>
                                                                                    	<td><strong>Registration Number :</strong></td>
                                                                                        <td><?php echo $username?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    	<td><strong>Full Names :</strong></td>
                                                                                        <td><?php echo $fn?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    	<td><strong>Phone Number:</strong></td>
                                                                                        <td><a href="tel:<?php echo $phone?>"><?php echo $phone?></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    	<td><strong>Email :</strong></td>
                                                                                        <td><a href="mailto:<?php echo $email?>"><?php echo $email?></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    	<td><strong>Identification Number :</strong></td>
                                                                                        <td><?php echo $idno?></td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                               </table>
                                                                               
                                                                               <h4><strong>School Information</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />



                
                                                                            <table class="table table-striped">
                                                                                <tbody>
                                                                                    <tr>
                                                                                    	<td><strong>Assigned School :</strong></td>
                                                                                        <td><?php echo $school?></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    	<td><strong>Status</strong></td>
                                                                                        <td><span class="badge badge-md badge-success"><strong>Active</strong></span>
</td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                               </table>

                
                
                                                                        </div>
                
                                                                    </div>
                                                                    <!--<div class="tab-pane fade" id="profile-1">
                
                                                                        <p>2</p>
                
                                                                    </div>-->
                                                                    <div class="tab-pane fade" id="messages-1">
                
                                                                        <!--password-->
                                                                        <h4><strong>Change Password</strong></h4>
                                                                    <hr style="border:1px solid rgba(31, 181, 172, 1);" />

                                        
																			<?php $attributes = array("name" => "form", 'id' => 'passwordForm');
                                        echo form_open("lecturer/validate_password", $attributes);?>
                                        
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
                                                                                       'value'=>$username,
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
                                        

                                        </div>
                                        
                                        <!--end profile content-->









                                    </div>
                                </div>
                            </div>
                        </section></div>


                
            <!-- END CONTENT -->
