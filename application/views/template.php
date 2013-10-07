<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo (isset($title)? $title:"Titol")?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->




        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css"/>
        <!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/non-responsive.css"/>-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.10.2.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.js"></script>
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <?php
    if(is_array($styles))
    {
        for($i=0;$i<count($styles);$i++)
        {
            if($styles[$i]['noscript']==true)
            {?>
                <noscript>
                    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/<?php echo $styles[$i]['file']; ?>.css"/>
                </noscript>
            <?php
            }
            else
            {
                ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/<?php echo $styles[$i]['file']; ?>.css"/>
                <?php
            }
        }
    }
    ?>
    </head>
<body>


<div class="container">
    <header class="row">

    </header>
        <nav class="navbar navbar-inverse">


                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menu">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo base_url(); ?>" class="navbar-brand">Admin</a>
                    </div>
                    <div class="navbar-menu collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                        </ul>
                    </div>


        </nav>
        <div class="row">
        <?php if(isset($content))
        $this->load->view($content);
        else
            echo "";?>
    </div>
</div>

<?php

    if(is_array($scripts))
    {
        for($i=0;$i<count($scripts);$i++)
        {

            if($scripts[$i]['extern']=='1'){
                echo $scripts[$i]['file']."extern<br>";
            ?>
<script type="text/javascript"  src="<?php echo $scripts[$i]['file']; ?>.js">
                </script>
            <?php}
            if($scripts[$i]['extern']=='0')
                {
echo $scripts[$i]['file']."intern<br>";
                ?>
                <script type="text/javascript"  src="<?php echo base_url(); ?>public/js/<?php echo $scripts[$i]['file']; ?>.js">
                </script>

            <?php
            }
        }
    }
    ?>
</body>
</html>