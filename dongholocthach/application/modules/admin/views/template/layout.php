<html>
    <head>
        <title>WEB BÁN HÀNG</title>
        <link href="<?php echo base_url()?>/public/news/css/category.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/news/css/new-style.css" />
        <link rel="shortcut icon" href="<?php echo base_url()?>public/news/images/mobile_icon.ico" type="image/x-icon"/>
        <script src="<?php echo base_url()?>public/admin/js/jquery-1.10.2.js"></script>
<!--        <script src="--><?php //echo base_url()?><!--public/admin/js/jquery-ui.js"></script>-->
        <script src="<?php echo base_url()?>/public/admin/category/jquery.js"></script>
        <script src="<?php echo base_url()?>/public/admin/category/jquery.nestable.js"></script>
        <!--<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
        <script src="<?php echo base_url()?>public/admin/user/user.js"></script>
<!--	<script src='//code.jquery.com/ui/1.11.0/jquery-ui.js'></script>-->
        <meta charset="UTF-8">
        <script>
            $(document).ready(function (){

                $(".collapse").click(function (){
                    $(this).parent().children("ul").toggle("1000");
                });



                $('#nestable').nestable({
                    maxDepth : 100
                });

                var updateOutput = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data('output');
                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                        var result = window.JSON.stringify(list.nestable('serialize'));//, null, 2));
                        console.log(result);
                        $('#saveCategory').click(function(){
                            $.ajax({
                                type:"POST",
                                url:'<?php echo base_url()?>admin/category/moveCategory',
                                data:'data='+window.JSON.stringify(list.nestable('serialize')),
                                success:function(result){
                                }
                            })

                        });
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                };

                // activate Nestable for list 1
                $('#nestable').nestable({
                    group: 1
                })
                    .on('change', updateOutput);

                // output initial serialised data
                updateOutput($('#nestable').data('output', $('#nestable-output')));




            });
        </script>
    </head>
    <body>
        <div id="top">
            <?php $this->load->view("top");?>
        </div>
        <div id="main">
            <div id="left">
                <?php $this->load->view("left");?>
            </div>
            <div id="container">
                <div id="content-header">
                    <h3><?php echo $page_title;?></h3>
                </div>
                <div id="content">
                    <?php $this->load->view($template);?>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div id="footer">
            <?php $this->load->view("footer");?>
        </div>
    </body>
</html>

    	
		
        
    