			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('customers'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>customers/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_customer'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_customer'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>customers/orders" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_orders'); ?>">
											<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('customer_orders'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>customers/deliveries" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_deliveries'); ?>">
											<span class="range-text"> <i class="fa fa-arrows-alt"></i> <?php echo $this->lang->line('customer_deliveries'); ?></span>
										</a>
									</li>	
									<li>
										<a href="<?php echo base_url();?>deliveries/returns" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('customer_returns'); ?>">
											<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('customer_returns'); ?></span>
										</a>
									</li>
								</ul>
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('customerblocked'); ?>
									
									<table id="fixedHeader" class="table custom-table customerTable txtTable">
										<thead>
											<tr>
												<th><?php echo $this->lang->line('code'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('business_title'); ?></th>
												<th><?php echo $this->lang->line('address'); ?></th>
												<th><?php echo $this->lang->line('phone'); ?></th>
												<th><?php echo $this->lang->line('email'); ?></th>
												<th><?php echo $this->lang->line('price_level'); ?></th>
												<th><?php echo $this->lang->line('status'); ?></th>
												<th ><?php echo $this->lang->line('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($customers) {
													foreach ($customers as $customer) { 
													$ct++;
													$customerPriceLevel = $this->global_model->getItem('price_levels', 'id', $customer->price_level, 'name');
											?>
											<tr>
												<td><?php echo $customer->client_code;?></td>
												<td><?php echo $customer->full_name;?></td>
												<td><?php echo $customer->business_title;?></td>
												<td><?php echo $customer->address;?></td>
												<td><?php echo $customer->phone;?></td>
												<td><?php echo $customer->email;?></td>
												<td><?php echo $customerPriceLevel;?></td>
												<td><?php echo ($customer->status==1) ? 'active' : 'inactive';?></td>
												<td class="btn-group">
													<form method="post" action="<?php echo base_url();?>customer/edit">
													<input type="hidden" name="customers_custId" id="customers_custId<?php echo $ct;?>" value="<?php echo $customer->client_id;?>">
													<button type="submit" class="btn btn-sm btn-primary mr-1" title="<?php echo $this->lang->line('edit_customer'); ?>"><i class="fa fa-edit"></i></button>
													</form>
													<!-- IF CUSTOMER STATUS =1 => DISPLAY BUTTON TO ACTIVATE -->
													<?php if ($customer->status==1) { ?>
													<button type="button" name="deactivateCustomer" id="deactivateCustomer" class="btn btn-sm btn-success cust_action" title="<?php echo $this->lang->line('deactivate_customer'); ?>"><i class="fa fa-toggle-on"></i></button>
													<?php } else { ?>
													<button type="button" name="deactivateCustomer" id="deactivateCustomer" class="btn btn-sm btn-danger cust_action" title="<?php echo $this->lang->line('activate_customer'); ?>"><i class="fa fa-toggle-off"></i></button>
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
	