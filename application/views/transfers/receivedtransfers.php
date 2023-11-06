			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers_received'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>transfers/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_transfer'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_transfer'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>transfers/issued" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('transfers_issued_help'); ?>">
											<span class="range-text"> <i class="fa fa-backward"></i> <?php echo $this->lang->line('transfers_issued'); ?></span>
										</a>
									</li>
									
									
									
								</ul>
								
								<div class="table-responsive">
									<?php echo $this->session->flashdata('receptionStorageSuccess'); ?>
									<?php echo $this->session->flashdata('receptionStorageError'); ?>
										
									<table id="fixedHeader" class="table custom-table issuedTransferTable txtTable ">
										<thead>
											<tr>
												<th></th>
												<th><?php echo $this->lang->line('date'); ?></th>
												<th><?php echo $this->lang->line('code'); ?></th>
												<th><?php echo $this->lang->line('from_warehouse'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('to_warehouse'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('volume'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('weight'); ?></th>
												<th ><?php echo $this->lang->line('received'); ?></th>
												<th ><?php echo $this->lang->line('stored'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($transfers) {
													foreach ($transfers as $transfer) { 
													$ct++;
													$originWarehouse = $this->global_model->getItem('warehouses', 'id', $transfer->warehouse_id, 'warehouseName');
													$destinationWarehouse = $this->global_model->getItem('warehouses', 'id', $transfer->destination_id, 'warehouseName');
											?>
											<tr colspan="10"   data-id="<?php echo $transfer->transfer_id; ?>" >
												<td class="expand" data-toggle="collapse" data-target="<?php echo '#tr'.$transfer->transfer_id.$ct;?>" class="accordion-toggle "><i class="fa fa-caret-right"></i></td>
												<td><?php echo $this->global_model->setDateFormat($transfer->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));?></td>
												<td><?php echo $transfer->transfer_code;?></td>
												<td><?php echo $originWarehouse;?></td>
												<td><?php echo $destinationWarehouse;?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($this->transfer_model->transferVolume( $transfer->transfer_id)).' '.$this->lang->line('cubic_meter');?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($this->transfer_model->transferWeight( $transfer->transfer_id)).' '.$this->lang->line('kg');?></td>
												<td class="text-center">
												<?php 
													//
													if($transfer->received ==1) {
														echo '<i class="fa fa-check-circle text-success"></i>';
													} else {
														/* IF AUTHORIZED TO RECEIVE */
														echo '<form method="post" action="'.base_url('transfers/reception').'">';
														echo '<input type="hidden" name="receivedTrId" value="'.$transfer->transfer_id.'" />';
														echo '<button class="btn btn-primary btn-sm"><span class="small">'.$this->lang->line("receive").'</span></button>';
														echo '</form>';
													}
												?>
												</td>
												<td class="text-center">
												<?php
													if($transfer->received == 1) {
														
														if($this->transfer_model->isTransferStored($transfer->transfer_id)) {
															echo '<i class="fa fa-check-circle text-success"></i>';
														} else {
															/* IF AUTHORIZED TO MANAGE LOCATIONS */
														echo '<form method="post" action="'.base_url('transfers/reception/store').'">';
														echo '<input type="hidden" name="receivedTrId1" value="'.$transfer->transfer_id.'" />';
														echo '<i class="fa fa-exclamation-triangle text-danger"></i> <button class="btn btn-primary btn-sm"><span class="small">'.$this->lang->line("manage_storage_locations").'</span></button>';
														echo '</form>';
														}
													} else {
														echo '<i class="fa fa-times-circle text-danger"></i>';
													}
												?>
												</td>
												
											</tr>
											<tr class="p">
												<td colspan="10" class="hiddenRow">
													<div class="accordian-body collapse p-3" id="<?php echo 'tr'.$transfer->transfer_id.$ct;?>">
														<table class="table table-striped">
															<thead>
																<tr class="info ml-5">
																	<th class="text-primary"><?php echo $this->lang->line('barcode');?></th>
																	<th class="text-primary  text-left"><?php echo $this->lang->line('name');?></th>
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_transferred');?></th>		
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_approved');?></th>	
																	<th class="text-primary  text-right"><?php echo $this->lang->line('qty_received');?></th>	
																</tr>
															</thead>	
															<tbody>
																<?php echo $this->transfer_model->displayTransferDetails($transfer->transfer_id); ?>
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
	