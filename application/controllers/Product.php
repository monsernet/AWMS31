<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Product extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('upload');
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
		
		$data['title'] = $this->lang->line('products');
		$data['activemenu'] = 'prod';
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/index');
		$this->load->view('inc/footer');
		
	}
	public function alertProducts(){
		
		$data['title'] = $this->lang->line('products_in_alert');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/alertproducts');
		$this->load->view('inc/footer');
		
	}
	
	//OUT OF STOCK PRODUCTS
	public function outOfStock(){
		
		$data['title'] = $this->lang->line('products_oos');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/outofstock');
		$this->load->view('inc/footer');
		
	}
	
	//LIST OF CATEGORIES
	public function productCategories(){
		
		$data['title'] = $this->lang->line('categories');
		$data['activemenu'] = 'cat';
		$data['categories'] = $this->global_model->RetreiveData('product_categories','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/categories');
		$this->load->view('inc/footer');
		
	}
	
	//CURRENT STOCK
	public function currentStock(){
		
		$data['title'] = $this->lang->line('current_stock');
		$data['activedrop'] = 'stkctrl';
		$data['activemenu'] = 'currstock';
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/stock');
		$this->load->view('inc/footer');
		
	}
	
	//STOCK MVTs
	public function stockMovements(){
		
		$data['title'] = $this->lang->line('stock_mvt');
		$data['activedrop'] = 'stkctrl';
		$data['activemenu'] = 'stkmvt';
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/stockmvts');
		$this->load->view('inc/footer');
		
	}
	
	//NEW PRODUCT PAGE
	public function create(){
		
		$data['title'] = $this->lang->line('new_product');
		$data['categories'] = $this->global_model->RetreiveData('product_categories','');
		$data['units'] = $this->global_model->RetreiveData('measuring_units','');
		$data['suppliers'] = $this->global_model->RetreiveData('suppliers','');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/create');
		$this->load->view('inc/footer');
		
	}
	
	//EDIT PRODUCT
	public function edit($id)
	{
    if (!$this->global_model->itemExist('products', 'product_id', $id)) {
		$this->session->set_flashdata('prodnotexist', '<div class="alert alert-danger"> '.$this->lang->line('product_not_exist').'</div>');
		redirect('products');
	} else {		
	$data['product'] = $this->db->where(['product_id' => $id])->get('products')->row();
	$data['price'] = $this->db->where(['product_id' => $id])->get('price')->row();
	$data['dimensions'] = $this->db->where(['product_id' => $id])->get('dimensions')->row();
	$data['title'] = $this->lang->line('edit_product');
    $data['categories'] = $this->global_model->RetreiveData('product_categories','');
	$data['units'] = $this->global_model->RetreiveData('measuring_units','');
	$data['suppliers'] = $this->global_model->RetreiveData('suppliers','');
	$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
    $this->load->view('inc/header',$data);
	$this->load->view('inc/topheader',$data);
	$this->load->view('inc/sidebar');
	$this->load->view('products/editproduct');
	$this->load->view('inc/footer');
	}
  }
  
  //EDIT CATEGORY
	public function editCategory($id)
	{
		if (!$this->global_model->itemExist('product_categories', 'category_id', $id)) {
			$this->session->set_flashdata('catnotexist', '<div class="alert alert-danger"> '.$this->lang->line('product_not_exist').'</div>');
			redirect('categories');
		} else {		
		$data['category'] = $this->db->where(['category_id' => $id])->get('product_categories')->row();
		$data['title'] = $this->lang->line('edit_category');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/editcategory');
		$this->load->view('inc/footer');
		}
	}
	
	//NEW CATEGORY
	public function createCategory(){
		
		$data['title'] = $this->lang->line('new_category');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/newcategory');
		$this->load->view('inc/footer');
		
	}
	
	//PRODUCT BARCODING
	public function productBarcoding(){
		
		$data['title'] = $this->lang->line('product_barcoding');
		$data['activemenu'] = 'prodbar';
		$data['products'] = $this->global_model->RetreiveData('products','');
		if($this->global_model->sanitizeString($this->input->post('barcoding_items'))) {
			$data['productRow'] = $this->global_model->RetreiveRow('products', ['product_id' => $this->global_model->sanitizeString($this->input->post('barcoding_items'))]);
			$data['barcodingRow'] = $this->global_model->RetreiveRow('barcoding_products', ['warehouse_id' => $this->session->userdata('warehouseid') ]);
		}
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/barcoding');
		$this->load->view('inc/footer');
		
	}
	
	//PRODUCT QR CODE
	public function productQrcode(){
		
		$data['title'] = $this->lang->line('product_qrcodes');
		$data['activemenu'] = 'prodqr';
		$data['products'] = $this->global_model->RetreiveData('products','');
		if($this->global_model->sanitizeString($this->input->post('barcoding_items'))) {
			$product_id = $this->global_model->sanitizeString($this->input->post('barcoding_items'));
			// If product QR Code does not exist
			if($this->global_model->itemExistMultiConditions('product_qrcodes', ['product_id' => $product_id, 'warehouse_id' => $this->session->userdata('warehouseid') ])==FALSE) 
			{
				// Product data
				$product_name = $this->global_model->getItem('products', 'product_id', $product_id, 'product_name');
				$product_barcode = $this->global_model->getItem('products', 'product_id', $product_id, 'product_barcode');
				$category_id = $this->global_model->getItem('products', 'product_id', $product_id, 'category_id');
				$category_name = $this->global_model->getItem('product_categories', 'category_id', $category_id, 'category_name');
				// QR Code settings
				$ecc_level = $this->global_model->getItem('product_qr_settings', 'warehouse_id', $this->session->userdata('warehouseid'), 'ecc_level');
				$size = $this->global_model->getItem('product_qr_settings', 'warehouse_id', $this->session->userdata('warehouseid'), 'size');
				// add qr code to database
				$content_data =$this->lang->line('product').': '.$product_name.PHP_EOL.$this->lang->line('barcode').': '.$product_barcode.PHP_EOL.$this->lang->line('category').': '.$category_name;
				// Generate QR Code
				$qr = $this->generate_qrcode($content_data, $product_id, $ecc_level, $size );
				// Add QR Code to Database
				if($this->product_model->insert_product_qr_data($qr)) {
					$data['productRow'] = $this->global_model->RetreiveRow('products', ['product_id' => $product_id]);
					$data['qrRow'] = $this->global_model->RetreiveRow('product_qrcodes', ['product_id' => $product_id]);
					$data['qrSettings'] = $this->global_model->RetreiveRow('product_qr_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
				}
			} else {
				//If product QR Code already exuist
				$data['productRow'] = $this->global_model->RetreiveRow('products', ['product_id' => $product_id]);
				$data['qrRow'] = $this->global_model->RetreiveRow('product_qrcodes', ['product_id' => $product_id]);
				$data['qrSettings'] = $this->global_model->RetreiveRow('product_qr_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
			}
		}
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/qrcode');
		$this->load->view('inc/footer');
	}
	
	function generate_qrcode($data, $product_id, $ecc_level, $size)
	{
        // Load QR Code Library 
        $this->load->library('ciqrcode');
        
		//QR Code Image Name
		$hex_data   = bin2hex(random_bytes(10));
        $save_name  = $hex_data.'.png';

        // QR Code File Directory Initialize 
        $dir = 'uploads/qrcodes/products/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        // QR Configuration  
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        // QR Data 
        $params['data']     = $data;
        $params['level']    = $ecc_level;
        $params['size']     = $size;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        // Return Data 
        $return = array(
            'product_id' 		=> $product_id,
			'content' 			=> $data,
            'file'    			=> $dir. $save_name,
			'warehouse_id'    	=> $this->session->userdata('warehouseid')
        );
        return $return;
    }
	
		
	public function store()
	{
		
	  //form validation
    $this->form_validation->set_rules('productBarcode', 'Barcode', 'trim|required|is_unique[products.product_barcode]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
	$this->form_validation->set_rules('productName', 'Name', 'trim|required|is_unique[products.product_name]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
	$this->form_validation->set_rules('productCategory', $this->lang->line('category'), 'trim|required');
	$this->form_validation->set_rules('productUnit', $this->lang->line('unit'), 'trim|required');
	$this->form_validation->set_rules('productVat', $this->lang->line('vat_rate'),'trim|greater_than_equal_to[0]|less_than[100]|required');
	$this->form_validation->set_rules('productCost', $this->lang->line('unit_cost'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productPrice', $this->lang->line('selling_price'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('minimumStock', $this->lang->line('minimum_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('securityStock', $this->lang->line('security_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('maximumStock', $this->lang->line('maximum_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productAlert', $this->lang->line('alert_qty'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productLength', $this->lang->line('package_length'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productWidth', $this->lang->line('package_width'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productHeight', $this->lang->line('package_height'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productWeight', $this->lang->line('package_weight'),'trim|numeric|greater_than[0]|required');
	
	
	// extract uploaded file 
	$config['upload_path'] = './uploads/pictures/products/';
	$config['max_size'] = "2048000"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
	$config['allowed_types'] = "gif|jpg|png|jpeg";
	$config['max_width'] = '1024';
	$config['max_height'] = '768';
	$this->load->library('upload', $config);
	// ------- Upload directory
	$upload_location = $config['upload_path'];
	// ------- To store uploaded files path
	$files_arr = array();
		
	//array of posted values to use to save data or to remember posted inputs
	$data = array (
		  'productBarcode' => $this->global_model->sanitizeString($this->input->post('productBarcode')),
          'productName' => $this->global_model->sanitizeString($this->input->post('productName')),
		  'productCategory' => $this->global_model->sanitizeString($this->input->post('productCategory')),
		  'productSupplier' => $this->global_model->sanitizeString($this->input->post('productSupplier')),
		  'productUnit' => $this->global_model->sanitizeString($this->input->post('productUnit')),
		  'productVat' => $this->global_model->sanitizeString($this->input->post('productVat')),
		  'productCost' => $this->global_model->sanitizeString($this->input->post('productCost')),
		  'productPrice' => $this->global_model->sanitizeString($this->input->post('productPrice')),
		  'minStock' => $this->global_model->sanitizeString($this->input->post('minimumStock')),
		  'secStock' => $this->global_model->sanitizeString($this->input->post('securityStock')),
		  'maxStock' => $this->global_model->sanitizeString($this->input->post('maximumStock')),
		  'productAlert' => $this->global_model->sanitizeString($this->input->post('productAlert')),
		  'productLength' => $this->global_model->sanitizeString($this->input->post('productLength')),
		  'productWidth' => $this->global_model->sanitizeString($this->input->post('productWidth')),
		  'productHeight' => $this->global_model->sanitizeString($this->input->post('productHeight')),
		  'productWeight' => $this->global_model->sanitizeString($this->input->post('productWeight')),
	);
	  // if all fields are ok, save data
      if ($this->form_validation->run()) {
		   // UPLOAD THE FILE
			$fileName0 = $_FILES['productFile']['name'];
			$phrase = substr(md5(uniqid(rand(), true)),16, 16);
			// Get extension
			$ext = '.'.pathinfo($fileName0, PATHINFO_EXTENSION);
			// File path
			$path = $upload_location.$phrase.$ext;
			 //Copy the uploaded file		
			move_uploaded_file($_FILES['productFile']['tmp_name'],$path);
			$fileName = $phrase.$ext;
        $product = array (
			'product_barcode' => $data['productBarcode'],
			'product_name' => $data['productName'],
			'product_picture' => $fileName,
			'category_id' => $data['productCategory'],
			'supplier_id' => $data['productSupplier'],
			'product_unit' => $data['productUnit'],
			'tax_id' => $data['productVat'],
			'min_stock' => $data['minStock'],
			'sec_stock' => $data['secStock'],
			'max_stock' => $data['maxStock'],
			'alert_units' => $data['productAlert'],
			'warehouse_id' => $this->session->userdata('warehouseid'),
		 );
		

        $this->db->insert('products', $product);
		$productId = $this->db->insert_id();
		if($productId) {
			//insert prices
			$price = array (
				'cost' => $data['productCost'],
				'selling_price' => $data['productPrice'],
				'warehouse_id' => $this->session->userdata('warehouseid'),
				'product_id' => $productId,
			);
			$this->db->insert('price', $price);
			//insert storage information
			$storage = array (
				'product_id' => $productId,
				'length_pr' => $data['productLength'],
				'width_pr'  => $data['productWidth'],
				'height_pr' => $data['productHeight'],
				'weight_pr' => $data['productWeight'],
			);
			$this->db->insert('dimensions', $storage);
		}
		$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('product_added_success').'</div>');
      } else {
        // to display errors occured
		$this->session->set_flashdata('errors', validation_errors());
		// to memorize the data already posted
		$this->session->set_flashdata('data',$data);
		// redirect to create form
        redirect(base_url('product/create'));
      }

      redirect('products');
	}
	
	//UPDATE EDITED PRODUCT
	public function update($id)
	{
      //form validation
    $this->form_validation->set_rules('productBarcode', 'Barcode', 'trim|required');
	$this->form_validation->set_rules('productName', 'Name', 'trim|required');
	$this->form_validation->set_rules('productCategory', $this->lang->line('category'), 'trim|required');
	$this->form_validation->set_rules('productUnit', $this->lang->line('unit'), 'trim|required');
	$this->form_validation->set_rules('productVat', $this->lang->line('vat_rate'),'trim|greater_than_equal_to[0]|less_than[100]|required');
	$this->form_validation->set_rules('productCost', $this->lang->line('unit_cost'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productPrice', $this->lang->line('selling_price'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('minimumStock', $this->lang->line('minimum_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('securityStock', $this->lang->line('security_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('maximumStock', $this->lang->line('maximum_stock'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productAlert', $this->lang->line('alert_qty'),'trim|greater_than_equal_to[0]|numeric|required');
	$this->form_validation->set_rules('productLength', $this->lang->line('package_length'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productWidth', $this->lang->line('package_width'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productHeight', $this->lang->line('package_height'),'trim|numeric|greater_than[0]|required');
	$this->form_validation->set_rules('productWeight', $this->lang->line('package_weight'),'trim|numeric|greater_than[0]|required');
	
	// Upload settings
		$config['upload_path'] = './uploads/pictures/products/';
		$config['max_size'] = "2048000"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
		$config['allowed_types'] = "gif|jpg|png|jpeg";
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		// ------- Upload directory
		$upload_location = $config['upload_path'];
		// ------- To store uploaded files path
		$files_arr = array();
	
	
	//array of posted values to use to save data or to remember posted inputs
	$data = array (
		  'productBarcode' => $this->global_model->sanitizeString($this->input->post('productBarcode')),
          'productName' => $this->global_model->sanitizeString($this->input->post('productName')),
		  'productCategory' => $this->global_model->sanitizeString($this->input->post('productCategory')),
		  'productSupplier' => $this->global_model->sanitizeString($this->input->post('productSupplier')),
		  'productUnit' => $this->global_model->sanitizeString($this->input->post('productUnit')),
		  'productVat' => $this->global_model->sanitizeString($this->input->post('productVat')),
		  'productCost' => $this->global_model->sanitizeString($this->input->post('productCost')),
		  'productPrice' => $this->global_model->sanitizeString($this->input->post('productPrice')),
		  'minStock' => $this->global_model->sanitizeString($this->input->post('minimumStock')),
		  'secStock' => $this->global_model->sanitizeString($this->input->post('securityStock')),
		  'maxStock' => $this->global_model->sanitizeString($this->input->post('maximumStock')),
		  'productAlert' => $this->global_model->sanitizeString($this->input->post('productAlert')),
		  'productLength' => $this->global_model->sanitizeString($this->input->post('productLength')),
		  'productWidth' => $this->global_model->sanitizeString($this->input->post('productWidth')),
		  'productHeight' => $this->global_model->sanitizeString($this->input->post('productHeight')),
		  'productWeight' => $this->global_model->sanitizeString($this->input->post('productWeight')),
		  'packageUnits' => $this->global_model->sanitizeString($this->input->post('productUnits'))
	);
	  // if all fields are ok, save data
      if ($this->form_validation->run()) {
		// UPLOAD THE FILE
		$fileName0 = $_FILES['productFileEdit']['name'];
		if ($fileName0!='') {
			$phrase = substr(md5(uniqid(rand(), true)),16, 16);
			// Get extension
			$ext = '.'.pathinfo($fileName0, PATHINFO_EXTENSION);
			// File path
			$path = $upload_location.$phrase.$ext;
			 //Copy the uploaded file		
			move_uploaded_file($_FILES['productFileEdit']['tmp_name'],$path);
			$fileName = $phrase.$ext;
			//product data array
			$product = array (
				'product_barcode' => $data['productBarcode'],
				'product_name' => $data['productName'],
				'product_picture' => $fileName,
				'category_id' => $data['productCategory'],
				'supplier_id' => $data['productSupplier'],
				'product_unit' => $data['productUnit'],
				'tax_id' => $data['productVat'],
				'min_stock' => $data['minStock'],
				'sec_stock' => $data['secStock'],
				'max_stock' => $data['maxStock'],
				'alert_units' => $data['productAlert'],
				'warehouse_id' => $this->session->userdata('warehouseid'),
			 );
		} else {
			$product = array (
				'product_barcode' => $data['productBarcode'],
				'product_name' => $data['productName'],
				'category_id' => $data['productCategory'],
				'supplier_id' => $data['productSupplier'],
				'product_unit' => $data['productUnit'],
				'tax_id' => $data['productVat'],
				'min_stock' => $data['minStock'],
				'sec_stock' => $data['secStock'],
				'max_stock' => $data['maxStock'],
				'alert_units' => $data['productAlert'],
				'warehouse_id' => $this->session->userdata('warehouseid'),
			 );
		}			
        
		//update products table
		$this->db->where(['product_id' => $id])->update('products', $product);
		//update prices
		$price = array (
			'cost' => $data['productCost'],
			'selling_price' => $data['productPrice'],
			'warehouse_id' => $this->session->userdata('warehouseid')
		);
		$this->db->where(['product_id' => $id])->update('price', $price);
		//update storage information
		$storage = array (
			'length_pr' => $data['productLength'],
			'width_pr'  => $data['productWidth'],
			'height_pr' => $data['productHeight'],
			'weight_pr' => $data['productWeight'],
			'units_pr' => $data['packageUnits']
		);
		$this->db->where(['product_id' => $id])->update('dimensions', $storage);	
		
		$this->session->set_flashdata('updatesuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('product_updated_success').'</div>'); 
      } else {
        // to display errors occured
		$this->session->set_flashdata('errors', validation_errors());
		// to memorize the data already posted
		$this->session->set_flashdata('data',$data);
		// redirect to create form
        redirect(base_url('products'));
      }

      redirect('products');
	}
	
	//UPDATE  CATEGORY
	public function updateCategory()
  {
	$id = $this->global_model->sanitizeString($this->input->post('catId'));
	$data = array (
		  'category_name' => $this->global_model->sanitizeString($this->input->post('categoryName')),
          'category_description' => $this->global_model->sanitizeString($this->input->post('categoryDescription'))
	);
	
    $category = array (
        'category_name' => $data['category_name'],
		'category_description' => $data['category_description']
    );

    $this->db->where(['category_id' => $id])->update('product_categories', $category);
	$this->session->set_flashdata('updatesuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('category_updated_success').'</div>'); 
    
     redirect('categories');
  }
	
	//ACTIVATE/DEACTIVATE PRODUCT
	public function activationAction() {
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		$currentStatus = $this->global_model->getItem('products', 'product_id', $productId, 'status');
		if($currentStatus==0){
			//if current status=0 ( deactivated ) => activate the product
			//by changing status to 1
			$status = 1;
			//$newaction recerved for the displaying the alert
			$newaction = $this->lang->line('activated');
		} else {
			//if current status=1 ( active ) => deactivate the product
			//by changing status to 0
			$status = 0;
			//$newaction recerved for the displaying the alert
			$newaction = $this->lang->line('deactivated');
		}
		$action = array (
			'status' => $status
		);
		$this->db->where(['product_id' => $productId])->update('products', $action);	
		
		$this->session->set_flashdata('productblocked', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('product_successfully').$newaction.'</div>'); 
		$result = 'action';
		//redirect('products');
		echo json_encode($result);
	}
	
	//SAVE NEW CATEGORY -- NEW CATEGORY PAGE
	public function storecategory()
	{
        //form validation
		$this->form_validation->set_rules('categoryName',$this->lang->line('category_name'), 'trim|required|is_unique[product_categories.category_name]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
		if ($this->form_validation->run()) {
		$cat = array (
          'category_name'        => $this->global_model->sanitizeString($this->input->post('categoryName')),
		  'category_description' => $this->global_model->sanitizeString($this->input->post('categoryDescription')),
		  'warehouse_id'         => $this->session->userdata('warehouseid')
        );
		//inseert
        $this->db->insert('product_categories', $cat);
		$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('category_added_success').'</div>');
		redirect('categories');
		} else {
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('data',$cat);
			redirect(base_url('product/createcategory'));
		}
	}
	
	//SAVE NEW CATEGORY -- NEW PRODUCT PAGE
	public function saveNewCategory()
	{
        $cat = array (
          'category_name'        => $this->global_model->sanitizeString($this->input->post('categoryName')),
		  'category_description' => $this->global_model->sanitizeString($this->input->post('categoryName')),
		  'warehouse_id'         => $this->session->userdata('warehouseid')
        );
		//inseert
        $this->db->insert('product_categories', $cat);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	//SAVE NEW UNIT -- NEW PRODUCT PAGE
	public function saveNewUnit()
	{
        $unit = array (
          'code'        => $this->global_model->sanitizeString($this->input->post('unitCode')),
		  'designation' => $this->global_model->sanitizeString($this->input->post('unitName'))
        );
		//inseert
        $this->db->insert('measuring_units', $unit);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	public function productDimensions(){
		
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['title'] = $this->lang->line('product_dimensions');
		$data['activemenu'] = 'prodim';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/dimensions');
		$this->load->view('inc/footer');
		
	}
	
	public function disabledDimensions(){
		
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['title'] = $this->lang->line('product_dimensions');
		$data['activemenu'] = 'prodim';
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/disableddimensions');
		$this->load->view('inc/footer');
		
	}
	
	//DISPLAY DIMENSION WHEN SELECTING A PRODUCT FROM THE LIST
	public function displayDimensions(){
		
		$productId = $this->global_model->sanitizeString($this->input->post('productId'));
		$data = $this->global_model->RetreiveRow('dimensions', ['product_id' => $productId]);
		echo json_encode($data);
		
	}
	
	//UPDATE PRODUCT DIMENSIONS
	public function saveDimensions()
  {
	$id = $this->global_model->sanitizeString($this->input->post('productDim_products'));
	$data = array (
		  'length_pr' => $this->global_model->sanitizeString($this->input->post('productDim_length')),
          'width_pr' => $this->global_model->sanitizeString($this->input->post('productDim_width')),
		  'height_pr' => $this->global_model->sanitizeString($this->input->post('productDim_height')),
		  'weight_pr' => $this->global_model->sanitizeString($this->input->post('productDim_weight')),
		  'units_pr' => $this->global_model->sanitizeString($this->input->post('productDim_units'))
	);
	
    $product = array (
        'length_pr' => $data['length_pr'],
		'width_pr' => $data['width_pr'],
		'height_pr' => $data['height_pr'],
		'weight_pr' => $data['weight_pr'],
		'units_pr' => $data['units_pr']
    );

    $this->db->where(['product_id' => $id])->update('dimensions', $product);
	$this->session->set_flashdata('updatesuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('dimensions_updated_success').'</div>'); 
    
     redirect('product/productDimensions');
  }
  
  //ADD NEW PRODUCT STCK
	public function addNewStock(){
		
		$data['title'] = $this->lang->line('add_stock');
		$data['activedrop'] = 'stkctrl';
		$data['activemenu'] = 'addstk';
		$data['products'] = $this->global_model->RetreiveData('products',['status' => 1]);
		$data['destinations'] = $this->global_model->RetreiveData('warehouses',['id' => $this->session->userdata('warehouseid')]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('products/addstock');
		$this->load->view('inc/footer');
		
	}
	
	//GET PRODUCT NAME FROM SCANNED BARCODE
	public function getProductFromBarcode()
	{
        $barcode =  $this->global_model->sanitizeString($this->input->post('barcode'));
		//retreive product name
        $productId = $this->global_model->getItem('products', 'product_barcode', $barcode, 'product_id');
		$productStock = $this->product_model->productInventory ($productId, $this->session->userdata('warehouseid'));
		$result = array(
                'productId' => $productId,
                'productStock' => $productStock
            );
		echo json_encode($result);
	}
	
	//SAVE NEW STOCK -- ADD STOCK PAGE
	public function saveStock()
	{
        
		//insert inventory
		$stock = array (
          'dateinventory'   => date('Y-m-d'),
		  'inn' 			=> $this->global_model->sanitizeString($this->input->post('addStockQty')),
		  'out_inv' 		=> 0,
		  'product_id' 		=> $this->global_model->sanitizeString($this->input->post('addStockProduct1')),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'transfer_id' 	=> 0,
		  'delivery_id' 	=> 0,
		  'order_id' 		=> 0,
		  'lot' 			=> $this->global_model->sanitizeString($this->input->post('addStockReference')),
		  'return_id' 		=> 0	
        );
		
        $this->db->insert('inventory', $stock);
		$inventory_id = $this->db->insert_id();
		if($inventory_id) {
			$result = array();
			foreach ($this->input->post("shelfVolume") as $key => $val) {
				$result[] = array(             
					'date_occ'     => $this->input->post('addStockDate')[$key],
					'inventory_id' => $inventory_id,
					'inn_occ' 	   => $this->input->post('shelfVolume')[$key],
					'out_occ'      => 0,
					'product_id'   => $this->input->post('addStockProduct1'),
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'ref_occ' 	   => $this->input->post('addStockReference'),
					'row_occ' 	   => $this->input->post('addStockRow')[$key],
					'line_occ' 	   => $this->input->post('addStockLine')[$key],
					'shelf_occ'    => $this->input->post('addStockShelf')[$key]
					
				);      
			}      
			$this->db->insert_batch('occupancy',$result);
			$filledIn = TRUE;
			
			if($filledIn==TRUE) {
				$this->session->set_flashdata('addStockSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line("stock_added_success").'</div>');
				redirect('product/addNewStock');
			} else {
				$this->session->set_flashdata('addStockWarning', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("stock_added_without_storage").'</div>');
				redirect('product/addNewStock');
			}
		} else {
			$this->session->set_flashdata('addStockError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("stock_not_added").'</div>');
				redirect('product/addNewStock');
		}
	}
	
	//GET SINGLE PRODUCT VOLUME AND SEND TO AJAX REQUEST
	public function getProductVolume()
	{ 
        $productId = $this->global_model->sanitizeString($this->input->post('productId'));
		$warehouseId = $this->session->userdata('warehouseid');
		$productVolume = $this->product_model->singleProductVolume($productId);
		$storageVolume = $this->storage_model->max_shelf_volume ($warehouseId);
		
		$result = array(
                'prodVolume' => $productVolume,
                'storVolume' => $storageVolume
            );
		
		echo json_encode($result);
	}
	
	//ADD RACKING DYNAMICALLY FOR THE ADDED STOCK
	public function addStockLocations(){
		$volume = $this->input->post('volume');
		$nbShelves = $this->input->post('nbShelves');
		$locations =$this->product_model->addStockRacking($volume, $nbShelves);
		echo json_encode($locations);
	}
	
	//GET PRODUCT BARCODE FROM SELECTED NAME
	public function getProductBarcode()
	{
        $productId =  $this->global_model->sanitizeString($this->input->post('productId'));
		//retreive product barcode
        $productBarcode = $this->global_model->getItem('products', 'product_id', $productId, 'product_barcode');
		$productStock = $this->product_model->productInventory ($productId, $this->session->userdata('warehouseid'));
		$result = array(
                'productBarcode' => $productBarcode,
                'productStock' => $productStock
            );
		echo json_encode($result);
	}
	
	//PRODUCT MVTs
	public function productMvt()
	{
		$productId = $this->input->post('productId');
		
		$data= $this->product_model->displayProductMvt($productId);
		echo json_encode($data);
		
	}
	
	//PRODUCTS OF A SUPPLIER
	public function getSupplierProducts()
	{
		$supplierId = $this->global_model->sanitizeString($this->input->post('supplierId'));
		$data= $this->product_model->getSuppProducts($supplierId);
		echo json_encode($data);
		
	}
	
	//SAVE NEW PRODUCT FROM LPO PAGE
	public function saveProductFromLPO()
	{
     
	//array of posted values to use to save data or to remember posted inputs
	$data = array (
		  'productBarcode' => $this->global_model->sanitizeString($this->input->post('productCode')),
          'productName' => $this->global_model->sanitizeString($this->input->post('productName')),
		  'productCategory' => $this->global_model->sanitizeString($this->input->post('productCategory')),
		  'productSupplier' => $this->global_model->sanitizeString($this->input->post('productSupplier')),
		  'productUnit' => $this->global_model->sanitizeString($this->input->post('productUnit')),
		  'productVat' => 0,
		  'productCost' => 0,
		  'productPrice' => 0,
		  'minStock' => 0,
		  'secStock' => 0,
		  'maxStock' => 0,
		  'productAlert' => 0,
		  'productLength' => 0,
		  'productWidth' => 0,
		  'productHeight' => 0,
		  'productWeight' => 0
	);
	  
        $product = array (
			'product_barcode' => $data['productBarcode'],
			'product_name' => $data['productName'],
			'category_id' => $data['productCategory'],
			'supplier_id' => $data['productSupplier'],
			'product_unit' => $data['productUnit'],
			'tax_id' => $data['productVat'],
			'min_stock' => $data['minStock'],
			'sec_stock' => $data['secStock'],
			'max_stock' => $data['maxStock'],
			'alert_units' => $data['productAlert'],
			'warehouse_id' => $this->session->userdata('warehouseid'),
		 );
		

        $this->db->insert('products', $product);
		$productId = $this->db->insert_id();
		if($productId) {
			//insert prices
			$price = array (
				'cost' => $data['productCost'],
				'selling_price' => $data['productPrice'],
				'warehouse_id' => $this->session->userdata('warehouseid'),
				'product_id' => $productId,
			);
			$this->db->insert('price', $price);
			//insert storage information
			$storage = array (
				'product_id' => $productId,
				'length_pr' => $data['productLength'],
				'width_pr'  => $data['productWidth'],
				'height_pr' => $data['productHeight'],
				'weight_pr' => $data['productWeight'],
			);
			$this->db->insert('dimensions', $storage);
			$result['msg'] = 'productadded';
			$result['supplierProducts'] = $this->product_model->getSuppProducts($data['productSupplier']);
		} else {
			$result['msg']  = 'productnotadded';
		}
		
      echo json_encode($result);
	}
	
	//ADD NEW PRODUCT TO PACKAGE LIST --PACKAGE BARCODING PAGE
	public function addProductToPackageList () {
		$prId = $this->global_model->sanitizeString($this->input->post('prId'));
		$qty = $this->global_model->sanitizeString($this->input->post('qty'));
		$result = $this->product_model->addProductToPackageList ($prId, $qty);
		echo json_encode($result);
	}
	
	//PACKAGE BARCODING
	public function packageBarcoding(){
		
		$data['title'] = $this->lang->line('package_barcoding');
		$data['activemenu'] = 'packbar';
		$data['products'] = $this->global_model->RetreiveData('products','');
		$data['clients'] = $this->global_model->RetreiveData('clients','');
		if((!empty($this->session->flashdata('package_id')))) {
			$data['barcodingRow'] = $this->global_model->RetreiveRow('barcoding_packs', ['warehouse_id' => $this->session->userdata('warehouseid') ]);
			$data['packRow'] = $this->global_model->RetreiveRow('packages', ['warehouse_id' => $this->session->userdata('warehouseid'), 'package_id' => $this->session->flashdata('package_id') ]);
			$data['packDetails'] = $this->global_model->RetreiveData('package_details',['package_id' => $this->session->flashdata('package_id')]);
		}
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('pickpack/packagebarcoding');
		$this->load->view('inc/footer');
		
	}

	
	//SAVE NEW PACKAGE 
	public function storepackage()
	{
        $packageCode = 'PCK'.date('y').date('m').date('d').date('h').date('i').date('s').substr(str_repeat(0, 4).(intval($this->global_model->getLastId('packages', 'package_id'))+1), - 4);
		//insert package
		$package = array (
          'package_code'   => $packageCode ,
		  'datetime' 		=> date("Y-m-d"),
		  'warehouse_id' 	=> $this->session->userdata('warehouseid'),
		  'client_id' 	=> $this->global_model->sanitizeString($this->input->post('packageBarcode_customers')),
		  'shipping_address' 	=> $this->global_model->sanitizeString($this->input->post('packageBarcode_clientShipAdr')),
		  'agent_id' 		=> $this->session->userdata('userid')
        );
		
        $this->db->insert('packages', $package);
		$package_id = $this->db->insert_id();
		if($package_id) {
			$result = array();
			foreach ($this->input->post("packBarPrId") as $key => $val) {
				$volume = $this->product_model->singleProductVolume( $this->input->post('packBarPrId')[$key])* floatval($this->input->post('packBarPrQty')[$key]);
				$weight = $this->product_model->singleProductWeight( $this->input->post('packBarPrId')[$key])* floatval($this->input->post('packBarPrQty')[$key]);
				$result[] = array(             
					'package_id'     => $package_id,
					'warehouse_id' => $this->session->userdata('warehouseid'),
					'product_id' 	   => $this->input->post('packBarPrId')[$key],
					'qty' 	   => $this->input->post('packBarPrQty')[$key],
					'volume' 	   => $volume,
					'weight' 	   => $weight
				);      
			}      
			$this->db->insert_batch('package_details',$result);
			$this->session->set_flashdata('package_id', $package_id);
			redirect('packages/barcoding');
		} else {
			$this->session->set_flashdata('addPackageError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("package_not_saved").'</div>');
				redirect('packages/barcoding');
		}
	}
	
 
}