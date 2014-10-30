<h3>Danh sach tin tuc</h3>
<?php
    echo "<table border='1' cellpadding='0' cellspacing='0'>";
    foreach($listuser as $list)
    {
        echo "<tr>";
        echo "<td>".$list['name']."</td>";
        echo "<td>".$list['email']."</td>";
        echo "<td>".$list['address']."</td>";
        echo "<td>".$list['phone']."</td>";
        echo "<td><a href='/Day1/news/update/".$list['id']."'>Update</a></td>";
        echo "<td><a href='/Day1/news/delete/".$list['id']."'>Delete</a></td>";
        echo "</tr>";
    }
    echo "<table>";
    echo "<a href='/Day1/news/insert'>Insert</a>";