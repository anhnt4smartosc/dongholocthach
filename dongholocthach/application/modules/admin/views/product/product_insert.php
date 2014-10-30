<style>
    .category_list {
        background: #fbfbfb;
        border: 1px solid #ccc;
        width: 350px;
    }
    textarea{
        width: 350px;
        height: 100px;
    }
</style>
<div style="clear:both;"></div>
<div class="grid_12">
    <div class="module">
        <div class="module-body">
            <form action="" method="POST" enctype="multipart/form-data">

                    <label>Product name</label>
                    <input type="text" class="input-short" name="product_name" size="60" value="<?php echo set_value("product_name")?>"/>
                    <?php echo form_error("product_name"); ?>
                    <br/>

                    <label>Product price</label>
                    <input type="text" class="input-short" name="product_price" value="<?php echo set_value("product_price")?>"/>
                    <?php echo set_value("product_price")?>
                    <?php echo form_error("product_price"); ?>
                    <br/>

                    <label>Price sale</label>
                    <input type="text" class="input-short" name="product_sale" value="<?php echo set_value("product_sale")?>"/>
                    <?php echo form_error("product_price"); ?>
                    <br/>


                    <label>Category</label>
                    <br/>

                    <div class="category_list">
                     <?php
                        if(isset($checkedCate) && is_array($checkedCate)){
                            build_cate_list($listCategory,0,$checkedCate);
                        }else {
                            build_cate_list($listCategory);
                        }
                     ?>
                    </div>

                    <br/>
                <?php //echo form_error("cate_id[]"); ?>
                <label>Product Description</label>
                <br/>
                    <textarea name="product_desc" ><?php echo set_value("product_desc")?></textarea>
                <br/>

                <script type="text/javascript" src="<?php echo base_url();?>public/ckeditor/ckeditor.js"></script>
                <script>
                if(CKEDITOR.instances['product_desc']) {
                CKEDITOR.remove(CKEDITOR.instances['product_desc']);
                }
                CKEDITOR.config.width = 1000;
                CKEDITOR.config.height = 200;
                CKEDITOR.replace('product_desc',{});
                </script>
                    <label>Brand</label>
                    <select style="width: 150px;" name="brand_id">
                            <option value="">Select brand</option>
                            <?php if(isset($listBrand) && $listBrand != null) {
                                foreach($listBrand as $brand) {
                                    $check = "";
                                    if($brand['brand_id'] == set_value("brand_id")){
                                        $check = "selected";
                                    }
                                    echo "<option value='".$brand['brand_id']."' ".$check.">".$brand['brand_name']."</option>";
                                }
                            }
                            ?>
                    </select>
                    <?php echo form_error("brand_id"); ?>

                    <br/>

                    <label>Product images</label>
                    <input type="file" name="images" value="<?php echo set_value("images")?>" />
                    <?php echo form_error("images"); ?>
                    <br/>

                    <label>Images small</label>
                    <input type="file" name="imgs[]" multiple="true" value=""/>
                    <br/>

                    <input type="submit" value="Insert product" name="btninsert" />
            </form>
        </div>

    </div>  
    <div style="clear:both;"></div>
    <?php
        function build_cate_list($sourceArr,$parents = 0,$arrayValues = array())
        {
            if(count($sourceArr)> 0) {
                echo "<ul>";
                foreach($sourceArr as $key => $value){
                    $check = "";
                    if(in_array($value["category_id"],$arrayValues)){
                        $check = "checked";
                    }
                    if($value['category_parentId'] == $parents){
                        echo "<li><input type='checkbox' ".$check." name ='cate_id[]' value ='".$value['category_id']."'>".$value['category_name'].$check;
                        $newParents = $value['category_id'];
                        unset($sourceArr[$key]);
                        build_cate_list($sourceArr,$newParents,$arrayValues);
                        echo "</li>";
                    }
                }
                echo "</ul>";
            }

        }
    ?>
</div> 