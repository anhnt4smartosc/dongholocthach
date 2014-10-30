<html>
    <head>
        <title>WEB BÁN HÀNG</title>
        <link href="<?php echo base_url()?>/public/news/css/category.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/home/css/my-style.css" />
        <link rel="shortcut icon" href="<?php echo base_url()?>public/admin/images/wolf_icon.png" type="image/x-icon"/>
        <script src="<?php echo base_url()?>public/admin/js/jquery-1.11.0.min.js"></script>

        <script src="<?php echo base_url()?>/public/admin/category/jquery.js"></script>
        <script src="<?php echo base_url()?>/public/admin/category/jquery.nestable.js"></script>
        <!--<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>-->
        <script src="<?php echo base_url()?>public/admin/user/user.js"></script>
        <script src="<?php echo base_url()?>public/home/js/default.js"></script>
        <meta charset="UTF-8">
        <script>

            $(document).ready(function (){
                $(".leaf").hover(function (){
                    $(this).children(".sub-menu-1").slideToggle(300);
                    $(this).children(".sub-menu-2").fadeToggle(300);
                });
				
				$(".product a").mouseover(function (){
					$(this).children("img").css("box-shadow","0px 0px 10px 0px");
					
					$(this).mouseleave(function (){
						$(this).children("img").css("box-shadow","none");
					});
				});

                $('#checkbox').change(function(){
                    setInterval(function () {
                        moveLeft();
                    }, 3000);
                });

                var slideCount = $('#slider ul li').length;
                var slideWidth = $('#slider ul li').width();
                var slideHeight = $('#slider ul li').height();
                var sliderUlWidth = slideCount * slideWidth;

                $('#slider').css({ width: slideWidth, height: slideHeight });

                $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

                $('#slider ul li:last-child').prependTo('#slider ul');

                function moveLeft() {
                    $('#slider ul').animate({
                        left: + slideWidth
                    }, 500, function () {
                        $('#slider ul li:last-child').prependTo('#slider ul');
                        $('#slider ul').css('left', '');
                    });
                };

                function moveRight() {
                    $('#slider ul').animate({
                        left: - slideWidth
                    }, 500, function () {
                        $('#slider ul li:first-child').appendTo('#slider ul');
                        $('#slider ul').css('left', '');
                    });
                };

                $('a.control_prev').click(function () {
                    moveLeft();
                });

                $('a.control_next').click(function () {
                    moveRight();
                });


                setInterval(function () {
                    moveLeft();
                }, 3000);

                $('#slider').hover(function(){
                    clearInterval();
                });

            });
			
        </script>
    </head>
    <body>
        <div id="top">
            <?php $this->load->view("top");?>
        </div>
        <div id="main">
<!--            <div id="left">-->
<!--                --><?php //$this->load->view("left");?>
<!--            </div>-->
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

    	
		
        
    