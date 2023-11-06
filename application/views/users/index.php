			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('users'); ?></li>
				</ol>
				
			</div>
			<div class="main-container">
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="card">
							<div class="card-body">
								<ul class="top-icons pull-right text-info small">
									<li>
										<a href="<?php echo base_url();?>users/new" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('new_user'); ?>">
											<span class="range-text"> <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('new_user'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>users/banned" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('banned_users'); ?>">
											<span class="range-text"> <i class="fa fa-user-times"></i> <?php echo $this->lang->line('banned_users'); ?></span>
										</a>
									</li>
									<li>
										<a href="<?php echo base_url();?>users/roles" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('user_roles'); ?>">
											<span class="range-text"> <i class="fa fa-vcard-o"></i> <?php echo $this->lang->line('user_roles'); ?></span>
										</a>
									</li>
									
									
									
									
								</ul>
								<div class="table-responsive txtTable">
									<?php echo $this->session->flashdata('addsuccess'); ?>
									<?php echo $this->session->flashdata('updatesuccess'); ?>
									<?php echo $this->session->flashdata('usernotexist'); ?>
									<?php echo $this->session->flashdata('userbanned'); ?>
									<table id="fixedHeader" class="table custom-table userTable">
										<thead>
											<tr>
												
												<th><?php echo $this->lang->line('user_picture'); ?></th>
												<th><?php echo $this->lang->line('fullname'); ?></th>
												<th><?php echo $this->lang->line('username'); ?></th>
												<th><?php echo $this->lang->line('email'); ?></th>
												<th><?php echo $this->lang->line('status'); ?></th>
												<th><?php echo $this->lang->line('user_type'); ?></th>
												<th><?php echo $this->lang->line('registration_date'); ?></th>
												<th ><?php echo $this->lang->line('action'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$ct=0;
												if($users) {
												foreach ($users as $user) { 
													$ct++;
													
												
											?>
											<tr>
												<td >
												<?php 
													if ($user->profileImage) 
													{ 
														echo '<div class="row-img"><img src="'.base_url().'uploads/pictures/users/'.$user->profileImage.'" class="img-thumbnail" alt="'.$user->fullName.'"></div>';
													} else {
														echo '<div class="row-img"><img src="'.base_url().'uploads/pictures/users/avatar.png" class="img-thumbnail" alt="'.$user->fullName.'"></div>';
													}															 
												?>
												</td>
												<td>
													<span class="mt-0 mb-1"><b><?php echo $user->fullName; ?></b></span>
												</td>
												<td><?php echo $user->username; ?></td>
												<td><?php echo $user->email; ?></td>
												<td><?php echo ($user->status==1) ? '<span class="text-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("active").'</span>' : '<span class="text-danger"><i class="fa fa-times-circle"></i> '.$this->lang->line("banned").'</span>'; ?></td>
												<td><?php echo $user->user_type; ?></td>
												<td><?php echo $user->registerDate; ?></td>
												<td class="btn-group">
													
													<a href="<?php echo base_url();?>users/edit/<?php echo $user->id;?>" class="btn btn-sm btn-primary mr-1" title="<?php echo $this->lang->line('edit_user'); ?>"><i class="fa fa-edit"></i></a>
													<input type="hidden" name="users_userId" id="users_userId<?php echo $ct;?>" value="<?php echo $user->id;?>">
													<a href="<?php echo base_url();?>user/roles/<?php echo $user->id;?>" class="btn btn-sm btn-secondary mr-1"><i class="fa fa-vcard-o"></i></a>
													<!-- IF USER STATUS =1 => DISPLAY BUTTON TO ACTIVATE -->
													<?php if ($user->status==1) { ?>
													<button type="button" name="deactivateUser" id="deactivateUser" class="btn btn-sm btn-success user_action" title="<?php echo $this->lang->line('block_user'); ?>"><i class="fa fa-toggle-on"></i></button>
													<?php } else { ?>
													<button type="button" name="deactivateUser" id="deactivateUser" class="btn btn-sm btn-danger user_action" title="<?php echo $this->lang->line('activate_user'); ?>"><i class="fa fa-toggle-off"></i></button>
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
	