<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class User extends CI_Controller {
 
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
	
	//SANITIZE THE SQL REQUEST
	public function sanitizeString($value = ''){

		$value = trim($value);
		$value = strtr($value,array_flip(get_html_translation_table(HTML_ENTITIES)));
		$value = strip_tags($value);
		$value = mysqli_real_escape_string($this->get_mysqli(), $value);
		$value = htmlspecialchars($value);

		return $value;
	}
	
	public function get_mysqli() { 
		$db = (array)get_instance()->db;
		return mysqli_connect('localhost', $db['username'], $db['password'], $db['database']);
	} 
	
	//check if user exists
	public function user_exist($userEmail) {
        $this->db->where('userEmail', $userEmail);
        if ($this->db->get('users')->num_rows()> 0) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	
	// Email format validation
	public function validateEmail($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return TRUE;
		} else {
			return FALSE;
		}
}
 
	public function index(){
		$data = array();
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		//restrict users to go back to login if session has been set
		if($this->session->userdata('userid')){
			redirect('home');
		}
		else{
			$this->load->view('inc/header-login');
			$this->load->view('loggin', $data);
			$this->load->view('inc/footer-login');
		}
	}
	
	public function register(){
		
		//load session library
		$this->load->library('session');
		//restrict users to go back to login if session has been set
		if($this->session->userdata('userid')){
			redirect('home');
		}
		else{
			$this->load->view('inc/header-login');
			$this->load->view('register');
			$this->load->view('inc/footer-login');
		}
	}
	
	public function saveNewUser()
	{
		$userName = $this->global_model->sanitizeString($this->input->post('userName'));
		$userUsername = $this->global_model->sanitizeString($this->input->post('userUsername'));
		$email = $this->global_model->sanitizeString($this->input->post('email'));
		$password = $this->global_model->sanitizeString($this->input->post('password'));
		$rePassword = $this->global_model->sanitizeString($this->input->post('rePassword'));
		$verificationCode = uniqid();
		$activation_key = urlencode(base64_encode($verificationCode));
		$verificationLink = base_url() . 'register/email-confirmation/' .$activation_key ;
		$expiryDate = date('Y-m-d H:i:s', strtotime(' + 24 hours'));
		
		if ($this->global_model->itemExist('users', 'email', $id) && $this->global_model->getItem('users', 'activation_key',$id,'status') == 1) {
			$this->session->set_flashdata("emailExist",'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('email_exist').'</div>');
			redirect ('login');
		} elseif ($password != $rePassword) {
			$this->session->set_flashdata("passwordNotMatch",'<div class="alert alert-warning"><i class=" fa fa-exclamation-triangle"></i> '.$this->lang->line('password_not_match').'</div>');
			redirect ('register');
		} else {
		
			$hashedPass = password_hash($password, PASSWORD_DEFAULT);
			$data = array (
				'fullName' => $this->global_model->sanitizeString($this->input->post('userName')),
				'username' => $this->global_model->sanitizeString($this->input->post('userUsername')),
				'email' => $this->global_model->sanitizeString($this->input->post('email')),
				'password' => $hashedPass,
				'activation_key' => $activation_key,
				'activation_expiry' => $expiryDate
			);
			$this->db->insert('users', $data);
			$registerId = $this->db->insert_id();
			if($registerId) {
				$from_email = "admin@mywarehouse.com";
				$to_email = $email;
				//Load email library
				$this->load->library('email');
				$this->email->from($from_email, 'AWMS Administrator');
				$this->email->to($to_email);
				$this->email->subject('AWMS - '.$this->lang->line('confirm_registration'));
				$this->email->message($this->lang->line('welcome').strtoupper($this->global_model->sanitizeString($this->input->post('userName'))).'<br/>'.$this->lang->line('body_part1').'<br/><div class="text-center mt-3 mb-3"><a href="'.$verificationLink.'" class="btn btn-info" >'.$this->lang->line('body_part2').'</a></div><br/>'.$this->lang->line('body_part3'));
				$this->email->set_mailtype("html");
				//Send mail
				if($this->email->send()){
					$this->session->set_flashdata("confirmation_msg",'<div class="alert alert-success"><i class="fa fa-check-circle"></i>'.$this->lang->line('confirmation_success').'</div>');
					redirect ('login');
				}
				else {
					$this->session->set_flashdata("confirmation_msg",'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>'.$this->lang->line('confirmation_failure').'</div>');
					redirect ('register');
				}
			}
		}
		
			
	}
	
	public function confirnEmail($id) {
		$expiryDate = strtotime('Y-m-d H:i:s',$this->global_model->getItem('users', 'activation_key',$id,'activation_expiry'));
		$todayDate = date('Y-m-d H:i:s');
		if($this->global_model->getItem('users', 'activation_key',$id,'status') == 1) {
			$data["result"] = '<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('email_already_activated').'</div>';
		} elseif (!$this->global_model->itemExist('users', 'activation_key', $id)) {
			$data["result"] = '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('key_not_found').'</div>';	
		} elseif ($todayDate > $expiryDate) {
			$data["result"] = '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line('activation_expired').'</div>';	
		} else {
			$data["result"] = '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('email_confirmed_1').'</div><br><div class="row justify-content-md-center mb-5"><a class="btn btn-info text-white" href="'.base_url().'">'.$this->lang->line('login_account').'</a></div>';		
		}
		$this->load->view('inc/header-login');
		$this->load->view('registrationconfirm', $data);
	}
 
	public function login(){
		
		/* we have to check first if Google_captcha is enabled or not */
		$google_captcha_status = $this->input->post('google_captcha_enabled');
		/* if enabled */
		if($google_captcha_status=='yes') {
			$captcha_response = trim($this->input->post('g-recaptcha-response'));
			if($captcha_response != '')
			{
				//Get Secret_key from Application Settings
				$keySecret = $this->global_model->getItem('application_settings', 'id',1,'secret_key');

				$check = array(
					'secret'		=>	$keySecret,
					'response'		=>	$this->input->post('g-recaptcha-response')
				);

				$startProcess = curl_init();

				curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

				curl_setopt($startProcess, CURLOPT_POST, true);

				curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

				curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

				curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

				$receiveData = curl_exec($startProcess);

				$finalResponse = json_decode($receiveData, true);

				if($finalResponse['success'])
				{
					$email = $this->sanitizeString($this->input->post('email'));
					$password= $this->sanitizeString($this->input->post('password'));
					
					/* check the user login data */
					$data = $this->users_model->login($email, $password);
	 
					if($data['logged']==TRUE){
						//if Login with default username -> should change email & password
						if($email=='admin@mywarehouse.com') {
							// redirect to the page of changing user details
							$this->session->set_userdata('oldemail', $email); 
							$this->session->set_userdata('userid', $data['userId']);
							$this->session->set_userdata('username', $data['username']);
							$this->session->set_userdata('name', $data['name']);
							redirect('update-user-infos');
							
						} else {
							// session
							$this->session->set_userdata('userid', $data['userId']);
							$this->session->set_userdata('username', $data['username']);
							$this->session->set_userdata('name', $data['name']);
							
							// remember me
							if($this->input->post("rememberme")) {
								set_cookie ("loginId", $email, time()+ (3 * 60 * 60));  
								set_cookie ("loginPass", $password,  time()+ (3 * 60 * 60));
							} else {
								set_cookie ("loginId",""); 
								set_cookie ("loginPass","");
							}            
							redirect('home');
						}
					}
					else{  
						
						$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
						$data['loginError'] = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("login_invalid").'</div>'; 
						$this->load->view('inc/header-login');
						$this->load->view('loggin',$data);
					}
				}
				else
				{
					$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
					$data['loginError'] = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("captcha_verification_failed").'</div>'; 
					$this->load->view('inc/header-login');
					$this->load->view('loggin',$data);
				}

			}
			else
			{
				$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
				$data['loginError'] = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("captcha_verification_failed").'</div>'; 
				$this->load->view('inc/header-login');
				$this->load->view('loggin',$data);
			}
		} else { // means google_captcha is not enabled, so we proceed to login without checking captcha 
		
			$email = $this->sanitizeString($this->input->post('email'));
			$password= $this->sanitizeString($this->input->post('password'));
					
			/* check the user login data */
			$data = $this->users_model->login($email, $password);
	 
			if($data['logged']==TRUE){
				//if Login with default username -> should change email & password
				if($email=='admin@mywarehouse.com') {
					// redirect to the page of changing user details
					$this->session->set_userdata('oldemail', $email); 
					$this->session->set_userdata('userid', $data['userId']);
					$this->session->set_userdata('username', $data['username']);
					$this->session->set_userdata('name', $data['name']);
					redirect('update-user-infos');
							
				} else {
					// session
					$this->session->set_userdata('userid', $data['userId']);
					$this->session->set_userdata('username', $data['username']);
					$this->session->set_userdata('name', $data['name']);
							
					// remember me
					if($this->input->post("rememberme")) {
						set_cookie ("loginId", $email, time()+ (3 * 60 * 60));  
						set_cookie ("loginPass", $password,  time()+ (3 * 60 * 60));
					} else {
						set_cookie ("loginId",""); 
						set_cookie ("loginPass","");
					}            
					redirect('home');
				}
			}
			else{  
						
				$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
				$data['loginError'] = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("login_invalid").'</div>'; 
				$this->load->view('inc/header-login');
				$this->load->view('loggin',$data);
			}
		
		}
		
		
		
		
	}
	
	
	
	//CHANGE USER PASSWORD
	public function changeuserpassword()
	{
		$data['title'] = $this->lang->line('change_password');
		$data['userEmail'] = $this->global_model->getItem('users', 'id',$this->session->userdata('userid'),'email');
		$data['userName'] = $this->global_model->getItem('users', 'id',$this->session->userdata('userid'),'fullName');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('inc/topheader');
		$this->load->view('inc/sidebar');
		$this->load->view('users/changepassword',$data);
		$this->load->view('inc/footer');
	}
	
	//SAVE NEW PASSWORD
	public function saveLoginPassword()
	{
		
		$newUserName = $this->global_model->sanitizeString($this->input->post('cup_name'));
		$newPassword1 = $this->global_model->sanitizeString($this->input->post('cup_newPassword1'));
		$newPassword2 = $this->global_model->sanitizeString($this->input->post('cup_newPassword2'));
		if($newPassword1 != $newPassword2) {
			$this->session->set_flashdata('changePasswordError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  '.$this->lang->line('password_error').'</div>');
			redirect('user/change-password');
		} else {
			$hashedPass = password_hash($newPassword1, PASSWORD_DEFAULT);
			$data = array (
				  'fullName' => $newUserName,
				  'password' => $hashedPass
			);
			//update user password
			$this->db->where(['id' => $this->session->userdata('userid')])->update('users', $data);
			$this->session->set_flashdata('changePasswordSuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i>  '.$this->lang->line('password_change_error').'</div>');
			redirect('user/change-password');
			
		}
	}
	
	 //UPDATE USER INFO -- FIRST TIME USE 
	public function updateLoginInfos()
	{
		$data['title'] = $this->lang->line('update_user_details');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$this->load->view('inc/header',$data);
		$this->load->view('users/updateLoginDetails',$data);
		$this->load->view('inc/footer-login');
	}
	
	//SAVE UPDATED USER INFO -- FIRST TIME USE 
	public function saveLoginInfos()
	{
		$oldEmail = $this->global_model->sanitizeString($this->input->post('uu_oldEmail'));
		$newEmail = $this->global_model->sanitizeString($this->input->post('uu_newEmail'));
		$newPassword1 = $this->global_model->sanitizeString($this->input->post('uu_newPassword1'));
		$newPassword2 = $this->global_model->sanitizeString($this->input->post('uu_newPassword2'));
		if($oldEmail == $newEmail) {
			$this->session->set_flashdata('sameEmailError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  '.$this->lang->line('same_email_error').'</div>');
			redirect('update-user-infos');
		} elseif($newPassword1 != $newPassword2) {
			$this->session->set_flashdata('passwordError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  '.$this->lang->line('password_error').'</div>');
			redirect('update-user-infos');
		} else {
			$hashedPass = password_hash($newPassword1, PASSWORD_DEFAULT);
			$data = array (
				  'fullName' => $this->global_model->sanitizeString($this->input->post('uu_name')),
				  'email' => $this->global_model->sanitizeString($this->input->post('uu_newEmail')),
				  'password' => $hashedPass
			);
			//update user infos
			$this->db->where(['id' => 1])->update('users', $data);
			$this->logout();
			
		}
	}
	
	
		
	public function logout(){
		$this->load->library('session');
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('oldemail');
		$this->session->unset_userdata('warehouseid');
		redirect('/');
	}
	
	public function refreshCaptcha()
    {
        /************************************
		|******* REFRESH CAPTCHA REMOVED ************
		|***********************************/
    }
	
	public function userList()
	{
		$data['activedrop'] = 'users';
		$data['activemenu'] = 'allusers';
		$data['title'] = $this->lang->line('list_of_users');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$data['users'] = $this->global_model->RetreiveData('users','');
		$this->load->view('inc/header');
		$this->load->view('inc/topheader', $data);
		$this->load->view('inc/sidebar');
		$this->load->view('users/index',$data);
		$this->load->view('inc/footer');
	}
	
	public function createUser()
	{
		$data['activedrop'] = 'users';
		$data['activemenu'] = 'newuser';
		$data['title'] = $this->lang->line('new_user');
		$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
		$data['user_types'] = $this->global_model->RetreiveData('user_types','');
		$data['warehouses'] = $this->global_model->RetreiveData('warehouses','');
		$this->load->view('inc/header');
		$this->load->view('inc/topheader', $data);
		$this->load->view('inc/sidebar');
		$this->load->view('users/create',$data);
		$this->load->view('inc/footer');
	}
	
	//SAVE NEW USER TYPE -- NEW USER PAGE
	public function saveNewUserType()
	{
        $typ = array (
          'user_type'        => $this->global_model->sanitizeString($this->input->post('userTypeName')),
		  'type_description' => $this->global_model->sanitizeString($this->input->post('userTypeDescription'))
        );
		//inseert
        $this->db->insert('user_types', $typ);
		$result['rowId'] = $this->db->insert_id();

		echo json_encode($result);
	}
	
	public function saveUser()
	{
		
	  //form validation
    $this->form_validation->set_rules('userFullname', 'Full Name', 'trim|required|is_unique[users.fullName]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
	$this->form_validation->set_rules('newuser_username', 'Username', 'trim|required|is_unique[users.username]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
	$this->form_validation->set_rules('newuser_email', 'Email', 'trim|required|is_unique[users.email]', array(
                'is_unique'     => $this->lang->line('already_exists')
        ));
	$this->form_validation->set_rules('new_user_user_type', $this->lang->line('user_type'), 'trim|required');
	$this->form_validation->set_rules('new_user_warehouse', $this->lang->line('warehouse'), 'trim|required');
	
	
	// extract uploaded file 
	$config['upload_path'] = './uploads/pictures/users/';
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
		  'userFullname' => $this->global_model->sanitizeString($this->input->post('userFullname')),
          'new_user_user_type' => $this->global_model->sanitizeString($this->input->post('new_user_user_type')),
		  'new_user_warehouse' => $this->global_model->sanitizeString($this->input->post('new_user_warehouse')),
		  'newuser_username' => $this->global_model->sanitizeString($this->input->post('newuser_username')),
		  'newuser_email' => $this->global_model->sanitizeString($this->input->post('newuser_email')),
		  'password1' => $this->global_model->sanitizeString($this->input->post('uu_newPassword1')),
		  'password2' => $this->global_model->sanitizeString($this->input->post('uu_newPassword2'))
	);
	  // if all fields are ok, save data
      if ($this->form_validation->run()) {
		  
		  // Check if passwords are the same 
		  if($data['password1'] != $data['password2']) {
			$this->session->set_flashdata('passwordError', '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i>  '.$this->lang->line('password_error').'</div>');
			// to memorize the data already posted
			$this->session->set_flashdata('data',$data);
			// redirect to create form
			redirect(base_url('user/createUser'));
		  } else {
		  
			   // UPLOAD THE FILE
				$fileName0 = $_FILES['userImageFile']['name'];
				$phrase = substr(md5(uniqid(rand(), true)),16, 16);
				// Get extension
				$ext = '.'.pathinfo($fileName0, PATHINFO_EXTENSION);
				// File path
				$path = $upload_location.$phrase.$ext;
				 //Copy the uploaded file		
				move_uploaded_file($_FILES['userImageFile']['tmp_name'],$path);
				$fileName = $phrase.$ext;
				//Hash Password
				$hashedPass = password_hash($data['password1'], PASSWORD_DEFAULT);
				$user = array (
					'fullName' => $data['userFullname'],
					'username' => $data['newuser_username'],
					'email' => $data['newuser_email'],
					'password' => $hashedPass,
					'profileImage' => $fileName,
					'status' => 1,
					'user_type' => $data['new_user_user_type']
				 );
		

				$this->db->insert('users', $user);
				$userId = $this->db->insert_id();
				if($userId) {
					//insert access to warehouse
					$warehouse_access = array (
						'user_id' => $userId,
						'warehouse_id' => $data['new_user_warehouse'],
					);
					$this->db->insert(' warehouse_access', $warehouse_access);
					
				}
				$this->session->set_flashdata('addsuccess', '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->lang->line('new_user_added_success').'</div>');
		  }
      } else {
        // to display errors occured
		$this->session->set_flashdata('errors', validation_errors());
		// to memorize the data already posted
		$this->session->set_flashdata('data',$data);
		// redirect to create form
        redirect(base_url('user/createUser'));
      }

      redirect('users/list');
	}
	
	//EDIT PRODUCT
	public function editUser($id)
	{
    if (!$this->global_model->itemExist('users', 'id', $id)) {
		$this->session->set_flashdata('usernotexist', '<div class="alert alert-danger"> '.$this->lang->line('user_not_exist').'</div>');
		redirect('users');
	} else {		
	
	$data['title'] = $this->lang->line('edit_user');
	$data['user'] = $this->db->where(['id' => $id])->get('users')->row();
    $data['user_types'] = $this->global_model->RetreiveData('user_types','');
	$data['warehouses'] = $this->global_model->RetreiveData('warehouses','');
	$data['applicationRow'] = $this->global_model->RetreiveRow('application_settings', ['id' => 1]);
    $this->load->view('inc/header',$data);
	$this->load->view('inc/topheader',$data);
	$this->load->view('inc/sidebar');
	$this->load->view('users/edit');
	$this->load->view('inc/footer');
	}
  }
	
	
 
}