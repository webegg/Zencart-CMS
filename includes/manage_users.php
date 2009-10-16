<?php	
	require_once('settings.php');
	include ( 'lib/Pagination.php' );
	checkLogin ( '1' );
	
	$active_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 1" );
	$inactive_users		=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 0" );
	$suspended_users	=	$db->RecordCount ( "SELECT ID FROM `users` WHERE `Active` = 2" );
	
	$which_users		=	( numeric ( $_GET['active'] ) ) ? $_GET['active'] : '1';
	
	$pagination = new Pagination();
	$pagination->start = ( @$_GET['start'] ) ? $_GET['start'] : '0';
	$pagination->filePath = APPLICATION_URL . 'manage_users.php';
	$pagination->select_what = '*';
	$pagination->the_table = '`' . DBPREFIX . 'users`';
	$pagination->add_query = ' WHERE `Active` = ' . $db->qstr ( $which_users ) . ' ORDER BY `ID` DESC';
	$pagination->otherParams = '&active=' . $which_users;
	
	$query = $pagination->getQuery ( TRUE );
	$paginate = $pagination->paginate();

?>
	<script type="text/JavaScript">
	<!--
		function MM_jumpMenu(targ,selObj,restore){ //v3.0
		  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
		  if (restore) selObj.selectedIndex=0;
		}
	//-->
	</script>

	<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Users</h2>
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
                            
                            <form action="#">
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td colspan="4">
                                        <DIV align="center"><a href="default_content.php?page=manage_users"><b>Active</b></a> | 
                                        <a href="default_content.php?page=manage_users&active=0"><b>Inactive</b></a> | 
                                        <a href="default_content.php?page=manage_users&active=2"><b>Suspended</b></a></DIV>
                                        </td>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                	<th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Options</th>
                                </tbody>
                                    <?php
										$nr = 1;
										if ( $db->RecordCount ( $query ) > 0 )
										{
											$users = $db->get_results ( $query );
											require_once ( BASE_PATH . "/lib/date_class/date.php" );
											$date = new DateClass ();//Create the date class instance
											foreach ( $users as $row ):
									?>
                                    <tbody>
                                        <td><b><?=$nr?></b></td>
                                        <td><DIV align="left" style="padding-left:8px"><?=$row->Username?></DIV></td>
                                        <td><DIV align="left" style="padding-left:8px"><?=$row->Firstname?> <?=$row->Lastname?></DIV></td>
                                        <td width="60">
                                            <DIV align="center">
                                            
                                                <select name="option" onChange="MM_jumpMenu('parent',this,0)">
                                                    
                                                    <option>----------</option>
<?php
						if ( $row->Active == 1 || $row->Active == 0 ):
?>
							<option value="default_content.php?page=admin_options&ID=<?=$row->ID?>&action=suspend&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Suspend</option>
<?php 
						endif;
?>
							
<?php
						if ( $row->Active == 0 || $row->Active == 2 ):
?>
							<option value="default_content.php?page=admin_options&ID=<?=$row->ID?>&action=activate&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Activate</option>
<?php
						endif;
?>
							<option value="default_content.php?page=admin_options&ID=<?=$row->ID?>&action=delete&active=<?=$_GET['active']?>&start=<?=$_GET['start']?>">Delete</option>
							
						</select>
					
					</DIV>
				</td>
			</tr>
<?php
	$nr++;
		endforeach;
	}
	else {
?>
			<tr>
				<td colspan="3">No users to display</td>
			</tr>
<? } ?>
				
		</table>
	
		<?=$paginate;?>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="includes/register.php" target="_blank" class="button add_new"><span><span>ADD NEW USER</span></span></a></li>
                                </ul>
                                <ul class="right">
                                   
                                </ul>
                            </div>
                            <!--[if !IE]>end table menu<![endif]-->
                            
                            
                            </fieldset>
                            </form>
                            
                            
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

</body>

</html>