<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>To Do - Payments</h2>
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
													
													<div class="todo_list">
												<?php 
        If ( $trainee_3months = $db->get_results("SELECT * FROM trainees WHERE payment_1 = '0' AND NOW() >= start_date +90") )
			{ ?>
            <b>The following trainees need their 3 month payment checked off:</b><br />
              <?php foreach( $trainee_3months as $trainee_3months)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_3months->trainee_id; ?>"><?php echo $trainee_3months->trainee_fname; ?> <?php echo $trainee_3months->trainee_sname ?></a>,
                   <?php }?> <br /><br /><?php } ?>
        <?php 
        If ( $trainee_6months = $db->get_results("SELECT * FROM trainees WHERE payment_2 = '0' AND NOW() >= start_date +365") )
			{ ?>
            <b>The following trainees need their 12 month payment checked off:</b><br />
            <?php foreach( $trainee_6months as $trainee_6months)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_6months->trainee_id; ?>"><?php echo $trainee_6months->trainee_fname; ?> <?php echo $trainee_6months->trainee_sname ?></a>,
                   <?php }?> <br /><br /><?php  } ?>
        <?php 
        If ( $trainee_completed = $db->get_results("SELECT * FROM trainees WHERE payment_3 = '0' AND NOW() >= status='Completed'") )
			{ ?>
            <b>The following trainees need their completed payment checked off:</b><br />
            <?php foreach( $trainee_completed as $completed)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_completed->trainee_id; ?>"><?php echo $trainee_completed->trainee_fname; ?> <?php echo $trainee_completed->trainee_sname ?></a>,
                   <?php }?><br /><br /><?php } ?>
												</div>
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