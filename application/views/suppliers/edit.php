			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('suppliers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('edit_supplier'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?php echo base_url('supplier/update');?>">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url();?>suppliers" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('suppliers'); ?>">
												<span class="range-text"> <i class="fa fa-plus-list"></i> <?php echo $this->lang->line('suppliers'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>purchases/lpo" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('lpo'); ?>">
												<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('lpo'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>purchases/po" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('orders'); ?>">
												<span class="range-text"> <i class="fa fa-arrows-alt"></i> <?php echo $this->lang->line('orders'); ?></span>
											</a>
										</li>	
										<li>
											<a href="<?php echo base_url();?>purchases/receivings" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('receivings'); ?>">
												<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('receivings'); ?></span>
											</a>
										</li>
									</ul>
									<?php 
										$data = $this->session->flashdata('data');
										echo $this->session->flashdata('adderror');
										
										
										
									?>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group form-group-sm">
														<label> <?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="editSupplier_supplierId" value="<?php echo $supplierRow->supplier_id; ?>">
														<input type="text" name="editSupplier_supplierCode" id="editSupplier_supplierCode" Placeholder="" class="form-control form-control-sm" value="<?php echo $supplierRow->supplier_code; ?>" Required >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('name'); ?></label>
														<input type="text" name="editSupplier_supplierName" id="editSupplier_supplierName" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->full_name; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('commercial_register'); ?></label>
														<input type="text" name="editSupplier_supplierRegister" id="editSupplier_supplierRegister" Placeholder="" class="form-control form-control-sm" value="<?php echo $supplierRow->register_number; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" name="editSupplier_supplierPhone" id="editSupplier_supplierPhone" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->phone; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('mobile'); ?></label>
														<input type="text" name="editSupplier_supplierMobile" id="editSupplier_supplierMobile" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->mobile; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('address'); ?></label>
														<textarea name="editSupplier_supplierAddress" id="editSupplier_supplierAddress" Placeholder="" class="form-control form-control-sm " Required><?php echo $supplierRow->address; ?></textarea>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('city'); ?></label>
														<input type="text" name="editSupplier_supplierCity" id="editSupplier_supplierCity" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->city; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('country'); ?></label>
														<input type="text" name="editSupplier_supplierCountry" id="editSupplier_supplierCountry" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->country; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('email'); ?></label>
														<input type="email" name="editSupplier_supplierEmail" id="editSupplier_supplierEmail" Placeholder="" class="form-control form-control-sm " value="<?php echo $supplierRow->email; ?>" Required  >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('status'); ?></label>
														<select name="editSupplier_supplierStatus" id="editSupplier_supplierStatus" class="form-control select2" Required >
															<?php 
															//if ($data){
																if($supplierRow->status==0) {
																	echo '<option value="">'.$this->lang->line('select').'</option>';
																	echo '<option value="1">'.$this->lang->line('active').'</option>';
																	echo '<option value="0" selected>'.$this->lang->line('inactive').'</option>';
																} elseif($supplierRow->status==1) {
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
												<button type="submit" name="updateSupplier" id="updateSupplier" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-refresh"></i><?php echo $this->lang->line('update_supplier'); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>		
				</div>
			</div>
				
	