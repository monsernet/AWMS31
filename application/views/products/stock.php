			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('current_stock'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								
								<div class="table-responsive">
									
									<table id="fixedHeader" class="table custom-table productTable txtTable">
										<thead>
											<tr>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('category'); ?></th>
												<th><?php echo $this->lang->line('supplier'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock_alert'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('qty_reserved'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('status'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($products) {
													foreach ($products as $product) { 
													$ct++;
													$supplier       = $this->global_model->getItem('suppliers', 'supplier_id', $product->supplier_id, 'full_name');
													$alerts         = $product->alert_units;
													$inventory      = $this->product_model->productInventory ($product->product_id, $this->session->userdata('warehouseid'));
													$reserved      = $this->product_model->stockReserved ($product->product_id, $this->session->userdata('warehouseid'));
													
											?>
											<tr>
												<td>
													<span class="mt-0 mb-1"><b><?php echo $product->product_name; ?></b></span>
													<p class="m-0 font-size-14"><i><?php echo $product->product_barcode; ?></i></p>
												</td>
												<td><?php echo $this->global_model->getItem('product_categories', 'category_id', $product->category_id, 'category_name');?></td>
												<td><?php echo $supplier;?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($alerts).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td class="text-right"><b><?php echo $this->global_model->setNumberFormat($inventory).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></b></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($reserved).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td class="text-center">
													<?php 
													if(floatval($inventory) > $alerts) {
														echo '<div class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("stock_available").'</div>';
													} elseif(floatval($inventory>0)) {
														echo '<div class="text-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("stock_alert").'</div>';
													} else {
														echo '<div class="text-danger"><i class="fa fa-times-circle"></i> '.$this->lang->line("stock_not_available").'</div>';
													}
													?>
												</td>
												
											</tr>
												<?php } } ?>
										</tbody>
									</table>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
	