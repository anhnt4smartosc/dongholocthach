<div id="top-menu">
    <ul>
        <li>
            <a class="home" href="<?php echo base_url() ?>default/home/index">Trang chủ</a>
        </li>
        <?php foreach ($pageList as $page): ?>
            <li>
                <a href="<?php echo base_url() ?>default/home/basic_page/<?php echo $page['basic_page_id'] ?>"><?php echo $page['basic_page_name'] ?></a>
            </li>
        <?php endforeach; ?>
	<li>
                    <!--<form id="search" action="<?php echo base_url("default/home/search")?>">
                <input name="searchName" type="text" placeholder="Tìm kiếm ... "/>
            </form>-->
        </li>
    </ul>
    <div style="clear: both">
    </div>


    </div>
    <?php if(isset($bigBanner) && $bigBanner):?>
        <div id="big-banner">
            <img style="min-height: 250px" src="<?php echo $bigBanner?>"/>
        </div>
    <?php endif;?>
<!--    <marquee behavior="slide" scrollamount="20" style="color: red; text-transform: uppercase; padding: 10px;font-weight: bold" direction="left">Đồng hồ lộc thạch - 229 Đội Cấn - Ba Đình - Hà Nội</marquee>-->
    <div>
        <?php
        if (isset($listSale) && ($total = count($listSale)) > 0) {
            ?>
            <script src="<?php echo base_url()?>/public/admin/js/jquery.plugin.js"></script>
            <script src="<?php echo base_url()?>/public/admin/js/jquery.countdown.js"></script>
            <script src="<?php echo base_url()?>/public/admin/js/jquery.countdown-vi.js"></script>
            <script>
                $(document).ready(
                    function(){
                        $(".count_down").each(
                            function(){
                                var austDay = new Date();
                                austDay = new Date($(this).html());
                                $(this).countdown({
                                        until: austDay
                                    }
                                );
                            }
                        );
                    }
                );
            </script>
            <?php
            if ($total > 3) {
                echo "<div id='top-banner'>";
                ?>
                <script src="<?php echo base_url() ?>/public/home/js/jquery.slides.min.js"></script>
                <?php
                echo "<div id='slides'>";
                $page = ceil($total / 3);
                for ($i = 1; $i <= $page; $i++) {
                    $start = ($i - 1) * 3;
                    $end = $i * 3 - 1;
                    $end = $end >= $total ? $total - 1 : $end;

                    echo "<div class='item'>";
                    for ($j = $start; $j <= $end; $j++) {
                        echo "<div class='sale_product'>";
                        $image_path = base_url() . "public/products/images/" . $listSale[$j]['product_main_image'];
                        echo "<a href='".base_url("default/home/product")."/".$listSale[$j]['product_id']."'><img class='lazy' data-original='$image_path'/></a>";
                        echo "<a href='".base_url("default/home/product")."/".$listSale[$j]['product_id']."'><h3>" . $listSale[$j]['product_name'] . "</h3></a>";
                        echo "<div class='sale_product_price'>";
                        ?>
                        <table>
                            <tr>
                                <td><label>Giá cũ</label><i class="old-product-price"><?php echo $listSale[$j]['product_price'] ?></i></td>
                                <td><label>Giá mới</label><b class="product-price"><?php echo $listSale[$j]['product_price'] *  (1-$listSale[$j]['product_sale']/100)?></b></td>
                            </tr>
                            <tr>
                                <td><label>Sale</label><?php echo $listSale[$j]['product_sale']." %" ?></td>
                                <td><label>Tiết kiệm</label><?php echo ($listSale[$j]['product_price'] * $listSale[$j]['product_sale']/100)." VNĐ" ?></td>
                            </tr>
                        </table>

                        <div class="count_down">
                            <?php echo $listSale[$j]['product_sale_date_end']; ?>
                        </div>
                        <div class="sale_stamp">
                            <?php echo $listSale[$j]['product_sale']." %"?>
                        </div>
                        <?php
                        echo "</div>";
                        echo "</div>";

                    }
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            } else {

                foreach ($listSale as $product) {
                    echo "<div class='sale_product'>";
                    $image_path = base_url() . "public/products/images/" . $product['product_main_image'];
                    echo "<a href='".base_url("default/home/product")."/".$product['product_id']."'><img class='lazy' data-original='$image_path'/></a>";
                    echo "<a href='".base_url("default/home/product")."/".$product['product_id']."'><h3>".$product['product_name']."</h3></a>";
                    echo "<div class='sale_product_price'>";
                    ?>
                    <table>
                        <tr>
                            <td><label>Giá cũ</label><i class="old-product-price"><?php echo $product['product_price']." VNĐ" ?></i></td>
                            <td><label>Giá mới</label><b class="product-price"><?php echo ($product['product_price'] *  ( 1 - $product['product_sale']/100))." VNĐ"?></b></td>
                        </tr>
                        <tr>
                            <td><label>Sale</label><?php echo $product['product_sale']." %" ?></td>
                            <td><label>Tiết kiệm</label><?php echo ($product['product_price'] * $product['product_sale']/100)." VNĐ" ?></td>
                        </tr>
                    </table>

                    <div class="count_down">
                        <?php echo $product['product_sale_date_end']; ?>
                    </div>
                    <div class="sale_stamp">
                        <?php echo $product['product_sale']." %"?>
                    </div>
                    <?php
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>