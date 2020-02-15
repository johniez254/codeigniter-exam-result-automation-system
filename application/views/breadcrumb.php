<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->role; 
$name       =	$this->db->get_where('login' , array('login_id'=>$id))->row()->name;
?>
<?php if($role=="admin"){?>
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php echo ucwords($page_name);?></h1>                            </div>

                            <?php if($crumb=="1"){?>
                            <?php if($page_name=="dashboard"){?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                </ol>
                            </div>
                            <?php }else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="#"><?php echo ucwords($page_name)?></a>
                                    </li>
                                </ol>
                            </div>
                            <?php }}else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."admin/".$function."" ?>"><?php echo ucwords($page_crumb);?></a>
                                    </li>
                                    <li class="active">
                                        <strong><?php echo $page_title; ?></strong>
                                    </li>
                                </ol>
                            </div>
                            <?php }?>

                        </div>
                    </div>
                    <div class="clearfix"></div>

<?php }?>

<!----------------------------------------------------------------------------------------------------------------------------->

<?php if($role=="lecturer"){?>
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php echo ucwords($page_name);?></h1>                            </div>

                            <?php if($crumb=="1"){?>
                            <?php if($page_name=="dashboard"){?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                </ol>
                            </div>
                            <?php }else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="#"><?php echo ucwords($page_name)?></a>
                                    </li>
                                </ol>
                            </div>
                            <?php }}else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url()?>lecturer/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."lecturer/".$function."" ?>"><?php echo ucwords($page_crumb);?></a>
                                    </li>
                                    <li class="active">
                                        <strong><?php echo $page_title; ?></strong>
                                    </li>
                                </ol>
                            </div>
                            <?php }?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
<?php }?>

<?php if($role=="student"){?>
<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php echo ucwords($page_name);?></h1>                            </div>

                            <?php if($crumb=="1"){?>
                            <?php if($page_name=="dashboard"){?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                </ol>
                            </div>
                            <?php }else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="#"><?php echo ucwords($page_name)?></a>
                                    </li>
                                </ol>
                            </div>
                            <?php }}else{?>
                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url()?>student/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."student/".$function."" ?>"><?php echo ucwords($page_crumb);?></a>
                                    </li>
                                    <li class="active">
                                        <strong><?php echo $page_title; ?></strong>
                                    </li>
                                </ol>
                            </div>
                            <?php }?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php }?>
