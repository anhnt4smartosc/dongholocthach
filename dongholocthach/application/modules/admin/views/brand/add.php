
<form action="" method="post">
    <label>Tên hãng</label>
    <input type="text" name="brand_name" value="<?php echo set_value("brand_name")?>"/>
    <?php echo form_error("brand_name")?>
    <br/>
    <label>Miêu tả</label>
    <textarea name="brand_desc"><?php echo set_value("brand_desc");?></textarea>
    <?php echo form_error("brand_desc")?>
    <br/>
    <input type="submit" value="Thêm mới" name="btnOk"/>
</form>
<?php echo $this->session->flashdata('message')?$this->session->flashdata('message'):""?>