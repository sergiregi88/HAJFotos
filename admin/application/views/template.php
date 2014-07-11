<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administración - <?php echo (isset($title)? $title:"")?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->




        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css"/>
        <!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>public/css/non-responsive.css"/>-->
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/main.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.10.2.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.js"></script>
    <link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

    <script src="<?php echo base_url();?>public/js/noty/packaged/jquery.noty.packaged.js" type="text/javascript"></script>

    <?php
   /* if(is_array($styles))
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
    }*/
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
                        <a href="<?php echo base_url(); ?>home" class="navbar-brand">Administración</a>
                    </div>
                    <div class="navbar-menu collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <?php if($logged==true ){?>
                            <li <?php echo  $pg =='home' ? 'class="active"' : '' ?>><a  href="<?php echo base_url();?>home">Inicio</a></li>
                            <li <?php echo  $pg =='init' ? 'class="active"' : '' ?>><a  href="<?php echo base_url();?>init">Fotos de Inicio</a></li>
                            <li  <?php echo  $pg =='albums' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>albums">Álbumes</a></li>
                            <li <?php echo  $pg =='books' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>books">Libros</a></li>
                            <li <?php echo  $pg =='events' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>events">Eventos</a></li>
                            <li <?php echo  $pg =='letters' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>letters">Cartas</a></li>
                            <li <?php echo  $pg =='photos_art' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>photos_art">Fotos Artísticas</a></li>
                            <li <?php echo  $pg =='presentations' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>presentations">Presentaciones</a></li>
                            <li <?php echo  $pg =='logout' ? 'class="active"' : '' ?>><a href="<?php echo base_url();?>login/logout">Salir</a></li>
                            <?php } ?>
                        </ul>
                    </div>


        </nav>
        <div class="row">
        <?php if(isset($content))
        $this->load->view($content);
?>
    </div>
</div>

</body>
</html>

