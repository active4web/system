	<!--end navbar-->
	<?php 
	foreach($site_info as $siteinfo)
	foreach($product as $product_details)
	?>
<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo ( $lang == 'arabic' )?$product_details->title_ar: $product_details->title_eng ; ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							  <li><a href="<?= DIR?>site"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="<?= DIR?>site/product/products"><?php echo lang('product_page'); ?></a></li>
							</ol>	
						</div>
					</div>
				</div>		
				<div class="clearfix"></div>
				
	  
			
			</div>
		</div>
				
		<div class="wrapper">
			<div class="pro-details">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
						<!--start carousel-->
				  
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
							  <!-- Indicators -->
							  <ol class="carousel-indicators">
							  <?php 
							  $total_gallery=0;
							 $total_gallery=count($gallery_count); 
							  if($total_gallery>0){
								 $count=0;
								 foreach($gallery_count as $gallery_count){
									 
					 if($count==0){
						 $class_slider="active";
					 }
					 else {
					 $class_slider="";
					 }

					
								  ?>
								<li data-target="#carousel-example-generic" data-slide-to="<?= $count?>" class="<?= $class_slider?>"></li>
								
					<?php   $count++; } ?>
							  <?php }?>
							  </ol>

								<!-- Wrapper for slides -->
								<?php
								if(count($gallery)>0){
								?>
								<div class="carousel-inner" role="listbox">
									<?php
									
										$count=0;
										foreach($gallery as $gallery){
											$count++;
							if($count==1){
								$class_slider="active";
							}
							else {
							$class_slider="";
							}
									?>
									<div class="item <?= $class_slider?>">
						<img class="img-responsive center-block" src="<?= DIR_DES_STYLE?>gallery/products/<?= $gallery->image;?>">
									</div>
										<?php }?>
									
									
								</div>
								<?php } else {?>
									<div class="carousel-inner" role="listbox">
										
									<div class="item active">
						<img class="img-responsive center-block" src="<?= DIR_DES_STYLE?>products/<?= $product_details->img;?>">
									</div>
								</div>
								<?php }?>
									
								<!-- Controls -->
								<?php if($total_gallery>0){?>
								 <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								 </a>
								 <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								 </a>
								 <?php }?>
							</div>
						<!--end of carousel-->
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<p>
							<?php echo ( $lang == 'arabic' )?$product_details->details_ar: $product_details->details ; ?>

							</p>
						</div>
					</div>
				</div>	
						
			</div>
		</div>
