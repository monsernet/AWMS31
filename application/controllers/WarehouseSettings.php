<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class WarehouseSettings extends CI_Controller {
 
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
	
	public function index(){
		
		$data['title'] = $this->lang->line('warehouse_settings');
		$data['activemenu'] = 'warset';
		$data['warehouse'] = $this->global_model->RetreiveRow('warehouses', ['id' => $this->session->userdata('warehouseid')]);
		$data['warhDim'] = $this->global_model->RetreiveRow('warh_dimensions', ['warehouseId' => $this->session->userdata('warehouseid')]);
		$data['storage'] = $this->global_model->RetreiveRow('storage_area', ['warehouseId' => $this->session->userdata('warehouseid')]);
		$data['storageRacking'] = $this->global_model->RetreiveRow('storage_racking', ['warehouseId' => $this->session->userdata('warehouseid')]);
		$data['inventorySettings'] = $this->global_model->RetreiveRow('inventory_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['eoqSettings'] = $this->global_model->RetreiveRow('eoq_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['inventorySystems'] = $this->global_model->RetreiveData('inventory_systems','');
		$data['storageSystems'] = $this->global_model->RetreiveData('storage_systems','');
		$data['inventoryTecgniques'] = $this->global_model->RetreiveData('inventory_techniques','');
		$data['pickingMethods'] = $this->global_model->RetreiveData('picking_methods','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('warhsettings/index');
		$this->load->view('inc/footer');
		
	}
	
	
	
	
 
}