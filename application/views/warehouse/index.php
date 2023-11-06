			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('warehouses'); ?></li>
					<li class="breadcrumb-item"><?php echo $title; ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('dashboard'); ?></li>
				</ol>	
			</div>
			<div class="main-container">
				<div class="row gutters ml-2">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<!--<div class="card">
							<div class="card-header">
								<div class="card-title"><?php echo $title; ?></div>
							</div>
						<div class="card-body">
							<!-- WIDGETS -->
							<div class="row">
								<?php
									$total_warehouse_area = $this->warehouse_model->warehouse_total_area($this->session->userdata('warehouseid'));
									$storage_area = $this->warehouse_model->storage_area($this->session->userdata('warehouseid'));
									$potential_storage_area = floatval($total_warehouse_area)> 0 ? (floatval($storage_area)*100 / floatval($total_warehouse_area)) : 0 ;
									$totalInventoryVolume = $this->product_model->totalInventoryVolume($this->session->userdata('warehouseid'));
									$space_utilzation = floatval($storage_area)> 0 ? (floatval($totalInventoryVolume)*100 / floatval($storage_area)) : 0 ;
								?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-warning">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('storage_area'); ?><hr></p>
												   <h4 class="my-1 text-widget-storage-area"><?php echo $this->global_model->setNumberFormatWithoutDecimals($storage_area).' '.$this->lang->line('cubic_meter');?> </h4>
												   <p class="mb-0 small"><?php echo number_format($potential_storage_area,2).$this->lang->line('of_warehouse_volume') ; ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-storage-area text-white ms-auto"><span class="icon-layers2"></span>
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
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('occupied_volume'); ?><hr></p>
												   <h4 class="my-1 text-widget-occupied-area"><?php echo number_format($totalInventoryVolume,2).' '.$this->lang->line('cubic_meter');?> </h4>
												   <p class="mb-0 small"><?php echo $this->global_model->setNumberFormat($space_utilzation).$this->lang->line('of_storage_volume')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-occupied-area text-white ms-auto"><span class="icon-minimize"></span>
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
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('aisles'); ?><hr></p>
												   <h4 class="my-1 text-widget-aisles"><?php echo intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));?> </h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('nb_of_aisles')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-aisles text-white ms-auto"><span class="icon-view_week"></span>
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
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('racking_lines'); ?><hr></p>
												   <h4 class="my-1 text-widget-lines"><?php echo intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')))*2;?> </h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('nb_of_lines')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-lines text-white ms-auto"><span class="icon-more-vertical"></span>
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
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('total_racks'); ?><hr></p>
												   <h4 class="my-1 text-widget-racks"><?php echo $this->global_model->setNumberFormatWithoutDecimals(intval($this->warehouse_model->nb_racks ($this->session->userdata('warehouseid'))));?> </h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('nb_of_racks')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-racks text-white ms-auto"><span class="icon-grid_on"></span>
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
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('total_shelves'); ?><hr></p>
												   <h4 class="my-1 text-widget-shelves"><?php echo $this->global_model->setNumberFormatWithoutDecimals(intval($this->warehouse_model->nb_shelves ($this->session->userdata('warehouseid'))));?> </h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('nb_of_shelves')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-shelves text-white ms-auto"><span class="icon-codepen"></span>
											   </div>
										   </div>
										   
									   </div>
									</div>	
								</div> 

								

								<?php $blocked_users = $this->global_model->countItems('users', 'status', 'inactive'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-warning">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('users'); ?><hr></p>
												   <h4 class="my-1 text-warning"><?php echo $this->global_model->countItems('users');?> </h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including').$blocked_users.$this->lang->line('blocked'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
											   </div>
										   </div>
										   
									   </div>
									</div>	
								</div> 
								<?php $inactive_products = $this->global_model->countItems('products', 'status', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-success">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('products'); ?><hr></p>
												   <h4 class="my-1 text-success"><?php echo $this->global_model->setNumberFormatWithoutDecimals($this->global_model->countItems('products', 'warehouse_id', $this->session->userdata('warehouseid')));?></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including').$inactive_products.$this->lang->line('blocked'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-barcode"></i>
											   </div>
										   </div>
									   </div>
									</div>								
								</div>
								<?php $inactive_categories = $this->global_model->countItems('product_categories', 'status', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-success">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('categories'); ?><hr></p>
												   <h4 class="my-1 text-info"><?php echo $this->global_model->countItems('product_categories', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including').$inactive_categories.$this->lang->line('blocked'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa fa-sitemap"></i>
											   </div>
										   </div>
									   </div>
									</div>								
								</div>
								
																
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('qty_stock'); ?><hr></p>
												   <h4 class="my-1 text-widget-stock"><?php echo $this->global_model->setNumberFormatWithoutDecimals($this->product_model->totalItems($this->session->userdata('warehouseid')));?> <small> <?php echo $this->lang->line('units'); ?></small></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including_reserved_qty'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-stock text-white ms-auto"><i class="fa fa-cubes"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								<?php 
								$total_stock = $this->product_model->totalItems($this->session->userdata('warehouseid'));
								$reserved_stock = $this->product_model->totalStockReserved($this->session->userdata('warehouseid'));
								$reserved_percentage = floatval($total_stock)> 0 ? (floatval($reserved_stock)*100 / floatval($total_stock)) : 0 ; 
								?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('reserved_stock'); ?><hr></p>
												   <h4 class="my-1 text-widget-reserved"><?php echo $this->global_model->setNumberFormatWithoutDecimals($this->product_model->totalStockReserved($this->session->userdata('warehouseid')));?> <small> <?php echo $this->lang->line('units'); ?></small></h4>
												   <p class="mb-0 small"><?php echo number_format($reserved_percentage,2).$this->lang->line('of_total_stock'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-reserved text-white ms-auto"><span class="icon-verified_user"></span>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								<?php $inactive_suppliers = $this->global_model->countItems('suppliers', 'status', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('suppliers'); ?><hr></p>
												   <h4 class="my-1 text-widget-supplier"><?php echo $this->global_model->countItems('suppliers');?></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including').$inactive_suppliers.$this->lang->line('blocked'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-supplier text-white ms-auto"><i class="fa fa-address-book"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('purchasing_orders'); ?><hr></p>
												   <h4 class="my-1 text-danger"><?php echo $this->global_model->countItems('orders', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('po_created'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fa fa-file-text"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								<?php $inactive_customers = $this->global_model->countItems('clients', 'status', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('customers'); ?><hr></p>
												   <h4 class="my-1 text-widget-customer"><?php echo $this->global_model->countItems('clients');?></h4>
												   <p class="mb-0 small"><?php echo $this->lang->line('including').$inactive_customers.$this->lang->line('blocked'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-customer text-white ms-auto"><i class="fa fa-address-card"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								<?php $inapproved_cust_orders = $this->global_model->countItems('clientorders', 'approved', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('customer_orders'); ?><hr></p>
												   <h4 class="my-1 text-widget-custorders"><?php echo $this->global_model->countItems('clientorders', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $inapproved_cust_orders.$this->lang->line('waiting_approval'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-custorders text-white ms-auto"><i class="fa fa-file-text"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								<?php $undelivered_deliveries = $this->global_model->countItems('deliveries', 'delivered', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('customer_deliveries'); ?><hr></p>
												   <h4 class="my-1 text-widget-delivery"><?php echo $this->global_model->countItems('deliveries', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $undelivered_deliveries.$this->lang->line('waiting_delivery'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-delivery text-white ms-auto"><span class="icon-truck"></span>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								<?php $undelivered_transfers = $this->global_model->countItems('transfers', 'loaded', '0'); ?>								
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('transfers'); ?><hr></p>
												   <h4 class="my-1 text-widget-transfer"><?php echo $this->global_model->countItems('transfers', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $undelivered_transfers.$this->lang->line('waiting_transfer'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-transfer text-white ms-auto"><span class="icon-swap_vert"></span>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
																																							
								<?php $unstored = $this->global_model->countItems('receivings', 'stored', '0'); ?>
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('goods_reception'); ?><hr></p>
												   <h4 class="my-1 text-widget-reception"><?php echo $this->global_model->countItems('receivings', 'warehouse_id', $this->session->userdata('warehouseid'));?></h4>
												   <p class="mb-0 small"><?php echo $unstored.$this->lang->line('waiting_storage'); ?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-reception text-white ms-auto"><i class="fa fa-arrow-circle-o-down"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								<?php 
								$allreturns = $this->global_model->countItems('returns'); 
								$transfer_returns = $this->global_model->countItemsMultiConditions('returns', ['to_warehouse' => $this->session->userdata('warehouseid'), 'transfer_id <>' => 0]);
								$delivery_returns = $this->global_model->countItemsMultiConditions('returns', ['to_warehouse' => $this->session->userdata('warehouseid'), 'delivery_id <>' => 0]);
								$tr_ret_percentage = floatval($allreturns)> 0 ? (floatval($transfer_returns)*100 / floatval($allreturns)) : 0 ; 
								$del_ret_percentage = floatval($allreturns)> 0 ? (floatval($delivery_returns)*100 / floatval($allreturns)) : 0 ; 
								?>
								
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('transfer_returns'); ?><hr></p>
												   <h4 class="my-1 text-widget-return"><?php echo $transfer_returns ;?></h4>
												   <p class="mb-0 small"><?php echo number_format($tr_ret_percentage,2).$this->lang->line('of_all_returns')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-return text-white ms-auto"><i class="fa fa-arrow-circle-left"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								<div class="col-lg-3 col-sm-6">
									<div class="card-dash radius-10 border-start border-0 border-3 border-danger">
									   <div class="card-body">
										   <div class="d-flex align-items-center">
											   <div>
												   <p class="mb-0 text-secondary"><?php echo $this->lang->line('delivery_returns'); ?><hr></p>
												   <h4 class="my-1 text-widget-delret"><?php echo $delivery_returns; ?></h4>
												   <p class="mb-0 small"><?php echo number_format($del_ret_percentage,2).$this->lang->line('of_all_returns')   ;?></p>
											   </div>
											   <div class="widgets-icons-2 rounded-circle bg-widget-delret text-white ms-auto"><i class="fa fa-arrow-circle-left"></i>
											   </div>
										   </div>
									   </div>
									</div>
								</div>
								
								
							</div>
							<!-- END WIDGETS -->
						<!--</div>-->
					</div>
				</div>
			</div>
		</div>