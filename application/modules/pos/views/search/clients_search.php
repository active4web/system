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
<title><?= lang("clients_search");?></title>
<?php include ("design/inc/header.php");?>
<link rel="stylesheet" href="<?=$url;?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?=$url;?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
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
							<span class="active"><?= lang("teamwork");?></span>
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
										<span class="caption-subject bold uppercase"> <?= lang("teamwork");?></span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="table-toolbar">
										<div class="row">
											<div class="col-md-12">
<form action="<?=$url;?>pos/search/clients_search" method="POST" id="form">
    <div class="btn-group">
        <lebal><?=lang("date_from");?> </lebal>
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
<br>
										</div>
									</div>
									
									<form action="<?=$url;?>pos/teamwork/delete_teamwork" method="POST" id="form">
									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1_2">
										<thead>
										<tr>
												<th>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input id="checkAll" type="checkbox" class="group-checkable" data-set="#sample_1_2 .checkboxes" />
														<span></span>
													</label>
												</th>
										<th> <?= lang("name_customer");?></th>
										<th><?= lang("special_code");?></th>
									 <th><?= lang("clients_category");?></th>
									 <th>Date</th>
									 <th>Limit</th>
									 <th><?= lang("limit");?></th>
									 <th><?= lang("Total_sales");?></th>


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
										<?php if(!empty($result)){?>
										<tbody>
                                        <?php
										
                            foreach($result as $data) {
                                
                          $id_client=get_tab_row("limit_payment",array('id'=>$data->id),'id_client');
												$view=get_tab_row("team_work",array('id'=>$id_client),'view');
												$user_title=get_tab_row("team_work",array('id'=>$id_client),'title');;
												$id_customer=get_tab_row("team_work",array('id'=>$id_client),'id_customer');;
												$creation_date=get_tab_row("team_work",array('id'=>$id_client),'creation_date');
												$specail_code=get_tab_row("team_work",array('id'=>$id_client),'specail_code');
												$limit_value=get_tab_row("team_work",array('id'=>$id_client),'limit_value');
												$count_clients=get_tab_row("team_work",array('id'=>$id_client),'count_clients');
												
												switch($view){
													case 0:
													  $view="<span class='label label-sm label-danger'>".lang('not_active')."</span>";
													  break;
													case 1:
													  $view="<span class='label label-sm label-success'>".lang('active')."</span>";
													  break;
													default:
													  break; 
												}
		$team_Work=get_tab_row("clients",array('id'=>$id_customer),'name');
                                        ?>
											<tr class="odd gradeX">
												<td>
													<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
														<input type="checkbox" class="checkboxes" value="<?=$data->id;?>" name="check[]" />
														<span></span>
													</label>
												</td>
												<?php
												
												?>
						<td><?=$user_title;?></td>
						<td><?=$specail_code;?></td>
						<td><?=$team_Work;?></td>
							<td><?=$data->date;;?></td>
							<td><?=$data->value_limit;;?></td>
							<td><?=$limit_value;;?></td>
						<td><a href="<?=base_url()?>pos/search/search_result?id=<?=$data->id?>"><?= $count_clients;?></a></td>
											
										
												
												
											</tr>
                                            <?php }?>

									<?php }else{?>
									<tr>
									<td colspan="11">
									<center><span class="caption-subject font-red bold uppercase"><?=lang('no_data');?> </span></center>
									</td>
									</tr>
									
									<?php }?>
									</tbody>
									</table>
									</form>
								</div>

								<div class="row">
                                    <div class="col-md-5 col-sm-5">
									<br>
                                       
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
	<script>
$(document).ready(function(e) {
    $(".addbutton").click(function(e) {
        window.location.assign("add_teamwork");
    });
});
</script>

<script>
$(document).ready(function(e) {
$(".edit").click(function(e) {
var id = $(this).data("id");
//alert(id);
var data={id:id};
			$.ajax({
				url: '<?php echo base_url("pos/teamwork/check_view_teamwork") ?>',
                type: 'POST',
                data: data,				
                success: function( data ) {
                	if (data == "1") {
					// alert(data);
                		$(".code_actvation-"+id).html("<span class='label label-sm label-success'><?=lang('active');?></span>");
                	}
                	if (data == "0") {
                		$(".code_actvation-"+id).html("<span class='label label-sm label-danger'><?=lang('not_active');?></span>");
                	}
				}
         });
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
	$(".cancel").click(function(){
		if($('input[type=checkbox]:not("#checkAll"):checked').length>0){
			$('#form').unbind('submit').submit();//renable submit
		}
	    else{
			toastr.warning("<?=lang('row_one_alert');?>");
	}
	});
});
</script>

</body>
</html>
