<?php $db->select("$dbprefix$username"); ?>
<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Scheduled Email</h2>
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
                                        <th>Contact</th>
										<th>Message Subject</th>
										<th>Send Time</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $sms_queue = $db->get_results("SELECT * FROM email_queue LEFT JOIN email_messages on (email_queue.email_queue_message_id = email_messages.email_messages_id) LEFT JOIN contacts on (email_queue.email_queue_contact_id = contacts.contacts_id)") )
			{
              foreach( $sms_queue as $sms_queue)
 			   {
			   ?>
            							<tr class="first">
                                        
										  <td><?php echo $sms_queue->email_queue_id ?></td>
										  <td><?php echo $sms_queue->contacts_firstname ?> <?php echo $sms_queue->contacts_lastname ?></td>
										  <td><?php echo $sms_queue->email_messages_subject ?></td>
										   <td><?php echo $sms_queue->send_time ?></td>
										   <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="delete" href="#">1</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
											 <?php 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6">There are currently no scheduled emails in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
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
