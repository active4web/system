<?php
$url=base_url();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."pos/System_cp/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='team_work';
}

foreach($data as $result){
$id = $result->id;
$title = $result->title;
$code = $result->code;
$phone = $result->specail_code;
$id_customer = $result->id_customer;
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8">
<title><?= lang("edit");?></title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <?php include ("design/inc/topbar.php");?>
		<script type="text/javascript" src="<?=$url?>design/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=$url?>design/ckfinder/ckfinder.js"></script>

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
							<a href="<?=$url.'pos';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
                        <a href="<?=$url.'pos/teamwork/teamwork';?>"><?= lang("customers");?></a>
                        <i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span class="active"><?= lang("edit");?></span>
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
                                                    <i class="fa fa-gift"></i> <?= lang("edit");?> </div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
    <form action="<?=$url;?>pos/teamwork/edit_action" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                               <input type="hidden" name="id" value="<?= $id?>">
											   
											        <div class="form-body">
													
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("name_customer");?></span>
                                                                <input type="text"  value="<?= $title?>" placeholder="<?= lang("name_customer");?>" class="form-control" name="title">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                      
                                                      
                                                          <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("code_customer");?></span>
                                                                <input type="text" placeholder="<?= lang("code_customer");?>" readonly value="<?= $code;?>" class="form-control" name="code" readonly>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														
														
														
														
														 <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("specail_code")?></span>
                                                                <input type="text" placeholder="<?= lang("phone")?>" class="form-control"  value="<?=$phone?>"  readonly name="specail_code">



 <!--  <i class="error_2" id="mobilenotavalible1"  style="display:none;float:right;margin-top:20px">
                                                        <span style="font-family: 'DroidKufiRegular', sans-serif !important;  vertical-align: super;"> رقم التليفون غير صحيح ,يجب اى يقل عن 11 رقم</span>
                                                         <a  href="#" data-toggle="tooltip" title="رقم التليفون غير متاح">
                                                        <i style="color:#ff4747;font-size:30px;" class="fa fa-exclamation-circle"></i>
                                                        </a></i>

                                 <i class="error_2" id="mobilenotavalible"  style="display:none;float:right;margin-top:20px">
                                                        <span style="font-family: 'DroidKufiRegular', sans-serif !important;  vertical-align: super;">رقم التليفون غير متاح</span>
                                                         <a  href="#" data-toggle="tooltip" title="رقم التليفون غير متاح">
                                                        <i style="color:#ff4747;font-size:30px;" class="fa fa-exclamation-circle"></i>
                                                        </a></i>
                                            <i class="success_1" id="mobileavalible" style="display:none;float:right;margin-top:20px">
                                            <span style=" font-family: 'DroidKufiRegular', sans-serif !important;    vertical-align: super;">رقم التليفون متاح</span>

                                            <a href="#" data-toggle="tooltip" title="التليفون  متاح">
                                            <i style="color:#3db63e;font-size:30px;" class="fa fa-check-circle"></i></a>
                                            </i>-->
                                               

															</div>
															<div class="col-md-2"></div>
                                                        </div>

                                                       
                                                        
                                                      <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
<span class="help-block"><?= lang("clients_category")?> (<?=get_tab_row("clients",array("view"=>'1'),'name');?>)</span>
  <select name="id_cat" class="form-control">
<option value=""><?= lang("maincategory")?></option>
                                                                      
                                                                  <?php 
                                                                  $data=get_alltab('clients',array('view'),'','id','desc');
                                                                  foreach($data as $data){
                                                                  ?>
                                                                  <option value="<?=$data->id?>"><?=$data->name?></option>
                                                                  <?php }?>
                                                                  </select>

                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

														
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">
                                                                <i class="fa fa-check"></i><?= lang("edit")?> </button>
                                                                <button type="reset" class="btn default"><?= lang("delete")?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
<script type="text/javascript">
	//CKEDITOR.replace('description');
	var details = CKEDITOR.replace( 'details' );
	var details_ar = CKEDITOR.replace( 'details_ar' );
	CKFinder.setupCKEditor( details );
	CKFinder.setupCKEditor( details_ar );
</script>
</body></html>
