<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo lang('faq_page'); ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							<li><a href="<?= DIR?>site/"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="#"><?php echo lang('faq_page'); ?></a></li>
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
					<div class="fq">
						<div class="col-md-9 col-sm-9 col-xs-12 ">
							<?php if($result_amount>0){?>
							<ul>
							<?php	
						foreach($results as $prod) {
						?>
								<li>
									<div class="title">
										<div class="tog"></div>
										<h5><?php echo ( $lang == 'arabic' )?$prod->title_ar: $prod->title_eng ; ?></h5>
									</div>
									<p><?php echo ( $lang == 'arabic' )?$prod->details_ar: $prod->details ; ?></p>
								</li>
								<?php }?>
							</ul>
							
						<div class="col-md-12" style="text-align:center">
						<?php foreach($links as $link){?><?php echo $link;?><?php } ?>


						</div>
					<?php } else {?>
						<h4><?= $no_data;?></h4>
					<?php } ?>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12 ">
							<a href="<?= DIR ?>site/pages/contact"><div class="support text-center">
								<img class="img-responsive center-block" src="<?= DIR ?>design/frontpage/img/support.png">
								<h5> <?php echo lang('faq_question'); ?></h5></a>
							</div>
						</div>
					</div>
				</div>
				
					
			</div>
		</div>
