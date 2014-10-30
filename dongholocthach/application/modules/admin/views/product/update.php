
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
                echo "<li><input type='checkbox' ".$check." name ='cate_id[]' value ='".$value['category_id']."'>".$value['category_name'];
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
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/home/css/alz_style.css'; ?>">
    <style>
        .category_list {
            background: #fbfbfb;
            border: 1px solid #ccc;
            width: 350px;
            margin-left: 180px;
        }
        .category_list  > textarea{
            width: 350px;
            height: 100px;
        }
        .category_list    ul  > li {
            margin: 15px;
        }
        .wrap_category > label{
            width: 200px;
        }
    </style>
    <script src="<?php echo base_url() . 'public/admin/js/jquery-1.11.0.min.js' ;?>"></script>
</head>
<body>
<div class="container">
    <div class="wrap-info">
        <div class="left_content">
            <?php
            /**
             * nhận dữ liệu từ product model
             * tạo form với chức năng chỉnh sửa
             * @var string
             */
            if (isset($product) && $product != null) {
                if (isset($success) && $success) {
                    ?>
                    <div class="alert alert-success">
                        <h3>Thay đổi thành công</h3>
                    </div>
                <?php
                }
                if (isset($errors) && !empty($errors))
                {
                    echo '<div class="error alert alert-error">';
                    var_dump($errors);
                    if (is_array($errors)) {
                        foreach ($errors as $err) {
                            echo '<h4><p class="error alert alert-error">' . $err . '</p></h4>';
                        }
                    }else echo $errors;
                    echo '</div>';
                }
                $id  = $product['product_id'];
                $atrs =  array('class' => 'form_control', 'id' => 'form_update_product');
                echo form_open_multipart(base_url().'index.php/admin/product/edit/' . $id , $atrs);   // echo form_hidden()
                echo form_fieldset('<b>Update product</b>');

                $options =  array();
                $selected = isset($brand[0]) ? '': 'brand_' . $brand['brand_id'];
                $brands = $this->brand_model->get();
                foreach($brands as $e) {
                    $key =  'brand_' . $e['brand_id'];
                    $value = $e['brand_name'];
                    $options["$key"] = $value;
                }
                // brands
                echo '<label for="brands">Hãng sản phẩm:  </label>';
                if ($selected) echo form_dropdown('brands', $options, $selected);
                else echo form_dropdown('brands', $options);
                echo '<br/>';

                // name
                echo '<label for="product_name">Tên sản phẩm: </label>';
                echo '<input type="text" name="product_name" value="';
                if (isset($product) && isset($product['product_name'])) echo $product['product_name'] . '"';
                else echo '" placeholder="product name"';
                echo '>';
                echo '<br/>';

                // price
                echo '<label for="product_price">Giá sản phẩm: </label>';
                echo '<input type="text" name="product_price" value="' ;
                if (isset($product) && isset($product['product_price'])) echo $product['product_price'] . '"';
                else echo '" placeholder="price ..."';
                echo '>';
                echo '<br/>';

                // sale %
                echo '<label for="product_sale">Giảm giá: </label>';
                echo '<input type="text" name="product_sale" value="' ;
                if (isset($product) && isset($product['product_sale'])) echo $product['product_sale'] . '"';
                else echo '" placeholder="sale ..."';
                echo '>';
                echo '<br />';

                // desc -text area
                $data = array(
                    'name'        => 'product_desc',
                    'id'          => 'product_desc',
                    'value'       => isset($product['product_desc']) ?  $product['product_desc'] : '',
                    'cols' => '20',
                    'rows' => '8'
                );

                echo '<label for="product_desc">Thông tin mô tả: </label>';
                echo form_textarea($data);
                // main image
                echo '<div>';
                echo '<div style="width="350px"; height="350px"; text-align="center";" >';
                echo form_label('Ảnh đại diện: ','product_mainImage');
                echo '</div>';
                echo '<div width="350px" height="450px">';
                $src =  isset($path) ? $path : base_url(). 'public/admin/images/product/default/face.png';
                echo '<img src="'.$src.'"  width="350px" height="350px" alt="Anh dai dien">';
                echo '</div>';

                // change image , register dynamic load with advance
                echo '<div id="image_load" >';
                // check box !important
                echo form_label('Thay thế ảnh đại diện: ','product_images');
                echo '<input type="checkbox" name="image_edit" value="'. $image['image_id'] .'" /> ';
                // var_dump($image);

                // change image : selelct drpdown - option
                echo '<select id="images_product_dynamic" name="product_images">';
                echo '<option value="" checked>&nbsp;</option>';
                if(isset($image_product) && $image_product) {
                    foreach($image_product as $img) {
                        if (file_exists($img['image_path'])) {
                            $src = $img['image_path'];
                        }else {
                            $src_thumb = $this->image_model->has_thumb($img['image_id']);
                            $src = $src_thumb !== FALSE ? $src_thumb:$this->image_model->get_full_path($img['image_id']);
                        }
                        if ($image['image_id'] == $img['image_id'] ) continue;
                        $echo_option = (isset($img['image_name']) && $img['image_name'] != null) ? $img['image_name'] : $img['image_path'];
                        echo '<option style="background-image:url('. $src .' );" value="'. $img['image_id'].'" >'.$echo_option.'</	option>';
                    }
                }
                echo '</div>';
                ?>
                <!--    <script>
                        $(function () {
                                $("#images_product_dynamic").change(function() {
                                        var css;
                                        var img = $("#images_product_dynamic option:selected").css(["background_image"]);
                                        $.each(img, function (prop, value) {
                                            html.push( prop + ": " + value );
                                        });
                                        alert(img);
                                    });
                            });
                    </script>-->
                <?php

                // change image :  upload image
                echo '<label for="upload" >Hoặc</label>';
                echo '<input type="file" name="upload"  />';
                echo '<br />';

                $category = $this->category_model->listCategory();
                $slts = array();
                if (isset($categories)) {
                    if (is_array($categories)) {
                        $slts = array();
                        foreach ($categories as $c) {
                            $slts [] =  $c['category_id'];
                        }
                    }
                }
                ?>
                <div class="wrap wrap_category">
                    <label>Category</label>
                    <br />
                    <div class="category_list">
                        <?php
                        if(isset($slts) && is_array($slts)){
                            build_cate_list($category,0,$slts);
                        }else {
                            build_cate_list($category);
                        }
                        ?>
                    </div>
                </div>
                <div id="block_upload_images">
                    <label for="upload_images">Upload image</label>
                    <input type="file" multiple="mutiple" name="upload_images[]" />
                </div>
                <?php

                echo form_label('Update', 'btnok');
                echo form_submit('btnok', 'Update!');
                $content =  '<a href="'. base_url(). 'admin/product/index' .'"  class="btn" style="padding: 2px; margin-left: 20px; background-color: yellow; text-decoration: none; color: black;" >back</a>';
                echo $content;

                echo form_fieldset_close();
                echo '</form>';
            }else {
                echo '<p class="info">Khong ton tai product nay</p>';
            }
            ?>
        </div>
    </div>
</div>
<?php $this->load->view('product/image_manage', $data); ?>