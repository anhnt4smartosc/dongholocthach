<div id="bot-menu">
    <ul>
        <li>
            <a class="home" href="<?php echo base_url() ?>default/home/index">Trang chủ</a>
        </li>
        <?php foreach ($pageList as $page): ?>
            <li>
                <a href="<?php echo base_url() ?>default/home/basic_page/<?php echo $page['basic_page_id'] ?>"><?php echo $page['basic_page_name'] ?></a>
            </li>
        <?php endforeach; ?>
        <li></li>
    </ul>
    <div style="clear: both">
    </div>
</div>