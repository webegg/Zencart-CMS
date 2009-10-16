<div class="title_wrapper">
        <h2>Active Configuration</h2>
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
                                        <th>Paypal Email</th>
                                        <th>Region</th>
										<th>Currency</th>
										<th>Shipping Rate</th>
                                        
                                    </tr>
                                    <?php 
        If ( $shop_config = $db->get_results("SELECT * FROM shop_config LEFT JOIN shop_settings on (shop_config.settings_id = shop_settings.setting_id) WHERE config_id = '1'") )
			{
              foreach( $shop_config as $shop_config)
 			   {
			   ?>
            							<tr class="first">
                                        
										  <td><?php echo $shop_config->setting_id ?></td>
										  <td><?php echo $shop_config->email_address ?></td>
										  <td><?php echo $shop_config->region_code ?></td>
										  <td><?php echo $shop_config->currency_code ?></td>
										  <td>$<?php echo $shop_config->shipping_amount ?></td>
										  
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
	<br>