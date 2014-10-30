
<form action="" method="post">
    <fieldset>
    <legend>Ckeditor</legend>
    <input type="text" placeholder="Tên trang" name="basic_page_name"/><br/>
    <textarea id="txt_content" name="basic_page_content">
        <?php echo $content_html;?>
    </textarea>
        <?php echo display_ckeditor($ckeditor);?>
        <input type="submit" name="btnOk" value="Thêm mới"/>
    </fieldset>
</form>