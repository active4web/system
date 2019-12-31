	<!--end navbar-->
	<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo lang('contact_page'); ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							  <li><a href="<?= DIR?>site/"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="#"><?php echo lang('contact_page'); ?></a></li>
							</ol>	
						</div>
					</div>
				</div>		
				<div class="clearfix"></div>
				
	  
			
			</div>
		</div>
				<style>
				iframe{width:100%;height:350px}
				</style>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="contact">
						<div class="col-md-8 col-sm-8 col-xs-12">
							<h3 class="hed-border"><?php echo lang('sendmessage'); ?></h3>
							<?php
							if(isset($_SESSION['msg'])){
echo $_SESSION['msg'];

							}
							?>
							<form action="<?= DIR?>site/pages/contact_action" method="post">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text"  name="name" class="form-control input-lg" placeholder="<?php echo lang('name_contact'); ?>">
									  </div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								  <div class="form-group">
									<input type="email" name="email" class="form-control input-lg" placeholder="<?php echo lang('mail_contact'); ?>">
								  </div>
								  </div>
								
								  <div class="col-md-12">
								   <div class="form-group">
									<textarea class="form-control input-lg" name="message" placeholder="<?php echo lang('message_contact'); ?>"></textarea>
									</div>
								  </div>
								  <button type="submit" class="btn more pull-right"> <?php echo lang('send_contact'); ?></button>
								</form>
						</div>
						<?php
						foreach($contact_info as $contact_info)
						?>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="cont">
							<h3 class="hed-border"><?php echo lang('contact_info'); ?></h3>
							<li><i class="fa fa-envelope fa-lg"></i><span><?php echo $contact_info->email_sales?></span></li>
							<li><i class="fa fa-phone fa-lg"></i><span><?php echo $contact_info->phone_sales?></span></li> 
							<li><i class="fa fa-map-marker fa-lg"></i>
							<?php echo ( $lang == 'arabic' )?$contact_info->address_ar: $contact_info->address_eng ; ?>
						</li> 
						
						</div>
						</div>
					</div>
				
				</div>
				
					
			</div>
			<div class="map">
			<?php echo $contact_info->map?>
					</div>
		</div>
