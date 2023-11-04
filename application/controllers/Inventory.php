<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Inventory extends CI_Controller {
 
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
		
		$data['title'] = $this->lang->line('inventory_control');
		$data['activedrop'] = 'inv';
		$data['activemenu'] = 'invctrl';
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid'), 'status' => 1]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('inventory/index');
		$this->load->view('inc/footer');
	}
	
	//ECONOMIC ORDER QUANTITY
	public function eoq(){
		
		$data['title'] = $this->lang->line('economic_order_qty');
		$data['activedrop'] = 'inv';
		$data['activemenu'] = 'eoq';
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid'), 'status' => 1]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('inventory/eoq');
		$this->load->view('inc/footer');
	}
	
	//PHYSICAL INVENTORY
	public function physicalInventory(){
		
		$data['title'] = $this->lang->line('physical_inventory');
		$data['activedrop'] = 'inv';
		$data['activemenu'] = 'phyinv';
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid')]);
		/* DISPLAY ONLY LAST INVENTORY */
		$lastInvId = $this->global_model->getLastId('physical_inventories', 'id');
		$data['inventories'] = $this->global_model->RetreiveData('physical_inventories',['warehouse_id' => $this->session->userdata('warehouseid'), 'YEAR(creation_date)' => date('Y'), 'id' => $lastInvId]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('inventory/physinv');
		$this->load->view('inc/footer');
	}
	
	//STORAGE POSITIONS
	public function storagepos(){
		
		$data['title'] = $this->lang->line('storage_positions');
		$data['activedrop'] = 'inv';
		$data['activemenu'] = 'strpos';
		$data['products'] = $this->global_model->RetreiveData('products',['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('inventory/storagepos');
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
	
	//SAVE NEW PHYSICAL INVENTORY -- 
	public function createPhysInventory()
	{
        //form validation
		$this->form_validation->set_rules('inventoryDesignation',$this->lang->line('designation'), 'trim|required|is_unique[physical_inventories.designation]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
		if ($this->form_validation->run()) {
		$inv = array (
          'warehouse_id'        => $this->session->userdata('warehouseid'),
		  'designation'          => $this->global_model->sanitizeString($this->input->post('inventoryDesignation'))
        );
		//inseert
        $this->db->insert('physical_inventories', $inv);
		$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('inventory_added_success').'</div>');
		redirect('inventory/physical-inventory');
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('data',$inv);
			redirect(base_url('inventory/physical-inventory'));
		}
	}
	
	//ADD  PHYSICAL QTY -- 
	public function addPhysicalInventory()
	{
       $prId = $this->global_model->sanitizeString($this->input->post('productId'));
	   $prStock = $this->product_model->productInventory ($prId, $this->session->userdata('warehouseid'));
	   $invDetail = array (
          'invId'          => $this->global_model->sanitizeString($this->input->post('invId')),
		  'warehouseId'   => $this->session->userdata('warehouseid'),
		  'productId'      => $prId,
		  'stock'          => $prStock,
		  'invCount'       => $this->global_model->sanitizeString($this->input->post('invQty'))
        );
		//inseert
        $this->db->insert('phys_inv_details', $invDetail);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	//GET  INVENTORY DETAILS -- 
	public function getInventoryDetails()
	{
       $prId = $this->global_model->sanitizeString($this->input->post('productId'));
	   $invId = $this->global_model->sanitizeString($this->input->post('invId'));
	   $productName = $this->global_model->getItem('products', 'product_id',$prId,'product_name');
	   $productBarcode = $this->global_model->getItem('products', 'product_id',$prId,'product_barcode');
	   /* *****
	   VERY IMPORTANT : Stock should be the current stock AND NOT the stock existing in the inventory details
	   */
	   $prStock = $this->product_model->productInventory ($prId, $this->session->userdata('warehouseid'));
	   /* *****
	   Last Physical Stock added is the same qty existing in the inventory details
	   */
	   $physQty = $this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$invId, 'productId'=>$prId], 'invCount');
		
		$result['productName'] = $productName;
		$result['productBarcode'] = $productBarcode;
		$result['stock'] = $prStock;
		$result['physQty'] = $physQty;
		
		echo json_encode($result);
	}
	
	//UPDATE  INVENTORY PHYSICAL  QTY -- 
	public function updatePhysQty()
	{
       $operationDate = date("Y-m-d");
	   
	   $invDetail = array (
		  'stock_date'     => $operationDate,
		  'invCount'       => $this->global_model->sanitizeString($this->input->post('physQty')),
		  'invDate'       => $operationDate
        );
		
		/** Here, we want to display a return message (success / failure) **/
		if($this->db->where(['productId' => $this->global_model->sanitizeString($this->input->post('prId')), 'invId' => $this->global_model->sanitizeString($this->input->post('invId'))] )->update('phys_inv_details', $invDetail)) {
			$result['message'] = '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('phys_qty_updated_success').'</div>';
		} else {
			$result['message'] = '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> '.$this->lang->line('phys_qty_updated_failure').'</div>';
		}
		
		echo json_encode($result);
	}
	
	//ADJUST  STOCK -- 
	public function adjustInventory()
	{
       $invId = $this->global_model->sanitizeString($this->input->post('invId'));
	   $productId = $this->global_model->sanitizeString($this->input->post('productId'));
	   $operationDate = date("Y-m-d");
	   // retreiving the stock from inventory details 
	   $stock      = $this->product_model->productInventory ($productId, $this->session->userdata('warehouseid'));
	   $physStock = $this->global_model->getItemMultiConditions('phys_inv_details', ['invId'=>$invId, 'productId'=>$productId], 'invCount');
	   // if stock > Physical quantity => decrease the difference from stock
	   $difference = 0;
	   $result = "notdone";
	   if(floatval($stock)> floatval($physStock)) {
		   $difference = floatval($stock)- floatval($physStock);
		   //decrease the difference
		   $inv = array (
				'dateinventory'   => $operationDate,
				'inn' 			  => 0,
				'out_inv' 		  => $difference,
				'product_id' 	  => $productId,
				'warehouse_id' 	  => $this->session->userdata('warehouseid'),
				'transfer_id' 	  => 0,
				'delivery_id' 	  => 0,
				'order_id' 		  => 0,
				'lot' 			  => $this->lang->line('inventory_adjust'),
				'return_id' 	  => 0	
			);
			$this->db->insert('inventory', $inv);
			$inventory_id = $this->db->insert_id();
			// add the inventory id to the table inventory_adjustments 
			/**** This will be used later to retreive only the rows after the adjustment and not all the inventory rows  ****/
			$adj = array (
				'warehouseId'     => $this->session->userdata('warehouseid'),
				'productId' 	  => $productId,
				'inventoryId' 	  => $inventory_id,
				'startingStock'   => $stock
			);
			$this->db->insert('inventory_adjustments', $adj);
			
			$result ="done";
			
		// if stock < Physical quantity => increase the difference from stock
	   } elseif(floatval($stock) < floatval($physStock)) {
		   $difference = floatval($physStock)- floatval($stock);
		   //increase the difference
		   $inv = array (
				'dateinventory'   => $operationDate,
				'inn' 			  => $difference,
				'out_inv' 		  => 0,
				'product_id'      => $productId,
				'warehouse_id' 	  => $this->session->userdata('warehouseid'),
				'transfer_id' 	  => 0,
				'delivery_id' 	  => 0,
				'order_id' 		  => 0,
				'lot' 			  => $this->lang->line('inventory_adjust'),
				'return_id' 	  => 0	
			);
			$this->db->insert('inventory', $inv);
			$inventory_id = $this->db->insert_id();
			// add the inventory id to the table inventory_adjustments 
			/**** This will be used later to retreive only the rows after the adjustment and not all the inventory rows  ****/
			$adj = array (
				'warehouseId'     => $this->session->userdata('warehouseid'),
				'productId' 	  => $productId,
				'inventoryId' 	  => $inventory_id,
				'startingStock'   => $stock
			);
			$this->db->insert('inventory_adjustments', $adj);
			
			$result ="done";
	   }
	   
		echo json_encode($result);
	}
	
	//PRODUCT STORAGE POSITIONS
	public function productStoragePositions()
	{
		$productId = $this->input->post('productId');
		
		$data= $this->inventory_model->displayProductStoragePos($productId);
		echo json_encode($data);
		
	}
	
	//GET LAST INVENTORY ID
	public function getLastInventoryId()
	{

		$lastInvId= $this->global_model->getLastId('inventory', 'inventory_id');
		echo json_encode($lastInvId);
		
	}
	
	
	
	
	
 
}