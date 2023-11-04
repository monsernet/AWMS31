<?php if($this->session->userdata('site_lang') == "arabic") { ?>
	<body class="authentication" dir="rtl">
	<?php } else { ?>
	<body class="authentication" dir="ltr">
	<?php } ?>
		<div class="container">
			<form class="form-horizontal" action="<?php echo base_url(); ?>register/save" method="post">
				<div class="row justify-content-md-center">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<div class="row justify-content-md-center">
									<a href="#" class="login-logo">
										<img class="mw-100" src="<?php echo base_url();?>assets/img/logo_register.png" alt="WMS logo">
									</a>
								<div>
								<h5 class="text-center"><?php echo $this->lang->line('signin_title'); ?></h5>
								<?php if(!empty($loginError)){ echo $loginError;} ?>
								<?php echo $this->session->flashdata('confirmation_msg'); ?>
								<?php echo $this->session->flashdata('passwordNotMatch'); ?>
								<div class="form-group d-flex">
									<label class="mt-2 mr-2"><?php echo $this->lang->line('select_language'); ?> </label>
									<div class="dropdown d-none d-md-block me-2">
										<button type="button" class="btn header-item waves-effect" data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
											<?php if($this->session->userdata('site_lang') == "arabic") { ?>
											<span class="font-size-16"> العربية </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/ksa_flag.jpg" alt="اللغة العربية" height="16">
											<?php } elseif($this->session->userdata('site_lang') == "french") { ?>
											<span class="font-size-16"> Fran&ccedil;ais </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/french_flag.jpg" alt="Langue Francaise" height="16">
											<?php } else { ?>
											 <span class="font-size-16"> English </span> <img class="ms-2"
												src="<?php echo base_url();?>assets/img/flags/us_flag.jpg" alt="English Language" height="16">
												<?php } ?>
										</button>
										<div class="dropdown-menu dropdown-menu-end">

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/english"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/us_flag.jpg" alt="user-image" height="12"> <span
													class="align-middle"> English </span>
											</a>

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/french"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/french_flag.jpg" alt="user-image" height="12"> <span
													class="align-middle"> Fran&ccedil;ais </span>
											</a>

											<!-- item-->
											<a href="<?php echo base_url("dashboard/switchLang/arabic"); ?>" class="dropdown-item notify-item">
												<img src="<?php echo base_url();?>assets/img/flags/ksa_flag.jpg" alt="user-image" height="12"> <span
													class="align-middle"> العربية </span>
											</a>

										  
										</div>
									</div>
								</div>
								<div class="form-group">
									<input type="text" name="userName" class="form-control" placeholder="<?php echo $this->lang->line('full_name'); ?>" value="<?php  echo get_cookie("loginId");  ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="text" name="userUsername" class="form-control" placeholder="<?php echo $this->lang->line('username'); ?>" value="<?php  echo get_cookie("loginId");  ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="email" name="email" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php  echo get_cookie("loginId");  ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" value="<?php  echo get_cookie("loginPass");  ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="password" name="rePassword" class="form-control" placeholder="<?php echo $this->lang->line('retype_password'); ?>" value="<?php  echo get_cookie("loginPass");  ?>" REQUIRED>
								</div>
								
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('register'); ?></button>
								</div>
								<div class="actions align-left">
									<span class="additional-link"><?php echo $this->lang->line('already_user'); ?></span>
									<a href="<?php echo base_url().'login'; ?>" class="btn btn-dark mr-3"><?php echo $this->lang->line('login'); ?></a>
								</div>
								<hr>
								<div class="text-center position-relative">
									<small class="text-muted"><?php echo date('Y');?> © MESDEV SOFT </small>
								</div>
    
								
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
		<!-- Container end -->

	</body>
</html>