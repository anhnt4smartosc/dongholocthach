<div id="wrapper">
    <meta charset="UTF-8">
    <?php echo ($error)? $error : ""; ?>
    <form action="" method="post">
        <input type="text" name="user_name" <?php echo set_value("user_name")?>/><?php echo form_error("user_name"); ?><br/>
        <input type="submit" name="ok" value="Gửi"/>
    </form>
    <?php
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/17/14
 * Time: 5:29 PM
 */ ?>
</div>