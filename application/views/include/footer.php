<footer>
<?php
foreach($site_info as $site_info)
?>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12">
						<img class="img-responsive center-block" src="<?=base_url();?>design/frontpage/img/logo.png">
						<div class="sochal text-center">
							<a href="<?= $site_info->facebook;?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
							<a href="<?= $site_info->twitter;?>" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
							<a href="<?= $site_info->instagram;?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
						</div>
					</div>
					<div class="col-md-2 col-sm-6 col-xs-12">
						<h4><?= lang('important_link')?></h4>
						<li><a href="<?= base_url()?>site"><?php echo lang('home_page'); ?></a></li>
						<li><a href="<?= base_url()?>site/pages/about"><?php echo lang('about_page'); ?></a></li>
						<li><a href="<?= base_url()?>site/doctors/team_work"><?php echo lang('team_page'); ?></a></li>
					</div>
					<div class="col-md-2 col-sm-2 col-xs-12">
						<h4 class="hidden-title"><?= lang('important_link')?></h4>
						<li><a href="<?= base_url()?>site/product/products"><?php echo lang('product_page'); ?></a></li>
						<li><a href="<?= base_url()?>site/faq/help"><?php echo lang('faq_page'); ?></a></li>
						<li><a href="<?= base_url()?>site/pages/contact"><?php echo lang('contact_page'); ?></a></li>
						
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<h4><?php echo lang('contact_info'); ?></h4>
						<div class="cont">
							<li><a href="mailto:<?= $site_info->footer_email?>"><i class="fa fa-envelope fa-lg"></i><?= $site_info->footer_email;?></a></li>
							<li><a href="tel:<?= $site_info->footer_phone;?>" class="Blondie"><i class="fa fa-phone fa-lg"></i><?= $site_info->footer_phone;?></a></li> 
							<li><i class="fa fa-map-marker fa-lg"></i>
							<?php echo ( $lang == 'arabic' )?$site_info->address_ar: $site_info->address_eng ; ?>
							</li>  
						
						</div>
					</div>
				</div>
			</div>	
			<div class="coppy text-center">
				<h5><?php echo lang('copy_right'); ?><a href="https://wisyst.com/"  target="_blank">WISYST</a></h5>
			</div>	
		</footer>


		   <!-- Start Scroller -->
    
				<div id="elevator_item" style="display: block;"> 
					<a id="elevator" onclick="return false;" title="Back To Top"></a> 
				</div>
			
			<!-- End Scroller -->




		
			
			
		<script src="<?=base_url();?>design/frontpage/js/jquery.js"></script>
		<script src="<?=base_url();?>design/frontpage/js/owl.carousel.js"></script>
		<script src="<?=base_url();?>design/frontpage/js/bootstrap.min.js"></script>
		<script src="<?=base_url();?>design/frontpage/js/plug.js"></script>
		
	
	</body>
</html>
