<div id="center">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script>
        $(function() {
            $( "#datestart" ).datepicker();
            $( "#dateend" ).datepicker();
        });
    </script>
    <form action="" method="post">
        DateStart:
        <input type="text" id="datestart" name="datestart"  >
        DateEnd: <input type="text" id="dateend" name="dateend" >
        <input type="submit" value="Report" name="btnok">
    </form>
    <?php
    echo "<table border='1' cellpadding='0' cellspacing='0' class='table-content'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td>Category ID</a></td>";
    echo "<td>Category Name</a></td>";
    echo "<td>Category ParentID</td>";
    echo "<td>Times buy</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "<tbody id ='showdata'>";
    if(!empty($listcategory))
        foreach($listcategory as $key=> $list)
        {
            if(is_numeric($key))
            {
                if($key % 2 == 0){
                    $class = "odd";
                }else {
                    $class = "even";
                }
                echo "<tr id=".$list['category_id']." class='".$class."'>";
                echo "<td>".$list['category_id']."</td>";
                echo "<td>".$list['category_name']."</td>";
                echo "<td>".$list['category_parentId']."</td>";
                echo "<td>".$list['timebuy']."</td>";
                echo "</tr>";
            }
        }
    echo "</tbody>";
    echo "</table>";
  //  echo $pages;

    ?>
</div>