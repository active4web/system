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
$curt='teamwork';
}
foreach($data as $data)
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
                        <a href="<?=$url.'pos/teamwork/customers';?>"><?= lang("clients_category");?></a>
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
                                                    <i class="fa fa-gift"></i><?= lang("edit");?></div>
                                            </div>
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                <form action="<?=$url;?>pos/teamwork/update_action" class="form-horizontal form-bordered"  method="post" enctype="multipart/form-data">
                                                    <div class="form-body">
														<input type="hidden" name="id" value="<?=$data->id?>">
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("maincategory");?></span>
                                                                <input type="text" placeholder="<?= lang("maincategory");?>"  value="<?=$data->name?>" class="form-control" name="name">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                
                                                        <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("discountdep");?></span>
                                                                <input type="number" placeholder="<?= lang("discountdep");?>" value="<?=$data->discount?>"   class="form-control" name="discount">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

                                                     <div class="form-group">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block"><?= lang("limit");?></span>
                                                                <input type="text" placeholder="<?= lang("limit");?>"  value="<?=$data->limit_value?>"  class="form-control" name="limit">
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>

                                                        <div class="form-group">
                                                                <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
                                                                    <span class="help-block"><?= lang("target");?></span> 
<input type="number" placeholder="<?= lang("target");?>"  value="<?=$data->max_clients?>"  class="form-control" name="max_clients">
                                                                        <!--<span class="help-block"> This is inline help </span>-->
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>
                                                    
                                                                <div class="form-group">
                                                                <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
            <span class="help-block"> <?= lang("duration");?> </span> 
<input type="number" placeholder="<?= lang("duration");?>" value="<?=$data->period?>"   class="form-control" name="max_period">
                                                                        <!--<span class="help-block"> This is inline help </span>-->
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>


<div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                         <span class="help-block"><?= lang("discount_rate");?></span> 
<input type="number" placeholder="<?= lang("discount_rate");?>" value="<?=$data->discount_clients;?>"  class="form-control" name="max_discount">
</div><div class="col-md-2"></div></div>
<!--<div class="form-group">
<div class="col-md-2"></div>
<div class="col-md-8">
<span class="help-block">عدد الطلبات</span> 
<input type="number" placeholder="عدد الطلبات"  value="<?=$data->max_orders?>"  class="form-control" name="max_orders">
 <span class="help-block"> This is inline help </span>
  </div>
<div class="col-md-2"></div>
</div>-->

 <div class="form-group">
<div class="col-md-2"></div>
<div class="col-md-8">
<span class="help-block"><?=lang("wallet");?></span> 
<input type="number" placeholder="<?=lang("wallet");?>" value="<?=$data->total_money?>"    class="form-control" name="max_money">
                                                                        <!--<span class="help-block"> This is inline help </span>-->
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>

                                                           <div class="form-group">
                                                                <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
<span class="help-block"><?=lang("lowestprice");?></span> 
                                                                        <input type="number" placeholder="<?=lang("lowestprice");?>" value="<?=$data->min_price?>"  class="form-control" name="min_money">
                                                                        <!--<span class="help-block"> This is inline help </span>-->
                                                                    </div>
                                                                    <div class="col-md-2"></div>
                                                                </div>

                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green sendd">
                                                                <i class="fa fa-check"></i><?= lang("edit");?></button>
                                                                <button type="reset" class="btn default"><?= lang("delete");?></button>
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
        <input type="hidden" id="mobilef">
<?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>

phone
<?php }?>
<script>
$(document).ready(function(e) {
$("#phone").focusout(function(e) {
var mobile=$("#phone").val();
 


if(mobile!=""){
var data={mobile:mobile}
$.ajax({
url: '<?php echo base_url()?>pos/teamwork/check_mobile',
type: 'POST',
dataType: 'json',
data:data,
success: function( data ) {
if(data==1){
$("#mainmobdiv").css("display","block");
$("#mobilenotavalible").show();
$("#mobileavalible").hide();
$("#mobilef").val(1);
$("#phone").css("border","1px solid#F00");
$(".sendd").prop("type", "button");
}
else{
    $("#mainmobdiv").css("display","block");
$("#mobilenotavalible").hide();
$("#mobileavalible").show();
$("#mobilef").val(0);
$("#phone").css("border","0px solid#F00");
$(".sendd").prop("type", "submit");

}

}
});
}
});
});

</script>



</body></html>
