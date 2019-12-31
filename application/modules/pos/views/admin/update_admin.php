<?php
$url=base_url();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='team_work';
}

$id=$_GET['id_type'];
$upadmin= $this->db->get_where('admin',array('id'=>$id))->result(); 
	foreach($upadmin as $upadmin){
    $mail=$upadmin->mail;
	$username=$upadmin->username;
	$fname=$upadmin->fname;
	$lname=$upadmin->lname;
	$img=$upadmin->img;
	$phone=$upadmin->phone;
	$id=$upadmin->id;
	}
	
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" >
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?=lang('edit');?></title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <?php include ("design/inc/sidebar.php");?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
			<div class="page-content" style="min-height: 1261px;">
                    <!-- BEGIN PAGE HEAD-->
                    
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
							<a href="<?=$url.'admin';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
                        <a href="<?=$url.'pos/System_cp/team_work';?>"><?=lang('admins');?></a>
                        <i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active"><?=lang('add');?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->

                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                       <!--Start from-->	
                                <div class="tab-content">					
                                    <div class="tab-pane active" id="tab_5">
                                        <div class="portlet box blue ">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i><?=lang('add_admins');?></div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?=$url;?>pos/System_cp/update_admin_action" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $id?>">
                                                    <div class="form-body">
														<div class="form-group">
														<div class="col-md-3" style="text-align:center"></div>
                                                            <div class="col-md-6" style="text-align:center">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
																			<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																				<img src="<?=$url;?>uploads/site_setting/<?=$img?>" alt="" /> </div>
																			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																			<div>
																				<span class="btn default btn-file">
																					<span class="fileinput-new"><?=lang('profile_image');?></span>
																					<span class="fileinput-exists"><?=lang('change');?></span>
																					<input type="file" name="file"> </span>
																				<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <?=lang('remove');?> </a>
																			</div>
																		</div>
															</div>
															<div class="col-md-3" style="text-align:center"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('email');?></span>
                                                                <input type="text" placeholder="<?=lang('email');?>" value="<?=$mail?>"  class="form-control" name="mail">
                                                                <span class="caption-subject font-red bold uppercase"><?php if(form_error('mail'))echo form_error('mail')?></span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('username');?></span>
                                                                <input type="text" placeholder="<?=lang('username');?>" value="<?=$username?>"   class="form-control" name="username">
                                                                <span class="caption-subject font-red bold uppercase"><?php if(form_error('username'))echo form_error('username')?></span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('first_name');?></span>
                                                                <input type="text" placeholder="<?=lang('first_name');?>"   value="<?=$fname?>"  class="form-control" name="fname">
                                                                <span class="caption-subject font-red bold uppercase"><?php if(form_error('fname'))echo form_error('fname')?></span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>


                                                     <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('second_name');?></span>
                                                                <input type="text" placeholder="<?=lang('second_name');?>" value="<?=$lname?>" class="form-control" name="lname">
                                                                <span class="caption-subject font-red bold uppercase"><?php if(form_error('lname'))echo form_error('lname')?></span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('phone');?></span>
                                                            <span class="caption-subject font-red bold uppercase"><input type="text" value="<?=$phone?>" placeholder="<?=lang('phone');?>" class="form-control" name="phone" >
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														<div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('password');?></span>
                                                                <input type="password" placeholder="<?=lang('password');?>" class="form-control" name="password">
                                                                <span class="caption-subject font-red bold uppercase"><?php if(form_error('password'))echo form_error('password')?></span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
														<input type="hidden" name="permission" value="0">
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?=lang('role');?></label>
                                                            <select class="form-control" name="permission">
                                                                <option value="">select user role</option>
                                                                <option value="0">Adminstrator</option>
                                                                <!--<option value="1">Admin</option>-->
                                                              <option value="2">Casher</option>
                                                            </select>
                                                               
															</div>
															<div class="col-md-2"></div>
                                                        </div>


                                                        
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                <i class="fa fa-check"></i><?=lang('edit');?></button>
                                                                <button type="reset" class="btn default"><?=lang('cancel');?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
                                       
									</div>	
<!---END FROM-->
												
                                            
                                      
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
            </div>
            </div>
            </div>
            </div>
            </div>
            </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body></html>
