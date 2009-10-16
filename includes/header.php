<?php 

	$user_id = $_SESSION['user_id']; 
	//echo $user_id;
	$username = get_username ( $_SESSION['user_id'] );
	//echo $username;
?>
	<!--[if !IE]>start head<![endif]-->
		<div id="head">
			
			<!--[if !IE]>start logo and user details<![endif]-->
			<div id="logo_user_details">
				<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
				<!--[if !IE]>start user details<![endif]-->
				<div id="user_details">
					<ul id="user_details_menu">
						<li><strong><?php echo 'Hello <em><b><u>' . get_username ( $_SESSION['user_id'] ) . '</u></b></em>!'; ?>
</strong></li>
						<li>
							<ul id="user_access">
								<li class="first"><a href="".$directory_string."modules/default_content.php?page=update_profile">My account</a></li>
								<li class="last"><a href="".$directory_string."modules/logout.php">Log out</a></li>
							</ul>
						</li>
					</ul>
					<?php //include "includes/header_search_include.php" ?>
				</div>
				<!--[if !IE]>end user details<![endif]-->
			</div>
			<!--[if !IE]>end logo end user details<![endif]-->
			<!--[if !IE]>start menus_wrapper<![endif]-->
			<div id="menus_wrapper">
				<div id="main_menu">
					<ul>
						<li><a href="".$directory_string."modules/default_content.php?page=general_menu" class="selected"><span><span>General</span></span></a></li>
                        <?php if ( isadmin ( $_SESSION['user_id'] ) ): ?>
						<li><a href="".$directory_string."modules/default_content.php?page=manage_users"><span><span>Manage Users</span></span></a></li>
                        <li><a href="".$directory_string."modules/default_content.php?page=admin_settings"><span><span>Site Settings</span></span></a></li>
                        <?php endif; ?>
                        <li><a href="".$directory_string."modules/default_content.php?page=update_profile"><span><span>My Account</span></span></a></li>
						<li class="last"><a href="".$directory_string."modules/logout.php"><span><span>Logout</span></span></a></li>
					</ul>
				</div>

				<div id="sec_menu">
					<ul>
						<li>
							<span class="drop"><span><span><a href="".$directory_string."modules/members.php" class="sm8">Home</a></span></span></span>
						</li>
						<?php 
							If ( $menu_items = $db->get_results("SELECT * FROM modules WHERE User_ID = '$user_id'") )
								{
								  foreach( $menu_items as $menu_items)
								   { ?>
									<?php include("".$directory_string."modules/$menu_items->module_name/menu_dropdown.php") ?>
                      <?php 	} }else	{ ?> 
					  
					  <?php } ?>
                      
                      <li>
                        <span class="drop"><span><span><a href="#" class="sm8">Support</a></span></span></span>
                        <ul>
                            <li><a class="" href="".$directory_string."modules/default_content.php?page=contact_support&module=support">Request Support</a></li>
                            <li><a class="" href="".$directory_string."modules/default_content.php?page=manage_tickets&module=support">View Tickets</a></li>
                            <!--<li><a class="" href="".$directory_string."modules/default_content.php?page=sms_support&module=support">SOS Request</a></li>-->
                        </ul>
						</li>
					</ul>
				</div>
			</div>
			<!--[if !IE]>end menus_wrapper<![endif]-->
		</div>
		<!--[if !IE]>end head<![endif]-->