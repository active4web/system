<?php #endregion
foreach($home_page as $homepage)
?>
<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<div class="title">
								<h3><?php echo lang('bmi_title'); ?></h3>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<ol class="breadcrumb text-center">
							<li><a href="<?= DIR?>site/"><?php echo lang('home_page'); ?></a></li>
							  <li class="active"><a href="#"><?php echo lang('bmi_page'); ?></a></li>
							</ol>	
						</div>
					</div>
				</div>		
				<div class="clearfix"></div>
				
	  
			
			</div>
		</div>
				
		<div class="wrapper">
			<div class="container">
				<div class="row bmi">
					<p>
					<?php echo ( $lang == 'arabic' )?$homepage->bmi_site_ar: $homepage->bmi_site ; ?>
					</p>
					<?php
					$bmi_body=0;
					$bmi_length=0;
						$bmi_body=$this->input->post('bmi_body');
						$bmi_length=$this->input->post('bmi_length');
					
						if($bmi_body==0&&$bmi_length==0){?>
					
					<div class="col-md-12">
					<h3 class="hed-border"><?php echo lang('bmi_maintitle'); ?></h3>
					<form method="post" action="<?= DIR?>site/pages/bmi">
					<p><?php echo lang('bmi_message0'); ?></p>
					<div class="col-md-4 col-ms-4 clo-xs-12">
						<div class="form-group has-feedback">
						  <div class="input-group">
							
							<input type="text" class="form-control"  require name="bmi_body" id="bmi_body" aria-describedby="inputGroupSuccess4Status" placeholder="<?php echo lang('bmi_body'); ?> (<?php echo lang('bmi_example'); ?>,4)">
							<span class="input-group-addon"><?php echo lang('bmi_Kg'); ?></span>
						  </div>
						 
						</div>
					</div>
					<div class="col-md-4 col-ms-4 clo-xs-12">
						<div class="form-group has-feedback">
						  <div class="input-group">
							
							<input type="text" class="form-control" require  name="bmi_length" id="bmi_length" aria-describedby="inputGroupSuccess4Status" placeholder="<?php echo lang('bmi_length'); ?>(<?php echo lang('bmi_example'); ?> 1,70)">
							<span class="input-group-addon"><?php echo lang('bmi_m'); ?></span>
						  </div>
						 
						</div>
					</div>
					<div class="col-md-4 col-ms-4 clo-xs-12">
						<button class="more btn btn-lg"><?php echo lang('bmi_calculate'); ?></button>
					</div>	
					</form>
					<div class="clearfix"></div>
					</div>
						<?php } else {
							$main_v=$bmi_length*$bmi_length;
							$total=round($bmi_body/$main_v,2);
							$main_precent=$homepage->bmi_base*$main_v;
							$calculated_p=round($bmi_body-$main_precent,2);
							?>
					<div class="alert alert-success text-center" role="alert">
						<p><?php echo lang('bmi_result'); ?></p>
						<?php
						if ( $lang == 'arabic' ){
						?>
						<h4><?php if($calculated_p>0){ echo lang('bmi_corpulence');}else { echo  lang('bmi_normal_weight'); }?> 
						  <?= $total;?>  = BMI </h4>
						<?php } else {?>
						<h4><?= $total;?>  <?php if(($calculated_p>0)){ echo lang('bmi_corpulence');}else { echo  lang('bmi_normal_weight'); }?> = BMI</h4>
						<?php } if($calculated_p>0){?>

						<p> <?php echo lang('bmi_lose'); ?><?= $calculated_p;?>
						 <?php echo lang('bmi_normal'); ?> 
						(<?= $main_precent;?>)</p>
						<?php }?>
						
					</div>
					<div class="col-md-4 col-ms-4 clo-xs-12"><br><br></brr></div>
					<div class="col-md-4 col-ms-4 clo-xs-12">
						<a href="<?= DIR?>site/pages/bmi">
					<button class="more btn btn-lg"><?php echo lang('bmi_again_calculate'); ?></button>
				</a>
						</div>
						<div class="col-md-4 col-ms-4 clo-xs-12"><br><br></div>
						<?php }?>
						<div class="clearfix"></div>
				<div class="alert alert-danger text-center" role="alert"><?php echo lang('bmi_message'); ?></div>
</div>
			</div>		
		</div>

		