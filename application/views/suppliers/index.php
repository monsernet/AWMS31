			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('suppliers'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>suppliers/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_supplier'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_supplier'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>purchases/lpo" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('lpo'); ?>">
											<span class="range-text"> <i class="fa fa-minus-square"></i> <?php echo $this->lang->line('lpo'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>purchases/po" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('orders'); ?>">
											<span class="range-text"> <i class="fa fa-arrows-alt"></i> <?php echo $this->lang->line('orders'); ?></span>
										</a>
									</li>	
									<li>
										<a href="<?php echo base_url();?>purchases/receivings" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('receivings'); ?>">
											<span class="range-text"> <i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('receivings'); ?></span>
										</a>
									</li>
									
									
									
								</ul>
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('supplierblocked'); ?>
									
									<table id="fixedHeader" class="table custom-table supplierTable txtTable">
										<thead>
											<tr>
												<th><?php echo $this->lang->line('code'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('address'); ?></th>
												<th><?php echo $this->lang->line('phone'); ?></th>
												<th><?php echo $this->lang->line('email'); ?></th>
												<th><?php echo $this->lang->line('status'); ?></th>
												<th ><?php echo $this->lang->line('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($suppliers) {
													foreach ($suppliers as $supplier) { 
													$ct++;
											?>
											<tr>
												<td><?php echo $supplier->supplier_code;?></td>
												<td><?php echo $supplier->full_name;?></td>
												<td><?php echo $supplier->address;?></td>
												<td><?php echo $supplier->phone;?></td>
												<td><?php echo $supplier->email;?></td>
												<td><?php echo ($supplier->status==1) ? 'active' : 'inactive';?></td>
												<td class="btn-group">
													<form method="post" action="<?php echo base_url();?>supplier/edit">
													<input type="hidden" name="suppliers_suppId" id="suppliers_suppId<?php echo $ct;?>" value="<?php echo $supplier->supplier_id;?>">
													<button type="submit" class="btn btn-sm btn-primary mr-1" title="<?php echo $this->lang->line('edit_supplier'); ?>"><i class="fa fa-edit"></i></button>
													</form>
													<!-- IF SUPPLIER STATUS =1 => DISPLAY BUTTON TO ACTIVATE -->
													<?php if ($supplier->status==1) { ?>
													<button type="button" name="deactivateSupplier" id="deactivateSupplier" class="btn btn-sm btn-success supp_action" title="<?php echo $this->lang->line('deactivate_supplier'); ?>"><i class="fa fa-toggle-on"></i></button>
													<?php } else { ?>
													<button type="button" name="deactivateSupplier" id="deactivateSupplier" class="btn btn-sm btn-danger supp_action" title="<?php echo $this->lang->line('activate_supplier'); ?>"><i class="fa fa-toggle-off"></i></button>
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
	