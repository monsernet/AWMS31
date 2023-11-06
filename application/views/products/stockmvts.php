			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('stock_mvt'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 m-3">
										<div class="form-group">
											<label ><?php echo $this->lang->line('select_product');?>:</label>
											<select class="form-control select2" name="inventory_items" id="inventory_items" Required>
												<option value=""><?php echo $this->lang->line('select');?></option>
													<?php foreach($products as $product) { 
															echo '<option value="'.$product->product_id.'">'.$product->product_name.' ('.$product->product_barcode.')</option>';
														}	
													?>
											</select>
										</div>
									</div>					
								</div>
								<div class="row">
								<div class="table-responsive">
									<table id="fixedHeader" class="table custom-table productMvtTable txtTable">
										<thead>
											<tr>							
												<th width="10%"><?php echo $this->lang->line('date');?></th>
												<th width="15%"><?php echo $this->lang->line('mvt_type');?></th>
												<th class="text-right" width="10%"><?php echo $this->lang->line('stock_before');?></th>
												<th class="text-right" width="10%"><?php echo $this->lang->line('qty_inn');?></th>
												<th class="text-right" width="10%"><?php echo $this->lang->line('qty_out');?></th>
												<th class="text-right" width="10%"><?php echo $this->lang->line('stock_after');?></th>
												<th width="20%"><?php echo $this->lang->line('reference');?></th>
												<th width="15%"><?php echo $this->lang->line('added_by');?></th>
											</tr>
										</thead>
										<tbody>
																		
										</tbody>
									</table>
								</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
	