			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('product_qrcodes'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('products/qrcodes');?>">
								<div class="row  mr-3">
									<div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
										<div class="form-group">
											<label ><?php echo $this->lang->line('select_product');?>:</label>
											<select class="form-control select2" name="barcoding_items" id="barcoding_items" onchange="this.form.submit()" Required>
												<option value=""><?php echo $this->lang->line('select');?></option>
													<?php foreach($products as $product) { ?>
															<option value="<?php echo $product->product_id;?>" <?php if (isset($productRow) && $productRow->product_id==$product->product_id) echo "SELECTED"; ?> ><?php echo $product->product_name.' ('.$product->product_barcode.')';?></option>
													<?php	}	?>
													
											</select>
										</div>
									</div>					
								</div>	
								</form>								
							</div>
						</div>
					</div>
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="row  mr-3">
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label ><?php echo $this->lang->line('barcode'); ?></label>
											<input type="text" class="form-control form-control-sm" name="barcoding_productBarcode" id="barcoding_productBarcode" value="<?php if(isset($productRow)) echo  $productRow->product_barcode; ?>" placeholder="<?php echo $this->lang->line('barcode'); ?>" Readonly>
										</div>
									</div>
									<div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
										<div class="form-group">
											<label ><?php echo $this->lang->line('name'); ?></label>
											<input type="text" class="form-control form-control-sm" name="barcoding_productName" id="barcoding_productName" value="<?php  if(isset($productRow)) echo  $productRow->product_name; ?>" placeholder="<?php echo $this->lang->line('name'); ?>" Readonly>
										</div>
									</div>
								</div>
								<div class="row  mr-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="productBarcodesView">
										<?php if (isset($productRow)) {
											
											//Display Data Text
											$qr_dispaly_text=$qrSettings->display_text;
											//Data Text Position
											$text_position = ($qrSettings->text_position !='') ? $qrSettings->text_position : 'right';
											//Product Name
											$product_name=$productRow->product_name;
											//Product Barcode
											$product_barcode=$productRow->product_barcode;
											//Product Category
											$product_category=$this->global_model->getItem('product_categories', 'category_id', $productRow->category_id, 'category_name');
											
											?>
											<div class="card mb-3"  >
												<div class="card-header bg-light text-right">
													<button class="btn btn-primary" onclick="printProductQrCode()"><i class="fa fa-print"></i> <?php echo $this->lang->line('print'); ?> </button>
												</div>
												<div class="card-body">
													<div class="row no-gutters col-md-10 d-flex justify-content-center">
														<div class="col-md-6">
															<!-- QR Image -->
															<img src="<?= base_url($qrRow->file) ?>" class="content-img" alt="<?= $qrRow->content ?>">
														</div>
														<div class="col-md-6 d-flex justify-content-left">
															<h5 class="card-text mt-3"><?= nl2br($qrRow->content) ?></h5>
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
											
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	