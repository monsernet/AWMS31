<?php if($this->session->userdata('site_lang') == "arabic") { ?>
	<body class="authentication" dir="rtl">
	<?php } else { ?>
	<body class="authentication" dir="ltr">
	<?php } ?>
		<div class="container">
			<form class="form-horizontal" action="<?php echo base_url(); ?>login" method="post" id="" >
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="#" class="login-logo">
									<?php echo '<img class="mw-100" src="'.base_url().'uploads/application/'.$applicationRow->logo.'" alt="WMS logo">'; ?>
								</a>
								<h6 class="text-center"><?php echo $applicationRow->long_name; ?> - <?php echo $applicationRow->short_name; ?></h6><hr/>
								<h5 class="text-center"><?php echo $this->lang->line('login_title'); ?></h5>
								<?php if(isset($loginError)){ echo $loginError;} ?>
								<?php echo $this->session->flashdata('confirmation_msg'); ?>
								<?php echo $this->session->flashdata('emailExist'); ?>
								<div class="form-group d-flex">
									<label class="mt-2 mr-2"><?php echo $this->lang->line('select_language'); ?> </label>
									<div class="dropdown d-none d-md-block me-2">
										<button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
											<?php if($this->session->userdata('site_lang') == "arabic") { ?>
											<span class="font-size-16"> العربية </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/ksa_flag.jpg" alt="اللغة العربية" height="16px" width="16px">
											<?php } elseif($this->session->userdata('site_lang') == "french") { ?>
											<span class="font-size-16"> Fran&ccedil;ais </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/french_flag.jpg" alt="Langue Francaise" height="16px" width="16px">
											<?php } else { ?>
											 <span class="font-size-16"> English </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/us_flag.jpg" alt="English Language" height="16px" width="16px">
												<?php } ?>
										</button>
										<div class="dropdown-menu dropdown-menu-end" id="langSection">

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/english"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/us_flag.jpg" alt="user-image" height="16px" width="16px"> <span
													class="align-middle"> English </span>
											</a>

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/french"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/french_flag.jpg" alt="user-image" height="16px" width="16px"> <span
													class="align-middle"> Fran&ccedil;ais </span>
											</a>

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/arabic"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/ksa_flag.jpg" alt="user-image" height="16px" width="16px"> <span
													class="align-middle"> العربية </span>
											</a>

										  
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="email" name="email" id="userEmail" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php  echo get_cookie("loginId");  ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="password" name="password" id="userPassword" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" value="<?php  echo get_cookie("loginPass");  ?>" REQUIRED>
								</div>
								
								<!---- NEW GOOGLE CAPTCHA -->
								<?php 
									/*DESCRIPTION :
									============
									If this is your first time using the application, you are not concerned to use Google Captcha 
									just because the google captcha is saved in the application_settings table of the database, 
									and you have to add your google captcha details there first before using it. That's why Google 
									Captcha won't show up when you use the app for the 1st time. */
									
									if($applicationRow) { // here to double check if application settings are already set
								
										if($applicationRow->use_captcha =='yes') {
										/* here we should check if google captcha is already set and also we should check if 
										   use_google_captcha is already enabled  */
											echo '<div class="form-group">';
											echo '<div class="g-recaptcha" data-sitekey="'.$applicationRow->site_key.'"></div>';
											// we will tell data validation that google_captcha is enabled
											echo '<input type="hidden" name="google_captcha_enabled" value="yes">'; 
											echo '</div>';
										} else {
											//here we will tell data validation that google captcha is not enabled
											echo '<input type="hidden" name="google_captcha_enabled" value="no">';
										}
								}
								?>
								<!---- END GOOGLE CAPTCHA ---->
								<div class="form-group div-hidden">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="form-check-input" id="rememberme" <?php if(get_cookie("member_login")) { ?> checked  <?php } ?> />
										<label class="form-check-label" name="rememberme" for="rememberme" ><?php echo $this->lang->line('remember_me'); ?></label>
									</div>
								</div>
								<div class="form-group">
									<button type="submit" name="submitLogin" class="btn btn-primary btn-block" ><?php echo $this->lang->line('login'); ?></button>
								</div>
								
								<hr>
								<div class="text-center position-relative">
									<small class="text-muted"><?php echo $this->lang->line('copyrights');?> &copy; <?php echo date('Y');?> <a href="#">AWMS - Advanced Warehouse Management System</a></strong>.     <?php echo $this->lang->line('all_rights_reserved');?></small>
								</div>
    
								
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
		<!-- Container end -->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		
	</body>
</html>