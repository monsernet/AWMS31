			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('purchases'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('purchasing_order'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** ORDER DATA **/
						//SET THE LPO CODE /** You can change it as you like **/
						$orderCode = 'PO-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('po', 'id'))+1), - 4).'-'.date('y');
						//SET FORMATTED date
						$todayDate = date("Y/m/d");
						$orderDate= $this->global_model->setDateFormat($todayDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('purchases/saveorder');?>">
								<div class="row">
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('code'); ?></label>
														<input type="hidden" name="polpoId" value="<?php echo $lpoRow->order_id;?>" />
														<input type="text" class="form-control" name="poOrderCode" id="poOrderCode" value="<?php echo $orderCode; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="text" class="form-control" name="poOrderDate" id="poOrderDate" value="<?php echo $orderDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('warehouse'); ?></label>
														<input type="hidden" name="poWarehouseId" value="<?php echo $lpoRow->warehouse_id;?>" />
														<input type="text" class="form-control" name="poWarehouseName" id="poWarehouseName" value="<?php echo $this->global_model->getItem('warehouses', 'id', $lpoRow->warehouse_id, 'warehouseName')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('supplier'); ?></label>
														<input type="hidden" name="poSupplierId" value="<?php echo $lpoRow->supplier_id;?>" />
														<input type="text" class="form-control" name="poSupplierName" id="poSupplierName" value="<?php echo $this->global_model->getItem('suppliers', 'supplier_id', $lpoRow->supplier_id, 'full_name')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('quotation'); ?></label>
														<input type="text" class="form-control" name="poQuotation" id="poQuotation" value=""  >
													</div>
												</div>
												
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('delivery_before'); ?></label>
														<input type="date" class="form-control" name="poDeliveryDate" id="poDeliveryDate" value="" REQUIRED  >
													</div>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="table-responsive">
														<table class="table custom-table small" id="orderProductList" width="100%">
															<thead>
																<th width="25%"><?php echo $this->lang->line('barcode'); ?></th>
																<th width="35%"><?php echo $this->lang->line('name'); ?></th>
																<th width="15%"><?php echo $this->lang->line('lpo_qty'); ?></th>
																<th width="25%"><?php echo $this->lang->line('order_qty'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($lpoDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="orderPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="lpoQty[]" value="'.$detail->qty.'" />'.number_format($detail->qty,2).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	echo '<td><input type="number" class="form-control control-sm " name="orderQty[]" value="'.$detail->qty.'"  REQUIRED /></td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="saveOrder" id="saveOrder" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-save"></i> <?php echo $this->lang->line('save_order'); ?></button>
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
				
	