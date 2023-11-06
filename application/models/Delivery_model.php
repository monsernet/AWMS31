<?php
	class Delivery_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//ADD PRODUCT TO ORDER
		public function addProductToCustomerOrder( $prId, $qty)
		{
			$content = '';
			$content .='<tr>';
			$content .='<td><input type="hidden" name="orderPrId[]" value="'.$prId.'">'.$this->global_model->getItem('products', 'product_id', $prId, 'product_barcode').'</td>';
			$content .='<td>'.$this->global_model->getItem('products', 'product_id', $prId, 'product_name').'</td>';
			$content .='<td class="text-right"><input type="hidden" name="orderPrQty[]" value="'.$qty.'">'.$this->global_model->setNumberFormat($qty).' '.$this->global_model->getProductUnit($prId).'</td>';
			$content .='<td class="text-center"><button type="button" class="btn btn-sm btn-danger removeRow" title="'.$this->lang->line('remove').'"><i class="fa fa-times-circle"></i></button> </td>';
			$content .='</tr>';
			return $content;
		}
		
		//TOTAL VOLUME OF A CUSTOMER ORDER
		public function orderVolume( $orderId) {
			$this->db->select("SUM(volume) as sumVolume ");
			$this->db->from('clientorder_details');
			$this->db->where('order_id', $orderId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumVolume);
			} else {
				return 0;
			}
		}
		
		//TOTAL WEIGHT OF A CUSTOMER ORDER
		public function orderWeight ($orderId) {
			$this->db->select("SUM(weight) as sumWeight ");
			$this->db->from('clientorder_details');
			$this->db->where('order_id', $orderId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumWeight);
			} else {
				return 0;
			}
		}
		
		//ORDER DETAILS 
		public function displayOrderDetails($orderId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('clientorder_details');
			$this->db->where('order_id', $orderId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getItem('measuring_units', 'id',$record->product_id,'code').' </td>';
					//IF ORDER IS NOT APPROVED YET ==> APPROVED QTY = 0
					if($this->global_model->getItem('clientorders', 'order_id', $orderId, 'approved')==0){
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat(0).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('clientorder_details', ['order_id' => $orderId, 'product_id' =>$record->product_id], 'qty')).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					}
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="order-row"><td colspan="4"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		//DELIVERY DETAILS 
		public function displayDeliveryDetails($deliveryId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('delivery_details');
			$this->db->where('delivery_id', $deliveryId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->product_id, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->order_qty).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getProductUnit($record->product_id).' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->volume).' '.$this->lang->line("cubic_meter").' </td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->weight).' '.$this->lang->line("kg").' </td>';
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="po-row"><td colspan="6"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		//DELIVERY PICKUP -- GET THE PICK UP DETAILS OF A SPECIFIC PRODUCT
		public function getProductPickupDetails ($productId, $deliveryId) {
			$content='';
			$this->db->select("*");
			$this->db->from('occupancy');
			$this->db->where('delivery_id', $deliveryId);
			$this->db->where('product_id', $productId);
			$records = $this->db->get();
			if($records->result()) {
				$content .='<ul class="list-unstyled">';
				foreach($records->result() as $record) {
					$content .='<li class="list-group-item d-flex justify-content-between align-items-center py-1">';
					$content .='Location: R'.$record->row_occ.'-L'.$this->warehouse_model->getRealLocation($record->line_occ).'-S'.$record->shelf_occ;
					$content .='<span class="text-primary">'.$this->global_model->setNumberFormat($record->out_occ).' '.$this->lang->line("cubic_meter").'</span>';
					$content .='</li>';
				}
				$content .='</ul>';
			}
			
			return $content;
		}
		
		//DELIVERY PACKAGING -- GET THE NUMBER OF BOXES FOR A DELIVERED PRODUCT
		public function getProductPackBoxes ($productId, $deliveryId) {
			
			$boxQty = $this->global_model->getItem('dimensions', 'product_id', $productId, 'units_pr');
			$deliveryPrQty = $this->global_model->getItemMultiConditions('delivery_details', ['product_id' => $productId, 'delivery_id' => $deliveryId], 'qty');
			if($boxQty > 0) {
				$nbBoxes = $deliveryPrQty/$boxQty;
			} else {
				$nbBoxes = 0;
			}
			return $nbBoxes;

		}
		
		
		
		
		
		
		
		
		
		
		
	}
?>