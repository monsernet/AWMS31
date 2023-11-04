<?php
	class Order_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//ADD PRODUCT TO LPO
		public function addProductToLPO( $prId, $qty)
		{
			$content = '';
			$content .='<tr>';
			$content .='<td><input type="hidden" name="lpoPrId[]" value="'.$prId.'">'.$this->global_model->getItem('products', 'product_id', $prId, 'product_barcode').'</td>';
			$content .='<td>'.$this->global_model->getItem('products', 'product_id', $prId, 'product_name').'</td>';
			$content .='<td class="text-right"><input type="hidden" name="lpoPrQty[]" value="'.$qty.'">'.$this->global_model->setNumberFormat($qty).' '.$this->global_model->getProductUnit($prId).'</td>';
			$content .='<td class="text-center"><button type="button" class="btn btn-sm btn-danger removeRow" title="'.$this->lang->line('remove').'"><i class="fa fa-times-circle"></i></button> </td>';
			$content .='</tr>';
			return $content;
			
		}
		
		//LPO DETAILS 
		public function displayOrderDetails($orderId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('order_details');
			$this->db->where('order_id', $orderId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					//IF LPO IS NOT APPROVED YET ==> APPROVED QTY = 0
					if($this->global_model->getItem('orders', 'order_id', $orderId, 'approved')==0){
						$content .='<td class="text-right">0.00 '.$this->global_model->getProductUnit($record->product_id).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('po_details', ['po_id' => $orderId, 'product_id' =>$record->product_id], 'qty_appr')).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					}
					//IF ORDER IS NOT RECEIVED YET ==> RECEIVED QTY = 0
					if($this->global_model->getItem('orders', 'order_id', $orderId, 'received')==0){
						$content .='<td class="text-right">0.00 '.$this->global_model->getProductUnit($record->product_id).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('rc_details', ['lpo_id' => $orderId, 'product_id' =>$record->product_id], 'qty_appr')).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					}
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="lpo-row"><td colspan="5"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		//PO DETAILS 
		public function displayPODetails($orderId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('po_details');
			$this->db->where('po_id', $orderId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty_appr).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					//IF ORDER IS NOT RECEIVED YET ==> RECEIVED QTY = 0 ELSE DISPLAY RECEIVED QTY
					if($this->global_model->getItem('po', 'id', $orderId, 'received')==0){
						$content .='<td class="text-right">0.00 '.$this->global_model->getProductUnit($record->product_id).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('receiving_details', ['order_id' => $orderId, 'product_id' =>$record->product_id], 'qty_appr')).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					}
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="po-row"><td colspan="5"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		//RECEIVING DETAILS 
		public function displayReceivingDetails($recId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('receiving_details');
			$this->db->where('rc_id', $recId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty_appr).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty_dmg).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="inventory-row"><td colspan="5"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		
		
		
	}
?>