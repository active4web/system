<!--end navbar-->
<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo lang('team_page'); ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							  <li><a href="<?= DIR?>site"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="#"><?php echo lang('team_page'); ?></a></li>
							</ol>	
						</div>
					</div>
				</div>		
				<div class="clearfix"></div>
				
	  
			
			</div>
		</div>
				
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="latest_product text-center">
					<?php if($result_amount>0){
						foreach($results as $prod) {
						?>
						<div class="col-md-3 col-sm-3 col-xs-6">
								<a href="<?= DIR ?>site/doctors/doctor_details/<?= $prod->id;?>">
									<div class="pro">
									<img class="img-responsive center-block" src="<?= DIR_DES_STYLE?>teamwork/<?= $prod->img;?>">
									<h5> <?php echo ( $lang == 'arabic' )?$prod->title_ar: $prod->title_eng ; ?></h5>
								</div></a>
							</div>
						<?php }?>
						<div class="col-md-12">
						<?php foreach($links as $link){?><?php echo $link;?><?php } ?>


						</div>
					<?php } else {?>
						<h4><?= $no_data;?></h4>
					<?php } ?>
					</div>
				</div>
				
					
			</div>
		</div>
