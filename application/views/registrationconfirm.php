<?php if($this->session->userdata('site_lang') == "arabic") { ?>
	<body class="authentication" dir="rtl">
	<?php } else { ?>
	<body class="authentication" dir="ltr">
	<?php } ?>
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
						<div class="subscribe-form">
							<div class="">
								<div class="row justify-content-md-center">
									<a href="#" class="login-logo">
										<img class="mw-100" src="<?php echo base_url();?>assets/img/logo_register.png" alt="WMS logo">
									</a>
									<div>
										<h5 class="text-center"><?php echo $this->lang->line('email_confirmation'); ?></h5>
									
										<?php echo $result; ?>
										
										
										<div class="text-center position-relative">
											<small class="text-muted"><?php echo $this->lang->line('copyrights');?> &copy; <?php echo date('Y');?> <a href="#">AWMS - Advanced Warehouse Management System</a></strong>.     <?php echo $this->lang->line('all_rights_reserved');?></small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</body>
</html>