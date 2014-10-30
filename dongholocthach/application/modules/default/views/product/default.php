<!--Popup------------------------------------------------------------------------------------>
<div class="backdrop"></div>
<div class="box"><div class="close">
        <img src="<?php echo base_url()?>/public/popup/xx.png" width="40px" height="40px" />
    </div>
    <img src="<?php echo base_url()?>/public/popup/2.jpg" onload="open_box()" style="width: 800px;height: 420px;" />
</div>
<!----------------------------------------------------------------------------------------->
<div id="filter">
    <form action="<?php echo base_url()?>default/home/index" method="post">
        <label>Sắp xếp</label>
        <input type="hidden" name="category" value="<?php echo isset($_GET['category']) && $_GET['category']?$_GET['category']:""?>"/>
        <select name="order" id="order_select">
            <option value="product_date" <?php echo $order == 'product_date'?"selected":"" ?>>Thời gian</option>
            <option value="product_name" <?php echo $order == 'product_name'?"selected":"" ?>>Tên sản phẩm</option>
            <option value="product_price" <?php echo $order == 'product_price'?"selected":"" ?>>Giá</option>
        </select>
        <select name="order_opt" id="order_opt_select">
            <option value="asc" <?php echo $order_opt == 'asc'?"selected":"" ?>>Tăng dần</option>
            <option value="desc" <?php echo $order_opt == 'desc'?"selected":"" ?>>Giảm dần</option>
        </select>
    </form>
</div>
<?php
    echo "<div id ='showdata'>";
    if($listProduct && !empty($listProduct))
    {
        foreach($listProduct as $product)
        {
            echo "<div class='product'>";
	        echo "<a href='".base_url()."default/home/details/".$product['product_id']."'>";
            echo "<img class='product-image' src ='".$product['main_image']."'/>";
            echo "</a>";
            echo "<h3>".$product['product_name']."</h3>";
	        echo "<div class='product-price'>";

            if($product['product_sale'] > 0) {
                echo "<span class='new-price'>".number_format(($product['product_price']*(100-$product['product_sale'])/100))." VNĐ</span>";
                echo "<span class='old-price'>".number_format($product['product_price'])." VNĐ</span>";
                echo "<div class='sale_stamp'>".$product['product_sale']." %</div>";
            }else {
                echo "<span class='new-price'>".number_format($product['product_price'])." VNĐ</span>";
            }
            echo "</div>";
            echo "<div class='button-container'>";
		?><button class="cart-button btn" onclick="insert_cart(<?php echo $product['product_id'];?>,'<?php echo base_url();?>default/shopping_cart/insert')">Mua hàng</button></div>
		<?php
            echo "</div>";
        }
    }
    echo"</div>";
//    echo $pages;
?>
<?php if (isset($pager)):?>
    <div id="pager">
        <?php echo $pager?>
    </div>
<?php endif;?>