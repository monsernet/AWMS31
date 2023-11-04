<?php if($this->session->userdata('site_lang') == "arabic") { ?>
	<body class="authentication" dir="rtl">
	<?php } else { ?>
	<body class="authentication" dir="ltr">
	<?php } ?>
		<div class="container">
			<form class="form-horizontal" action="<?php echo base_url(); ?>update-user" method="post">
				<div class="row justify-content-md-center">
					<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
						<div class="login-screen">
							<div class="login-box">
								<a href="#" class="login-logo">
									<img class="mw-100" src="<?php echo base_url();?>assets/img/logo3.png" alt="WMS logo">
								</a>
								<?php echo $this->session->flashdata('updateUserAlert'); ?>
								<h5 class="text-center"><?php echo $this->lang->line('update_user_details'); ?></h5>
								<?php if(!empty($updateError)){ echo $updateError;} ?>
								<div class="form-group">
									<input type="email" name="uu_oldEmail" class="form-control" value="<?php echo $this->session->userdata('oldemail'); ?>" DISABLED>
								</div>
								<div class="form-group">
									<input type="email" name="uu_newEmail" class="form-control" value="<?php echo $this->lang->line('new_email'); ?>" REQUIRED>
								</div>
								<hr width="50%">
								<div class="form-group">
									<input type="password" name="uu_newPassword1" class="form-control" placeholder="<?php echo $this->lang->line('new_password'); ?>" REQUIRED>
								</div>
								<div class="form-group">
									<input type="password" name="uu_newPassword2" class="form-control" placeholder="<?php echo $this->lang->line('retype_new_password'); ?>" REQUIRED>
								</div>
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block"><?php echo $this->lang->line('update_login_details'); ?></button>
								</div>
								<hr>
								<div class="text-center position-relative">
									<small class="text-muted"><?php echo date('Y');?> © AWMS - Advanced Warehouse Management System </small>
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