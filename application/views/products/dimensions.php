			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('product_dimensions'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<!--<div class="row">-->
				<div class="card">
					<div class="card-body">
						<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<ul class="top-icons pull-right text-info small">
									<li>
										<a href="<?php echo base_url();?>products/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_product'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_product'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>products" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('all_products'); ?>">
											<span class="range-text"> <i class="fa fa-barcode"></i> <?php echo $this->lang->line('all_products'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>products/alert" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('products_stock_alert'); ?>">
											<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('products_stock_alert'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>products/oos" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('products_out_of_alert'); ?>">
											<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('products_out_of_alert'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>categories" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('categories'); ?>">
											<span class="range-text"> <i class="fa fa-th-list"></i> <?php echo $this->lang->line('categories'); ?></span>
										</a>
									</li>	
								</ul>
						</div>
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<?php echo $this->session->flashdata('updatesuccess'); ?>			
							<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
								<div class="card">
									<div class="card-body">
										<img src="<?php echo base_url('assets/img/box_dimensions.png');?>" class="img-fluid" alt="<?php echo $this->lang->line('product_dimensions'); ?>">
									</div>
								</div>
							</div>
							<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
								<form method="post" action="<?php echo base_url('product/saveDimensions');?>">
								<div class="row">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label ><?php echo $this->lang->line('product'); ?></label>
											<select class="form-control select2" name="productDim_products" id="productDim_products" REQUIRED>
												<option value=""><?php echo $this->lang->line('select_product'); ?></option>
												<?php foreach ($products as $product) { 
													if ($this->input->post('productDim_products')!==NULL){ 
														if ($this->input->post('productDim_products')==$product->product_id) {
															echo '<option value="'.$product->product_id.'" selected>'.$category->product_name.'</option>';
														} else {
															echo '<option value="'.$product->product_id.'">'.$product->product_name.'</option>';
														}			
													} else {
												?>
												<option value="<?php echo $product->product_id;?>"><?php echo $product->product_name;?></option>
												<?php } } ?>
											</select>
										</div>
										<hr>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label ><?php echo $this->lang->line('package_length'); ?></label>
										<div class="input-group input-group-sm mb-2 mr-sm-2">
											<input type="number" min="0" step="0.01" name="productDim_length" id="productDim_length" value="<?php if ($this->input->post('productDim_products')){ echo $data['productLength']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_length'); ?>" REQUIRED>
											<div class="input-group-prepend">
												<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label ><?php echo $this->lang->line('package_width'); ?></label>
										<div class="input-group input-group-sm mb-2 mr-sm-2">
											<input type="number" min="0" step="0.01" name="productDim_width" id="productDim_width" value="<?php if ($this->input->post('productDim_products')){ echo $data['productWidth']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_width'); ?>" REQUIRED>
											<div class="input-group-prepend">
												<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label ><?php echo $this->lang->line('package_height'); ?></label>
										<div class="input-group input-group-sm mb-2 mr-sm-2">
											<input type="number" min="0" step="0.01" name="productDim_height" id="productDim_height" value="<?php if ($this->input->post('productDim_products')){ echo $data['productHeight']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('package_height'); ?>" REQUIRED>
											<div class="input-group-prepend">
												<div class="input-group-text"><?php echo $this->lang->line('cm'); ?></div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label ><?php echo $this->lang->line('total_weight'); ?></label>
										<div class="input-group input-group-sm mb-2 mr-sm-2">
											<input type="number" min="0" step="0.01" name="productDim_weight" id="productDim_weight" value="<?php if ($this->input->post('productDim_products')){ echo $data['productWeight']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('total_weight'); ?>" REQUIRED>
											<div class="input-group-prepend">
												<div class="input-group-text"><?php echo $this->lang->line('kg'); ?></div>
											</div>
										</div>
									</div>
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
										<label ><?php echo $this->lang->line('pallet_units'); ?></label>
										<div class="input-group input-group-sm mb-2 mr-sm-2">
											<input type="number" min="0" step="1" name="productDim_units" id="productDim_units" value="<?php if ($this->input->post('productDim_products')){ echo $data['productWeight']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('pallet_units'); ?>" REQUIRED>
											<div class="input-group-prepend">
												<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
											</div>
										</div>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
										<button type="submit" name="saveDimensions" id="saveDimensions" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12" <?php if (!$this->input->post('productDim_products')) { echo 'DISABLED';} ?> ><i class="fa fa-save"></i><?php echo $this->lang->line('save_dimensions'); ?></button>
									</div>
								</div>
								</form>
							</div>
							</div>
						</div>		
					</div>
				</div>
						<!--</div>-->
			</div>
		
	