			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('deliveries'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('delivery_note'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
						<?php
						/*** DELIVERY DATA **/
						//SET THE DELIVERY CODE /** You can change it as you like **/
						$deliveryCode = 'DLN-'.substr(str_repeat(0, 4).(intval($this->global_model->getLastId('deliveries', 'delivery_id'))+1), - 4).'-'.date('y');
						//SET FORMATTED date
						$todayDate = date("Y/m/d");
						$deliveryDate = $this->global_model->setDateFormat($todayDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						$custOrderDate = $this->global_model->setDateFormat($orderRow->datetime, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						if($orderRow->limited_period == 1) {
							$deliveryBeforeDate = $this->global_model->setDateFormat($orderRow->delivery_limit, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
						} else {
							$deliveryBeforeDate ='NA';
						}
						?>
						<div class="card">
							<div class="card-body">
								<form method="post" action="<?php echo base_url('deliveries/savedeliverynote');?>">
								<div class="row">
								
								<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="card">
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('delivery_code'); ?></label>
														<input type="hidden" name="copId" value="<?php echo $orderRow->order_id;?>" />
														<input type="text" class="form-control" name="deliveryCode" id="deliveryCode" value="<?php echo $deliveryCode; ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('date'); ?></label>
														<input type="text" class="form-control" name="deliveryDate" id="deliveryDate" value="<?php echo $deliveryDate?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('from_warehouse'); ?></label>
														<input type="hidden" name="deliveryWarehouseId" value="<?php echo $orderRow->warehouse_id;?>" />
														<input type="text" class="form-control" name="deliveryWarehouseName" id="deliveryWarehouseName" value="<?php echo $this->global_model->getItem('warehouses', 'id', $orderRow->warehouse_id, 'warehouseName')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('customer'); ?></label>
														<input type="hidden" name="deliverySupplierId" value="<?php echo $orderRow->client_id;?>" />
														<input type="text" class="form-control" name="deliverySupplierName" id="deliverySupplierName" value="<?php echo $this->global_model->getItem('clients', 'client_id', $orderRow->client_id, 'full_name')  ?>"  READONLY>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('customer_order'); ?></label>
														<input type="hidden" name="deliveryCustOrderId" value="<?php echo $orderRow->order_id;?>" />
														<input type="text" class="form-control" name="deliveryCustOrderCode" id="deliveryCustOrderCode" value="<?php echo $orderRow->order_code;?>" READONLY  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('order_date'); ?></label>
														<input type="text" class="form-control" name="customerOrderDate" id="customerOrderDate" value="<?php echo $custOrderDate;?>" READONLY  >
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('delivery_before'); ?></label>
														<input type="text" class="form-control" name="deliveryDeliveryDate" id="deliveryDeliveryDate" value="<?php echo $deliveryBeforeDate;?>" READONLY  >
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
																<th width="32%"><?php echo $this->lang->line('name'); ?></th>
																<th width="18%"><?php echo $this->lang->line('cpo_qty'); ?></th>
																<th width="25%"><?php echo $this->lang->line('qty_approved'); ?></th>
															</thead>
															<tbody>
															<?php 
																$ct=0;
																foreach ($orderDetails as $detail) { 
																	$ct++;
																	echo '<tr>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="cpoPrId[]" value="'.$detail->product_id.'" />'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_barcode').'</td>';
																	echo '<td>'.$this->global_model->getItem('products', 'product_id', $detail->product_id, 'product_name').'</td>';
																	echo '<td><input type="hidden" class="form-control control-sm " name="cpoQty[]" value="'.$detail->qty.'" />'.$this->global_model->setNumberFormat($detail->qty).' '.$this->global_model->getProductUnit($detail->product_id).'</td>';
																	echo '<td><input type="number" class="form-control control-sm " name="apprQty[]" value="'.$detail->qty.'"  REQUIRED /></td>';
																	echo '</tr>';
																}
															?>
															</tbody>
														</table>
														
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
													<button type="submit" name="savedeliveryNote" id="savedeliveryNote" class="btn btn-primary col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-save"></i> <?php echo $this->lang->line('save_deliverynote'); ?></button>
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
				
	