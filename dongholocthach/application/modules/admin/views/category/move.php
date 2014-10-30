<form action="" method="post">
    <input id="saveCategory" type="button" value="Save">
</form>

<div class="cf nestable-lists">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            <?php
            foreach($listCategory as $category){
                if(!$category['category_parentId'])
                {
                    echo "<li class='dd-item' data-id=".$category['category_id'].">";
                    echo "<div class='dd-handle'>".$category['category_name']."</div>";
                    if(getChildren($listCategory,$category))
                    {
                        echo "<ol class='dd-list'>";
                        printTree($listCategory, $category);
                        echo "</ol>";
                    }
                    echo "</li>";
                }
            }
            //echo $html;
            ?>
        </ol>
    </div>
</div>


<script>

    $(document).ready(function()
    {

    });
</script>

<?php
function getChildren($cateList = array(), $parentCate)
{
    $children = array();
    foreach($cateList as $cate)
    {
        if($cate['category_parentId'] == $parentCate['category_id'])
        {
            $children[] = $cate;
        }
    }

    if(count($children) == 0)
    {
        return false;
    }
    else {
        return $children;
    }
}

function printTree($cateList, $cate)
{
    $children = getChildren($cateList, $cate);
    if($children)
    {
        foreach($children as $child)
        {
            echo "<li class='dd-item' data-id=".$child['category_id'].">";
            echo "<div class='dd-handle'>".$child['category_name']."</div>";
            if(getChildren($cateList, $child))
            {
                echo "<ol class='dd-list'>";
                printTree($cateList, $child);
                echo "</ol>";
            }
            echo "</li>";
        }
    }

}
?>