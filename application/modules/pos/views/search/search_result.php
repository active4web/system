<?php
$url=base_url();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:$url"."pos/System_cp/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='orders';
$curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
$curt_id = $this->uri->segment(4);
$this->session->set_userdata(array('curt' => $curt));
$this->session->set_userdata(array('curt_id' => $curt_id));
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

<title>Casher</title>
<?php include ("design/inc/header.php");?>
<link rel="stylesheet" href="<?=$url;?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?=$url;?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<style>
.input-group-sm>.input-group-btn>select.btn, .input-group-sm>select.form-control, .input-group-sm>select.input-group-addon, select.input-sm {
width:100px;
}
.dataTables_wrapper .dataTables_length{margin-top:20px;}
div.dataTables_wrapper div.dataTables_filter{margin-top:20px;}
</style>
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
				<!-- BEGIN CONTENT BODY -->
				<div class="page-content">
					<!-- BEGIN PAGE BREADCRUMB -->
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<a href="<?=$url.'pos';?>"><?=lang('admin_panel');?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<span class="active">Casher Statistics</span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
								<div class="portlet-title">
								
				
				<div class="col-md-12">
<div class="btn-group"></div>

<div class="btn-group">
<form action="<?=$url;?>pos/search/clients_search" method="POST" id="form">
    <input type="hidden" name="id_admin" value="<?= $this->input->get("id");?>">
    <div class="btn-group">
        <lebal><?=lang("date_from");?></lebal>
<input name="start_time"   size="18"  type="date"  class="form_datetime form-control editable editable-click" >
    </div>
    
        <div class="btn-group">
        <lebal><?=lang("date_to");?></lebal>
<input name="end_time"  size="18" type="date"  class="form_datetime form-control editable editable-click" >
    </div>
     <div class="btn-group">
           <lebal><br></lebal>
<button id="sample_editable_1_2_new" class="btn sbold green" style="padding-left:30px;padding-right:30px">
    <?=lang("Search");?><i class="fa fa-search"></i>
</button>
 </div>
</form>
</div>
</div>

											</div>

									<table class="table table-striped table-bordered table-hover table-checkable order-column" style="margin-top:20px" id="sample_1_2">
										<thead>
											<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
                                        	<th>Order Code</th>
												<th>Total Price</th>
	                                             <th>Date</th>
	                                        <th>Details</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										<?php if(!empty($results)){?>
										<tbody>
                                        <?php
                                        $id_admin=$this->input->get("id");
										 $tt=$this->db->get_where('final_order',array('id_admin'=>$id_admin))->result();
										 if(count($tt)>0){
                                            foreach($results as $data) {
											

 ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="checkboxes" value="<?=$data->id;?>" name="check[]" />
														<span></span>
													</label>
												</td>
												<?php
												mb_internal_encoding("UTF-8");
												?>
								<td><a href="<?=base_url()?>pos/statistics/order_details?id=<?= $data->id;?>"><?= $data->date_code."".$data->order_code?></a></td>
												<td> <?= $data->total_price?> </td>
                                               <td> <?= $data->date?> </td>
                                               <td> Details</td>										
											</tr>
                                            <?php }?>
										<?php } ?>
										
									<?php }else{?>
									<tr>
									<td colspan="9">
									<center><span class="caption-subject font-red bold uppercase">لا يوجد محتوى </span></center>
									</td>
									</tr>
									
									<?php }?>
									</tbody>
									</table>
								</div>

								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                        <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        <ul class="nav nav-pills">
                                            <li>
                                            <a href="javascript:;"> <?=lang('total_records');?>
                                                <span class="badge badge-success pull-right"> <?php echo $result_amount; ?> </span>
                                            </a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <div style="text-align: right;" class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_2_paginate">
                                            <ul class="pagination" style="visibility: visible;">
                                                <?php echo $pagination; ?>
                                            </ul>
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
		</div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
		<?php if(isset($_SESSION['msg']) && $_SESSION['msg']!=''){?>
<script>
$(document).ready(function(e) {
 toastr.success("<?php echo $_SESSION['msg']?>");
});
</script>
<?php }?>






</body>
</html>
