			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('transfers_received'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('store_reception'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row card">
					<div class="card-body">
						
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<?php 
									if ($this->session->flashdata('addStockSuccess')){
										echo $this->session->flashdata('addStockSuccess');
									}
									if ($this->session->flashdata('addStockWarning')){
										echo $this->session->flashdata('addStockWarning');
									}
									if ($this->session->flashdata('addStockError')){
										echo $this->session->flashdata('addStockError');
									}
									$data='';
									if($this->session->flashdata('data')) {
										$data = $this->session->flashdata('data');
									}
									/*** TRANSFER DATE FORMAT **/
										$trDate = $transferRow->datetime;
										$transferDate= $this->global_model->setDateFormat($trDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
								?>
										
								<div class="card m-2">
									<div class="card-body border border-gray">
										<form method="post" action="<?php echo base_url('transfer/saveReceptionStorage');?>">
										<div class="row">
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('code'); ?></label>
													<input type="hidden"  name="receptionTrId" id="receptionTrId" value="<?php echo $transferRow->transfer_id; ?>" class="form-control control-sm">
													<input type="text"  name="receptionTrCode" id="receptionTrCode" value="<?php echo $transferRow->transfer_code; ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('date'); ?></label>
													<input type="text"  name="receptionTrDate" id="receptionTrDate" value="<?php echo $transferDate; ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
													<input type="text"  name="receptionTrFromWarehouse" id="receptionTrFromWarehouse" value="<?php echo $this->global_model->getItem('warehouses', 'id', $transferRow->warehouse_id, 'warehouseName')  ?>" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('select_product'); ?></label>
													<div class="d-flex">
														<select class="form-control select2"  name="receptionTrProduct" id="receptionTrProduct" REQUIRED>
															<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
															<?php foreach ($transferDetails as $detail) { 
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
													<input type="text"  name="receptionTrPrQty" id="receptionTrPrQty" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('volume').' ('.$this->lang->line('cubic_meter').')'; ?></label>
													<input type="text"  name="receptionTrPrVolume" id="receptionTrPrVolume" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
											<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
												<div class="form-group">
													<label ><?php echo $this->lang->line('required_shelves'); ?></label>
													<input type="text"  name="receptionTrPrShelves" id="receptionTrPrShelves" value="" class="form-control control-sm" placeholder="" READONLY>
												</div>
											</div>
										</div>
										
										<div class="row">
											<?php 
												$nbAsiles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
												$nbRacksPerLine = intval($this->warehouse_model->nb_racks_per_line ($this->session->userdata('warehouseid')));
											?>	
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 " id="storeReceptionBloc">
												<?php
													$warehouseId = $this->session->userdata('warehouseid');
													$volume = $this->storage_model->max_shelf_volume ($warehouseId);
													//echo $volume;
												?>
												<div class="row m-2">
													<button class="btn btn-secondary div-hidden" id="receptionLocationsButton" type="button" data-toggle="collapse" data-target="#receptionLocations" aria-expanded="false" aria-controls="receptionLocations" >
														<?php echo $this->lang->line('storage_details_button'); ?>
													</button>
												</div>
												<div class="row collapse" id="receptionLocations">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
														<div class="row table-responsive">
															<table class="table" id="receptionLocationsTable" width="100%">
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
														<button type="submit" name="saveTrReceptionLocations" id="saveTrReceptionLocations" class="btn btn-primary div-hidden col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_storage_locations'); ?></button>
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
				
	