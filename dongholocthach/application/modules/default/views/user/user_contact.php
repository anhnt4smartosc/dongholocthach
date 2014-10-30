<meta charset="utf-8" />
<style>
    button, input, select, textarea {
        font-size: 100%;
        margin: 0;
        vertical-align: middle;
    }
    button, input {
        line-height: normal;
    }
    button::-moz-focus-inner, input::-moz-focus-inner {
        border: 0 none;
        padding: 0;
    }
    button, html input[type="button"], input[type="reset"], input[type="submit"] {
        cursor: pointer;
    }
    label, select, button, input[type="button"], input[type="reset"], input[type="submit"], input[type="radio"], input[type="checkbox"] {
        cursor: pointer;
    }
    input[type="search"] {
        box-sizing: content-box;
    }
    textarea {
        overflow: auto;
        vertical-align: top;
    }

    html {
        font-family: sans-serif;
    }
    body {
        margin: 0;
    }
    article, aside, details, figcaption, figure, footer, header, hgroup, main, nav, section, summary {
        display: block;
    }
    audio, canvas, progress, video {
        display: inline-block;
        vertical-align: baseline;
    }
    audio:not([controls]) {
        display: none;
        height: 0;
    }
    [hidden], template {
        display: none;
    }
    a {
        background: none repeat scroll 0 0 transparent;
    }
    a:active, a:hover {
        outline: 0 none;
    }
    abbr[title] {
        border-bottom: 1px dotted;
    }
    b, strong {
        font-weight: 700;
    }
    dfn {
        font-style: italic;
    }
    h1 {
        font-size: 2em;
        margin: 0.67em 0;
    }
    mark {
        background: none repeat scroll 0 0 #ffff00;
        color: #000000;
    }
    small {
        font-size: 80%;
    }
    sub, sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
    }
    sup {
        top: -0.5em;
    }
    sub {
        bottom: -0.25em;
    }
    img {
        border: 0 none;
    }
    svg:not(:root) {
        overflow: hidden;
    }
    figure {
        margin: 1em 40px;
    }
    hr {
        box-sizing: content-box;
        height: 0;
    }
    pre {
        overflow: auto;
    }
    code, kbd, pre, samp {
        font-family: monospace,monospace;
        font-size: 1em;
    }
    button, input, optgroup, select, textarea {
        color: inherit;
        font: inherit;
        margin: 0;
    }
    button {
        overflow: visible;
    }
    button, select {
        text-transform: none;
    }
    button, html input[type="button"], input[type="reset"], input[type="submit"] {
        cursor: pointer;
    }
    button[disabled], html input[disabled] {
        cursor: default;
    }
    button::-moz-focus-inner, input::-moz-focus-inner {
        border: 0 none;
        padding: 0;
    }
    input {
        line-height: normal;
    }
    input[type="checkbox"], input[type="radio"] {
        box-sizing: border-box;
        padding: 0;
    }
    legend {
        border: 0 none;
        padding: 0;
    }
    textarea {
        overflow: auto;
    }
    optgroup {
        font-weight: 700;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    td, th {
        padding: 0;
    }
</style>
<style>
.small-thumbnail {
    width: 110px;
    height: 110px;
}
.btn {
    padding: 10px;
}
a {
    text-decoration: none;
}
.btn-success {
    color:#fff;
    background-color:#5cb85c;
    border-color:#4cae4c
}
.btn-success:hover,.btn-success:focus,.btn-success:active,.btn-success.active,.open>.dropdown-toggle.btn-success{
    color:#fff;
    background-color:#449d44;
    border-color:#398439
}
.btn-success:active,.btn-success.active,.open>.dropdown-toggle.btn-success{
    background-image:none
}
.btn-success.disabled,.btn-success[disabled],fieldset[disabled] .btn-success,.btn-success.disabled:hover,.btn-success[disabled]:hover,fieldset[disabled] .btn-success:hover,.btn-success.disabled:focus,.btn-success[disabled]:focus,fieldset[disabled] .btn-success:focus,.btn-success.disabled:active,.btn-success[disabled]:active,fieldset[disabled] .btn-success:active,.btn-success.disabled.active,.btn-success[disabled].active,fieldset[disabled] .btn-success.active{
    background-color:#5cb85c;
    border-color:#4cae4c
}
.btn-success .badge{
    color:#5cb85c;
    background-color:#fff
}
.btn{
    display:inline-block;
    padding:6px 12px;
    margin-bottom:0;
    font-size:14px;
    font-weight:400;
    line-height:1.42857143;
    text-align:center;
    white-space:nowrap;
    vertical-align:middle;
    cursor:pointer;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
    background-image:none;
    border:1px solid transparent;
    border-radius:4px
}

.btn:focus,.btn:active:focus,.btn.active:focus{
    outline:thin dotted;
    outline:5px auto -webkit-focus-ring-color;
    outline-offset:-2px
}

.btn:hover,.btn:focus{
    color:#333;
    text-decoration:none
}

.btn:active,.btn.active{
    background-image:none;
    outline:0;
    -webkit-box-shadow:inset 0 3px 5px rgba(0,0,0,.125);
    box-shadow:inset 0 3px 5px rgba(0,0,0,.125)
}

.btn.disabled,.btn[disabled],fieldset[disabled] .btn{
    pointer-events:none;
    cursor:not-allowed;
    filter:alpha(opacity=65);
    -webkit-box-shadow:none;
    box-shadow:none;
    opacity:.65
}

.btn-default{
    color:#333;
    background-color:#fff;
    border-color:#ccc
}

.btn-default:hover,.btn-default:focus,.btn-default:active,.btn-default.active,.open>.dropdown-toggle.btn-default{
    color:#333;
    background-color:#e6e6e6;
    border-color:#adadad
}

.btn-default:active,.btn-default.active,.open>.dropdown-toggle.btn-default{
    background-image:none
}

.btn-default.disabled,.btn-default[disabled],fieldset[disabled] .btn-default,.btn-default.disabled:hover,.btn-default[disabled]:hover,fieldset[disabled] .btn-default:hover,.btn-default.disabled:focus,.btn-default[disabled]:focus,fieldset[disabled] .btn-default:focus,.btn-default.disabled:active,.btn-default[disabled]:active,fieldset[disabled] .btn-default:active,.btn-default.disabled.active,.btn-default[disabled].active,fieldset[disabled] .btn-default.active{
    background-color:#fff;
    border-color:#ccc
}

.btn-default .badge{
    color:#fff;
    background-color:#333
}
fieldset {
    border: 0 none;
    margin: 0;
    min-width: 0;
    padding: 0;
}
legend {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: -moz-use-text-color -moz-use-text-color #e5e5e5;
    border-image: none;
    border-style: none none solid;
    border-width: 0 0 1px;
    color: #333333;
    display: block;
    font-size: 21px;
    line-height: inherit;
    margin-bottom: 20px;
    padding: 0;
    width: 100%;
}
label {
    display: inline-block;
    font-weight: 700;
    margin-bottom: 5px;
    max-width: 100%;
}
input[type="search"] {
    box-sizing: border-box;
}
input[type="radio"], input[type="checkbox"] {
    line-height: normal;
    margin: 4px 0 0;
}
input[type="file"] {
    display: block;
}
input[type="range"] {
    display: block;
    width: 100%;
}
select[multiple], select[size] {
    height: auto;
}
input[type="file"]:focus, input[type="radio"]:focus, input[type="checkbox"]:focus {
    outline: thin dotted;
    outline-offset: -2px;
}
output {
    color: #555555;
    display: block;
    font-size: 14px;
    line-height: 1.42857;
    padding-top: 7px;
}
.form-control {
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #cccccc;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #555555;
    display: block;
    font-size: 14px;
    height: 34px;
    line-height: 1.42857;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
}
.form-control:focus {
    border-color: #66afe9;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6);
    outline: 0 none;
}
.form-control::-moz-placeholder {
    color: #777777;
    opacity: 1;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #eeeeee;
    cursor: not-allowed;
    opacity: 1;
}
textarea.form-control {
    height: auto;
}
input[type="search"] {
}
input[type="date"], input[type="time"], input[type="datetime-local"], input[type="month"] {
    line-height: 34px;
}
input.input-sm[type="date"], input.input-sm[type="time"], input.input-sm[type="datetime-local"], input.input-sm[type="month"] {
    line-height: 30px;
}
input.input-lg[type="date"], input.input-lg[type="time"], input.input-lg[type="datetime-local"], input.input-lg[type="month"] {
    line-height: 46px;
}
.form-group {
    margin-bottom: 15px;
}
.radio, .checkbox {
    display: block;
    margin-bottom: 10px;
    margin-top: 10px;
    min-height: 20px;
    position: relative;
}
.radio label, .checkbox label {
    cursor: pointer;
    font-weight: 400;
    margin-bottom: 0;
    padding-left: 20px;
}
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
    margin-left: -20px;
    position: absolute;
}
.radio + .radio, .checkbox + .checkbox {
    margin-top: -5px;
}
.radio-inline, .checkbox-inline {
    cursor: pointer;
    display: inline-block;
    font-weight: 400;
    margin-bottom: 0;
    padding-left: 20px;
    vertical-align: middle;
}
.radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline {
    margin-left: 10px;
    margin-top: 0;
}
input[type="radio"][disabled], input[type="checkbox"][disabled], input.disabled[type="radio"], input.disabled[type="checkbox"], fieldset[disabled] input[type="radio"], fieldset[disabled] input[type="checkbox"] {
    cursor: not-allowed;
}
.radio-inline.disabled, .checkbox-inline.disabled, fieldset[disabled] .radio-inline, fieldset[disabled] .checkbox-inline {
    cursor: not-allowed;
}
.radio.disabled label, .checkbox.disabled label, fieldset[disabled] .radio label, fieldset[disabled] .checkbox label {
    cursor: not-allowed;
}
.form-control-static {
    margin-bottom: 0;
    padding-bottom: 7px;
    padding-top: 7px;
}
.form-control-static.input-lg, .form-control-static.input-sm {
    padding-left: 0;
    padding-right: 0;
}
.input-sm, .form-horizontal .form-group-sm .form-control {
    border-radius: 3px;
    font-size: 12px;
    height: 30px;
    line-height: 1.5;
    padding: 5px 10px;
}
select.input-sm {
    height: 30px;
    line-height: 30px;
}
textarea.input-sm, select.input-sm[multiple] {
    height: auto;
}
.input-lg, .form-horizontal .form-group-lg .form-control {
    border-radius: 6px;
    font-size: 18px;
    height: 46px;
    line-height: 1.33;
    padding: 10px 16px;
}
select.input-lg {
    height: 46px;
    line-height: 46px;
}
textarea.input-lg, select.input-lg[multiple] {
    height: auto;
}
.has-feedback {
    position: relative;
}
.has-feedback .form-control {
    padding-right: 42.5px;
}
.form-control-feedback {
    display: block;
    height: 34px;
    line-height: 34px;
    position: absolute;
    right: 0;
    text-align: center;
    top: 25px;
    width: 34px;
    z-index: 2;
}
.input-lg + .form-control-feedback {
    height: 46px;
    line-height: 46px;
    width: 46px;
}
.input-sm + .form-control-feedback {
    height: 30px;
    line-height: 30px;
    width: 30px;
}
.has-success .help-block, .has-success .control-label, .has-success .radio, .has-success .checkbox, .has-success .radio-inline, .has-success .checkbox-inline {
    color: #3c763d;
}
.has-success .form-control {
    border-color: #3c763d;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.has-success .form-control:focus {
    border-color: #2b542c;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #67b168;
}
.has-success .input-group-addon {
    background-color: #dff0d8;
    border-color: #3c763d;
    color: #3c763d;
}
.has-success .form-control-feedback {
    color: #3c763d;
}
.has-warning .help-block, .has-warning .control-label, .has-warning .radio, .has-warning .checkbox, .has-warning .radio-inline, .has-warning .checkbox-inline {
    color: #8a6d3b;
}
.has-warning .form-control {
    border-color: #8a6d3b;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.has-warning .form-control:focus {
    border-color: #66512c;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #c0a16b;
}
.has-warning .input-group-addon {
    background-color: #fcf8e3;
    border-color: #8a6d3b;
    color: #8a6d3b;
}
.has-warning .form-control-feedback {
    color: #8a6d3b;
}
.has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline {
    color: #a94442;
}
.has-error .form-control {
    border-color: #a94442;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.has-error .form-control:focus {
    border-color: #843534;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 6px #ce8483;
}
.has-error .input-group-addon {
    background-color: #f2dede;
    border-color: #a94442;
    color: #a94442;
}
.has-error .form-control-feedback {
    color: #a94442;
}
.has-feedback label.sr-only ~ .form-control-feedback {
    top: 0;
}
.help-block {
    color: #737373;
    display: block;
    margin-bottom: 10px;
    margin-top: 5px;
}

