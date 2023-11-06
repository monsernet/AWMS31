			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('receivings'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_receiving'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** ORDER DATA **/
						//SET THE LPO CODE /** You can change it as you like **/
						$rcCode = 'RC-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('receivings', 'id'))+1), - 4).'-'.date('y');
						//SET Receiving date
						$month = date('m');
						$day = date('d');
						$year = date('Y');
						$today = $year . '-' . $month . '-' . $day;
						
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('purchases/savereceiving');?>">
								<div class="row">
								
								<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="rcPoId" value="<?php echo $poRow->id;?>" />
														<input type="hidden" name="rcLPOId" value="<?php echo $poRow->lpo_id;?>" />
														<input type="text" class="form-control" name="rcCode" id="rcCode" value="<?php echo $rcCode; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="date" class="form-control" name="rcDate" id="rcDate" value="<?php echo $today;?>"  >
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('warehouse'); ?></label>
														<input type="hidden" name="rcWarehouseId" value="<?php echo $poRow->warehouse_id;?>" />
														<input type="text" class="form-control" name="rcWarehouseName" id="rcWarehouseName" value="<?php echo $this->global_model->getItem('warehouses', 'id', $poRow->warehouse_id, 'warehouseName')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('supplier'); ?></label>
														<input type="hidden" name="rcSupplierId" value="<?php echo $poRow->supplier_id;?>" />
														<input type="text" class="form-control" name="rcSupplierName" id="rcSupplierName" value="<?php echo $this->global_model->getItem('suppliers', 'supplier_id', $poRow->supplier_id, 'full_name')  ?>"  READONLY>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table small" id="rcProductList" width="100%">
															<thead>
																<th width="20%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="25%"><?php echo $this->lang->line('name'); ?></th>
																<th width="15%"><?php echo $this->lang->line('po_qty'); ?></th>
																<th width="20%"><?php echo $this->lang->line('qty_received'); ?></th>
																<th width="20%"><?php echo $this->lang->line('qty_damaged'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($poDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="rcPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="poQty[]" value="'.$detail->qty.'" />'.number_format($detail->qty,2).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	echo '<td><input type="number" class="form-control control-sm " name="rcQty[]" value="'.$detail->qty.'"  REQUIRED /></td>';
																	echo '<td><input type="number" class="form-control control-sm " name="damQty[]" value="0"  REQUIRED /></td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="saveRC" id="saveRC" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-save"></i> <?php echo $this->lang->line('save_receiving'); ?></button>
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
				
	