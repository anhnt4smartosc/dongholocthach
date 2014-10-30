<meta charset="utf-8" />
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

</style>

<meta charset="utf-8">
<script src="<?php echo base_url();?>public/admin/js/jquery-1.11.0.min.js" ></script>
<div id="message_form" class="warning">
    <?php if (isset($error)) {
        echo '<p class="alert warning"><i>' . $error . '</i></p>';
    }    ?>
</div>
<form method="post" action="<?php echo base_url();?>default/user/login<?php if($url_after) echo '/'. $url_after;?>" role="form">
    <fieldset>
        <legend>Login</legend>
        <div class="ap_show ">
            <label for="user_name">User name</label>
            <input type="text" class="form-control" name="user_name" placeholder="user name " id="userid_email_control"/>
        </div>
        <div class="ap_show">
            <span class="ap_show">
                <input type="radio" class="form-control" name="sign_in" value="register" id="register_radio" />
            </span>
            <span class="bold_show"><b>đăng kí</b><i>(thông tin sẽ được nhập sau)</i></span>
        </div
        <div class="ap_show">
            <span class="ap_show">
                <input type="radio" class="form-control" name="sign_in" value="pasword"checked="" id="password_radio" />
            </span>
            <span class="ap_show">
                <label for="password">Password </label>
            </span>
            <input type="password" class="form-control" name="password" placeholder="Your 's password" />
        </div>
        <input type="submit" name="btnok" value="Đăng nhập" class="btn btn-default" />
        <a href="<?php echo base_url();?>default/shopping_cart/checkout" class="btn btn-success" class="btn btn-successs" >Check out</a>
    </fieldset>
</form>
<script>
    $(document).ready(function(){
        $('div.ap_show  input#register_radio').change(function(e) {
            $("input[type=password]").prop("disabled",!$("input[type=password]").prop("disabled"));
        });
        $('#password_radio').change(function(e) {
            $("input[type=password]").prop("disabled",!$("input[type=password]").prop("disabled"));
        });
    });
    function user_exists(user_email, name_function, base_url) {
        $(document).ready(function() {
            $.ajax({
                'url' :  base_url+'/user/'+name_function+ '/' + user_email,
                'type' : 'POST',
                'data_type' : 'json',
                'data' : {
                    'user_id' : user_email
                },
                success : function(data){
                    alert(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    $('div.message').removeClass().addClass('error')
                        .text('tài khoản đã tồn tại.').show(500);
                    $("div.image_product_container:has(input:checked)").show(500);
                }
            });
        });
    }
</script>