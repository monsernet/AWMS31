<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 /*********************** ABOUT *****************************/
 /* This controller includes general functions used in all the script */
 
class Global_controller extends CI_Controller {
 
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
	
	//Load the options of a defined dropdown select
	public function loadSelect() {
		$tableName = $this->input->post('tableName');
		$data = $this->global_model->RetreiveData(strtolower($tableName), '');
		echo json_encode($data);
	 }
	 
	 
	 
	 //Load the options with conditions of a defined dropdown select
	public function loadSelectWithCondition() {
		$tableName = $this->input->post('tableName');
		$condition = $this->input->post('condition');
		$data = $this->global_model->RetreiveData(strtolower($tableName), $condition);
		echo json_encode($data);
	 }
	 public function clearOldData() {
		$this->global_model->emptyTable('barcoding_packs');
		$this->global_model->emptyTable('barcoding_products');
		$this->global_model->emptyTable('barcoding_racks');
		$this->global_model->emptyTable('clientorders');
		$this->global_model->emptyTable('clientorder_details');
		$this->global_model->emptyTable('clients');
		$this->global_model->emptyTable('companysettings');
		$this->global_model->emptyTable('currencies');
		$this->global_model->emptyTable('deliveries');
		$this->global_model->emptyTable('delivery_details');
		$this->global_model->emptyTable('dimensions');
		$this->global_model->emptyTable('email_settings');
		$this->global_model->emptyTable('eoq_settings');
		$this->global_model->emptyTable('inventory');
		$this->global_model->emptyTable('inventory_adjustments');
		$this->global_model->emptyTable('inventory_settings');
		$this->global_model->emptyTable('inventory_tmp');
		$this->global_model->emptyTable('loadings');
		$this->global_model->emptyTable('loading_approve');
		$this->global_model->emptyTable('login_sessions');
		$this->global_model->emptyTable('measuring_units');
		$this->global_model->emptyTable('occupancy');
		$this->global_model->emptyTable('occupancy_tmp');
		$this->global_model->emptyTable('orders');
		$this->global_model->emptyTable('order_details');
		$this->global_model->emptyTable('packages');
		$this->global_model->emptyTable('package_details');
		$this->global_model->emptyTable('physical_inventories');
		$this->global_model->emptyTable('phys_inv_details');
		$this->global_model->emptyTable('po');
		$this->global_model->emptyTable('po_details');
		$this->global_model->emptyTable('price');
		$this->global_model->emptyTable('products');
		$this->global_model->emptyTable('product_categories');
		$this->global_model->emptyTable('product_rates');
		$this->global_model->emptyTable('product_taxes');
		$this->global_model->emptyTable('receivings');
		$this->global_model->emptyTable('receiving_details');
		$this->global_model->emptyTable('returns');
		$this->global_model->emptyTable('return_details');
		$this->global_model->emptyTable('settings');
		$this->global_model->emptyTable('storage_area');
		$this->global_model->emptyTable('storage_racking');
		$this->global_model->emptyTable('storage_reallines');
		$this->global_model->emptyTable('suppliers');
		$this->global_model->emptyTable('transfers');
		$this->global_model->emptyTable('transfer_approved');
		$this->global_model->emptyTable('transfer_details');
		$this->global_model->emptyTable('transfer_received');
		$this->global_model->emptyTable('warehouses');
		$this->global_model->emptyTable('warh_dimensions');
		$msg = 'dataempty';
		echo json_encode($msg);
		//echo $msg;
	 }
	 
