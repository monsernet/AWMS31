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
										<a href="<?php echo base_url();?>products" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('all_products'); ?>">
											<span class="range-text"> <i class="fa fa-barcode"></i> <?php echo $this->lang->line('all_products'); ?></span>
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
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('prodnotexist'); ?>
									<table id="fixedHeader" class="table custom-table txtTable">
										<thead>
											<tr>
												<th><?php echo $this->lang->line('barcode'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('category'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock_alert'); ?></th>
												<th class="text-right"><?php echo $this->lang->line('stock'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php echo $this->product_model->alertItemList( $this->session->userdata('warehouseid'));?>
										</tbody>
									</table>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
	