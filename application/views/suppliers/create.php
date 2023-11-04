			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('suppliers'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_supplier'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="card">
					<div class="card-body">
						<form method="post" action="<?php echo base_url('supplier/saveSupplier');?>">
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
										
										//SET THE SUPPLIER CODE /** You can change it as you like **/
										$supplierCode = 'SP'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('suppliers', 'supplier_id'))+1), - 4);
										
									?>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row ">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group form-group-sm">
														<label> <?php echo $this->lang->line('code'); ?></label>
														<input type="text" name="supplierCode" id="supplierCode" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['supplier_code']; }else { echo $supplierCode;}?>" Required >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('name'); ?></label>
														<input type="text" name="supplierName" id="supplierName" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['full_name']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('commercial_register'); ?></label>
														<input type="text" name="supplierRegister" id="supplierRegister" Placeholder="" class="form-control form-control-sm" value="<?php if ($data){ echo $data['register_number']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('phone'); ?></label>
														<input type="text" name="supplierPhone" id="supplierPhone" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['phone']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('mobile'); ?></label>
														<input type="text" name="supplierMobile" id="supplierMobile" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['mobile']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('address'); ?></label>
														<textarea name="supplierAddress" id="supplierAddress" Placeholder="" class="form-control form-control-sm " Required><?php if ($data){ echo $data['address']; }?></textarea>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('city'); ?></label>
														<input type="text" name="supplierCity" id="supplierCity" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['city']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('country'); ?></label>
														<input type="text" name="supplierCountry" id="supplierCountry" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['country']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('email'); ?></label>
														<input type="email" name="supplierEmail" id="supplierEmail" Placeholder="" class="form-control form-control-sm " value="<?php if ($data){ echo $data['email']; }?>" Required  >
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label><?php echo $this->lang->line('status'); ?></label>
														<select name="supplierStatus" id="supplierStatus" class="form-control select2" Required >
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
												<button type="submit" name="saveSupplier" id="saveSupplier" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('save_supplier'); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>		
				</div>
			</div>
				
	