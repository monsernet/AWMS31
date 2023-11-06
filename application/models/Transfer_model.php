<?php
	class Transfer_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//ADD PRODUCT TO TRANSFER
		public function addProductToTransfer( $prId, $qty)
		{
			$content = '';
			$content .='<tr>';
			$content .='<td><input type="hidden" name="transferPrId[]" value="'.$prId.'">'.$this->global_model->getItem('products', 'product_id', $prId, 'product_barcode').'</td>';
			$content .='<td>'.$this->global_model->getItem('products', 'product_id', $prId, 'product_name').'</td>';
			$content .='<td class="text-right"><input type="hidden" name="transferPrQty[]" value="'.$qty.'">'.$this->global_model->setNumberFormat($qty).' '.$this->global_model->getProductUnit($prId).'</td>';
			$content .='<td class="text-center"><button type="button" class="btn btn-sm btn-danger removeRow" title="'.$this->lang->line('remove').'"><i class="fa fa-times-circle"></i></button> </td>';
			$content .='</tr>';
			return $content;
		}
		
		//TOTAL VOLUME OF A TRANSFER
		public function transferVolume( $transferId) {
			$this->db->select("SUM(volume) as sumVolume ");
			$this->db->from('transfer_details');
			$this->db->where('transferId', $transferId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumVolume);
			} else {
				return 0;
			}
		}
		
		//TOTAL WEIGHT OF A TRANSFER
		public function transferWeight ($transferId) {
			$this->db->select("SUM(weight) as sumWeight ");
			$this->db->from('transfer_details');
			$this->db->where('transferId', $transferId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumWeight);
			} else {
				return 0;
			}
		}
		
		
		
		//TRANSFER DETAILS 
		public function displayTransferDetails($transferId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('transfer_details');
			$this->db->where('transferId', $transferId);
			$records = $this->db->get();
			if($records->result()) {
				$count = 0;
				foreach($records->result() as $record) {
					$count ++;
					$content .='<tr >';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->productId, 'product_barcode').'</td>';
					$content .='<td>'.$this->global_model->getItem('products', 'product_id', $record->productId, 'product_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->qty).' '.$this->global_model->getProductUnit($record->productId).' </td>';
					//IF TRANSFER IS NOT APPROVED YET ==> APPROVED QTY = 0
					if($this->global_model->getItem('transfers', 'transfer_id', $transferId, 'approved')==0){
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat(0).' '.$this->global_model->getProductUnit($record->productId).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('transfer_approved', ['transfer_id' => $transferId, 'product_id' =>$record->productId], 'qty_appr')).' '.$this->global_model->getProductUnit($record->productId).' </td>';
					}
					//IF TRANSFER IS NOT RECEIVED YET ==> RECEIVED QTY = 0
					if($this->global_model->getItem('transfers', 'transfer_id', $transferId, 'received')==0){
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat(0).' '.$this->global_model->getProductUnit($record->productId).' </td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($this->global_model->getItemMultiConditions('transfer_received', ['transfer_id' => $transferId, 'product_id' =>$record->productId], 'qty_appr')).' '.$this->global_model->getProductUnit($record->productId).' </td>';
					}
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="inventory-row"><td colspan="5"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_items_found").'</div></td></tr>';
			}
			return $content;
		}
		
		
		//GET THE PICK UP DETAILS OF A SPECIFIC PRODUCT
		public function getProductPickupDetails ($productId, $transferId) {
			$content='';
			$this->db->select("*");
			$this->db->from('occupancy');
			$this->db->where('transfer_id', $transferId);
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
		
		//BEFORE APPROVING THE LOADING, WE HAVE TO CHECK IF ALL PRODUCTS OF A TRANSFER ARE PICKED UP
		public function checkProductPickup($transferId) {
			$this->db->select("*");
			$this->db->from('transfer_approved');
			$this->db->where('transfer_id', $transferId);
			$records = $this->db->get();
			$pickup = TRUE;
			if($records->result()) {
				foreach($records->result() as $record) {
					if($record->loaded == 0) {
						$pickup = FALSE;
						break;
					}
				}
			}
			return $pickup;
		}
		
		//CHECK IF A RECEIVED TRANSFER IS STORED OR NOT
		public function isTransferStored($transferId) {
			$this->db->select("*");
			$this->db->from('transfer_received');
			$this->db->where('transfer_id', $transferId);
			$records = $this->db->get();
			$stored = FALSE;
			if($records->result()) {
				$exist = FALSE;
				foreach($records->result() as $record) {
					$this->db->select("*");
					$this->db->from('occupancy');
					$this->db->where('transfer_id', $transferId);
					$this->db->where('product_id', $record->product_id);
					$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
					$records1 = $this->db->get();
					if($records1->result()) {
						$exist = TRUE;
					} else {
						$exist = FALSE;
						break;
					}
				}
				if ($exist == TRUE ){
					$stored = TRUE;
				} else {
					$stored = FALSE;
				}
			}
			return $stored;
			
		}
		
		
		
	}
?>