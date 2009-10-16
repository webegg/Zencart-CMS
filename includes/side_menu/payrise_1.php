<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>To Do - Payrises</h2>
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
        If ( $trainee_payrise_1 = $db->get_results("SELECT * FROM trainees WHERE payrise_1 = '0' AND NOW() >= start_date +183") )
			{ ?>
            <b>The following payrises need to be checked off (6 month):</b><br />
              <?php foreach( $trainee_payrise_1 as $trainee_payrise_1)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_payrise_1->trainee_id; ?>"><?php echo $trainee_payrise_1->trainee_fname; ?> <?php echo $trainee_payrise_1->trainee_sname ?></a>,
                   <?php } ?><br /><br /><?php } ?>
				    <?php 
        If ( $trainee_payrise_2 = $db->get_results("SELECT * FROM trainees WHERE payrise_2 = '0' AND NOW() >= start_date +365") )
			{ ?>
            <b>The following payrises need to be checked off (1 year):</b><br />
              <?php foreach( $trainee_payrise_2 as $trainee_payrise_2)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_payrise_2->trainee_id; ?>"><?php echo $trainee_payrise_2->trainee_fname; ?> <?php echo $trainee_payrise_2->trainee_sname ?></a>,
                   <?php } ?><br /><br /><?php } ?>
         <?php 
        If ( $trainee_payrise_3 = $db->get_results("SELECT * FROM trainees WHERE payrise_3 = '0' AND NOW() >= start_date +548") )
			{ ?>
            <b>The following payrises need to be checked off (18 months):</b><br />
              <?php foreach( $trainee_payrise_3 as $trainee_payrise_3)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_payrise_3->trainee_id; ?>"><?php echo $trainee_payrise_3->trainee_fname; ?> <?php echo $trainee_payrise_3->trainee_sname ?></a>,
                   <?php } ?><br /><br /><?php } ?>
         <?php 
        If ( $trainee_payrise_4 = $db->get_results("SELECT * FROM trainees WHERE payrise_4 = '0' AND NOW() >= start_date +730") )
			{ ?>
            <b>The following payrises need to be checked off (2 years):</b><br />
              <?php foreach( $trainee_payrise_4 as $trainee_payrise_4)
 			   { ?>
                   <a href="project_edit.php?page=trainee_edit&id=<?php echo $trainee_payrise_4->trainee_id; ?>"><?php echo $trainee_payrise_4->trainee_fname; ?> <?php echo $trainee_payrise_4->trainee_sname ?></a>,
                   <?php } ?><br /><br /><?php } ?>
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