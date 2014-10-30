<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Update User</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <style>
            label{
                float: left;
                width: 100px;
            }
            input{
                margin-bottom: 5px;
            }
            .error{
                color:red;
            }
        </style>
    </head>
    <body>
        
        <form action="" method="post">
            <label>Full name</label>
            <input type="text" name="txtfullName" value="<?= isset($user['user_fullName'])?$user['user_fullName']:'' ?>" />
            <span class="error">
                <?php echo isset($error['errorName']) ? $error['errorName'] : ""; ?>
            </span>
            <br />
            <label>Email</label>
            <input type="text" name="txtemail" value="<?= isset($user['user_email'])?$user['user_email']:'' ?>" />
            <span class="error">
                <?php echo isset($error['errorEmail']) ? $error['errorEmail'] : ""; ?>
            </span>
            <br />
            <label>Address</label>
            <input type="text" name="txtaddress" value="<?= isset($user['user_address'])?$user['user_address']:'' ?>" />
            <span class="error">
                <?php echo isset($error['errorAddress']) ? $error['errorAddress'] : ""; ?>
            </span>
            <br />
            <label>Phone</label>
            <input type="text" name="txtphone" value="<?= isset($user['user_phone'])?$user['user_phone']:'' ?>" />
            <span class="error">
                <?php echo isset($error['errorPhone']) ? $error['errorPhone'] : ""; ?>
            </span>
            <br />
            <label>Gender</label>
            Male<input type="radio" name="txtgender" value="1" <?= (isset($user['user_gender']) && $user['user_gender']=='1') ? 'checked' : '' ?> />
            Female&nbsp;<input type="radio" name="txtgender" value="0" <?= (isset($user['user_gender']) && $user['user_gender']=='0') ? 'checked' : '' ?> />
            <span class="error">
                <?php echo isset($error['errorGender']) ? $error['errorGender'] : ""; ?>
            </span>
            <br />            
            <label>&nbsp;</label>
            <input type="submit" name="btnok" value="Update" />
        </form>
    </body>
</html>
