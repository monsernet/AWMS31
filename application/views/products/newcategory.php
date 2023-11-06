			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('products'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('categories'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_category'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row  d-flex justify-content-center">
						<div class="card">
							<div class="row card-body">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>categories" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('categories'); ?>">
											<span class="range-text"> <i class="fa fa-barcode"></i> <?php echo $this->lang->line('categories'); ?></span>
										</a>
									</li>
									
								</ul>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php 
										if ($this->session->flashdata('errors')){
											echo $this->session->flashdata('errors');
										}
										$data='';
										if($this->session->flashdata('data')) {
											$data = $this->session->flashdata('data');
										}
									?>
									<form method="post" action="<?php echo base_url('product/storecategory');?>">
									<div class="row card">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('new_category'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row justify-content-center">
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label for="categoryName"><?php echo $this->lang->line('category_name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="categoryName" id="categoryName" value="<?php if ($data){ echo $data['categoryName']; }?>" placeholder="<?php echo $this->lang->line('category_name'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('category_description'); ?></label>
														<textarea class="form-control  form-control-sm" name="categoryDescription" id="categoryDescription" placeholder="<?php echo $this->lang->line('category_description'); ?>" REQUIRED ><?php if ($data){ echo $data['categoryDescription']; }?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row justify-content-center col-12">
										<button type="submit" name="saveProductCategory" id="saveProductCategory" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12"><i class="fa fa-save"></i><?php echo $this->lang->line('save_category'); ?></button>
									</div>
									</form>
								</div>		
							</div>
						</div>
					</div>
				</div>
				
	
	