<?php
//session_start();
ob_start();
$dd=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$dd"."admin/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];	
}
?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html class="sidebar sidebar-discover">
<!-- <![endif]-->

<head>
	<meta charset="utf-8">
	<?php include ("design/inc/head1.inc");?>
</head>

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">
	</div>
	<div id="content">
		<?php  include("design/inc/header.inc");?>
		<!-- END HEADER -->
		<!-- BEGIN HEADER & CONTENT DIVIDER -->
		<div class="clearfix"> </div>
		<!-- END HEADER & CONTENT DIVIDER -->
		<!-- BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<!-- BEGIN SIDEBAR -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<?php include ("design/inc/sidebar.inc");?>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$dd.'admin';?>">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span>Users</span>
							<i class="fa fa-circle"></i>
						</li>
						<?php if($_GET['t']==0){$cli="Owners";}else{$cli="Guests";}?>
						<li>
							<span class="active"><?=$cli?> List</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="icon-settings font-dark"></i>
										<span class="caption-subject bold uppercase"><?=$cli?> List</span>
									</div>
								</div>
								<span class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-6">
												<?php if($result_amount>0){?>
													<div class="btn-group">
														<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> Delete Group
															<i class="fa fa-remove"></i>
														</button>
													</div>
												<?php }?>
											</div>
											<div class="col-md-6">
												<div class="btn-group pull-right">
													<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
														<i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu pull-right">
														<li>
															<a href="javascript:;">
																<i class="fa fa-print"></i> Print </a>
														</li>
														<li>
															<a href="javascript:;">
																<i class="fa fa-file-pdf-o"></i> Save as PDF </a>
														</li>
														<li>
															<a href="javascript:;">
																<i class="fa fa-file-excel-o"></i> Export to Excel </a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<form action="<?php echo $dd?>admin/clients/delete?t=<?=$_GET['t']?>" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
												<th> Name </th>
												<th> Email </th>
												<th> Phone </th>
												<th> Gender </th>
												<th> Verified </th>
												<th> Active </th>
												<th> Actions </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<tbody>
                                        <?php
                                            foreach($results as $data) {
												$active=$data->active;
												switch($active){
													case 0:
													  $active="<span class='label label-sm label-danger'>Not Active</span>";
													  break;
													case 1:
													  $active="<span class='label label-sm label-success'>Active</span>";
													  break;
													default:
													  break; 
												}
												$gender=$data->gender;
												switch($gender){
													case 1:
													  $gender="Male";
													  break;
													case 2:
													  $gender="Female";
													  break;
													default:
													  break; 
												}
												$type=$data->type;
												switch($type){
													case 0:
													  $type="<span class='label label-primary'> Owner </span>";
													  break;
													case 1:
													  $type="<span class='label label-success'> Client </span>";
													  break;
													default:
													  break; 
												}
												$active_mail=$data->active_mail;
												$active_phone=$data->active_phone;
												$active_img=$data->active_img;
												if($active_mail==1 && $active_phone==1 && $active_img==1)
												$verified = "<span class='label label-primary'><i class='fa fa-check-circle'></i> Verified </span>";
												else
												$verified = "<span class='label label-danger'><i class='fa fa-remove'></i> Not Verified </span>";
												
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input name="check[]" type="checkbox" class="checkboxes" value="<?=$data->id_clients;?>" />
														<span></span>
													</label>
												</td>
												<td> <?=$data->fname;?> </td>
												<td> <?=$data->email;?> </td>
												<td> <?=$data->phone;?> </td>
												<td> <?=$gender;?> </td>
												<td> <?=$verified;?> </td>
												<td><span class="code_actvation-<?php echo $data->id_clients;?>"><?php echo $active;?></span>
												<a data-id="<?=$data->id_clients;?>" class="btn btn-xs purple edit" style="padding: 1px 0px;"><i class="fa fa-edit"></i></a>
												</td>
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<li><a href="<?php echo $dd?>admin/clients/view?id=<?=$data->id_clients;?>"><i class="fa fa-eye"></i> View </a></li>
															<li><a href="<?php echo $dd?>admin/clients/verify?id=<?=$data->id_clients;?>&t=<?=$_GET['t']?>"><i class="fa fa-check-circle"></i> Verify </a></li>
															<li><a data-toggle="modal" href="#draggable_<?=$data->id_clients;?>"><i class="fa fa-send"></i> Send Message </a></li>
														</ul>
													</div>
												</td>
											</tr>
											<div class="modal fade draggable-modal" id="draggable_<?=$data->id_clients;?>" tabindex="-1" role="basic" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
															<h4 class="modal-title">Send Your Replay To :: <?=$data->email;?></h4>
														</div>
														<form action="<?php echo $dd?>admin/clients/send_action" class="form-horizontal form-bordered" method="post">
														<div class="modal-body"> 
															<div class="form-body">
																<div class="form-group">
																	<div class="col-md-12">
																	<input name="subject" type="text" placeholder="Subject" class="form-control" required>
																	<span class="help-block"> Your Subject </span>
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-md-12">
																	<textarea name="message" type="text" placeholder="Message" class="form-control" rows="5" required></textarea>
																	<input type="hidden" name="name" value="<?=$data->fname;?> <?=$data->lname;?>">
																	<input type="hidden" name="email" value="<?=$data->email;?>">
																	<input type="hidden" name="t" value="<?=$_GET['t']?>">
																	<span class="help-block"> Your Message </span>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn green">Send</button>
																<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
															</div>
														</div>
														</form>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
                                            <?php }?>
										</tbody>
									</table>
									</form>
								
								<div class="row">
								<div class="col-md-12 col-sm-12">
									<?php if($result_amount>0){?>
										<div class="btn-group">
												<button id="sample_editable_1_2_new" class="btn sbold red delbutton"> Delete Group
													<i class="fa fa-remove"></i>
												</button>
										</div>
									<?php }?>
									</div>
								</div>
								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> Total Records :
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
											<?php foreach($links as $link){?><?php echo $link;?><?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								</div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END Table Data-->

				</div>
				<!-- END CONTENT -->
			</div>
			<!-- END CONTAINER -->
			<div id="footer" class="hidden-print">
				<?php include ("design/inc/footer.inc");	?>
			</div>
		</div>
		<?php include ("design/inc/headf1.inc");?>
<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
	$.ajax({
		url: '<?php echo base_url("admin/clients/active") ?>',
		type: 'POST',
		data: data,				
		success: function( data ) {
		if (data == "1") {
			// alert(data);
			$(".code_actvation-"+id).html("<span class='label label-sm label-success'>Active</span>");
		}
		if (data == "0") {
			$(".code_actvation-"+id).html("<span class='label label-sm label-danger'>Not Active</span>");
		}
		}
		});
	});
});
</script>
<script>
$(document).ready(function(e) {
	$(".delbutton").click(function(e) {
        window.location.assign("delete");
	});
});
</script>
<script>
$(document).ready(function(e) {
    $("#checkAll").change(function(){
		$("input[type=checkbox]").not("#checkAll").each(function() {
            this.checked=!this.checked;
        });
	});
	$(".delbutton").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
			$('#form').unbind('submit').submit();//renable submit
		}
	    else{
			window.stop();
		alert("Select at least one to delete");		
	}
	});
});
</script>
<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
	toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>
</body>
</html>