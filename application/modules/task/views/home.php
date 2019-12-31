
		
	<?php
	foreach($siteinfo as $siteinfo)
	foreach($home_page as $home_page)
	
	?>
				<div id="myslide" class="carousel slide" data-ride="carousel">
					
					<!-- Wrapper for slides -->
					
					<div class="carousel-inner">
					<?php
						$count=0;
						$main_count=count($main_slider);
						foreach($main_slider as $main_slider){

							$count++;
							if($count==$main_count){
								$class_slider="active";
							}
							else {
							$class_slider="next";
							}
							?>
						

						<div class="item <?= $class_slider?> left">
							<div class="carousel-caption fadeIn " >
	<h2 class="apparcase text-center-xs"><?php echo ( $lang == 'arabic' )?$main_slider->name_ar: $main_slider->name ; ?></h2>
								<p><?php echo ( $lang == 'arabic' )?$main_slider->details_ar: $main_slider->details ; ?></p>
								<?php #endregion
								if($main_slider->link!=""){
								?>
								<a class="more" href="<?= $main_slider->link?>"><?php echo lang('read_more'); ?></a>
								<?php 
								}
								?>
							</div>
						</div>
						<?php }?>
				
					</div>
						
					<!-- Controls -->
					 <a class="left carousel-control" href="#myslide" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					 </a>
					 <a class="right carousel-control" href="#myslide" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					 </a>
				</div>
					<!--end of carousel-->
			</div>
		</div>
				
		<div class="wrapper">
			<div class="dite">
				<div class="container">
						<div class="row"> 
							<div class="col-md-5 col-sm-5 col-xs-12">
								<img class="img-responsive center-block" src="<?=DIR_DES_STYLE ?>site_setting/<?= $home_page->breif_img;?>">
							</div>	
							<div class="col-md-7 col-sm-7 col-xs-12">
								<h3 class="hed-border"><?php echo lang('about_title'); ?></h3>
								<p>
								<?php echo ( $lang == 'arabic' )?$home_page->breif_txt_ar: $home_page->breif_txt_eng ; ?>
								</p>
								<a class="more light" href="<?= DIR?>site/pages/about"><?php echo lang('more'); ?></a>
							</div>
							
						</div>
				</div>			
			</div>
			<div class="centr-doctor"  style="background: url(<?=DIR_DES_STYLE ?>site_setting/<?= $home_page->team_background;?>)no-repeat center;
    background-size: 100% 100%;">
				<div class="overlay">
					<div class="container">
						<div class="row"> 
							<div class="col-md-8 col-sm-12 col-xs-12">
								<div class="doctor text-center">
									<h4><?php echo ( $lang == 'arabic' )?$home_page->team_title_ar: $home_page->team_title_eng ; ?></h4>
									<div id="owl-example" class="owl-carousel " style="direction:ltr">

									<?php
							foreach($team_work as $team_work){
							?>
										<div class="item ">
											<a href="<?= DIR ?>site/doctors/doctor_details/<?= $team_work->id?>">
											<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>teamwork/<?= $team_work->img?>">
											<h5><?php echo ( $lang == 'arabic' )?$team_work->title_ar: $team_work->title_eng ; ?></h5></a>
										</div>
							<?php }?>
									
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 col-xs-12 hidden-xs ">
								<div class="left-doctor" 
								style="background: url(<?= DIR_DES_STYLE ?>site_setting/<?= $home_page->team_img?>)no-repeat bottom;background-size: 100% 100%;">
								</div>
							</div>
						</div>
						
					</div>	
				</div>	
			</div>
			<div class="latest_product text-center">
				<div class="container">
					<h3 class="hed-border"><?php echo lang('home_product'); ?></h3>
						<div class="row"> 
							<?php
							foreach($home_products as $home_products){
							?>
							<div class="col-md-3 col-sm-3 col-xs-6">
								<a href="<?= DIR ?>site/product/products_details/<?= $home_products->id?>"><div class="pro">
									<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>products/<?= $home_products->img?>">
									<h5><?php echo ( $lang == 'arabic' )?$home_products->title_ar: $home_products->title_eng ; ?></h5>
								</div></a>
							</div>
							<?php } ?>
						
						</div>
					</div>
						
			</div>
		</div>
