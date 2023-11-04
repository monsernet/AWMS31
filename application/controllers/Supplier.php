<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Supplier extends CI_Controller {
 
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
		
		$data['title'] = $this->lang->line('suppliers');
		$data['activedrop'] = 'supp';
		$data['activemenu'] = 'allsupp';
		$data['suppliers'] = $this->global_model->RetreiveData('suppliers','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('suppliers/index');
		$this->load->view('inc/footer');
		
	}
	
	//DISPLAY NEW SUPPLIER PAGE
	public function create(){
		
		$data['title'] = $this->lang->line('new_supplier');
		$data['activedrop'] = 'supp';
		$data['activemenu'] = 'newsupp';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('suppliers/create');
		$this->load->view('inc/footer');
		
	}
	
	//EDIT SUPPLIER PAGE
	public function edit(){
		
		$data['title'] = $this->lang->line('edit_supplier');
		$data['activedrop'] = 'supp';
		$supplierId = $this->global_model->sanitizeString($this->input->post('suppliers_suppId'));
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$data['supplierRow'] = $this->global_model->RetreiveRow('suppliers', ['supplier_id' => $supplierId]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('suppliers/edit');
		$this->load->view('inc/footer');
		
	}
	
	//SAVE NEW SUPPLIER 
	public function saveSupplier()
	{
        $supp = array (
			'supplier_code'     => $this->global_model->sanitizeString($this->input->post('supplierCode')),
			'full_name'      	=> $this->global_model->sanitizeString($this->input->post('supplierName')),
			'register_number'   => $this->global_model->sanitizeString($this->input->post('supplierRegister')),
			'phone'      		=> $this->global_model->sanitizeString($this->input->post('supplierPhone')),
			'mobile'     		=> $this->global_model->sanitizeString($this->input->post('supplierMobile')),
			'address'    		=> $this->global_model->sanitizeString($this->input->post('supplierAddress')),
			'city'       		=> $this->global_model->sanitizeString($this->input->post('supplierCity')),
			'country'    		=> $this->global_model->sanitizeString($this->input->post('supplierCountry')),
			'email'      		=> $this->global_model->sanitizeString($this->input->post('supplierEmail')),
			'status'     		=> $this->global_model->sanitizeString($this->input->post('supplierStatus'))
        );
		//inseert
        $this->db->insert('suppliers', $supp);
		$suppId = $this->db->insert_id();

		if($suppId) {
			$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('supplier_added_success').'</div>');
			redirect('suppliers');
		} else {
			$this->session->set_flashdata('adderror', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('supplier_not_added_success').'</div>');
			// to memorize the data already posted
			$this->session->set_flashdata('data',$supp);
			//redirect to the create form
			redirect('suppliers/new');
		}
	}
	
	//SAVE NEW SUPPLIER FROM NEW PRODUCT PAGE 
	public function saveNewSupplier()
	{
        $supp = array (
			'supplier_code'       => $this->global_model->sanitizeString($this->input->post('supplierCode')),
			'full_name'       => $this->global_model->sanitizeString($this->input->post('supplierName')),
			'register_number'   => $this->global_model->sanitizeString($this->input->post('supplierRegister')),
			'phone'      => $this->global_model->sanitizeString($this->input->post('supplierPhone')),
			'mobile'     => $this->global_model->sanitizeString($this->input->post('supplierMobile')),
			'address'    => $this->global_model->sanitizeString($this->input->post('supplierAddress')),
			'city'       => $this->global_model->sanitizeString($this->input->post('supplierCity')),
			'country'    => $this->global_model->sanitizeString($this->input->post('supplierCountry')),
			'email'      => $this->global_model->sanitizeString($this->input->post('supplierEmail')),
			'status'     => $this->global_model->sanitizeString($this->input->post('supplierStatus'))
        );
		//inseert
        $this->db->insert('suppliers', $supp);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	//UPDATE EDITED SUPPLIER
	public function update()
	{
		$suppId = $this->global_model->sanitizeString($this->input->post('editSupplier_supplierId'));
		$supp = array (
				'supplier_code'     => $this->global_model->sanitizeString($this->input->post('editSupplier_supplierCode')),
				'full_name'      	=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierName')),
				'register_number'   => $this->global_model->sanitizeString($this->input->post('editSupplier_supplierRegister')),
				'phone'      		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierPhone')),
				'mobile'     		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierMobile')),
				'address'    		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierAddress')),
				'city'       		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierCity')),
				'country'    		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierCountry')),
				'email'      		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierEmail')),
				'status'     		=> $this->global_model->sanitizeString($this->input->post('editSupplier_supplierStatus'))
		);
	  
		//update supplier 
		$this->db->where(['supplier_id' => $suppId])->update('suppliers', $supp);
		
		$this->session->set_flashdata('updatesuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('supplier_updated_success').'</div>'); 
      

      redirect('suppliers');
	}
	
	//ACTIVATE/DEACTIVATE SUPPLIER
	public function activationAction() {
		$supplierId = $this->global_model->sanitizeString($this->input->post('supplierId'));
		$currentStatus = $this->global_model->getItem('suppliers', 'supplier_id', $supplierId, 'status');
		if($currentStatus==0){
			//if current status=0 ( deactivated ) => activate the supplier
			//by changing status to 1
			$status = 1;
			//$newaction recerved for the displaying the alert
			$newaction = $this->lang->line('activated');
		} else {
			//if current status=1 ( active ) => deactivate the supplier
			//by changing status to 0
			$status = 0;
			//$newaction recerved for the displaying the alert
			$newaction = $this->lang->line('deactivated');
		}
		$action = array (
			'status' => $status
		);
		$this->db->where(['supplier_id' => $supplierId])->update('suppliers', $action);	
		
		$this->session->set_flashdata('supplierblocked', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('supplier_successfully').$newaction.'</div>'); 
		$result = 'action';
		echo json_encode($result);
	}
	
	
 
}