	 public function installDemoData() {
		 
		$sql="INSERT INTO `barcoding_packs` (`id`, `warehouse_id`, `barcode_technology`, `barcode_type`, `paper_size`) VALUES
		(1, 1, 1, 2, 1),
		(2, 4, 1, 2, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO barcoding_products (id, warehouse_id, barcode_technology, barcode_type, paper_size, paper_orientation, margin_top, margin_bottom, margin_left, margin_right, barcodes_row, barcodes_col, barcode_padding) VALUES
		(1, 1, 1, 2, 1, 1, 6, 6, 6, 6, 3, 12, 0),
		(2, 4, 1, 2, 1, 1, 3, 3, 3, 3, 3, 12, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO barcoding_racks (id, warehouse_id, barcode_technology, barcode_type, paper_size, shelf_barcoding, rack_barcoding, aisle_barcoding) VALUES
		(1, 1, 1, 2, 2, 1, 2, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `clientorders` (`order_id`, `order_code`, `datetime`, `client_id`, `warehouse_id`, `limited_period`, `delivery_limit`, `agent_id`, `approved`, `loaded`, `delivered`, `received`) VALUES
		(1, 'OC185236-22', '2022-06-23', 1, 1, 0, '2022-06-24', 1, 1, 0, 0, 0),
		(2, '1234567', '2022-11-01', 2, 1, 0, '2022-11-10', 1, 1, 0, 0, 0),
		(3, 'OR1522', '2022-11-02', 1, 1, 1, '2022-11-23', 1, 1, 0, 0, 0),
		(4, '234454545', '2022-11-09', 2, 1, 1, '2022-11-16', 1, 1, 0, 0, 0),
		(5, '233433434', '2022-11-10', 1, 1, 1, '2022-11-17', 1, 1, 0, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `clientorder_details` (`id`, `order_id`, `warehouse_id`, `price_id`, `product_id`, `qty`, `volume`, `weight`) VALUES
		(1, 1, 1, NULL, 1, 15, 1.6875, 112.5),
		(2, 1, 1, NULL, 5, 2, 0.3024, 29),
		(3, 2, 1, NULL, 1, 40, 4.5, 312),
		(4, 2, 1, NULL, 4, 40, 1.125, 400),
		(5, 3, 1, NULL, 1, 45, 5.0625, 351),
		(6, 3, 1, NULL, 4, 35, 0.984375, 350),
		(7, 4, 1, NULL, 1, 15, 1.6875, 117),
		(8, 4, 1, NULL, 4, 25, 0.703125, 250),
		(9, 4, 1, NULL, 5, 45, 0.28125, 202.5),
		(10, 5, 1, NULL, 1, 500, 56.25, 3900)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO clients (client_id, client_code, full_name, business_title, tax, mobile, phone, address, shippingAddress, city, country, email, price_level, status) VALUES
		(1, 'CUST0001', 'General Trading Company', 'General Trading Company', 12, '12563256842', '14523254789', '114 Yongue Street Toronto ON M4R 1A2', '114 Yongue Street Toronto ON M4R 1A2', 'Toronto', 'Canada', 'sales@gtc.com', 1, 1),
		(2, 'CUST0002', 'Helen Sandu', 'Helen Sandu', 12, '1452369542', '1452369852', '123 Nepean Street Ottawa ON K2P 0C3', '123 Nepean Street Ottawa ON K2P 0C3', 'Ottawa', 'Canada', 'helen.sandu@mail.com', 1, 1),
		(3, 'CUST0003', 'Customer 03', 'Business Title Customer 03', 12, '1236547852369', '123456789632', 'address of customer 03', 'address of customer 03', 'city03', 'country03', 'email@customer03.com', 1, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO companysettings (id, companyName, business_title, companyAddress, shippingAddress, tax_number, register_number, companyPhone, companyEmail, country, city) VALUES
		(1, 'My Company', 'MyCompany', 'Bloc 12, str 18B, District 12A', 'Bloc 12, str 18B, District 12A', '1523148/MF', '1245263/15', '+123456789632', 'info@mycompany.com', 'Canada', 'Quebec');";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `currencies` (`id`, `curr_symbol`, `curr_code`, `curr_name`) VALUES
		(1, '$', 'USD', 'US Dollar'),
		(2, '€', 'Euro', 'Euro')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `deliveries` (`delivery_id`, `delivery_code`, `datetime`, `client_id`, `client_order`, `warehouse_id`, `agent_id`, `picked`, `packed`, `delivered`) VALUES
		(1, 'DN0001-22', '2022-06-24', 1, 1, 1, 1, 1, 1, 1),
		(2, 'DLN-0002-22', '2022-11-10', 2, 2, 1, 1, 1, 1, 1),
		(3, 'DLN-0003-22', '2022-11-12', 1, 3, 1, 1, 1, 1, 0),
		(4, 'DLN-0004-22', '2022-11-12', 2, 4, 1, 1, 1, 0, 0),
		(5, 'DLN-0005-22', '2022-11-12', 1, 5, 1, 1, 1, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `delivery_details` (`id`, `delivery_id`, `warehouse_id`, `product_id`, `order_qty`, `qty`, `volume`, `weight`, `loaded`, `packed`) VALUES
		(1, 1, 1, 1, 15, 15, 1.6875, 112.5, 1, 1),
		(2, 1, 1, 5, 2, 2, 0.3024, 29, 1, 1),
		(3, 2, 1, 1, 40, 40, 4.5, 312, 1, 1),
		(4, 2, 1, 4, 40, 40, 1.125, 400, 1, 1),
		(5, 3, 1, 1, 45, 45, 5.0625, 351, 1, 1),
		(6, 3, 1, 4, 35, 35, 0.984375, 350, 1, 1),
		(7, 4, 1, 1, 15, 15, 1.6875, 117, 1, 0),
		(8, 4, 1, 4, 25, 25, 0.703125, 250, 1, 0),
		(9, 4, 1, 5, 45, 45, 0.28125, 202.5, 1, 0),
		(10, 5, 1, 1, 500, 500, 56.25, 3900, 1, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `dimensions` (`ID`, `product_id`, `length_pr`, `width_pr`, `height_pr`, `weight_pr`, `units_pr`) VALUES
		(1, 1, 50, 50, 45, 7.8, 12),
		(2, 2, 60, 60, 50, 9, 12),
		(3, 3, 50, 50, 45, 7.5, 12),
		(4, 4, 25, 45, 25, 10, 6),
		(5, 5, 25, 10, 25, 4.5, 12),
		(6, 6, 43, 40, 40, 11.5, 6),
		(7, 7, 25, 25, 25, 11.4, 3),
		(8, 8, 15, 15, 15, 4.5, 12),
		(9, 9, 10, 15, 10, 3.5, 12),
		(10, 10, 55, 55, 15, 12, 3)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO email_settings (id, warehouse_id, email_method, sender_name, sender_email, mail_server, mail_port, mail_password) VALUES
		(1, 1, 'phpmail', 'My Warehouse Admin', 'info@mywarehouse.com', 'NA', 0, '123456'),
		(2, 4, 'phpmail', 'Admin', 'info@mail.com', 'NA', 0, '')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO eoq_settings (id, warehouse_id, holdingCost, orderingCost) VALUES
		(1, 1, 27, 32),
		(2, 4, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `inventory` (`inventory_id`, `dateinventory`, `inn`, `out_inv`, `product_id`, `warehouse_id`, `transfer_id`, `delivery_id`, `order_id`, `lot`, `return_id`, `user_id`) VALUES
		(1, '2022-05-26', 250, 0, 1, 1, 0, 0, 0, 'inv123-22', 0, 0),
		(2, '2022-05-26', 500, 0, 2, 1, 0, 0, 0, 'inv14523-22', 0, 0),
		(3, '2022-05-26', 100, 0, 5, 1, 0, 0, 0, '125632-22', 0, 0),
		(4, '2022-05-27', 0, 50, 1, 1, 1, 0, 0, 'Transfer 1', 0, 0),
		(5, '2022-05-27', 0, 120, 1, 1, 2, 0, 0, 'Transfer 2', 0, 0),
		(6, '2022-05-27', 0, 100, 2, 1, 2, 0, 0, 'Transfer 2', 0, 0),
		(7, '2022-05-27', 0, 75, 1, 1, 3, 0, 0, 'Transfer 3', 0, 0),
		(8, '2022-05-27', 0, 100, 2, 1, 3, 0, 0, 'Transfer 3', 0, 0),
		(9, '2022-05-27', 0, 100, 5, 1, 3, 0, 0, 'Transfer 3', 0, 0),
		(10, '2022-05-28', 50, 0, 1, 2, 1, 0, 0, 'Transfer 1', 0, 1),
		(11, '2022-06-03', 120, 0, 1, 2, 2, 0, 0, 'Transfer 2', 0, 1),
		(12, '2022-06-03', 100, 0, 2, 2, 2, 0, 0, 'Transfer 2', 0, 1),
		(13, '2022-06-17', 50, 0, 1, 1, 0, 0, 1, 'Order #1', 0, 1),
		(14, '2022-06-17', 50, 0, 2, 1, 0, 0, 1, 'Order #1', 0, 1),
		(15, '2022-06-17', 50, 0, 5, 1, 0, 0, 1, 'Order #1', 0, 1),
		(16, '2022-06-30', 0, 15, 1, 1, 0, 1, 0, 'Delivery #1', 0, 0),
		(17, '2022-07-01', 0, 2, 5, 1, 0, 1, 0, 'Delivery #1', 0, 0),
		(18, '2022-07-13', 250, 0, 1, 1, 0, 0, 0, 'inv13122', 0, 0),
		(19, '2022-08-17', 0, 100, 2, 1, 4, 0, 0, 'Transfer 4', 0, 0),
		(20, '2022-11-06', 520, 0, 1, 1, 0, 0, 0, 'DN12345-33', 0, 0),
		(21, '2022-11-06', 400, 0, 1, 1, 0, 0, 0, 'DN12345-33', 0, 0),
		(22, '2022-11-06', 2120, 0, 4, 1, 0, 0, 0, 'DN16574-22', 0, 0),
		(23, '2022-11-06', 0, 122, 1, 1, 6, 0, 0, 'Transfer 6', 0, 0),
		(24, '2022-11-06', 0, 85, 2, 1, 6, 0, 0, 'Transfer 6', 0, 0),
		(25, '2022-11-10', 350, 0, 1, 1, 0, 0, 2, 'Order #2', 0, 1),
		(26, '2022-11-10', 450, 0, 5, 1, 0, 0, 2, 'Order #2', 0, 1),
		(27, '2022-11-10', 250, 0, 1, 1, 0, 0, 0, 'inv1342-22', 0, 0),
		(28, '2022-11-10', 450, 0, 4, 1, 0, 0, 3, 'Order #3', 0, 1),
		(29, '2022-11-10', 0, 40, 1, 1, 0, 2, 0, 'Delivery #2', 0, 0),
		(30, '2022-11-10', 0, 40, 4, 1, 0, 2, 0, 'Delivery #2', 0, 0),
		(31, '2022-11-12', 0, 45, 1, 1, 0, 3, 0, 'Delivery #3', 0, 0),
		(32, '2022-11-12', 0, 35, 4, 1, 0, 3, 0, 'Delivery #3', 0, 0),
		(33, '2022-11-12', 0, 15, 1, 1, 0, 4, 0, 'Delivery #4', 0, 0),
		(34, '2022-11-12', 0, 25, 4, 1, 0, 4, 0, 'Delivery #4', 0, 0),
		(35, '2022-11-12', 0, 45, 5, 1, 0, 4, 0, 'Delivery #4', 0, 0),
		(36, '2022-11-12', 0, 500, 1, 1, 0, 5, 0, 'Delivery #5', 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO inventory_settings (id, warehouse_id, inventory_technique, pickpack_method, aisle_label_format, bay_label_format, shelf_label_format, bin_label_format, holding_cost, ordering_cost) VALUES
		(1, 1, 3, 1, 2, 1, 1, 1, 0, 0),
		(2, 4, 3, 1, 1, 1, 1, 1, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `inventory_tmp` (`inventory_id`, `dateinventory`, `inn`, `out_inv`, `product_id`, `warehouse_id`, `transfer_id`, `delivery_id`, `order_id`, `lot`, `return_id`, `user_id`) VALUES
		(8, '2022-08-19', 0, 100, 1, 1, 5, 0, 0, 'TR-0005-22', 0, 1),
		(9, '2022-08-19', 0, 50, 2, 1, 5, 0, 0, 'TR-0005-22', 0, 1),
		(12, '2022-11-10', 0, 200, 1, 1, 8, 0, 0, 'TR-0008-22', 0, 1),
		(13, '2022-11-10', 0, 200, 4, 1, 8, 0, 0, 'TR-0008-22', 0, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `loadings` (`id`, `reference`, `reference_id`, `warehouse_id`, `transport_date`, `vehicle_registration`, `driver_name`, `driver_id_number`, `agent_id`) VALUES
		(1, 'Delivery', 1, 1, '2022-07-08', '123/18563256', 'John Mecklen', '12345865932', 1),
		(2, 'Delivery', 2, 1, '2022-11-10', '9345 RN 16', 'John', '123456789034', 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO login_sessions (id, warehouse_id, session_timeout, login_attempts, wrong_attempts) VALUES
		(1, 1, 180, 5, 3),
		(2, 4, 180, 3, 3)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO measuring_units (id, code, designation) VALUES
		(1, 'PC', 'Piece'),
		(2, 'UN', 'Unit'),
		(3, 'M', 'Meter'),
		(4, 'CM', 'Centimeter'),
		(5, 'KG', 'Kilogram')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `occupancy` (`id_occ`, `date_occ`, `inventory_id`, `transfer_id`, `delivery_id`, `order_id`, `return_id`, `inn_occ`, `out_occ`, `product_id`, `warehouse_id`, `ref_occ`, `row_occ`, `line_occ`, `shelf_occ`) VALUES
		(1, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 1),
		(2, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 2),
		(3, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 3),
		(4, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 3, 1),
		(5, '0000-00-00', 1, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv123-22', 1, 3, 2),
		(6, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 1),
		(7, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 2),
		(8, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 3),
		(9, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 1, 1),
		(10, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 9, 2),
		(11, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 9, 3),
		(12, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 9, 1),
		(13, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 1, 2),
		(14, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 1, 3),
		(15, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 5, 1, 1),
		(16, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 1),
		(17, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 2),
		(18, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 3),
		(19, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 16, 1),
		(20, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 16, 2),
		(21, '0000-00-00', 3, 0, 0, 0, 0, 6, 0, 5, 1, '125632-22', 7, 15, 1),
		(22, '0000-00-00', 3, 0, 0, 0, 0, 6, 0, 5, 1, '125632-22', 7, 15, 2),
		(23, '0000-00-00', 3, 0, 0, 0, 0, 3.12, 0, 5, 1, '125632-22', 7, 15, 3),
		(24, '2022-05-27', 0, 1, 0, 0, 0, 0, 5.63, 1, 1, 'transfer', 1, 1, 1),
		(25, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 1, 2),
		(26, '2022-05-27', 0, 2, 0, 0, 0, 0, 0.37, 1, 1, 'transfer', 1, 1, 1),
		(27, '2022-05-27', 0, 2, 0, 0, 0, 0, 1.13, 1, 1, 'transfer', 1, 3, 2),
		(28, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 1, 3),
		(29, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 2),
		(30, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 1),
		(31, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 3),
		(32, '2022-05-27', 0, 3, 0, 0, 0, 0, 2.44, 1, 1, 'transfer', 1, 3, 2),
		(33, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 3, 1),
		(34, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 1, 1),
		(35, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 16, 1),
		(36, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 16, 2),
		(37, '2022-05-27', 0, 3, 0, 0, 0, 0, 3.11, 5, 1, 'transfer', 7, 15, 3),
		(38, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 5, 1, 'transfer', 7, 15, 2),
		(39, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 5, 1, 'transfer', 7, 15, 1),
		(40, '2022-06-03', 0, 1, 0, 0, 0, 5.63, 0, 1, 2, 'reception', 1, 1, 1),
		(41, '2022-06-17', 13, 0, 0, 1, 0, 5.63, 0, 1, 1, 'receiving', 11, 24, 2),
		(42, '2022-06-17', 14, 0, 0, 1, 0, 6, 0, 2, 1, 'receiving', 5, 1, 2),
		(43, '2022-06-17', 14, 0, 0, 1, 0, 3, 0, 2, 1, 'receiving', 5, 1, 3),
		(44, '2022-06-17', 15, 0, 0, 1, 0, 6, 0, 5, 1, 'receiving', 9, 16, 2),
		(45, '2022-06-17', 15, 0, 0, 1, 0, 1.56, 0, 5, 1, 'receiving', 9, 16, 3),
		(46, '2022-06-30', 16, 0, 1, 0, 0, 0, 1.69, 1, 1, 'transfer', 11, 24, 2),
		(47, '2022-07-01', 17, 0, 1, 0, 0, 0, 0.3, 5, 1, 'transfer', 9, 16, 2),
		(48, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 1),
		(49, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 2),
		(50, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 3),
		(51, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 19, 1),
		(52, '0000-00-00', 18, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv13122', 12, 19, 2),
		(53, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 9, 3),
		(54, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 1, 2),
		(55, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 9, 2),
		(56, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 3, 10, 2),
		(57, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 11, 16, 2),
		(58, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 17, 13, 2),
		(59, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 12, 10, 2),
		(60, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 15, 22, 1),
		(61, '0000-00-00', 21, 0, 0, 0, 0, 5, 0, 1, 1, 'DN12345-33', 10, 15, 2),
		(62, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 15, 22, 2),
		(63, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 16, 21, 1),
		(64, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 16, 22, 2),
		(65, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 3, 3, 2),
		(66, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 4, 2),
		(67, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 3, 2),
		(68, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 4, 1),
		(69, '0000-00-00', 22, 0, 0, 0, 0, 3.63, 0, 4, 1, 'DN16574-22', 10, 19, 2),
		(70, '2022-11-06', 0, 6, 0, 0, 0, 0, 0.56, 1, 1, 'transfer', 1, 3, 2),
		(71, '2022-11-06', 0, 6, 0, 0, 0, 0, 5, 1, 1, 'transfer', 10, 15, 2),
		(72, '2022-11-06', 0, 6, 0, 0, 0, 0, 8, 1, 1, 'transfer', 3, 10, 2),
		(73, '2022-11-06', 0, 6, 0, 0, 0, 0, 0.17, 1, 1, 'transfer', 11, 16, 2),
		(74, '2022-11-06', 0, 6, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 1, 3),
		(75, '2022-11-06', 0, 6, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 9, 1),
		(76, '2022-11-06', 0, 6, 0, 0, 0, 0, 3.3, 2, 1, 'transfer', 5, 1, 1),
		(77, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 2),
		(78, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 3),
		(79, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 2),
		(80, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 15, 19, 2),
		(81, '2022-11-10', 25, 0, 0, 2, 0, 7.38, 0, 1, 1, 'receiving', 19, 25, 3),
		(82, '2022-11-10', 26, 0, 0, 2, 0, 2.81, 0, 5, 1, 'receiving', 12, 13, 2),
		(83, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 1, 1),
		(84, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 3, 1),
		(85, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 3, 1),
		(86, '0000-00-00', 27, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv1342-22', 1, 1, 1),
		(87, '2022-11-10', 28, 0, 0, 3, 0, 8, 0, 4, 1, 'receiving', 15, 25, 3),
		(88, '2022-11-10', 28, 0, 0, 3, 0, 4.66, 0, 4, 1, 'receiving', 16, 12, 2),
		(89, '2022-11-10', 29, 0, 2, 0, 0, 0, 4.5, 1, 1, 'transfer', 1, 1, 1),
		(90, '2022-11-10', 30, 0, 2, 0, 0, 0, 1.13, 4, 1, 'transfer', 3, 3, 2),
		(91, '2022-11-12', 31, 0, 3, 0, 0, 0, 2, 1, 1, 'transfer', 1, 1, 1),
		(92, '2022-11-12', 31, 0, 3, 0, 0, 0, 3.05, 1, 1, 'transfer', 1, 3, 1),
		(93, '2022-11-12', 32, 0, 3, 0, 0, 0, 0.98, 4, 1, 'transfer', 10, 19, 2),
		(94, '2022-11-12', 33, 0, 4, 0, 0, 0, 1.69, 1, 1, 'transfer', 1, 1, 1),
		(95, '2022-11-12', 34, 0, 4, 0, 0, 0, 0.7, 4, 1, 'transfer', 10, 19, 2),
		(96, '2022-11-12', 35, 0, 4, 0, 0, 0, 0.28, 5, 1, 'transfer', 9, 16, 3),
		(97, '2022-11-12', 36, 0, 5, 0, 0, 0, 3.94, 1, 1, 'transfer', 1, 1, 1),
		(98, '2022-11-12', 36, 0, 5, 0, 0, 0, 16, 1, 1, 'transfer', 2, 3, 2),
		(99, '2022-11-12', 36, 0, 5, 0, 0, 0, 12.95, 1, 1, 'transfer', 1, 3, 1),
		(100, '2022-11-12', 36, 0, 5, 0, 0, 0, 8, 1, 1, 'transfer', 2, 3, 3),
		(101, '2022-11-12', 36, 0, 5, 0, 0, 0, 7.36, 1, 1, 'transfer', 11, 16, 2),
		(102, '2022-11-12', 36, 0, 5, 0, 0, 0, 8, 1, 1, 'transfer', 12, 10, 2)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `orders` (`order_id`, `order_code`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `approved`, `delivery_limit`, `received`) VALUES
		(1, 'LPO-0001-22', '2022-06-10 00:00:00', 1, 1, 1, 1, '2022-06-25', 0),
		(2, 'LPO-0002-22', '2022-11-06 00:00:00', 1, 1, 1, 1, '2022-11-01', 0),
		(3, 'LPO-0003-22', '2022-11-06 00:00:00', 2, 1, 1, 1, '2022-10-30', 0),
		(4, 'LPO-0004-22', '2022-11-06 00:00:00', 1, 1, 1, 0, NULL, 0),
		(5, 'LPO-0005-22', '2022-11-10 00:00:00', 2, 1, 1, 1, '2022-11-16', 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `order_details` (`id`, `order_id`, `warehouse_id`, `price_id`, `product_id`, `qty`) VALUES
		(1, 1, 1, NULL, 1, 50),
		(2, 1, 1, NULL, 2, 50),
		(3, 1, 1, NULL, 5, 50),
		(4, 2, 1, NULL, 1, 350),
		(5, 2, 1, NULL, 5, 450),
		(6, 3, 1, NULL, 4, 450),
		(7, 4, 1, NULL, 5, 100),
		(8, 5, 1, NULL, 6, 400),
		(9, 5, 1, NULL, 4, 500)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `packages` (`package_id`, `package_code`, `datetime`, `warehouse_id`, `client_id`, `shipping_address`, `agent_id`) VALUES
		(1, 'PCK202207220002', '2022-07-22', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(2, 'PCK2207260002', '2022-07-26', 1, 2, '123 Nepean Street Ottawa ON K2P 0C3', 1),
		(3, 'PCK2207260002', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(4, 'PCK2207260002', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(5, 'PCK2207261128330005', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(6, 'PCK2207261129370006', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(7, 'PCK2207261132580007', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(8, 'PCK2207261141560008', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(9, 'PCK2207261147080009', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(10, 'PCK2207261152340010', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(11, 'PCK2207261156430011', '2022-07-26', 1, 2, '123 Nepean Street Ottawa ON K2P 0C3', 1),
		(12, 'PCK2207271206170012', '2022-07-27', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(13, 'PCK2207271215080013', '2022-07-27', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(14, 'PCK2207271224200014', '2022-07-27', 1, 3, 'address of customer 03', 1),
		(15, 'PCK2208171006510015', '2022-08-17', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(16, 'PCK2208181125280016', '2022-08-18', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(17, 'PCK2208191111030017', '2022-08-19', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(18, 'PCK2210220601050018', '2022-10-22', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
		(19, 'PCK2211170700230019', '2022-11-17', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `package_details` (`id`, `package_id`, `warehouse_id`, `product_id`, `qty`, `volume`, `weight`) VALUES
		(1, 1, 1, 1, 100, 11.25, 750),
		(2, 1, 1, 2, 100, 18, 900),
		(3, 2, 1, 1, 45, 5.0625, 337.5),
		(4, 2, 1, 2, 25, 4.5, 225),
		(5, 3, 1, 1, 50, 5.625, 375),
		(6, 3, 1, 2, 45, 8.1, 405),
		(7, 4, 1, 1, 25, 2.8125, 187.5),
		(8, 4, 1, 2, 45, 8.1, 405),
		(9, 5, 1, 1, 25, 2.8125, 187.5),
		(10, 5, 1, 2, 72, 12.96, 648),
		(11, 6, 1, 1, 125, 14.0625, 937.5),
		(12, 6, 1, 2, 12, 2.16, 108),
		(13, 7, 1, 1, 50, 5.625, 375),
		(14, 7, 1, 2, 65, 11.7, 585),
		(15, 8, 1, 1, 50, 5.625, 375),
		(16, 8, 1, 2, 50, 9, 450),
		(17, 9, 1, 1, 50, 5.625, 375),
		(18, 9, 1, 2, 50, 9, 450),
		(19, 9, 1, 3, 50, 5.625, 375),
		(20, 10, 1, 1, 50, 5.625, 375),
		(21, 10, 1, 2, 50, 9, 450),
		(22, 10, 1, 3, 60, 6.75, 450),
		(23, 11, 1, 1, 120, 13.5, 900),
		(24, 11, 1, 2, 50, 9, 450),
		(25, 12, 1, 1, 72, 8.1, 540),
		(26, 12, 1, 2, 72, 12.96, 648),
		(27, 13, 1, 1, 75, 8.4375, 562.5),
		(28, 13, 1, 2, 75, 13.5, 675),
		(29, 14, 1, 1, 75, 8.4375, 562.5),
		(30, 14, 1, 2, 75, 13.5, 675),
		(31, 15, 1, 1, 50, 5.625, 375),
		(32, 15, 1, 2, 50, 9, 450),
		(33, 16, 1, 1, 50, 5.625, 375),
		(34, 16, 1, 2, 50, 9, 450),
		(35, 17, 1, 1, 50, 5.625, 375),
		(36, 18, 1, 1, 30, 3.375, 225),
		(37, 18, 1, 2, 25, 4.5, 225),
		(38, 18, 1, 3, 50, 5.625, 375),
		(39, 19, 1, 2, 45, 8.1, 405),
		(40, 19, 1, 3, 125, 14.0625, 937.5),
		(41, 19, 1, 4, 70, 1.96875, 700)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `physical_inventories` (`id`, `warehouse_id`, `designation`, `creation_date`) VALUES
		(1, 1, 'inv-14-7-2022', '2022-07-14')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO phys_inv_details (id, invId, warehouseId, productId, stock, stock_date, invCount, invDate) VALUES
		(1, 1, 1, 1, 290, '2022-07-14', 293, '2022-07-14'),
		(2, 1, 1, 2, 250, '2022-07-14', 250, '2022-07-14'),
		(3, 1, 1, 4, 0, '2022-07-14', 0, '2022-07-14'),
		(4, 1, 1, 11, 0, '2022-07-14', 0, '2022-07-14'),
		(5, 1, 1, 5, 48, '2022-07-14', 48, '2022-07-14'),
		(6, 1, 1, 6, 0, '2022-07-14', 0, '2022-07-14'),
		(7, 1, 1, 7, 0, '2022-07-14', 0, '2022-07-14'),
		(8, 1, 1, 8, 0, '2022-07-14', 0, '2022-07-14'),
		(9, 1, 1, 9, 0, '2022-07-14', 0, '2022-07-14'),
		(10, 1, 1, 10, 0, '2022-07-14', 0, '2022-07-14')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `po` (`id`, `po_code`, `lpo_id`, `quotation`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `delivery_limit`, `received`) VALUES
		(1, 'PO-0001-22', 1, 'QT123-22', '2022-06-11', 1, 1, 1, '2022-06-25', 1),
		(2, 'PO-0002-22', 2, 'quote1234-22', '2022-11-06', 1, 1, 1, '2022-11-01', 1),
		(3, 'PO-0003-22', 3, 'qwqwqw', '2022-11-06', 2, 1, 1, '2022-10-30', 1),
		(4, 'PO-0004-22', 5, '', '2022-11-10', 2, 1, 1, '2022-11-16', 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `po_details` (`id`, `po_id`, `warehouse_id`, `product_id`, `qty`, `qty_appr`, `agent_id`) VALUES
		(1, 1, 1, 1, 50, 50, 1),
		(2, 1, 1, 2, 50, 50, 1),
		(3, 1, 1, 5, 50, 50, 1),
		(4, 2, 1, 1, 350, 350, 1),
		(5, 2, 1, 5, 450, 450, 1),
		(6, 3, 1, 4, 450, 450, 1),
		(7, 4, 1, 6, 400, 400, 1),
		(8, 4, 1, 4, 500, 500, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `price` (`price_id`, `cost`, `selling_price`, `tax`, `warehouse_id`, `product_id`, `type`) VALUES
		(1, 45, 73.5, NULL, 1, 1, 0),
		(2, 57, 84, NULL, 1, 2, 0),
		(3, 45, 73.5, NULL, 2, 3, 0),
		(4, 25, 47, NULL, 1, 4, 0),
		(5, 20, 37, NULL, 1, 5, 0),
		(6, 27, 48, NULL, 1, 6, 0),
		(7, 37, 58, NULL, 1, 7, 0),
		(8, 18, 45, NULL, 1, 8, 0),
		(9, 13, 32, NULL, 1, 9, 0),
		(10, 45, 75, NULL, 1, 10, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `products` (`product_id`, `product_barcode`, `product_name`, `product_picture`, `supplier_id`, `product_unit`, `category_id`, `tax_id`, `min_stock`, `sec_stock`, `max_stock`, `alert_units`, `warehouse_id`, `status`) VALUES
		(1, '123456789001', 'Electric Heater 600 W', 'ed57c3dc3a47bb20.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 1, 1),
		(2, '123456789002', 'Electric Heater 1200 W', 'eqIZoKoMfRTPz8Xj.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 1, 0),
		(3, '88H-0000UB-0TV', 'Halogen Heater 1800 W', 'mJsEYVRjzLF93aeQ.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 2, 1),
		(4, '123456789562', 'Halogen Heater 1200W', 'w16cnhNz6oh7SZRH.jpg', 2, 1, 1, 12, 20, 80, 0, '100', 1, 1),
		(5, '123456789123', 'Halogen Heater 600 W', 'OciVLCv3e1OySuDh.jpg', 1, 1, 1, 7, 50, 150, 0, '200', 1, 1),
		(6, '123456789128', 'Electric Heater HVW11A', 'AJ6cznN4aEv92G7S.jpg', 2, 1, 1, 3, 50, 200, 0, '250', 1, 1),
		(7, '123456765456', 'Electric Heater VSW12', '3RcNLV3E5c1VpfiS.jpg', 4, 1, 1, 12, 100, 300, 0, '400', 1, 1),
		(8, '1564328794563', 'Heating Fan 2000W', '7FKFbAdBqpSJX4qt.jpg', 4, 2, 3, 12, 100, 300, 0, '400', 1, 1),
		(9, '1734524583456', 'Heating Fan 1500W', 'K5Cb0ranHGQHiN0j.jpg', 4, 1, 3, 12, 100, 300, 0, '400', 1, 1),
		(10, '1239873456785', 'Electric Fan 40 cm', '1CUo9tSbqSpZjamv.jpg', 1, 1, 7, 12, 50, 200, 0, '250', 1, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `product_categories` (`category_id`, `category_name`, `category_description`, `warehouse_id`, `status`) VALUES
		(1, 'Electric Heaters', 'Electric Heaters', 1, 1),
		(2, 'Ceramic Heaters', 'Ceramic Heaters', 1, 1),
		(3, 'Fan heaters', 'Fan heaters', 1, 1),
		(4, 'Electric Stones', 'Electric Stones', 1, 0),
		(5, 'Ceramic Stones', 'Ceramic Stones', 1, 0),
		(6, 'Compressors', 'Compressors', 1, 0),
		(7, 'Electric Fans', 'Electric Fans', 1, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO product_rates (rate_id, default_rate, level_1, level_2, level_3, level_4, level_5, store_id, product_id) VALUES
		(1, 73.5, 73.5, 73.5, 73.5, 73.5, 73.5, 1, 1),
		(2, 84, 84, 84, 84, 84, 84, 1, 2),
		(3, 73.5, 73.5, 73.5, 73.5, 73.5, 73.5, 2, 3),
		(4, 47, 47, 47, 47, 47, 47, 1, 4)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `receivings` (`id`, `rc_code`, `po_id`, `lpo_id`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `stored`) VALUES
		(1, 'RC-0001-22', 1, 1, '2022-06-17', 1, 1, 1, 1),
		(2, 'RC-0002-22', 2, 2, '2022-11-10', 1, 1, 1, 1),
		(3, 'RC-0003-22', 3, 3, '2022-11-10', 2, 1, 1, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `receiving_details` (`id`, `rc_id`, `order_id`, `lpo_id`, `date_reception`, `warehouse_id`, `product_id`, `qty`, `qty_appr`, `qty_dmg`, `agent_id`, `stored`) VALUES
		(1, 1, 1, 1, '2022-06-17', 1, 1, 50, 50, 0, 1, 1),
		(2, 1, 1, 1, '2022-06-17', 1, 2, 50, 50, 0, 1, 1),
		(3, 1, 1, 1, '2022-06-17', 1, 5, 50, 50, 0, 1, 1),
		(4, 2, 2, 2, '2022-11-10', 1, 1, 350, 350, 0, 1, 1),
		(5, 2, 2, 2, '2022-11-10', 1, 5, 450, 450, 0, 1, 1),
		(6, 3, 3, 3, '2022-11-10', 1, 4, 450, 450, 0, 1, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `returns` (`id`, `delivery_id`, `transfer_id`, `return_code`, `return_date`, `return_reference`, `from_warehouse`, `from_client`, `to_warehouse`, `agent_id`) VALUES
		(1, 0, 2, 'RET-0001-22', '2022-07-10', 'DC1523172001', 2, 0, 1, 1),
		(2, 1, 0, 'RET-0002-22', '2022-07-11', 'CR123456183', 0, 1, 1, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `return_details` (`id`, `return_id`, `warehouse_id`, `product_id`, `qty_returned`, `return_reason`) VALUES
		(1, 1, 1, 1, 2, 'Not working'),
		(2, 1, 1, 2, 0, 'Nothing'),
		(3, 2, 1, 1, 3, ''),
		(4, 2, 1, 5, 0, '')";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `settings` (`id`, `warehouseId`, `lang`, `multiLang`, `tzone`, `firstDay`, `dateFormat`, `timeFormat`, `defaultCurrency`, `decimalDigits`, `useThSep`, `thSepChar`) VALUES
		(1, 1, 1, 1, 'America/Vancouver', 2, 'dd-mm-yyyy', 1, 1, 3, 1, 2),
		(2, 4, 1, 0, 'UTC', 2, 'mm-dd-yyyy', 1, 1, 1, 1, 2)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `storage_area` (`id`, `warehouseId`, `StorageLength`, `StorageWidth`, `StorageHeight`, `stockType`) VALUES
		(1, 1, 70, 55, 7, 1),
		(2, 2, 50, 15, 4, 1),
		(3, 4, 50, 15, 4, 1)";
		$this->global_model->insertData($sql);
		//----
		$sql="INSERT INTO `storage_racking` (`id`, `warehouseId`, `rackingSystem`, `inventorySystem`, `storageSystem`, `rackHeight`, `rackLength`, `rackWidth`, `shelfHeight`, `aisle`) VALUES
		(1, 1, 1, 1, 1, 6, 2, 2, 2, 2),
		(2, 2, 1, 1, 1, 4, 2, 2, 1.5, 2),
		(3, 4, 1, 1, 1, 4, 2, 2, 2, 2)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `storage_reallines` (`id`, `virtualLine`, `visualLine`) VALUES
		(1, 1, 1),
		(2, 3, 2),
		(3, 4, 3),
		(4, 6, 4),
		(5, 7, 5),
		(6, 9, 6),
		(7, 10, 7),
		(8, 12, 8),
		(9, 13, 9),
		(10, 15, 10),
		(11, 16, 11),
		(12, 18, 12),
		(13, 19, 13),
		(14, 21, 14),
		(15, 22, 15),
		(16, 24, 16),
		(17, 25, 17),
		(18, 27, 18),
		(19, 28, 19),
		(20, 30, 20),
		(21, 31, 21),
		(22, 33, 22),
		(23, 34, 23),
		(24, 36, 24),
		(25, 37, 25),
		(26, 39, 26),
		(27, 40, 27),
		(28, 42, 28),
		(29, 43, 29),
		(30, 45, 30),
		(31, 46, 31),
		(32, 48, 32),
		(33, 49, 33),
		(34, 51, 34),
		(35, 52, 35),
		(36, 54, 36),
		(37, 55, 37),
		(38, 57, 38),
		(39, 58, 39),
		(40, 60, 40),
		(41, 61, 41),
		(42, 63, 42),
		(43, 64, 43),
		(44, 66, 44),
		(45, 67, 45),
		(46, 69, 46),
		(47, 70, 47),
		(48, 72, 48),
		(49, 73, 49),
		(50, 75, 50),
		(51, 76, 51),
		(52, 78, 52),
		(53, 79, 53),
		(54, 81, 54),
		(55, 82, 55),
		(56, 84, 56),
		(57, 85, 57),
		(58, 87, 58),
		(59, 88, 59),
		(60, 90, 60),
		(61, 91, 61),
		(62, 93, 62),
		(63, 94, 63),
		(64, 96, 64),
		(65, 97, 65),
		(66, 99, 66),
		(67, 100, 67)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `suppliers` (`supplier_id`, `supplier_code`, `full_name`, `register_number`, `mobile`, `phone`, `address`, `city`, `country`, `email`, `status`) VALUES
		(1, 'SUPP0001', 'General Equipments', '1234567', '125478963', '145236987', '123, str Jean Dunold,', 'City', 'Canada', 'contact@generalequipments.com', 1),
		(2, 'SUPP0002', 'Appliances Company ', '375-218-259', '6529856584', '6529856321', '12-153 2/4 main street Montreal QC H32 2YZ', 'Montreal', 'Canada', 'sales@appliacescmp.com', 1),
		(4, 'SUPP0003', 'Supplier 3', '145-523-654', '', '4521875', 'Adress of supplier 3', 'City', 'Canada', '', 0),
		(5, 'SP0004', 'Apha Supplies', '125-458-563-213', '3464646', '2121454545', 'District 15A, Road 123, Bloc B3', 'city 4', 'Canada', 'info@aphasupplies.com', 1),
		(6, 'SP0005', 'Dudet Electics', '145-256-521', '1234569874', '1234567891', 'Adress of supplier 5', 'City 5', 'Canada', 'supp5@mail.com', 1),
		(7, 'SP0006', 'Supplier 6', '12345698ME/20', '987654321', '123456789', 'Bloc 1, str 125, Disctrict 12A', 'Quebec', 'Canada', 'info@supp6.com', 1),
		(8, 'SP0008', 'Supplier 08', '123456789/MF', '1478523699632', '123456789213', 'Bloc 1, Street 123, Building 2C', 'Montreal', 'Canada', 'info@supplier.com', 1),
		(9, 'SP0009', 'Supplier 09', '12345879/MF', '125469856', '125456321', 'Address of supplier 09', 'city 9', 'country 9', 'info@supplier09.com', 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `transfers` (`transfer_id`, `transfer_code`, `datetime`, `warehouse_id`, `destination_id`, `agent_id`, `approved`, `loaded`, `received`) VALUES
		(1, 'TR-0001-22', '2022-05-27', 1, 2, 1, 1, 1, 1),
		(2, 'TR-0002-22', '2022-05-27', 1, 2, 1, 1, 1, 1),
		(3, 'TR-0003-22', '2022-05-27', 1, 3, 1, 1, 1, 0),
		(4, 'TR-0004-22', '2022-05-27', 1, 2, 1, 1, 1, 0),
		(5, 'TR-0005-22', '2022-08-17', 1, 2, 1, 1, 0, 0),
		(6, 'TR-0006-22', '2022-08-19', 1, 2, 1, 1, 1, 0),
		(7, 'TR-0007-22', '2022-11-06', 1, 2, 1, 0, 0, 0),
		(8, 'TR-0008-22', '2022-11-10', 1, 2, 1, 1, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `transfer_approved` (`approval_id`, `transfer_id`, `date_approve`, `warehouse_id`, `destination_id`, `product_id`, `qty`, `qty_appr`, `loaded`, `agent_id`) VALUES
		(1, 1, '2022-05-27', 1, 2, 1, 50, 50, 1, 1),
		(2, 2, '2022-05-27', 1, 2, 1, 120, 120, 1, 1),
		(3, 2, '2022-05-27', 1, 2, 2, 100, 100, 1, 1),
		(4, 3, '2022-05-27', 1, 3, 1, 75, 75, 1, 1),
		(5, 3, '2022-05-27', 1, 3, 2, 100, 100, 1, 1),
		(6, 3, '2022-05-27', 1, 3, 5, 100, 100, 1, 1),
		(7, 4, '2022-05-27', 1, 2, 2, 100, 100, 1, 1),
		(8, 5, '2022-08-19', 1, 2, 1, 100, 100, 0, 1),
		(9, 5, '2022-08-19', 1, 2, 2, 50, 50, 0, 1),
		(10, 6, '2022-11-06', 1, 2, 1, 122, 122, 1, 1),
		(11, 6, '2022-11-06', 1, 2, 2, 85, 85, 1, 1),
		(12, 8, '2022-11-10', 1, 2, 1, 200, 200, 0, 1),
		(13, 8, '2022-11-10', 1, 2, 4, 200, 200, 0, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `transfer_details` (`detailId`, `transferId`, `origin`, `destination`, `productId`, `qty`, `volume`, `weight`) VALUES
		(1, 1, 1, 2, 1, 50, 5.625, 375),
		(2, 2, 1, 2, 1, 120, 13.5, 900),
		(3, 2, 1, 2, 2, 100, 18, 900),
		(4, 3, 1, 3, 1, 75, 8.4375, 562.5),
		(5, 3, 1, 3, 2, 100, 18, 900),
		(6, 3, 1, 3, 5, 100, 15.12, 1450),
		(7, 4, 1, 2, 2, 100, 18, 900),
		(8, 5, 1, 2, 1, 100, 11.25, 750),
		(9, 5, 1, 2, 2, 50, 9, 450),
		(10, 6, 1, 2, 1, 122, 13.725, 915),
		(11, 6, 1, 2, 2, 85, 15.3, 765),
		(12, 7, 1, 2, 1, 150, 16.875, 1125),
		(13, 7, 1, 2, 2, 100, 18, 900),
		(14, 8, 1, 2, 1, 200, 22.5, 1560),
		(15, 8, 1, 2, 4, 200, 5.625, 2000)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO `transfer_received` (`reception_id`, `transfer_id`, `date_reception`, `from_warehouse`, `to_warehouse`, `product_id`, `qty`, `qty_appr`, `agent_id`) VALUES
		(1, 1, '2022-05-28', 1, 2, 1, 50, 50, 1),
		(2, 2, '2022-06-03', 1, 2, 1, 120, 120, 1),
		(3, 2, '2022-06-03', 1, 2, 2, 100, 100, 1)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO warehouses (id, warehouseName, address, city, state, country, manager, contact, mobile, area, volume, freezone, disabled) VALUES
		(1, 'My Warehouse', 'str1, b123B, district 12', 'Montreal', 'Quebec', 'Canada', 'Patrick Lubom', '12345678912', '145236589', 1500, 5000, 500, 0),
		(2, 'Warehouse 2', 'str1. bl2, disctrict 124', 'Montreal', 'Montreal', 'Canada', 'John Edison', '001586965423', '0', 1000, 3000, 300, 0),
		(3, 'Warehouse 3', 'str15A. bl7, disctrict 18', 'Montreal', 'Montreal', 'Canada', 'Edward Nilpom', '001586965423', '0', 1000, 3000, 300, 0),
		(4, 'Warehouse 4', 'Address of Warehouse 4', 'city 4', '', 'country 4', 'manager waeh 4', '123456789', '', 0, 0, 0, 0)";
		$this->global_model->insertData($sql);
		//---
		$sql="INSERT INTO warh_dimensions (id, warehouseId, warhLength, warhWidth, warhHeigth, office, restroom, otherFreeSpace, storage_cost_rate) VALUES
		(1, 1, 80, 70, 7, 12, 10, 0, 11.5),
		(2, 4, 80, 25, 4, 15, 10, 22, 11.6)";
		$this->global_model->insertData($sql);
		
		
		$msg = 'datainserted';
		echo json_encode($msg);
	 }
	 
	public function copyfolderdata () {
		$from = "./demodata/pictures/products/";
		$to = "./uploads/pictures/products/";
		$ext="*";
		$msg="";
		// SOURCE FOLDER CHECK
		if (!is_dir($from)) { 
			$msg = $from.$this->lang->line('does_not_exist'); 
			return; 
		}

		// CREATE DESTINATION FOLDER
		if (!is_dir($to)) {
			if (!mkdir($to)) { 
				$msg = $this->lang->line('can_not_create').$to; 
			} else {
				$msg = $this->lang->line('folder_created').$to."\r\n";
			}
		}

		// GET ALL FILES + FOLDERS IN SOURCE
		$all = glob("$from$ext", GLOB_MARK);
		//print_r($all);

		// COPY FILES + RECURSIVE INTERNAL FOLDERS
		if (count($all)>0) { foreach ($all as $a) {
			$ff = basename($a); // CURRENT FILE/FOLDER
			if (is_dir($a)) {
				copyfolder("$from$ff/", "$to$ff/");
			} else {
				if (!copy($a, "$to$ff")) { 
					$msg .=$this->lang->line('error_copying').$a.$this->lang->line('to').$to.$ff; 
					return;
				} else {
					$msg .= "<br/>".$a.$this->lang->line('copied').$to.$ff;
				}
			}	
		}}
		echo json_encode($msg);
	}
	 
	 
	
	
	
	
 
}