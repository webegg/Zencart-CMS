<?php 
	$id = $_REQUEST['id'];
	$db->select("webegg_com_au_$username");
	
	if(isset($_POST['submit'])){ 
	@extract($_REQUEST);

		if($_FILES['image']['size']>0)
			{
				$image1=time().$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'../images/categories/'.$image1);
				@resize_img("../images/categories/".$image1, 100, '75', false, 80, 0, "");	
			}
		
		
		if ($id == '') { 
			$db->query("INSERT INTO shop_categories (category_name, category_description, category_image, active) VALUES ('$category_name', '$category_description', $image1', '$active')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Shop category successfully created!</strong></li>';
		} else {
		$db->query("UPDATE shop_categories SET category_name = '$category_name', category_description = '$category_description', active = '$active' WHERE category_id='$category_id'");
		if($image1 !=='')
			{
			   $db->query("UPDATE shop_categories SET category_image = '$image1' WHERE category_id='$category_id'");
			}
			$sql.=" where id='$id'";
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Shop category successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM shop_categories WHERE category_id='$id'";
	$row = $db->getRow ( $query );
?>
<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>
        <?php
     if ($id == !'')
     {
         echo("Edit");
     } else {
		 echo("Add New");
	 }
?>
         Shop Category</h2>
        
        <!--[if !IE]>start section menu<![endif]-->
        <!--<ul class="section_menu">
            <li><a href="#"><span><span>Inactive Tab</span></span></a></li>
            <li><a href="#" class="active"><span><span>Active Tab</span></span></a></li>
            <li><a href="#"><span><span>Products</span></span></a></li>
            <li><a href="#"><span><span>Last One</span></span></a></li>
        </ul>-->
        <!--[if !IE]>end section menu<![endif]-->
        
        
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
                                                        
                            <!--<p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nisl sit amet iaculis ullamcorper, orci tellus feugiat est, at dapibus massa dui vel lectus. Sed felis nunc, pharetra ullamcorper, fermentum nec, cursus nec, ipsum. Nunc porta blandit risus. Proin pharetra. Proin ultrices viverra lorem. Phasellus tellus enim, accumsan et, luctus vitae, mattis in, diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate, arcu consectetur auctor lacinia, justo est suscipit massa, a 
                            </p>-->
                            
                            
                            <!--[if !IE]>start forms<![endif]-->
							<ul class="system_messages">
								<?php echo "$update_message"; ?>
							</ul>
                            <form action="<?=$_SERVER['PHP_SELF']?>" class="search_form general_form" method="post">
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="edit_category"/>
							<input type="hidden" name="module" value="shop"/> 
							<input type="hidden" name="id" value="<?php echo $row->category_id?>" />
							<input type="hidden" name="category_id" value="<?php echo $row->category_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Category Name:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="category_name" name="category_name" value="<?php echo $row->category_name?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Category Description:</label>
                                        <div class="inputs">
                                            <textarea name="category_descition" id="category_description" cols="50" rows="10"><?php echo $row->category_description; ?></textarea>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Active:</label>
                                        <div class="inputs">
                                            <input type="radio" id="active" name="active" <?php if ($row->active == '1') { ?> checked="checked"<?php } ?> value="1" />
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Image:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="file" id="image" name="image" size="50"/></span>
											<br />
											<?php if ($row->category_image !== '') { ?>
												<img src="../images/categories/<?php echo $row->category_image; ?>" width="200px" />
											<?php } ?>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
																
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <div class="buttons">
                                            
                                            
                                            <ul>
                                                <li><span class="button send_form_btn"><span><span>SUBMIT</span></span><input name="submit" type="submit" /></span></li>
                                                <li><span class="button cancel_btn"><span><span>CANCEL</span></span><input name="" onclick="javascript:history.back()" /></span></li>

                                            </ul>
                                            
                                           
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    
                                    
                                    </div>
                                    <!--[if !IE]>end forms<![endif]-->
                                    
                                </fieldset>
                                <!--[if !IE]>end fieldset<![endif]-->
                                
                                
                                
                                
                            </form>
                            <!--[if !IE]>end forms<![endif]-->	
                            
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
