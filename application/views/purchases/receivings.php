			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('purchases'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('receivings'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<?php echo $this->session->flashdata('receivingInvWarning'); ?>
									<?php echo $this->session->flashdata('approveReceivingSuccess'); ?>
									<?php echo $this->session->flashdata('approveReceivingError'); ?>
									<?php echo $this->session->flashdata('receivingStorageSuccess'); ?>
									<?php echo $this->session->flashdata('receivingStorageError'); ?>
										
									<table id="fixedHeader" class="table custom-table receivingTable txtTable ">
										<thead>
											<tr>
												<th></th>
												<th><?php echo $this->lang->line('date'); ?></th>
												<th><?php echo $this->lang->line('code'); ?></th>
												<th><?php echo $this->lang->line('warehouse'); ?></th>
												<th><?php echo $this->lang->line('supplier'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('order'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('lpo'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('stored'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($receivings) {
													foreach ($receivings as $rec) { 
													$ct++;
													$warehouseName = $this->global_model->getItem('warehouses', 'id', $rec->warehouse_id, 'warehouseName');
													$supplierName = $this->global_model->getItem('suppliers', 'supplier_id', $rec->supplier_id, 'full_name');
													$orderCode = $this->global_model->getItem('po', 'id', $rec->po_id, 'po_code');
													$lpoCode = $this->global_model->getItem('orders', 'order_id', $rec->lpo_id, 'order_code');
											?>
											<tr colspan="10"   data-id="<?php echo $rec->id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#rc'.$rec->id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($rec->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $rec->rc_code;?></td>
												<td><?php echo $warehouseName;?></td>
												<td><?php echo $supplierName;?></td>
												<td class="text-right"><?php echo $orderCode ;?></td>
												<td class="text-right"><?php echo $lpoCode ;?></td>
												
												<td class="text-center">
												<?php
													if($rec->stored == 1) {
														echo '<i class="fa fa-check-circle text-success"></i>';
													} else {
														/* IF AUTHORIZED TO MANAGE LOCATIONS */
														echo '<form method="post" action="'.base_url('purchases/receiving/store').'">';
														echo '<input type="hidden" name="receivedRCId" value="'.$rec->id.'" />';
														echo '<i class="fa fa-exclamation-triangle text-danger"></i> <button class="btn btn-primary btn-sm"><span class="small">'.$this->lang->line("manage_storage_locations").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												
											</tr>
											<tr class="p">
												<td colspan="10" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'rc'.$rec->id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>
																	<th class="text-primary  text-right"><?php echo $this->lang->line('po_qty');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_received');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_damaged');?></th>	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->order_model->displayReceivingDetails($rec->id); ?>
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
	