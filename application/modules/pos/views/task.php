
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" >
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Task</title>
<?php include ("design/inc/header.php");?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<!-- BEGIN HEADER -->
        <!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
			<div class="page-content" style="min-height: 1261px;">
                
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
                                            
                                        <div class="portlet light bordered form-fit">
                                            <div class="portlet-title">
                                                <div class="caption"></div>
                                                <div class="actions"></div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="#" class="form-horizontal form-bordered" id="form" method="get" >
                                                    <div class="form-body">
														
                                                        <div class="form-group" style="direction:ltr">
														<div class="col-md-2"></div>
                                                            <div class="col-md-8">
                                                            <span class="help-block">Your string</span>
                                                                <input type="text" placeholder="Your string" class="form-control" name="str"  id="str">
                                                                <span class="caption-subject font-red" id="error"  style="display:none">Your string must no longer than 255 chars</span>
                                                                <!--<span class="help-block"> This is inline help </span>-->
															</div>
															<div class="col-md-2"></div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
														
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="button" class="btn green send_task">
                                                                <i class="fa fa-check"></i>Submit</button>
                                                                <button type="reset" class="btn default">Cancel</button>
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
        

        <?php include ("design/inc/footer_js.php");?>
        <?php 
if(isset($_SESSION['msg'])){
?>
<script>
$(document).ready(function(e) {
         toastr.error("Your string must no longer than 255 chars",{timeOut: 1000});
});
</script>
<?php }?>

<script>
$(document).ready(function(e) {
$(".send_task").click(function(){
 $(".send_task").attr("disabled", "disabled");
    var form=$("#form");
    var data=form.serialize();
    var str=$("#str").val();
   if(str.length>255){
        toastr.error("Your string must no longer than 255 chars",{timeOut: 1000});
        $(".send_task").attr("disabled",false);
   }
   else {
           location.assign("<?php echo base_url()?>pos/task/overview?str="+str);
        }     
     
});   
});
</script>

</body></html>
