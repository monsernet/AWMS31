<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomError404 extends CI_Controller {
	
    function __construct(){
      parent::__construct();
      $this->load->helper('url');
	  $this->load->library('user_agent');
      $this->load->library('session');
      $this->load->database();
	  $this->lang->load('info','english');
	  $this->load->model('users_model');
	  $this->load->model('global_model');
	  $this->load->model('warehouse_model');
	  $this->load->model('storage_model');
	  $this->load->model('product_model');
	  $this->load->model('inventory_model');
	  $this->load->model('transfer_model');
    }
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect($this->agent->referrer());
	}
  
    public function index() {
		$data['title'] = $this->lang->line('page_not_found');
		$this->load->view('inc/header');
		$this->load->view('inc/topheader', $data);
		$this->load->view('inc/sidebar');
		$this->load->view('error404');
    }
	
}