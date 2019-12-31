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

<title>Billing Details</title>
<?php include ("design/inc/header.php");?>
<link rel="stylesheet" href="<?=$url;?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?=$url;?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<style>
.input-group-sm>.input-group-btn>select.btn, .input-group-sm>select.form-control, .input-group-sm>select.input-group-addon, select.input-sm {
width:100px;
}
.dataTables_paginate,.dataTables_info {display:none}
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    display: none;
}
.dataTables_wrapper .dataTables_length {
    float: left;
    display: none;
}
.input-group-sm>.input-group-btn>select.btn, .input-group-sm>select.form-control, .input-group-sm>select.input-group-addon, select.input-sm {
    width: 100px;
    display: none;
}
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
							<span class="active">Billing Details</span>
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
										<span class="caption-subject bold uppercase">Billing Details</span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
	
										</div>
									</div>
									
									<form action="<?=$url;?>admin/orders/add_order" method="POST" id="form">
									<input type="hidden" name="phone" id="myphone">
									<input type="hidden" name="clientcode" id="clientcode">

									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
								
										<thead>
										
										<tr>
									<th  colspan="2"><?= lang("Meals");?></th>
											<th><?= lang("price");?></th>
											<th><?= lang("qty");?> </th>
											<th><?= lang("discount");?> </th>
											<th><?=lang("total_price");?></th>
											</tr>
										</thead>
										<tfoot>
											<tr>
											    <th > </th>
												<th colspan="2"> </th>
												<th> </th>
												<th> </th>
												<th> </th>
											</tr>
										</tfoot>
										

<?php
$id_order=$this->input->get('id');
$tt=$this->db->get_where('order_data',array('order_id'=>$id_order))->result();
if(count($tt)>0){
foreach($tt as $data) {
$total_price=$data->total_price;
$qty=$data->qty;
$main_price=$data->main_price;
$id_meal=$data->id_meal;
$Product_discount=$data->Product_discount;
$meal_name=get_tab_row('product',array('id'=>$id_meal),'title');
?>

<tr class="odd gradeX">
<td colspan="2"><?= $meal_name;?></td>
<td> <?= $main_price?> </td>
<td> <?= $qty?> </td>
<td> <?= $Product_discount?> </td>
<td> <?= $total_price?> </td>
</tr>

<?php } }?>







									</table>
									</form>
								</div>

								<div class="row">


                                    

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
