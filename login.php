<?php
	require_once ( 'settings.php' );

	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		if ( $_POST['username'] != '' && $_POST['password'] != '' )
		{
			$query = 'SELECT ID, Username, Active, Password FROM ' . DBPREFIX . 'users WHERE Username = ' . $db->qstr ( $_POST['username'] ) . ' AND Password = ' . $db->qstr ( md5 ( $_POST['password'] ) );

			if ( $db->RecordCount ( $query ) == 1 )
			{
				$row = $db->getRow ( $query );
				if ( $row->Active == 1 )
				{
					set_login_sessions ( $row->ID, $row->Password, ( $_POST['remember'] ) ? TRUE : FALSE );
					header ( "Location: " . REDIRECT_AFTER_LOGIN );
				}
				elseif ( $row->Active == 0 ) {
					$error = 'Your membership was not activated. Please open the email that we sent and click on the activation link.';
				}
				elseif ( $row->Active == 2 ) {
					$error = 'You are suspended!';
				}
			}
			else {		
				$error = 'Login failed!';		
			}
		}
		else {
			$error = 'Please use both your username and password to access your account';
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
					<?php if ( isset( $error ) ) { echo '			<p class="error">' . $error . '</p>' . "\n";}?>

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
								<input name="username" type="text" />
							</span>
						</label>
						<label>
							<strong>Password:</strong>
							<span class="input_wrapper">
								<input name="password" type="password" />
							</span>
						</label>
                        <?php if ( ALLOW_REMEMBER_ME ):?>
							<label class="inline">
								<input type="checkbox" name="remember" id="remember" />
								Remember me on this computer?
   		                 </label>
						<?php endif;?>
						
						
						
						<ul class="form_menu">
							<li><span class="button"><span><span>Submit</span></span><input type="submit" name=""/></span></li>
							<li><a href="javascript:window.close()"><span><span>Close</span></span></a></li>
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
