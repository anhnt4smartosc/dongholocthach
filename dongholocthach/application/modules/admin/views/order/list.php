<form action="<?php echo base_url("admin/order/index")?>">
    <label>Mã đơn hàng</label>
    <input type="text" name="search_id" value="<?php echo $search_id?$search_id:""?>"/>
    <br/>

    <label>Ngày tạo</label>
    <input type="text" name="search_date" value="<?php echo $search_date?$search_date:""?>"/>
    <br/>

    <label>Sắp xếp</label>
        <select name="order">
            <option value="order_id" <?php echo $order == "order_id"?"selected":"" ?>>Mã đơn hàng</option>
            <option value="order_date" <?php echo $order == "order_date"?"selected":"" ?>>Ngày tạo</option>
        </select>
    <br/>
    <label>Trạng thái</label>
        <select name="search_status">
            <option value="-1">Tất cả</option>
            <option value="0" <?php echo $order == "0"?"selected":"" ?>>Chưa xác nhận</option>
            <option value="1" <?php echo $order == "1"?"selected":"" ?>>Đang thanh toán</option>
            <option value="2" <?php echo $order == "2"?"selected":"" ?>>Đã thanh toán</option>
        </select>

        <input type="radio" value="asc" name="order_opt" <?php echo $order_opt == "asc"?"checked":""?>/>Tăng dần
        <input type="radio" value="desc" name="order_opt" <?php echo $order_opt == "desc"?"checked":""?>/>Giảm dần
    <br/>
    <input type="submit" value="Tìm kiếm" name="searchBtn"/>
</form>
<table class="table-content">
    <thead>
        <th>Mã đơn hàng</th>
        <th>Ngày tạo</th>
        <th>Trạng thái</th>
        <th>Tên khách hàng</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
        <th>Giới tính</th>
        <th>Chi tiết</th>
<!--        <th>Xóa</th>-->
    </thead>
    <?php foreach($listOrder as $key => $order):?>
        <?php $class = $key % 2 == 0?"odd":"even"?>
        <tr class="<?php echo $class?>" >
            <td>
                <?php echo $order['order_id'];?>
            </td>
            <td>
                <?php echo $order['order_date'];?>
            </td>
            <td>
                <?php
                switch($order['order_status']){
                    case 0: echo "<p class='uncheck'>Chưa xác nhận</p>";break;
                    case 1: echo "<p class='checked'>Đang thanh toán</p>";break;
                    case 2: echo "<p class='finished'>Đã thanh toán</p>";break;
                }
                ?>
            </td>
            <td>
                <?php echo $order['order_fullName'];?>
            </td>
            <td>
                <?php echo $order['order_email'];?>
            </td>
            <td>
                <?php echo $order['order_address'];?>
            </td>
            <td>
                <?php echo $order['order_phone'];?>
            </td>
            <td>
                <?php echo $order['order_gender'] == 1?"Nam":"Nữ";?>
            </td>
            <td>
                <a href="<?php echo base_url("admin/order/view")."/".$order['order_id']?>">Chi tiết</a>
            </td>
            <td>
<!--                <a href="--><?php //echo base_url("admin/order/delete")."/".$order['order_id']?><!--">Xóa</a>-->
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div id="pager">
    <?php print $pager;?>
</div>