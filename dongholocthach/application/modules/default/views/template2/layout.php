<html>
    <head>
    	<meta charset="UTF-8">
        <title><?php echo $page_title?></title>
        <link rel="stylesheet" href="<?php echo base_url()?>/public/home/css/jquery.countdown.css"/>
        <link rel="shortcut icon" href="<?php echo base_url()?>public/admin/images/wolf_icon.png" type="image/x-icon"/>
        <script src="<?php echo base_url()?>public/home/js/jquery-1.8.1.min.js"></script>
        <script src="<?php echo base_url()?>/public/home/js/jquery.nouislider.min.js"></script>
        <script src="<?php echo base_url()?>/public/home/js/jquery.lazyload.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>public/home/js/default.js"></script>
        <script src="<?php echo base_url()?>public/home/js/jquery.elevateZoom-3.0.8.min.js"></script>
        <script src="<?php echo base_url()?>public/home/js/jquery-ui.js"></script>
        <script src="http://www.dnasir.com/github/jquery-lazyimage/jquery.lazyimage.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>public/home/css/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/home/css/my-style-2.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/home/css/popup.css" />
		
        <script>
            $(document).ready(function (){
                $(function(){
                    $('#slides').slidesjs({
                        width: 940,
                        height: 300,
                        play: {
                            active: true,
                            pauseOnHover: true,
                            auto: true,
                            interval: 5000
                        }
                    });
                });

            });

        </script>
    </head>
    <body>
        <div id="header-bottom">
            <div id="site-name">
                <div class="wrap">
                    <a href="<?php echo base_url("default/home/index")?>" style="float: left">
                        <h1>
                            Đồng hồ lộc thạch - 229 Đội Cấn - Hà Nội
                        </h1>
                    </a>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
        <div class="wrap">
            <div id="top">
                <?php $this->load->view("top");?>
            </div>
            <div id="main">
                <div id="left">
                    <?php $this->load->view("left");?>
                </div>
                <div id="container">
                    <div class="content-header">
                        <h3><?php echo $page_title;?></h3>
                    </div>
                    <div id="content">
                        <?php $this->load->view($template);?>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            <div id="fixed-right">
                <?php $this->load->view("support_block")?>
            </div>
        </div>
        <div id="footer">
            <?php $this->load->view("footer");?>
        </div>
    </body>
</html>