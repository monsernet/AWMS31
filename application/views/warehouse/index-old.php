			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('warehouses'); ?></li>
					<li class="breadcrumb-item active"><?php echo $title; ?></li>
				</ol>	
			</div>
			<div class="main-container">
				<div class="row gutters ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<!--<div class="card">
							<div class="card-header">
								<div class="card-title"><?php echo $title; ?></div>
							</div>
						<div class="card-body">
							<!-- WIDGETS -->
							<div class="row">
								
								
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-success">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary">Bounce Rate</p>
												   <h4 class="my-1 text-success">34.6%</h4>
												   <p class="mb-0 font-13">-4.5% from last week</p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-bar-chart"></i>
											   </div>
										   </div>
									   </div>
									</div>								
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-warning">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('users'); ?></p>
												   <h4 class="my-1 text-warning"><?php echo $this->global_model->countItems('users', 'status', 'actif');?> </h4>
												   <p class="mb-0 font-13">+8.4% from last week</p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
											   </div>
										   </div>
										   
									   </div>
									</div>	
								</div> 
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-success">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('products'); ?></p>
												   <h4 class="my-1 text-success"><?php echo $this->global_model->countItems('products', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 font-13">-4.5% from last week</p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-barcode"></i>
											   </div>
										   </div>
									   </div>
									</div>								
								</div>
								
								
								
								
								

								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-product rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('products', 'warehouse_id', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('products'); ?> </p>
										</div>
										<div class="icon">
											<i class="fa fa-barcode" aria-hidden="true"></i>
										</div>
										<a href="<?php echo base_url();?>products" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-category rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('product_categories', 'warehouse_id', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('categories'); ?> </p>
										</div>
										<div class="icon">
											<i class="fa fa-sitemap" aria-hidden="true"></i>
										</div>
										<a href="<?php echo base_url();?>categories" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-order rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('orders', 'warehouse_id', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('orders'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-file-text"></i>
										</div>
										<a href="<?php echo base_url();?>orders" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-delivery rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('deliveries', 'warehouse_id', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('deliveries'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-truck"></i>
										</div>
										<a href="<?php echo base_url();?>deliveries" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-stock rounded">
										<div class="inner">
											<h3> <?php echo $this->product_model->totalItems($this->session->userdata('warehouseid'));?> <small> <?php echo $this->lang->line('units'); ?></small></h3> 
											<p> <?php echo $this->lang->line('stock'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-cubes"></i>
										</div>
										<a href="<?php echo base_url();?>products/stock" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-transfer rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('transfers', 'warehouse_id', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('transfers'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-exchange"></i>
										</div>
										<a href="<?php echo base_url();?>transfers" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-supplier rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('suppliers', 'status', 1);?> </h3>
											<p> <?php echo $this->lang->line('suppliers'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-address-book"></i>
										</div>
										<a href="<?php echo base_url();?>suppliers" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-customer rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('clients', 'status', 1);?> </h3>
											<p> <?php echo $this->lang->line('customers'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-address-card"></i>
										</div>
										<a href="<?php echo base_url();?>customers" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-reception rounded">
										<div class="inner">
											<h3> 213 </h3>
											<p> <?php echo $this->lang->line('receptions'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-arrow-circle-o-down"></i>
										</div>
										<a href="#" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-return rounded">
										<div class="inner">
											<h3> <?php echo $this->global_model->countItems('returns', 'to_warehouse', $this->session->userdata('warehouseid'));?> </h3>
											<p> <?php echo $this->lang->line('returns'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-registered"></i>
										</div>
										<a href="<?php echo base_url();?>returns" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
								<div class="col-lg-3 col-sm-6">
									<div class="card-box bg-widget-report rounded">
										<div class="inner">
											<h3> <br/> </h3>
											<p> <?php echo $this->lang->line('reports'); ?></p>
										</div>
										<div class="icon">
											<i class="fa fa-bar-chart-o"></i>
										</div>
										<a href="<?php echo base_url();?>reports" class="card-box-footer">
										<?php if($this->session->userdata('site_lang') == "arabic") { ?><i class="fa fa-arrow-circle-left"></i>
										<?php } else { ?><i class="fa fa-arrow-circle-right"></i><?php } ?>
										<?php echo $this->lang->line('view_more'); ?>  </a>
									</div>
								</div>
							</div>
							<!-- END WIDGETS -->
						<!--</div>-->
					</div>
				</div>
			</div>
		</div>