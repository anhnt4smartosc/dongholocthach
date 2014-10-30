<div id="product-detail-view">
</div>

<div id="product-container">
    <div id="album-container">
        <div id="main-image">
            <img src="<?php echo base_url("public/products/images") . "/" . $product['product_main_image'] ?>"/>
        </div>
    </div>
    <div id="product-detail">
        <h1 id="product-name"><?= $product['product_name'] ?></h1>
        <table>
            <?php
            if ($product['product_sale'] != 0) {
                echo "<tr>";
                echo "<td>Khuyến mại :</td>";
                echo "<td><span class='product_sale'>" . $product['product_sale'] . " %</span></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Giá:</td>";
                echo "<td class='detail-price'>" . $product['product_price']*(1- $product['product_sale']/100) . " VNĐ</td>";
                echo "</tr>";
            } else {
                echo "<tr>";
                echo "<td>Giá:</td>";
                echo "<td class='detail-price'>" . $product['product_price'] . " VNĐ</td>";
                echo "</tr>";
            }
            ?>

            <tr>
                <td>Hãng sản xuất :</td>
                <td><?= $brand['brand_name'] ?></td>
            </tr>

        </table>
    </div>
</div>
<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>

<div id="tabs" style="clear: both">
    <ul>
        <li><a href="#tabs-1">Chi tiết sản phẩm</a></li>
        <li><a href="#tabs-2">Album</a></li>
        <li><a href="#related-container">Các sản phẩm cùng danh mục</a></li>
        <li><a href="#facebook-comment">Đánh giá</a></li>
    </ul>
    <div id="tabs-1">
        <?php echo $product['product_description'] ? $product['product_description'] : "Sản phẩm chưa có miêu tả" ?>
    </div>
    <div id="tabs-2">
        Album ảnh sẽ được cập nhật sau
    </div>

    <div id="related-container">
        <?php if (isset($listRelatedProducts)): ?>
            <?php foreach ($listRelatedProducts as $product): ?>
                <div class="product-container related">
                    <img src="<?php echo base_url() . "/public/products/images/" . $product['product_main_image'] ?>"/>
                    <h4><?php echo $product['product_name'] ?></h4>

                    <div class="product-details">
                        <?php if ($product['product_sale'] == 0): ?>
                            <label>Giá :</label><b class="product-price"><?php echo $product['product_price'] ?> VNĐ</b>
                            <br/>
                            <a class="details_link"
                               href="<?php echo base_url() . "/default/home/product/" . $product['product_id'] ?>">Xem
                                chi
                                tiết</a>
                        <?php else: ?>
                            <label>Giá cũ:</label><i class="old-product-price"><?php echo $product['product_price'] ?>
                                VNĐ</i>
                            <br/>
                            <label>Giá mới:</label><b
                                class="product-price"><?php echo $product['product_price'] * (1 - $product['product_sale'] / 100) ?>
                                VNĐ</b>
                            <br/>
                            <label>Lượt xem:</label><b class="product-views"><?php echo $product['product_views'] ?>
                                lượt
                                xem</b>
                            <br/>
                            <a class="details_link"
                               href="<?php echo base_url() . "default/home/product/" . $product['product_id'] ?>">Xem
                                chi
                                tiết</a>
                            <div class="sale_ico">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div id="fb-root"></div>
<!--    <div id="facebook-comment" class="fb-comments" data-href="http://www.hayhaytv.vn/xem-phim/phim-teenage-mutant-ninja-turtles-ninja-rua-hd-393838326E61.html" data-numposts="5" data-colorscheme="light"></div>-->
    <div id="facebook-comment" class="fb-comments" data-href="<?php echo base_url()."/".$this->uri->uri_string()?>" data-numposts="5" data-colorscheme="light"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
</div>
<script>
    $("#main-image img").elevateZoom({
        zoomWindowFadeIn: 1000,
        zoomWindowFadeOut: 1000,
        lensFadeIn: 1000,
        lensFadeOut: 1000
    });
</script>