<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Storage extends CI_Controller {
 
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
		$this->load->model('transfer_model');
		$this->lang->load('info','english');
	  
	}
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect(current_url());
	}
	
	public function index(){
		
		$data['title'] = $this->lang->line('storage_management');
		$data['activemenu'] = 'warman';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('storage/index');
		$this->load->view('inc/footer');
	}
	
	//GET RACK VOLUME
	public function getRackVolume()
	{
        $rack_row  = $this->global_model->sanitizeString($this->input->post('rack_row'));
		$rack_line = $this->global_model->sanitizeString($this->input->post('rack_line'));
		  
        $volume = $this->storage_model->rack_volume ($rack_row, $rack_line);

		echo json_encode($volume);
	}
	
	//GET SHELF VOLUME
	public function getShelfVolume()
	{
        $warehouseId = $this->session->userdata('warehouseid');
        $volume = $this->storage_model->max_shelf_volume ($warehouseId);

		echo json_encode($volume);
	}
	
	//GET SHELF OCCUPANCY
	public function getShelfOcuupancy()
	{
        $rowId = $this->global_model->sanitizeString($this->input->post('rowId'));
		$lineId = $this->global_model->sanitizeString($this->input->post('lineId'));
		$shelfId = $this->global_model->sanitizeString($this->input->post('shelfId'));
        $occupancy = $this->storage_model->shelf_current_volume ($rowId, $lineId, $shelfId);

		echo json_encode($occupancy);
	}
	
	//PACKAGE BARCODING
	public function rackBarcoding(){
		
		$data['title'] = $this->lang->line('rack_barcoding');
		$data['labelling'] = $this->global_model->RetreiveRow('inventory_settings', ['warehouse_id' => $this->session->userdata('warehouseid') ]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('storage/rackbarcoding');
		$this->load->view('inc/footer');
		
	}
	
	
	
 
}