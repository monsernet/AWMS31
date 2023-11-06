			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('user'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('update_user_details'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row ml-3">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<?php echo $this->session->flashdata('sameEmailError'); ?>
								<?php echo $this->session->flashdata('passwordError'); ?>
								<form method="post" action="<?php echo base_url('save-user-infos');?>">
								
								<div class="row  mr-3">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
										<div class="row">
											<div class="card">
												<div class="card-body border border-gray">
													<div class="row">
														<!-- ****** ALERT MESSAGE ****** -->
														<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
															<div class="alert alert-warning text-white">
																<h6 class="text-justify"><i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line("update_user_alert"); ?></h6>
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
															<label ><?php echo $this->lang->line('old_email'); ?></label>
															<div class="form-group">
																<input type="email" name="uu_oldEmail" class="form-control" value="<?php echo $this->session->userdata('oldemail'); ?>" READONLY>
															</div>
														</div>
													</div>
													<hr >
												</div>
												<div class="row">
													<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('full_name'); ?></label>
															<div class="form-group">
																<input type="text" name="uu_name" class="form-control" placeholder="<?php echo $this->lang->line('full_name'); ?>" REQUIRED>
															</div>
														</div>
													</div>
													<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
														<div class="form-group">
															<label ><?php echo $this->lang->line('new_email'); ?></label>
															<div class="form-group">
																<input type="email" name="uu_newEmail" class="form-control" placeholder="<?php echo $this->lang->line('new_email'); ?>" REQUIRED>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
														<div class="form-group">
															<label ><?php echo $this->lang->line('new_password'); ?></label>
															<input type="password" name="uu_newPassword1" class="form-control" placeholder="<?php echo $this->lang->line('new_password'); ?>" REQUIRED>
														</div>
													</div>
													<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
														<div class="form-group">
															<label ><?php echo $this->lang->line('retype_new_email'); ?></label>
															<input type="password" name="uu_newPassword2" class="form-control" placeholder="<?php echo $this->lang->line('retype_new_password'); ?>" REQUIRED>
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
	