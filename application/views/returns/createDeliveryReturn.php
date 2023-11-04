			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('deliveries'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('returns'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_delivery_return'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				
						<div class="card">
							<div class="card-body">
								
								<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url('deliveries/returns');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('delivery_returns'); ?>">
												<span class="range-text"> <i class="fa fa-forward"></i> <?php echo $this->lang->line('delivery_returns'); ?></span>
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
											<form method="post" action="<?php echo base_url('deliveries/returns/new');?>">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('enter_delivery_code'); ?></label>
														<input type="text" class="form-control  form-control-sm" name="returnDeliveryCode" id="returnDeliveryCode" value="<?php if(isset($deliveryRow)){ echo $deliveryRow->delivery_code; } ?>"  REQUIRED>
													</div>
													<span class="text-danger" id="returnDeliveryCodeError"><?php if(isset($errorDeliveryExist)){ echo $errorDeliveryExist; } ?></span>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mt-4">
													<div class="form-group">
														<label ><br/></label>
													<button type="submit" name="returnFindDelivery" id="returnFindDelivery" class="btn btn-info" ><i class="fa fa-search"></i> <?php echo $this->lang->line('find_delivery');  ?></button>
													</div>
													<span class="text-danger" id="returnDeliveryCodeError"></span>
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
														<label ><?php echo $this->lang->line('delivery_code'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryDelivCode" id="returnDeliveryDelivCode" value="<?php if(isset($deliveryRow)){ echo $deliveryRow->delivery_code; } ?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('delivery_date'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryDelivDate" id="returnDeliveryDelivDate" value="<?php if(isset($deliveryRow)){ echo $this->global_model->setDateFormat($deliveryRow->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));} ?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('customer'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryCustomer" id="returnDeliveryCustomer" value="<?php if(isset($deliveryRow)){ echo $this->global_model->getItem('clients', 'client_id', $deliveryRow->client_id, 'full_name'); }?>"  DISABLED>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('to_warehouse'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryWarhouse" id="returnDeliveryWarhouse" value="<?php if(isset($deliveryRow)){ echo $this->global_model->getItem('warehouses', 'id', $deliveryRow->warehouse_id, 'warehouseName'); }?>"  DISABLED>
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12" >
									<div class="card">
										<div class="card-body border border-gray">
										<form method="post" action="<?php echo base_url('deliveries/newreturn/save');?>">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_code'); ?></label>
														<?php 
															//SET THE RETURN CODE /** You can change it as you like **/
															$returnCode = 'RET-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('returns', 'id'))+1), - 4).'-'.date('y');
														?>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryRetCode" id="returnDeliveryRetCode" value="<?php echo $returnCode; ?>" READONLY >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_date'); ?></label>
														<!-- DELIVERY ID -->
														<input type="hidden" name="returnDelivId" value="<?php if(isset($deliveryRow)){ echo $deliveryRow->delivery_id; } ?>" />
														<!-- CUSTOMER -->
														<input type="hidden" name="retDelivCustomer" value="<?php if(isset($deliveryRow)){ echo $deliveryRow->client_id; } ?>"  >
														<!-- RETURNED TO WAREHOUSE -->
														<input type="hidden" name="retDelivWarehouse" value="<?php if(isset($deliveryRow)){ echo $deliveryRow->warehouse_id; } ?>"  >
														<!-- RETURN DATE -->
														<input type="date" class="form-control form-control-sm" name="returnDeliveryRetDate" id="returnDeliveryRetDate" value="" REQUIRED >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('return_reference'); ?></label>
														<input type="text" class="form-control form-control-sm" name="returnDeliveryRetReference" id="returnDeliveryRetReference" value="" REQUIRED >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<!-- LIST OF PRODUCTS -->
														<table class="table custom-table txtTable" id="" width="100%">
															<thead>
																
																<th width="30%"><?php echo $this->lang->line('name'); ?></th>
																<th ><?php echo $this->lang->line('deliv_qty'); ?></th>
																<th ><?php echo $this->lang->line('ret_qty'); ?></th>
																<th width="37%" ><?php echo $this->lang->line('ret_reason'); ?></th>
															</thead>
															<tbody>
																<?php 
																$ct=0;
																if(isset($deliveryDetails)) {
																	foreach ($deliveryDetails as $detail) { 
																		$ct++;
																		echo '<tr>';
																		echo '<td><input type="hidden" class="form-control control-sm " name="delivPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'<br><span class="text-muted">'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																		echo '<td><input type="hidden" class="form-control control-sm " name="deliveredQty[]" value="'.$detail->qty.'" />'.number_format($detail->qty,2).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
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
													<button type="submit" name="saveDeliveryReturn" id="saveDeliveryReturn" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" <?php if($ct==0) { echo 'DISABLED'; } ?>><i class="fa fa-save"></i> <?php echo $this->lang->line('save_returned_qty'); ?></button>
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
				
	