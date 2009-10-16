<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Property - To Do List</h2>
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
							If ( $todo= $db->get_results("SELECT * from property_todo WHERE user_id='$user_id' LIMIT 4") )
								{
	                               foreach( $todo as $todo )
                                        { ?>
              					 <dl>
                                    <dt><span class="order"></span><?php echo $todo->title; ?></dt>
                                    <dd>
                                       <?php echo $todo->description; ?> 
                                    </dd>
                                    <dd>
                                        <ul class="todo_menu">
                                            <li><a href="includes/actions/todo_mark_completed.php?id=<?php echo $todo->todo_id?>">Mark Completed</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                                       <?php } } 
									   		else { 
           										echo "You have no items in your to do list";
												} 
										//$db->debug(); ?>	
                                                                                    
													<span style="margin-left:10px;">
                                                    	<a href="#" class="plus">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add new event</a>
                                                    </span>
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