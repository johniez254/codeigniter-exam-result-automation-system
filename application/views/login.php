<?php
echo doctype('html5');
$system_name      =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_name;
$system_abbr     =	$this->db->get_where('settings' , array('system_id'=>'1'))->row()->system_abbr;
?>
    

<head>
	<meta charset="utf-8">
	<title><?php echo $system_abbr;?> :: Login page</title>
	
	<?php include'includes_top.php';?> 
    
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" login_page">


        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">
                <h1><a href="<?php echo base_url()?>" title="Login Page" tabindex="-1"><?php echo $system_name?></a></h1>
				
                <div style="background-color:rgba(0, 0, 0, .5); padding:30px;">
                
                <?php $attributes = array("name" => "loginform", 'id'=>'loginform');
            echo form_open("login/validate", $attributes);?>
            					<div id="message"></div>
                    <div class="form-group">
                    <p>
                        <label for="user_login">Username/Reg. Number<br />
                            <input type="text" name="username" id="username" class="input" value="" size="20" autofocus autocomplete="off" placeholder="" /></label>
                    </p>
                            </div>
                    <div class="form-group">
                    <p>
                        <label for="user_pass">Password<br />
                            <input type="password" name="password" id="password" class="input" value="" size="20" placeholder="" /></label>
                    </p>
                    </div>
                    
                    <p class="submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Login" />
                    </p>
                </form>

                <p id="nav">
                    <?php /*?><a class="pull-left" href="#" title="Password Lost and Found">Forgot password?</a><?php */?>
                </p>
                </div>


            </div>
        </div>

        <?php include'includes_bottom.php';?> 


    </body>
</html>



