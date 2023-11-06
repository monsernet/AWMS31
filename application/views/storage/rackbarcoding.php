			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('packages'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('package_barcoding'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<?php echo $this->session->flashdata('addPackageError'); ?>
								<form method="post" action="<?php echo base_url('packages/store');?>">
								<div class="row mr-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<p class="text-justify">
											<span class="text-info"><i class="fa fa-question-circle" ></i> <b><?php echo $this->lang->line('notes'); ?></b></span><br/>
											<span class="small"> <?php echo $this->lang->line('package_barcoding_help'); ?></span>
										</p>
									</div>
								</div>
								<div class="row  mr-3">
									<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
										<div class="row">
											<div class="card">
												<div class="card-body border border-gray">
													<div class="row">
														<!-- ****** CUSTOMER DETAILS ****** -->
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<!-- Select customer -->
															<div class="form-group">
																<label ><?php echo $this->lang->line('select_customer'); ?></label>
																<select class="form-control select2"  name="packageBarcode_customers" id="packageBarcode_customers" REQUIRED >
																	<option value=""><?php echo $this->lang->line('select_customer'); ?> </option>
																	<?php foreach ($clients as $client) { ?>
																	<option value="<?php echo $client->client_id;?>"><?php echo $client->full_name;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<!-- customer shipping address -->
															<div class="form-group">
																<label ><?php echo $this->lang->line('shipping_address'); ?></label>
																<textarea class="form-control form-control-sm" name="packageBarcode_clientShipAdr" id="packageBarcode_clientShipAdr" REQUIRED></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12  disabled-bloc disabled-div" id="barcodingPackageDiv">
										<div class="card">
											<div class="card-body border border-gray">
												<div class="row">
													<!-- ****** PACKAGE DETAILS -->
													<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
													<!-- Select Products to add to the current package -->
														<div class="form-group">
															<label ><?php echo $this->lang->line('select_product'); ?></label>
															<select class="form-control select2"  name="packageBarcode_Products" id="packageBarcode_Products" >
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
															<input type="number" min="0" step="0.01" name="packageBarcode_PrQty" id="packageBarcode_PrQty" value="" class="form-control form-control-sm"  >
														</div>
													</div>
													<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mt-3">
														
														<button type="button" name="packageBarcode_addProduct" id="packageBarcode_addProduct" class="btn btn-primary mt-2"><?php echo $this->lang->line('add'); ?></button>
													</div>
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<div class="table-responsive">
															<table class="table custom-table small" id="packageBarcode_productList" width="100%">
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
														<button type="submit" name="packageBarcode_generateBarcode" id="packageBarcode_generateBarcode" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" DISABLED ><i class="fa fa-barcode"></i> <?php echo $this->lang->line('generate_package_barcode'); ?></button>
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
					<?php if (!empty($this->session->flashdata('package_id'))) { ?>
					<!--  ***** BARCODE PRINTING ZONE ***** -->
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="row  mr-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex flex-row-reverse">
										<div class="form-group">
											<button class="btn btn-primary" onclick="printPackageBarcode()"><i class="fa fa-print"></i> Print </button>
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="packageBarcodesView">
										<?php 
											//Barcode Type
											if($barcodingRow->barcode_type==1) { $barcode_type='code39';}
											else {$barcode_type='code128';}
											//Paper Size
											if($barcodingRow->paper_size==1) {
												$paper_length=210; $paper_width=297; 
												$barcode_width=150* 3.779528;
												$barcode_height= 250;
											} else { 
												$paper_length=148; $paper_width=210;
												$barcode_width=88* 3.779528;
												$barcode_height= 250;
											}
											//Source company
											$from = $this->global_model->getItem('companysettings', 'id', 1, 'companyName');
											$from_address = $this->global_model->getItem('companysettings', 'id', 1, 'companyAddress');
											$from_phone = $this->global_model->getItem('companysettings', 'id', 1, 'companyPhone');
											//Destination company
											$destinationId = $packRow->client_id;
											$to = $this->global_model->getItem('clients', 'client_id', $destinationId, 'full_name');
											$to_address = $packRow->shipping_address;
											$to_phone = $this->global_model->getItem('clients', 'client_id', $destinationId, 'phone');
											
											?>
										<div class="table-responsive">
											<table class="table table-bordered" cellpadding="10">
												<!-- SOURCE & DESTINATION COMPANIES -->
												<tr>
													<td width="50%"><h3>
														<?php echo strtoupper($this->lang->line('from')); ?></h3>
														<h4><?php echo strtoupper($from); ?><br/>
														<?php echo strtoupper($from_address); ?><br/>
														<?php echo strtoupper($from_phone); ?></h4>
													</td>
													<td width="50%"><h3>
														<?php echo strtoupper($this->lang->line('to')); ?></h3>
														<h4><?php echo strtoupper($to); ?><br/>
														<?php echo strtoupper($to_address); ?><br/>
														<?php echo strtoupper($to_phone); ?></h4>
													</td>
												</tr>
												<!-- PACKAGE DETAILS -->
												<tr> 
													<td colspan="2"><h3>
														<?php echo strtoupper($this->lang->line('items')); ?></h3>
														<?php 
														$totalWeight = 0;
														foreach($packDetails as $detail) {
															$totalWeight+=floatval($detail->weight);
															echo '<h4>'.strtoupper($this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name')).'<br/>';
															echo '<span class="text-right">'.$this->global_model->setNumberFormat($detail->qty).' '.strtoupper($this->lang->line('units')).'</span></h4>';
														} ?>
														<?php echo '<h3>'.strtoupper($this->lang->line('total_weight')).'<br/>'; ?><br/>
														<?php echo '<span class="text-right">'.$this->global_model->setNumberFormat($totalWeight).' '.strtoupper($this->lang->line('kg')).'</span></h3>';?>
													</td>
												</tr>
												<!-- BARCODE -->
												<tr>
													<?php 
														$pack_barcode = $packRow->package_code;
														echo '<td colspan="2" class="text-center" ><h4><img width="'.$barcode_width.'px" height="'.$barcode_height.'px"  src="'.base_url().'assets/barcode/barcode.php?codetype='.$barcode_type.'&size='.$barcode_height.'&text='.$pack_barcode.'&print=true"/></h4></td>';
													?>
												</tr>
												
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
	