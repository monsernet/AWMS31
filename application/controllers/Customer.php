<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customer extends CI_Controller {
 
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
		
		$data['title'] = $this->lang->line('customers');
		$data['activedrop'] = 'cust';
		$data['activemenu'] = 'allcust';
		$data['customers'] = $this->global_model->RetreiveData('clients','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('customers/index');
		$this->load->view('inc/footer');
		
	}
	
	//DISPLAY NEW CUSTOMER PAGE
	public function create(){
		
		$data['title'] = $this->lang->line('new_customer');
		$data['activedrop'] = 'cust';
		$data['activemenu'] = 'newcust';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('customers/create');
		$this->load->view('inc/footer');
		
	}
	
	//EDIT CUSTOMER PAGE
	public function edit(){
		
		$data['title'] = $this->lang->line('edit_customer');
		$customerId = $this->global_model->sanitizeString($this->input->post('customers_custId'));
		$data['customerRow'] = $this->global_model->RetreiveRow('clients', ['client_id' => $customerId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('customers/edit');
		$this->load->view('inc/footer');
		
	}
	
	//SAVE NEW CUSTOMER 
	public function saveCustomer()
	{
        $cust = array (
			'client_code'     	=> $this->global_model->sanitizeString($this->input->post('customerCode')),
			'full_name'      	=> $this->global_model->sanitizeString($this->input->post('customerName')),
			'business_title'   	=> $this->global_model->sanitizeString($this->input->post('customerBusiness')),
			'tax'      			=> $this->global_model->sanitizeString($this->input->post('customerTax')),
			'phone'      		=> $this->global_model->sanitizeString($this->input->post('customerPhone')),
			'mobile'     		=> $this->global_model->sanitizeString($this->input->post('customerMobile')),
			'address'    		=> $this->global_model->sanitizeString($this->input->post('customerAddress')),
			'city'       		=> $this->global_model->sanitizeString($this->input->post('customerCity')),
			'country'    		=> $this->global_model->sanitizeString($this->input->post('customerCountry')),
			'email'      		=> $this->global_model->sanitizeString($this->input->post('customerEmail')),
			'price_level'     	=> $this->global_model->sanitizeString($this->input->post('customerPriceLevel')),
			'status'     		=> $this->global_model->sanitizeString($this->input->post('customerStatus'))
        );
		//inseert
        $this->db->insert('clients', $cust);
		$custId = $this->db->insert_id();

		if($custId) {
			$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('customer_added_success').'</div>');
			redirect('customers');
		} else {
			$this->session->set_flashdata('adderror', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('customer_not_added_success').'</div>');
			// to memorize the data already posted
			$this->session->set_flashdata('data',$cust);
			//redirect to the create form
			redirect('customers/new');
		}
	}
	
	
	//UPDATE EDITED CUSTOMER
	public function update()
	{
		$custId = $this->global_model->sanitizeString($this->input->post('editCustomer_customerId'));
		$cust = array (
				'client_code'     	=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerCode')),
				'full_name'      	=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerName')),
				'business_title'   	=> $this->global_model->sanitizeString($this->input->post('editCustomer_businessTitle')),
				'tax'      			=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerTax')),
				'phone'      		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerPhone')),
				'mobile'     		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerMobile')),
				'address'    		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerAddress')),
				'city'       		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerCity')),
				'country'    		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerCountry')),
				'email'      		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerEmail')),
				'price_level'      	=> $this->global_model->sanitizeString($this->input->post('editCustomer_priceLevel')),
				'status'     		=> $this->global_model->sanitizeString($this->input->post('editCustomer_customerStatus'))
		);
	  
		//update supplier 
		$this->db->where(['client_id' => $custId])->update('clients', $cust);
		
		$this->session->set_flashdata('updatesuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('customer_updated_success').'</div>'); 
      

      redirect('customers');
	}
	
	//ACTIVATE/DEACTIVATE CUSTOMER
	public function activationAction() {
		$custId = $this->global_model->sanitizeString($this->input->post('custId'));
		$currentStatus = $this->global_model->getItem('clients', 'client_id', $custId, 'status');
		if($currentStatus==0){
			//if current status=0 ( deactivated ) => activate the customer
			//by changing status to 1
			$status = 1;
			//$newaction reserved for the displaying the alert
			$newaction = $this->lang->line('activated');
		} else {
			//if current status=1 ( active ) => deactivate the customer
			//by changing status to 0
			$status = 0;
			//$newaction reserved for the displaying the alert
			$newaction = $this->lang->line('deactivated');
		}
		$action = array (
			'status' => $status
		);
		$this->db->where(['client_id' => $custId])->update('clients', $action);	
		
		$this->session->set_flashdata('customerblocked', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('customer_successfully').$newaction.'</div>'); 
		$result = 'action';
		echo json_encode($result);
	}
	
	public function getClientShippingAddress() {
		$custId = $this->global_model->sanitizeString($this->input->post('custId'));
		$shippingAddress = $this->global_model->getItem('clients', 'client_id', $custId, 'shippingAddress');
		echo json_encode($shippingAddress);
	}
	
	
 
}