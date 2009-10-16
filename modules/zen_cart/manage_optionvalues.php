<script type="text/javascript">
function deleteoptions(deleteid) {
	if (confirm("Are you sure you want to delete this record")) {
		document.getElementById("hddelete").value = deleteid;
		document.frm_options.submit();
		return true;
	} else {
		return false;
	}	
	
}

</script>

<?php

$db->select("webegg_com_au_$username");

$deleteid = $_REQUEST['hddelete'];

if($deleteid!='') {
	$db->query("delete From products_options_values where products_options_values_id = '".$deleteid."' ");
	$db->query("delete From products_options_values_to_products_options where products_options_values_id = '".$deleteid."' ");
}

?>

<div class="section table_section">
	<!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Manage Options Values</h2>
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
                            
                            <form method="post" name="frm_options" action="" >
							<input type="hidden" name="hddelete" id="hddelete" value="" />
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <th>No.</th>
                                        <th width="20%">Option Value</th>
										<th width="60%">Option Name</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $shop_categories = $db->get_results("SELECT A.*,B.products_options_values_to_products_options_id,C.products_options_name FROM products_options_values A, products_options_values_to_products_options B, products_options C Where A.products_options_values_id=B.products_options_values_id and C.products_options_id =B.products_options_id ") )
			{
				$cnt = 1;
              foreach( $shop_categories as $shop_categories)
 			   {			   
			   ?>
			   						
            							<tr class="first">
                                        
										  <td><?php echo $cnt; ?></td>
										  <td><?php echo $shop_categories->products_options_values_name ?></td>
										  <td><?php echo $shop_categories->products_options_name ?></td>
										  <td>
                                             <div class="actions" style="float:left; width:50px;">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=create_optionvalue&module=zen_cart&id=<?php echo $shop_categories->products_options_values_id?>">1</a></li>
                                                    
                                                </ul>
                                            </div>
											<div style="float:left"><a style="cursor:pointer;" onclick="deleteoptions('<?php echo $shop_categories->products_options_values_id?>');" >Remove</a></div>
                                        </td>
                                    </tr>
											 <?php 	$cnt++; } }else	{ ?>
                                             <tr>
                                              <td colspan="6" style="text-align:center;">There are currently no option values in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=create_optionvalue&module=zen_cart" class="button add_new"><span><span>CREATE NEW OPTION VALUE</span></span></a></li>
									<li><a href="default_content.php?page=manage_attributes&module=zen_cart" class="button add_new"><span><span>BACK</span></span></a></li>
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
