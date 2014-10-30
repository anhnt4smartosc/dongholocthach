<style>
    .table-content img {
        max-width: 100px;
    }
</style>

<form action="" method="get">
    <label>Tên sản phẩm</label>
    <input type="text" name="product_name" value="<?php echo $product_name?$product_name:""?>"/>
    <br/>
    <label>Hãng</label>
    <select name="brand_id">
        <option value="-1" <?php echo $brand_id == -1 ? "selected" : ""?> >Tất cả các hãng</option>
        <?php foreach($listBrands as $brand):?>
            <option value="<?php echo $brand['brand_id']?>" <?php echo $brand['brand_id'] == $brand_id ? "selected":""?> >
                <?php echo $brand['brand_name']?>
            </option>
        <?php endforeach;?>
    </select><br/>
    <input name="btnOk" value="Tìm kiếm" type="submit">
</form>
<div id="pager">
    <?php echo $pager;?>
</div>
<table class="table-content">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Ảnh đại diện</th>
        <th>Giá sản phẩm</th>
        <th>Sale</th>
        <th>Ngày bắt đầu</th>
        <th>Kết thúc</th>
        <th>Chỉnh sửa</th>
        <th>Xóa</th>
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
            <td><a class="delete_link" href="<?php echo base_url("admin/products/delete")."/".$product['product_id']?>">Xóa</a></td>
        </tr>
    <?php endforeach;?>
</table>
<a href="<?php echo base_url("admin/products/insert")?>" class="insert_link">
    Thêm mới sản phẩm
</a>