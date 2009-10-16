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

<?php $db->select("webegg_com_au_$username");

	$deleteid = $_REQUEST['hddelete'];

	if($deleteid!='') {
		$db->query("delete From products_attributes where products_attributes_id = '".$deleteid."' ");
	}

	$getattributeqry = $db->get_results("Select A.products_attributes_id,A.attributes_price_onetime,A.options_values_price,B.products_name,C.products_options_name,D.products_options_values_name from products_attributes A, products_description B, products_options C, products_options_values D
	Where A.products_id = B.products_id and A.options_id = C.products_options_id and A.options_values_id = D.products_options_values_id");

	function printArray($str) {
		print "<pre>";
			print_r($str);
		print "</pre>";	
	}
		
			
?>
<div class="section table_section">
	<!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Product Attributes</h2>
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
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="manage_attributes"/> 
							<input type="hidden" name="module" value="zen_cart" />
							<input type="hidden" name="hddelete" id="hddelete" value="" />
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <th>No.</th>
										<th width="20%">Product Name</th>
                                        <th width="20%">Attribute Option Name</th>
										 <th width="20%">Attribute Option Value</th>
										 <th width="20%">Price</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ($getattributeqry!='')
			{
			  $cnt=1;
              foreach( $getattributeqry as $shop_categories)
 			   {			   
			   ?>
			   						
            							<tr class="first">
                                        
										  <td><?php echo $cnt;  ?></td>
										   <td><?php echo $shop_categories->products_name ?></td>
										   <td><?php echo $shop_categories->products_options_name ?> </td>
										   <td><?php echo $shop_categories->products_options_values_name ?></td>
										   <td><?php echo $shop_categories->attributes_price_onetime ?></td>
										  <td>
                                           <div class="actions" style="float:left; width:50px;">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=create_attribute&module=zen_cart&id=<?php echo $shop_categories->products_attributes_id?>">1</a></li>
                                                    
                                                </ul>
                                            </div>
											<div style="float:left"><a style="cursor:pointer;" onclick="deleteoptions('<?php echo $shop_categories->products_attributes_id?>');" >Remove</a></div>
                                        </td>
                                    </tr>
											 <?php $cnt++; 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6" align="center" style="text-align:center;">There are currently no attributes in the database.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
									 <li><a href="default_content.php?page=create_attribute&module=zen_cart" class="button add_new"><span><span>CREATE PRODUCT ATTRIBUTE</span></span></a></li>
                                    <li><a href="default_content.php?page=manage_options&module=zen_cart" class="button add_new"><span><span>MANAGE OPTION NAME</span></span></a></li>
									&nbsp;&nbsp;<li><a href="default_content.php?page=manage_optionvalues&module=zen_cart" class="button add_new"><span><span>MANAGE OPTION VALUES</span></span></a></li>
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
