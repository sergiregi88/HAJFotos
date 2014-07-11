			<header class="row">
				<div class="col-lg-2 col-lg-offset-3 col-md-offset-3 col-md-2  col-xs-offset-2 col-xs-2">
				<img class="logo" src="<?php echo base_url(); ?>public/logo.jpg" height="150" width="150"/>
				<div class="title_min"><h1 class="title_min_h1">Fotograf&iacute;a</h1></div>
				</div>
				<div class="col-lg-4 col-md-7 col-xs-7">
				<h1 class="col-lg-10"><div class="nom col-lg-offset-3 col-md-offset-2 col-lg-3 col-md-3  col-xs-offset-2 col-xs-3">Helena Alvarez Jim&eacute;nez</div>
					<div class="left col-md-9 col-xs-10 title_big" > Fotograf&iacute;a</div></h1>
				</div>
			</header>
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".menu-enlace">
							<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"></a>
				</div>


				<div class="collapse navbar-collapse menu-enlace">
					<ul class="nav navbar-nav navbar-center">
						<li class="<?php echo active_link("home"); ?>"><a href="<?php echo base_url();?>home">Inicio</a></li>
						<li class="echo active_link('albums');?>"><a href="<?php echo base_url();?>albums">&Aacute;lbumes</a></li>
						<li class="echo active_link('reports');?> dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" >Mis Trabajos<b class="caret"></b></a>
							<ul  class="dropdown-menu">
								<li><a href="<?php echo base_url();?>events">Eventos</a></li>
								<li><a href="<?php echo base_url();?>books">Books</a></li>
								<li><a href="<?php echo base_url();?>photos_art">Fotos artistícas</a></li>
								<li><a href="<?php echo base_url();?>letters">Cartas</a></li>
								<li><a href="<?php echo base_url();?>presentation">Presentaciones</a></li>
							</ul>
						</li>
						<li class="echo active_link('about');?>"><a href="<?php echo base_url();?>about">Sobre M&iacute;</a></li>
						<li class="echo active_link('contact');?>"><a href="<?php echo base_url();?>contact">Contacto</a></li>
						<li><a href="<?php echo base_url();?>admin/login">Administración</a></li>
					</ul>

				</div>
			</nav>