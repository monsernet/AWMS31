			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('customers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('orders'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_customer_order'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('customers/orders/save');?>">
								<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url('customers/orders');?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_orders'); ?>">
												<span class="range-text"> <i class="fa fa-forward"></i> <?php echo $this->lang->line('customer_orders'); ?></span>
											</a>
										</li>
									</ul>
									<?php 
										
										
											echo $this->session->flashdata('addCustOrderSuccess');
											echo $this->session->flashdata('addCustOrderWarning');
											echo $this->session->flashdata('addCustOrderError');
									?>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('cpo_code'); ?></label>
														<input type="text" class="form-control" name="custOrderCode" id="custOrderCode" value=""  REQUIRED>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('cpo_date'); ?></label>
														<input type="date" class="form-control" name="custOrderDate" id="custOrderDate" value=""  REQUIRED>
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('customer'); ?></label>
														<select class="form-control select2"  name="custCustomer" id="custCustomer" REQUIRED>
															<option value=""><?php echo $this->lang->line('select_customer'); ?> </option>
															<?php 
															if($customers) {
																foreach ($customers as $customer ) {	?>
																	<option value="<?php echo $customer->client_id;?>"><?php echo $customer->full_name.' ('.$customer->business_title.')';?></option>
															<?php } } ?>
														</select>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('delivery_before'); ?></label>
														<input type="date" class="form-control" name="custDeliveryLimit" id="custDeliveryLimit" value=""   >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 disabled-bloc disabled-div" id="cpoProductDiv">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
												<!-- Select Products to add to the current order -->
													<div class="form-group">
														<label ><?php echo $this->lang->line('select_product'); ?></label>
														<select class="form-control select2"  name="custOrderProducts" id="custOrderProducts" >
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
														<input type="number" min="0" step="0.01" name="custOrderQty" id="custOrderQty" value="" class="form-control control-sm"  >
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-3">
													
													<button type="button" name="addProductToCustOrderTable" id="addProductToCustOrderTable" class="btn btn-primary mt-2"><?php echo $this->lang->line('add'); ?></button>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table small" id="custOrderProductList" width="100%">
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
													<button type="submit" name="saveCustOrder" id="saveCustOrder" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" DISABLED><i class="fa fa-save"></i> <?php echo $this->lang->line('save_customer_order'); ?></button>
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
				
	