<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row-fluid">
	<div class="span12 box" style="padding:10px;">
		<div id="myCarousel" class="carousel slide">
			<div class="carousel-inner">
				<?php
				$n = 0;
				foreach($slideshow as $slide){
					$active = '';
					if($n==0) $active = 'active';
				?>
				<div class="row-fluid item <?php echo $active; ?>">
					<img src="<?php echo site_url().'/media/slideshow/'.$slide['media_realname']; ?>" style="height:350px; width:100%"/>
					<div class="carousel-caption">
						<h4><?php echo $slide['media_title']; ?></h4>
					</div>
				</div>
				<?php
					$n++;
				}
				?>
			</div>
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div>
	</div>
</div>
<div class="row-fluid" style="border-radius:3px; background-color:#fff; padding-top:10px">
	<div class="span8">
			<img src="<?php echo site_url(); ?>/media/mekanisme.jpg">
	</div>
	<div class="span4">
		<style>
			.kip-right-home{
				margin-bottom: 15px;
			}
			.kip-right-home h3{
				font-weight: normal;
			}
		</style>
		
		<div class="kip-right-home">
			<h3>PETA SITUS</h3>
		</div>
		
		<div class="kip-right-home">
			<?php
			//echo config_item('form_login');
			?>
		</div>
	</div>
</div>