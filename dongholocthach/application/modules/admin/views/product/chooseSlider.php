
<form action="<?php echo base_url('admin/product/chooseSlider')?>" method="get">
    <input type="text" name="searchName" placeholder="type search name" value="<?php echo isset($searchName)?$searchName:""?>">
    <input type="submit" name="btnok" value="Search">
</form>
<form action="" method="post">
<input type="submit" name="save"  value="Save" />
    <br /><br />

<table class="table-content">
    <thead style="color: blue;">
        <th>Image</th>
        <th>Image</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Is Slider</th>
    </thead>
    <?php
        $listSlider = array();
        if(isset($listproduct)){
            foreach($listproduct as $key=>$product){
                echo "<tr>";
                echo "<td><img class='thumbnail' src ='".$product['main_image_path']."'/></td>";
                echo "<td><img class='thumbnail' src ='".$product['main_image_path_thumb']."'/></td>";
                echo "<td>".$product['product_id']."</td>";
                echo "<td>".$product['product_name']."</td>";
                //echo "<td>".$product['isSlider']."</td>";
                $listSlider[] = $product['isSlider'];

                if($product['isSlider'] == 1){
                    echo "<td>
                            <input type='checkbox' name='listSlider[".$product['product_id']."]' value='1' checked>
                            <br />
                          </td>";
                }else{
                    echo "<td>
                            <input type='checkbox' name='listSlider[".$product['product_id']."]' value='0' >
                            <br />
                          </td>";
                }

                echo "</tr>";
            }
        }

    ?>
</table>

</form>