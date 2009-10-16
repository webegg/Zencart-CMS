
<?php $db->select("$dbprefix$username"); ?>
<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Contacts</h2>
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
                                        <th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Mobile</th>
										<th>Email Opt In</th>
										<th>SMS Opt In</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $contacts = $db->get_results("SELECT * FROM contacts") )
			{
              foreach( $contacts as $contacts)
 			   {
			   ?>
            							<tr class="first">
                                        
										  <td><?php echo $contacts->contacts_id ?></td>
										  <td><?php echo $contacts->contacts_firstname ?></td>
										  <td><?php echo $contacts->contacts_lastname ?></td>
										   <td><?php echo $contacts->contacts_email ?></td>
										    <td><?php echo $contacts->contacts_mobile ?></td>
										  <td><input type="checkbox" <?php if ( $contacts->email_opt_in == 1 ) {	echo "checked=checked"; } else { }?> name="email_opt_in" disabled="true"/></td>
										  <td><input type="checkbox" <?php if ( $contacts->sms_opt_in == 1 ) {	echo "checked=checked"; } else { }?> name="sms_opt_in" disabled="true"/></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_contacts&module=contacts&id=<?php echo $contacts->contacts_id?>">1</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
											 <?php 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6">There are currently no contacts in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=edit_contacts&module=contacts" class="button add_new"><span><span>CREATE NEW CONTACT</span></span></a></li>
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
