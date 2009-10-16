<?php
	require_once('../settings.php');

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' && $_POST['password'] == $_POST['password_confirmed'] && $_POST['email'] != '' && valid_email ( $_POST['email'] ) == TRUE )
		{
			if ( ! checkUnique ( 'Username', $_POST['username'] ) )
			{
				$error = 'Username already taken. Please try again!';
			}
			elseif ( ! checkUnique ( 'Email', $_POST['email'] ) )
			{
				$error = 'The email you used is associated with another user. Please try again or use the "forgot password" feature!';
			}
			else {		
				$query = $db->query ( "INSERT INTO " . DBPREFIX . "users (`Username` , `Password`, `date_registered`, `Email`, `Random_key`) VALUES (" . $db->qstr ( $_POST['username'] ) . ", " . $db->qstr ( md5 ( $_POST['password'] ) ).", '" . time () . "', " . $db->qstr ( $_POST['email'] ) . ", '" . random_string ( 'alnum', 32 ) . "')" );
				
				$getUser = "SELECT ID, Username, Email, Random_key FROM " . DBPREFIX . "users WHERE Username = " . $db->qstr ( $_POST['username'] ) . "";
		
				if ( $db->RecordCount ( $getUser ) == 1 )
				{			
					$row = $db->getRow ( $getUser );
					
					$subject = "Activation email from " . DOMAIN_NAME;

					$message = "Dear ".$row->Username.", this is your activation link to join our website. In order to confirm your membership please click on the following link: <a href=\"" . APPLICATION_URL . "confirm.php?ID=" . $row->ID . "&key=" . $row->Random_key . "\">" . APPLICATION_URL . "confirm.php?ID=" . $row->ID . "&key=" . $row->Random_key . "</a> <br /><br />Thank you for joining";
					
					if ( send_email ( $subject, $row->Email, $message ) ) {
						$msg = 'Account registered. Please check your email for details on how to activate it.';
					}
					else {
						$error = 'I managed to register your membership but failed to send the validation email. Please contact the admin at ' . ADMIN_EMAIL;
					}
				}
				else {
					$error = 'User not found. Please contact the admin at ' . ADMIN_EMAIL;
				}
			}							
		}
		else {		
			$error = 'There was an error in your data. Please make sure you filled in all the required data, you provided a valid email address and that the password fields match one another.';	
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="../css/admin-login.css"  />
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
							<strong>Username:</strong>
							<span class="input_wrapper">
								<input name="username" type="text" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" />
							</span>
						</label>
						<label>
							<strong>Password:</strong>
							<span class="input_wrapper">
								<input name="password" id="password" type="password" />
							</span>
						</label>
                        <label>
							<strong>Re-Password:</strong>
							<span class="input_wrapper">
								<input name="password_confirmed" id="password_confirmed" type="password" />
							</span>
						</label>
                        <label>
							<strong>Email:</strong>
							<span class="input_wrapper">
								<input name="email" type="text" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" />
							</span>
						</label>
    			
						
						<ul class="form_menu">
							<li><span class="button"><span><span>Submit</span></span><input type="submit" name=""/></span></li>
							
						</ul>
						
						</div>
					</div>
				</fieldset>
			</form>
            <? } ?>
			<!--[if !IE]>end login<![endif]-->
		</div>
		<!--[if !IE]>end login wrapper<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
