<h3>Quản Lý Image</h3>
<hr />
<?php
/**
 * input : image_id
 * output : table width images
 */
if ( isset($product) && $product != null){
$id = $product['product_id'];
?>
<div class="container">
    <div class="wrap">

        <?php
        echo form_fieldset('<b>Delete Images</b>');
        ?>
        <input type="hidden" name="product_id" value="<?php echo $id;?>" id="product_id" />
        <?php
        $image_product = $this->image_model->get_image_product($id);
        if ( $image_product != null && !empty($image_product) )
        {
            echo '<div class="message" id="message"></div>';
            foreach ($image_product as $row)
            {
                //src - img
                $src = $this->image_model->get_full_path($row['image_id']);
                $thumb = $this->image_model->has_thumb($row['image_id']);
                $src = ($thumb != '' && $thumb !== FALSE)?$thumb : $src;
                //alt - img
                $attrs = $this->image_model->get_image_properties($row['image_id']);
                $alt = ($attrs !== null && $attrs['status']) ? $attrs['width'] . 'x'
                    . $attrs['height'] : '';
                $alt .= $row['image_name'];
                ?>
                <div class="box_10 image_product_container  " id="image_product_container_<?php echo $row['image_id']; ?>" >
                    <div class="box_6 inline " id="image_product_<?php echo $row['image_id']; ?>">
                        <div class="img_thumb_nail ">
                            <img  title="<?php echo $alt;?>"src="<?php echo $src; ?>" alt="<?php echo $alt;?>" class="img_thumb_nail" id="<?php echo $row['image_id'];?>"/>
                            <span class="img_thumb_nail"><?php echo $alt;?></span>
                        </div>
                    </div>
                    <span class="btn_acction_edit">
                        <input type="checkbox" name="delete_<?php echo $row['image_id']?>" <?php if($product['product_mainImageId'] != null && $product['product_mainImageId'] == $row['image_id']) echo "disabled";?> /> 
                    </span>
                </div>
            <?php
            }

            ?>
            <a href="#btn" id="btn" class="btn btn-primary" >Save</a>
            <?php
            echo form_fieldset_close();
        }
        }
        ?>
        <script>
            $(document).ready(function() {
                $("a.btn-primary").click(function(e){
                    e.preventDefault();
                    var selected = $("div.image_product_container input:checked").map(function(i, el){
                        return el.name;
                    }).get();
                    var ok = confirm("Xóa ảnh đã chọn !");
                    if (ok) {
                        var id = $("#product_id").val();
                        $.ajax({
                            'url' : '<?php echo base_url();?>admin/product/delete_image/',
                            'type' : 'POST',
                            'dataType' : 'json',
                            'data': {
                                'id': id,
                                'delete_id': selected
                            },
                            success : function(data){
                                $("div.image_product_container:has(input:checked)").hide(100);
                                $('div.message').addClass('success').text(data).show(500);
                            },
                            error : function(XMLHttpRequest, textStatus, errorThrown) {
                                $('div.message').hide(500);
                                $('div.message').removeClass().addClass('error')
                                    .text('There was an error.').show(500);
                                $("div.image_product_container:has(input:checked)").show(500);
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</div>
</body></html>