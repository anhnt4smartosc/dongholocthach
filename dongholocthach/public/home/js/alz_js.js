function get_var_function(base_url, controller , funct, vars)
    {
        $(document).ready(function(e) {
            
            $.ajax({
                'url' : base_url +"/"+ vars,
                'method' : 'post',
                'datatype': 'json',
                'data' : {
                    'var' : vars
                },
                success : function (data) {
                    $("a#cart span").html('(' + data + ')');
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('fail')
                }
            });        
        });
    }
function insert_cart(id, base_url)
    {

        get_var_function(base_url, 'shopping_cart' , 'insert' , id);
    }
function user_exists(useremai, name_function) {
        $(document).ready(function() {
           $.ajax({
                  'url' : '<?php echo base_url();?>admin/user/'+name_function+ '/' + useremai,
                  'type' : 'POST',
                  'data_type' : 'json',
                  'data' : {
                    'user_id' : useremai 
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
