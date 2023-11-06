	<?php
		if(intval($this->global_model->countItems('companysettings')) > 0) {
			// if no settings  -> redirect to company settings page 
			$this->session->set_flashdata('companyAlreadyExist', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('company_information_already_exist').'</div>');
			redirect('home');
		}
	?>

	<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('general_settings'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('company_settings'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('company/save-settings');?>">
								
								<div class="row  mr-3">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
										<div class="row">
											<div class="card">
												<div class="card-body border border-gray">
													<div class="row">
														<!-- ****** ALERT MESSAGE ****** -->
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="alert alert-warning text-white">
																<h6 class="text-justify"><i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line("company_settings_alert"); ?></h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
										<div class="card">
											<div class="card-body border border-gray">
												<!-- ****** NEW USER DETAILS -->
												<div class="row">
													<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<!-- Select Products to add to the current package -->
														<div class="form-group">
															<label ><?php echo $this->lang->line('company_fullname'); ?></label>
															<input type="text" class="form-control" name="nc_companyFullName" id="nc_companyFullName" value="" placeholder="<?php echo $this->lang->line('company_fullname'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('company_shortname'); ?></label>
															<input type="text" class="form-control" name="nc_companyShortName" id="nc_companyShortName" value="" placeholder="<?php echo $this->lang->line('company_shortname'); ?>" REQUIRED>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('email'); ?></label>
															<input type="email" class="form-control" name="nc_companyEmail" id="nc_companyEmail" value="" placeholder="<?php echo $this->lang->line('email'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('phone'); ?></label>
															<input type="text" class="form-control" name="nc_companyPhone" id="nc_companyPhone" value="" placeholder="<?php echo $this->lang->line('phone'); ?>" REQUIRED>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('shipping_address'); ?></label>
															<textarea class="form-control" name="nc_companyShippingAddress" id="nc_companyShippingAddress"  placeholder="<?php echo $this->lang->line('shipping_address'); ?>" REQUIRED></textarea>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('billing_address'); ?></label>
															<textarea class="form-control" name="nc_companyBillingAddress" id="nc_companyBillingAddress"  placeholder="<?php echo $this->lang->line('billing_address'); ?>" REQUIRED></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('tax_number'); ?></label>
															<input type="text" class="form-control" name="nc_companyTaxNumber" id="nc_companyTaxNumber" value="" placeholder="<?php echo $this->lang->line('tax_number'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('register_number'); ?></label>
															<input type="text" class="form-control" name="nc_companyRegisterNumber" id="nc_companyRegisterNumber" value="" placeholder="<?php echo $this->lang->line('register_number'); ?>" REQUIRED>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('country'); ?></label>
															<input type="text" class="form-control" name="nc_companyCountry" id="nc_companyCountry" value="" placeholder="<?php echo $this->lang->line('country'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('city'); ?></label>
															<input type="text" class="form-control" name="nc_companyCity" id="nc_companyCity" value="" placeholder="<?php echo $this->lang->line('city'); ?>" REQUIRED>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
														<div class="form-group">
															<button type="submit"  class="btn btn-primary btn-block col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-refresh"></i> <?php echo $this->lang->line('add_company_settings'); ?></button>
														</div>
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
					
				</div>
	