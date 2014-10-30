<div id="advanced-filter">
    <form>
        <label>Tên sản phẩm</label>
        <input type="text" name="searchName" min="3" value="<?php echo isset($_GET['searchName']) && $_GET['searchName']?$_GET['searchName']:""?>"/>
        <br/>
        <label>Tên hãng</label>
        <select name="brandId">
            <option value="-1">Tất cả các hãng</option>
            <?php foreach($listFilterBrands as $brand):?>
                <option value="<?php echo $brand['brand_id']?>" <?php echo isset($_GET['brandId']) && $brand['brand_id'] == $_GET['brandId'] ? "selected":""?>>
                    <?php echo $brand['brand_name'];?>
                </option>
            <?php endforeach;?>
        </select>
        <br/>
        <label>Sắp xếp</label>
        <select name="order">
            <option value="product_create_date" <?php echo isset($_GET['order']) && $_GET['order'] == 'product_create_date' ? "selected" : "" ?>>
                Thời gian
            </option>
            <option value="product_name" <?php echo isset($_GET['order']) && $_GET['order'] == 'product_name' ? "selected" : "" ?>>Tên sản phẩm
            </option>
            <option value="product_price" <?php echo isset($_GET['order']) && $_GET['order'] == 'product_price' ? "selected" : "" ?>>Giá</option>
        </select>
        <select name="order_opt">
            <option value="asc" <?php echo isset($_GET['order_opt']) && $_GET['order_opt'] == 'asc' ? "selected" : "" ?>>Tăng dần</option>
            <option value="desc" <?php echo isset($_GET['order_opt']) && $_GET['order_opt'] == 'desc' ? "selected" : "" ?>>Giảm dần</option>
        </select>
        <br/>
        <label>Giá thấp nhất</label>
        <input type="number" min="0" name="minPrice" value="<?php echo isset($_GET['minPrice']) && $_GET['minPrice']?$_GET['minPrice']:"0"?>"/>
        <br/>
        <label>Giá cao nhất</label>
        <input type="number" max="10000000" name="maxPrice" value="<?php echo isset($_GET['maxPrice']) && $_GET['maxPrice']?$_GET['maxPrice']:"10000000"?>"/>
        <br/>
        <input type="submit" value="Tìm kiếm"/>
    </form>
</div>

<?php if(count($listProducts)>0 ):?>
<?php foreach ($listProducts as $product): ?>
    <div class="product-container search-item">
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
<?php endif; ?>