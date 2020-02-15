
<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>
<?php if($role=="admin"){?>
<div class='page-topbar '>
            <div class='logo-area'>

            </div>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        
                    </ul>
                </div>		
                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                            <?php if ($this->session->userdata('logged_in') === TRUE){?>
                                <img src="<?php echo $this->adm->get_image_url('user',$id);?>" alt="user-image" class="img-circle img-inline"><?PHP }?>
                                <span><?php echo ucwords($name);?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?php echo base_url()?>admin/settings">
                                        <i class="fa fa-wrench"></i>
                                        Settings
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>admin/profile">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?php echo base_url()?>admin/logout">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>			
                </div>		
            </div>

        </div>
        <?php }?>
        
        <!----------------------------------------------------------------------------------------------------------------->
		
        <?php if($role=="lecturer"){?>
        <div class='page-topbar '>
            <div class='logo-area'>

            </div>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        
                    </ul>
                </div>		
                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                            
                            <?php if ($this->session->userdata('logged_in') === TRUE){?>
                                <img src="<?php echo $this->lec->get_image_url('user',$id);?>" alt="user-image" class="img-circle img-inline"><?php }?>
                                <?php $stringed_name=explode(' ', trim($name));?>
                                <span><?php echo ucwords($stringed_name[0]);?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                
                                <li>
                                    <a href="<?php echo base_url()?>lecturer/profile">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?php echo base_url()?>lecturer/logout">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>			
                </div>		
            </div>

        </div>
		<?php }?>
        
        <?php if($role=="student"){?>
		
        <div class='page-topbar '>
            <div class='logo-area'>

            </div>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        
                    </ul>
                </div>		
                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?php echo $this->stud->get_image_url('user',$id);?>" alt="user-image" class="img-circle img-inline">
                                <span><?php echo ucwords($name);?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                
                                <li>
                                    <a href="<?php echo base_url()?>student/profile">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?php echo base_url()?>student/logout">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>			
                </div>		
            </div>

        </div>
        
        <?php } ?>