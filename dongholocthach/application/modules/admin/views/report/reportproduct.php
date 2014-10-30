
<div id="center">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script>
        $(function() {
            $( "#datestart" ).datepicker();
            $( "#dateend" ).datepicker();
        });
    </script>
    <form action="" method="post">
        DateStart: <input type="text" id="datestart" name="datestart" value="<?php echo $datestart?date('m/d/Y',$datestart):''?>" >
        DateEnd: <input type="text" id="dateend" name="dateend" value="<?php echo  $dateend?date('m/d/Y',$dateend):''?>">
        <input type="submit" value="Report" name="btnok">
    </form>
    <?php
    echo "<table border='1' cellpadding='0' cellspacing='0' class='table-content'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>Image</a></td>";
    echo "<td>Name</a></td>";
    echo "<td>Price</td>";
    echo "<td>Price sale</td>";
    echo "<td>Brand</td>";
    echo "<td>Total sell</td>";
    echo "<td>Update</td>";
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
                echo "<td><img class='thumbnail' src ='".base_url()."public/admin/images/".$list['image_path']."'/></td>";
                echo "<td>".$list['product_name']."</td>";
                echo "<td>".$list['product_price']."</td>";
                echo "<td>".$list['product_sale']."</td>";
                echo "<td>".$list['brand_name']."</td>";
                echo "<td>".$list['total']."</td>";
                echo "<td><a href='".base_url()."admin/product/update/".$list['product_id']."'>Update</a></td>";
                echo "</tr>";
            }
        }
    echo "</tbody>";
    echo "</table>";
    echo $pages;

    ?>
</div>