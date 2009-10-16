<?php 
	$db->select("webegg_com_au_$username");
	$id = $_REQUEST['id'];
?>
<div class="section table_section">
	<!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Select Attribute Details</h2>
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
                            
                            <form action="<?=$_SERVER['PHP_SELF']?>">
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="manage_attributes"/> 
							<input type="hidden" name="module" value="zen_cart" />
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                     <tr>
                                        <th colspan="4">Attribute Select Name:</th>
                                    </tr>
                                    <tr>
                                        <th>No.</th>
                                        <th width="70%">Attribute Detail</th>
                                        <th>Sort Order</th>
                                        <th style="width: 96px;">Actions</th>
                                        
                                    </tr>
                                   
                                    <?php 
        If ( $shop_categories = $db->get_results("SELECT * FROM products_options_values_to_products_options LEFT JOIN products_options_values on (products_options_values_to_products_options.products_options_values_id = products_options_values.products_options_values_id) WHERE products_options_values_to_products_options.products_options_id = '$id'") )
			{
              foreach( $shop_categories as $shop_categories)
 			   {			   
			   ?>
			   						
            							<tr class="first">
                                        
										  <td><?php echo $shop_categories->products_options_values_id ?></td>
										  <td><?php echo $shop_categories->products_options_values_name ?></td>
                                          <td><?php echo $shop_categories->products_options_values_sort_order ?></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_attributes_details&module=zen_cart&id=<?php echo $shop_categories->categories_id?>">1</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
											 <?php 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6">There are currently no categories in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=edit_attributes&module=zen_cart" class="button add_new"><span><span>CREATE NEW SELECT CATEGORY</span></span></a></li>
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
