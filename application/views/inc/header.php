<?php 
	
	if($this->session->userdata('userid')){
		//user session
		$userid = $this->session->userdata('userid');
		$username = $this->session->userdata('username');
		
	} else {
		redirect('/');
	}
?>	
<!DOCTYPE html>
<?php if($this->session->userdata('site_lang') == "arabic") { ?>
<html lang="ar">
<?php } else { ?>
<html lang="en">
<?php }  ?>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="AWMS - Advanced Warehouse Management System ">
		<meta name="author" content="Monsernet - Ali Omar">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon1.ico">
		<title><?php echo $this->lang->line('app_title');?><?php echo (isset($title) ? $title : '') ; ?></title>
		
		
		<!-- Main Style + Bootstrap -->
		<?php if($this->session->userdata('site_lang') == "arabic") { ?>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style-rtl.css">
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-rtl.min.css">
		<?php } else { ?>
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">
		<?php } ?>
		
		<!-- Font Style -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/style.css">
		<!-- Fontawesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- Data Tables -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bs4.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bs4-custom.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/buttons.bs.css" >
		 <!-- Select2 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		<!-- Swettalert2 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.css">
		<!-- DateRange css -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterange/daterange.css">
		<!-- Step wizard css -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/stepwizard.css">
		
	</head>
	<?php if($this->session->userdata('site_lang') == "arabic") { ?>
	<body dir="rtl">
	<?php } else { ?>
	<body dir="ltr">
	<?php } ?>
		
		<div class="page-wrapper">
		