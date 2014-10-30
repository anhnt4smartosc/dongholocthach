<style>
    label {
        width: 100px;
        float: left;
    }
    #login-wrap {
        width: 500px;
        margin: auto;
        padding: 10px;
        position: relative;
    }
    body {
        background-color: #373737;
        color: #bbb;
        font-family: inherit;
    }
    input[type='text'],input[type='password']{
        padding: 0 10px;
        width: 300px;
        height: 40px;
        color: #bbb;
        text-shadow: 1px 1px 1px black;
        background: rgba(0, 0, 0, 0.16);
        border: 0;
        border-radius: 5px;
        -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.06);
        box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.06);
    }
    input[type='submit']{
        padding: 0 10px;
        height: 40px;
        color: white;
        border: 0;
        border-radius: 5px;
        background: #00A346;
        font-weight: bold;
    }
    input[type='submit']:hover {
    }
    h2 {
        color: #f5f5f5;
        text-align: center;
    }
</style>
<meta charset="utf-8"/>
<div id="login-wrap">
<h2>Hệ thống quản lí shop bán hàng</h2>


<h4 style="color: red">
<?php
    echo (isset($error)) ? $error : "";
?>
</h4>
<br />
<form action="" method="post">
    <label>Tên đăng nhập</label>
    <input type="text" size="20" name="username" value="<?php echo (isset($username)) ? $username : "Username";?>"/>
    <br/>
    <br/>
    <label>Mật khẩu</label>
    <input type="password" size="20" name="password" value="<?php echo (isset($password)) ? $password : "Password";?>"/>
    <br/>
    <br/>
    <label>&nbsp;</label>
    <input type="submit" name="login" value="Đăng nhập"/>
</form>

</div>