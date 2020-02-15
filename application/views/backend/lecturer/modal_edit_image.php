 <?php 
 foreach($image_id->result() as $row):
 	$id=$row->login_id;
 endforeach;
 ?>
 <!--col-lg-12_start-->
                      <div class="col-lg-12">
                      	 <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Upload Profile Picture</h2>
                                <div class="actions panel_actions pull-right">
                                </div>
                            </header>
                            <div class="content-body">    
                            	<div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="team-member ">
                                                    <div class="team-img">
                                                        <img class="img-responsive" src="<?php echo $this->lec->get_image_url('user',$id);?>" alt="admin image">
                                                    </div>
                                                    <div class="team-info">
                                                         <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'lecturer/update_image', $at);?>
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
																'required'=>'required',
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