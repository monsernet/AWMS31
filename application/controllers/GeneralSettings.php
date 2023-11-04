<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class GeneralSettings extends CI_Controller {
 
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
		
		$data['title'] = $this->lang->line('general_settings');
		$data['activemenu'] = 'genset';
		$data['companyRow'] = $this->global_model->RetreiveRow('companysettings', ['id' => 1]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$data['timezones'] = $this->global_model->timezone_list();
		$data['langs'] = $this->global_model->RetreiveData('lang','');
		$data['currencies'] = $this->global_model->RetreiveData('currencies','');
		$data['localSettings'] = $this->global_model->RetreiveRow('settings', ['warehouseId' => $this->session->userdata('warehouseid')]);
		$data['loginSessRow'] = $this->global_model->RetreiveRow('login_sessions', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['mailSettingsRow'] = $this->global_model->RetreiveRow('email_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['productBarcodingRow'] = $this->global_model->RetreiveRow('barcoding_products', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['packBarcodingRow'] = $this->global_model->RetreiveRow('barcoding_packs', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['productQr'] = $this->global_model->RetreiveRow('product_qr_settings', ['warehouse_id' => $this->session->userdata('warehouseid')]);
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader',$data);
		$this->load->view('inc/sidebar');
		$this->load->view('generalsettings/index');
		$this->load->view('inc/footer');
		
	}
	
	public function companysettings(){
		
		$data['title'] = $this->lang->line('company_settings');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('generalsettings/companysettings');
		$this->load->view('inc/footer');
		
	}
	//CHECK IF MAIL() FUNCTION IS ENABLED IN THE SERVER
	public function checkMailFunction() {
		$emailMethod = $this->global_model->sanitizeString($this->input->post('emailMethod'));
		if($emailMethod=="phpmail"){
			if ( function_exists( 'mail' ) )
			{
				$result="enabled";
			}
			else
			{
				$result="disabled";
			}
		} else {
			$result="";
		}
		echo json_encode($result);
	}
	
	//TEST SMTP CONNECTION
	public function testSmtpConnection() {
		$smtpServer = $this->global_model->sanitizeString($this->input->post('smtpServer'));
		$smtpPort = $this->global_model->sanitizeString($this->input->post('smtpPort'));
		$senderName = $this->global_model->sanitizeString($this->input->post('senderName'));
		$senderMail = $this->global_model->sanitizeString($this->input->post('senderMail'));
		$senderPassword = $this->global_model->sanitizeString($this->input->post('senderPassword'));
		
		$result = $this->global_model->authSendEmail($smtpServer,$smtpPort,30 ,'',$senderMail,$senderPassword ,$senderName, $senderName, 'monsernet@gmail.com', 'Ali', 'Test SMTP', 'This is a test message to test SMTP connection');
		echo json_encode($result);
	}
	
	//SAVE COMPANY INFORMATION 
	public function saveCompanySettings()
	{
        //CHECK IF COMPANY SETTINGS ALREADY EXIST
		if(intval($this->global_model->countItems('companysettings')) > 0) {
			// if no settings  -> redirect to company settings page 
			$this->session->set_flashdata('companyAlreadyExist', '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('company_information_already_exist').'</div>');
			redirect('home');
		} else {
			$cmp = array (
				'companyName'     		=> $this->global_model->sanitizeString($this->input->post('nc_companyFullName')),
				'business_title'      	=> $this->global_model->sanitizeString($this->input->post('nc_companyShortName')),
				'companyAddress'   		=> $this->global_model->sanitizeString($this->input->post('nc_companyBillingAddress')),
				'shippingAddress'      	=> $this->global_model->sanitizeString($this->input->post('nc_companyShippingAddress')),
				'tax_number'     		=> $this->global_model->sanitizeString($this->input->post('nc_companyTaxNumber')),
				'register_number'    	=> $this->global_model->sanitizeString($this->input->post('nc_companyRegisterNumber')),
				'companyPhone'       	=> $this->global_model->sanitizeString($this->input->post('nc_companyPhone')),
				'companyEmail'    		=> $this->global_model->sanitizeString($this->input->post('nc_companyEmail')),
				'country'      			=> $this->global_model->sanitizeString($this->input->post('nc_companyCountry')),
				'city'     				=> $this->global_model->sanitizeString($this->input->post('nc_companyCity'))
			);
			//inseert
			$this->db->insert('companysettings', $cmp);
			$cmp_id = $this->db->insert_id();

			if($cmp_id) {
				$this->session->set_flashdata('addCompanysuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('company_information_added_success').'</div>');
				//redirect to the warehouse selection page 
				redirect('home');
			} else {
				$this->session->set_flashdata('addCompanyError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('company_information_not_added_success').'</div>');
				//redirect to the warehouse selection page 
				redirect('home');
			}
		}
	}
	
	public function generateBarcodeExample(){
		
		$this->output->delete_cache();
		$barcodeType = $this->global_model->sanitizeString($this->input->post('barcodeType'));
		$barcodeNumber = $this->global_model->sanitizeString($this->input->post('barcodeNumber'));
		if($barcodeType==1) {
			$codeType='Code39';
		} else {
			$codeType='Code128';
		}
		$result='<img  src="./assets/barcode/barcode.php?codetype='.$codeType.'&size=50&text='.$barcodeNumber.'&print=true"/>';
		
		echo json_encode($result);
		
	}
	
	//UPDATE COMPANY INFORMATION
	public function updateCompanyInformation() {
		$companyFullName = $this->global_model->sanitizeString($this->input->post('companyFullName'));
		$companyShortName = $this->global_model->sanitizeString($this->input->post('companyShortName'));
		$companyEmail = $this->global_model->sanitizeString($this->input->post('companyEmail'));
		$companyPhone = $this->global_model->sanitizeString($this->input->post('companyPhone'));
		$companyShippingAddress = $this->global_model->sanitizeString($this->input->post('companyShippingAddress'));
		$companyBillingAddress = $this->global_model->sanitizeString($this->input->post('companyBillingAddress'));
		$companyTaxNumber = $this->global_model->sanitizeString($this->input->post('companyTaxNumber'));
		$companyRegisterNumber = $this->global_model->sanitizeString($this->input->post('companyRegisterNumber'));
		$companyCountry = $this->global_model->sanitizeString($this->input->post('companyCountry'));
		$companyCity = $this->global_model->sanitizeString($this->input->post('companyCity'));
		
		$infos = array (
			'companyName' => $companyFullName,
			'business_title' => $companyShortName,
			'companyAddress' => $companyBillingAddress,
			'shippingAddress' => $companyShippingAddress,
			'tax_number' => $companyTaxNumber,
			'register_number' => $companyRegisterNumber,
			'companyPhone' => $companyPhone,
			'companyEmail' => $companyEmail,
			'country' => $companyCountry,
			'city' => $companyCity
		);
		$this->db->where(['id' => 1])->update('companysettings', $infos);
		$result = $this->lang->line('company_info_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE APPLICATION SETTINGS
	public function updateApplicationSettings() {
		$applicationLongName = $this->global_model->sanitizeString($this->input->post('applicationLongName'));
		$applicationShortName = $this->global_model->sanitizeString($this->input->post('applicationShortName'));
		$applicationLogo = $this->global_model->sanitizeString($this->input->post('applicationLogo'));
		$applicationFavicon = $this->global_model->sanitizeString($this->input->post('applicationFavicon'));
		$captchaStatus = $this->global_model->sanitizeString($this->input->post('captchaStatus'));
		$siteKey = $this->global_model->sanitizeString($this->input->post('siteKey'));
		$secretKey = $this->global_model->sanitizeString($this->input->post('secretKey'));
		
		/*  If logo is not changed =>  */
		if($applicationLogo !='') {
			if ($applicationFavicon !='') {
				$infos = array (
					'long_name' => $applicationLongName,
					'short_name' => $applicationShortName,
					'logo' => $applicationLogo,
					'favicon' => $applicationFavicon,
					'use_captcha' => $captchaStatus,
					'secret_key' => $secretKey,
					'site_key' => $siteKey
				);
			} else {
				$infos = array (
					'long_name' => $applicationLongName,
					'short_name' => $applicationShortName,
					'logo' => $applicationLogo,
					'use_captcha' => $captchaStatus,
					'secret_key' => $secretKey,
					'site_key' => $siteKey
				);
			}
		} else {
			if ($applicationFavicon !='') {
				$infos = array (
					'long_name' => $applicationLongName,
					'short_name' => $applicationShortName,
					'favicon' => $applicationFavicon,
					'use_captcha' => $captchaStatus,
					'secret_key' => $secretKey,
					'site_key' => $siteKey
				);
			} else {
				$infos = array (
					'long_name' => $applicationLongName,
					'short_name' => $applicationShortName,
					'use_captcha' => $captchaStatus,
					'secret_key' => $secretKey,
					'site_key' => $siteKey
				);
			}
		}
		$this->db->where(['id' => 1])->update('application_settings', $infos);
		$result = $this->lang->line('application_settings_updated_success');
		echo json_encode($result);
	}
	
	
	//UPDATE LOCAL SETTINGS
	public function updateLocalSettings() {
		$defaultLanguage = $this->global_model->sanitizeString($this->input->post('defaultLanguage'));
		$default_timezone = $this->global_model->sanitizeString($this->input->post('default_timezone'));
		$firstDayOfWeek = $this->global_model->sanitizeString($this->input->post('firstDayOfWeek'));
		$autorizeMultiLanguages = $this->global_model->sanitizeString($this->input->post('autorizeMultiLanguages'));
		$defaultDateFormat = $this->global_model->sanitizeString($this->input->post('defaultDateFormat'));
		$defaultTimeFormat = $this->global_model->sanitizeString($this->input->post('defaultTimeFormat'));
		$defaultCurrency = $this->global_model->sanitizeString($this->input->post('defaultCurrency'));
		$currencyDecimalDigits = $this->global_model->sanitizeString($this->input->post('currencyDecimalDigits'));
		$useThousandSeparator = $this->global_model->sanitizeString($this->input->post('useThousandSeparator'));
		$thousandSeparator = $this->global_model->sanitizeString($this->input->post('thousandSeparator'));
		
		$infos = array (
			'lang' => $defaultLanguage,
			'multiLang' => $autorizeMultiLanguages,
			'tzone' => $default_timezone,
			'firstDay' => $firstDayOfWeek,
			'dateFormat' => $defaultDateFormat,
			'timeFormat' => $defaultTimeFormat,
			'defaultCurrency' => $defaultCurrency,
			'decimalDigits' => $currencyDecimalDigits,
			'useThSep' => $useThousandSeparator,
			'thSepChar' => $thousandSeparator
		);
		$this->db->where(['warehouseId' => $this->session->userdata('warehouseid')])->update('settings', $infos);
		$result = $this->lang->line('local_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE LOGIN SETTINGS
	public function updateLoginSettings() {
		$sessionTimeout = $this->global_model->sanitizeString($this->input->post('sessionTimeout'));
		$loginAttemps = $this->global_model->sanitizeString($this->input->post('loginAttemps'));
		$accountLockTime = $this->global_model->sanitizeString($this->input->post('accountLockTime'));
		
		
		$infos = array (
			'session_timeout' => $sessionTimeout,
			'login_attempts' => $loginAttemps,
			'wrong_attempts' => $accountLockTime
			
		);
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('login_sessions', $infos);
		$result = $this->lang->line('login_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE EMAIL SETTINGS
	public function updateEmailSettings() {
		$emailSendingMethod = $this->global_model->sanitizeString($this->input->post('emailSendingMethod'));
		$senderName = $this->global_model->sanitizeString($this->input->post('senderName'));
		$senderEmail = $this->global_model->sanitizeString($this->input->post('senderEmail'));
		$mailServer = $this->global_model->sanitizeString($this->input->post('mailServer'));
		$mailPort = $this->global_model->sanitizeString($this->input->post('mailPort'));
		$mailPassword = $this->global_model->sanitizeString($this->input->post('mailPassword'));
		
		$infos = array (
			'email_method' => $emailSendingMethod,
			'sender_name' => $senderName,
			'sender_email' => $senderEmail,
			
		);
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('email_settings', $infos);
		$result = $this->lang->line('email_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE PRODUCT BARCODE SETTINGS
	public function updateProductBarcodeSettings() {
		$productBarcodeTechnology = $this->global_model->sanitizeString($this->input->post('productBarcodeTechnology'));
		$productBarcodeType = $this->global_model->sanitizeString($this->input->post('productBarcodeType'));
		$paperSize = $this->global_model->sanitizeString($this->input->post('paperSize'));
		$paperOrientation = $this->global_model->sanitizeString($this->input->post('paperOrientation'));
		$marginTop = $this->global_model->sanitizeString($this->input->post('marginTop'));
		$marginBottom = $this->global_model->sanitizeString($this->input->post('marginBottom'));
		$marginLeft = $this->global_model->sanitizeString($this->input->post('marginLeft'));
		$marginRight = $this->global_model->sanitizeString($this->input->post('marginRight'));
		$barcodesPerRow = $this->global_model->sanitizeString($this->input->post('barcodesPerRow'));
		$barcodesPerCol = $this->global_model->sanitizeString($this->input->post('barcodesPerCol'));
		$barcodePadding = $this->global_model->sanitizeString($this->input->post('barcodePadding'));
		
		$infos = array (
			'barcode_technology' => $productBarcodeTechnology,
			'barcode_type' => $productBarcodeType,
			'paper_size' => $paperSize,
			'paper_orientation' => $paperOrientation,
			'margin_top' => $marginTop,
			'margin_bottom' => $marginBottom,
			'margin_left' => $marginLeft,
			'margin_right' => $marginRight,
			'barcodes_row' => $barcodesPerRow,
			'barcodes_col' => $barcodesPerCol,
			'barcode_padding' => $barcodePadding
		);
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('barcoding_products', $infos);
		$result = $this->lang->line('product_barcode_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE PACK BARCODE SETTINGS
	public function updatePackBarcodeSettings() {
		$packBarcodeTechnology = $this->global_model->sanitizeString($this->input->post('packBarcodeTechnology'));
		$packBarcodeType = $this->global_model->sanitizeString($this->input->post('packBarcodeType'));
		$packPaperSize = $this->global_model->sanitizeString($this->input->post('packPaperSize'));
		
		$infos = array (
			'barcode_technology' => $packBarcodeTechnology,
			'barcode_type' => $packBarcodeType,
			'paper_size' => $packPaperSize
		);
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('barcoding_packs', $infos);
		$result = $this->lang->line('pack_barcode_settings_updated_success');
		echo json_encode($result);
	}
	
	//UPDATE PRODUCT QR CODE SETTINGS
	public function updateProductQrSettings() {
		$qrEccLevel = $this->global_model->sanitizeString($this->input->post('qrEccLevel'));
		$qrSize = $this->global_model->sanitizeString($this->input->post('qrSize'));
		
		$infos = array (
			'ecc_level' => $qrEccLevel,
			'size' => $qrSize
		);
		$this->db->where(['warehouse_id' => $this->session->userdata('warehouseid')])->update('product_qr_settings', $infos);
		$result = $this->lang->line('product_qr_settings_updated_success');
		echo json_encode($result);
	}
	
	//SAVE NEW CURRENCY -- 
	public function saveNewCurrency()
	{
        $currency = array (
          'curr_symbol'     	=> $this->global_model->sanitizeString($this->input->post('currencySymbol')),
		  'curr_code' 			=> $this->global_model->sanitizeString($this->input->post('currencyCode')),
		  'curr_name' 			=> $this->global_model->sanitizeString($this->input->post('currencyName'))
        );
		//inseert
        $this->db->insert('currencies', $currency);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	function generate_qrcode($data)
	{
        /* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data.'.png';

        /* QR Code File Directory Initialize */
        $dir = 'assets/media/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        /* Return Data */
        $result = array(
            'content' => $data,
            'file'    => $dir. $save_name
        );
        echo json_encode($result);
    }
	
	function uploadFileAjax()
	{
		/* Getting file name */
		$filename = $_FILES['file']['name'];
		// Get extension
		$ext = '.'.pathinfo($filename, PATHINFO_EXTENSION);
		//Randon file Name
		$phrase = substr(md5(uniqid(rand(), true)),16, 16);
		//New File Name
		$newFileName = $phrase.$ext;
		/* Location */
		$location = "uploads/application/".$newFileName;
		$uploadOk = 1;
  
		if($uploadOk == 0){
			$result = "notuploaded";
		} else {
			/* Upload file */
			if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
				$result =  $newFileName;
			}else{
				$result = "notuploaded";
			}
		}
		echo json_encode($result);
	}
	
	
	
	
	
	
	
 
}