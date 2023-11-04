			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('edit_product'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row">
						<div class="card">
							<div class="row card-body">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url().'products'?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('products'); ?>">
											<span class="range-text"> <i class="fa fa-barcode"></i> <?php echo $this->lang->line('products'); ?></span>
										</a>
									</li>
									
								</ul>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php 
										if ($this->session->flashdata('errors')){
											echo $this->session->flashdata('errors');
										}
										$data='';
										if($this->session->flashdata('data')) {
											$data = $this->session->flashdata('data');
										}
									?>
									<form method="post" enctype="multipart/form-data" action="<?php echo base_url('product/update/'.$product->product_id);?>">
									<div class="row card">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('general_information'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label for="productBarcode"><?php echo $this->lang->line('barcode'); ?></label>
														<input type="text" class="form-control form-control-sm" name="productBarcode" id="productBarcode" value="<?php echo $product->product_barcode; ?>" placeholder="<?php echo $this->lang->line('barcode'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label for="productName"><?php echo $this->lang->line('name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="productName" id="productName" value="<?php echo $product->product_name; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('category'); ?></label>
														<div class="d-flex">
															<select class="form-control select2" name="productCategory" id="productCategory" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_category'); ?></option>
																<?php foreach ($categories as $category) { 
																	 
																		if ($product->category_id==$category->category_id) {
																			echo '<option value="'.$category->category_id.'" selected>'.$category->category_name.'</option>';
																		} else {
																			echo '<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
																		}
																	} ?>
															</select>
															
															<button type="button" id="addNewCategory" class="btn btn-primary btn-sm  ml-2" data-toggle="modal" data-target="#addNewCategoryModal" /> <?php echo $this->lang->line('new'); ?> </button>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('supplier'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="productSupplier" id="productSupplier" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_supplier'); ?> </option>
																<?php foreach ($suppliers as $supplier) { 
																	
																		if ($product->supplier_id==$supplier->supplier_id) {
																			echo '<option value="'.$supplier->supplier_id.'" selected>'.$supplier->full_name.' <small>('.$supplier->supplier_code.')</small></option>';
																		} else {
																			echo '<option value="'.$supplier->supplier_id.'">'.$supplier->full_name.' <small>('.$supplier->supplier_code.')</small></option>';
																		}
																	} ?>
															</select>
															<button type="button" id="addNewSupplier" class="btn btn-primary btn-sm  ml-2" data-toggle="modal" data-target="#addNewSupplierModal"  /> <?php echo $this->lang->line('new'); ?> </button>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('unit'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="productUnit" id="productUnit" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_unit'); ?> </option>
																<?php foreach ($units as $unit) { 
																	 
																		if ($product->product_unit==$unit->id) {
																			echo '<option value="'.$unit->id.'" selected>'.$unit->designation.' <small>('.$unit->code.')</small></option>';
																		} else {
																			echo '<option value="'.$unit->id.'">'.$unit->designation.' <small>('.$unit->code.')</small></option>';
																		}
																	} ?>
															</select>
															<button type="button" id="addNewUnit" class="btn btn-primary btn-sm  ml-2" data-toggle="modal" data-target="#addNewUnitModal" /> <?php echo $this->lang->line('new'); ?> </button>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('cost_price'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productCost" id="productCost" value="<?php echo $price->cost;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('cost_price'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text">$</div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('selling_price'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productPrice" id="productPrice" value="<?php echo $price->selling_price;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('selling_price'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text">$</div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('vat_rate'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productVat" id="productVat" value="<?php echo $product->tax_id; ?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('vat_rate'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text">%</div>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label for="productFile"><?php echo $this->lang->line('product_picture'); ?></label>
														<input type="file" class="form-control form-control-sm editProductPicture" name="productFileEdit" id="productFileEdit"    >
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
													<div class="form-group">
														<div id="productPictureView">
															<?php 
															if($product->product_picture !='' || $product->product_picture != NULL) {
																echo '<img src="'.base_url().'uploads/pictures/products/'.$product->product_picture.'" class="content-img" id="editProductImage"   />'; 
															} else {
																echo '<img src="'.base_url().'uploads/pictures/products/avatar.png" class="content-img" id="editProductImage"   />'; 
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-- STOCK LEVELS -->
									<div class="row card">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('stock_levels'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('minimum_stock'); ?></label>
														<input type="number" min="0" step="0.01" name="minimumStock" id="minimumStock" value="<?php echo $product->min_stock;?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('minimum_stock'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('security_stock'); ?></label>
														<input type="number" min="0" step="0.01" name="securityStock" id="securityStock" value="<?php echo $product->sec_stock;?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('security_stock'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-3 col-lglg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('alert_qty'); ?></label>
														<input type="number" min="0" step="0.01" name="productAlert" id="productAlert" value="<?php echo $product->alert_units;?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('alert_qty'); ?>" READONLY>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('maximum_stock'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('maximum_stock'); ?>" data-content="<?php echo $this->lang->line('maximum_stock_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
														<input type="number" min="0" step="0.01" name="maximumStock" id="maximumStock" value="<?php echo $product->max_stock;?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('maximum_stock'); ?>" REQUIRED>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row card ">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('storage_information'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row d-flex justify-content-center">
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('package_length'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productLength" id="productLength" value="<?php echo $dimensions->length_pr;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_length'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('package_width'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productWidth" id="productWidth" value="<?php echo $dimensions->width_pr;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_width'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('package_height'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productHeight" id="productHeight" value="<?php echo $dimensions->height_pr;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_height'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('total_weight'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productWeight" id="productWeight" value="<?php echo $dimensions->weight_pr;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('total_weight'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('kg'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('package_units'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productUnits" id="productUnits" value="<?php echo $dimensions->units_pr;?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_units'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row justify-content-center col-12">
										<button type="submit" name="updateProduct" id="updateProduct" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-refresh"></i> <?php echo $this->lang->line('update_product'); ?></button>
									</div>
									</form>
								</div>		
							</div>
						</div>
					</div>
				</div>
				
	<!--##### MODALS -->
	
	<!-- ADD NEW CATEGORY -->
	<div class="modal fade" id="addNewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->lang->line('add_new_category'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
				<div class="modal-body">
					<div class="row ">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group form-group-sm">
								<label> <?php echo $this->lang->line('category_name'); ?></label>
								<input type="text" name="newProduct_categoryName" id="newProduct_categoryName" Placeholder="<?php echo $this->lang->line('category_name'); ?>" class="form-control form-control-sm" value="" Required >
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('category_description'); ?></label>
								<input type="text" name="newProduct_categoryDescription" id="newProduct_categoryDescription" Placeholder="<?php echo $this->lang->line('category_description'); ?>" class="form-control form-control-sm" value=""  >
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
					<button type="button" id="newProduct_saveCategory" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_category'); ?></button>
				</div>
		</div>
	</div>
	</div>
	
	<!-- ADD NEW SUPPLIER -->
	<div class="modal fade" id="addNewSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addNewSupplierModal" aria-hidden="true">
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
								<input type="text" name="newProduct_supplierCode" id="newProduct_supplierCode" Placeholder="<?php echo $this->lang->line('code'); ?>" class="form-control form-control-sm" value="" Required >
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('name'); ?></label>
								<input type="text" name="newProduct_supplierName" id="newProduct_supplierName" Placeholder="<?php echo $this->lang->line('name'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('commercial_register').' OR '.$this->lang->line('national_id'); ?></label>
								<input type="text" name="newProduct_supplierRegister" id="newProduct_supplierRegister" Placeholder="<?php echo $this->lang->line('commercial_register').' OR '.$this->lang->line('national_id'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('phone'); ?></label>
								<input type="text" name="newProduct_supplierPhone" id="newProduct_supplierPhone" Placeholder="<?php echo $this->lang->line('phone'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('mobile'); ?></label>
								<input type="text" name="newProduct_supplierMobile" id="newProduct_supplierMobile" Placeholder="<?php echo $this->lang->line('mobile'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('address'); ?></label>
								<textarea name="newProduct_supplierAddress" id="newProduct_supplierAddress" Placeholder="<?php echo $this->lang->line('address'); ?>" class="form-control form-control-sm" Required></textarea>
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('city'); ?></label>
								<input type="text" name="newProduct_supplierCity" id="newProduct_supplierCity" Placeholder="<?php echo $this->lang->line('city'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('country'); ?></label>
								<input type="text" name="newProduct_supplierCountry" id="newProduct_supplierCountry" Placeholder="<?php echo $this->lang->line('country'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('email'); ?></label>
								<input type="email" name="newProduct_supplierEmail" id="newProduct_supplierEmail" Placeholder="<?php echo $this->lang->line('email'); ?>" class="form-control form-control-sm" value="" Required  >
							</div>
						</div>
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
							<div class="form-group">
								<label><?php echo $this->lang->line('status'); ?></label>
								<select name="newProduct_supplierStatus" id="newProduct_supplierStatus" class="form-control select2" Required >
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
					<button type="button" id="newProduct_saveSupplier" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_supplier'); ?></button>
				</div>
		</div>
	</div>
	</div>
	
	
	<!-- ADD NEW UNIT -->
	<div class="modal fade" id="addNewUnitModal" tabindex="-1" role="dialog" aria-labelledby="addNewUnitModal" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->lang->line('add_new_unit'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form >
				<div class="modal-body">
					<div class="row ">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group form-group-sm">
								<label> <?php echo $this->lang->line('unit_code'); ?></label>
								<input type="text" name="newProduct_unitCode" id="newProduct_unitCode" Placeholder="<?php echo $this->lang->line('unit_code'); ?>" class="form-control form-control-sm" value=""  >
							</div>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group form-group-sm">
								<label> <?php echo $this->lang->line('unit_name'); ?></label>
								<input type="text" name="newProduct_unitName" id="newProduct_unitName" Placeholder="<?php echo $this->lang->line('unit_name'); ?>" class="form-control form-control-sm" value="" Required >
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
					<button type="button" id="newProduct_saveUnit" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_unit'); ?></button>
				</div>
			</form>
		</div>
	</div>
	</div>