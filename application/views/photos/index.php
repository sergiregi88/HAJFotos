
<div >

		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/gallery/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/gallery/css/elastislide.css"/>


	<div id="rg-gallery" class="rg-gallery">
		<div class="rg-thumbs">
			 Elastislide Carousel Thumbnail Viewer --
			<div class="es-carousel-wrapper">
				<div class="es-nav">
					<span class="es-nav-prev">Previous</span>
					<span class="es-nav-next">Next</span>
				</div>
				<div class="es-carousel">
					<ul>
    <?php if(count($list_photos)>0){?>
		<?php  for($i=0;$i<count($list_photos);$i++){?>

			<li >

					<a href="#"><img alt="sss"  data-id-photo="<?php echo $list_photos[$i]->id; ?>" data-description="<?php echo $list_photos[$i]->title;?>" data-large="<?php echo $list_photos[$i]->url;?>"   src="<?php echo $list_photos[$i]->thumbnailUrl;?>"/></a>

			</li>
		<?php } }?>
					</ul>
				</div>
			</div>
			- End Elastislide Carousel Thumbnail Viewer -
		</div><!-- rg-thumbs -
	</div><!-- rg-gallery -
	<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<input type="text"/>
						<button id="ss">aaaa</button>
					</div>
				</div>
			</div>
	->
		</script>
<script type="text/javascript">

		var url2="<?php echo base_url(); ?>";
		var id_album=$("#id-album").html();
		alert(id_album);
	</script>
	<script type="text/javascript" src="<?php echo base_url() ?>public/gallery/js/jquery.tmpl.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>public/gallery/js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>public/gallery/js/jquery.elastislide.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>public/gallery/js/gallery.js"></script>
	-->

</div>

