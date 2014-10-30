<form action="/form/save" method="post">
    <textarea name="txt_content" id="txt_content" class="textarea">
        <?php echo $content_html;?>
    </textarea>
    <?php echo display_ckeditor($ckeditor);?>
    <input type="submit" value="Ok"/>
</form>