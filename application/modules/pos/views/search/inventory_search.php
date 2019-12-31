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

<title><?=lang("inventory")?></title>
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
							<span class="active"><?=lang("inventory")?></span>
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
										<span class="caption-subject bold uppercase"><?=lang("inventory")?></span>
									</div>
				
				<div class="col-md-12">
<div class="btn-group"></div>
<div class="btn-group">

</div>
<div class="btn-group">
<form action="<?=$url;?>pos/search/inventory_search" method="POST" id="form">
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
                                        	<th><?=lang("name_meal");?></th>
                                        	<th><?=lang("date");?></th>
												<th><?=lang("price");?></th>
	                                             <th><?=lang("qty");?></th>
	                                        <th><?=lang("maincategory");?> </th>
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
											</tr>
										</tfoot>
										<?php if(!empty($results)){?>
										<tbody>
                                        <?php
										 $tt=$this->db->get_where('product')->result();
										 if(count($tt)>0){
                                            foreach($results as $data) {
												$id_meal=$data->id_meal;
												$total_price=$data->total_price;
                                                $qty=$data->qty;
                                                $date=$data->ids;
                                    
$name_meal=get_tab_row('product',array('id'=>$id_meal),'title');
$id_cat=get_tab_row('product',array('id'=>$id_meal),'id_cat');
$name_cat=get_tab_row('Food_categories',array('id'=>$id_cat),'name');
$name_cat=get_tab_row('Food_categories',array('id'=>$id_cat),'name');
	$final_qty = $this->db->query("select  sum(qty) as final_qty from order_data where id_meal=$id_meal  group by id_meal");
				if(count($final_qty->result())>0){
					foreach ($final_qty->result() as $final_qty){
					    $total_qty=$final_qty->final_qty;
					}
				}



	$final_price= $this->db->query("select  sum(total_price) as total_price from order_data where id_meal=$id_meal  group by id_meal");
				if(count($final_price->result())>0){
					foreach ($final_price->result() as $final_price){
					    $total_price=$final_price->total_price;
					}
				}

 ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="checkboxes" value="<?=$id_meal;?>" name="check[]" />
														<span></span>
													</label>
												</td>
												<?php
												mb_internal_encoding("UTF-8");
												?>
								<td><?= mb_substr($name_meal,0,50)."...";?></td>
								<td style="direction: ltr; text-align: center;"> <?= $date ?> </td>
												<td> <?= $total_price?> </td>
                                               <td> <?= $total_qty?> </td>
											 
                                               <td> <?= $name_cat?> </td>
											
										
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
