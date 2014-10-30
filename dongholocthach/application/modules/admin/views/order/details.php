<?php

?>

<table class="table-content">
    <tr class="header-table"><td colspan="4">Thông tin khách hàng</td></tr>
    <tr>
        <td>Mã đơn hàng</td>
        <td colspan="3"><?php  echo $order['order_id']?></td>
    </tr>

    <tr>
        <td>Ngày tạo</td>
        <td colspan="3"><?php  echo $order['order_date']?></td>
    </tr>

    <tr>
        <td>Trạng thái</td>
        <td colspan="3">
            <?php
                switch($order['order_status']){
                    case 0: echo "Chưa xác nhận";break;
                    case 1: echo "Đang thanh toán";break;
                    case 2: echo "Đã thanh toán";break;
                }
            ?>
        </td>
    </tr>

    <tr>
        <td>Người mua</td>
        <td colspan="3"><?php  echo $order['order_fullName']?></td>
    </tr>

    <tr>
        <td>Mã khách hàng</td>
        <td colspan="3"><?php  echo $order['user_id']?></td>
    </tr>

    <tr>
        <td>Email</td>
        <td colspan="3"><?php  echo $order['order_email']?></td>
    </tr>

    <tr>
        <td>Điện thoại</td>
        <td colspan="3"><?php echo $order['order_phone']?></td>
    </tr>
    <tr class="header-table"><td colspan="4">Thông tin đặt hàng</td></tr>
    <tr class="header-column">
        <td>Mã sản phẩm</td>
        <td>Tên sản phẩm</td>
        <td>Giá bán</td>
        <td>Số lượng</td>
    </tr>
    <?php
        $total = 0;
        foreach($orderDetails as $detail):
    ?>
        <tr>
            <td><?php echo $detail['product_id']?></td>
            <td><?php echo $detail['product_name']?></td>
            <td><?php echo $detail['order_price']?></td>
            <td><?php echo $detail['order_quantity']?></td>
            <?php $total+=$detail['order_price']* $detail['order_quantity']?>
        </tr>
    <?php endforeach;?>
    <tr class="total-row">
        <td colspan="3">Thành tiền</td>
        <td><?php echo $total?></td>
    </tr>
</table>
<br/>
    <?php if($order['order_status'] == 0):?>
        <a class="button-link delete-link" href="<?php echo base_url("/admin/order/approve/")."/".$order['order_id']?>">Xác nhận hóa đơn</a>
        <a class="button-link" href="<?php echo base_url("/admin/order/delete/")."/".$order['order_id']?>">Hủy hóa đơn</a>
    <?php elseif($order['order_status'] == 1):?>
        <a class="button-link" href="<?php echo base_url("/admin/order/delete/")."/".$order['order_id']?>">Hủy hóa đơn</a>
        <a class="button-link" href="<?php echo base_url("/admin/order/finish/")."/".$order['order_id']?>">Hoàn thành hóa đơn</a>
    <?php endif?>


