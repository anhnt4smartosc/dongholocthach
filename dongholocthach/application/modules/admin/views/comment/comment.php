<html>
    <head>
        <title>Comment</title>
        <meta charset="UTF-8">
        <style>
            label{
                float: left;
                width: 100px;
            }            
            .error{
                color:red;
            }
        </style>
    </head>
    <body>
    <div id="center">
        <form action="" method="post">
        Display:
        <select name="display_option">        
            <option value="new" <?php if($display_option=='new') echo "selected"?>>New</option>
            <option value="all" <?php if($display_option=='all') echo "selected"?>>All</option>
            <option value="deleted" <?php if($display_option=='deleted') echo "selected"?>>Deleted</option>
            <option value="accepted" <?php if($display_option=='accepted') echo "selected"?>>Accepted</option>
        </select>
        <br />
        Search:
        <input type="text" name="search" value="<?= $search?>"/>
        
    <?php    
        if(isset($error)&&$error!='') echo "<p class='error'>$error</p>";
        else
        {
            echo "<table border='1' cellpadding='0' cellspacing='0' class='table-content'>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>UserName</td>";
            echo "<td>UserEmail</td>";
            echo "<td>Comment</td>";        
            echo "<td>Rate</td>";
            echo "<td>Product</td>";
            echo "<td>Delete</td>";        
            echo "</tr>";
            echo "</tbody>";
            echo "<tbody id ='showdata'>";
            foreach($list_comment as $key=> $value)
            {
                echo "<tr>";
                echo "<td>".$value['user_name']."</td>";
                echo "<td>".$value['user_email']."</td>";
                echo "<td>".$value['comment_detail']."</td>"; 
                echo "<td>".$value['comment_rate']."</td>";  
                echo "<td>".$value['product_name']."</td>";           
                echo "<td><input type='checkbox' name='delete[]' value='".$value['comment_id']."' ".
                ($value['comment_status']==0 ? 'checked' : '')." /></td>";
                echo "</tr>";            
            }
            echo "</tbody>";
            echo "</table>";
        }                
               
    ?>
        <br />
        <input type="submit" name="btnok" value="Submit" />
        </form>
    </div>
        
    </body>
</html>

