			
			<div class="main-container" >
				<?php
					$delivDate = $deliveryRow->datetime;
					$packingListCode = idate('Y',strtotime($delivDate)).idate('d',strtotime($delivDate)).idate('m',strtotime($delivDate)).idate('z', strtotime($delivDate)).substr(str_repeat(0, 3).(intval($this->global_model->getLastId('deliveries', 'delivery_id'))+1), - 3);
					$warhId = $this->session->userdata('warehouseid');
					$deliveryDate= $this->global_model->setDateFormat($delivDate, $this->global_model->getItem('settings', 'warehouseId',$warhId , 'dateFormat'));
				?>
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body p-2">
								<div class="invoice-container">
									<div class="row gutters" id="noPrintPackingList">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="custom-actions-btns mb-5">
													<a href="#" class="btn btn-primary">
														<i class="icon-export"></i> <?php echo $this->lang->line('export_pdf'); ?>
													</a>
													<a href="#" onClick="printPackingList()" class="btn btn-dark">
														<i class="icon-printer"></i> <?php echo $this->lang->line('print'); ?>
													</a>
												</div>
											</div>
									</div>
									<div class="invoice-header">
										
										
											<div class="row gutters">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
													
														<img alt="<?php echo $this->lang->line('packing_slip'); ?>" src="<?php echo base_url();?>assets/barcode/barcode.php?codetype=Code128&size=50&text=<?php echo $packingListCode;?>&print=true"/>
													
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6">
													<address class="text-right">
														<b><?php echo $companyRow->companyName; ?></b><br>
														<?php echo $companyRow->companyAddress; ?><br>
														<?php echo $companyRow->companyPhone; ?><br>
														<?php echo $companyRow->companyEmail; ?>
													</address>
												</div>
											</div>
											<!-- Row end -->

											<!-- Row start -->
											<div class="row gutters">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 text-left">
													<div class="doc-block">
														<address>
															<b><?php echo $this->lang->line('customer_details'); ?></b><br>
															<?php echo $this->global_model->getItem('clients', 'client_id',$deliveryRow->client_id , 'full_name'); ?><br>
															<?php echo $this->global_model->getItem('clients', 'client_id',$deliveryRow->client_id , 'shippingAddress'); ?><br>
															<?php echo $this->global_model->getItem('clients', 'client_id',$deliveryRow->client_id , 'phone'); ?><br>
															<?php echo $this->global_model->getItem('clients', 'client_id',$deliveryRow->client_id , 'email'); ?><br>
														</address>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
													<div class="doc-block text-right">
														<div class="invoice-num">
															<div><b><?php echo $this->lang->line('packing_slip_details'); ?></b><br></div>
															<div><?php echo $this->lang->line('packing_slip'); ?>: <?php echo $packingListCode ;?></div>
															<div><?php echo $this->lang->line('delivery_note'); ?>: <?php echo $deliveryRow->delivery_code ;?><hr/></div>
															
															<div><?php echo $this->lang->line('printing_date'); ?>: <?php echo date('d-m-y h:i:s')  ;?></div>
														</div>
													</div>													
												</div>
											</div>
											<!-- Row end -->

										</div>

										<div class="invoice-body">

											<!-- Row start -->
											<div class="row gutters">
												<div class="col-lg-12 col-md-12 col-sm-12">
													<div class="table-responsive">
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th width="50%"><?php echo $this->lang->line('product'); ?></th>
																	<th class="text-right"><?php echo $this->lang->line('qty'); ?></th>
																	<th class="text-right"><?php echo $this->lang->line('volume'); ?></th>
																	<th class="text-right"><?php echo $this->lang->line('weight'); ?></th>
																	<th class="text-right"><?php echo $this->lang->line('nb_boxes'); ?></th>
																</tr>
															</thead>
															<tbody>
															<?php foreach ($deliveryDetails as $detail) { ?>
																<tr>
																<td>
																	<?php echo $this->global_model->getItem('products', 'product_id',$detail->product_id , 'product_name'); ?> 
																	<p class="m-0 text-muted">
																		<?php echo $this->global_model->getItem('products', 'product_id',$detail->product_id , 'product_barcode'); ?> 
																	</p>
																</td>
																<td class="text-right"><?php echo $this->global_model->setNumberFormat($detail->qty).' '.$this->global_model->getProductUnit($detail->product_id); ?> </td>
																<td class="text-right"><?php echo $this->global_model->setNumberFormat($detail->volume).' '.$this->lang->line('cubic_meter'); ?> </td>
																<td class="text-right"><?php echo $this->global_model->setNumberFormat($detail->weight).' '.$this->lang->line('kg'); ?> </td>
																<td class="text-right"><?php echo $this->global_model->setNumberFormat($this->delivery_model->getProductPackBoxes ($detail->product_id, $deliveryRow->delivery_id)).' '.$this->lang->line('box');?></td>
																</tr>
															<?php }?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<!-- Row end -->

										</div>

										<div class="invoice-footer">
											<?php echo $this->lang->line('this');?><?php echo $this->lang->line('packing_slip');?><?php echo $this->lang->line('generated_automatically'); ?>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Row end -->

			</div>
			
			
			
	