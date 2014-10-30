
<?php foreach($listHotProducts as $product):?>
    <div class="product-container">
        <img class="lazy" width="10px" height="10px" data-original="<?php echo base_url()."/public/products/images/".$product['product_main_image']?>"/>
        <em class="product-create-date"><label>Ngày đăng </label><?php echo $product['product_create_date']?></em>
        <h3><?php echo $product['product_name']?></h3>
        <div class="product-details">
            <?php if($product['product_sale'] == 0): ?>
                <label>Giá :</label><b class="product-price"><?php echo $product['product_price']?> VNĐ</b><br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."/default/home/product/".$product['product_id']?>">Xem chi tiết</a>
            <?php else:?>
                <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price']?> VNĐ</i>
                <br/>
                <label>Giá mới:</label><b class="product-price"><?php echo $product['product_price'] * ( 1 - $product['product_sale']/100)?> VNĐ</b>
                <br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."default/home/product/".$product['product_id']?>">Xem chi tiết</a>
                <div class="sale_ico">
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endforeach;?>
<?php if(isset($listHotBrandProducts_1) && count($listHotBrandProducts_1)>0):?>
    <div class="content-header">
        <h3><?php echo $brand_1['brand_name'];?></h3>
    </div>
    <br/>

<?php foreach($listHotBrandProducts_1 as $product):?>
    <div class="product-container">
        <img src="<?php echo base_url()."/public/products/images/".$product['product_main_image']?>"/>
        <em class="product-create-date"><label>Ngày đăng </label><?php echo $product['product_create_date']?></em>
        <h3><?php echo $product['product_name']?></h3>
        <div class="product-details">
            <?php if($product['product_sale'] == 0): ?>
                <label>Giá :</label><b class="product-price"><?php echo $product['product_price']?> VNĐ</b><br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."/default/home/product/".$product['product_id']?>">Xem chi tiết</a>
            <?php else:?>
                <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price']?> VNĐ</i>
                <br/>
                <label>Giá mới:</label><b class="product-price"><?php echo $product['product_price'] * ( 1 - $product['product_sale']/100)?> VNĐ</b>
                <br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."default/home/product/".$product['product_id']?>">Xem chi tiết</a>
                <div class="sale_ico">
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endforeach;?>
    <div class="read-more"><a href="<?php echo base_url("default/home/brand")."/".$brand_1['brand_id']?>">Xem thêm</div>
<?php endif;?>
<?php if(isset($listHotBrandProducts_2) && count($listHotBrandProducts_2)>0):?>
    <div class="content-header">
        <h3><?php echo $brand_2['brand_name'];?></h3>
    </div>
    <br/>
<?php foreach($listHotBrandProducts_2 as $product):?>
    <div class="product-container">
        <img src="<?php echo base_url()."/public/products/images/".$product['product_main_image']?>"/>
        <em class="product-create-date"><label>Ngày đăng </label><?php echo $product['product_create_date']?></em>
        <h3><?php echo $product['product_name']?></h3>
        <div class="product-details">
            <?php if($product['product_sale'] == 0): ?>
                <label>Giá :</label><b class="product-price"><?php echo $product['product_price']?> VNĐ</b>
                <br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."/default/home/product/".$product['product_id']?>">Xem chi tiết</a>
            <?php else:?>
                <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price']?> VNĐ</i>
                <br/>
                <label>Giá mới:</label><b class="product-price"><?php echo $product['product_price'] * ( 1 - $product['product_sale']/100)?> VNĐ</b>
                <br/>
                <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views']?> lượt xem</b>
                <br/>
                <a class="details_link" href="<?php echo base_url()."default/home/product/".$product['product_id']?>">Xem chi tiết</a>
                <div class="sale_ico">
                </div>
            <?php endif;?>
        </div>
    </div>
<?php endforeach;?>

    <div class="read-more"><a href="<?php echo base_url("default/home/brand")."/".$brand_2['brand_id']?>">Xem thêm</div>
<?php endif;?>