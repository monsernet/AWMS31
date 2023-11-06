			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('deliveries'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('delivery_notes'); ?></li>
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
									<?php echo $this->session->flashdata('addDeliverySuccess'); ?>
									<?php echo $this->session->flashdata('addDeliveryWarning'); ?>
									<?php echo $this->session->flashdata('addDeliveryError'); ?>
									<?php echo $this->session->flashdata('invWarning'); ?>
									<?php echo $this->session->flashdata('deliverynotexist'); ?>
									<?php echo $this->session->flashdata('addLoadingSuccess'); ?>
									<?php echo $this->session->flashdata('addDeliveryError'); ?>
									
									<table id="fixedHeader" class="table custom-table lpoTable txtTable ">
										<thead>
											<tr>
												<th></th>
												<th><?php echo $this->lang->line('date'); ?></th>
												<th><?php echo $this->lang->line('delivery_code'); ?></th>
												<th><?php echo $this->lang->line('customer_order'); ?></th>
												<th><?php echo $this->lang->line('customer'); ?></th>
												<th ><?php echo $this->lang->line('delivery_before'); ?></th>
												<th ><?php echo $this->lang->line('picked'); ?></th>
												<th ><?php echo $this->lang->line('packed'); ?></th>
												<th ><?php echo $this->lang->line('loaded'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if(!empty($deliveries)) {
												foreach ($deliveries as $delivery) { 
												$ct++;
												$warehouseName = $this->global_model->getItem('warehouses', 'id', $delivery->warehouse_id, 'warehouseName');
												$clientName = $this->global_model->getItem('clients', 'client_id', $delivery->client_id, 'full_name');
												$orderCode = $this->global_model->getItem('clientorders', 'order_id', $delivery->client_order, 'order_code');
												$hasDeliveryLimit = $this->global_model->getItem('clientorders', 'order_id', $delivery->client_order, 'limited_period');
											?>
											<tr colspan="8"   data-id="<?php echo $delivery->delivery_id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#dn'.$delivery->delivery_id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($delivery->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $delivery->delivery_code;?></td>
												<td><?php echo $orderCode;?></td>
												<td><?php echo $clientName;?></td>
												<?php 
													if($hasDeliveryLimit == 0) {
														$deliveryLimit = 'NA';
													} else {
														$deliveryLimit = $this->global_model->getItem('clientorders', 'order_id', $delivery->client_order, 'delivery_limit');
														$deliveryLimit = $this->global_model->setDateFormat($deliveryLimit, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
													}
												?>
												<td><?php echo $deliveryLimit;?></td>
												<td class="text-center">
												<!--CHECK IF DELIVERY IS PICKED -->
												<?php 
													if ($delivery->picked ==1) {
														echo '<span class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('picked').'</span>';
													} else {
														/* IF AUTHORIZED TO PICK */
														echo '<form method="post" action="'.base_url('deliveries/pick').'">';
														echo '<input type="hidden" name="pickDelivId" value="'.$delivery->delivery_id.'" />';
														echo '<button type="submit" class="btn btn-primary btn-sm"><span class="small"><i class="fa fa-th" aria-hidden="true"></i> '.$this->lang->line("pick").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												<td class="text-center">
												<!--CHECK IF DELIVERY IS PACKED -->
												<?php 
													if ($delivery->packed ==1) {
														echo '<i class="fa fa-check-circle text-success"></i> <a href="'.base_url().'customers/deliveries/packingslip/'.$delivery->delivery_id.'" target="_blank" class="text-info">'.$this->lang->line("packing_slip").'</a>';
													} else {
														/* IF AUTHORIZED TO PACK */
														echo '<form method="post" action="'.base_url('deliveries/pack').'">';
														echo '<input type="hidden" name="packDelivId" value="'.$delivery->delivery_id.'" />';
														echo '<button type="submit" class="btn btn-primary btn-sm"><span class="small"><i class="fa fa-archive" aria-hidden="true"></i>  '.$this->lang->line("pack").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												<td class="text-center">
												<!--CHECK IF DELIVERY IS LOADED -->
												<?php 
													if ($delivery->delivered ==1) {
														echo '<span class="text-success"><i class="fa fa-check-circle text-success"></i> '.$this->lang->line('loaded').'</span>';
													} else {
														/* IF AUTHORIZED TO LOAD */
														echo '<form method="post" action="'.base_url('deliveries/load').'">';
														echo '<input type="hidden" name="loadDelivId" value="'.$delivery->delivery_id.'" />';
														echo '<button type="submit" class="btn btn-primary btn-sm"><span class="small"><i class="fa fa-truck fa-flip-horizontal" aria-hidden="true"></i> '.$this->lang->line("load").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												
											</tr>
											<tr class="p">
												<td colspan="9" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'dn'.$delivery->delivery_id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>
																	<th class="text-primary  text-right"><?php echo $this->lang->line('cpo_qty');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('delivered_qty');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('volume');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('weight');?></th>	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->delivery_model->displayDeliveryDetails($delivery->delivery_id); ?>
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
	