			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('receivings'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('store_receiving'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row card">
					<div class="card-body">
						
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<?php 
									
									
									
									/*** TRANSFER DATE FORMAT **/
										$rcDate = $receivingRow->datetime;
										$receivingDate= $this->global_model->setDateFormat($rcDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
										$recLPO = $receivingRow->lpo_id;
										$recPO = $receivingRow->po_id;
								?>
										
								<div class="card m-2">
									<div class="card-body border border-gray">
										<form method="post" action="<?php echo base_url('order/saveReceivingStorage');?>">
										<div class="row">
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('code'); ?></label>
													<input type="hidden"  name="recReceivingId" id="recReceivingId" value="<?php echo $receivingRow->id; ?>" class="form-control control-sm">
													<input type="text"  name="recCode" id="recCode" value="<?php echo $receivingRow->rc_code; ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('date'); ?></label>
													<input type="text"  name="recDate" id="recDate" value="<?php echo $receivingDate; ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('local_purchasing_order'); ?></label>
													<input type="text"  name="recLPO" id="recLPO" value="<?php echo $this->global_model->getItem('orders', 'order_id', $receivingRow->lpo_id, 'order_code'); ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('purchasing_order'); ?></label>
													<input type="hidden"  name="recPOId" id="recPOId" value="<?php echo $receivingRow->po_id; ?>" class="form-control control-sm">
													<input type="text"  name="recPO" id="recPO" value="<?php echo $this->global_model->getItem('po', 'id', $receivingRow->po_id, 'po_code'); ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('warehouse'); ?></label>
													<input type="text"  name="rcwarehouseName" id="rcwarehouseName" value="<?php echo $this->global_model->getItem('warehouses', 'id', $receivingRow->warehouse_id, 'warehouseName');  ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('supplier'); ?></label>
													<input type="text"  name="rcSupplierName" id="rcSupplierName" value="<?php echo $this->global_model->getItem('suppliers', 'supplier_id', $receivingRow->supplier_id, 'full_name') ; ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('select_product'); ?></label>
													<div class="d-flex">
														<select class="form-control select2"  name="rcProduct" id="rcProduct" REQUIRED>
															<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
															<?php foreach ($receivingDetails as $detail) { 
																	$productName = $this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name');
																	$productBarcode = $this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode');
																	echo '<option value="'.$detail->product_id.'">'.$productName.' <small>('.$productBarcode.')</small></option>';
															 } ?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('qty'); ?></label>
													<input type="text"  name="rcPrQty" id="rcPrQty" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('volume').' ('.$this->lang->line('cubic_meter').')'; ?></label>
													<input type="text"  name="rcPrVolume" id="rcPrVolume" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('required_shelves'); ?></label>
													<input type="text"  name="rcPrShelves" id="rcPrShelves" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
										</div>
										
										<div class="row">
											<?php 
												$nbAsiles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
												$nbRacksPerLine = intval($this->warehouse_model->nb_racks_per_line ($this->session->userdata('warehouseid')));
											?>	
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 " id="storeReceivingBloc">
												<?php
													$warehouseId = $this->session->userdata('warehouseid');
													$volume = $this->storage_model->max_shelf_volume ($warehouseId);
													//echo $volume;
												?>
												<div class="row m-2">
													<button class="btn btn-secondary div-hidden" id="receivingLocationsButton" type="button" data-toggle="collapse" data-target="#receivingLocations" aria-expanded="false" aria-controls="receivingLocations" >
														<?php echo $this->lang->line('storage_details_button'); ?>
													</button>
												</div>
												<div class="row collapse" id="receivingLocations">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="row table-responsive">
															<table class="table" id="receivingLocationsTable" width="100%">
																<thead class="thead-light">
																	<th class="w-25"><?php echo $this->lang->line('volume').' ('.$this->lang->line('cubic_meter').')'; ?></th>
																	<th class="w-25"><?php echo $this->lang->line('row_no'); ?></th>
																	<th class="w-25"><?php echo $this->lang->line('line_no'); ?></th>
																	<th class="w-25"><?php echo $this->lang->line('shelf_no'); ?></th>
																</thead>
																<tbody>
																						
																</tbody>
															</table>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  justify-content-center">
														<button type="submit" name="saveReceivingLocations" id="saveReceivingLocations" class="btn btn-primary div-hidden col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_storage_locations'); ?></button>
													</div>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>
						
					</div>
				</div>
			</div>
				
	