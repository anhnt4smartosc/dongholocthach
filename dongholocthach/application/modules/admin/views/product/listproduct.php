<div id="center">
    <form action="<?php echo base_url('admin/product/listProduct')?>" method="get">
        <input type="text" name="searchName" placeholder="type search name" value="<?php echo isset($searchName)?$searchName:""?>">
        <input type="submit" name="btnok" value="Search">
    </form>
    <?php
    echo "<table border='1' cellpadding='0' cellspacing='0' class='table-content'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>Image</a></td>";
    echo "<td>Name</a></td>";
    echo "<td>Date up</a></td>";
    echo "<td>Price</td>";
    echo "<td>Price sale</td>";
    echo "<td>Brand</td>";
    echo "<td>Update</td>";
    echo "<td>Delete</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "<tbody id ='showdata'>";
    if(!empty($listproduct))
        foreach($listproduct as $key=> $list)
        {
            if(is_numeric($key))
            {
                if($key % 2 == 0){
                    $class = "odd";
                }else {
                    $class = "even";
                }
                echo "<tr id=".$list['product_id']." class='".$class."'>";
                echo "<td><img class='thumbnail' src ='".$list['image_path']."'/></td>";
                echo "<td>".$list['product_name']."</td>";
                echo "<td>".$list['product_date']."</td>";
                echo "<td>".$list['product_price']."</td>";
                echo "<td>".$list['product_sale']."%</td>";
                echo "<td>".$list['brand_name']."</td>";
                echo "<td><a href='".base_url()."admin/product/edit/".$list['product_id']."'>Update</a></td>";
                echo "<td><a href='".base_url()."admin/product/delete/".$list['product_id']."'>Delete</a></td>";
                echo "</tr>";
            }
        }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='".base_url()."admin/product/insert'><input type ='button' value ='thêm mới'></a>";
    echo $pages;

    ?>
</div>