<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Manage System Settings</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                
                                
                                            <div class="col-md-12">

                                                <ul class="nav nav-tabs nav-justified primary">
                                                    <li class="active">
                                                        <a href="#home-1" data-toggle="tab">
                                                            <i class="fa fa-cog"></i> General System Settings
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#profile-1" data-toggle="tab">
                                                            <i class="fa fa-file-image-o"></i> Upload University Logo 
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content primary">
                                                    <div class="tab-pane fade in active" id="home-1">

                                                        <div>

                                                            <!--settings form start-->
                                         <?php $setting_id=$this->db->get_where('settings', array('system_id' => 1)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
												$id=$row->system_id;
												$sname=$row->system_name;
												$abbr=$row->system_abbr;
												$address=$row->system_address;
												$em=$row->system_email;
												$phone=$row->system_phone;
												$institution=$row->institution;


?>

                                 		<?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'id' => 'settingsForm');
            echo form_open("admin/validate_setting", $attributes);?>
            <div id="settingMessage"></div>
            												<div class="form-group">
                                                          
                                                           <label>Institution :</label>
															 <?php 
                                                            $data=array(
                                                            'name'=> 'institution',
                                                            'type'=>'text',
                                                            'placeholder'=>'Institution name',
                                                            'class'=>'form-control',
                                                            'id'=>'institution',
                                                            'value'=>$institution,
                                                            'autocomplete'=>'off'
                                                            
                                                            );
                                                            echo form_input($data);
                                                                                        
                                                             ?>
                                      
                                                            </div>
                                                            
                                                           <div class="form-group">
                                                          
                                                                <label>System Name :</label>
															 <?php 
                                                            $data=array(
                                                            'name'=> 'sname',
                                                            'type'=>'text',
                                                            'placeholder'=>'system name',
                                                            'class'=>'form-control',
                                                            'id'=>'sname',
                                                            'value'=>$sname,
                                                            'autocomplete'=>'off'
                                                            
                                                            );
                                                            echo form_input($data);
                                                                                        
                                                             ?>
                                      
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>System Abbreviation :</label>
													 			<?php 
                                                                    $data=array(
                                                                    'name'=> 'abr',
                                                                    'type'=>'text',
                                                                    'placeholder'=>'abbreviation',
                                                                    'class'=>'form-control',
                                                                    'id'=>'abr',
                                                                    'value'=>$abbr,
                                                                    'autocomplete'=>'off'
                                                                    
                                                                    );
                                                                    echo form_input($data);
                                                                                                
                                                                ?>
                                      
                                                            </div>
                                                           
                                                            <div class="form-group">
                                                          
                                                                  <label>Address :</label>
                                                     				<?php 
                                                                    $data=array(
                                                                    'name'=> 'address',
                                                                    'type'=>'text',
                                                                    'placeholder'=>'address',
                                                                    'class'=>'form-control',
                                                                    'id'=>'address',
                                                                    'value'=>$address,
                                                                    'autocomplete'=>'off'
                                                                    
                                                                    );
                                                                    echo form_input($data);
                                                                                                
                                                                     ?>
                                      
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                                      
                                                             <label>Email :</label>
                                             				<?php 
                                                            $data=array(
                                                            'name'=> 'email',
                                                            'type'=>'text',
                                                            'placeholder'=>'email',
                                                            'class'=>'form-control',
                                                            'id'=>'email',
                                                            'value'=>$em,
                                                            'autocomplete'=>'off'
                                                            
                                                            );
                                                            echo form_input($data);
                                                                                        
                                                             ?>
                                      
                                                            </div>
                                                            
                                                            
                                                         <div class="form-group">
                                                           <label>Phone number :</label>
                                         				<?php 
															$data=array(
															'name'=> 'phone',
															'type'=>'number',
															'placeholder'=>'phone number',
															'class'=>'form-control',
															'id'=>'phone',
															'value'=>$phone,
															'autocomplete'=>'off'
															
															);
															echo form_input($data);
                                                                                    
                                                         ?>
                                      
                                                            </div>
                                                            
                                  
                                                            
                                                            <?php 
															$data=array(
															'type'=>'submit',
															'class'=>'btn btn-primary',
															'value'=>'save',
															
															);
															echo form_submit($data);
															?>
                                
																			   <?php 
                                                        $data=array(
                                                        'type'=>'button',
                                                        'class'=>'btn btn-warning',
                                                        'value'=>'Reset',
														'onclick'=>'resetForm()',
                                                        
                                                        );
                                                        echo form_reset($data);
                                                        ?>
                                                                                    
                                           <?php echo form_close()?>
                                        <!--settings form end-->


                                                        </div>

                                                    </div>
                                                    <div class="tab-pane fade" id="profile-1">
                                                    
                                                    
                                                    
                                            <div class="col-sm-3 col-md-3">
                                            </div>

                                                    
                                                    

                                                        <div class="team-member">
                                                    <div class="team-img">
                                                        <img class="img-responsive" src="<?php echo $this->adm->get_image_url('school','logo');?>" alt="school logo image">
                                                    </div>
                                                    <div class="team-info">
                                                         <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'admin/school_logo', $at);?>
                                                            <div class="form-group">
                                                                <label>Select a New Logo</label>
                              
                                                                <?php
                                                                $dat=array(
																'type'=>'file',
																'name'=> 'userfile',
																'accept'=>'image/*',
																'id'=>'userfile',
																'required'=>'required',
																//'class'=>'tex-center',
																
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

                                            </div>

                                
                                    
                                </div>
                            </div>
                        </section></div>



                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <section class="box primary">
                            <header class="panel_header">
                                <h2 class="title pull-left">UPLOAD LOGO</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">



										
                                                <div class="team-member ">
                                                    <div class="team-img" style="background:rgba(153, 114, 181, 1.0);">
                                                        <img class="img-responsive" src="<?php echo $this->adm->get_image_url('logo','logo');?>" alt="logo image">
                                                    </div>
                                                    <div class="team-info">
                                                         <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'admin/update_logo', $at);?>
                                                            <div class="form-group">
                                                                <label>Select a New Logo</label>
                              
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
                            </div>
                        </section></div>
                        
                        
                        
                        
                         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <section class="box purple">
                            <header class="panel_header">
                                <h2 class="title pull-left">Data Manager</h2>
                                <div class="actions panel_actions pull-right">
                                    <i class="box_toggle fa fa-chevron-down"></i>
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">



										
                                            <!-- Accordion START -->
                                                <div class="panel-group primary" id="accordion-2" role="tablist" aria-multiselectable="true">
                                                    
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <center>
                                                                <a class="collapsed btn btn-info btn-block" data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-2" aria-expanded="false" aria-controls="collapseTwo-2">
                                                                    <i class='fa fa-download'></i> Backup
                                                                </a>
                                                                </center>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo-2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                 <!--back up data-->
                                                        <center>
                                                        
                                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" >

                                                        <tbody>
                                                                                            
                                                                                            
                                                            <?php 
                                    
                                                            for($i = 1; $i<= 13; $i++):
                                    
                                                            
                                    
                                                                if($i	==	1)	$type	=	'all';
                                    
                                                                else if($i	==	2)$type	=	'courses';
																else if($i	==	3)$type	=	'departments';
																else if($i	==	4)$type	=	'grades';
																else if($i	==	5)$type	=	'lecturers';
																else if($i	==	6)$type	=	'login';
																else if($i	==	7)$type	=	'manage_units';
																else if($i	==	8)$type	=	'results';
																else if($i	==	9)$type	=	'schools';
																else if($i	==	10)$type	=	'semesters';
																else if($i	==	11)$type	=	'settings';
																else if($i	==	12)$type	=	'students';
																else if($i	==	13)$type	=	'units';
                                    
                                                                ?>
                                    
                                                                <tr>
                                    
                                                                    <td><?php echo $type;?></td>
                                    
                                                                    <td align="center">
                                    
                                                                        <a href="<?php echo base_url();?>admin/data_manager/create/<?php echo $type;?>" 
                                    
                                                                            class="btn btn-success btn-xs" data-toggle="tooltip" title="download backup"><i class="fa fa-download" ></i>
                                    
                                                                                </a>
                                    
                                                                    </td>
                                    
                                                                </tr>
                                    
                                                                <?php 
                                    
                                                            endfor;
                                    
                                                            ?>
                                    
                                                        </tbody>
                                    
                                                    </table>
                                    
                                                    </center>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            <!-- Accordion END -->





                                    </div>
                                </div>
                            </div>
                        </section></div>
                        



                       
 
