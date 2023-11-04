			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('receive_transfer'); ?></li>
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
								<form method="post" action="<?php echo base_url('transfer/approveTransferReception');?>">
								<div class="row">
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="RecTransferId" value="<?php echo $transferRow->transfer_id;?>" />
														<input type="text" class="form-control" name="RectransferCode" id="RectransferCode" value="<?php echo $transferRow->transfer_code; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="hidden" name="RecTransferCode" value="<?php echo $transferRow->transfer_code;?>" />
														<input type="text" class="form-control" name="RectransferDate" id="RectransferDate" value="<?php echo $transferDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
														<input type="hidden" name="RecWarehouseId" value="<?php echo $transferRow->warehouse_id;?>" />
														<input type="text" class="form-control" name="RecOrginWarehouse" id="RecOrginWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->warehouse_id, 'warehouseName')  ?>"  READONLY>
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
														<table class="table custom-table small" id="receptionProductList" width="100%">
															<thead>
																<th width="25%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="35%"><?php echo $this->lang->line('name'); ?></th>
																<th width="15%"><?php echo $this->lang->line('qty_transferred'); ?></th>
																<th width="25%"><?php echo $this->lang->line('qty_received'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($transferDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="RecTransferPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="RecTransferredQty[]" value="'.$detail->qty_appr.'" />'.$this->global_model->setNumberFormat($detail->qty_appr).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	echo '<td><input type="number" class="form-control control-sm " name="RecReceivedQty[]" value="'.$detail->qty_appr.'"  REQUIRED /></td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="approveReception" id="approveReception" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-check-circle"></i> <?php echo $this->lang->line('approve_reception'); ?></button>
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
				
	