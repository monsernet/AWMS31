			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('purchases'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_lpo'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('order/saveLPO');?>">
								<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url();?>purchases/lpo" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('lpo'); ?>">
												<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('local_purchasing_orders'); ?></span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url();?>purchases/po" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('orders'); ?>">
												<span class="range-text"> <i class="fa fa-arrows-alt"></i> <?php echo $this->lang->line('purchasing_orders'); ?></span>
											</a>
										</li>	
										<li>
											<a href="<?php echo base_url();?>purchases/receivings" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('receivings'); ?>">
												<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('receivings'); ?></span>
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
										
										//SET THE LPO CODE /** You can change it as you like **/
										$lpoCode = 'LPO-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('orders', 'order_id'))+1), - 4).'-'.date('y');
										//SET FORMATTED date
										$todayDate = date("Y/m/d");
										$lpoDate= $this->global_model->setDateFormat($todayDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
										//SET THE SUPPLIER CODE /** You can change it as you like **/
										$supplierCode = 'SP'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('suppliers', 'supplier_id'))+1), - 4);
									?>
								</div>
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="text" class="form-control form-control-sm" name="lpoCode" id="lpoCode" value="<?php echo $lpoCode; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="text" class="form-control form-control-sm" name="lpoDate" id="lpoDate" value="<?php echo $lpoDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('warehouse'); ?></label>
														<input type="text" class="form-control form-control-sm" name="lpoWarehouse" id="lpoWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $this->session->userdata('warehouseid'), 'warehouseName')  ?>"  READONLY>
													</div>
												</div>
												
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('select_supplier'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="newLPOSupplier" id="newLPOSupplier" >
																<option value=""><?php echo $this->lang->line('select_supplier'); ?> </option>
																<?php foreach ($suppliers as $supplier) { ?>
																<option value="<?php echo $supplier->supplier_id;?>"><?php echo $supplier->full_name;?> (<?php echo $supplier->supplier_code;?>)</option>
																<?php } ?>
															</select>
															<button type="button" id="newLpo_newSupplier"  class="btn btn-secondary btn-sm  ml-2" data-toggle="modal" data-target="#newLpo_newSupplierModal" title="<?php echo $this->lang->line('new_supplier'); ?>" > <i class="fa fa-plus-square"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 disabled-div" id="newLpoAddProductDiv">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
												<!-- Select Products to add to the current transfer -->
													<div class="form-group">
														<label ><?php echo $this->lang->line('select_product'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="lpoProducts" id="lpoProducts" >
																<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
																
															</select>
															<button type="button" id="newLpo_newProduct"  class="btn btn-secondary btn-sm  ml-2" data-toggle="modal" data-target="#newLpo_newProductModal" title="<?php echo $this->lang->line('new_product'); ?>" /> <i class="fa fa-plus-square"></i></button>
														</div>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('qty'); ?></label>
														<input type="number" min="0" step="0.01" name="lpoProductQty" id="lpoProductQty" value="" class="form-control form-control-sm"  >
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-3">
													
													<button type="button" name="addProductToLpoTable" id="addProductToLpoTable" class="btn btn-primary mt-2"><?php echo $this->lang->line('add'); ?></button>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table small" id="lpoProductList" width="100%">
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
													<button type="submit" name="saveLpo" id="saveLpo" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" DISABLED><i class="fa fa-save"></i> <?php echo $this->lang->line('save_lpo'); ?></button>
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
			
			<!-- MODALS -->
			<!-- ADD NEW SUPPLIER -->
			<div class="modal fade" id="newLpo_newSupplierModal" tabindex="-1" role="dialog" aria-labelledby="newLpo_newSupplierModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->lang->line('add_new_supplier'); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
						<div class="modal-body">
							<div class="row ">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group form-group-sm">
										<label> <?php echo $this->lang->line('code'); ?></label>
										<input type="text" name="newLPO_supplierCode" id="newLPO_supplierCode" Placeholder="<?php echo $this->lang->line('code'); ?>" value="<?php echo $supplierCode; ?>" class="form-control form-control-sm" value="" Required >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('name'); ?></label>
										<input type="text" name="newLPO_supplierName" id="newLPO_supplierName" Placeholder="<?php echo $this->lang->line('name'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('commercial_register').' OR '.$this->lang->line('national_id'); ?></label>
										<input type="text" name="newLPO_supplierRegister" id="newLPO_supplierRegister" Placeholder="<?php echo $this->lang->line('commercial_register').' OR '.$this->lang->line('national_id'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('phone'); ?></label>
										<input type="text" name="newLPO_supplierPhone" id="newLPO_supplierPhone" Placeholder="<?php echo $this->lang->line('phone'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('mobile'); ?></label>
										<input type="text" name="newLPO_supplierMobile" id="newLPO_supplierMobile" Placeholder="<?php echo $this->lang->line('mobile'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('address'); ?></label>
										<textarea name="newLPO_supplierAddress" id="newLPO_supplierAddress" Placeholder="<?php echo $this->lang->line('address'); ?>" class="form-control form-control-sm" Required></textarea>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('city'); ?></label>
										<input type="text" name="newLPO_supplierCity" id="newLPO_supplierCity" Placeholder="<?php echo $this->lang->line('city'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('country'); ?></label>
										<input type="text" name="newLPO_supplierCountry" id="newLPO_supplierCountry" Placeholder="<?php echo $this->lang->line('country'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('email'); ?></label>
										<input type="email" name="newLPO_supplierEmail" id="newLPO_supplierEmail" Placeholder="<?php echo $this->lang->line('email'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('status'); ?></label>
										<select name="newLPO_supplierStatus" id="newLPO_supplierStatus" class="form-control select2" Required >
											<option value=""><?php echo $this->lang->line('select'); ?></option>
											<option value="1"><?php echo $this->lang->line('active'); ?></option>
											<option value="0"><?php echo $this->lang->line('deactive'); ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
							<button type="button" id="newLPO_saveSupplier" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_supplier'); ?></button>
						</div>
				</div>
			</div>
			</div>
			
			<!-- ADD NEW PRODUCT -->
			<div class="modal fade" id="newLpo_newProductModal" tabindex="-1" role="dialog" aria-labelledby="newLpo_newProductModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->lang->line('new_product'); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
						<div class="modal-body">
							<div class="row ">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group form-group-sm">
										<label> <?php echo $this->lang->line('barcode'); ?></label>
										<input type="text" name="newLPO_productBarcode" id="newLPO_productBarcode" Placeholder="<?php echo $this->lang->line('barcode'); ?>" value="0" class="form-control form-control-sm" value="" Required >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('name'); ?></label>
										<input type="text" name="newLPO_productName" id="newLPO_productName" Placeholder="<?php echo $this->lang->line('name'); ?>" class="form-control form-control-sm" value="" Required  >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('category'); ?></label>
										<select class="form-control select2" name="newLPO_productCategory" id="newLPO_productCategory" REQUIRED>
											<option value=""><?php echo $this->lang->line('select_category'); ?></option>
												<?php foreach ($categories as $category) { 	?>
														<option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
												<?php }  ?>
										</select>
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('supplier'); ?></label>
										<input type="hidden" name="newLPO_productSupplierId" id="newLPO_productSupplierId" value="" class="form-control form-control-sm" value="" Required  >
										<input type="text" name="newLPO_productSupplierName" id="newLPO_productSupplierName" value="" class="form-control form-control-sm" value="" READONLY  >
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label><?php echo $this->lang->line('unit'); ?></label>
										<select class="form-control select2"  name="newLPO_productUnit" id="newLPO_productUnit" REQUIRED>
											<option value=""><?php echo $this->lang->line('select_unit'); ?> </option>
												<?php foreach ($units as $unit) { 	?>
														<option value="<?php echo $unit->id;?>"><?php echo $unit->designation.' <small>('.$unit->code.')</small>';?></option>
												<?php  } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
							<button type="button" id="newLPO_saveProduct" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_supplier'); ?></button>
						</div>
				</div>
			</div>
			</div>
	
				
			