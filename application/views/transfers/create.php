			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('transfers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_transfer'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('transfers/save');?>">
								<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url();?>transfers/issued" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('transfers_issued_help'); ?>">
												<span class="range-text"> <i class="fa fa-forward"></i> <?php echo $this->lang->line('transfers_issued'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>transfers/received" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('transfers_received_help'); ?>">
												<span class="range-text"> <i class="fa fa-backward"></i> <?php echo $this->lang->line('transfers_received'); ?></span>
											</a>
										</li>
										
										
										
									</ul>
									<?php 
										
										if ($this->session->flashdata('addTransferSuccess')){
											echo $this->session->flashdata('addTransferSuccess');
										}
										if ($this->session->flashdata('addTransferWarning')){
											echo $this->session->flashdata('addTransferWarning');
										}
										if ($this->session->flashdata('addTransferError')){
											echo $this->session->flashdata('addTransferError');
										}
										$data='';
										if($this->session->flashdata('data')) {
											$data = $this->session->flashdata('data');
										}
										
										//SET THE TRANSFER CODE /** You can change it as you like **/
										$transferCode = 'TR-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('transfers', 'transfer_id'))+1), - 4).'-'.date('y');
										//SET FORMATTED date
										$todayDate = date("Y/m/d");
										$transferDate= $this->global_model->setDateFormat($todayDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
									?>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="text" class="form-control form-control-sm" name="transferCode" id="transferCode" value="<?php echo $transferCode; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="text" class="form-control form-control-sm" name="transferDate" id="transferDate" value="<?php echo $transferDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
														<input type="text" class="form-control form-control-sm" name="OrginWarehouse" id="OrginWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $this->session->userdata('warehouseid'), 'warehouseName')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('to_warehouse'); ?></label>
														<select class="form-control select2"  name="destinationWarehouse" id="destinationWarehouse" REQUIRED>
															<option value=""><?php echo $this->lang->line('select_destination'); ?> </option>
															<?php foreach ($dest_warehouses as $destination) { 
																if ($data){ 
																	if ($data['destinationWarehouse']==$destination->id) {
																		echo '<option value="'.$destination->id.'" selected>'.$destination->warehouseName.' </option>';
																	} else {
																		echo '<option value="'.$destination->id.'">'.$destination->warehouseName.' </option>';
																	}					
																} else {
															?>
															<option value="<?php echo $destination->id;?>"><?php echo $destination->warehouseName;?></option>
															<?php } } ?>
														</select>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('address'); ?></label>
														<textarea class="form-control form-control-sm" name="destinationAddress" id="destinationAddress" value="" READONLY ></textarea>
													</div>
												</div>
												
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('contact_name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="destinationManager" id="destinationManager" value="" READONLY >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" class="form-control form-control-sm" name="destinationPhone" id="destinationPhone" value="" READONLY >
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
												<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
												<!-- Select Products to add to the current transfer -->
													<div class="form-group">
														<label ><?php echo $this->lang->line('select_product'); ?></label>
														<select class="form-control select2"  name="transferProducts" id="transferProducts" >
															<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
															<?php foreach ($products as $product) { ?>
															<option value="<?php echo $product->product_id;?>"><?php echo $product->product_name;?> (<?php echo $product->product_barcode;?>)</option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('qty'); ?></label>
														<input type="number" min="0" step="0.01" name="transferQty" id="transferQty" value="" class="form-control form-control-sm"  >
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-3">
													
													<button type="button" name="addProductToTransferTable" id="addProductToTransferTable" class="btn btn-primary mt-2"><?php echo $this->lang->line('add'); ?></button>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table txtTable" id="transferProductList" width="100%">
															<thead>
																<th><?php echo $this->lang->line('barcode'); ?></th>
																<th><?php echo $this->lang->line('name'); ?></th>
																<th><?php echo $this->lang->line('qty'); ?></th>
																<th></th>
															</thead>
															<tbody>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="saveTransfer" id="saveTransfer" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" DISABLED><i class="fa fa-save"></i> <?php echo $this->lang->line('save_transfer'); ?></button>
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
				
	