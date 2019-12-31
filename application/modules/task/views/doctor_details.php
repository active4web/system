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
							  <li><a href="<?= DIR?>site/"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="<?= DIR?>site/doctors/team_work"><?php echo lang('team_page'); ?></a></li>
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
					<div class="doctor-de">
					<div class="col-md-5 col-sm-5 col-xs-12">
							<img class="img-responsive center-block" src="<?= DIR_DES_STYLE?>teamwork/<?= $product_details->img?>">
							<div class="sochal text-center">
								<a href="<?= $product_details->facebook?>" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>
								<a href="<?= $product_details->twitter?>" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>
								<a href="<?= $product_details->instagram?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>

							</div>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<p>
							<?php echo ( $lang == 'arabic' )?$product_details->details_ar: $product_details->details; ?>

							</p>
						</div>
</div>

					</div>
				</div>	
						
			</div>
		</div>
