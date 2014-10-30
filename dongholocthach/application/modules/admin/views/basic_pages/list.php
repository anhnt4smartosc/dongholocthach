<form action="" method="post">
    <textarea id="nestable-output" name="positionArray">
    </textarea>
    <input type="submit" value="Lưu" name="btnOk"/>
</form>
<div class="cf nestable-lists">
    <div class="dd" id="nestable">
        <ol>
            <?php foreach($listPages as $page):?>
                <li class='dd-item' data-id="<?php echo $page['basic_page_id']?>">
                    <ul class="small-menu">
                        <li>
                            <a href="<?php echo base_url("admin/basic_page/update")."/".$page['basic_page_id']?>">
                                Chỉnh sửa
                            </a>
                        </li>
                        <li>
                            <a class="delete_link" href="<?php echo base_url("admin/basic_page/delete")."/".$page['basic_page_id']?>">
                                Xóa trang
                            </a>
                        </li>
                    </ul>
                    <div class='dd-handle'>
                        <?php echo $page['basic_page_name'];?>
                    </div>
                </li>
            <?php endforeach;?>
        </ol>
    </div>
</div>