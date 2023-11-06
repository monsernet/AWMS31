<!-- Sidebar wrapper start -->
			<nav id="sidebar" class="sidebar-wrapper <?php if((!$this->session->userdata('warehouseid')) OR ($this->session->userdata('oldemail')=='admin@mywarehouse.com')){ echo ' disable-sidebar';}?>" <?php if(!$this->session->userdata('warehouseid')){ echo ' title="Please choose a warehouse to enable the sidebar !!"';}?>>

				<!-- Sidebar brand start  -->
				<div class="sidebar-brand">
					<a href="index.html" class="logo mb-2">
						<img src="<?php echo base_url();?>assets/img/logo-dashboard.png" alt="MWH-WMS">
					</a>
					<a href="index.html" class="logo-sm mb-2">
						<img src="<?php echo base_url();?>assets/img/logo2.png" alt="MWH-WMS">
					</a>
				</div>
				<!-- Sidebar brand end  -->

				<!-- Sidebar content start -->
				<div class="sidebar-content <?php if((!$this->session->userdata('warehouseid')) OR ($this->session->userdata('oldemail')=='admin@mywarehouse.com')){ echo ' disabled-div';}?>">

					<!-- sidebar menu start -->
					<div class="sidebar-menu">
						<ul>
							<!-- GENERAL SECTION -->
							<li class="header-menu"><?php echo $this->lang->line('general'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='dash') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>warehouse" >
									<i class="icon-home2"></i>
									<span class="menu-text"><?php echo $this->lang->line('dashboard'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='genset') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>general_settings">
									<i class="icon-settings1"></i>
									<span class="menu-text"><?php echo $this->lang->line('general_settings'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='warh') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>home">
									<i class="icon-settings1"></i>
									<span class="menu-text"><?php echo $this->lang->line('switch_warehouse'); ?></span>
								</a>
							</li>
							<!-- USER MANAGEMENT SECTION -->
							<li class="header-menu"><?php echo $this->lang->line('user_management'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='allusers') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>users/list" >
									<i class="fa fa-users"></i>
									<span class="menu-text"><?php echo $this->lang->line('users'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='newuser') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>users/new" >
									<i class="fa fa-user-plus"></i>
									<span class="menu-text"><?php echo $this->lang->line('new_user'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='roles') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>warehouse" >
									<i class="fa fa-vcard-o"></i>
									<span class="menu-text"><?php echo $this->lang->line('user_roles'); ?></span>
								</a>
							</li>
							
							<!-- WAREHOUSE SECTION -->
							<li class="header-menu"><?php echo $this->lang->line('warehouse'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='warset') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>warehouse/settings">
									<i class="icon-settings1"></i>
									<span class="menu-text"><?php echo $this->lang->line('warehouse_settings'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='warman') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>storage/overview">
									<i class="icon-package"></i>
									<span class="menu-text"><?php echo $this->lang->line('storage_management'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='warlay') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>warehouse/layout">
									<i class="icon-grid_on"></i>
									<span class="menu-text"><?php echo $this->lang->line('warehouse_layout'); ?></span>
								</a>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('products'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='prod') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>products">
									<i class="icon-package"></i>
									<span class="menu-text"><?php echo $this->lang->line('products'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='cat') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>categories">
									<i class="icon-list2"></i>
									<span class="menu-text"><?php echo $this->lang->line('categories'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='prodim') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>products/dimensions">
									<i class="icon-border_all"></i>
									<span class="menu-text"><?php echo $this->lang->line('packaging_information'); ?></span>
								</a>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('stock_inventory'); ?></li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='stkctrl') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-grid"></i>
									<span class="menu-text"><?php echo $this->lang->line('stock_control'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='currstock') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>products/stock"><?php echo $this->lang->line('current_stock'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='stkmvt') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>stock/mvts"><?php echo $this->lang->line('stock_mvt'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='addstk') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>products/addstock"><?php echo $this->lang->line('add_stock'); ?></a>
										</li>
									</ul>
								</div>
							</li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='inv') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-server"></i>
									<span class="menu-text"><?php echo $this->lang->line('inventory_control'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='invctrl') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>stock/inventory"><?php echo $this->lang->line('inventory_control'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='eoq') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>inventory/economic-order-qty"><?php echo $this->lang->line('eoq'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='strpos') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>inventory/storage-positions"><?php echo $this->lang->line('storage_positions'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='phyinv') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>inventory/physical-inventory"><?php echo $this->lang->line('physical_inventory'); ?></a>
										</li>
										
									</ul>
								</div>
							</li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='trans') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-corner-up-right"></i>
									<span class="menu-text"><?php echo $this->lang->line('transfers'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newtrans') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>transfers/new"><?php echo $this->lang->line('new_transfer'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='rcv') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>transfers/received"><?php echo $this->lang->line('transfers_received'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='sent') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>transfers/issued"><?php echo $this->lang->line('transfers_issued'); ?></a>
										</li>
										
									</ul>
								</div>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('purchasing_management'); ?></li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='supp') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-users"></i>
									<span class="menu-text"><?php echo $this->lang->line('suppliers'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newsupp') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>suppliers/new"><?php echo $this->lang->line('new_supplier'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='allsupp') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>suppliers"><?php echo $this->lang->line('suppliers'); ?></a>
										</li>
									</ul>
								</div>
							</li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='prsh') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-credit-card"></i>
									<span class="menu-text"><?php echo $this->lang->line('purchasings'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newlpo') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>purchases/lpo/new"><?php echo $this->lang->line('newlpo'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='lpo') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>purchases/lpo"><?php echo $this->lang->line('lpo'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='po') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>purchases/po"><?php echo $this->lang->line('po'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='gdrcv') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>purchases/receivings"><?php echo $this->lang->line('receivings'); ?></a>
										</li>
										
									</ul>
								</div>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('delivery_management'); ?></li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='cust') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-people"></i>
									<span class="menu-text"><?php echo $this->lang->line('customers'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newcust') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>customers/new"><?php echo $this->lang->line('new_customer'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='allcust') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>customers"><?php echo $this->lang->line('customers'); ?></a>
										</li>
									</ul>
								</div>
							</li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='del') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-truck"></i>
									<span class="menu-text"><?php echo $this->lang->line('deliveries'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='custord') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>customers/orders"><?php echo $this->lang->line('customer_orders'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='custdel') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>customers/deliveries"><?php echo $this->lang->line('deliveries'); ?></a>
										</li>
									</ul>
								</div>
							</li>
							
							<li class="header-menu"><?php echo $this->lang->line('return_management'); ?></li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='trret') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-corner-up-left"></i>
									<span class="menu-text"><?php echo $this->lang->line('transfer_returns'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newtrret') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>transfers/returns/new"><?php echo $this->lang->line('new_transfer_return'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='alltrret') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>transfers/returns"><?php echo $this->lang->line('transfer_returns'); ?></a>
										</li>
									</ul>
								</div>
							</li>
							<li class="sidebar-dropdown <?php if(isset($activedrop) && $activedrop=='delret') { echo 'active';} ?>">
								<a href="#">
									<i class="icon-corner-up-left"></i>
									<span class="menu-text"><?php echo $this->lang->line('delivery_returns'); ?></span>
								</a>
								<div class="sidebar-submenu">
									<ul>
										<li <?php if(isset($activemenu) && $activemenu=='newdelret') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>deliveries/returns/new"><?php echo $this->lang->line('new_delivery_return'); ?></a>
										</li>
										<li <?php if(isset($activemenu) && $activemenu=='alldelret') { echo 'class="active-page-link"';} ?>>
											<a href="<?php echo base_url();?>deliveries/returns"><?php echo $this->lang->line('delivery_returns'); ?></a>
										</li>
										
										
									</ul>
								</div>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('barcoding'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='prodbar') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>products/barcoding">
									<i class="fa fa-barcode"></i>
									<span class="menu-text"><?php echo $this->lang->line('product_barcoding'); ?></span>
								</a>
							</li>
							<li <?php if(isset($activemenu) && $activemenu=='packbar') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>packages/barcoding">
									<i class="fa fa-barcode"></i>
									<span class="menu-text"><?php echo $this->lang->line('package_barcoding'); ?></span>
								</a>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('qrcodes'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='prodqr') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>products/qrcodes">
									<i class="fa fa-qrcode"></i>
									<span class="menu-text"><?php echo $this->lang->line('product_qrcodes'); ?></span>
								</a>
							</li>
							<li class="header-menu"><?php echo $this->lang->line('backups'); ?></li>
							<li <?php if(isset($activemenu) && $activemenu=='back') { echo 'class="active-page-link"';} ?>>
								<a href="<?php echo base_url();?>data/backup">
									<i class="fa fa-hdd-o"></i>
									<span class="menu-text"><?php echo $this->lang->line('backup'); ?></span>
								</a>
							</li>
							
						</ul>
					</div>
					<!-- sidebar menu end -->

				</div>
				<!-- Sidebar content end -->
			</nav>
			<!-- Sidebar wrapper end -->
