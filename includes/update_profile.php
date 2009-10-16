<?php 
	require_once('settings.php');
	checkLogin('1 2');
	
	$query = "SELECT * FROM `" . DBPREFIX . "users` WHERE `ID` = " . $db->qstr ( $_SESSION['user_id'] );
	$row = $db->getRow ( $query );
	
	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( valid_email ( $_POST['email'] ) )
		{			
			$update = "UPDATE " . DBPREFIX . "users SET Email = " . $db->qstr ( $_POST['email'] );
			
			//do we allow users to change their usernames
			if ( ALLOW_USERNAME_CHANGE ) {
				$update .= ", Username = " . $db->qstr ( $_POST['username'] );
			}
			
			//if we have a new password via POST we update the old one
			if ( $_POST['password'] != '' ):
				$update .= ", Password = " . $db->qstr ( md5 ( $_POST['password'] ) );
			endif;
			
			$update .= " WHERE ID = " . $db->qstr ( $_SESSION['user_id'] );
			
			if ( $db->query ( $update ) )
			{
				$msg = 'Your profile was successfully updated!';
			}
			else {
				$error = 'I was unable to save your profile. Please contact the administrator at ' . ADMIN_EMAIL;
			}			 
		}
		else {
			$error = 'Invalid email address';
		}
	}
	

?>

	<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Manage My Account</h2>
        <span class="title_wrapper_left"></span>
        <span class="title_wrapper_right"></span>
    </div>
    <!--[if !IE]>end title wrapper<![endif]-->
    <!--[if !IE]>start section content<![endif]-->
    <div class="section_content">
        <!--[if !IE]>start section content top<![endif]-->
        <div class="sct">
            <div class="sct_left">
                <div class="sct_right">
                    <div class="sct_left">
                        <div class="sct_right">  
                                                          
                            <p>
                                To update any settings within your account, please use the forms below.
                            </p>
                            
                            
                            <!--[if !IE]>start forms<![endif]-->
                            <form action="<?=$_SERVER['PHP_SELF']?>?page=update_profile" method="post" class="search_form general_form">
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <input type="hidden" name="_submit_check" value="1"/> 
			
                                    <label for="username">Username</label>
                                    <input class="input" type="text" id="username" name="username" size="32" <?php if ( ! ALLOW_USERNAME_CHANGE ): echo 'disabled'; endif; ?> value="<?=$row->Username?>" />
                                    <br /><br />
                                    <label for="password">Password</label>
                                    <input class="input" type="password" id="password" name="password" size="32" value="" />
                                    <br /><br />
                                    <label for="email">Email</label>
                                    <input class="input" type="text" id="email" name="email" size="32" value="<?=$row->Email?>" />
                                    <br /><br />
                                    <input type="submit" name="register" value="Update Profile"  alt="submit" title="submit" />
                                    <div class="clear"></div>
                                    </div>
                                    <!--[if !IE]>end forms<![endif]-->
                                    
                                </fieldset>
                                <!--[if !IE]>end fieldset<![endif]-->
                                
                                
                                
                                
                            </form>
                            <!--[if !IE]>end forms<![endif]-->	
                            
                            <!--[if !IE]>start system messages<![endif]-->
                            <ul class="system_messages">
                            <?php	if ( isset ( $error ) )	{ ?>
                            <li class="red"><span class="ico"></span><strong class="system_title">
								<?php echo '			<p class="error">' . $error . '</p>' . "\n";	}	?>
                            </strong></li>
                            
                            <?php	if ( isset ( $msg ) )	{ ?> 
                            <li class="red"><span class="ico"></span><strong class="system_title">
								<?php echo '			<p class="msg">' . $msg . '</p>' . "\n";	}	?>
                            </strong></li>
                            </ul>
                            <!--[if !IE]>end system messages<![endif]-->
                                    
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--[if !IE]>end section content top<![endif]-->
        <!--[if !IE]>start section content bottom<![endif]-->
        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
        <!--[if !IE]>end section content bottom<![endif]-->
        
    </div>
    <!--[if !IE]>end section content<![endif]-->
</div>
<!--[if !IE]>end section<![endif]-->
