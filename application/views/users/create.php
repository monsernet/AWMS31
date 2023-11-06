			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item"><?php echo $this->lang->line('users'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('new_user'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row m-2">
						<div class="card">
							<div class="row card-body">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<ul class="top-icons pull-right text-info">
									<li>
										<a href="<?php echo base_url();?>users" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('users'); ?>">
											<span class="range-text"> <i class="fa fa-users"></i> <?php echo $this->lang->line('users'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>users/banned" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('stock_alert'); ?>">
											<span class="range-text"> <i class="fa fa-user-times"></i> <?php echo $this->lang->line('banned_users'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>users/roles" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('out_of_stock'); ?>">
											<span class="range-text"> <i class="fa fa-vcard-o"></i> <?php echo $this->lang->line('user_roles'); ?></span>
										</a>
									</li>
									
									
									
									
								</ul>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php 
										
										$data='';
										if($this->session->flashdata('data')) {
											$data = $this->session->flashdata('data');
										}
										if ($this->session->flashdata('errors')){
											echo '<div class="alert alert-error"><i class="fa fa-exclamation-triangle"></i> '.$this->session->flashdata('errors').'</div>';
										}
										
									?>
									<form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/saveUser');?>">
									
									<div class="row card">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('general_information'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label for="userFullname"><?php echo $this->lang->line('full_name'); ?></label>
														<input type="text" class="form-control form-control-sm" name="userFullname" id="userFullname" value="<?php if ($data){ echo $data['userFullname']; }?>" placeholder="<?php echo $this->lang->line('full_name'); ?>" REQUIRED>
													</div>
													<div class="form-group">
														<label ><?php echo $this->lang->line('user_type'); ?></label>
														<div class="d-flex">
															<select class="form-control select2" name="new_user_user_type" id="new_user_user_type" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_user_type'); ?></option>
																<?php foreach ($user_types as $type) { 
																	if ($data){ 
																		if ($data['new_user_user_type']==$type->id) {
																			echo '<option value="'.$type->id.'" selected>'.$type->user_type.'</option>';
																		} else {
																			echo '<option value="'.$type->id.'">'.$type->user_type.'</option>';
																		}																			
																	} else {
																	?>
																<option value="<?php echo $type->id;?>"><?php echo $type->user_type;?></option>
																<?php } 
																	} 
																?>
															</select>
															
															<button type="button" id="addNewUserType" class="btn btn-primary btn-xs  ml-2" data-toggle="modal" data-target="#addNewUserTypeModal" /> <?php echo $this->lang->line('new'); ?> </button>
														</div>
													</div>
													<div class="form-group">
														<label ><?php echo $this->lang->line('select_warehouse'); ?></label>
														<div class="d-flex">
															<select class="form-control select2" name="new_user_warehouse" id="new_user_warehouse" REQUIRED>
																<option value=""><?php echo $this->lang->line('select_warehouse'); ?></option>
																<?php foreach ($warehouses as $warehouse) { 
																	/*if ($data){ 
																		if ($data['productCategory']==$category->category_id) {
																			echo '<option value="'.$category->category_id.'" selected>'.$category->category_name.'</option>';
																		} else {
																			echo '<option value="'.$category->category_id.'">'.$category->category_name.'</option>';
																		}																			
																	} else {*/
																	?>
																<option value="<?php echo $warehouse->id;?>"><?php echo $warehouse->warehouseName;?></option>
																<?php //} 
																	} 
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label for="userImageFile"><?php echo $this->lang->line('user_picture'); ?></label>
														<input type="file" class="form-control form-control-sm addUserPicture" name="userImageFile" id="userImageFile"   REQUIRED>
													</div>
													<div class="form-group">
														<div id="userPictureDiv" ><?php echo '<img src="'.base_url().'uploads/pictures/users/avatar.png" class="content-img" id="addUserImage"   />'; ?></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- USER CONNECTION DETAILS -->
									<div class="row card">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('user_login_details'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('username'); ?></label>
														<input type="text"  name="newuser_username" id="newuser_username" value="<?php if ($data){ echo $data['newuser_username']; }?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('username'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('email'); ?></label>
														<input type="email"  name="newuser_email" id="newuser_email" value="<?php if ($data){ echo $data['newuser_email']; }?>" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('email'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-3 col-lglg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('password'); ?></label>
														<input type="password"  name="newuser_password1" id="newuser_password1" value="" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('password'); ?>" REQUIRED>
													</div>
												</div>
												<div class="col-xl-3 col-lglg-3 col-md-3 col-sm-6 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('retype_password'); ?></label>
														<input type="password"  name="newuser_password2" id="newuser_password2" value="" class="form-control form-control-sm"  placeholder="<?php echo $this->lang->line('password'); ?>" REQUIRED>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row justify-content-center col-12">
										<button type="submit" name="saveNewUser" id="saveNewUser" class="btn btn-primary col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12"><i class="fa fa-save"></i><?php echo $this->lang->line('save_new_user'); ?></button>
									</div>
									</form>
								</div>		
							</div>
						</div>
					</div>
				</div>
				
	<!--##### MODALS -->
	
	<!-- ADD NEW CATEGORY -->
	<div class="modal fade" id="addNewUserTypeModal" tabindex="-1" role="dialog" aria-labelledby="addNewUserTypeModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle"><?php echo $this->lang->line('add_new_user_type'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
					<div class="modal-body">
						<div class="row ">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group form-group-sm">
									<label> <?php echo $this->lang->line('user_type'); ?></label>
									<input type="text" name="newUserTypeName" id="newUserTypeName" Placeholder="<?php echo $this->lang->line('user_type'); ?>" class="form-control form-control-sm" value="" Required >
								</div>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo $this->lang->line('user_type_description'); ?></label>
									<textarea name="newUserTypeDescription" id="newUserTypeDescription" Placeholder="<?php echo $this->lang->line('user_type_description'); ?>" class="form-control form-control-sm" ></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary  btn-sm" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
						<button type="button" id="newUserTypeSave" class="btn btn-info btn-sm"><?php echo $this->lang->line('save_user_type'); ?></button>
					</div>
			</div>
		</div>
	</div>
	