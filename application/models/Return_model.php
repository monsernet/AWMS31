<?php
	class Return_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//RETURN DETAILS 
		public function displayReturnDetails($returnId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('return_details');
			$this->db->where('return_id', $returnId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty_returned).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td >'.$record->return_reason.' </td>';
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="po-row"><td colspan="4"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
	}
		