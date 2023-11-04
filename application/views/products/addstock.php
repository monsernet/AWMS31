			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('add_stock'); ?></li>
				</ol>
				
			</div>
				<div class="row m-2">
						<div class="card">
							<div class="row card-body">
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
									?>
									
									<div class="card m-2">
										<div class="card-header bg-dark opacity-3">
											<span class="card-title text-white"><?php echo $this->lang->line('select_product'); ?></span>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('barcode'); ?></label>
														<input type="text"  name="addStockBarcode" id="addStockBarcode" value="<?php if ($data){ echo $data['addStockBarcode']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('barcode'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('product'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="addStockProduct" id="addStockProduct" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
																<?php foreach ($products as $product) { 
																	if ($data){ 
																		if ($data['product_id']==$product->product_id) {
																			echo '<option value="'.$product->product_id.'" selected>'.$product->product_name.' <small>('.$product->product_barcode.')</small></option>';
																		} else {
																			echo '<option value="'.$product->product_id.'">'.$product->product_name.' <small>('.$product->product_barcode.')</small></option>';
																		}																			
																	} else {
																	?>
																<option value="<?php echo $product->product_id;?>"><?php echo $product->product_name.' <small>('.$product->product_barcode.')</small>';?></option>
																<?php } } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center text-danger" id="errorBarcode">
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php 
									$nbAsiles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
									$nbRacksPerLine = intval($this->warehouse_model->nb_racks_per_line ($this->session->userdata('warehouseid')));
								?>
								<form method="post" action="<?php echo base_url('product/saveStock');?>">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 disabled-div disabled-bloc" id="addStockBloc">
									<div class="card m-2">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('add_stock'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="date" class="form-control form-control-sm" name="addStockDate" id="addStockDate" value="<?php echo (new DateTime())->format('Y-m-d'); ?>"  REQUIRED>
													</div>
												</div>
												<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('warehouse'); ?></label>
														<select class="form-control select2" name="addStockWarehouse" id="addStockWarehouse" REQUIRED>
																
																<?php foreach ($destinations as $destination) { ?>
																<option value="<?php echo $destination->id;?>"><?php echo $destination->warehouseName;?></option>
																<?php  } ?>
															</select>
													</div>
												</div>
											</div>
											
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('barcode'); ?></label>
														<input type="text"  name="addStockBarcode1" id="addStockBarcode1" value="<?php if ($data){ echo $data['addStockBarcode']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('barcode'); ?>" READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('product'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="addStockProduct1" id="addStockProduct1" tabindex="-1" aria-hidden="true" READONLY>
																<option value=""><?php echo $this->lang->line('select_product'); ?> </option>
																<?php foreach ($products as $product) { 
																	if ($data){ 
																		if ($data['product_id']==$product->product_id) {
																			echo '<option value="'.$product->product_id.'" selected>'.$product->product_name.' <small>('.$product->product_barcode.')</small></option>';
																		} else {
																			echo '<option value="'.$product->product_id.'">'.$product->product_name.' <small>('.$product->product_barcode.')</small></option>';
																		}																			
																	} else {
																	?>
																<option value="<?php echo $product->product_id;?>"><?php echo $product->product_name.' <small>('.$product->product_barcode.')</small>';?></option>
																<?php } } ?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('current_stock'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="addStockCurrentStock" id="addStockCurrentStock" value="" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('stock'); ?>" READONLY>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('reference'); ?></label><a tabindex="0"  role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="<?php echo $this->lang->line('reference'); ?>" data-content="<?php echo $this->lang->line('addstock_reference_help'); ?>"> <i class="fa fa-question-circle text-warning" ></i></a>
													<div class="form-group">
														<input type="text"  name="addStockReference" id="addStockReference" value="<?php if ($data){ echo $data['reference']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('reference'); ?>" REQUIRED>
														
													</div>
												</div>
												<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-12">
													<label ><?php echo $this->lang->line('quantity'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="addStockQty" id="addStockQty" value="<?php if ($data){ echo $data['qty']; }?>" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('quantity'); ?>" REQUIRED>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('units'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<label class="text-danger" ><?php echo $this->lang->line('required_volume'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="addStockRequiredVolume" id="addStockRequiredVolume" value="" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('required_volume'); ?>" READONLY>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('cubic_meter'); ?></div>
														</div>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<label class="text-danger" ><?php echo $this->lang->line('required_shelves'); ?></label>
													<div class="input-group input-group-sm mb-2 mr-sm-2">
														<input type="number" min="0" step="0.01" name="addStockRequiredShelves" id="addStockRequiredShelves" value="" class="form-control form-control-sm" placeholder="<?php echo $this->lang->line('required_shelves'); ?>" READONLY>
														<div class="input-group-prepend">
															<div class="input-group-text"><?php echo $this->lang->line('shelves'); ?></div>
														</div>
													</div>
												</div>
											</div>
											
											<?php
											 $warehouseId = $this->session->userdata('warehouseid');
											$volume = $this->storage_model->max_shelf_volume ($warehouseId);
											//echo $volume;
											?>
											<div class="row m-2">
												<button class="btn btn-secondary div-hidden" id="addStockLocationsButton" type="button" data-toggle="collapse" data-target="#stockLocations" aria-expanded="false" aria-controls="stockLocations" >
													<?php echo $this->lang->line('storage_details_button'); ?>
												</button>
											</div>
											<div class="row collapse" id="stockLocations">
												
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="row table-responsive">
														<table class="table txtTable" id="addStockLocationsTable" width="100%">
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
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 scrolling-wrapper">
													<!--############ WAREHOUSE LAYOUT -->
													<div class="card h-250">
														<div class="card-body scrolling-wrapper flex-row flex-nowrap">
															<!-- AISLE LAYOUT -->
															<table  width="100%" id="AsileLayoutTable"  >
															<tr>
																<?php 
																// specify the asile line numbers
																$asileArr = array();
																for($i=1;$i<($nbAsiles*3);$i++) {
																	array_push($asileArr, $i);
																	$i+=2;
																}
																$max_rack_volume = floatval($this->storage_model->max_rack_volume ($this->session->userdata('warehouseid')));
																$c=0;
																echo '<th></th>';
																for($i=0;$i<($nbAsiles*3);$i++) {
																	if (in_array(($i), $asileArr)){
																		echo '<th></th>';
																	} else {
																		$c++;
																		echo '<th class="small text-primary text-center">L'.$c.'</th>';
																	}
																}
																	?>
															</tr>
															
															<?php 
															
															
															for ($i=$nbRacksPerLine;$i>0;$i--) {
																echo '<tr>';
																echo '<td ><div class="asile text-center text-primary" >R'.$i.'</div></td>';
																$c=0;
																for($j=1;$j<=($nbAsiles*3);$j++) {
																	$rack_volume = $this->storage_model->rack_volume ($i, $j);
																	if($max_rack_volume>0) {
																		$occupancy = $rack_volume*100/$max_rack_volume;
																	} else {
																		$occupancy = 0;
																	}
																	
																	if (in_array(($j-1), $asileArr)){
																		
																		if($i==3 OR $i==9){
																			echo '<td id="cell'.$i.'_'.$j.'"><div class="asile text-center text-danger" ><i class="fa fa-long-arrow-up" aria-hidden="true"></i></div></td>';
																		} else {
																			echo '<td id="cell'.$i.'_'.$j.'"><div class="asile" >&nbsp;</div></td>';
																		}
																		
																	} else {
																		//echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack border border-primary">&nbsp;</div></td>';
																		$c++;
																		if($rack_volume ==0) {
																			echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack border border-primary" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="Rack# W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="Warehouse:  <b>'.$this->session->userdata('warehouseid').'</b><br>Rack Row: <b>'.$i.'</b><br>Rack Line: <b>'.$c.'</b><br>Rack Total Volume: <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>Rack Occupied Volume: <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>Rack Occupancy Rate : <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
																		} elseif ($rack_volume < ($max_rack_volume * 0.7)) {
																			echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack rack-notfull" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="Rack# W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="Warehouse:  <b>'.$this->session->userdata('warehouseid').'</b><br>Rack Row: <b>'.$i.'</b><br>Rack Line: <b>'.$c.'</b><br>Rack Total Volume: <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>Rack Occupied Volume: <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>Rack Occupancy Rate : <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
																		} else {
																			echo '<td id="cell'.$i.'_'.$j.'"><div class="divRack rack-full" tabindex="0"  role="button" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="bottom" title="Rack# W'.$this->session->userdata('warehouseid').'R'.$i.'L'.$c.'" data-content="Warehouse:  <b>'.$this->session->userdata('warehouseid').'</b><br>Rack Row: <b>'.$i.'</b><br>Rack Line: <b>'.$c.'</b><br>Rack Total Volume: <b>'.number_format($max_rack_volume,2).' m<sup>3</sup></b><br>Rack Occupied Volume: <b>'.number_format($rack_volume,2).' m<sup>3</sup></b><br/>Rack Occupancy Rate : <b>'.number_format($occupancy,2).' %</b>" >&nbsp;</div></td>';
																		}
																	}
																}
																echo '</tr>';
															}
															?>
															</table>
															
															<div id="tableAux">
																<table width="100%">
																	<tr>
																	<?php
																	$aisle_no=0;
																	echo '<td><div class="asile text-center text-danger" ><br/></div></td>';
																	for($i=0;$i<($nbAsiles*3);$i++) {
																		if($i==0 ) {
																			echo '<td><div class="divRack text-center text-danger" ><br/><i class="fa fa-long-arrow-right" aria-hidden="true"></i></div></td>';
																		} elseif (in_array(($i), $asileArr)){
																			$aisle_no++;
																			echo '<td class="text-center"><div class="asile text-info small" ><i class="fa fa-long-arrow-up text-danger" aria-hidden="true"></i><br/>'.$this->lang->line('ais').$aisle_no.'</div></td>';
																		} else {
																			echo '<td><div class="divRack" ><br/></div></td>';
																		}
																	}
																	?>
																	</tr>
																</table>
															</div>
															<div class="row mt-3">
															<table>
																<tr>
																	<td class="divRack border border-primary p-2"></td>
																	<td><div class="ml-2 mr-5"><?php echo $this->lang->line('empty_rack'); ?></div></td>
																	<td class="divRack rack-notfull p-2"></td>
																	<td><div class="ml-2 mr-5"><?php echo $this->lang->line('rack_not_full'); ?></div></td>
																	<td class="divRack rack-full p-2"></td>
																	<td><div class="ml-2 mr-5"><?php echo $this->lang->line('rack_full'); ?></div></td>
																	<td class=""><span class="text-info mr-2 ml-5"><?php echo $this->lang->line('ais'); ?></span>: <?php echo $this->lang->line('aisle'); ?></td>
																	<td class=""><span class="text-info mr-2 ml-5">R </span>: <?php echo $this->lang->line('row'); ?></td>
																	<td class=""><span class="text-info mr-2 ml-5">L </span>: <?php echo $this->lang->line('line'); ?></td>
																</tr>
															</table>
															</div>
														</div>
													</div>
													<!--#########END WAREHOUSE LAYOUT -->
												</div>
											</div>
										</div>
									</div>
									<?php //echo $this->product_model->addStockRacking(37.4, 7);?>
									<div class="row justify-content-center col-12">
										<button type="submit" name="saveProductStock" id="saveProductStock" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-save"></i> <?php echo $this->lang->line('save_stock'); ?></button>
									</div>
								</div>	
								</form>
							</div>
						</div>
					</div>
				
	