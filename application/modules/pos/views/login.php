<?php

ob_start();

$dd=base_url();
$curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_id = $this->uri->segment(4);
$this->session->set_userdata(array('curt' => $curt));
$this->session->set_userdata(array('curt_id' => $curt_id));
?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!-->

<html>

<!--<![endif]-->

<!-- BEGIN HEAD -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">



<title>تسجيل الدخول</title>

<?php include ("design/inc/header.php");?>

</head>

<body class=" login">

<?php if(!isset($_SESSION['admin_name'])){?>

	<!-- BEGIN LOGO -->

		<div class="logo">

			<a href="#">

				<img src="<?=DIR;?>uploads/site_setting/<?= get_tab_row("site_info",array("id"=>1),'logo')?>" alt="" /> </a>

		</div>

	<!-- END LOGO -->

	<div class="content">

			<!-- BEGIN LOGIN FORM -->

			

            <form class="login-form" action="<?php echo base_url()?>pos/System_cp/submit_login" method="post">

                   <h4 class="form-title font-green" style="text-align:center">

                      <!-- <a href="<?= DIR?>pos/<?= $controller_curt?>/lang_site/ar/" title="Arabic"><img src="<?=DIR?>uploads/site_setting/egypt.png" style="width:32px;height:32px;border-radius:50%;margin:10px"></a>

                       <a href="<?= DIR?>pos/<?= $controller_curt?>/lang_site/en/" title="English"><img src="<?=DIR?>uploads/site_setting/usa.jpg" style="width:32px;height:32px;border-radius:50%;margin:10px"></a>-->

                       </h4>

                <h4 class="form-title font-green" style="text-align:center"><?php echo lang('login'); ?></h4>

                

                <div class="alert alert-danger display-hide">

                    <button class="close" data-close="alert"></button>

                    <span><?php echo lang('plinsert'); ?></span>

                </div>

                <div class="form-group">
                    <div class="col-md-6">
                    <label class="control-label visible-ie8 visible-ie9"><?php echo lang('phone'); ?></label>
<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo lang('phone'); ?>" name="user_name" />
                    </div>

                    <div class="col-md-6">
                    <label class="control-label visible-ie8 visible-ie9"><?php echo lang('password'); ?></label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php echo lang('password'); ?> " name="password" />
                     
                    </div>

                 </div>

                <div class="form-actions form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn green uppercase"><?php echo lang('login'); ?></button>
                    </div>
                    <div class="col-md-6">
                    <a href="javascript:;" id="forget-password" class="forget-password"><?php echo lang('ForgetPassword'); ?></a>
                    </div>
                </div>

            </form>

            <!-- END LOGIN FORM -->

			

			<!-- BEGIN FORGOT PASSWORD FORM -->

            <form class="forget-form" action="<?php echo base_url();?>pos/System_cp/ForgotPassword" method="post" onsubmit ='return validate()'>

                <h3 class="font-green"><?php echo lang('ForgetPassword'); ?></h3>

                <p><?php echo lang('plemail'); ?> </p>

                <div class="form-group">

                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php echo lang('Email'); ?>" name="email" /> </div>

                <div class="form-actions">

                    <button type="button" id="back-btn" class="btn green btn-outline"><?php echo lang('Back'); ?></button>

                    <button type="submit" class="btn btn-success uppercase pull-right"><?php echo lang('Send'); ?></button>

                </div>

            </form>

            <!-- END FORGOT PASSWORD FORM -->

    </div>


        <!--[if lt IE 9]>

		<script src="<?=$url;?>design/assets/global/plugins/respond.min.js"></script>

		<script src="<?=$url;?>design/assets/global/plugins/excanvas.min.js"></script> 

		<script src="<?=$url;?>design/assets/global/plugins/ie8.fix.min.js"></script> 

		<![endif]-->

        <!-- BEGIN CORE PLUGINS -->

        <script src="<?=$url;?>design/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

		<script src="<?=$url;?>design/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

        <!-- END CORE PLUGINS -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->

        <script src="<?=$url;?>design/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

        <script src="<?=$url;?>design/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

		<script src="<?=$url;?>design/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <script src="<?=$url;?>design/assets/global/scripts/app.min.js" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <script src="<?=$url;?>design/assets/pages/scripts/login.min.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->

        <!-- END THEME LAYOUT SCRIPTS -->

        <script>

            $(document).ready(function()

            {

                $('#clickmewow').click(function()

                {

                    $('#radio1003').attr('checked', 'checked');

                });

            })

        </script>

<?php 

if(isset($_SESSION['msg'])){

?>

<script>

$(document).ready(function(e) {

 toastr.error("<?php echo $_SESSION['msg']?>", "Check Error");

});

</script>

<?php }?>

<?php }else{

redirect(base_url().'admin/','refresh');

}  

?>

</body>

</html>

