<?php if ($this->uri->segment(3) == 'brand' || $this->uri->segment(3) == 'ajaxBrand'): ?>
    <?php
        function getThumb($product_main_image)
        {
            $arr = explode(".", $product_main_image);
            $arr[0] = $arr[0] . "_thumb";
            return implode('.', $arr);
        }
    ?>
    <div id="filter">
        <form>
            <label>Sắp xếp</label>
            <select name="order" id="order_select">
                <option value="product_create_date" <?php echo $order == 'product_create_date' ? "selected" : "" ?>>
                    Thời gian
                </option>
                <option value="product_name" <?php echo $order == 'product_name' ? "selected" : "" ?>>Tên sản phẩm
                </option>
                <option value="product_price" <?php echo $order == 'product_price' ? "selected" : "" ?>>Giá</option>
            </select>
            <select name="order_opt" id="order_opt_select">
                <option value="asc" <?php echo $order_opt == 'asc' ? "selected" : "" ?>>Tăng dần</option>
                <option value="desc" <?php echo $order_opt == 'desc' ? "selected" : "" ?>>Giảm dần</option>
            </select>
        </form>
    </div>
    <?php endif; ?>
    <?php foreach ($listProducts as $product): ?>
        <div class="product-container">
            <img src="<?php echo base_url() . "public/products/images/".$product['product_main_image']?>"/>
            <em class="product-create-date"><label>Ngày đăng </label><?php echo $product['product_create_date']?></em>
            <h3><?php echo $product['product_name'] ?></h3>
            <div class="product-details">
                <?php if ($product['product_sale'] == 0): ?>
                    <label>Giá :</label><b class="product-price"><?php echo $product['product_price'] ?> VNĐ</b>
                    <br/>
                    <a class="details_link"
                       href="<?php echo base_url() . "default/home/product/" . $product['product_id'] ?>">Xem chi
                        tiết</a>
                <?php else: ?>
                    <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price'] ?> VNĐ</i>
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

                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (isset($pager) && $pager): ?>
        <div id="pager">
            <?php echo $pager ?>
        </div>
    <?php endif; ?>
