<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>To Do - Clothes</h2>
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
        If ( $trainee_clothes1 = $db->get_results("SELECT * FROM trainees WHERE clothes = '0' AND NOW() >= start_date +90") )
			{ ?>
            <b>The following trainees need their first issue of clothes (3 months):</b><br />
            <?php foreach( $trainee_clothes1 as $trainee_clothes1)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_clothes1->trainee_id; ?>"><?php echo $trainee_clothes1->trainee_fname; ?> <?php echo $trainee_clothes1->trainee_sname ?></a>,
                   <?php }?><br /><br /><?php } ?>
         <?php 
        If ( $trainee_clothes2 = $db->get_results("SELECT * FROM trainees WHERE clothes_2 = '0' AND NOW() >= start_date +365") )
			{ ?>
            <b>The following trainees need their first issue of clothes (12 months):</b><br />
            <?php foreach( $trainee_clothes2 as $trainee_clothes2)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_clothes2->trainee_id; ?>"><?php echo $trainee_clothes2->trainee_fname; ?> <?php echo $trainee_clothes2->trainee_sname ?></a>,
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