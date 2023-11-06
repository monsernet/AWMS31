			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('customers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_customer'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?php echo base_url('customer/saveCustomer');?>">
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
										
										//SET THE CUSTOMER CODE /** You can change it as you like **/
										$customerCode = 'CUST'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('clients', 'client_id'))+1), - 4);
										
									?>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group form-group-sm">
														<label> <?php echo $this->lang->line('code'); ?></label>
														<input type="text" name="customerCode" id="customerCode" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['client_code']; }else { echo $customerCode;}?>" Required >
													</div>
												</div>
											</div>
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('name'); ?></label>
														<input type="text" name="customerName" id="customerName" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['full_name']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('business_title'); ?></label>
														<input type="text" name="customerBusiness" id="customerBusiness" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['business_title']; }?>"   >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<label><?php echo $this->lang->line('tax_rate'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" max="100" name="customerTax" id="customerTax" Placeholder="" class="form-control form-control-sm" value="<?php if ($data){ echo $data['tax']; }?>" Required  >
														<div class="input-group-prepend">
															<div class="input-group-text">%</div>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" name="customerPhone" id="customerPhone" Placeholder="" class="form-control  form-control-sm" value="<?php if ($data){ echo $data['phone']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('mobile'); ?></label>
														<input type="text" name="customerMobile" id="customerMobile" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['mobile']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('address'); ?></label>
														<textarea name="customerAddress" id="customerAddress" Placeholder="" class="form-control form-control-sm " Required><?php if ($data){ echo $data['address']; }?></textarea>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('city'); ?></label>
														<input type="text" name="customerCity" id="customerCity" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['city']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('country'); ?></label>
														<input type="text" name="customerCountry" id="customerCountry" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['country']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('email'); ?></label>
														<input type="email" name="customerEmail" id="customerEmail" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['email']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('price_level'); ?></label>
														<select name="customerPriceLevel" id="customerPriceLevel" class="form-control select2" Required >
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<option value="1"><?php echo $this->lang->line('default'); ?></option>
														</select>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('status'); ?></label>
														<select name="customerStatus" id="customerStatus" class="form-control select2" Required >
															<?php 
															if ($data){
																if($data['status']==0) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1">'.$this->lang->line('active').'</option>';
																	echo '<option value="0" selected>'.$this->lang->line('inactive').'</option>';
																} elseif($data['status']==1) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1" selected>'.$this->lang->line('active').'</option>';
																	echo '<option value="0" >'.$this->lang->line('inactive').'</option>';
																} else {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1">'.$this->lang->line('active').'</option>';
																	echo '<option value="0">'.$this->lang->line('inactive').'</option>';
																}
															} else {?>
															<option value=""><?php echo $this->lang->line('select'); ?></option>
															<option value="1"><?php echo $this->lang->line('active'); ?></option>
															<option value="0"><?php echo $this->lang->line('inactive'); ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
											<div class="row justify-content-center col-12">
												<button type="submit" name="saveCustomer" id="saveCustomer" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('save_customer'); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>		
				</div>
			</div>
				
	