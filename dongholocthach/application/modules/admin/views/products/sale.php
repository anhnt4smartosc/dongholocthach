<style>
    .table-content img {
        max-width: 100px;
    }
</style>
<table class="table-content">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Ảnh đại diện</th>
        <th>Giá sản phẩm</th>
        <th>Sale</th>
        <th>Ngày bắt đầu</th>
        <th>Kết thúc</th>
        <th>Chỉnh sửa</th>
    </tr>
    <?php foreach($listProducts as $product):?>
        <tr>
            <td><?php echo $product['product_name']?></td>
            <?php
            $main = $product['product_main_image'];
            $arr = explode(".",$main);
            $arr[0] = $arr[0]."_thumb";
            $thumb = implode('.',$arr);
            ?>
            <td><img src="<?php echo base_url("public/products/images/230x172")."/".$thumb?>"/></td>
            <td><?php echo $product['product_price']?></td>
            <td><?php echo $product['product_sale']?></td>
            <td><?php echo $product['product_sale_date_start']?></td>
            <td><?php echo $product['product_sale_date_end']?></td>
            <td><a class="update_link" href="<?php echo base_url("admin/products/update")."/".$product['product_id']?>">Chỉnh sửa</a></td>
        </tr>
    <?php endforeach;?>
</table>