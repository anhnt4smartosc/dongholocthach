<div id="mega-menu" class="block">
    <h3>Hãng sản xuất</h3>

    <div class="block-content">
        <?php echo $listBrands; ?>
    </div>
</div>
<?php if (isset($range_slider)): ?>
    <div id="price-filter" class="block">
        <h3>Lọc theo giá</h3>

        <div class="block-content">
            <?php echo $range_slider; ?>
            <input type="hidden" value="<?php echo $brand_id ? $brand_id : "-1" ?>" name="brand_id" id="brand_id"/>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($listNewProducts)): ?>
    <div id="news-product-container" class="block">
        <h3>Các sản phẩm mới nhất</h3>
        <?php foreach ($listNewProducts as $product): ?>
            <div class="product-container new">
                <img class="lazy" data-original="<?php echo base_url() . "public/products/images/" .$product['product_main_image']?>"/>
                <h4><?php echo $product['product_name'] ?></h4>

                <div class="product-details">
                    <?php if ($product['product_sale'] == 0): ?>
                        <label>Giá :</label><b class="product-price"><?php echo $product['product_price'] ?> VNĐ</b>
                        <br/>
                        <a class="details_link"
                           href="<?php echo base_url() . "default/home/product/" . $product['product_id'] ?>">Xem chi
                            tiết</a>
                    <?php else: ?>
                        <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price'] ?>
                            VNĐ</i>
                        <br/>
                        <label>Giá mới:</label><b
                            class="product-price"><?php echo $product['product_price'] * (1 - $product['product_sale'] / 100) ?>
                            VNĐ</b>
                        <br/>
                        <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views'] ?> lượt
                            xem</b>
                        <br/>
                        <a class="details_link"
                           href="<?php echo base_url() . "default/home/product/" . $product['product_id'] ?>">Xem chi
                            tiết</a>
                        <div class="sale_ico">
<!--                            --><?php //echo $product['product_sale'] . '%' ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
