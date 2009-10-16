<?


	
	function remove_cat($category_id) {
		    
    $sql = ("SELECT * from products_to_categories
                  where categories_id = '" . (int)$category_id . "'");
 	$result = mysql_query($sql);
 	if(mysql_num_rows($result) >= 1) {
 		$update_message = '<li class="red"><span class="ico"></span><strong class="system_title">Category removed succesfully!</strong></li>';
 		return $update_message;
 	}

    $sql = ("delete from categories
                  where categories_id = '" . (int)$category_id . "'");
    mysql_query($sql);
                  
    $sql = ("delete from categories_description
                  where categories_id = '" . (int)$category_id . "'");
 	mysql_query($sql);
 	

    $sql = ("delete from metatags_categories_description
                  where categories_id = '" . (int)$category_id . "'");
 	mysql_query($sql);
	}
	
	function remove_prod($product_id) {


    $sql = ("delete from specials
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from products
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);


      $sql = ("delete from products_to_categories
                    where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);


    $sql = ("delete from products_description
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from meta_tags_products_description
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);



    $sql = ("delete from products_attributes
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from customers_basket
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from customers_basket_attributes
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from reviews
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from featured
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

    $sql = ("delete from products_discount_quantity
                  where products_id = '" . (int)$product_id . "'");
 	mysql_query($sql);

	}
	


?>