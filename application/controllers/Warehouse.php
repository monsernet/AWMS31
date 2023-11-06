<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Warehouse extends CI_Controller {
 
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
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){
			$warhId = $this->global_model->sanitizeString($this->input->post('warhId'));
			//WAREHOUSE SESSION 
			$this->session->set_userdata('warehouseid', $warhId);
		} else {
			$warhId = $this->session->userdata('warehouseid');
		}
		
		$warehouseName = $this->global_model->getItem('warehouses', 'id', $warhId, 'warehouseName');
		$data['activemenu'] = 'dash';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$data['title'] = $warehouseName;
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar',$data);
		$this->load->view('warehouse/index');
		$this->load->view('inc/footer');
		
	}
	
	public function create(){
		
		
		$data['activemenu'] = 'warh';
		
		$data['title'] = $this->lang->line('new_warehouse');
		$data['inventorySystems'] = $this->global_model->RetreiveData('inventory_systems','');
		$data['storageSystems'] = $this->global_model->RetreiveData('storage_systems','');
		$data['inventoryTecgniques'] = $this->global_model->RetreiveData('inventory_techniques','');
		$data['pickingMethods'] = $this->global_model->RetreiveData('picking_methods','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar',$data);
		$this->load->view('warehouse/createwarehouse');
		$this->load->view('inc/footer');
		
	}
	
	//SAVE NEW WAREHOUSE 
	public function save()
	{
        
		//insert warehouse
		$warh = array (
          'warehouseName'   => $this->global_model->sanitizeString($this->input->post('nw_warehouseName')),
		  'address' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehouseAddress')),
		  'city'  		    => $this->global_model->sanitizeString($this->input->post('nw_warehouseCity')),
		  'country' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehouseCountry')),
		  'manager' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehouseManager')),
		  'contact' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehousePhone')),
		  'mobile' 			=> $this->global_model->sanitizeString($this->input->post('nw_warehouseMobile'))
        );
		
        $this->db->insert('warehouses', $warh);
		$warh_id = $this->db->insert_id();
		if($warh_id) {
			//insert warehouse dimensions
			$warhDim = array (
			  'warehouseId'   => $warh_id ,
			  'warhLength' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehouseLength')),
			  'warhWidth'  		    => $this->global_model->sanitizeString($this->input->post('nw_warehouseWidth')),
			  'warhHeigth' 		=> $this->global_model->sanitizeString($this->input->post('nw_warehouseHeigth')),
			  'office' 		=> $this->global_model->sanitizeString($this->input->post('nw_officeSpace')),
			  'restroom' 		=> $this->global_model->sanitizeString($this->input->post('nw_restroomSpace')),
			  'otherFreeSpace' 			=> $this->global_model->sanitizeString($this->input->post('nw_otherSpace')),
			  'storage_cost_rate' 			=> $this->global_model->sanitizeString($this->input->post('nw_storageCostRate'))
			);
			
			$this->db->insert('warh_dimensions', $warhDim);
			$dim_id = $this->db->insert_id();
			
			//insert storage dimensions
			$storDim = array (
			  'warehouseId'   => $warh_id ,
			  'StorageLength' 		=> $this->global_model->sanitizeString($this->input->post('nw_storageLength')),
			  'StorageWidth'  		    => $this->global_model->sanitizeString($this->input->post('nw_storageWidth')),
			  'StorageHeight' 		=> $this->global_model->sanitizeString($this->input->post('nw_storageHeigth')),
			  'stockType' 		=> $this->global_model->sanitizeString($this->input->post('nw_stockType'))
			);
			
			$this->db->insert('storage_area', $storDim);
			$stor_id = $this->db->insert_id();
			
			//insert racking settings
			$racking = array (
			  'warehouseId'   => $warh_id ,
			  'rackingSystem' 		=> $this->global_model->sanitizeString($this->input->post('nw_rackingSystem')),
			  'inventorySystem'  		    => $this->global_model->sanitizeString($this->input->post('nw_inventorySystem')),
			  'storageSystem' 		=> $this->global_model->sanitizeString($this->input->post('nw_storageSystem')),
			  'rackHeight' 		=> $this->global_model->sanitizeString($this->input->post('nw_rackHeight')),
			  'rackLength' 		=> $this->global_model->sanitizeString($this->input->post('nw_rackLength')),
			  'rackWidth'  		    => $this->global_model->sanitizeString($this->input->post('nw_rackWidth')),
			  'shelfHeight' 		=> $this->global_model->sanitizeString($this->input->post('nw_shelfHeight')),
			  'aisle' 		=> $this->global_model->sanitizeString($this->input->post('nw_aisleWidth'))
			);
			
			$this->db->insert('storage_racking', $racking);
			$rack_id = $this->db->insert_id();
			
			//insert inventory settings
			$inv = array (
			  'warehouse_id'   => $warh_id ,
			  'inventory_technique' 		=> $this->global_model->sanitizeString($this->input->post('nw_inventoryTechnique')),
			  'pickpack_method'  		    => $this->global_model->sanitizeString($this->input->post('nw_pickPackMethod')),
			  'aisle_label_format' 		=> 1,
			  'bay_label_format' 		=> 1,
			  'shelf_label_format' 		=> 1,
			  'bin_label_format'  		    => 1,
			  'holding_cost' 		=> 0,
			  'ordering_cost' 		=> 0
			);
			
			$this->db->insert('inventory_settings', $inv);
			$inv_id = $this->db->insert_id();
			
			//insert locale settings ****** These are default settings, you can change them as you wish from the menu GENERAL SETTINGS >> LOCALE SETTINGS 
			$localSett = array (
			  'warehouseId'         => $warh_id ,
			  'lang' 		        => 1,             // ENGLISH
			  'multiLang'  		    => 0,             // MULTI LANG NOT AUTORIZED -- you can change it later
			  'tzone' 				=> 'UTC',		  // GMT time
			  'firstDay' 			=> 2,             // Monday
			  'dateFormat' 			=> 'mm-dd-yyyy',             
			  'timeFormat'  	    => 1,             // 24 hours
			  'defaultCurrency' 	=> 1,             // first currency : USD
			  'decimalDigits' 		=> 1,             // 2 decimal digits
			  'useThSep' 	  		=> 1,             // yes, use thousand seperator
			  'thSepChar' 	  		=> 2              // use comma (,) as thousand seperator
			);
			
			$this->db->insert('settings', $localSett);
			$loc_id = $this->db->insert_id();
			
			//Login & Session --> Default Settings
			$loginSess = array (
			  'warehouse_id'         => $warh_id ,
			  'session_timeout' 	 => 1,             // SEssion cleared after 180 minutes
			  'login_attempts'       => 3,             // Number of login attempts
			  'wrong_attempts' 	   	 => 3		       // Number of wrong attempts
			);
			
			$this->db->insert('login_sessions', $loginSess);
			$log_id = $this->db->insert_id();
			
			//Email Settings --> Default Settings
			$emailSett = array (
			  'warehouse_id'         => $warh_id ,
			  'email_method' 	 	 => 'phpmail',              // by default, the PHPMAIL function is used
			  'sender_name'       	 => 'Admin',             	// you can change it in the setting page
			  'sender_email' 	   	 => 'info@mail.com',	    // you have to change it in the setting page and put your email
			  'mail_server' 	   	 => 'NA',	                // with PHPMAIL, no need to put email server, so we put as default 'NA'
			  'mail_port' 	   	 	 => 0,	       				// No port required 
			  'mail_password' 	   	 => ''	                    // You have to change with your email password, otherwise, email wkll not work.
			);
			
			$this->db->insert('email_settings', $emailSett);
			$email_id = $this->db->insert_id();
			
			//Product Barcoding --> Default Settings
			$prodBar = array (
			  'warehouse_id'         => $warh_id ,
			  'barcode_technology' 	 => 1,                      // Linear barcode
			  'barcode_type'       	 => 2,             	        // code-128
			  'paper_size' 	   	 	 => 1,	                    // A4 size
			  'paper_orientation' 	 => 1,	                    // Landscape orientation'
			  'margin_top' 	   	 	 => 3,	       				// 3mm margin top
			  'margin_bottom' 	   	 => 3,	                    // 3mm margin bottom.
			  'margin_left' 	   	 => 3,	                    // 3mm margin left.
			  'margin_right' 	   	 => 3,	                    // 3mm margin right.
			  'barcodes_row' 	   	 => 3,	                    // 3 barcodes per row -- horizontal row.
			  'barcodes_col' 	   	 => 12,	                    // 12 barcodes per column -- vertical column.
			  'barcode_padding' 	 => 0	               	    // barcode paddings.
			);
			
			$this->db->insert('barcoding_products', $prodBar);
			$prodbar_id = $this->db->insert_id();
			
			//Package Barcoding --> Default Settings
			$packBar = array (
			  'warehouse_id'         => $warh_id ,
			  'barcode_technology' 	 => 1,                      // Linear barcode
			  'barcode_type'       	 => 2,             	        // code-128
			  'paper_size' 	   	 	 => 1	                    // A4 size
			);
			
			$this->db->insert('barcoding_packs', $packBar);
			$packbar_id = $this->db->insert_id();
			
			//EOQ Settings --> Default Settings
			$eoqSett = array (
			  'warehouse_id'         => $warh_id ,
			  'holdingCost' 		=> 0,
			  'orderingCost' 		=> 0
			);
			
			$this->db->insert('eoq_settings', $eoqSett);
			$eoq_id = $this->db->insert_id();
			
			
			
			redirect('home');
			
		} else {
			$this->session->set_flashdata('addWarhError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("warehouse_not_added").'</div>');
				redirect('home');
		}
	}
	
	public function layout(){
		
		
		$data['title'] = $this->lang->line('warehouse_layout');
		$data['activemenu'] = 'warlay';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('warehouse/layout');
		$this->load->view('inc/footer');
		
	}
	
	//UPDATE WAREHOUSE INFORMATION
	public function updateWarehouseInformation() {
		$warehouseName = $this->global_model->sanitizeString($this->input->post('warehouseName'));
		$warehouseAddress = $this->global_model->sanitizeString($this->input->post('warehouseAddress'));
		$warehouseCity = $this->global_model->sanitizeString($this->input->post('warehouseCity'));
		$warehouseCountry = $this->global_model->sanitizeString($this->input->post('warehouseCountry'));
		$warehouseManager = $this->global_model->sanitizeString($this->input->post('warehouseManager'));
		$warehousePhone = $this->global_model->sanitizeString($this->input->post('warehousePhone'));
		$warehouseMobile = $this->global_model->sanitizeString($this->input->post('warehouseMobile'));
		
		$infos = array (
			'warehouseName' => $warehouseName,
			'address' => $warehouseAddress,
			'city' => $warehouseCity,
			'country' => $warehouseCountry,
			'manager' => $warehouseManager,
			'contact' => $warehousePhone,
			'mobile' => $warehouseMobile
		);
		$this->db->where(['id' => $this->session->userdata('warehouseid')])->update('warehouses', $infos);
		$result = $this->lang->line('warehouse_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE WAREHOUSE SETTINGS
	public function updateWarehouseSettings() {
		$warhLength = $this->global_model->sanitizeString($this->input->post('warhLength'));
		$warhWidth = $this->global_model->sanitizeString($this->input->post('warhWidth'));
		$warhHeight = $this->global_model->sanitizeString($this->input->post('warhHeight'));
		$storageZoneLength = $this->global_model->sanitizeString($this->input->post('storageZoneLength'));
		$storageZoneWidth = $this->global_model->sanitizeString($this->input->post('storageZoneWidth'));
		$storageZoneHeight = $this->global_model->sanitizeString($this->input->post('storageZoneHeight'));
		$officeArea = $this->global_model->sanitizeString($this->input->post('officeArea'));
		$restroomArea = $this->global_model->sanitizeString($this->input->post('restroomArea'));
		$otherArea = $this->global_model->sanitizeString($this->input->post('otherArea'));
		$stockType = $this->global_model->sanitizeString($this->input->post('stockType'));
		$storageCost = $this->global_model->sanitizeString($this->input->post('storageCost'));
		
		$infos = array (
			'warhLength' => $warhLength,
			'warhWidth' => $warhWidth,
			'warhHeigth' => $warhHeight,
			'office' => $officeArea,
			'restroom' => $restroomArea,
			'otherFreeSpace' => $otherArea,
			'storage_cost_rate' => $storageCost
		);
		$storageInfos = array (
			'StorageLength' => $storageZoneLength,
			'StorageWidth' => $storageZoneWidth,
			'StorageHeight' => $storageZoneHeight,
			'stockType' => $stockType
		);
		$this->db->where(['id' => $this->session->userdata('warehouseid')])->update('warh_dimensions', $infos);
		$this->db->where(['id' => $this->session->userdata('warehouseid')])->update('storage_area', $storageInfos);
		$result = $this->lang->line('warehouse_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE STORAGE SETTINGS
	public function updateStorageSettings() {
		$rackHeight = $this->global_model->sanitizeString($this->input->post('rackHeight'));
		$rackLength = $this->global_model->sanitizeString($this->input->post('rackLength'));
		$rackWidth = $this->global_model->sanitizeString($this->input->post('rackWidth'));
		$shelfHeight = $this->global_model->sanitizeString($this->input->post('shelfHeight'));
		$aisleWidth = $this->global_model->sanitizeString($this->input->post('aisleWidth'));
		$rackingSystem = $this->global_model->sanitizeString($this->input->post('rackingSystem'));
		$inventorySystem = $this->global_model->sanitizeString($this->input->post('inventorySystem'));
		$storageSystem = $this->global_model->sanitizeString($this->input->post('storageSystem'));
		
		$infos = array (
			'rackingSystem' => $rackingSystem,
			'inventorySystem' => $inventorySystem,
			'storageSystem' => $storageSystem,
			'rackHeight' => $rackHeight,
			'rackLength' => $rackLength,
			'rackWidth' => $rackWidth,
			'shelfHeight' => $shelfHeight,
			'aisle' => $aisleWidth
		);
		
		$this->db->where(['warehouseId' => $this->session->userdata('warehouseid')])->update('storage_racking', $infos);
		$result = $this->lang->line('storage_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE INVENTORY SETTINGS
	public function updateInventorySettings() {
		$inventoryTechnique = $this->global_model->sanitizeString($this->input->post('inventoryTechnique'));
		$pickPackMethod = $this->global_model->sanitizeString($this->input->post('pickPackMethod'));
		$aisleLabellingFormat = $this->global_model->sanitizeString($this->input->post('aisleLabellingFormat'));
		$bayLabellingFormat = $this->global_model->sanitizeString($this->input->post('bayLabellingFormat'));
		$shelfLabellingFormat = $this->global_model->sanitizeString($this->input->post('shelfLabellingFormat'));
		$binLabellingFormat = $this->global_model->sanitizeString($this->input->post('binLabellingFormat'));
		
		$infos = array (
			'inventory_technique' => $inventoryTechnique,
			'pickpack_method' => $pickPackMethod,
			'aisle_label_format' => $aisleLabellingFormat,
			'bay_label_format' => $bayLabellingFormat,
			'shelf_label_format' => $shelfLabellingFormat,
			'bin_label_format' => $binLabellingFormat
		);
		
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('inventory_settings', $infos);
		$result = $this->lang->line('inventory_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE EOQ SETTINGS
	public function updateEOQSettings() {
		$eoqStorageCosts = $this->global_model->sanitizeString($this->input->post('eoqStorageCosts'));
		$orderingCosts = $this->global_model->sanitizeString($this->input->post('orderingCosts'));
		
		$infos = array (
			'holdingCost' => $eoqStorageCosts,
			'orderingCost' => $orderingCosts
		);
		
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('eoq_settings', $infos);
		$result = $this->lang->line('eoq_settings_updated_success');
		echo json_encode($result);
	}
	
	
	
 

	
 
}