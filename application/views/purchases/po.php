			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('purchases'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('purchasing_orders'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>purchases/lpo/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_lpo'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_lpo'); ?></span>
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
												<th><?php echo $this->lang->line('lpo'); ?></th>
												<th><?php echo $this->lang->line('quotation'); ?></th>
												<th><?php echo $this->lang->line('supplier'); ?></th>
												<th ><?php echo $this->lang->line('delivery_before'); ?></th>
												<th ><?php echo $this->lang->line('received'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if(!empty($pos)) {
												foreach ($pos as $po) { 
												$ct++;
												$warehouseName = $this->global_model->getItem('warehouses', 'id', $po->warehouse_id, 'warehouseName');
												$supplierName = $this->global_model->getItem('suppliers', 'supplier_id', $po->supplier_id, 'full_name');
												$lpoCode = $this->global_model->getItem('orders', 'order_id', $po->lpo_id, 'order_code');
											?>
											<tr colspan="8"   data-id="<?php echo $po->id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#po'.$po->id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($po->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $po->po_code;?></td>
												<td><?php echo $lpoCode;?></td>
												<td><?php echo $po->quotation;?></td>
												<td><?php echo $supplierName;?></td>
												<td><?php echo $this->global_model->setDateFormat($po->delivery_limit, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td class="text-center">
												<!--CHECK IF PO IS RECEIVED -->
												<?php 
													if ($po->received==1) {
														echo '<i class="fa fa-check-circle text-success"></i>';
													} else {
														/* IF AUTHORIZED TO RECEIVE */
														echo '<form method="post" action="'.base_url('purchases/receivings/new').'">';
														echo '<input type="hidden" name="poId" value="'.$po->id.'" />';
														echo '<button class="btn btn-primary btn-sm"><span class="small">'.$this->lang->line("receive").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												
											</tr>
											<tr class="p">
												<td colspan="10" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'po'.$po->id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>
																	<th class="text-primary  text-right"><?php echo $this->lang->line('lpo_qty');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('po_qty');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_received');?></th>	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->order_model->displayPODetails($po->id); ?>
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
	