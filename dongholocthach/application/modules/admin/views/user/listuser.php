<div id="center">
    <form action="" method="get">
    <label class="sort">Sort by</label>
    <select name="sortby" id="sortby">
        <option value="user_name">user_name</option>
        <option value="user_fullName">user_fullName</option>
        <option value="user_email">user_email</option>
        <option value="user_address">user_address</option>
        <option value="user_gender">user_gender</option>
    </select>
    <label class="sort">Type sort</label>
    <select name="typesort" id="typesort">
        <option value="asc">ASC</option>
        <option value="desc">DESC</option>
    </select>
    <input type="submit" name="btnok" value="Sort"/>
    </form>

    <?php
    echo "<table border='1' cellpadding='0' cellspacing='0' class='table-content'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>User name</a></td>";
    echo "<td>Full name</a></td>";
    echo "<td>Email</a></td>";
    echo "<td>Address</a></td>";
    echo "<td>Phone</td>";
    echo "<td>Gender</td>";
    echo "<td>Update</td>";
    echo "<td>Delete</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "<tbody id ='showdata'>";
    foreach($listuser as $key=> $list)
    {
        if(is_numeric($key))
        {
            if($key % 2 == 0){
                $class = "odd";
            }else {
                $class = "even";
            }
            $gender = $list['user_gender']==1?"Nam":"Nữ";
            echo "<tr id=".$list['user_id']." class='".$class."'>";
            echo "<td>".$list['user_name']."</td>";
            echo "<td>".$list['user_fullName']."</td>";
            echo "<td>".$list['user_email']."</td>";
            echo "<td>".$list['user_address']."</td>";
            echo "<td>".$list['user_phone']."</td>";
            echo "<td>".$gender."</td>";
            echo "<td><a href='".base_url()."admin/user/update/".$list['user_id']."'>Update</a></td>";
            echo "<td><a href='".base_url()."admin/user/delete/".$list['user_id']."'>Delete</a></td>";
            echo "</tr>";
        }
    }
    echo "</tbody>";
    echo "</table>";
    echo "<a href='".base_url()."admin/user/insert'><input type ='button' value='thêm mới'></a>";
    echo $pages;
    ?>
</div>