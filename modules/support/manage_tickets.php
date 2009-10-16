<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>My Support Tickets</h2>
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
                                        <th width="60%">Ticket Subject</th>
                                        <th>Submitted By</th>
										<th>Status</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $support_ticket = $db->get_results("SELECT * FROM support WHERE username = '$username' ORDER BY timestamp DESC") )
			{
              foreach( $support_ticket as $support_ticket)
 			   {
			   ?>
            							<tr class="first">
										  <td><?php echo $support_ticket->support_id ?></td>
										  <td<?php if ($support_ticket->read_status == '1') { ?> style="font-weight:bold"<?php } ?>>
										  	<a href="default_content.php?page=edit_ticket&module=support&id=<?php echo $support_ticket->support_id?>"><?php echo $support_ticket->subject ?></a>
										  </td>
										  <td style="color:#0099FF"><?php echo $support_ticket->contact_name ?></td>
										  <td><?php echo $support_ticket->status ?></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_ticket&module=support&id=<?php echo $support_ticket->support_id?>">1</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
											 <?php 	} } else	{ ?>
                                             <tr>
                                              <td colspan="6">You do not have any support tickets in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>
											<tr>
                                              <td colspan="6"><b>Key:</b> Items in <b>BOLD</b> have new messages.</b></td>
                                             </tr>
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=contact_support&module=support" class="button add_new"><span><span>CREATE NEW TICKET</span></span></a></li>
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
