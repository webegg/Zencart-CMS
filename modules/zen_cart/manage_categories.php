<?php $db->select("webegg_com_au_$username"); ?>
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
// removal of category
if($_GET['function'] == 'remove_cat') {

	require_once('class.Remove.php');
	echo 'yes';
	$cat_id = $_GET['id'];
	echo 'no';
	remove_cat($cat_id);
	echo 'test';
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Category removed succesfully!</strong></li>';
	
}

?>
<div class="section table_section">
	<!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Shop Categories</h2>
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
							<input type="hidden" name="page" value="manage_categories"/> 
							<input type="hidden" name="module" value="zen_cart" />
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                    <tbody><tr>
                                        <th>No.</th>
                                        <th width="80%">Category Name</th>
										<th>Active</th>
                                        <th style="width: 96px;">Actions</th>
                                    </tr>
                                    <?php 
        If ( $shop_categories = $db->get_results("SELECT * FROM categories LEFT JOIN categories_description on (categories.categories_id = categories_description.categories_id)") )
			{
              foreach( $shop_categories as $shop_categories)
 			   {			   
			   ?>
			   						
            							<tr class="first">
                                        
										  <td><?php echo $shop_categories->categories_id ?></td>
										  <td><?php echo $shop_categories->categories_name ?> <a href="default_content.php?page=manage_products&module=zen_cart&id=<?php echo $shop_categories->categories_id ?>">(view products)</a></td>
										  <td><?php if ($shop_categories->categories_status !== '0') { ?>Yes<?php } else { ?> No<?php } ?></td>
										  <td>
                                            <div class="actions">
                                                <ul>
                                                    <li><a class="edit" href="default_content.php?page=edit_category&module=zen_cart&id=<?php echo $shop_categories->categories_id?>">1</a></li>
                                                    <li><a class="delete" href="default_content.php?page=manage_categories&module=zen_cart&function=remove_cat&id=<?php echo $shop_categories->categories_id ?>">1</a></li>
                                                    
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
                                    <li><a href="default_content.php?page=edit_category&module=zen_cart" class="button add_new"><span><span>CREATE NEW CATEGORY</span></span></a></li>
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
