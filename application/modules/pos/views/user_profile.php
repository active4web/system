<?php
//session_start();
ob_start();
if(!isset($_SESSION['id_admin'])||$_SESSION['id_admin']==""){ 
header("Location:$url"."pos/system_cp/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='setting';
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?= lang("Account details");?></title>
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
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
							<a href="<?=$url.'pos';?>"><?= lang("admin_panel");?></a>
							<i class="fa fa-circle"></i>
						</li>
                        <li>
                            <span><?=lang("myprofile");?></span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
							<span class="active"><?= lang("Settings");?></span>
						</li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->                                <!-- END PORTLET MAIN -->
                                <!-- PORTLET MAIN -->

                                <!-- END PORTLET MAIN -->
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase"><?= lang("Account details");?></span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab"><?= lang("Personal data");?></a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab"><?= lang("Changing Personal");?></a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab"><?= lang("Change Password");?></a>
                                                    </li>
                                                    <?php
                                                    if($this->session->userdata('type_admin')==0){
                                                    ?>
                                                    <li>
                                                        <a href="#tab_1_4" data-toggle="tab"><?= lang("pharmacy data");?></a>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>
                                            <?php
                $id_admin=$this->session->userdata('id_admin');
                //@$_SESSION['site_favicon']
                                            foreach($data_admin as $data_admin)
                                            ?>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form role="form" action="<?=$url;?>pos/system_cp/update_profile" method="post">
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("full_name");?></label>
                                                                <input type="text" placeholder="<?= lang("full_name");?>" value="<?php echo $data_admin->name;?>" class="form-control" name="name"> </div>
                                                                                                                      <div class="form-group">
                                                                <label class="control-label"><?= lang("phone");?></label>
                                                                <input type="text" placeholder="<?= lang("phone");?>" value="<?php echo $data_admin->phone;?>" name="phone" class="form-control"> </div>
                                           
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("email");?></label>
                                                                <input type="text" name="email" value="<?php echo $data_admin->email;?>" placeholder="<?= lang("email");?>" class="form-control"> </div>
                                                            <div class="margiv-top-10">
                                                            <input type="submit" value="<?= lang("save");?>" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    <div class="tab-pane" id="tab_1_2">
                                                        
                                                        <form action="<?=$url;?>pos/system_cp/profileimg" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?=$url;?>uploads/site_setting/<?php echo $data_admin->img;?>" alt=""> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"><?= lang("profile_image");?></span>
                                                                            <span class="fileinput-exists"><?= lang("change");?> </span>
                                                                            <input type="file" name="file"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> <?= lang("delete");?> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="submit" value="<?= lang("save");?>" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- END CHANGE AVATAR TAB -->
                                                    <!-- CHANGE PASSWORD TAB -->
                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="<?=$url;?>pos/system_cp/editpassword" id="form" method="post">
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("current_password");?></label>
                                                            <input type="password" name="oldpassword" id="newpass" class="form-control">
                                                            <div class="alert alert-danger" id="oldpa" style="display:none">
                                                            <?= lang("new_not_correct");?></div>
                                                            </div>
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("new_password");?></label>
                                                            <input type="password" name="newpassword" id="pass" class="form-control"> </div>
                                                            <div class="form-group">
                                                            <label class="control-label"><?= lang("Retype_password");?></label>
                                                            <input type="password" name="confirmpassword" id="retpass" class="form-control"> 
                                                            <div class="alert alert-danger" id="confirm" style="display:none">
                                                            <?= lang("password_match");?></div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                            <input type="button" value="<?= lang("save");?>" class="btn green" id="cvcx">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <?php
                                                    if($this->session->userdata('type_admin')==0){
                                                    ?>
                                                 <div class="tab-pane" id="tab_1_4">
                                                     <?php foreach($pharmacy_setting as $pharmacy_setting)?>
                                                        <form role="form" action="<?=$url;?>pos/system_cp/about_profile" method="post" enctype="multipart/form-data">
                                            <input type="hidden" value="<?php echo $pharmacy_setting->id;?>" class="form-control" name="id">                
                                                            <div class="form-group">
                                                                <label class="control-label"><?= lang("pharmacy_name");?></label>
                                                                <input type="text" placeholder="<?= lang("pharmacy_name");?>" value="<?php echo $pharmacy_setting->name;?>" class="form-control" name="name">
                                                                </div>
                                                                
                                                             <div class="form-group">
                                                                <label class="control-label"><?= lang("pharmacy_phone");?></label>
                                                                <input type="text" placeholder="<?= lang("pharmacy_phone");?>" value="<?php echo $pharmacy_setting->phone;?>" class="form-control" name="pharmacy_phone">
                                                                </div>
                                                                
                                                         <div class="form-group">
                                                                <label class="control-label"><?= lang("pharmacy_email");?></label>
                                                                <input type="text" placeholder="<?= lang("pharmacy_email");?>" value="<?php echo $pharmacy_setting->email;?>" class="form-control" name="pharmacy_email">
                                                                </div>
                                                                
                                                                
                                                                    <div class="form-group">
                                                                <label class="control-label"><?= lang("pharmacy_about");?></label>
                                                               <textarea  class="form-control" placeholder="<?= lang("pharmacy_about");?>" name="pharmacy_about"><?php echo $pharmacy_setting->about;?></textarea>
                                                                </div>
                                                                
                                                                      <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?=$url;?>uploads/site_setting/<?php echo $pharmacy_setting->logo;?>" alt=""> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px;height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"><?= lang("pharmacy_img");?></span>
                                                                            <span class="fileinput-exists"><?= lang("change");?> </span>
                                                                            <input type="file" name="pharmacy_img"> </span>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> <?= lang("delete");?> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                
                                                                <div class="margiv-top-10">
                                                            <input type="submit" value="<?= lang("save");?>" class="btn green">
                                                            </div>
                                                        </form>
                                                    </div>   
                                                    <?php }?>
                                                    
                                                    <!-- END CHANGE PASSWORD TAB -->
                                                    <!-- PRIVACY SETTINGS TAB -->
                                                    <!-- END PRIVACY SETTINGS TAB -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
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
        $('#retpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>pos/system_cp/check_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    //alert(data);
                    if(data==1){ $("#confirm").show();$('#cvcx').prop("type", "button");}
			        else {$("#confirm").hide();$('#cvcx').prop("type", "submit");}
		        }

            });
        });
    </script>


<script type="text/javascript">
        $('#newpass').focusout(function(e){
	        $(".n_error").hide();
		    e.preventDefault();
		    var data=$("#form").serialize();
		    //alert(data);
            $.ajax({
                url: '<?php echo base_url()?>pos/system_cp/old_password',
                type: 'POST',
                dataType: 'json',
                data:data,
                success: function( data ) {
			    //alert(data);
                    if(data==1){$("#oldpa").hide();$('#cvcx').prop("type", "submit");}
			        else {$("#oldpa").show();$('#cvcx').prop("type", "button");}
		        }

            });
        });
    </script>

</body></html>