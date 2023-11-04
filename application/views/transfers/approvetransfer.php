			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('approve_transfer'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** TRANSFER DATE FORMAT **/
						$trDate = $transferRow->datetime;
						$transferDate= $this->global_model->setDateFormat($trDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('transfers/saveapproval');?>">
								<div class="row">
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="ApprTransferId" value="<?php echo $transferRow->transfer_id;?>" />
														<input type="text" class="form-control" name="ApprovaltransferCode" id="ApprovaltransferCode" value="<?php echo $transferRow->transfer_code; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="hidden" name="ApprTransferCode" value="<?php echo $transferRow->transfer_code;?>" />
														<input type="text" class="form-control" name="ApprovaltransferDate" id="ApprovaltransferDate" value="<?php echo $transferDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
														<input type="hidden" name="ApprWarehouseId" value="<?php echo $transferRow->warehouse_id;?>" />
														<input type="text" class="form-control" name="ApprovalOrginWarehouse" id="ApprovalOrginWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->warehouse_id, 'warehouseName');  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('to_warehouse'); ?></label>
														<input type="hidden" name="ApprDestinationId" value="<?php echo $transferRow->destination_id;?>" />
														<input type="text" class="form-control" name="ApprovalDestinationWarehouse" id="ApprovalDestinationWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->destination_id, 'warehouseName');  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('address'); ?></label>
														
														<textarea class="form-control" name="ApprovaldestinationAddress" id="ApprovaldestinationAddress" value="" READONLY ><?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->destination_id, 'address')  ?></textarea>
													</div>
												</div>
												
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('contact_name'); ?></label>
														<input type="text" class="form-control" name="ApprovaldestinationManager" id="ApprovaldestinationManager" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->destination_id, 'manager')  ?>" READONLY >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" class="form-control" name="ApprovaldestinationPhone" id="ApprovaldestinationPhone" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->destination_id, 'contact')  ?>" READONLY >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table small" id="transferProductList" width="100%">
															<thead>
																<th width="25%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="35%"><?php echo $this->lang->line('name'); ?></th>
																<th width="15%"><?php echo $this->lang->line('qty_transferred'); ?></th>
																<th width="25%"><?php echo $this->lang->line('qty_approved'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($transferDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="transferPrId[]" value="'.$detail->productId.'" />'.$this->global_model->getItem('products', 'product_id', $detail->productId, 'product_barcode').'</td>';
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->productId, 'product_name').'</td>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="transferNormalQty[]" value="'.$detail->qty.'" />'.$this->global_model->setNumberFormat($detail->qty).' '.$this->global_model->getProductUnit($detail->productId).'</td>';
																	echo '<td><input type="number" class="form-control control-sm " name="transferApprovedQty[]" value="'.$detail->qty.'"  REQUIRED /></td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="approveTransfer" id="approveTransfer" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-save"></i> <?php echo $this->lang->line('approve_transfer'); ?></button>
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
				
	