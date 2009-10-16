<?php $db->select("webegg_com_au_$username");
	$category_id = $_REQUEST['id']; 

?>
<?
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
<?
// removal of Product
if($_GET['function'] == 'remove_prod') {

	require_once('class.Remove.php');
	$prod_id = $_GET['prod_id'];
	remove_prod($prod_id);
	$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Category removed succesfully!</strong></li>';
	
}

?>
<div class="section table_section">
	<!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Shop Products</h2>
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
							<input type="hidden" name="page" value="manage_products"/> 
							<input type="hidden" name="module" value="zen_cart" />
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <th>No.</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
										<th>Active</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $shop_products = $db->get_results("SELECT * FROM products LEFT JOIN products_description on (products.products_id = products_description.products_id) LEFT JOIN categories_description on (products.master_categories_id = categories_description.categories_id) WHERE products.master_categories_id = '$category_id'") )
			{
              foreach( $shop_products as $shop_products)
 			   {
			   ?>
			   						
            							<tr class="first">
                                        
										  <td><?php echo $shop_products->products_id ?></td>
										  <td><?php echo $shop_products->products_name ?></td>
                                          <td><?php echo $shop_products->categories_name ?></td>
										  <td><?php if ($shop_categories->products_status == '1') { ?>Yes<?php } else { ?> No<?php } ?></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_product&module=zen_cart&id=<?php echo $shop_products->products_id?>">1</a></li>
                                                     <li><a class="delete" href="<?= curPageURL(); ?>&function=remove_prod&prod_id=<?php echo $shop_products->products_id?>">1</a></li>
                                                    
                                                </ul>

                                        </td>
                                    </tr>
											 <?php 	} }else	{ ?>
                                             <tr>
                                              <td colspan="6">There are currently no products in this category.</td>
                                             </tr>
											  <?php } //$db->debug(); ?>

                                    
                               </tbody></table>
                                </div>
                            </div>
                            <!--[if !IE]>end table_wrapper<![endif]-->
                            
                            <!--[if !IE]>start table menu<![endif]-->
                            <div class="table_menu">
                                <ul class="left">
                                    <li><a href="default_content.php?page=edit_product&module=zen_cart" class="button add_new"><span><span>CREATE NEW PRODUCT</span></span></a></li>
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
