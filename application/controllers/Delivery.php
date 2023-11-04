<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Delivery extends CI_Controller {
 
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
		$this->lang->load('info','english');
	  
	}
	
	public function switchLang($language = "") {
		$this->session->set_userdata('site_lang', $language);
		redirect(current_url());
	}
	
	//LIST OF ORDERS RECEIVED
	public function orders(){
		
		$data['title'] = $this->lang->line('orders');
		$data['activedrop'] = 'del';
		$data['activemenu'] = 'custord';
		$data['orders'] = $this->global_model->RetreiveOrderedData('clientorders',['warehouse_id' => $this->session->userdata('warehouseid')],'datetime','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('deliveries/orders');
		$this->load->view('inc/footer');
	}
	
	//CREATE NEW CUSTOMER ORDER
	public function createorder(){
		
		$data['title'] = $this->lang->line('new_customer_order');
		$data['activedrop'] = 'del';
		$data['customers'] = $this->global_model->RetreiveData('clients',['status' => 1]);
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid'), 'status' => 1]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('deliveries/createorder');
		$this->load->view('inc/footer');
	}
	
	//LIST OF DELIVERY NOTES
	public function deliveryList(){
		
		$data['title'] = $this->lang->line('delivery_notes');
		$data['activedrop'] = 'del';
		$data['activemenu'] = 'custdel';
		$data['deliveries'] = $this->global_model->RetreiveOrderedData('deliveries',['warehouse_id' => $this->session->userdata('warehouseid')],'delivery_id','desc');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('deliveries/deliveries');
		$this->load->view('inc/footer');
	}
	
	//CREATE DELIVERY NOTE FROM A CUSTOMER ORDER
	public function deliveryNote(){
		
		$data['title'] = $this->lang->line('delivery_note');
		$data['activedrop'] = 'del';
		$orderId = $this->global_model->sanitizeString($this->input->post('orderId'));
		$data['orderRow'] = $this->global_model->RetreiveRow('clientorders', ['order_id' => $orderId]);
		$data['orderDetails'] = $this->global_model->RetreiveData('clientorder_details',['order_id' => $orderId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('deliveries/deliverynote');
		$this->load->view('inc/footer');
	}
	
	//PICK DELIVERY
	public function pickDelivery(){
		
		$data['title'] = $this->lang->line('pick_delivery');
		$deliveryId = $this->global_model->sanitizeString($this->input->post('pickDelivId'));
		$data['deliveryRow'] = $this->global_model->RetreiveRow('deliveries', ['delivery_id' => $deliveryId]);
		$data['deliveryDetails'] = $this->global_model->RetreiveData('delivery_details',['delivery_id' => $deliveryId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('pickpack/pickDelivery');
		$this->load->view('inc/footer');
	}
	
	//PACK DELIVERY
	public function packDelivery(){
		
		$data['title'] = $this->lang->line('pack_delivery');
		$deliveryId = $this->global_model->sanitizeString($this->input->post('packDelivId'));
		$data['deliveryRow'] = $this->global_model->RetreiveRow('deliveries', ['delivery_id' => $deliveryId]);
		$data['deliveryDetails'] = $this->global_model->RetreiveData('delivery_details',['delivery_id' => $deliveryId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('pickpack/packDelivery');
		$this->load->view('inc/footer');
	}
	
	//DELIVERY PACKINGSLIP
	public function packingList($id)
	{
    if (!$this->global_model->itemExist('deliveries', 'delivery_id', $id)) {
		$this->session->set_flashdata('deliverynotexist', '<div class="alert alert-danger"> '.$this->lang->line('product_not_exist').'</div>');
		redirect('customers/deliveries');
	} elseif($this->global_model->getItem('deliveries', 'delivery_id', $id, 'packed') == 0) {
		$this->session->set_flashdata('deliverynotpacked', '<div class="alert alert-danger"> '.$this->lang->line('delivery_not_packed').'</div>');
		redirect('customers/deliveries');
	} else {		
	$data['title'] = $this->lang->line('packing_slip');
	$data['companyRow'] = $this->db->where(['id' => 1])->get('companysettings')->row();
	$data['deliveryRow'] = $this->db->where(['delivery_id' => $id])->get('deliveries')->row();
	$data['deliveryDetails'] = $this->global_model->RetreiveData('delivery_details',['delivery_id' => $id]);
	
    $this->load->view('inc/header',$data);
	//$this->load->view('inc/topheader',$data);
	//$this->load->view('inc/sidebar');
	$this->load->view('pickpack/packinglist', $data);
	$this->load->view('inc/footer-print');
	}
  }
  
  //LOAD DELIVERY
	public function loadDelivery(){
		
		$data['title'] = $this->lang->line('load_delivery');
		$deliveryId = $this->global_model->sanitizeString($this->input->post('loadDelivId'));
		$data['deliveryRow'] = $this->global_model->RetreiveRow('deliveries', ['delivery_id' => $deliveryId]);
		$data['deliveryDetails'] = $this->global_model->RetreiveData('delivery_details',['delivery_id' => $deliveryId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('deliveries/loadDelivery');
		$this->load->view('inc/footer');
	}
	
	//ADD NEW PRODUCT TO ORDER LIST
	public function addProductToCustomerOrder () {
		$prId = $this->global_model->sanitizeString($this->input->post('prId'));
		$qty = $this->global_model->sanitizeString($this->input->post('qty'));
		$stock = $this->product_model->productInventory ($prId, $this->session->userdata('warehouseid'));
		if($stock==0 OR $stock=="" OR $stock < $qty) {
			$result='notenoughstock';
		} else {
			$result = $this->delivery_model->addProductToCustomerOrder ($prId, $qty);
		}
		
		echo json_encode($result);
	}
	
	//SAVE CUSTOMER ORDER 
	public function storeorder()
	{
        if($this->global_model->sanitizeString($this->input->post('custDeliveryLimit'))) {
			$limited_period = 1;
			$delivery_limit = $this->global_model->sanitizeString($this->input->post('custDeliveryLimit'));
		 } else {
			$limited_period = 0;
			$delivery_limit = date("Y-m-d");
		 }
		//insert order
		$custorder = array (
          'order_code'   => $this->global_model->sanitizeString($this->input->post('custOrderCode')),
		  'datetime' 		=> $this->global_model->sanitizeString($this->input->post('custOrderDate')),
		  'client_id'   => $this->global_model->sanitizeString($this->input->post('custCustomer')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'limited_period' 		=> $limited_period,
		  'delivery_limit' 		=> $delivery_limit,
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('clientorders', $custorder);
		$order_id = $this->db->insert_id();
		if($order_id) {
			$result = array();
			$volume=0;
			$weight=0;
			foreach ($this->input->post("orderPrId") as $key => $val) {
				$volume = $this->product_model->singleProductVolume( $this->input->post('orderPrId')[$key])* floatval($this->input->post('orderPrQty')[$key]);
				$weight = $this->product_model->singleProductWeight( $this->input->post('orderPrId')[$key])* floatval($this->input->post('orderPrQty')[$key]);
				$result[] = array(             
					'order_id'     => $order_id,
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('orderPrId')[$key],
					'qty' 	   => $this->input->post('orderPrQty')[$key],
					'volume'      => $volume,
					'weight'   => $weight
				);      
			}      
			$this->db->insert_batch('clientorder_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				$this->session->set_flashdata('addCustOrderSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("customer_order_added_success").'</div>');
				redirect('customers/orders/new');
			} else {
				$this->session->set_flashdata('addCustOrderWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("customer_order_added_without_details").'</div>');
				redirect('customers/orders/new');
			}
		} else {
			$this->session->set_flashdata('addCustOrderError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("customer_order_not_added").'</div>');
				redirect('customers/orders/new');
		}
	}
	
	//SAVE  DELIVERY 
	public function savedelivery()
	{
        
		//insert order
		$delivery = array (
          'delivery_code'   => $this->global_model->sanitizeString($this->input->post('deliveryCode')),
		  'datetime' 		=> date("Y-m-d"),
		  'client_id'   => $this->global_model->sanitizeString($this->input->post('deliverySupplierId')),
		  'client_order'   => $this->global_model->sanitizeString($this->input->post('deliveryCustOrderId')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('deliveries', $delivery);
		$delivery_id = $this->db->insert_id();
		if($delivery_id) {
			$result = array();
			$volume=0;
			$weight=0;
			foreach ($this->input->post("cpoPrId") as $key => $val) {
				$volume = $this->product_model->singleProductVolume( $this->input->post('cpoPrId')[$key])* floatval($this->input->post('apprQty')[$key]);
				$weight = $this->product_model->singleProductWeight( $this->input->post('cpoPrId')[$key])* floatval($this->input->post('apprQty')[$key]);
				$result[] = array(             
					'delivery_id'     => $delivery_id,
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('cpoPrId')[$key],
					'order_qty' 	   => $this->input->post('cpoQty')[$key],
					'qty' 	   => $this->input->post('apprQty')[$key],
					'volume'      => $volume,
					'weight'   => $weight
				);      
			}      
			$this->db->insert_batch('delivery_details',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				//change the status of the customer order to approved 
				$action = array (
					'approved' => 1
				);
				$this->db->where(['order_id' => $this->global_model->sanitizeString($this->input->post('copId'))])->update('clientorders', $action);
				
				
				//display success message
				$this->session->set_flashdata('addDeliverySuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("delivery_created_success").'</div>');
				redirect('customers/deliveries');
			} else {
				$this->session->set_flashdata('addDeliveryWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("delivery_created_without_details").'</div>');
				redirect('customers/deliveries');
			}
		} else {
			$this->session->set_flashdata('addDeliveryError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("delivery_not_created").'</div>');
				redirect('customers/deliveries');
		}
	}
	
	
	//GET THE PICK UP DETAILS OF A SPECIFIC PRODUCT
		public function getProductPickupDetails ($productId, $deliveryId) {
			$content='';
			$this->db->select("*");
			$this->db->from('occupancy_tmp');
			$this->db->where('delivery_id', $deliveryId);
			$this->db->where('product_id', $productId);
			$records = $this->db->get();
			if($records->result()) {
				$content .='<ul class="list-unstyled">';
				foreach($records->result() as $record) {
					$content .='<li class="list-group-item d-flex justify-content-between align-items-center py-1">';
					$content .='Location: R'.$record->row_occ.'-L'.$this->warehouse_model->getRealLocation($record->line_occ).'-S'.$record->shelf_occ;
					$content .='<span class="text-primary">'.number_format($record->out_occ,2).' '.$this->lang->line("cubic_meter").'</span>';
					$content .='</li>';
				}
				$content .='</ul>';
			}
			
			return $content;
		}
		
	//GET DETAILS OF DELIVERY & PRODUCT TO MANAGE THE STORAGE LOCATION -- PICKUP OPERATION
	public function getproductDetailsFromDelivery() {
		$deliveryId = $this->global_model->sanitizeString($this->input->post('deliveryId'));
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		//Delivery Code 
		$data['deliveryCode'] = $this->global_model->getItem('deliveries', 'delivery_id', $deliveryId, 'delivery_code');
		//Delivery Date 
		$deliveryDate = $this->global_model->getItem('deliveries', 'delivery_id', $deliveryId, 'datetime');
		$data['deliveryDate'] = $this->global_model->setDateFormat($deliveryDate, $this->global_model->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'dateFormat'));
		//Product Barcode 
		$data['productBarcode'] = $this->global_model->getItem('products', 'product_id', $productId, 'product_barcode');
		//Product Name 
		$data['productName'] = $this->global_model->getItem('products', 'product_id', $productId, 'product_name');
		//Product Volume 
		$qty = $this->global_model->getItemMultiConditions('delivery_details', ['delivery_id' =>$deliveryId, 'product_id' => $productId], 'qty');
		$data['qty'] = $qty;
		$data['warehouseId'] = $this->session->userdata('warehouseid');
		$data['productVolume'] = number_format((floatval($this->product_model->singleProductVolume( $productId)) * $qty),2);
		//List of storage positions
		$data['storagepos'] = $this->storage_model->delivery_storage_positions_by_product ($productId);
		
		echo json_encode($data);
		
		
	}
	//update inventory when saving delivery
	public function updateInventory () {
		$stock = array (
          'dateinventory'   => date("Y-m-d"),
		  'inn' 			=> 0,
		  'out_inv' 		=> $this->global_model->sanitizeString($this->input->post('outQty')),
		  'product_id' 		=> $this->global_model->sanitizeString($this->input->post('productId')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'transfer_id' 	=> 0,
		  'delivery_id' 	=> $this->global_model->sanitizeString($this->input->post('deliveryId')),
		  'order_id' 		=> 0,
		  'lot' 			=> 'Delivery #'.$this->global_model->sanitizeString($this->input->post('deliveryId')),
		  'return_id' 		=> 0	
        );
		
        $this->db->insert('inventory', $stock);
		$inventory_id = $this->db->insert_id();
		echo json_encode($inventory_id);
	}
	
	//DELIVERY -- make the selected product as loaded
	public function updateProductLoading () {
		$product_id 		= $this->global_model->sanitizeString($this->input->post('productId'));
		$delivery_id  	= $this->global_model->sanitizeString($this->input->post('deliveryId'));
		$data = array(
			'loaded' => 1
		);

		$this->db->where(['delivery_id' => $delivery_id, 'product_id' => $product_id] );
		$this->db->update('delivery_details', $data);
		$result = 'loaded';
		echo json_encode($result);
	}
	
	//DELIVERY -- save the storage location of the picked product 
	public function saveDeliveryPickup () {
		$delivery_id  	= $this->global_model->sanitizeString($this->input->post('delivery_id'));
		$occ = array (
          'date_occ'   		=> date("Y-m-d"),
		  'inventory_id' 	=> $this->global_model->sanitizeString($this->input->post('inventory_id')),
		  'delivery_id' 	=> $this->global_model->sanitizeString($this->input->post('delivery_id')),
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
		//check if all products ae picked ==> make the delivery as totally picked
		$nonDelivProducts = $this->global_model->countItemsMultiConditions('delivery_details', ['delivery_id' => $delivery_id, 'loaded' => 0 ]);
		if($nonDelivProducts == 0) {
			$data = array(
				'picked' => 1
			);

			$this->db->where(['delivery_id' => $delivery_id] );
			$this->db->update('deliveries', $data);
		}
		echo json_encode($occ_id);
	}
	
	//APPROVE PRODUCT PACKING -- DELIVERY
	public function approveProductPack() {
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		$deliveryId = $this->global_model->sanitizeString($this->input->post('deliveryId'));
		
		$action = array (
			'packed' => 1
		);
		$this->db->where(['product_id' => $productId, 'delivery_id' => $deliveryId])->update('delivery_details', $action);	$result = 'action';
		//check if all products are packed ==> make the delivery as totally packed
		$nonPackedProducts = $this->global_model->countItemsMultiConditions('delivery_details', ['delivery_id' => $deliveryId, 'packed' => 0 ]);
		if($nonPackedProducts == 0) {
			$data = array(
				'packed' => 1
			);

			$this->db->where(['delivery_id' => $deliveryId] );
			$this->db->update('deliveries', $data);
		}
		$result ='packed';
		echo json_encode($result);
	}
	
	//APPROVE DELIVERY LOADING
	public function approveDeliveryLoading()
	{
        
		//insert order
		$loading = array (
          'reference'   => 'Delivery',
		  'reference_id'   => $this->global_model->sanitizeString($this->input->post('loadingDeliveryId')),
		  'warehouse_id'   => $this->global_model->sanitizeString($this->input->post('loadingWarehouse')),
		  'transport_date' 		=> $this->global_model->sanitizeString($this->input->post('loadingDeliveryDate')),
		  'vehicle_registration'   => $this->global_model->sanitizeString($this->input->post('loadingVehicleRegistration')),
		  'driver_name'   => $this->global_model->sanitizeString($this->input->post('loadingDriverName')),
		  'driver_id_number' 	=> $this->global_model->sanitizeString($this->input->post('loadingDriverIdNumber')),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('loadings', $loading);
		$loading_id = $this->db->insert_id();
		if($loading_id) {
			//make the delivery as loaded
			$data = array(
				'delivered' => 1
			);

			$this->db->where(['delivery_id' => $this->global_model->sanitizeString($this->input->post('loadingDeliveryId'))] );
			$this->db->update('deliveries', $data);
			//display success message
			$this->session->set_flashdata('addLoadingSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("loading_approved_success").'</div>');
			redirect('customers/deliveries');
		} else {
			//display error message
			$this->session->set_flashdata('addDeliveryError', '<div class="alert alert-error"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("loading_approved_error").'</div>');
			redirect('customers/deliveries');
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 
}