			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('user'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('change_password'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<?php echo $this->session->flashdata('passwordError'); ?>
								<?php echo $this->session->flashdata('changePasswordSuccess'); ?>
								<form method="post" action="<?php echo base_url('save-user-password');?>">
								
								<div class="row  mr-3">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
										<div class="row">
											<div class="card">
												<div class="card-body border border-gray">
													<div class="row">
														<!-- ****** ALERT MESSAGE ****** -->
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="alert alert-primary text-white">
																<h6 class="text-justify"><i class="fa fa-info-circle"></i> <?php echo $this->lang->line("change_password_alert"); ?></h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 ">
										<div class="card">
											<div class="card-body border border-gray">
												<!-- ****** NEW USER DETAILS -->
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
													<!-- Select Products to add to the current package -->
														<div class="form-group">
															<label ><?php echo $this->lang->line('email'); ?></label>
															<div class="form-group">
																<input type="email" name="cup_email" class="form-control" value="<?php echo $userEmail; ?>" READONLY>
															</div>
														</div>
													</div>
													<hr >
												</div>
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('full_name'); ?></label>
															<div class="form-group">
																<input type="text" name="cup_name" class="form-control" value="<?php echo $userName; ?>" REQUIRED>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
														<div class="form-group">
															<label ><?php echo $this->lang->line('new_password'); ?></label>
															<input type="password" name="cup_newPassword1" class="form-control" placeholder="<?php echo $this->lang->line('new_password'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
														<div class="form-group">
															<label ><?php echo $this->lang->line('retype_new_password'); ?></label>
															<input type="password" name="cup_newPassword2" class="form-control" placeholder="<?php echo $this->lang->line('retype_new_password'); ?>" REQUIRED>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 justify-content-center">
														<div class="form-group">
															<button type="submit"  class="btn btn-primary btn-block col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" ><i class="fa fa-refresh"></i> <?php echo $this->lang->line('update_login_details'); ?></button>
														</div>
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
					
				</div>
	