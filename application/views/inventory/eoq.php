			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('inventory_control'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('economic_order_qty'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								
								<div class="table-responsive">
									
									<table id="fixedHeader" class="table custom-table eoqTable" width="100%">
										<thead>
											<tr>
												<th rowspan="2"><?php echo $this->lang->line('product'); ?></th>
												<th colspan="3" scope='colgroup' class="text-center"><?php echo $this->lang->line('monthly_eoq'); ?></th>
												<th colspan="3" scope='colgroup' class="text-center"><?php echo $this->lang->line('quarterly_eoq'); ?></th>
												<th colspan="3" scope='colgroup' class="text-center"><?php echo $this->lang->line('halfyearly_eoq'); ?></th>
												<th colspan="3" scope='colgroup' class="text-center"><?php echo $this->lang->line('annual_eoq'); ?></th>
											</tr>
											<tr>
												<th scope="col"><?php echo $this->lang->line('sales'); ?></th>
												<th scope="col"><?php echo $this->lang->line('eoq'); ?></th>
												<th scope="col"><?php echo $this->lang->line('st'); ?></th>
												<th scope="col"><?php echo $this->lang->line('sales'); ?></th>
												<th scope="col"><?php echo $this->lang->line('eoq'); ?></th>
												<th scope="col"><?php echo $this->lang->line('st'); ?></th>
												<th scope="col"><?php echo $this->lang->line('sales'); ?></th>
												<th scope="col"><?php echo $this->lang->line('eoq'); ?></th>
												<th scope="col"><?php echo $this->lang->line('st'); ?></th>
												<th scope="col"><?php echo $this->lang->line('sales'); ?></th>
												<th scope="col"><?php echo $this->lang->line('eoq'); ?></th>
												<th scope="col"><?php echo $this->lang->line('st'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
													$currentDate = date('m/d/Y');
													$monthBeginDate = date('m/d/Y', strtotime('-1 month'));
													$threeMonthBeginDate = date('m/d/Y', strtotime('-3 months'));
													$sixMonthBeginDate = date('m/d/Y', strtotime('-6 months'));
													$yearBeginDate = date('m/d/Y', strtotime('-1 year'));
													
												if($products) {
													foreach ($products as $product) { 
													$ct++;
													$minStock = floatval($this->global_model->getItem('products', 'warehouse_id',$this->session->userdata('warehouseid'),'min_stock'));
													$secStock = floatval($this->global_model->getItem('products', 'warehouse_id',$this->session->userdata('warehouseid'),'sec_stock'));
													$inventory = floatval($this->product_model->productInventory ($product->product_id, $this->session->userdata('warehouseid')));
													$alert = '';
													if($minStock >= $inventory) {
																$alert = '<a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="'. $this->lang->line('danger_eoq').'" data-content="'.$this->lang->line('danger_eoq_help').'" > <i class="fa fa-times-circle text-danger" title="'. $this->lang->line('click_to_see_msg').'" ></i></a>';
															} elseif( $secStock >= $inventory) {
																$alert = '<a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="'. $this->lang->line('warning_eoq').'" data-content="'.$this->lang->line('warning_eoq_help').'"> <i class="fa fa-exclamation-circle text-warning" title="'. $this->lang->line('click_to_see_msg').'" ></i></a>';
															} else {
																$alert = '<a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="'. $this->lang->line('ok_eoq').'" data-content="'.$this->lang->line('ok_eoq_help').'"> <i class="fa fa-check-circle text-success" title="'. $this->lang->line('click_to_see_msg').'" ></i></a>';
															}
												
											?>
											<tr>
												<td>
													<b class="mt-0 mb-1"><?php echo $product->product_name; ?></b>
													<p class="m-0 font-size-11"><i><?php echo $product->product_barcode; ?></i></p>
												</td>
												<td><?php echo $this->global_model->setNumberFormat(floatval($this->product_model->periodicSoldQty($product->product_id, $monthBeginDate, $currentDate))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td><?php echo $this->global_model->setNumberFormat(ceil(floatval($this->inventory_model->calculateEOQ($product->product_id, $monthBeginDate, $currentDate, 1)))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code'); ?></td>
												<td>
													<?php
														echo $alert;
													?>
												</td>
												<td><?php echo $this->global_model->setNumberFormat(floatval($this->product_model->periodicSoldQty($product->product_id, $threeMonthBeginDate, $currentDate))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td><?php echo $this->global_model->setNumberFormat(ceil(floatval($this->inventory_model->calculateEOQ($product->product_id, $threeMonthBeginDate, $currentDate, 3)))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code'); ?></td>
												<td>
													<?php
														echo $alert;
													?>
												</td>
												<td><?php echo $this->global_model->setNumberFormat(floatval($this->product_model->periodicSoldQty($product->product_id, $sixMonthBeginDate, $currentDate))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td><?php echo $this->global_model->setNumberFormat(ceil(floatval($this->inventory_model->calculateEOQ($product->product_id, $threeMonthBeginDate, $currentDate, 6)))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code'); ?></td>
												<td>
													<?php
														echo $alert;
													?>
												</td>
												<td><?php echo $this->global_model->setNumberFormat(floatval($this->product_model->periodicSoldQty($product->product_id, $yearBeginDate, $currentDate))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td><?php echo $this->global_model->setNumberFormat(ceil(floatval($this->inventory_model->calculateEOQ($product->product_id, $threeMonthBeginDate, $currentDate, 12)))).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code'); ?></td>
												<td>
													<?php
														echo $alert;
													?>
												</td>
											</tr>
											<?php }
												}
											?>
										</tbody>
									</table>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
	