</style>

<link rel="stylesheet" href="<?php echo base_url();?>public/home/css/alz_style.css" />
<?php
if (isset($user_saved_info) && $user_saved_info) {
    $user_id = ($user_saved_info['user_id']) ? $user_saved_info['user_id'] : '';
    $user_name = ($user_saved_info['user_name']) ? $user_saved_info['user_name'] : '';
    $user_email = ($user_saved_info['user_email']) ? $user_saved_info['user_email'] : '';
    $user_address = ($user_saved_info['user_address']) ? $user_saved_info['user_address'] : '';
    $user_phone = ($user_saved_info['user_phone']) ? $user_saved_info['user_phone'] : '';
    $user_gender = ($user_saved_info['user_gender']) ? $user_saved_info['user_gender'] : '';
    $user_full_name = ($user_saved_info['user_full_name']) ? $user_saved_info['user_full_name'] : '';
}
?>
<div class="wrap-info">
    <h3>Thông tin người dùng</h3>
    <div id="message_form" class="warning">
        <?php if (isset($error)) {
            echo '<p class="alert warning"><i>' . $error . '</i></p>';
        }    ?>
    </div>
    <form class="form" role="form" method="POST" action="<?php echo base_url();?>default/shopping_cart/checkout">
        <?php echo form_fieldset('Nhập thông tin'); ?>
        <?php if (isset($user_id)) echo form_hidden('user_id', $user_id); ?>
        <div class="ap_show"><p class="alert alert-info"><?php if(isset($user_full_name)) echo 'Người dùng <b>' . $user_full_name . '</b>'; ?></div>
        <label for="user_name">User name</label>
        <input type="text" name="user_name" class="form-control" placholder="User name" value="<?php if (isset($user_name) && $user_name ) echo $user_name;?>" /><br />

        <label for="user_email">Địa chỉ Email</label>
        <input type="text" name="user_email" class="form-control" placholder="User email" value="<?php if (isset($user_email) && $user_email) echo $user_email;?>" /><br />

        <label for="user_address">Địa chỉ cư trú</label>
        <input type="text" name="user_address" class="form-control" placholder="User Address" value="<?php if (isset($user_address) && $user_address ) echo $user_address;?>"/><br />

        <label for="user_phone">Số điện thoại</label>
        <input type="text" name="user_phone" class="form-control" placholder="User Phone" value="<?php if (isset($user_phone) && $user_phone) echo $user_phone;?>"/><br />
        <label for="user_gender">Giới tính</label>
        <div class="form-group">
            <input type="radio" name="user_gender" value="1" <?php if(isset($user_gender) && $user_gender == 1) echo "checked"; ?>/> Nam
            <input type="radio" name="user_gender" value="2" <?php if(isset($user_gender) && $user_gender == 2) echo "checked"; ?>/> Nữ
        </div>
        <input type="submit" class="btn btn-default" name="btnok" value="save" />
        </fieldset>
    </form>
</div>