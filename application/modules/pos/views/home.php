<?php
//session_start();
ob_start();
if(!isset($_SESSION['admin_name'])||$_SESSION['admin_name']==""){ 
header("Location:".base_url()."pos/System_cp/login"); 
}
else{
$id_admin=$_SESSION['id_admin'];
$admin_name=$_SESSION['admin_name'];
$last_login=$_SESSION['last_login'];
$curt='home';
$curt = $this->uri->segment(3);
$main_curt=$this->uri->segment(1);
$controller_curt=$this->uri->segment(2);
if($controller_curt==""){
  $controller_curt="System_cp";  
}
else {
 $controller_curt=$this->uri->segment(2);   
}
$curt_id = $this->uri->segment(4);
$this->session->set_userdata(array('curt' => $curt));
$this->session->set_userdata(array('curt_id' => $curt_id));
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

<title><?= lang("dashboard");?></title>
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
                <?php //include ("design/inc/sidebar.php");?>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?= lang("dashboard");?><small></small></h1>
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <!--<ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active">Dashboard</span>
                        </li>
                    </ul>-->
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>pos/category/">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                        <?php
                    $num_product=$this->db->get_where("category")->result();
                                        ?>
                                            <span data-counter="counterup" data-value="
                                            <?php echo count($num_product); ?>"></span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small><?= lang("maincategory");?></small>
                                    </div>
                                    <div class="icon">
                                 <i class="icon-notebook"></i>
                              </div>
                                </div>
</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
							<a href="<?= DIR?>pos/teamwork/customers">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                        <?php
                                        $num_product=$this->db->get_where("payment")->result();
                                        ?>
							<span data-counter="counterup" data-value="<?= count($num_product); ?>">
                            </span>
                                        </h3>
                                        <small><?= lang("customers");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-basket"></i>
                                    </div>
                                </div>
</a>
                            </div>
                        </div>

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat2 bordered">
                                <a href="<?= DIR?>pos/foods/Meals">
                                    <div class="display">
                                        <div class="number">
                                            <h3 class="font-blue-sharp">
                        <?php $num_meals=$this->db->get_where("pharmaceutical",array("id_pharmacy"=>$this->session->userdata('id_pharmacy')))->result();?>
                                                <span data-counter="counterup" data-value="<?= count($num_meals);?>"></span>
                                            </h3>
                                            <small><?= lang("orders");?></small>
                                        </div>
                                        <div class="icon">
                                            <i class="icon-pencil"></i>
                                        </div>
                                    </div>
                                   </a>
                                </div>
                            </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
								
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($total_visitor);?>"></span>
                                        </h3>
                                        <small><?= lang("orders");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
								
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($total_visitor);?>"></span>
                                        </h3>
                                        <small><?= lang("reports");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
								
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="<?=count($total_visitor);?>"></span>
                                        </h3>
                                        <small><?= lang("inventory");?></small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php include ("design/inc/footer.php");?>
        <!-- END FOOTER -->

        <?php include ("design/inc/footer_js.php");?>
    </body>
</html>
