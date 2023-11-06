			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('customers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('edit_customer'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?php echo base_url('customer/update');?>">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url();?>customers" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customers'); ?>">
												<span class="range-text"> <i class="fa fa-plus-list"></i> <?php echo $this->lang->line('customers'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>customers/orders" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_orders'); ?>">
												<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('customer_orders'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>customers/deliveries" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_deliveries'); ?>">
												<span class="range-text"> <i class="fa fa-arrows-alt"></i> <?php echo $this->lang->line('customer_deliveries'); ?></span>
											</a>
										</li>	
										<li>
											<a href="<?php echo base_url();?>deliveries/returns" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_returns'); ?>">
												<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('customer_returns'); ?></span>
											</a>
										</li>
									</ul>
									<?php 
										$data = $this->session->flashdata('data');
										echo $this->session->flashdata('adderror');
									?>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group form-group-sm">
														<label> <?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="editCustomer_customerId" value="<?php echo $customerRow->client_id; ?>">
														<input type="text" name="editCustomer_customerCode" id="editCustomer_customerCode" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->client_code; ?>" Required >
													</div>
												</div>
											</div>
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('name'); ?></label>
														<input type="text" name="editCustomer_customerName" id="editCustomer_customerName" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->full_name; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('business_title'); ?></label>
														<input type="text" name="editCustomer_businessTitle" id="editCustomer_businessTitle" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->business_title; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<label><?php echo $this->lang->line('tax_rate'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" max="100" name="editCustomer_customerTax" id="editCustomer_customerTax" Placeholder="" class="form-control form-control-sm" value="<?php echo $customerRow->tax; ?>" Required  >
														<div class="input-group-prepend">
															<div class="input-group-text">%</div>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" name="editCustomer_customerPhone" id="editCustomer_customerPhone" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->phone; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('mobile'); ?></label>
														<input type="text" name="editCustomer_customerMobile" id="editCustomer_customerMobile" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->mobile; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('address'); ?></label>
														<textarea name="editCustomer_customerAddress" id="editCustomer_customerAddress" Placeholder="" class="form-control form-control-sm " Required><?php echo $customerRow->address; ?></textarea>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('city'); ?></label>
														<input type="text" name="editCustomer_customerCity" id="editCustomer_customerCity" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->city; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('country'); ?></label>
														<input type="text" name="editCustomer_customerCountry" id="editCustomer_customerCountry" Placeholder="" class="form-control form-control-sm " value="<?php echo $customerRow->country; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('email'); ?></label>
														<input type="email" name="editCustomer_customerEmail" id="editCustomer_customerEmail" Placeholder="" class="form-control  form-control-sm" value="<?php echo $customerRow->email; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('price_level'); ?></label>
														<select name="editCustomer_priceLevel" id="editCustomer_priceLevel" class="form-control select2" Required >
															<?php 
															//if ($data){
																if($customerRow->price_level==1) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1" selected>'.$this->lang->line('default').'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('status'); ?></label>
														<select name="editCustomer_customerStatus" id="editCustomer_customerStatus" class="form-control select2" Required >
															<?php 
															//if ($data){
																if($customerRow->status==0) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1">'.$this->lang->line('active').'</option>';
																	echo '<option value="0" selected>'.$this->lang->line('inactive').'</option>';
																} elseif($customerRow->status==1) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1" selected>'.$this->lang->line('active').'</option>';
																	echo '<option value="0" >'.$this->lang->line('inactive').'</option>';
																} else {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1">'.$this->lang->line('active').'</option>';
																	echo '<option value="0">'.$this->lang->line('inactive').'</option>';
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="submit" name="updateCustomer" id="updateCustomer" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-refresh"></i><?php echo $this->lang->line('update_customer'); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>		
				</div>
			</div>
				
	