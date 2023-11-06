<?php 
//CHECK IF COMPANY SETTINGS ARE ALREADY EXIST
if(intval($this->global_model->countItems('companysettings')) == 0) {
	// if no settings  -> redirect to company settings page 
	redirect('company/settings');
}

?>

			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('select_warehouse'); ?></li>
				</ol>	
			</div>
			
			<div class="main-container">
				<div class="row gutters ml-2">
					
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-header">
								<!-- Page Title -->
								<div class="card-title"><?php echo $this->lang->line('select_warehouse'); ?></div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<ul class="top-icons pull-right text-info">
										<li>
											<a href="<?php echo base_url();?>warehouses/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_warehouse'); ?>">
												<span class="range-text"> <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('add_new_warehouse'); ?></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php 
											echo $this->session->flashdata('addWarhError');
											echo $this->session->flashdata('companyAlreadyExist');
											echo $this->session->flashdata('addCompanysuccess');
											echo $this->session->flashdata('addCompanyError');
									?>
								</div>
							</div>
							<div class="card-body ml-3">
								<div class="documentsContainerScroll">
									<div class="documents-body">
										<div class="row gutters ml-4">
											<!-- List of warehouses -->
											<?php 
											if($warehouses) {
												foreach($warehouses as $wrh) { 
											?>
											<div class="col-12 col-sm-6 col-md-3">
												<div class="front">
													<div class="card">
														<div class="card-body text-center pb-2">
															<p><img class="rounded-circle" src="<?php echo base_url();?>assets/img/logo2.png" alt="MWH-WMS"></p>
															<h5 class="card-title"><strong><?php echo $wrh->warehouseName; ?></strong></h5>
															<p class="card-text"><?php echo $wrh->address; ?> - <?php echo $wrh->city; ?> - <?php echo $wrh->country; ?><br/>tel: <?php echo $wrh->contact; ?></p>
															<form class="form-horizontal" action="<?php echo base_url(); ?>warehouse" method="post">
																<input type="hidden" name="warhId" value="<?php echo $wrh->id; ?>">
																<button class="btn btn-primary"><span class="icon-arrow-right-circle"></span> <?php echo $this->lang->line('select_warehouse'); ?></span></button>
															</form>
														</div>
													</div>
												</div>
											</div>
											<?php 
											}
											} else {
												echo '<div class="text-danger"><p class="text-center"><h6><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('no_warehouses_found').'<a href="'.base_url().'warehouses/new" title="'.$this->lang->line('new_warehouse').'">'.$this->lang->line('new_warehouse').'</a></h6></p></div>'; 
											}
											
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

		