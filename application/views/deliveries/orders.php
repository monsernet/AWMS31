			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('customers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('orders'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>customers/orders/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_customer_order'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_customer_order'); ?></span>
										</a>
									</li>
									
									
									
									
								</ul>
								
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addOrderSuccess'); ?>
									<?php echo $this->session->flashdata('addOrderWarning'); ?>
										
									<table id="fixedHeader" class="table custom-table lpoTable txtTable ">
										<thead>
											<tr>
												<th></th>
												<th><?php echo $this->lang->line('date'); ?></th>
												<th><?php echo $this->lang->line('code'); ?></th>
												<th><?php echo $this->lang->line('customer'); ?></th>
												<th ><?php echo $this->lang->line('delivery_before'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('volume'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('weight'); ?></th>
												<th ><?php echo $this->lang->line('approved'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if(!empty($orders)) {
												foreach ($orders as $order) { 
												$ct++;
												//$warehouseName = $this->global_model->getItem('warehouses', 'id', $lpo->warehouse_id, 'warehouseName');
												$customerName = $this->global_model->getItem('clients', 'client_id', $order->client_id, 'full_name');
												$businessTitle = $this->global_model->getItem('clients', 'client_id', $order->client_id, 'business_title');
											?>
											<tr colspan="8"   data-id="<?php echo $order->order_id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#order'.$order->order_id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($order->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $order->order_code;?></td>
												<td><?php echo $customerName.' ('.$businessTitle.')';?></td>
												<td class="text-center">
												<!--CHECK IF ORDER IS APPROVED -> GET THE DELIVERY DATE -->
												<?php 
													if ($order->approved==1) {
														echo $this->global_model->setDateFormat($order->delivery_limit, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
													} else {
															echo 'NA';
													}
												?>
												</td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($this->delivery_model->orderVolume( $order->order_id)).' '.$this->lang->line('cubic_meter');?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($this->delivery_model->orderWeight( $order->order_id)).' '.$this->lang->line('kg');?></td>
												<td class="text-center">
												<!--CHECK IF CUSTOMER ORDER IS APPROVED -->
												<?php 
													if ($order->approved==1) {
														echo '<i class="fa fa-check-circle text-success"></i>';
													} else {
														/* IF AUTHORIZED TO APPROVE */
														echo '<form method="post" action="'.base_url('deliveries/delivery-note').'">';
														echo '<input type="hidden" name="orderId" value="'.$order->order_id.'" />';
														echo '<button class="btn btn-primary btn-sm"><span class="small">'.$this->lang->line("approve").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												
											</tr>
											<tr class="p">
												<td colspan="10" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'order'.$order->order_id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_received');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_approved');?></th>	
																	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->delivery_model->displayOrderDetails($order->order_id); ?>
															</tbody>
														</table>
													</div>
												</td>
											</tr>
												<?php } } ?>
										</tbody>
									</table>
									
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
	