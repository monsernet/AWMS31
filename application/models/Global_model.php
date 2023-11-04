<?php
	class Global_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			
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
	
	//SET DATE FORMAT
	public function setDateFormat($date, $format){

		if($format=='mm-dd-yyyy') {
			return date('m-d-Y', strtotime($date));
		} elseif($format=='dd-mm-yyyy') {
			return date('d-m-Y', strtotime($date));
		} elseif($format=='mm/dd/yyyy') {
			return date('m/d/Y', strtotime($date));
		} elseif($format=='dd/mm/yyyy') {
			return date('d/m/Y', strtotime($date));
		} elseif($format=='yyyy-mm-dd') {
			return date('Y-m-d', strtotime($date));
		} elseif($format=='yyyy/mm/dd') {
			return date('Y/m/d', strtotime($date));
		} else {
			return date('d-m-Y', strtotime($date));
		}

	}
	
	//SET NUMBER FORMAT
	public function setNumberFormat($number){
		$result ="";
		$decimals = 0;
		$strdecimals = $this->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'decimalDigits');
		if($strdecimals=='') {$decimals = 0;} else {$decimals = $strdecimals;}
		$useSeperator = $this->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'useThSep');
		$seperator = $this->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'thSepChar');
			if ($useSeperator==1) {
					if($seperator == 1){
						$result = number_format($number, $decimals, '.', ' ');
					} elseif($seperator == 2){
						$result = number_format($number, $decimals, '.', ',');
					} else{
						$result = number_format($number, $decimals, '.', '');
					} 
			} else {
					$result = number_format($number, $decimals, '.', '');
			}
		
		return $result;
	}
	
	public function setNumberFormatWithoutDecimals($number){
		$result ="";
		$decimals = 0;
		$useSeperator = $this->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'useThSep');
		$seperator = $this->getItem('settings', 'warehouseId', $this->session->userdata('warehouseid'), 'thSepChar');
			if ($useSeperator==1) {
					if($seperator == 1){
						$result = number_format($number, $decimals, '.', ' ');
					} elseif($seperator == 2){
						$result = number_format($number, $decimals, '.', ',');
					} else{
						$result = number_format($number, $decimals, '.', '');
					} 
			} else {
					$result = number_format($number, $decimals, '.', '');
			}
		
		return $result;
	}
	
	// TIME ZONE LIST
	function timezone_list() {
	  $time_Zones_arr = array();
	  $live_timestamp = time();
	  foreach(timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$time_Zones_arr[$key]['zone'] = $zone;
		$time_Zones_arr[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $live_timestamp);
	  }
	  return $time_Zones_arr;
	}

	public function get_mysqli() { 
		$db = (array)get_instance()->db;
		return mysqli_connect('localhost', $db['username'], $db['password'], $db['database']);
	} 
	
	// EMAIL FORMAT VALIDATION
	public function validateEmail($email) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	//TEST SMTP CONNECTION
	public function testSmtpConnection($smtpServer) {
		$f = fsockopen($smtpServer, 25) ;
		if ($f !== false) {
			$res = fread($f, 1024) ;
			if (strlen($res) > 0 && strpos($res, '220') === 0) {
				return "true" ;
			}
			else {
				//return "Error: " . $res ;
				throw new Exception("Error: " . $res);
			}
		}
		fwrite($f, 'QUIT'."\r\n");
		fclose($f) ;
	}
	
	public function send(){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
		$mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host     = 'mail.your-domain.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'user-name@your-domain.com';
        $mail->Password = 'your-password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;  // change the port number if necessary
		
		$mail->mailer = "smtp";
        
        $mail->setFrom('user-name@your-domain.com', 'YOUR-NAME');
        $mail->addReplyTo('user-name@domain.com', 'YOUR-NAME');
        
        // Add a recipient
        $mail->addAddress('info@your-domain.com');
        
        // Add cc or bcc 
        $mail->addCC('info@your-domain.com');
        $mail->addBCC('info@your-domain.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }
	
	function authSendEmail($smtpServer,$port,$timeout ,$auth,$username,$password ,$from, $namefrom, $to, $nameto, $subject, $message)
	{
	//SMTP + SERVER DETAILS
	/* * * * CONFIGURATION START * * * */
	 
	$localhost = "localhost";
	$newLine = "\r\n";
	/* * * * CONFIGURATION END * * * * */
	 
	//Connect to the host on the specified port
	$smtpConnect = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
	$smtpResponse = fgets($smtpConnect, 515);
	if(empty($smtpConnect))
	{
	$output = "Failed to connect: $smtpResponse";
	return $output;
	}
	else
	{
	$logArray['connection'] = "Connected: $smtpResponse";
	}
	if ($auth)
	{
	//Request Auth Login
	fputs($smtpConnect,"AUTH LOGIN" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output ."$smtpResponse";
	 
	//Send username
	fputs($smtpConnect, base64_encode($username) . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output . "$smtpResponse";
	 
	//Send password
	fputs($smtpConnect, base64_encode($password) . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output . "$smtpResponse";
	}
	//Say Hello to SMTP
	fputs($smtpConnect, "HELO $localhost" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output ."$smtpResponse";
	 
	//Email From
	fputs($smtpConnect, "MAIL FROM: $from" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output . "$smtpResponse";
	 
	//Email To
	fputs($smtpConnect, "RCPT TO: $to" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output ."$smtpResponse";
	 
	//The Email
	fputs($smtpConnect, "DATA" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output . "$smtpResponse";
	 
	//Construct Headers
	$headers = "MIME-Version: 1.0" . $newLine;
	$headers .= "Content-type: text/html; charset=iso-8859-1" . $newLine;
	$headers .= "To: $nameto &lt;$to&gt;" . $newLine;
	$headers .= "From: $namefrom &lt;$from&gt;" . $newLine;
	 
	fputs($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output . "$smtpResponse";
	 
	// Say Bye to SMTP
	fputs($smtpConnect,"QUIT" . $newLine);
	$smtpResponse = fgets($smtpConnect, 515);
	$output = $output ."$smtpResponse";
	 
	return $output;
	}
	
	//CHECK IF AN SPECIFIC ITEM EXISTS
	public function itemExist($tableName, $itemId, $itemValue) {
        $this->db->where($itemId, $itemValue);
        if ($this->db->get($tableName)->num_rows()> 0) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	
	//CHECK IF AN SPECIFIC ITEM EXISTS WITH CONDITION
	public function itemExistWithCondition($tableName, $itemId, $itemValue, $condition) {
        $this->db->where($itemId, $itemValue);
		$this->db->where($condition);
        if ($this->db->get($tableName)->num_rows()> 0) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	
	//CHECK IF AN SPECIFIC ITEM EXISTS WITH CONDITION
	public function itemExistMultiConditions($tableName, $condition) {
		$this->db->where($condition);
        if ($this->db->get($tableName)->num_rows()> 0) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	
	//COUNT ITEMS IN A TABLE
	public function countItems($table, $conditionField=NULL, $conditionValue=NULL) {
		
		$this->db->select('*');
		$this->db->from($table);
		if($conditionField !=NULL) {
			$this->db->where($conditionField, $conditionValue);
		}
		return $this->db->count_all_results();
	}
	
	//COUNT ITEMS IN A TABLE WITH MULTIPLE CONDITIONS
	public function countItemsMultiConditions($table, $condition) {
		
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		return $this->db->count_all_results();
	}
	
	// LOAD DATA FROM A TABLE
		public function RetreiveData($tableName, $multipleWhere='') {
			$this->db->select("*");
			$this->db->from($tableName);
			if($multipleWhere!='') {
				$this->db->where($multipleWhere);
			}
			$query = $this->db->get();
			if($query->result()) {
				return $query->result();
			} else {
				return '';
			}
		}
	
	// LOAD GROUPED DATA FROM A TABLE
		public function RetreiveGroupedData($tableName, $multipleWhere, $groupField) {
			$this->db->select("*");
			$this->db->from($tableName);
			if($multipleWhere!='') {
				$this->db->where($multipleWhere);
			}
			$this->db->group_by($groupField);
			$query = $this->db->get();
			if($query->result()) {
				return $query->result();
			} else {
				return '';
			}
		}
		
	// LOAD ORDERED DATA FROM A TABLE
		public function RetreiveOrderedData($tableName, $multipleWhere, $orderField, $orderFilter) { 
			/* 
			IMPORTANT : ORDERFILTER SHOULD HAVE AS VALUE EITHER 'DESC' OR 'ASC'. OTHERWISE, A DABTABASE ERROR WILL OCCUR
			   ORDERFILTER = desc => if ordering from high to low
			   ORDERFILTER = asc  => if ordering from low to top
			*/
			$this->db->select("*");
			$this->db->from($tableName);
			if($multipleWhere!='') {
				$this->db->where($multipleWhere);
			}
			$this->db->order_by($orderField, $orderFilter);
			$query = $this->db->get();
			if($query->result()) {
				return $query->result();
			} else {
				return '';
			}
		}
	
	// RETREIVE ROW FROM TABLE
		public function RetreiveRow($tableName, $condition) {
			$this->db->select("*");
			$this->db->from(strtolower($tableName));
			$this->db->where($condition);
			$query = $this->db->get();
			return ($query->row()) ? $query->row() : '';
			//return ;
		}
		
	// to load the data of a selected dropdown
		public function RetreiveSelectData($tableName) {
			$this->db->select("*");
			$this->db->from($tableName);
			$query = $this->db->get();
			return $query->result();
		}
		//Retreive item data
		public function getItem($table, $fieldId, $fieldValue, $searchField) {
			$this->db->select("*");
			$this->db->from(strtolower($table));
			$this->db->where($fieldId, $fieldValue);
			$query = $this->db->get();
			if($row  = $query->row()) {
				return $row->$searchField;	
			} else {
				return "";
			}
					
		}
		
		//Retreive item data with multiple conditions
		public function getItemMultiConditions($table, $conditions, $searchField) {
			$this->db->select("*");
			$this->db->from(strtolower($table));
			$this->db->where($conditions);
			$query = $this->db->get();
			if($row  = $query->row()) {
				return $row->$searchField;	
			} else {
				return "";
			}
					
		}
		
		// get last Id from a table
		public function getLastId($table, $idField) {
            $this->db->select_max($idField);
			$result = $this->db->get($table)->row();
			if($result) {
				return $result->$idField;
			} else {
				return 0;
			}

		}
		public function getMinId($table, $idField) {
			$this->db->select_min($idField);
			$result = $this->db->get($table)->row();  
			return $result->$idField;
		}
		
		public function defaultCurrency($warehouseId) {
			$this->db->select("*");
			$this->db->from('settings');
			$this->db->where('warehouseId', $warehouseId);
			$query = $this->db->get();
			$curr_id = 0;
			if($row = $query->row()){
				return ($this->getItem ('currencies', 'id', $row->defaultCurrency, 'curr_symbol'));
			} else {
				return '$';
			}
		}
		
		public function emptyTable($table) {
			//$this->db->query("TRUNCATE " . strtolower($table));
			$this->db->truncate(strtolower($table));
			$this->db->query("ALTER TABLE ".strtolower($table)." AUTO_INCREMENT = 1");
			//$result = $this->db->get();
			return $table.' cleared';
		}
		
		public function insertData( $sql) {
			$this->db->query($sql);
			return 'inserted';
		}
		
		public function getProductUnit($productId) {
			$productUnit = $this->getItem ('products', 'product_id', $productId, 'product_unit');
			return ($this->getItem ('measuring_units', 'id', $productUnit, 'code'));
		}
		
		
		
		
		
	}
?>