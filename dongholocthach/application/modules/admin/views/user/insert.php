<html>
<head>
    <meta charset="UTF-8">
    <style>
        label {
            width: 150px;
            float: left;
        }
        .error {
            color:red;

        }
    </style>
</head>
<body>
<form action="" method="post">
    <label>Tên người dùng</label>
    <input type="text" name="user_name" value="<?php echo set_value("user_name")?>"/>
    <?php echo form_error("user_name"); ?>
    <br />

    <label>Mật khẩu</label>
    <input type="password" name="user_password" value="<?php echo set_value("user_password")?>"/>
    <?php echo form_error("user_password"); ?>
    <br />

    <label>Xác nhận mật khẩu</label>
    <input type="password" name="user_password_conf" value="<?php echo set_value("user_password_conf")?>"/>
    <br />

    <label>Địa chỉ</label>
    <input type="text" name="user_address" value="<?php echo set_value("user_address")?>"/>
    <?php echo form_error("user_address"); ?>
    <br />

    <label>Email</label>
    <input type="text" name="user_email" value="<?php echo set_value("user_email")?>"/>
    <?php echo form_error("user_email"); ?>
    <br />

    <label>Tên đầy đủ</label>
    <input type="text" name="user_fullName" value="<?php echo set_value("user_fullName")?>"/>
    <?php echo form_error("user_fullName"); ?>
    <br />

    <label>Điện thoại</label>
    <input type="text" name="user_phone" value="<?php echo set_value("user_phone")?>"/>
    <?php echo form_error("user_phone"); ?>
    <br />
    <label>Giới tính</label>
    <input type="radio" name="user_gender" value="1" <?php echo set_value("user_phone") == 1?"checked":""?> /> Nam
    <input type="radio" name="user_gender" value="2" <?php echo set_value("user_phone") == 2?"checked":""?> /> Nữ
    <?php echo form_error("user_gender"); ?>
    <br/>

    <label>Vai trò</label>
    <select name="user_level">
        <option value="1">Admin</option>
        <option value="2" selected>Người dùng</option>
    </select>
    <br/>
    <label>&nbsp;</label>
    <input type="submit" name="ok" value="Insert" />
    <input type="reset" value="Reset" />
</form>
</body>
</html>