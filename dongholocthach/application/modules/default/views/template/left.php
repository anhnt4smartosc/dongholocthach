
<ul id="menu">
    <li><a class="collapse" href="#" onclick="return false">Quản lý người dùng</a>
        <ul id="ab">
            <li><a href="<?php echo base_url()?>admin/user/index">Danh sách người dùng</a></li>
            <li><a href="<?php echo base_url()?>admin/user/insert">Thêm người dùng</a></li>
        </ul>
    </li>
    <li>
        <a class="collapse" href="#" onclick="return false">Quản lý nhãn hiệu</a>
        <ul id="ab">
            <li><a href="<?php echo base_url()?>admin/brand/index">Danh sách các hãng</a></li>
            <li><a href="<?php echo base_url()?>admin/brand/insert">Thêm hãng</a></li>
        </ul>
    </li>
    <li>
        <a class="collapse" href="#" onclick="return false">Quản lý danh mục</a>
        <ul id="ab">
            <li><a href="<?php echo base_url()?>admin/category/index">Danh sách danh mục</a></li>
            <li><a href="<?php echo base_url()?>admin/category/insert">Thêm danh mục</a></li>
<!--			<li><a href="--><?php //echo base_url()?><!--admin/category/move">Di chuyển danh mục</a></li>-->
        </ul>
    </li>
    <li>
        <a class="collapse" href="#" onclick="return false">Quản lý Sản Phẩm</a>
        <ul id="ab">
            <li><a href="<?php echo base_url()?>admin/product/index">Danh sách sản phẩm</a></li>
            <li><a href="<?php echo base_url()?>admin/product/insert">Thêm sản phẩm</a></li>
            <li><a href="<?php echo base_url()?>admin/product/chooseSlider">Chọn slider</a></li>
            <li><a href="<?php echo base_url()?>admin/product/moveSlider">Di chuyển slider</a></li>
        </ul>
    </li>
    <li>
        <a class="collapse" href="#" onclick="return false">Quản lý đơn hàng</a>
        <ul id="ab">
            <li><a href="<?php echo base_url()?>admin/order/index">Danh sách đơn hàng</a></li>
<!--            <li><a href="--><?php //echo base_url()?><!--admin/order/view">Xem đơn hàng</a></li>-->
        </ul>
    </li>
</ul>
