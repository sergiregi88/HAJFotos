




			<div class="row" id="slider" >
				<div id="carousel-example-generic" class="carousel slide" >
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<?php
						for($i=0;$i<count($list);$i++){
						?>

						<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0)//echo 'active'; ?>"></li>


					<?php } ?>
					</ol>
		 			<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php if(count($list)){ ?>
						<?php
						for($i=0;$i<count($list);$i++){
						?>
						<div class="item <?php echo (($i==0) ?'active':'');?>"><img class="img" src="<?php echo $list[$i]->url; ?>"></div>

						<?php }
						 		}else{
							?>
							<div class="item active"><img src="no_images.jpeg" class="img-no" ></div>
					<?php } ?>
					</div>
					<!-- Controls -->
					<?php  if(count($list)>1){ ?>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
					<?php } ?>
				</div>
			</div>
				<div class="panel panel-inverse">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, dolor eaque vitae corporis exercitationem perferendis expedita suscipit harum quod ex. Cupiditate, voluptates iste ducimus voluptatibus maxime et nulla quas eum.
				</div>

