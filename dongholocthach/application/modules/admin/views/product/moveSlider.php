<?php
    if($listslider == null){
        echo "<h3> Không có sản phẩm được chọn làm slider </h3> ";
    }else{
?>

<link href="<?php echo base_url()?>/public/news/css/category.css" rel="stylesheet" type="text/css" />
<form action="moveSlider" method="post">
    <input type="submit" name="save" value="Save" />
    <input type="text" id="nestable-output" hidden name="jsonPosition" value=""/>
</form>
<br />

<div class="cf nestable-lists">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            <?php

            foreach($listslider as $slider){
                echo "<li class='dd-item' data-id=".$slider['product_id'].">";
                echo "<div class='dd-handle'>".$slider['product_name']."</div>";
                echo "</li>";

            }
            //echo $html;
            ?>
        </ol>
    </div>
</div>

<script src="<?php echo base_url()?>/public/admin/category/jquery.js"></script>
<script src="<?php echo base_url()?>/public/admin/category/jquery.nestable.js"></script>

<script>

    $(document).ready(function()
    {
        $('#nestable').nestable({
            maxDepth : 1
        });

        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
            .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

    });
</script>
        
<?php
    }
?>

