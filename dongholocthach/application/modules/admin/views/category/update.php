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
    <label>Tên Category</label>
    <input type="text" name="category_name" value="<?php echo isset($category['category_name'])?$category['category_name']:''?>"/>
    <?php echo form_error("category_name"); ?>
    <br />
    <label>Thuộc category</label>
    <?php echo $listCategory?>
    <br/>
    <label>&nbsp;</label>
    <input type="submit" name="btnok" value="Update" />
    <input type="reset" value="Reset" />
</form>
</body>
</html>