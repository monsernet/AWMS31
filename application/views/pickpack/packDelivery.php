			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('deliveries'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('pick_delivery'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** DELIVERY DATE FORMAT **/
						$delivDate = $deliveryRow->datetime;
						$warhId = $this->session->userdata('warehouseid');
						$deliveryDate= $this->global_model->setDateFormat($delivDate, $this->global_model->getItem('settings', 'warehouseId',$warhId , 'dateFormat'));
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('delivery/approvePacking');?>">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="card">
											<div class="card-body border border-gray">
												<div class="row">
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('code'); ?></label>
															<input type="hidden" name="pickDeliveryId" value="<?php echo $deliveryRow->delivery_id;?>" />
															<input type="text" class="form-control control-sm" name="pickDeliveryCode" id="pickDeliveryCode" value="<?php echo $deliveryRow->delivery_code; ?>"  READONLY>
														</div>
													</div>
													<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('date'); ?></label>
															<input type="hidden" name="pickDeliveryDate" value="<?php echo $deliveryRow->datetime;?>" />
															<input type="text" class="form-control control-sm" name="pickupDelivDate" id="pickupDelivDate" value="<?php echo $deliveryDate?>"  READONLY>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
															<input type="hidden" name="pickDeliveryWarehouse" value="<?php echo $deliveryRow->warehouse_id;?>" />
															<input type="text" class="form-control control-sm" name="pickupDelivWarehouse" id="pickupDelivWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $deliveryRow->warehouse_id, 'warehouseName'); ?>"  READONLY>
														</div>
													</div>
													
												</div>
												<div class="row">
													<div class="table-responsive">
														<table class="table custom-table txtTable" id="deliverPackProductList" width="100%">
															<thead>
																<th width="12%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="23%"><?php echo $this->lang->line('name'); ?></th>
																<th width="10%"><?php echo $this->lang->line('qty'); ?></th>
																<th width="10%"><?php echo $this->lang->line('volume'); ?></th>
																<th width="10%"><?php echo $this->lang->line('nb_boxes'); ?></th>
																<th width="17%" ><?php echo $this->lang->line('packaging_status'); ?></th>
																<th width="18%" ><?php echo $this->lang->line('box_barcoding'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($deliveryDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	/** Product Barcode **/
																	echo '<td><input type="hidden" class="form-control control-sm " name="deliveryPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	/** Product Name **/
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	/** Qty Approved **/
																	echo '<td class="text-right"><input type="hidden" class="form-control control-sm " name="deliveryQty[]" value="'.$detail->qty.'" />'.$this->global_model->setNumberFormat($detail->qty).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	/** Volume to be loaded **/
																	echo '<td class="text-right">'.$this->global_model->setNumberFormat((floatval($detail->qty)*floatval($this->product_model->singleProductVolume( $detail->product_id)))).' '.$this->lang->line('cubic_meter').'</td>';
																	/** Number of boxes **/
																	echo '<td class="text-right">'.$this->global_model->setNumberFormat($this->delivery_model->getProductPackBoxes ($detail->product_id, $deliveryRow->delivery_id)).' '.$this->lang->line('box').'</td>';
																	
																	/** Packaging Status  **/
																	if($detail->packed ==1) {
																		echo '<td>';
																			echo '<span class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('packed').'</span>';
																		echo '</td>';
																	//****** Approve the packaging when ready ***
																	} else {
																		echo '<td>';
																			/* SET AS PACKED */
																		echo '<form method="post" action="'.base_url('delivery/approvePackaging').'">';
																		echo '<input type="hidden" name="packagingDelivId" id="packagingDelivId'.$ct.'" value="'.$deliveryRow->delivery_id.'" />';
																		echo '<input type="hidden" name="packagingPrId" id="packagingPrId'.$ct.'" value="'.$detail->product_id.'" />';
																		echo '<button type="button"  class="btn btn-primary btn-sm pr_deliv_pack"><span class="small"><i class="fa fa-th" aria-hidden="true"></i> '.$this->lang->line("set_as_packed").'</span></button>';
																		echo '</form>';
																		echo '</td>';
																	}
																	echo '<td>';
																	echo '</td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
													</div>
												</div>
												
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
														<button type="submit" name="deliveryPackingList" id="deliveryPackingList" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" DISABLED ><i class="fa fa-print"></i> <?php echo $this->lang->line('packing_slip'); ?></button>
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
								<label> <?php echo $this->lang->line('delivery_code'); ?></label>
								<input type="hidden" name="pickupDelivery_deliveryId" id="pickupDelivery_deliveryId"  value="<?php echo $deliveryRow->delivery_id;?>"  >
								<input type="text" name="pickupDelivery_InventoryId" id="pickupDelivery_InventoryId"  value=""  >
								<input type="text" name="pickupDelivery_deliveryCode" id="pickupDelivery_deliveryCode"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('date'); ?></label>
								<input type="text" name="pickupDelivery_deliveryDate" id="pickupDelivery_deliveryDate"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('barcode'); ?></label>
								<input type="text" name="pickupDelivery_prBarcode" id="pickupDelivery_prBarcode"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
					</div>
					<div class="row ">
						
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('name'); ?></label>
								<input type="hidden" name="pickupDelivery_prId" id="pickupDelivery_prId"  value=""  >
								<input type="hidden" name="pickupDelivery_warehouseId" id="pickupDelivery_warehouseId"  value="<?php echo $this->session->userdata('warehouseid'); ?>"  >
								<input type="text" name="pickupDelivery_prName" id="pickupDelivery_prName"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('qty'); ?></label>
								<input type="text" name="pickupDelivery_prQty" id="pickupDelivery_prQty"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('volume'); ?></label>
								<input type="text" name="pickupDelivery_prVolume" id="pickupDelivery_prVolume"  class="form-control form-control-sm" value="" READONLY >
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
							<div class="form-group">
								<label> <?php echo $this->lang->line('rem_volume'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('remaining_volume'); ?>" data-content="<?php echo $this->lang->line('rem_volume_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
								<input type="text" name="DeliveryPrRemainingVolume" id="DeliveryPrRemainingVolume"  class="form-control form-control-sm" value="" READONLY >
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
							<table class="table txtTable" id="DeliveryProductVolumeList" width="100%">
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
					<input type="hidden" name="DelSavedItems" id="DelSavedItems" value="0" >
					<button type="button" id="saveDelPrPickupLocations" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_pickup_locations'); ?></button>
				</div>
		</div>
	</div>
	</div>	
	