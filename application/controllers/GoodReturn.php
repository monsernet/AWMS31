<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class GoodReturn extends CI_Controller {
 
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
		$this->load->model('order_model');
		$this->load->model('delivery_model');
		$this->load->model('return_model');
		$this->lang->load('info','english');
	  
	}
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect(current_url());
	}
	
	//LIST OF TRANSFER RETURNS
	public function TransferReturns(){
		
		$data['title'] = $this->lang->line('transfer_returns');
		$data['activedrop'] = 'trret';
		$data['activemenu'] = 'alltrret';
		$data['returns'] = $this->global_model->RetreiveOrderedData('returns',['to_warehouse' => $this->session->userdata('warehouseid'), 'transfer_id <>' => 0],'return_date','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('returns/transferreturns', $data);
		$this->load->view('inc/footer');
	}
	
	//LIST OF DELIVERY RETURNS
	public function deliveryReturns(){
		
		$data['title'] = $this->lang->line('delivery_returns');
		$data['activedrop'] = 'delret';
		$data['activemenu'] = 'alldelret';
		$data['returns'] = $this->global_model->RetreiveOrderedData('returns',['to_warehouse' => $this->session->userdata('warehouseid'), 'delivery_id <>' => 0],'return_date','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('returns/deliveryreturns', $data);
		$this->load->view('inc/footer');
	}
	
	//CREATE NEW TRANSFER RETURN
	public function createTransferReturn(){
		
		$data['title'] = $this->lang->line('new_transfer_return');
		$data['activedrop'] = 'trret';
		$data['activemenu'] = 'newtrret';
		if ($this->input->post()) {
			$transferCode = $this->global_model->sanitizeString($this->input->post('returnTransferCode'));
			$transferId = $this->global_model->getItem('transfers', 'transfer_code', $transferCode, 'transfer_id');
			if($this->global_model->itemExist('transfers', 'transfer_id', $transferId)) {
				$data['transferRow'] = $this->global_model->RetreiveRow('transfers', ['transfer_id' => $transferId]);
				$data['transferDetails'] = $this->global_model->RetreiveData('transfer_received',['transfer_id' => $transferId]);
			} else {
				$data['errorTransferExist'] ='<i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('code_entered_not_exist');
			}
		}
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('returns/createtransferreturn');
		$this->load->view('inc/footer');
	}
	
	//CREATE NEW DELIVERY RETURN
	public function createDeliveryReturn(){
		
		$data['title'] = $this->lang->line('new_delivery_return');
		$data['activedrop'] = 'delret';
		$data['activemenu'] = 'newdelret';
		if ($this->input->post()) {
			$deliveryCode = $this->global_model->sanitizeString($this->input->post('returnDeliveryCode'));
			$deliveryId = $this->global_model->getItem('deliveries', 'delivery_code', $deliveryCode, 'delivery_id');
			if($this->global_model->itemExist('deliveries', 'delivery_id', $deliveryId)) {
				$data['deliveryRow'] = $this->global_model->RetreiveRow('deliveries', ['delivery_id' => $deliveryId]);
				$data['deliveryDetails'] = $this->global_model->RetreiveData('delivery_details',['delivery_id' => $deliveryId]);
			} else {
				$data['errorDeliveryExist'] ='<i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('code_entered_not_exist');
			}
		}
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('returns/createdeliveryreturn');
		$this->load->view('inc/footer');
	}
	
	//SAVE TRANSFER RETURN 
	public function saveTransferReturn()
	{
        // Check if a transfer Id is already provided
		if($this->global_model->sanitizeString($this->input->post('returnTransferTrId'))) {
			//insert return
			$return = array (
			  'delivery_id'   => 0,
			  'transfer_id'   => $this->global_model->sanitizeString($this->input->post('returnTransferTrId')),
			  'return_code'   => $this->global_model->sanitizeString($this->input->post('returnTransferRetCode')),
			  'return_date' 		=> $this->global_model->sanitizeString($this->input->post('returnTransferRetDate')),
			  'return_reference'   => $this->global_model->sanitizeString($this->input->post('returnTransferRetReference')),
			  'from_warehouse' 	=> $this->global_model->sanitizeString($this->input->post('retTransferWarhFrom')),
			  'from_client'   => 0,
			  'to_warehouse' 	=> $this->global_model->sanitizeString($this->input->post('retTransferWarhTo')),
			  'agent_id' 		=> $this->session->userdata('userid')
			);
			
			$this->db->insert('returns', $return);
			$return_id = $this->db->insert_id();
			if($return_id) {
				//after adding return, we have to add its details
				$result = array();
				foreach ($this->input->post("trPrId") as $key => $val) {
					$result[] = array(             
						'return_id'     => $return_id,
						'warehouse_id' => $this->global_model->sanitizeString($this->input->post('retTransferWarhTo')),
						'product_id' 	   => $this->input->post('trPrId')[$key],
						'qty_returned' 	   => $this->input->post('returnedQty')[$key],
						'return_reason' 	   => $this->input->post('returnReason')[$key]
					);      
				}      
				$this->db->insert_batch('return_details',$result);
				$filledIn = TRUE;
				
				if($filledIn==TRUE) {
					//if all data , return + return details are provided ==> add success
					$this->session->set_flashdata('addReturnSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("return_added_success").'</div>');
					redirect('transfers/returns');
				} else {
					//if return return added but details (products & qties) are not added ==> add warning
					$this->session->set_flashdata('addReturnWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_added_without_details").'</div>');
					redirect('transfers/returns');
				}
			} else {
				//if nothing was provided ==> add error
				$this->session->set_flashdata('addReturnError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_not_added").'</div>');
					redirect('transfers/returns/new');
			}
		} else {
			//if, for any reason, transfer id was provided ==> alert message
			$this->session->set_flashdata('addReturnError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_not_added").'</div>');
			redirect('transfers/returns/new');
		}
	}
	
	//SAVE DELIVERY RETURN 
	public function saveDeliveryReturn()
	{
        // Check if a delivery Id is already provided
		if($this->global_model->sanitizeString($this->input->post('returnDelivId'))) {
			//insert return
			$return = array (
			  'delivery_id'   => $this->global_model->sanitizeString($this->input->post('returnDelivId')),
			  'transfer_id'   => 0,
			  'return_code'   => $this->global_model->sanitizeString($this->input->post('returnDeliveryRetCode')),
			  'return_date' 		=> $this->global_model->sanitizeString($this->input->post('returnDeliveryRetDate')),
			  'return_reference'   => $this->global_model->sanitizeString($this->input->post('returnDeliveryRetReference')),
			  'from_warehouse' 	=> 0,
			  'from_client'   => $this->global_model->sanitizeString($this->input->post('retDelivCustomer')),
			  'to_warehouse' 	=> $this->global_model->sanitizeString($this->input->post('retDelivWarehouse')),
			  'agent_id' 		=> $this->session->userdata('userid')
			);
			
			$this->db->insert('returns', $return);
			$return_id = $this->db->insert_id();
			if($return_id) {
				//after adding return, we have to add its details
				$result = array();
				foreach ($this->input->post("delivPrId") as $key => $val) {
					$result[] = array(             
						'return_id'     => $return_id,
						'warehouse_id' => $this->global_model->sanitizeString($this->input->post('retDelivWarehouse')),
						'product_id' 	   => $this->input->post('delivPrId')[$key],
						'qty_returned' 	   => $this->input->post('returnedQty')[$key],
						'return_reason' 	   => $this->input->post('returnReason')[$key]
					);      
				}      
				$this->db->insert_batch('return_details',$result);
				$filledIn = TRUE;
				
				if($filledIn==TRUE) {
					//if all data , return + return details are provided ==> add success
					$this->session->set_flashdata('addReturnSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("return_added_success").'</div>');
					redirect('deliveries/returns');
				} else {
					//if return return added but details (products & qties) are not added ==> add warning
					$this->session->set_flashdata('addReturnWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_added_without_details").'</div>');
					redirect('deliveries/returns');
				}
			} else {
				//if nothing was provided ==> add error
				$this->session->set_flashdata('addReturnError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_not_added").'</div>');
					redirect('deliveries/returns/new');
			}
		} else {
			//if, for any reason, transfer id was provided ==> alert message
			$this->session->set_flashdata('addReturnError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("return_not_added").'</div>');
			redirect('deliveries/returns/new');
		}
	}
	
	
	
	
	
	
	
	
	
	

	
 
}