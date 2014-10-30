
<div id="product-container">
    <div id="album-container">
        <div id="main-image">
            <img src="<?php echo $main_image;?>"/>
        </div>
        <div id="album">
            <a class="left-link" href="javascript:;" onclick="slidePictureThumbnail('left', $(this))"></a>
            <div id="center">
            <table>
                <tr>
                    <?php
                    foreach($images as $image)
                    {
                        echo "<td>";
                        echo "<img src='".$image."'>";
                        echo "</td>";
                    }
                    ?>                   
                </tr>
            </table>
            </div>
            <a class="right-link" href="javascript:;" onclick="slidePictureThumbnail('right', $(this))"></a>
        </div>
    </div>

    <div id="product-detail">
        <h1 style="color:black"><?= $product['product_name'] ?></h1>
        <table>
            <tr>
                <td>Giá niêm yết :</td>
                <td class="detail-price"><?= $product['product_price']?> VNĐ</td>
            </tr>
            <?php
            if($product['product_sale']!=0)
            {
                echo "<tr>";
                echo "<td>Khuyến mại :</td>";
                echo "<td class='detail-price'>".$product['product_sale']." %</td>";
                echo "</tr>";
            }
            ?>
            <tr>
                <td>Hãng sản xuất :</td>
                <td><?= $brand['brand_name']?></td>
            </tr>
            
            <tr>
                <td>Rating :</td>
                <td>
                    <?php
                        $rate_avg_i=$rate_avg/2;
                        $ceil = floor($rate_avg_i);

                        for($i = 1; $i<=$ceil; $i++){
                            echo "<img class='star' src='".base_url()."/public/home/images/star/fullstar.png'/>";
                        }
                        switch(ceil(($rate_avg_i-$ceil)*10)){
                            case 0:break;
                            default:
                                echo "<img class='star' src='".base_url()."/public/home/images/star/star".ceil(($rate_avg_i-$ceil)*10).".png'/>";
                        }
                        for($i = ceil(($rate_avg_i));$i<5;$i++){
                            echo "<img class='star' src='".base_url()."/public/home/images/star/empty_star.png'/>";
                        }
//                        for($i = 1; $i<= (floor(5-$rate_avg));$i++){
//                            echo "<img class='star' src='".base_url()."/public/home/images/star/empty_star.png'/>";
//                        }
                        echo "<span style='padding-left:10px;color:red'>".$rate_avg."/10 (".$rate_num." review".")"."</span>";
                    ?>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">Chi tiết sản phẩm:</td>
            </tr>
            <tr>
                
                <td colspan="2"><?= $product['product_desc']?></td>
            </tr>

            <tr>
                <td colspan="2">
                    <form id="cart-form" action="#">
                        <input type="hidden" value="id"/>
                        <label>Đặt hàng </label>
                        <input type="text" value="1" size="5" name="quantity"/>
                        <a class="cart-button" href="<?php echo base_url("default/shopping_cart/insert")."/".$product['product_id']?>">Mua hàng</a>
                    </form>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <form id="comment-form" action="#" method="get">
                        <div class="basic" data-average="10" data-id="1"></div>
                        <input type="hidden" value="0" name="rating" id="rating">
                        <input type="text" id="user_name" name="user_name" placeholder="Tên"/><br/>
                        <input type="text" id="user_email" name="user_email" placeholder="Email"/><br/>
                        <textarea id="comment_detail" name="comment_detail"></textarea>
                        <br/>
                        <input value="Đánh giá" type="button"onclick="ajaxReviewRating(<?php echo $product['product_id']?>,'<?php echo base_url()?>');" />
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div style="clear: both;padding-top: 10px">
        <h2>Đánh giá</h2>
        <ul id="comment-list">
            <?php
            foreach($comments as $comment)
            {
                $rate = $comment['comment_rate']/2;
                echo"<li>";
                if($comment["user_name"]!='')
                    echo "<h4>".$comment["user_name"]."</h4>";
                else echo "<h4>".$comment["user_email"]."</h4>";

                $floor = floor($rate);
                echo "<div style='padding-left:10px;'>";
                echo "Rate: ";
                for($i = 1; $i<= $floor;$i++){
                    echo "<img class='star' src='".base_url()."/public/home/images/star/fullstar.png'/>";
                }
                switch(ceil(10*($rate-$floor)))
                {
                    case 0:
                        break;
                    default:
                        echo "<img class='star' src='".base_url()."/public/home/images/star/star".ceil(10*($rate-$floor)).".png'/>";
                        break;
                }
                for($i = 1; $i<= (floor(5-$rate));$i++){
                    echo "<img class='star' src='".base_url()."/public/home/images/star/empty_star.png'/>";
                }
                echo "<span style='padding-left:10px;color:red'>".$rate." star</span>";
                echo "</div>";

                //echo "<i>".date("d/m/y",$comment["comment_time"])."</i>";
                echo "<p>".$comment["comment_detail"]."</p>";
                echo"</li>";
            }
            ?>

        </ul>
    </div>
</div>