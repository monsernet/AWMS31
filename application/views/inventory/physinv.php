			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('inventory_control'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('physical_inventory'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<?php 
										if ($this->session->flashdata('physQtyUpdatedResult')){
											echo $this->session->flashdata('physQtyUpdatedResult');
										}
									?>
								<div class="form-group">
									<label ><?php echo $this->lang->line('select_inventory'); ?></label>
									<div class="form-group">
										<select class="form-control select2" name="inventoryList" id="inventoryList" REQUIRED>
											<option value=""><?php echo $this->lang->line('select_inventory'); ?></option>
											<?php foreach ($inventories as $inventory) { ?> 
											<option value="<?php echo $inventory->id;?>" selected><?php echo $inventory->designation.' ('.date('d-m-Y',strtotime($inventory->creation_date)).') ';?></option>
											<?php }  ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
								<h6><?php echo $this->lang->line('create_new_inventory'); ?></h6><hr/>
								<?php 
										if ($this->session->flashdata('addsuccess')){
											echo $this->session->flashdata('addsuccess');
										}
										if ($this->session->flashdata('errors')){
											echo $this->session->flashdata('errors');
										}
										$data='';
										if($this->session->flashdata('data')) {
											$data = $this->session->flashdata('data');
										}
									?>
								<form method="post" action="<?php echo base_url('inventory/createphysinventory');?>">
								<div class="form-group">
									<label ><?php echo $this->lang->line('designation'); ?></label>
									<input type="text" class="form-control form-control-sm" name="inventoryDesignation" id="inventoryDesignation" value="" placeholder="<?php echo $this->lang->line('designation'); ?>" REQUIRED>
								</div>
								<div class="row justify-content-center col-12">
										<button type="submit" name="saveInventory" id="saveInventory" class="btn btn-primary col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_inventory'); ?></button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					
					<div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								
								<div class="table-responsive">
									
									<table id="fixedHeader" class="table custom-table physInvTable txtTable">
										<thead>
											<tr>
												<th class="text-left" ><?php echo $this->lang->line('name'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('perpetual_inventory'); ?></th>
												<th class="text-center"><?php echo $this->lang->line('physical_inventory'); ?></th>
												<th class="text-center" ></th>
												<th class="text-center"><?php echo $this->lang->line('notes'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($products) {
													foreach ($products as $product) { 
													$ct++;
													
													$inventory      = $this->product_model->productInventory ($product->product_id, $this->session->userdata('warehouseid'));
													//Last Inventory id
													$lastInvId = $this->global_model->getLastId('physical_inventories', 'id');
													$dateFormat = $this->global_model->getItem('settings', 'warehouseId',$this->session->userdata('warehouseid'),'dateFormat');
											?>
											<tr>
												<td >
													<h6 class="mt-0 mb-1"><?php echo $product->product_name; ?></h6>
													<p class="m-0 font-size-14"><i><?php echo $product->product_barcode; ?></i></p>
												</td>
												<td width="18%" class="text-center"><?php echo $this->global_model->setNumberFormat($inventory).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');
												if($this->global_model->itemExistWithCondition('phys_inv_details', 'invId', $lastInvId, ['productId' => $product->product_id ])){
													echo '<p class="m-0 font-size-7 text-danger"><i> <i class="fa fa-calendar"></i> '.$this->global_model->setDateFormat($this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$lastInvId, 'productId'=>$product->product_id], 'stock_date'),$dateFormat).'</i></p>';
												}
												?>
												
												</td>
												<td width="22%" class="text-center">
												<?php 
													if($this->global_model->itemExistWithCondition('phys_inv_details', 'invId', $lastInvId, ['productId' => $product->product_id ])){
														echo $this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$lastInvId, 'productId'=>$product->product_id], 'invCount').' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');
														echo '<p class="m-0 font-size-7 text-danger"><i> <i class="fa fa-calendar"></i> '.$this->global_model->setDateFormat($this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$lastInvId, 'productId'=>$product->product_id], 'invDate'),$dateFormat).'</i></p>';
													} else {
														echo '<div class="input-group mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="productPhysInv[]" id="productPhysInv'.$product->product_id.'" value="" class="form-control control-sm"  REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text">'.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code').'</div>
														</div>
													</div>';
													}
												?>
												<!-- hidden field to store inventory id -->
												<input type="hidden" name="physInvId[]" id="physInvId<?php echo $product->product_id;?>" class="praction" value="<?php echo $lastInvId;?>" />
												<!-- hidden field to store product id -->
												<input type="hidden" name="physInv_prId[]" id="physInv_prId<?php echo $product->product_id;?>" class="praction" value="<?php echo $product->product_id;?>" />
												</td>
												<td width="5%" class="text-center" >
													<?php 
													if($this->global_model->itemExistWithCondition('phys_inv_details', 'invId', $lastInvId, ['productId' => $product->product_id ])){
													?>
													<button type="button" name="editPhysInventory" id="editPhysInventory" class="btn btn-sm btn-warning mr-1" data-toggle="modal" data-target="#editPhysQtyModal" title="<?php echo $this->lang->line('edit_physical_inventory'); ?>" onclick="editPhysicalInventory(<?php echo $product->product_id; ?>)"><i class="fa fa-edit"></i></button>
													<?php 
													} else {
													?>
													<button type="button" name="savePhysInventory" id="savePhysInventory" class="btn btn-sm btn-primary mr-1 save-phys-inventory" title="<?php echo $this->lang->line('save_physical_inventory'); ?>" onclick="savePhysicalInventory(<?php echo $product->product_id; ?>)"><i class="fa fa-save"></i> </button>
													<?php } ?>
													
												</td>
												<td class="text-left">
												<?php 
												if($this->global_model->itemExistWithCondition('phys_inv_details', 'invId', $lastInvId, ['productId' => $product->product_id ])){
													$physStock = $this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$lastInvId, 'productId'=>$product->product_id], 'invCount');
													if(floatval($physStock)-floatval($inventory) > 0) {
														//physical stock greater than inventory 
														echo '<span class="text-danger"><i class="fa fa-times-circle"></i> '.$this->lang->line('stock_not_conform');
														echo '<button type="button" name="adjustInventory" id="adjustInventory" class="btn btn-sm btn-info mr-1 ml-1" title="'.$this->lang->line('adjust_inventory').'" onclick="adjustInventory('.$product->product_id.')"> '.$this->lang->line('adjust').'</button></span>';
													} elseif(floatval($physStock)-floatval($inventory) < 0) {
														// inventory greater than physical stock
														echo '<span class="text-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('stock_not_conform');
														echo '<button type="button" name="adjustInventory" id="adjustInventory" class="btn btn-sm btn-info mr-1 ml-1" title="'.$this->lang->line('adjust_inventory').'" onclick="adjustInventory('.$product->product_id.')"> '.$this->lang->line('adjust').'</button></span>';
													} else {
														echo '<span class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('stock_conform').'</span>';
													}
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
			<!-- EDIT PHYSICAL QTY MODAL FORM -->
			<!-- Modal -->
			<div class="modal fade" id="editPhysQtyModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel"><?php echo $this->lang->line('edit_physical_inventory'); ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="updateResult"></div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label ><?php echo $this->lang->line('inventory'); ?></label>
										<select class="form-control select2" name="editPhysQtyInvId" id="editPhysQtyInvId" READONLY>
											<?php foreach ($inventories as $inventory) { ?> 
											<option value="<?php echo $inventory->id;?>" selected><?php echo $inventory->designation.' ('.date('d-m-Y',strtotime($inventory->creation_date)).') ';?></option>
											<?php }  ?>
										</select>
									</div>
								</div>
								<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
									<!-- Hidden field PRODUCT ID used later when saving data -->
									<input type="hidden" class="form-control" name="editPhysQtyProductId" id="editPhysQtyProductId" value=""  READONLY>
									<!-- other fields -->
									<div class="form-group">
										<label ><?php echo $this->lang->line('product'); ?></label>
										<input type="text" class="form-control" name="editPhysQtyProductName" id="editPhysQtyProductName" value=""  READONLY>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
									<div class="form-group">
										<label ><?php echo $this->lang->line('barcode'); ?></label>
										<input type="text" class="form-control" name="editPhysQtyProductBarcode" id="editPhysQtyProductBarcode" value=""  READONLY>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label ><?php echo $this->lang->line('stock'); ?></label>
										<input type="text" class="form-control" name="editPhysQtyStock" id="editPhysQtyStock" value=""  READONLY>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group">
										<label ><?php echo $this->lang->line('physical_inventory'); ?></label>
										<input type="number" min="0" step="0.01" class="form-control" name="editPhysQtyPhysQty" id="editPhysQtyPhysQty" value=""  REQUIRED>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $this->lang->line('close'); ?></button>
							<button type="button" class="btn btn-primary" id="editPhysQtyUpdate"><i class="fa fa-refresh"></i> <?php echo $this->lang->line('update'); ?></button>
						</div>
					</div>
				</div>
			</div>
			
	