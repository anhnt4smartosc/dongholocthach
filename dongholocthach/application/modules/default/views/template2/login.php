<meta charset="utf-8"/>
<h1>Login</h1>
<form action="" method="post">
    <label>Username</label>
    <input type="text" size="20" name="username"/>
    <br/>
    <label>Password</label>
    <input type="password" size="20" name="password"/>
    <br/>
    <input type="submit" name="login" value="Login"/>
</form>
<label style='color: red;'><?php echo isset($error)?$error:""?></label>

