			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('loading_transfer'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** TRANSFER DATE FORMAT **/
						$transferDate= $this->global_model->setDateFormat($transferRow->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('transfer/approveloding');?>">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="card">
											<div class="card-body border border-gray">
												<div class="row">
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('code'); ?></label>
															<input type="hidden" name="LoadingTransferId" value="<?php echo $transferRow->transfer_id;?>" />
															<input type="text" class="form-control control-sm" name="LoadingtransferCode" id="LoadingtransferCode" value="<?php echo $transferRow->transfer_code; ?>"  READONLY>
														</div>
													</div>
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('date'); ?></label>
															<input type="hidden" name="LoadTransferCode" value="<?php echo $transferRow->transfer_code;?>" />
															<input type="text" class="form-control control-sm" name="LoadingtransferDate" id="LoadingtransferDate" value="<?php echo $transferDate?>"  READONLY>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="table-responsive">
														<table class="table custom-table txtTable" id="transferProductList" width="100%">
															<thead>
																<th width="12%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="23%"><?php echo $this->lang->line('name'); ?></th>
																<th width="10%"><?php echo $this->lang->line('qty'); ?></th>
																<th width="10%"><?php echo $this->lang->line('volume'); ?></th>
																<th width="18%" ></th>
																<th  ><?php echo $this->lang->line('pickup_details'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($transferDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	/** Product Barcode **/
																	echo '<td><input type="hidden" class="form-control control-sm " name="transferPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	/** Product Name **/
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	/** Qty Approved **/
																	echo '<td class="text-right"><input type="hidden" class="form-control control-sm " name="transferApprQty[]" value="'.$detail->qty_appr.'" />'.$this->global_model->setNumberFormat($detail->qty_appr).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	/** Volume to be loaded **/
																	echo '<td class="text-right">'.$this->global_model->setNumberFormat((floatval($detail->qty_appr)*floatval($this->product_model->singleProductVolume( $detail->product_id)))).' '.$this->lang->line('cubic_meter').'</td>';
																	/*---------------------------------------------------
																	******* Select locations from the warehouse ***
																	----------------------------------------------------*/
																	// if product is loaded 
																	if($detail->loaded ==1) {
																		echo '<td>';
																			echo '<span class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('picked_up').'</span>';
																		echo '</td>';
																			//****** Pickup Details ***
																		echo '<td>';
																			echo $this->transfer_model->getProductPickupDetails ($detail->product_id, $transferRow->transfer_id);
																		
																		echo '</td>';
																	// if product is not loaded yet
																	} else {
																		echo '<td>';
																			echo '<a href="#" id="" class="text-primary" data-toggle="modal" data-target="#prVolumeLocationsModal" onclick="manageTransferVolumes('.$transferRow->transfer_id.', '.$detail->product_id.')" />'.$this->lang->line('manage_pickup_locations').'</a>';
																		echo '</td>';
																		/******* Pickup Details ***
																		**/
																		echo '<td>';
																		
																		echo '</td>';
																	}
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
														<button type="submit" name="approveTransfer" id="approveTransfer" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-save"></i> <?php echo $this->lang->line('approve_transfer_loading'); ?></button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								</form>
							</div>		
						</div>
			</div>
			
			
			<!--##### MODALS -->
	
	<!-- PICKUP LOCATIONS -->
	<div class="modal fade" id="prVolumeLocationsModal" tabindex="-1" role="dialog" aria-labelledby="prVolumeLocationsModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content ">
			<div class="modal-header">
				<h5 class="modal-title" ><?php echo $this->lang->line('manage_pickup_locations'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
				<div class="modal-body">
					<div class="row ">
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('transfer_code'); ?></label>
								<input type="hidden" name="pickupTransfer_trId" id="pickupTransfer_trId"  value="<?php echo $transferRow->transfer_id;?>"  >
								<input type="hidden" name="pickupTransfer_InventoryId" id="pickupTransfer_InventoryId"  value=""  >
								<input type="text" name="pickupTransfer_trCode" id="pickupTransfer_trCode"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('date'); ?></label>
								<input type="text" name="pickupTransfer_trDate" id="pickupTransfer_trDate"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('barcode'); ?></label>
								<input type="text" name="pickupTransfer_prBarcode" id="pickupTransfer_prBarcode"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
					</div>
					<div class="row ">
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('name'); ?></label>
								<input type="hidden" name="pickupTransfer_prId" id="pickupTransfer_prId"  value=""  >
								<input type="hidden" name="pickupTransfer_warehouseId" id="pickupTransfer_warehouseId"  value="<?php echo $this->session->userdata('warehouseid'); ?>"  >
								<input type="text" name="pickupTransfer_prName" id="pickupTransfer_prName"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('qty'); ?></label>
								<input type="text" name="pickupTransfer_prQty" id="pickupTransfer_prQty"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('volume'); ?></label>
								<input type="text" name="pickupTransfer_prVolume" id="pickupTransfer_prVolume"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('rem_volume'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('remaining_volume'); ?>" data-content="<?php echo $this->lang->line('rem_volume_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
								<input type="text" name="prRemainingVolume" id="prRemainingVolume"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="alert alert-information">
								
								<div class="icon hidden-xs">
									<i class="fa fa-info-circle"></i>
								</div>
								<strong><?php echo $this->lang->line('note'); ?></strong>
								<?php echo $this->lang->line('volume_pickup_note_help'); ?>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="table-responsive">
							<table class="table txtTable" id="transferProductVolumeList" width="100%">
								<thead>
									
									<tr>
									<th width="10%"></th>
									<th width="25%"><?php echo $this->lang->line('storage_location'); ?></th>
									<th width="15%" ><?php echo $this->lang->line('volume'); ?></th>
									<th width="20%"><?php echo $this->lang->line('picked_volume'); ?></th>
									<th ><?php echo $this->lang->line('remaining_volume'); ?></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
					<!-- this is to check if all items checked are saved -->
					<input type="hidden" name="savedItems" id="savedItems" value="0" >
					<button type="button" id="loadTransfer_savePickupLocations" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_pickup_locations'); ?></button>
				</div>
		</div>
	</div>
	</div>	
	