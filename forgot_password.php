<?php
	require_once ( 'settings.php' );

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['email'] != '' && valid_email ( $_POST['email'] ) == TRUE )
		{
			
			$getUser = 'SELECT ID, Username, Temp_pass, Email FROM ' . DBPREFIX . 'users WHERE Email = ' . $db->qstr ( $_POST['email'] );

			if ( $db->RecordCount ( $getUser ) == 1 )
			{
	
				$temp_pass = random_string ( 'alnum', 12 );
				$row = $db->getRow ( $getUser );
				
				$query = $db->query ( "UPDATE " . DBPREFIX . "users SET Temp_pass='" . $temp_pass . "', Temp_pass_active=1 WHERE `Email`= " . $db->qstr ( $row->Email ) );
				
				
				$subject = "Password Reset Request";
				$message = "Dear " . $row->Username . ", Someone (presumably you), has requested a password reset. We have generated a new password for you to access our website:  <b>$temp_pass</b> . To confirm this change and activate your new password please follow this link to our website: <a href=\"" . APPLICATION_URL . "confirm_password.php?ID=$row->ID&new=$temp_pass\">" . APPLICATION_URL . "confirm_password.php?ID=$row->ID&new=$temp_pass</a> . Don't forget to update your profile as well after confirming this change and create a new password. If you did not initiate this request, simply disregard this email, and we're sorry for bothering you.";	

				if ( send_email ( $subject, $row->Email, $message ) ) {
					$msg = 'New password sent. Please check your email for more details.';
				}
				else {
					$error = 'I failed to send the validation email. Please contact the admin at ' . ADMIN_EMAIL;
				}
			}
			else {
				$error = 'There is no member to match your email.';
			}
		}
		else {
			$error = 'Invalid email !';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="css/admin-login.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-login-ie.css" /><![endif]-->

</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start login wrapper<![endif]-->
		<div id="login_wrapper">
			
			
			<div class="error">
				<div class="error_inner">
	<?php	if ( isset ( $error ) )	{ echo '			<p class="error">' . $error . '</p>' . "\n";	}	?>
	<?php	if ( isset ( $msg ) )	{ echo '			<p class="msg">' . $msg . '</p>' . "\n";	} else {//if we have a mesage we don't need this form again.?>
				</div>
			</div>
			
			
			
			<!--[if !IE]>start login<![endif]-->
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            	<input type="hidden" name="_submit_check" value="1"/> 
				<fieldset>
					<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
					<div class="formular">
						<div class="formular_inner">
						
						<label>
							<strong>Email:</strong>
							<span class="input_wrapper">
								 <input class="input" type="text" id="email" name="email" size="32" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" />
							</span>
						</label>
										
						<ul class="form_menu">
							<li><span class="button"><span><span>Submit</span></span><input type="submit" name=""/></span></li>
							<li><a href="javascript:history.back()"><span><span>Back</span></span></a></li>
							<li><a href="forgot_password.php"><span><span>Forgot Pass</span></span></a></li>
						</ul>
						
						</div>
					</div>
				</fieldset>
			</form>
			<!--[if !IE]>end login<![endif]-->
		</div>
		<!--[if !IE]>end login wrapper<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
<? } ?>