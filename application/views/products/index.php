			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('products'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info small">
									<li>
										<a href="<?php echo base_url();?>products/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_product'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_product'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>products/alert" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('products_stock_alert'); ?>">
											<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('products_stock_alert'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>products/oos" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('products_out_of_alert'); ?>">
											<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('products_out_of_alert'); ?></span>
										</a>
									</li>
									
									<li>
										<a href="<?php echo base_url();?>categories" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('categories'); ?>">
											<span class="range-text"> <i class="fa fa-th-list"></i> <?php echo $this->lang->line('categories'); ?></span>
										</a>
									</li>	
									
									
								</ul>
								<div class="table-responsive txtTable">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('prodnotexist'); ?>
									<?php echo $this->session->flashdata('productblocked'); ?>
									<table id="fixedHeader" class="table custom-table productTable">
										<thead>
											<tr>
												
												<th><?php echo $this->lang->line('picture'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('category'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock_alert'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('cost_price'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('selling_price'); ?></th>
												<th ><?php echo $this->lang->line('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($products) {
												foreach ($products as $product) { 
													$ct++;
													$units = $product->alert_units;
													$costPrice = $this->global_model->getItem('price', 'product_id', $product->product_id, 'cost');
													$sellingPrice = $this->global_model->getItem('price', 'product_id', $product->product_id, 'selling_price');
													$productWarehouse = $this->global_model->getItem('products', 'product_id', $product->product_id, 'warehouse_id');
												
											?>
											<tr>
												<td >
												<?php 
													if ($product->product_picture) 
													{ 
														echo '<div class="row-img"><img src="'.base_url().'uploads/pictures/products/'.$product->product_picture.'" class="img-fluid" alt="'.$product->product_name.'"></div>';
													} else {
														echo '<div class="row-img"><img src="'.base_url().'uploads/pictures/products/avatar.png" class="img-fluid" alt="'.$product->product_name.'"></div>';
													}															 
												?>
												</td>
												<td>
													<span class="mt-0 mb-1"><b><?php echo $product->product_name; ?></b></span>
													<p class="m-0 font-size-14"><i><?php echo $product->product_barcode; ?></i></p>
												</td>
												<td><?php echo $this->global_model->getItem('product_categories', 'category_id', $product->category_id, 'category_name');?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($units).' '.$this->global_model->getItem('measuring_units', 'id',$product->product_unit,'code');?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($costPrice);?></td>
												<td class="text-right"><?php echo $this->global_model->setNumberFormat($sellingPrice);?></td>
												<td class="btn-group">
													<?php if ($productWarehouse == $this->session->userdata('warehouseid')) { ?>
														<a href="<?php echo base_url();?>products/dimensions" class="btn btn-sm btn-info mr-1" title="<?php echo $this->lang->line('product_dimensions'); ?>"><i class="fa fa-cube"></i></a>
														<a href="<?php echo base_url();?>products/edit/<?php echo $product->product_id;?>" class="btn btn-sm btn-primary mr-1" title="<?php echo $this->lang->line('edit_product'); ?>"><i class="fa fa-edit"></i></a>
														<input type="hidden" name="action_productId" id="action_productId<?php echo $ct;?>" class="praction" value="<?php echo $product->product_id;?>" />
														<!-- IF PRODUCT STATUS =1 => DISPLAY BUTTON TO ACTIVATE -->
														<?php if ($product->status==1) { ?>
														<button type="button" name="deactivateProduct" id="deactivateProduct" class="btn btn-sm btn-success pr_action" title="<?php echo $this->lang->line('deactivate_product'); ?>"><i class="fa fa-toggle-on"></i></button>
														<?php } else { ?>
														<button type="button" name="deactivateProduct" id="deactivateProduct" class="btn btn-sm btn-danger pr_action" title="<?php echo $this->lang->line('activate_product'); ?>"><i class="fa fa-toggle-off"></i></button>
														<?php } ?>
													<?php } else { ?>
														<a href="<?php echo base_url();?>products/proddimensions" class="btn btn-sm btn-info mr-1" title="<?php echo $this->lang->line('product_dimensions'); ?>"><i class="fa fa-cube"></i></a>
														<a href="" class="btn btn-sm btn-primary mr-1 disabled" title="<?php echo $this->lang->line('edit_product'); ?>"><i class="fa fa-edit"></i></a>
														<input type="hidden" name="action_productId" id="action_productId<?php echo $ct;?>" class="praction" value="<?php echo $product->product_id;?>" />
														<!-- IF PRODUCT STATUS =1 => DISPLAY BUTTON TO ACTIVATE -->
														<?php if ($product->status==1) { ?>
														<button type="button" disabled name="deactivateProduct" id="deactivateProduct" class="btn btn-sm btn-success pr_action " title="<?php echo $this->lang->line('deactivate_product'); ?>"><i class="fa fa-toggle-on"></i></button>
														<?php } else { ?>
														<button type="button" disabled name="deactivateProduct" id="deactivateProduct" class="btn btn-sm btn-danger pr_action disabled" title="<?php echo $this->lang->line('activate_product'); ?>"><i class="fa fa-toggle-off"></i></button>
														<?php } ?>
													<?php } ?>
													
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
	