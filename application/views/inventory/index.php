			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('inventory_control'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li class="m-2">
										<form method="post" action="<?php echo base_url('inventory/index');?>">
											<input type="hidden" name="lastMonth" value="1" />
											<button type="submit" > <span class="range-text m-2"> <i class="fa fa-calendar"></i> <?php echo $this->lang->line('last_month'); ?></span></button>
										</form>
									</li>
									<li class="m-2">
										<form method="post" action="<?php echo base_url('inventory/index');?>">
											<input type="hidden" name="lastThreeMonths" value="1"/>
											<button type="submit" > <span class="range-text m-2"> <i class="fa fa-calendar"></i> <?php echo $this->lang->line('last_3_months'); ?></span></button>
										</form>
									</li>
									<li class="m-2">
										<form method="post" action="<?php echo base_url('inventory/index');?>">
											<input type="hidden" name="lastSixMonths" value="1" />
											<button type="submit" > <span class="range-text m-2"> <i class="fa fa-calendar"></i> <?php echo $this->lang->line('last_6_months'); ?></span></button>
										</form>
									</li>
									<li class="m-2">
										<form method="post" action="<?php echo base_url('inventory/index');?>">
											<input type="hidden" name="lastYear" value="1" />
											<button type="submit" > <span class="range-text m-2"> <i class="fa fa-calendar"></i> <?php echo $this->lang->line('last_year'); ?></span></button>
										</form>
									</li>	
									
									
									
								</ul>
								<div class="table-responsive">
									
									<table id="fixedHeader" class="table custom-table inventoryTable txtTable">
										<thead>
											<tr>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('start'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('start_inventory'); ?>" data-content="<?php echo $this->lang->line('start_inventory_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></th>
												<th><?php echo $this->lang->line('end'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('end_inventory'); ?>" data-content="<?php echo $this->lang->line('end_inventory_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></th>
												<th class="text-center"><?php echo $this->lang->line('qty_sold'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('inventory_turnover1'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('inventory_turnover'); ?>" data-content="<?php echo $this->lang->line('inventory_turnover_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></th>
												<th class="text-center"><?php echo $this->lang->line('storage_period1'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('storage_period'); ?>" data-content="<?php echo $this->lang->line('storage_period_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></th>
												<th class="text-center"><?php echo $this->lang->line('eoq'); ?><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('economic_order_qty'); ?>" data-content="<?php echo $this->lang->line('eoq_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a></th>
												<th class="text-center"><?php echo $this->lang->line('notes'); ?></th>
												
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												$currentDate = date('m/d/Y');
												if(isset($_POST['lastMonth']) && ($_POST['lastMonth']==1)) {
													$endDate = date('m/d/Y', strtotime('-1 month'));
												} elseif(isset($_POST['lastThreeMonths']) && ($_POST['lastThreeMonths']==1)) {
													$endDate = date('m/d/Y', strtotime('-3 months'));
												} elseif(isset($_POST['lastSixMonths']) && ($_POST['lastSixMonths']==1)) {
													$endDate = date('m/d/Y', strtotime('-6 months'));
												} elseif(isset($_POST['lastYear']) && ($_POST['lastYear']==1)) {
													$endDate = date('m/d/Y', strtotime('-1 year'));
												} else {
													$endDate = date('m/d/Y', strtotime('-1 month'));
												}
												if($products) {
													foreach ($products as $product) { 
													$ct++;
											?>
													<tr>
														<td>
															<h6 class="mt-0 mb-1"><?php echo $product->product_name; ?></h6>
															<p class="m-0 font-size-14"><i><?php echo $product->product_barcode; ?></i></p>
														</td>
														<td><?php echo date('d-m-Y', strtotime($endDate)); ?></td>
														<td><?php echo date('d-m-Y', strtotime($currentDate)); ?></td>
														<td class="text-right"><?php echo $this->product_model->periodicSoldQty($product->product_id, $endDate, $currentDate).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code'); ?></td>
														<td><?php echo $this->product_model->productInventory ($product->product_id, $this->session->userdata('warehouseid')).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?> 
														<td class="text-center"><?php echo $this->product_model->inventoryTurnover($product->product_id, $endDate, $currentDate); ?></td>
														<td class="text-right"><?php echo $this->global_model->setNumberFormat(floatval($this->product_model->estimatesSellingPeriod($product->product_id, $endDate, $currentDate))).' '.$this->lang->line('days'); ?></td>
														<td></td>
														<td></td>
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
	