<!-- Page content start  -->
	<div class="page-content">
		<header class="header">
			<div class="toggle-btns">
				<a id="toggle-sidebar" href="#">
					<i class="icon-align-justify"></i>
				</a>	
				<a id="pin-sidebar" href="#">
					<i class="icon-align-justify"></i>
				</a>	
			</div> 
			<div class="header-items">
				<div class="page-title ml-2 ">
					<!-- Page Title -->
					<h6 class="text-primary" ><?php echo (($title) ? $title : $this->lang->line('app_title')) ; ?></h6>
				</div>
				<ul class="header-actions">
					<li> <button  alt="<?php echo $this->lang->line('install_demo_data');?>"  class="btn btn-primary btn-sm  ml-2" data-toggle="modal" data-target="#installDemoDataModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-download"></i>  <?php echo $this->lang->line('install_demo_data');?></button></li>
					
					<li>
						<a href="" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="false">
							<?php if($this->session->userdata('site_lang') == "arabic") { ?>
                            <span class="user-name"> العربية </span> <img class="ms-2"
                                src="<?php echo base_url();?>assets/img/flags/ksa_flag.jpg" alt="اللغة العربية" width="16px" height="16px">
							<?php } elseif($this->session->userdata('site_lang') == "french") { ?>
							<span class="user-name"> Fran&ccedil;ais </span> <img class="ms-2"
                                src="<?php echo base_url();?>assets/img/flags/french_flag.jpg" alt="Langue Francaise" width="16px" height="16px">
							<?php } else { ?>
							 <span class="user-name"> English  <img 
                                src="<?php echo base_url();?>assets/img/flags/us_flag.jpg" alt="English Language" width="16px" height="16px"></span> 
								<?php } ?>
						</a>
					</li>
					
					
					
					<!-- Current User Menu -->
					<li class="dropdown">
						<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
							<span class="user-name"><?php echo $this->global_model->getItem('users', 'id', $this->session->userdata('userid'), 'fullName'); ?> </span>
							<i class="icon-chevron-down1"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
							<div class="header-profile-actions">
								<div class="header-user-profile">
									<h5><?php echo $this->global_model->getItem('users', 'id', $this->session->userdata('userid'), 'fullName'); ?></h5>
									<p><?php echo $this->global_model->getItem('users', 'id', $this->session->userdata('userid'), 'user_type'); ?></p>
								</div>
								<a href="<?php echo base_url();?>user/change-password"><i class="icon-lock2"></i> <?php echo $this->lang->line('change_password'); ?></a>
								<a href="<?php echo base_url();?>logout"><i class="icon-log-out1"></i><?php echo $this->lang->line('logout'); ?></a>
							</div>
						</div>
					</li>
				</ul>	
			</div>
			
			
		</header>
		<!-- DEMO DATA MODAL -->
			<div class="modal fade" id="installDemoDataModal" tabindex="-1" role="dialog" aria-labelledby="installDemoDataModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id=""><?php echo $this->lang->line('install_demo_data'); ?></h5>
						<button type="button" class="close" id="demoModal_close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						
					</div>
						<div class="modal-body">
							<div class="text-danger" id="installDemo_warningMsg">
								<strong><i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('warning'); ?></strong>
								<?php echo $this->lang->line('warning_install_demo'); ?>
								<hr>
								<div class="row justify-content-center col-12">
									
									<button type="button" name="installdemoData" id="installdemoData" class="btn btn-primary col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"><i class="fa fa-download"></i><?php echo $this->lang->line('install_demo_data'); ?></button>
								</div>
							</div>
							
							<div id="demoInstallationMessage" class="text-danger text-center mt-3 mb-3 small div-hidden">
								<i class="fa fa-info-circle"></i><?php echo $this->lang->line('welcoming_install_demo'); ?>
							</div>
							<div class="text-secondary small mt-2 mb-2" id="demoInstallProcess"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary  btn-sm" id="demoModal_close2" data-dismiss="modal"><?php echo $this->lang->line('close'); ?></button>
						</div>
				</div>
				
				
			</div>
			</div>