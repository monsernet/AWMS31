			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('categories'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>categories/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_category'); ?>">
											<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('new_category'); ?></span>
										</a>
									</li>
								</ul>
								<div class="table-responsive">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('catnotexist'); ?>
									<table id="fixedHeader" class="table custom-table txtTable">
										<thead>
											<tr>
												<th>#</th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th><?php echo $this->lang->line('description'); ?></th>
												<th width="20%"><?php echo $this->lang->line('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$count = 0;
											if($categories) {
												foreach ($categories as $category) { 
												$count++;
												?>
												<tr>
													<td><?php echo $count;?></td>
													<td><?php echo $category->category_name;?></td>
													<td><?php echo $category->category_description;?></td>
													<td>
														<a href="<?php echo base_url();?>categories/edit/<?php echo $category->category_id;?>" class="btn btn-sm btn-primary" title="<?php echo $this->lang->line('edit_category'); ?>"><i class="fa fa-edit"></i> <?php echo $this->lang->line('edit_category'); ?></button>
													</td>
												</tr>
												<?php }
											}												
											?>
										</tbody>
									</table>
								</div>		
							</div>
						</div>
					</div>
				</div>
			</div>
	