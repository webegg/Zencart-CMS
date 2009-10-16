<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Trainees</h2>
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
                                    <tbody><tr>
                                        <th>No.</th>
                                        <th>Trainee Name</th>
                                        <th>Fin. Union?</th>
                                        <th>Employer</th>
                                        <th>Trade</th>
										<th>Status</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $projects = $db->get_results("SELECT * FROM trainees") )
			{
              foreach( $projects as $projects)
 			   {
				$id = $projects->employer_id;
			   $employer = $db->get_var("SELECT employer_name FROM employers WHERE employer_id='$id'");
			   $trade_id = $projects->trade_id;
			   $trade = $db->get_var("SELECT trade_name FROM trades WHERE trade_id='$trade_id'");
			   ?>
            							<tr class="first">
                                        
										  <td><?php echo $projects->trainee_id ?></td>
										  <td><?php echo $projects->trainee_fname ?> <?php echo $projects->trainee_sname ?></td>
										  <td><form><input type="checkbox" <?php if ( $projects->fin_union == 1 ) {	echo "checked=checked"; } else { }?> name="fin_union"/></form></td>
										  <td><span class='statusPaid'><?php echo $employer ?></span></td>
										  <td><span class='statusPaid'><?php echo $trade ?></span></td>
										  <td><span class='statusPaid'><?php echo $projects->status ?></span></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_trainee&id=<?php echo $projects->trainee_id?>">1</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
											 <?php 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6">There are currently no trainees in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=edit_trainee" class="button add_new"><span><span>ADD NEW TRAINEE</span></span></a></li>
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
