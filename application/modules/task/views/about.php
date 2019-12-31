	<!--end navbar-->
	<?php 
	foreach($site_info as $siteinfo)
	?>
	<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo lang('about_page'); ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							  <li><a href="<?= DIR?>site/"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="#"><?php echo lang('about_page'); ?></a></li>
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
					<div class="about-top">
						<div class="col-md-5 col-sm-5 col-xs-12">
							<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>site_setting/<?= $siteinfo->about_img?>">
						</div>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<h3 class="hed-border"><?php echo lang('about_title'); ?></h3>
							<p><?php echo ( $lang == 'arabic' )?$siteinfo->about_site_ar: $siteinfo->about_site ; ?></p>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="about-bottom">
						
						

						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#vision" aria-controls="vision" role="tab" data-toggle="tab"><?php echo lang('about_Vision'); ?></a></li>
							<li role="presentation"><a href="#message" aria-controls="message" role="tab" data-toggle="tab"><?php echo lang('about_message'); ?></a></li>
							<li role="presentation"><a href="#score" aria-controls="score" role="tab" data-toggle="tab"><?php echo lang('about_goal'); ?></a></li>
						  </ul>
						  <!-- Tab panes -->
						  <div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="vision">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>site_setting/<?= $siteinfo->vision_img?>">
								</div>	
								<div class="col-md-7 col-sm-7 col-xs-12">
									<p>
									<?php echo ( $lang == 'arabic' )?$siteinfo->vision_site_ar: $siteinfo->vision_site ; ?>
									</p>
								</div>
							
							</div>
							<div role="tabpanel" class="tab-pane" id="message">
							
								<div class="col-md-5 col-sm-5 col-xs-12">
									<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>site_setting/<?= $siteinfo->message_img?>">
								</div>		
								<div class="col-md-7 col-sm-7 col-xs-12">
									<p>
									<?php echo ( $lang == 'arabic' )?$siteinfo->message_site_ar: $siteinfo->message_site ; ?>

									</p>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="score">
								<div class="col-md-5 col-sm-5 col-xs-12">
									<img class="img-responsive center-block" src="<?= DIR_DES_STYLE ?>site_setting/<?= $siteinfo->goals_img?>">
								</div>
								<div class="col-md-7 col-sm-7 col-xs-12">
									<p><?php echo ( $lang == 'arabic' )?$siteinfo->goals_site_ar: $siteinfo->goals_site ; ?></p>
								</div>
							</div>
							

					</div>
				</div>
				
					
			</div>
		</div>
