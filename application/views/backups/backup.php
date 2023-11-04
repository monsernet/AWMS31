			<div class="page-header">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><?php echo $this->lang->line('home'); ?></li>
					<li class="breadcrumb-item active"><?php echo $this->lang->line('backups'); ?></li>
				</ol>
				
			</div>
				<div class="row m-2">
						<div class="card">
							<div class="row card-body">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<?php
										if (isset($success) && strlen($success)) {
											echo '<div class="alert alert-success">';
											echo '<p><i class="fa fa-check-circle"></i> ' . $success . '</p>';
											echo '</div>';
										}

										if (isset($errors) && strlen($errors)) {
											echo '<div class="alert alert-error">';
											echo '<p><i class="fa fa-exclamation-triangle"></i> ' . $errors . '</p>';
											echo '</div>';
										}
										
										if (validation_errors()) {
											echo validation_errors('<div class="alert alert-error">', '</div>');
										}
									?>
									<?php
										$back_url = $this->uri->uri_string();
										$key = 'referrer_url_key';
										$this->session->set_flashdata($key, $back_url);
									?>
									
									<?php
										echo form_open($this->uri->uri_string());
									?>
									
										<p class="text-justify ml-4">
											<span class="text-info"><i class="fa fa-question-circle" ></i> <b><?php echo $this->lang->line('notes'); ?></b></span><br/>
											<span class="small"> <?php echo $this->lang->line('backups_help'); ?></span>
										</p>
									
									<div class="card m-2">
										<div class="card-header bg-dark opacity-3">
											<span class="card-title text-white"><?php echo $this->lang->line('create_backup_title'); ?></span>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('backup_type'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="backup_type" id="backup_type" REQUIRED>
																<option value=""><?php echo $this->lang->line('backup_type'); ?> </option>
																<option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '1' ? 'selected' : '')) ?>><?php echo $this->lang->line('db_backup'); ?></option>
																<option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '2' ? 'selected' : '')) ?>><?php echo $this->lang->line('file_backup'); ?></option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
													<div class="form-group">
														<label ><?php echo $this->lang->line('file_type'); ?></label>
														<div class="d-flex">
															<select class="form-control select2"  name="file_type" id="file_type" REQUIRED>
																<option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 1 ? 'selected' : '')) ?>>ZIP</option>
																<option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 2 ? 'selected' : '')) ?>>GZIP</option>
															</select>
														</div>
													</div>
												</div>
												<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-4">
													<button type="submit" name="backup" id="backup" value="backup" class="btn btn-primary col-12"><i class="fa fa-hdd-o"></i> <?php echo $this->lang->line('create_backup'); ?></button>
												</div>
											</div>
										</div>
									</div>
									
									<?php
										echo form_close();
									?>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
									<div class="card m-2">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('file_backups'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="table-responsive">
													<table  class="table">
														<thead>
															<tr>
																
															</tr>
														</thead>
														<tbody>
															<?php 
																$ct=0;
																if($file_list) {
																	foreach ($file_list as $item) { 
															?>
															<tr>
																<td width="70%"><?php echo $item->backup_name;?></td>
																<td><?php echo anchor('backup/download_site_file/'.$item->backup_id, '<i class="fa fa-download"></i> '.$this->lang->line('download'), array('class' => 'download'));?></td>
																<td><?php echo anchor('backup/delete_site_file/'.$item->backup_id, '<i class="fa fa-trash"></i> '. $this->lang->line('delete'), array('class' => 'delete', 'onclick' => "return confirm('Are you sure want to delete this file ?')"));?></td>
																
															</tr>
																<?php } } ?>
														</tbody>
													</table>
												</div>		
											</div>
										</div>
									</div>
								</div>	
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
									<div class="card m-2">
										<div class="card-header bg-dark opacity-3">
											<h6 class="card-title text-white"><?php echo $this->lang->line('db_backups'); ?></h6>
										</div>
										<div class="card-body border border-gray">
											<div class="row">
												<div class="table-responsive">
													<table  class="table">
														<thead>
															<tr>
																
															</tr>
														</thead>
														<tbody>
															<?php 
																$ct=0;
																if($db_list) {
																	foreach ($db_list as $item) { 
															?>
															<tr>
																<td width="70%"><?php echo $item->backup_name;?></td>
																<td><?php echo anchor('backup/download_db_file/'.$item->backup_id, '<i class="fa fa-download"></i> '.$this->lang->line('download'), array('class' => 'download'));?></td>
																<td><?php echo anchor('backup/delete_db_file/'.$item->backup_id, '<i class="fa fa-trash"></i> '. $this->lang->line('delete'), array('class' => 'delete', 'onclick' => "return confirm('".$this->lang->line('alert_confirm_action')."')"));?></td>
																
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
						</div>
					</div>
				
	