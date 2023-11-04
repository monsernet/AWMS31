			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('inventory'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('storage_positions'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="card">
					<div class="card-body">
						<div class="form-group">
							<label ><?php echo $this->lang->line('select_product');?>:</label>
							<form method="post" action="<?php echo base_url('inventory/storage-positions');?>">
							<select class="form-control select2 " name="storagePos_items" onchange="this.form.submit()" id="storagePos_items" Required>
								<option value=""><?php echo $this->lang->line('select');?></option>
								<?php foreach($products as $product) {
									if (($_SERVER["REQUEST_METHOD"] == "POST") && ($this->input->post('storagePos_items') == $product->product_id))  {
										echo '<option value="'.$product->product_id.'" selected>'.$product->product_name.' ('.$product->product_barcode.')</option>';
									} else {
									echo '<option value="'.$product->product_id.'">'.$product->product_name.' ('.$product->product_barcode.')</option>';
									}
								}	
								?>
							</select>
							</form>
						</div>
						<div class="table-responsive">
							<table id="prStorPos" class="table custom-table productStoragePosTable txtTable">
								<thead>
									<tr>							
										<th width="15%"><?php echo $this->lang->line('barcode');?></th>
										<th width="25%"><?php echo $this->lang->line('name');?></th>
										<th class="text-right" width="10%"><?php echo $this->lang->line('volume');?></th>
										<th width="10%"><?php echo $this->lang->line('row_no');?></th>
										<th width="10%"><?php echo $this->lang->line('line_no');?></th>
										<th width="10%"><?php echo $this->lang->line('shelf_no');?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if ($_SERVER["REQUEST_METHOD"] == "POST") {
										$prId = $this->input->post('storagePos_items');
										echo $this->inventory_model->displayProductStoragePos($prId);
									}
									?>
								</tbody>
							</table>
						</div>						
					</div>
				</div>
			</div>
		