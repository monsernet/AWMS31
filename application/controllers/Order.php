<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Order extends CI_Controller {
 
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
		$this->load->model('order_model');
		$this->lang->load('info','english');
	  
	}
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect(current_url());
	}
	
	//LIST OF LPO
	public function lpo(){
		
		$data['title'] = $this->lang->line('local_purchasing_orders');
		$data['activedrop'] = 'prsh';
		$data['activemenu'] = 'lpo';
		$data['lpos'] = $this->global_model->RetreiveOrderedData('orders',['warehouse_id' => $this->session->userdata('warehouseid')],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/lpo');
		$this->load->view('inc/footer');
	}
	
	//LIST OF APPROVED LPO -- PO
	public function po(){
		
		$data['title'] = $this->lang->line('purchasing_orders');
		$data['activedrop'] = 'prsh';
		$data['activemenu'] = 'po';
		$data['pos'] = $this->global_model->RetreiveOrderedData('po',['warehouse_id' => $this->session->userdata('warehouseid')],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/po');
		$this->load->view('inc/footer');
	}
	
	//LIST OF RECEIVED ORDERS -- RECEIVINGS
	public function receivings(){
		
		$data['title'] = $this->lang->line('receivings');
		$data['activedrop'] = 'prsh';
		$data['activemenu'] = 'gdrcv';
		$data['receivings'] = $this->global_model->RetreiveOrderedData('receivings',['warehouse_id' => $this->session->userdata('warehouseid')],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/receivings');
		$this->load->view('inc/footer');
	}
	
	//STORE RECEIVED ORDER IN WAREHOUSE
	public function storeReceiving(){
		
		$data['title'] = $this->lang->line('store_receiving');
		$recId = $this->global_model->sanitizeString($this->input->post('receivedRCId'));
		$data['receivingRow'] = $this->global_model->RetreiveRow('receivings', ['id' => $recId]);
		$data['receivingDetails'] = $this->global_model->RetreiveData('receiving_details',['rc_id' => $recId, 'stored' => 0]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/storereceiving');
		$this->load->view('inc/footer');
	}
	
	//CREATE NEW TRANSFER
	public function createLPO(){
		
		$data['title'] = $this->lang->line('new_lpo');
		$data['activedrop'] = 'prsh';
		$data['activemenu'] = 'newlpo';
		$data['suppliers'] = $this->global_model->RetreiveData('suppliers', ['status' => 1]);
		$data['categories'] = $this->global_model->RetreiveData('product_categories','');
		$data['units'] = $this->global_model->RetreiveData('measuring_units','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/create');
		$this->load->view('inc/footer');
	}
	
	//APPROVE LPO BY AUTORIZED PERSON 
	public function approveLPO(){
		
		$data['title'] = $this->lang->line('approve_lpo');
		$lpoId = $this->global_model->sanitizeString($this->input->post('lpoId'));
		$data['lpoRow'] = $this->global_model->RetreiveRow('orders', ['order_id' => $lpoId]);
		$data['lpoDetails'] = $this->global_model->RetreiveData('order_details',['order_id' => $lpoId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/approvelpo');
		$this->load->view('inc/footer');
	}
	
	//RECEIVE GOODS OF A CREATED PO
	public function createreceiving(){
		
		$data['title'] = $this->lang->line('new_receiving');
		$poId = $this->global_model->sanitizeString($this->input->post('poId'));
		$data['poRow'] = $this->global_model->RetreiveRow('po', ['id' => $poId]);
		$data['poDetails'] = $this->global_model->RetreiveData('po_details',['po_id' => $poId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('purchases/receivepo');
		$this->load->view('inc/footer');
	}
	
	//ADD NEW PRODUCT TO ORDER LIST
	public function addProductToLPO () {
		$prId = $this->global_model->sanitizeString($this->input->post('prId'));
		$qty = $this->global_model->sanitizeString($this->input->post('qty'));
		$result = $this->order_model->addProductToLPO ($prId, $qty);
		echo json_encode($result);
	}
	
	//SAVE NEW LPO 
	public function saveLPO()
	{
        
		//insert lpo
		$lpo = array (
          'order_code'   => $this->global_model->sanitizeString($this->input->post('lpoCode')),
		  'datetime' 		=> date("Y-m-d"),
		  'supplier_id'   => $this->global_model->sanitizeString($this->input->post('newLPOSupplier')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('orders', $lpo);
		$lpo_id = $this->db->insert_id();
		if($lpo_id) {
			$result = array();
			foreach ($this->input->post("lpoPrId") as $key => $val) {
				$result[] = array(             
					'order_id'     => $lpo_id,
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('lpoPrId')[$key],
					'qty' 	   => $this->input->post('lpoPrQty')[$key]
				);      
			}      
			$this->db->insert_batch('order_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				$this->session->set_flashdata('addLPOSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("lpo_added_success").'</div>');
				redirect('purchases/lpo');
			} else {
				$this->session->set_flashdata('addLPOWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("lpo_added_without_details").'</div>');
				redirect('purchases/lpo');
			}
		} else {
			$this->session->set_flashdata('addLPOError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("lpo_not_added").'</div>');
				redirect('purchases/lpo/new');
		}
	}
	
	//SAVE  ORDER (LPO APPROVAL)
	public function saveorder()
	{
        
		//insert order
		$order = array (
          'po_code'   => $this->global_model->sanitizeString($this->input->post('poOrderCode')),
		  'lpo_id'   => $this->global_model->sanitizeString($this->input->post('polpoId')),
		  'quotation'   => $this->global_model->sanitizeString($this->input->post('poQuotation')),
		  'datetime' 		=> date("Y-m-d"),
		  'supplier_id'   => $this->global_model->sanitizeString($this->input->post('poSupplierId')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'agent_id' 		=> $this->session->userdata('userid'),
		  'delivery_limit'   => $this->global_model->sanitizeString($this->input->post('poDeliveryDate')),
        );
		
        $this->db->insert('po', $order);
		$po_id = $this->db->insert_id();
		if($po_id) {
			$result = array();
			foreach ($this->input->post("orderPrId") as $key => $val) {
				$result[] = array(             
					'po_id'     => $po_id,
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('orderPrId')[$key],
					'qty' 	   => $this->input->post('lpoQty')[$key],
					'qty_appr' 	   => $this->input->post('orderQty')[$key],
					'agent_id'      => $this->session->userdata('userid')
				);      
			}      
			$this->db->insert_batch('po_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				//change the status of the LPO to approved & delivery_limit date
				$action = array (
					'approved' => 1,
					'delivery_limit' => $this->global_model->sanitizeString($this->input->post('poDeliveryDate'))
				);
				$this->db->where(['order_id' => $this->global_model->sanitizeString($this->input->post('polpoId'))])->update('orders', $action);
				
				//display success message
				$this->session->set_flashdata('addOrderSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("order_created_success").'</div>');
				redirect('purchases/po');
			} else {
				$this->session->set_flashdata('addOrderWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("order_created_without_details").'</div>');
				redirect('purchases/po');
			}
		} else {
			$this->session->set_flashdata('addOrderError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("order_not_created").'</div>');
				redirect('purchases/order');
		}
	}
	
	
	//SAVE ORDER RECEPTION
	public function savereceiving()
	{
        
		//insert receiving details
		$rc = array (
          'rc_code'   => $this->global_model->sanitizeString($this->input->post('rcCode')),
		  'po_id'   => $this->global_model->sanitizeString($this->input->post('rcPoId')),
		  'lpo_id'   => $this->global_model->sanitizeString($this->input->post('rcLPOId')),
		  'datetime' 		=> date("Y-m-d", strtotime($this->global_model->sanitizeString($this->input->post('rcDate')))),
		  'supplier_id'   => $this->global_model->sanitizeString($this->input->post('rcSupplierId')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('receivings', $rc);
		$rc_id = $this->db->insert_id();
		if($rc_id) {
			$result = array();
			$inv = array();
			foreach ($this->input->post("rcPrId") as $key => $val) {
				$result[] = array(             
					'rc_id'     => $rc_id,
					'order_id'     => $this->global_model->sanitizeString($this->input->post('rcPoId')),
					'lpo_id'     => $this->global_model->sanitizeString($this->input->post('rcLPOId')),
					'date_reception' => date("Y-m-d", strtotime($this->global_model->sanitizeString($this->input->post('rcDate')))),
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('rcPrId')[$key],
					'qty' 	   => $this->input->post('poQty')[$key],
					'qty_appr' 	   => $this->input->post('rcQty')[$key],
					'qty_dmg' 	   => $this->input->post('damQty')[$key],
					'agent_id'      => $this->session->userdata('userid')
				);      
			}      
			$this->db->insert_batch('receiving_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				//change the status of the PO to received 
				$action = array (
					'received' => 1
				);
				$this->db->where(['id' => $this->global_model->sanitizeString($this->input->post('rcPoId'))])->update('po', $action);
				//add received quantity to the stock of the  warehouse
				foreach ($this->input->post("rcPrId") as $key => $val) {
					$inv[] = array (
					  'dateinventory'   => date("Y-m-d", strtotime($this->global_model->sanitizeString($this->input->post('rcDate')))),
					  'inn' 			=> floatval($this->input->post('rcQty')[$key])-floatval($this->input->post('damQty')[$key]),
					  'out_inv' 		=> 0,
					  'product_id' 		=> $this->input->post('rcPrId')[$key],
					  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
					  'transfer_id' 	=> 0,
					  'delivery_id' 	=> 0,
					  'order_id' 		=> $this->global_model->sanitizeString($this->input->post('rcPoId')),
					  'lot' 			=> 'Order #'.$this->global_model->sanitizeString($this->input->post('rcPoId')),
					  'return_id' 		=> 0,
					  'user_id' 		=> $this->session->userdata('userid')
					);
				}
				if(!empty(inv)) {
					$this->db->insert_batch('inventory', $inv);
				} else {
					$this->session->set_flashdata('receivingInvWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reception_inventory_not_added").'</div>');
				}
				$this->session->set_flashdata('approveReceivingSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("order_received_success").'</div>');
				redirect('purchases/receivings');
			} else {
			$this->session->set_flashdata('approveReceivingError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("order_not_received").'</div>');
				redirect('purchases/receivings');
			}
		} else {
			$this->session->set_flashdata('approveReceivingError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("order_not_received").'</div>');
				redirect('purchases/receivings');
		}
	}
	
	//GET RECEIVING DETAILS 
	public function getReceivingDetails() {
		$rcId = $this->global_model->sanitizeString($this->input->post('rcId'));
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		//Product Qty ; stored qty = received qty - damaged qty (if any)
		$qty = floatval($this->global_model->getItemMultiConditions('receiving_details', ['rc_id' =>$rcId, 'product_id' => $productId], 'qty_appr')) - floatval($this->global_model->getItemMultiConditions('receiving_details', ['rc_id' =>$rcId, 'product_id' => $productId], 'qty_dmg')) ;
		$data['qty'] = $qty;
		$data['volume'] = floatval($this->product_model->singleProductVolume( $productId)) * floatval($qty);
		$warehouseId = $this->session->userdata('warehouseid');
        $data['maxVolume'] = $this->storage_model->max_shelf_volume ($warehouseId);
		
		echo json_encode($data);
		
	}
	
	//SAVE PO RECEIVING STORAGE POSITIONS 
	public function saveReceivingStorage () {
		$productId = $this->global_model->sanitizeString($this->input->post('rcProduct'));
		$order_id = $this->global_model->sanitizeString($this->input->post('recPOId'));
		$rcId = $this->global_model->sanitizeString($this->input->post('recReceivingId'));
		$inventoryId = $this->global_model->getItemMultiConditions('inventory', ['product_id' =>$productId, 'order_id' => $order_id], 'inventory_id') ; 
		foreach ($this->input->post("shelfVolume") as $key => $val) {
			$occ[] = array (
				'date_occ'   	=> date("Y-m-d"),
				'inventory_id' 	=> $inventoryId,
				'transfer_id' 	=> 0,
				'order_id' 	=> $order_id,
				'inn_occ' 		=> $this->input->post('shelfVolume')[$key],
				'out_occ' 		=> 0,
				'product_id' 	=> $productId,
				'warehouse_id' 	=> $this->session->userdata('warehouseid'),
				'ref_occ' 		=> 'receiving',
				'row_occ' 		=> $this->input->post('addStockRow')[$key],
				'line_occ' 		=> $this->input->post('addStockLine')[$key],
				'shelf_occ' 	=> $this->input->post('addStockShelf')[$key]
				
			);
		}
		if(!empty($occ)) {
			//insert occupancy
			$this->db->insert_batch('occupancy', $occ);
			//make the product as stored = 1 in receiving details 
			$action = array (
				'stored' => 1
			);
			$this->db->where(['rc_id' => $rcId, 'product_id' => $productId])->update('receiving_details', $action);
			// check if all products are stored ==> make receiving as totally stored
			$totallyStored = $this->global_model->itemExistMultiConditions('receiving_details', ['stored' => 0]);
			if($totallyStored ==FALSE) {
				$action1 = array (
				'stored' => 1
			);
			$this->db->where(['id' => $rcId])->update('receivings', $action);
			}
			
			$this->session->set_flashdata('receivingStorageSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("receiving_storage_added_success").'</div>');
		} else {
			$this->session->set_flashdata('receivingStorageError', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("receiving_storage_not_added").'</div>');
		}
		redirect('purchases/receivings');
	}
	
	
	
	
	
	
	
 
}