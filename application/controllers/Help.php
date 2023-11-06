<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Help extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('users_model');
		$this->load->model('global_model');
		$this->load->model('product_model');
		$this->load->model('warehouse_model');
		$this->load->model('storage_model');
		$this->load->model('inventory_model');
		$this->lang->load('info','english');
	  
	}
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect(current_url());
	}
	
	public function google_recaptcha(){
		
		$data['title'] = "How to Generate Google reCAPTCHA v2 Keys";
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('help/googlerecaptcha');
		$this->load->view('inc/footer');
		
	}
	
	
 
}