<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Transfer extends CI_Controller {
 
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
	
	//LIST OF TRANSFERS ISSUED
	public function transfersSent(){
		
		$data['title'] = $this->lang->line('transfers_issued');
		$data['activedrop'] = 'trans';
		$data['activemenu'] = 'sent';
		$data['transfers'] = $this->global_model->RetreiveOrderedData('transfers',['warehouse_id' => $this->session->userdata('warehouseid')],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/issuedtransfers');
		$this->load->view('inc/footer');
	}
	
	//LIST OF TRANSFERS ISSUED
	public function transfersReceived(){
		
		$data['title'] = $this->lang->line('transfers_issued');
		$data['activedrop'] = 'trans';
		$data['activemenu'] = 'rcv';
		$data['transfers'] = $this->global_model->RetreiveOrderedData('transfers',['destination_id' => $this->session->userdata('warehouseid'), 'loaded' => 1],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/receivedtransfers');
		$this->load->view('inc/footer');
	}
	
	//CREATE NEW TRANSFER
	public function create(){
		
		$data['title'] = $this->lang->line('new_transfer');
		$data['activedrop'] = 'trans';
		$data['activemenu'] = 'newtrans';
		$data['dest_warehouses'] = $this->global_model->RetreiveData('warehouses',['id !=' => $this->session->userdata('warehouseid')]);
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/create');
		$this->load->view('inc/footer');
	}
	
	//APPROVE TRANSFER BY AUTORIZED PERSON 
	public function approveTransfer(){
		
		$data['title'] = $this->lang->line('approve_transfer');
		$transferId = $this->global_model->sanitizeString($this->input->post('issuedTrId'));
		$data['transferRow'] = $this->global_model->RetreiveRow('transfers', ['transfer_id' => $transferId]);
		$data['transferDetails'] = $this->global_model->RetreiveData('transfer_details',['transferId' => $transferId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/approvetransfer');
		$this->load->view('inc/footer');
	}
	
	//APPROVE TRANSFER RECEPTION 
	public function receiveTransfer(){
		
		$data['title'] = $this->lang->line('receive_transfer');
		$transferId = $this->global_model->sanitizeString($this->input->post('receivedTrId'));
		$data['transferRow'] = $this->global_model->RetreiveRow('transfers', ['transfer_id' => $transferId]);
		$data['transferDetails'] = $this->global_model->RetreiveData('transfer_approved',['transfer_id' => $transferId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/approvereception');
		$this->load->view('inc/footer');
	}
	
	//LOAD TRANSFER
	public function loadTransfer(){
		
		$data['title'] = $this->lang->line('loading_transfer');
		$transferId = $this->global_model->sanitizeString($this->input->post('loadingTrId'));
		$data['transferRow'] = $this->global_model->RetreiveRow('transfers', ['transfer_id' => $transferId]);
		$data['transferDetails'] = $this->global_model->RetreiveData('transfer_approved',['transfer_id' => $transferId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('pickpack/loadTransfer');
		$this->load->view('inc/footer');
	}
	
	//STORE RECEPTION IN DESTINATION WAREHOUSE
	public function storeReception(){
		
		$data['title'] = $this->lang->line('store_reception');
		$transferId = $this->global_model->sanitizeString($this->input->post('receivedTrId1'));
		$data['transferRow'] = $this->global_model->RetreiveRow('transfers', ['transfer_id' => $transferId]);
		$data['transferDetails'] = $this->global_model->RetreiveData('transfer_received',['transfer_id' => $transferId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('transfers/storereception');
		$this->load->view('inc/footer');
	}
	
	//ADD NEW PRODUCT TO TRANSFER LIST
	public function addProductToTransfer () {
		$prId = $this->global_model->sanitizeString($this->input->post('prId'));
		$qty = $this->global_model->sanitizeString($this->input->post('qty'));
		$stock = $this->product_model->productInventory ($prId, $this->session->userdata('warehouseid'));
		if($stock==0 OR $stock=="" OR $stock < $qty) {
			$result='notenoughstock';
		} else {
			$result = $this->transfer_model->addProductToTransfer ($prId, $qty);
		}
		
		echo json_encode($result);
	}
	
	// GET DESTINATION WAREHOUSE INFORMATION
	public function getDestWarhInfo () {
		$warhouseId = $this->global_model->sanitizeString($this->input->post('warehouseId'));
		$result['warehouseAddress'] = $this->global_model->getItem('warehouses', 'id', $warhouseId, 'address');
		$result['contactName'] = $this->global_model->getItem('warehouses', 'id', $warhouseId, 'manager');
		$result['contactPhone'] = $this->global_model->getItem('warehouses', 'id', $warhouseId, 'contact');
		echo json_encode($result);
	}
	
	//SAVE NEW TRANSFER 
	public function store()
	{
        
		//insert transfer
		$transfer = array (
          'transfer_code'   => $this->global_model->sanitizeString($this->input->post('transferCode')),
		  'datetime' 		=> date("Y-m-d"),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'destination_id' 	=> $this->global_model->sanitizeString($this->input->post('destinationWarehouse')),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('transfers', $transfer);
		$transfer_id = $this->db->insert_id();
		if($transfer_id) {
			$result = array();
			$volume=0;
			$weight=0;
			foreach ($this->input->post("transferPrId") as $key => $val) {
				$volume = $this->product_model->singleProductVolume( $this->input->post('transferPrId')[$key])* floatval($this->input->post('transferPrQty')[$key]);
				$weight = $this->product_model->singleProductWeight( $this->input->post('transferPrId')[$key])* floatval($this->input->post('transferPrQty')[$key]);
				$result[] = array(             
					'transferId'     => $transfer_id,
					'origin' => $this->session->userdata('warehouseid'),
					'destination' => $this->global_model->sanitizeString($this->input->post('destinationWarehouse')),
					'productId' 	   => $this->input->post('transferPrId')[$key],
					'qty' 	   => $this->input->post('transferPrQty')[$key],
					'volume'      => $volume,
					'weight'   => $weight
				);      
			}      
			$this->db->insert_batch('transfer_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				$this->session->set_flashdata('addTransferSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("transfer_added_success").'</div>');
				redirect('transfers/new');
			} else {
				$this->session->set_flashdata('addTransferWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("transfer_added_without_details").'</div>');
				redirect('transfers/new');
			}
		} else {
			$this->session->set_flashdata('addTransferError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("transfer_not_added").'</div>');
				redirect('transfers/new');
		}
	}
	
	//SAVE  TRANSFER Approval
	public function storeApproval()
	{
        
		//insert approval
		$result = array();
		$tmp_inv = array();
		foreach ($this->input->post("transferPrId") as $key => $val) {
			$result[] = array(             
				'transfer_id'   	=> $this->global_model->sanitizeString($this->input->post('ApprTransferId')),
				'date_approve' 		=> date("Y-m-d"),
				'warehouse_id' 		=> $this->global_model->sanitizeString($this->input->post('ApprWarehouseId')),
				'destination_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprDestinationId')),
				'product_id' 	    => $this->input->post('transferPrId')[$key],
				'qty' 	   			=> $this->input->post('transferNormalQty')[$key],
				'qty_appr' 	   		=> $this->input->post('transferApprovedQty')[$key],
				'agent_id' 		=> $this->session->userdata('userid')
				);  
        }
		if(!empty($result)) {
			//save approval details
			$this->db->insert_batch('transfer_approved',$result);
			//update approval status to 1 in transfers table
			$action = array (
				'approved' => 1
			);
			$this->db->where(['transfer_id' => $this->global_model->sanitizeString($this->input->post('ApprTransferId'))])->update('transfers', $action);
			//add approved quantity to temporary inventory ==> Reserved out
			foreach ($this->input->post("transferPrId") as $key => $val) {
				$tmp_inv[] = array (
				  'dateinventory'   => date("Y-m-d"),
				  'inn' 			=> 0,
				  'out_inv' 		=> $this->input->post('transferApprovedQty')[$key],
				  'product_id' 		=> $this->input->post('transferPrId')[$key],
				  'warehouse_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprWarehouseId')),
				  'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprTransferId')),
				  'delivery_id' 	=> 0,
				  'order_id' 		=> 0,
				  'lot' 			=> $this->global_model->sanitizeString($this->input->post('ApprTransferCode')),
				  'return_id' 		=> 0,
				  'user_id' 		=> $this->session->userdata('userid')
				);
			}
			if(!empty($tmp_inv)) {
				$this->db->insert_batch('inventory_tmp', $tmp_inv);
			} else {
				$this->session->set_flashdata('reservedInvWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reserved_inventory_not_added").'</div>');
			}
			$this->session->set_flashdata('approveTransferSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("transfer_approved_success").'</div>');
				redirect('transfers/issued');
		} else {
			$this->session->set_flashdata('apprveTransferError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("transfer_not_approved").'</div>');
				redirect('transfers/issued');
		}
	}
	
	//APPROVE TRANSFER LOADING
	public function approveloding()
	{
        
		$transferId = $this->global_model->sanitizeString($this->input->post('LoadingTransferId'));
		$result = $this->transfer_model->checkProductPickup($transferId);
		if($result ==TRUE) {
			//update the loading status of the transfer
			$data = array(
				'loaded' => 1
			);

			$this->db->where(['transfer_id' => $transferId]);
			$this->db->update('transfers', $data);
			$this->session->set_flashdata('transferLoadingSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("transfer_loading_approved").'</div>');
				redirect('transfers/issued');
		} else {
			$this->session->set_flashdata('transferLoadingError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("transfer_loading_not_approved").'</div>');
				redirect('transfers/issued');
		}
		
		
		//insert approval
		$result = array();
		$tmp_inv = array();
		foreach ($this->input->post("transferPrId") as $key => $val) {
			$result[] = array(             
				'transfer_id'   	=> $this->global_model->sanitizeString($this->input->post('ApprTransferId')),
				'date_approve' 		=> date("Y-m-d"),
				'warehouse_id' 		=> $this->global_model->sanitizeString($this->input->post('ApprWarehouseId')),
				'destination_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprDestinationId')),
				'product_id' 	    => $this->input->post('transferPrId')[$key],
				'qty' 	   			=> $this->input->post('transferNormalQty')[$key],
				'qty_appr' 	   		=> $this->input->post('transferApprovedQty')[$key],
				'agent_id' 		=> $this->session->userdata('userid')
				);  
        }
		if(!empty($result)) {
			//save approval details
			$this->db->insert_batch('transfer_approved',$result);
			//update approval status to 1 in transfers table
			$action = array (
				'approved' => 1
			);
			$this->db->where(['transfer_id' => $this->global_model->sanitizeString($this->input->post('ApprTransferId'))])->update('transfers', $action);
			//add approved quantity to temporary inventory ==> Reserved out
			foreach ($this->input->post("transferPrId") as $key => $val) {
				$tmp_inv[] = array (
				  'dateinventory'   => date("Y-m-d"),
				  'inn' 			=> 0,
				  'out_inv' 		=> $this->input->post('transferApprovedQty')[$key],
				  'product_id' 		=> $this->input->post('transferPrId')[$key],
				  'warehouse_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprWarehouseId')),
				  'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('ApprTransferId')),
				  'delivery_id' 	=> 0,
				  'order_id' 		=> 0,
				  'lot' 			=> $this->global_model->sanitizeString($this->input->post('ApprTransferCode')),
				  'return_id' 		=> 0,
				  'user_id' 		=> $this->session->userdata('userid')
				);
			}
			if(!empty($tmp_inv)) {
				$this->db->insert_batch('inventory_tmp', $tmp_inv);
			} else {
				$this->session->set_flashdata('reservedInvWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reserved_inventory_not_added").'</div>');
			}
			$this->session->set_flashdata('approveTransferSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("transfer_approved_success").'</div>');
				redirect('transfers/issued');
		} else {
			$this->session->set_flashdata('apprveTransferError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("transfer_not_approved").'</div>');
				redirect('transfers/issued');
		}
	}
	
	//GET DETAILS OF TRANSFER & PRODUCT TO MANAGE THE STORAGE LOCATION -- PICKUP OPERATION
	public function getproductDetailsFromTransfer() {
		$transferId = $this->global_model->sanitizeString($this->input->post('transferId'));
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		//Transfer Code 
		$data['transferCode'] = $this->global_model->getItem('transfers', 'transfer_id', $transferId, 'transfer_code');
		//Transfer Date 
		$transferDate = $this->global_model->getItem('transfers', 'transfer_id', $transferId, 'datetime');
		$data['transferDate'] = $this->global_model->setDateFormat($transferDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
		//Product Barcode 
		$data['productBarcode'] = $this->global_model->getItem('products', 'product_id', $productId, 'product_barcode');
		//Product Name 
		$data['productName'] = $this->global_model->getItem('products', 'product_id', $productId, 'product_name');
		//Product Volume 
		$qty = $this->global_model->getItemMultiConditions('transfer_approved', ['transfer_id' =>$transferId, 'product_id' => $productId], 'qty_appr');
		$data['qty'] = $qty;
		$data['warehouseId'] = $this->session->userdata('warehouseid');
		$data['productVolume'] = number_format((floatval($this->product_model->singleProductVolume( $productId)) * $qty),2);
		//List of storage positions
		$data['storagepos'] = $this->storage_model->storage_positions_by_product ($productId);
		
		echo json_encode($data);
		
		
	}
	
	public function updateInventory () {
		$stock = array (
          'dateinventory'   => date("Y-m-d"),
		  'inn' 			=> 0,
		  'out_inv' 		=> $this->global_model->sanitizeString($this->input->post('outQty')),
		  'product_id' 		=> $this->global_model->sanitizeString($this->input->post('productId')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('transferId')),
		  'delivery_id' 	=> 0,
		  'order_id' 		=> 0,
		  'lot' 			=> 'Transfer '.$this->global_model->sanitizeString($this->input->post('transferId')),
		  'return_id' 		=> 0	
        );
		
        $this->db->insert('inventory', $stock);
		$inventory_id = $this->db->insert_id();
		echo json_encode($inventory_id);
	}
	
	public function removeResTransferQty () {
		
		  $product_id 		= $this->global_model->sanitizeString($this->input->post('productId'));
		  $transfer_id  	= $this->global_model->sanitizeString($this->input->post('transferId'));
		
        $this->db->delete('inventory_tmp', array('product_id' => $product_id, 'transfer_id' => $transfer_id)); 
		$result = "removed successfully";
		echo json_encode($result);
	}
	
	public function updateProductLoading () {
		$product_id 		= $this->global_model->sanitizeString($this->input->post('productId'));
		$transfer_id  	= $this->global_model->sanitizeString($this->input->post('transferId'));
		$data = array(
			'loaded' => 1
		);

		$this->db->where(['transfer_id' => $transfer_id, 'product_id' => $product_id] );
		$this->db->update('transfer_approved', $data);
		$result = 'loaded';
		echo json_encode($result);
	}
	
	public function saveTransferPickup () {
		$occ = array (
          'date_occ'   		=> date("Y-m-d"),
		  'inventory_id' 	=> $this->global_model->sanitizeString($this->input->post('inventory_id')),
		  'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('transfer_id')),
		  'inn_occ' 		=> 0,
		  'out_occ' 		=> $this->global_model->sanitizeString($this->input->post('out_occ')),
		  'product_id' 		=> $this->global_model->sanitizeString($this->input->post('product_id')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'ref_occ' 		=> 'transfer',
		  'row_occ' 		=> $this->global_model->sanitizeString($this->input->post('row_occ')),
		  'line_occ' 		=> $this->global_model->sanitizeString($this->input->post('line_occ')),
		  'shelf_occ' 		=> $this->global_model->sanitizeString($this->input->post('shelf_occ'))
        );
		
        $this->db->insert('occupancy', $occ);
		$occ_id = $this->db->insert_id();
		echo json_encode($occ_id);
	}
	
	//APPROVE TRANSFER RECEPTION
	public function approveTransferReception()
	{
        
		//insert approval
		$result = array();
		$inv = array();
		foreach ($this->input->post("RecTransferPrId") as $key => $val) {
			$result[] = array(             
				'transfer_id'   	=> $this->global_model->sanitizeString($this->input->post('RecTransferId')),
				'date_reception' 		=> date("Y-m-d"),
				'from_warehouse' 		=> $this->global_model->sanitizeString($this->input->post('RecWarehouseId')),
				'to_warehouse' 	=> $this->session->userdata('warehouseid'),
				'product_id' 	    => $this->input->post('RecTransferPrId')[$key],
				'qty' 	   			=> $this->input->post('RecTransferredQty')[$key],
				'qty_appr' 	   		=> $this->input->post('RecReceivedQty')[$key],
				'agent_id' 		=> $this->session->userdata('userid')
				);  
        }
		if(!empty($result)) {
			//save approval details
			$this->db->insert_batch('transfer_received',$result);
			//update reception status to 1 in transfers table
			$action = array (
				'received' => 1
			);
			$this->db->where(['transfer_id' => $this->global_model->sanitizeString($this->input->post('RecTransferId'))])->update('transfers', $action);
			//add approved quantity to the stock of the destination warehouse
			foreach ($this->input->post("RecTransferPrId") as $key => $val) {
				$inv[] = array (
				  'dateinventory'   => date("Y-m-d"),
				  'inn' 			=> $this->input->post('RecReceivedQty')[$key],
				  'out_inv' 		=> 0,
				  'product_id' 		=> $this->input->post('RecTransferPrId')[$key],
				  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
				  'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('RecTransferId')),
				  'delivery_id' 	=> 0,
				  'order_id' 		=> 0,
				  'lot' 			=> 'Transfer '.$this->global_model->sanitizeString($this->input->post('RecTransferId')),
				  'return_id' 		=> 0,
				  'user_id' 		=> $this->session->userdata('userid')
				);
			}
			if(!empty(inv)) {
				$this->db->insert_batch('inventory', $inv);
			} else {
				$this->session->set_flashdata('receptionInvWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reception_inventory_not_added").'</div>');
			}
			$this->session->set_flashdata('approveReceptionSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("transfer_received_success").'</div>');
				redirect('transfers/received');
		} else {
			$this->session->set_flashdata('approveReceptionError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reception_not_approved").'</div>');
				redirect('transfers/received');
		}
	}
	
	//GET RECEPTION DETAILS 
	public function getReceptionDetails() {
		$transferId = $this->global_model->sanitizeString($this->input->post('transferId'));
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		//Product Qty 
		$qty = $this->global_model->getItemMultiConditions('transfer_received', ['transfer_id' =>$transferId, 'product_id' => $productId], 'qty_appr');
		$data['qty'] = $qty;
		$data['volume'] = floatval($this->product_model->singleProductVolume( $productId)) * floatval($qty);
		$warehouseId = $this->session->userdata('warehouseid');
        $data['maxVolume'] = $this->storage_model->max_shelf_volume ($warehouseId);
		
		echo json_encode($data);
		
	}
	
	//SAVE RECEPTION STORAGE POSITIONS 
	public function saveReceptionStorage () {
		
		foreach ($this->input->post("shelfVolume") as $key => $val) {
			$occ[] = array (
				'date_occ'   	=> date("Y-m-d"),
				'transfer_id' 	=> $this->global_model->sanitizeString($this->input->post('receptionTrId')),
				'inn_occ' 		=> $this->input->post('shelfVolume')[$key],
				'out_occ' 		=> 0,
				'product_id' 	=> $this->global_model->sanitizeString($this->input->post('receptionTrProduct')),
				'warehouse_id' 	=> $this->session->userdata('warehouseid'),
				'ref_occ' 		=> 'reception',
				'row_occ' 		=> $this->input->post('addStockRow')[$key],
				'line_occ' 		=> $this->input->post('addStockLine')[$key],
				'shelf_occ' 	=> $this->input->post('addStockShelf')[$key]
				
			);
		}
		if(!empty($occ)) {
			$this->db->insert_batch('occupancy', $occ);
			$this->session->set_flashdata('receptionStorageSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("reception_storage_added_success").'</div>');
		} else {
			$this->session->set_flashdata('receptionStorageError', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("reception_storage_not_added").'</div>');
		}
		redirect('transfers/received');
	}
	
	
	
	
	
	
	
	
 
}