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

<title><?=lang("orders")?></title>
<?php include ("design/inc/header.php");?>
<link rel="stylesheet" href="<?=$url;?>design/lightbox2-master/dist/css/lightbox.min.css" type="text/css" media="screen" />
<script src="<?=$url;?>design/lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
<style>
.input-group-sm>.input-group-btn>select.btn, .input-group-sm>select.form-control, .input-group-sm>select.input-group-addon, select.input-sm {
width:100px;
}
.dataTables_paginate,.dataTables_info {display:none}
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
							<span class="active"><?=lang("orders")?></span>
						</li>
					</ul>
					<!-- END PAGE BREADCRUMB -->

					<!-- Start Table Data -->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet light bordered">
							
								<div class="portlet-body">
									<div class="table-toolbar">
										

<form action="<?=$url;?>pos/orders/add_order" method="POST" id="form">
<div class="btn-group">
 <lebal><?=lang("client_name");?></lebal>
<input type="text" name="client_name" readonly   id="client_name" class="form-control"  placeholder="<?=lang("client_name");?>"/>
</div>
<div class="btn-group">
      <lebal><?=lang("code_customer");?></lebal>
<input type="text" name="code"  id="codename" class="form-control"  placeholder="<?=lang("code_customer");?>"/>
</div>
<div class="btn-group">
    <lebal><?=lang("special_code");?></lebal>
<input type="text" name="special_code"  id="special_code" class="form-control"  placeholder="<?=lang("special_code");?>"/>
</div>

<div class="btn-group Paying_installments" style="display:none">
    <lebal><?=lang("Paying_installments");?></lebal>
<input type="checkbox" name="Paying_installments"  id="Paying_installments" value="1" class="form-control"  style="height:20px;" />
<input type="hidden"   id="special_code_value"  />
</div>


									<input type="hidden" name="phone" id="myphone">
									<input type="hidden" name="clientcode" id="clientcode">
									
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
												<th><?=lang("price");?></th>
	                                             <th><?=lang("discount");?></th>
												 <th><?=lang("min_amount");?></th>
	                                        <th><?=lang("maincategory");?> </th>
												<th><?=lang("operation");?></th>
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
											</tr>
										</tfoot>
										<?php if(!empty($results)){?>
										<tbody>
                                        <?php
										 $tt=$this->db->get_where('product')->result();
										 if(count($tt)>0){
                                            foreach($results as $data) {
												$title=$data->title;
												$offers=$data->offers;
												 $price=$data->price;
												 $min_amount=$data->min_amount;
                                         $creation_date=$data->creation_date;
                                        $update_date=$data->update_date;
                                        $id_cat=$data->id_cat;
                                        $img=base_url()."uploads/meals/".$data->img;
        $name_cat=get_tab_row('category',array('id'=>$id_cat),'name');
												

												
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
								<td><?= mb_substr($title,0,30)."...";?></td>
												<td> <?= $price?> </td>
                                               <td> <?= $offers?> </td>
											   <td style="text">
											   <input style="width:60px;" class="form-control" type="text" name="value<?= $data->id?>" value="1"></td>
                                               <td> <?= $name_cat?> </td>
											
										
												
												<td>
													<div class="btn-group">
														<button class="btn btn-xs red dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> <?=lang('operations');?>
															<i class="fa fa-angle-down"></i>
														</button>
														<ul class="dropdown-menu pull-left" role="menu">
															<li><a title="view image" class="example-image-link" href="<?php echo $img;?>" data-lightbox="example-1">
											   <?=lang('view');?><i class="fa fa-photo"></i>  </a></li>
														</ul>
													</div>
												</td>
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
									

									</form>
									<button id="sample_editable_1_2_new" class="btn sbold green cancel">
    <?=lang("confirm_request");?>
<i class="fa fa-plus"></i>
</button>
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
	<script>
$(document).ready(function(e) {
    $(".addbutton").click(function(e) {
        window.location.assign("<?= base_url()?>pos/teamwork/add_teamwork");
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
				url: '<?php echo base_url("pos/foods/check_view_meal") ?>',
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
<script>
$(document).ready(function(e) {
$("#phonename").keyup(function(e) {
var phone=$(this).val();
$("#myphone").val(phone);
});

$("#codename").keyup(function(e) {
var code=$(this).val();
$("#clientcode").val(code);
});

});
</script>

<script>
$(document).ready(function(e) {
$("#codename").keyup(function(e) {
var username=$(this).val();
 $(".Paying_installments").hide();
 var data={phone:username};
 $.ajax({
url: '<?=base_url()?>pos/teamwork/search_username',
type: 'POST',
dataType: 'json',
data: data,				
success: function( data ) {
$("#client_name").val(data);
}
});
});
});
</script>


<script>
$(document).ready(function(e) {
$("#special_code").keyup(function(e) {
    
    
    
    $(".Paying_installments").show();
var username=$(this).val();
//alert(username);
 var data={phone:username};
 $.ajax({
url: '<?=base_url()?>pos/teamwork/special_code_username',
type: 'POST',
dataType: 'json',
data: data,				
success: function( data ) {
$("#client_name").val(data);
$("#special_code_value").val(username);
}
});
});
});
</script>


<script type="text/javascript">
    $(document).ready(function(){
        
        
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                
                var username=$(this).val();
var special_code_value=$("#special_code_value").val();
 var data={special_code_value:special_code_value};
  if(username==1){
 $.ajax({
url: '<?=base_url()?>pos/teamwork/changelimit_username',
type: 'POST',
dataType: 'json',
data: data,				
success: function( data ) {
if(data==2){
 alert("You have exceeded the allowed limit");
 $("#sample_editable_1_2_new").prop('type', "button");   
   $("#sample_editable_1_2_new").prop("disabled", "disabled");
}
}
});
}               
                
            }
            else if($(this).prop("checked") == false){
                alert("Checkbox is unchecked.");
                 $("#sample_editable_1_2_new").prop("disabled",false);
            }
        });
    });
</script>

</body>
</html>
