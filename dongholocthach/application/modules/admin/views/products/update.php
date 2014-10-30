<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<form method="post" enctype="multipart/form-data">
    <label>Tên sản phẩm</label>
    <input name="product_name" value="<?php echo $product['product_name']?>"/>
    <br/>

    <label>Giá</label>
    <input name="product_price" value="<?php echo $product['product_price']?>" size="15"/>VNĐ
    <br/>

    <label>Sale</label>
    <input name="product_sale" value="<?php echo $product['product_sale']?>" size="10"/>%
    <br/>

    <label>Ngày bắt đầu sale</label>
    <input name="product_sale_date_start" id="product_sale_date_start" value="<?php echo $product['product_sale_date_start']?>" size="20"/>
    <br/>

    <label>Ngày kết thúc sale</label>
    <input name="product_sale_date_end" id="product_sale_date_end" value="<?php echo $product['product_sale_date_end']?>" size="20"/>
    <br/>


    <label>Miêu tả sản phẩm</label><br/>
    <textarea name="product_description" id="product_description">
        <?php echo $content_html;?>
    </textarea>
    <br/>
    <script type="text/javascript" src="<?php echo base_url();?>public/ckeditor/ckeditor.js"></script>
    <?php echo display_ckeditor($ckeditor);?>
    <label>Hãng</label>
    <?php if(count($listBrands)>0):?>
        <select name="brand_id">
            <?php foreach($listBrands as $brand):?>
                <option value="<?php echo $brand['brand_id']?>" <?php echo $brand['brand_id'] == $product['brand_id']?"selected":""?>>
                    <?php echo $brand['brand_name']?>
                </option>
            <?php endforeach;?>
        </select>
    <?php else:?>
        <p>Vui lòng thêm trước các hãng</p>
    <?php endif;?>
    <br/>

    <label>Ảnh đại diện</label>
    <br/>
    <img width="200px" src="<?php echo base_url("public/products/images")."/".$product['product_main_image']?>"/>
    <br/>
    <input type="file" name="product_main_image"/>
    <br/>
    <input type="submit" value="Thêm mới" name="btnOk"/>
</form>
<script>
    $(function() {
        $("#product_sale_date_start").datepicker();
        $("#product_sale_date_end").datepicker();
    });
</script>
