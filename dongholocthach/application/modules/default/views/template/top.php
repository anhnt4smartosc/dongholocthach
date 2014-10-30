<div id="site-name">
    <a href="<?php echo base_url("default/home/index")?>">
        <h1 style="font-family: Papyrus, fantasy;">
            Fashion Beauty
        </h1>
    </a>
</div>

<div id="mega-menu">
    <ul>
        <li class="leaf"><a href="#">Đồ nam</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi nam</a></li>
                <li class="leaf"><a href="#">Áo phông nam</a></li>
                <li class="leaf"><a href="#">Quần jean nam</a></li>
                <li class="leaf"><a href="#">Quần lửng nam</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a>
                    <ul class="sub-menu-2">
                        <li class="leaf"><a href="#">Giầy nam</a>
                        </li>
                        <li class="leaf"><a href="#">Đồng hồ</a>
                            <ul class="sub-menu-2">
                                <li><a href="#">Giầy nam</a></li>
                                <li><a href="#">Đồng hồ</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="leaf"><a href="#">Đồ nữ</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi</a></li>
                <li class="leaf"><a href="#">Áo phông</a></li>
                <li class="leaf"><a href="#">Quần jean</a></li>
                <li class="leaf"><a href="#">Quần lửng</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a></li>
            </ul>
        </li>

        <li class="leaf"><a href="#">Đồ nam</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi nam</a></li>
                <li class="leaf"><a href="#">Áo phông nam</a></li>
                <li class="leaf"><a href="#">Quần jean nam</a></li>
                <li class="leaf"><a href="#">Quần lửng nam</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a>
                    <ul class="sub-menu-2">
                        <li><a href="#">Giầy nam</a></li>
                        <li><a href="#">Đồng hồ</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="leaf"><a href="#">Đồ nữ</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi</a></li>
                <li class="leaf"><a href="#">Áo phông</a></li>
                <li class="leaf"><a href="#">Quần jean</a></li>
                <li class="leaf"><a href="#">Quần lửng</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a></li>
            </ul>
        </li>

        <li class="leaf"><a href="#">Đồ công sở</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi nam</a></li>
                <li class="leaf"><a href="#">Áo phông nam</a></li>
                <li class="leaf"><a href="#">Quần jean nam</a></li>
                <li class="leaf"><a href="#">Quần lửng nam</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a>
                    <ul class="sub-menu-2">
                        <li><a href="#">Giầy nam</a></li>
                        <li><a href="#">Đồng hồ</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="leaf"><a href="#">Thời trang cho bé</a>
            <ul class="sub-menu-1">
                <li class="leaf"><a href="#">Áo sơ mi</a></li>
                <li class="leaf"><a href="#">Áo phông</a></li>
                <li class="leaf"><a href="#">Quần jean</a></li>
                <li class="leaf"><a href="#">Quần lửng</a></li>
                <li class="leaf"><a href="#">Phụ kiện</a></li>
            </ul>
        </li>
    </ul>
</div>
<div id="top-banner">

    <img src="<?php echo base_url()?>/public/home/images/banner-resize-1350.png"/>
        <?php if(isset($slider)) :?>
            <div id="slider">
                <a href="#" class="control_next">>></a>
                <a href="#" class="control_prev"><<</a>
                <ul>
                    <?php foreach($slider as $product):?>
                    <li>
                        <a href="<?php echo base_url()?>default/home/details/<?php echo $product['product_id']?>">
                            <img src="<?php echo base_url()?>/public/admin/images/<?php echo $product['image_path']?>"/>
                        </a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        <?php endif;?>
<!--        <div class="slider_option">-->
<!--            <input type="checkbox" id="checkbox">-->
<!--            <label for="checkbox">Autoplay Slider</label>-->
<!--        </div>-->
</div>
