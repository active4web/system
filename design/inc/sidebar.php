        <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        
                        <?php
                        if($this->session->userdata("type_admin")==0){
                        ?>
                    <li class="nav-item start <?php if($curt=='home'){echo'active open';}?>">
                        <a href="<?=$url;?>pos/" class="nav-link ">
                            <i class="icon-home"></i>
                                        <span class="title"><?php echo lang('dashboard'); ?></span>
                                        <span class="selected"></span>
                                    </a>
                    </li>
                    
                    <li class="nav-item start <?php if($curt=='setting'){echo'active open';}?>">
                        <a href="<?=$url;?>pos/System_cp/setting" class="nav-link ">
                            <i class="icon-settings"></i>
                                        <span class="title"><?= lang("setting");?></span>
                                        <span class="selected"></span>
                        </a>
                    </li>
                      
                       <li class="nav-item start <?php if($curt=='team_work'){echo'active open';}?>">
                        <a href="<?=$url;?>pos/System_cp/team_work" class="nav-link ">
                            <i class="icon-users"></i>
                         <span class="title"><?= lang("admins");?></span>
                                        <span class="selected"></span>
                        </a>
                    </li>
                      

                    <li class="nav-item start <?php if($curt=='company'){echo'active open';}?>">
                        <a href="<?=$url;?>pos/company" class="nav-link ">
                            <i class="fa fa-home"></i>
                         <span class="title"><?= lang("company");?></span>
                                        <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start <?php if($curt=='category'){echo'active open';}?>" ">
				<a href="<?=base_url()?>pos/category/show" class="nav-link ">
								<span class="title"><?= lang("maincategory");?></span>
							</a>
						</li>

                        <li class="nav-item start <?php if($curt=='teamwork'){echo'active open';}?>">
<a href="<?=base_url()?>pos/teamwork/teamwork" class="nav-link ">
<i class="fa fa-users"></i>
<span class="title"><?= lang("teamwork");?></span>
</a>
</li>
                    
					<li class="nav-item start <?php if($curt=='meals'){echo'active open';}?>">
                        
						<a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-info"></i>
								<span class="title"><?= lang("menu");?></span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
						

							<li class="nav-item  ">
							
								<a href="<?=base_url()?>pos/Foods/" class="nav-link ">
									<span class="title"><?= lang("Meals");?></span>
								</a>
							</li>
                         
				
						
                            </ul>
                    </li>
					<?php }?>
					  <?php
                        if($this->session->userdata("type_admin")==0||$this->session->userdata("type_admin")==2){
                        ?>
					<li class="nav-item  <?php if($curt=='orders'){echo'active open';}?>">
                                    <a href="<?=base_url()?>pos/orders/" class="nav-link ">
                                        <i class="icon-basket"></i>
                                        <span class="title"><?= lang("orders");?></span>
                                    </a>
								</li>
								<?php } ?>
								<?php
                        if($this->session->userdata("type_admin")==0){
                        ?>
								<li class="nav-item  <?php if($curt=='update_contact'){echo'active open';}?>">
                                    <a href="<?=base_url()?>pos/search/billing" class="nav-link ">
                                        <i class="fa fa-money"></i>
                                        <span class="title"><?= lang("Billing");?></span>
                                    </a>
                                </li>
                               
								<li class="nav-item  <?php if($curt=='messages'){echo'active open';}?>">
                                    <a href="<?=base_url()?>pos/search/search" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title"><?= lang("teamwork");?> </span>
                                    </a>
								</li>
							
								
									<li class="nav-item  <?php if($curt=='messages'){echo'active open';}?>">
                                    <a href="<?=base_url()?>pos/search/inventory" class="nav-link ">
                                        <i class="icon-envelope"></i>
                                        <span class="title"><?= lang("inventory");?></span>
                                    </a>
								</li>
								<?php }?>
                            </ul>
                        </li>
                        
                            </ul>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
