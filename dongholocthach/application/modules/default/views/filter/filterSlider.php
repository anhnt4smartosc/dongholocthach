<form action="" method="post">
    <table id="filter-table">
        <tr>
            <td rowspan="2">
                <select id="allBrand">
                    <?php
                    echo "<option value='0'> -- select brand -- </option>";
                    foreach($listbrand as $brand){
                        echo "<option value='".$brand['brand_id']."'>".$brand['brand_name']."</option>";
                    }
                    ?>
                </select>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                    <div id="rangedval">
                        Khoảng giá :
                    <span id="rangeval">
                        <?php echo ($minPrice)? $minPrice : ""?> - <?php echo ($maxPrice)? $maxPrice : "" ?>
                    </span>
                        <input type="hidden" id="base_url" value="<?php echo base_url()?>" />
                        <input type="hidden" id="minPrice" value="<?php echo ($minPrice)? $minPrice : 0?>" />
                        <input type="hidden" id="maxPrice" value="<?php echo ($maxPrice)? $maxPrice : 0?>" />

                    </div>
            </td>
         </tr>
         <tr>
            <td></td>
            <td>
                <div id="rangeslider" ></div>
            </td>
             <td>&nbsp;&nbsp;&nbsp;</td>
        </tr>
    </table>
</form>
<br />
<table id ='showdata'>
    <tr><td></td></tr>
</table>
