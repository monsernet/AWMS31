			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('deliveries'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('returns'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>deliveries/returns/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_customer_order'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_delivery_return'); ?></span>
										</a>
									</li>
									
									
									
									
								</ul>
								
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addReturnSuccess'); ?>
									<?php echo $this->session->flashdata('addReturnWarning'); ?>
										
									<table id="fixedHeader" class="table custom-table delivRetTable txtTable ">
										<thead>
											<tr>
												<th></th>
												<th><?php echo $this->lang->line('return_date'); ?></th>
												<th><?php echo $this->lang->line('return_code'); ?></th>
												<th><?php echo $this->lang->line('delivery_code'); ?></th>
												<th><?php echo $this->lang->line('returned_from'); ?></th>
												<th ><?php echo $this->lang->line('return_reference'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if(!empty($returns)) {
												foreach ($returns as $return) { 
												$ct++;
												$clientName = $this->global_model->getItem('clients', 'client_id', $return->from_client, 'full_name');
												$deliveryCode = $this->global_model->getItem('deliveries', 'delivery_id', $return->delivery_id, 'delivery_code');
											?>
											<tr colspan="6"   data-id="<?php echo $return->id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#ret'.$return->id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($return->return_date, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $return->return_code;?></td>
												<td><?php echo $deliveryCode;?></td>
												<td><?php echo $clientName;?></td>
												<td><?php echo $return->return_reference;?></td>
											</tr>
											<tr class="p">
												<td colspan="6" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'ret'.$return->id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('returned_qty');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('return_reason');?></th>	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->return_model->displayReturnDetails($return->id); ?>
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
	