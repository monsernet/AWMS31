			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('returns'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_transfer_return'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				
						<div class="card">
							<div class="card-body">
								
								<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url('transfers/returns');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('transfer_returns'); ?>">
												<span class="range-text"> <i class="fa fa-forward"></i> <?php echo $this->lang->line('transfer_returns'); ?></span>
											</a>
										</li>
									</ul>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php echo $this->session->flashdata('addReturnError'); ?>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<form method="post" action="<?php echo base_url('transfers/returns/new');?>">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('enter_transfer_code'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnTransferCode" id="returnTransferCode" value="<?php if(isset($transferRow)){ echo $transferRow->transfer_code; } ?>"  REQUIRED>
													</div>
													<span class="text-danger" id="returnTransferCodeError"><?php if(isset($errorTransferExist)){ echo $errorTransferExist; } ?></span>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mt-4">
													<div class="form-group">
														<label ><br/></label>
													<button type="submit" name="returnFindTransfer" id="returnFindTransfer" class="btn btn-info" ><i class="fa fa-search"></i> <?php echo $this->lang->line('find_transfer');  ?></button>
													</div>
													<span class="text-danger" id="returnTransferCodeError"></span>
												</div>
												
											</div>
											</form>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('transfer_code'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnTransferTrCode" id="returnTransferTrCode" value="<?php if(isset($transferRow)){ echo $transferRow->transfer_code; } ?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('transfer_date'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnTransferTrDate" id="returnTransferTrDate" value="<?php if(isset($transferRow)){ echo $this->global_model->setDateFormat($transferRow->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));} ?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnTransferTrWarhOrigin" id="returnTransferTrWarhOrigin" value="<?php if(isset($transferRow)){ echo $this->global_model->getItem('warehouses', 'id', $transferRow->warehouse_id, 'warehouseName'); }?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('to_warehouse'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnTransferTrWarhDestination" id="returnTransferTrWarhDestination" value="<?php if(isset($transferRow)){ echo $this->global_model->getItem('warehouses', 'id', $transferRow->destination_id, 'warehouseName'); }?>"  DISABLED>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
									<div class="card">
										<div class="card-body border border-gray">
										<form method="post" action="<?php echo base_url('transfers/newreturn/save');?>">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_code'); ?></label>
														<?php 
															//SET THE RETURN CODE /** You can change it as you like **/
															$returnCode = 'RET-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('returns', 'id'))+1), - 4).'-'.date('y');
														?>
														<input type="text" class="form-control form-control-sm" name="returnTransferRetCode" id="returnTransferRetCode" value="<?php echo $returnCode; ?>" READONLY >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_date'); ?></label>
														<!-- TRANSFER ID -->
														<input type="hidden" name="returnTransferTrId" value="<?php if(isset($transferRow)){ echo $transferRow->transfer_id; } ?>" />
														<!-- RETURNED FROM WAREHOUSE -->
														<input type="hidden" name="retTransferWarhFrom" value="<?php if(isset($transferRow)){ echo $transferRow->destination_id; } ?>"  >
														<!-- RETURNED TO WAREHOUSE -->
														<input type="hidden" name="retTransferWarhTo" value="<?php if(isset($transferRow)){ echo $transferRow->warehouse_id; } ?>"  >
														<!-- RETURN DATE -->
														<input type="date" class="form-control form-control-sm" name="returnTransferRetDate" id="returnTransferRetDate" value="" REQUIRED >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_reference'); ?></label>
														<input type="text" class="form-control  form-control-sm" name="returnTransferRetReference" id="returnTransferRetReference" value="" REQUIRED >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<!-- LIST OF PRODUCTS -->
														<table class="table custom-table txtTable" id="receptionProductList" width="100%">
															<thead>
																
																<th width="30%"><?php echo $this->lang->line('name'); ?></th>
																<th ><?php echo $this->lang->line('tr_qty'); ?></th>
																<th ><?php echo $this->lang->line('ret_qty'); ?></th>
																<th width="37%" ><?php echo $this->lang->line('ret_reason'); ?></th>
															</thead>
															<tbody>
																<?php 
																$ct=0;
																if(isset($transferDetails)) {
																	foreach ($transferDetails as $detail) { 
																		$ct++;
																		echo '<tr>';
																		echo '<td><input type="hidden" class="form-control control-sm " name="trPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'<br><span class="text-muted">'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																		echo '<td><input type="hidden" class="form-control control-sm " name="transferredQty[]" value="'.$detail->qty_appr.'" />'.number_format($detail->qty_appr,2).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																		echo '<td><input type="number" class="form-control  form-control-sm " name="returnedQty[]" value=""  REQUIRED /></td>';
																		echo '<td><input type="text" class="form-control  form-control-sm " name="returnReason[]" value=""   /></td>';
																		echo '</tr>';
																	}
																}
															?>
															</tbody>
														</table>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="saveTransferReturn" id="saveTransferReturn" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" <?php if($ct==0) { echo 'DISABLED'; } ?>><i class="fa fa-save"></i> <?php echo $this->lang->line('save_returned_qty'); ?></button>
												</div>
											</div>
										</form>
										</div>
									</div>
								</div>
								</div>
							</div>		
						</div>
			</div>
				
	