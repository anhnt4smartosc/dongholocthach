<table class="table-content">
    <thead>
        <th><a href="#" class="sortable" onclick="return ;">Tên hãng</a></th>
        <th><a href="#" class="sortable" onclick="return false;">Miêu tả</a></th>
        <th>Chỉnh sửa</th>
        <th>Xóa</th>
    </thead>
    <tbody>
    <?php foreach($listBrand as $key=>$brand) :?>
        <tr class="<?php print $key % 2 == 0 ?"even":"odd"?>">
            <td class="<?php echo "brand_name"?>">
                <?php print $brand['brand_name'];?>
            </td>
            <td>
                <?php print $brand['brand_desc'];?>
            </td>
            <td>
                <a href="<?php echo base_url()?>admin/brand/edit/<?php print $brand['brand_id'];?>">Chỉnh sửa</a>
            </td>
            <td>
                <a href="<?php echo base_url()?>admin/brand/delete/<?php print $brand['brand_id'];?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br/>
<form action="<?php echo base_url()?>admin/brand/index" method="get">
    <input type="text" name="search_value" placeholder="Nhập tên hãng..." value="<?php echo isset($search_value) && $search_value ?$search_value:""?>"/>
    <label>
        Sắp xếp:
    </label>
    <select name="sort">
        <option value="brand_id" <?php echo isset($sort) && $sort=='brand_id'?"selected":""?> >
            Mã hãng sản xuất
        </option>
        <option value="brand_name" <?php echo isset($sort) && $sort=='brand_name'?"selected":""?> >
            Tên hãng
        </option>
    </select>
    <input type="submit" name="btnSearch" value="Tìm kiếm" />
</form>
<div id="pager">
    <?php print $pager;?>
</div>
