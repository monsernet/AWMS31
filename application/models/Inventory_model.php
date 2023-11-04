<?php
	class Inventory_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//CALCULATE  EOQ
		public function calculateEOQ($productId, $startDate, $endDate, $nbMonths)
		{
			$holdingCost = floatval($this->global_model->getItem('eoq_settings', 'warehouse_id',$this->session->userdata('warehouseid'),'holdingCost'));
			$orderingCost = floatval($this->global_model->getItem('eoq_settings', 'warehouse_id',$this->session->userdata('warehouseid'),'orderingCost'));
			$orderDemand = floatval($this->product_model->periodicSoldQty($productId, $startDate, $endDate));
			if($orderDemand > 0) {
				$eoq = sqrt((2*$orderingCost*$holdingCost*$nbMonths/12)/floatval($orderDemand));
			} else {
				$eoq=0;
			}

			return($eoq);
		}
		
		//PRODUCT STORAGE POSITIONS
		public function displayProductStoragePos($productId)
		{
			$content='';
			$this->db->select("(SUM(inn_occ) - SUM(out_occ)) as prodVolume, row_occ, line_occ, shelf_occ");
			$this->db->from('occupancy');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->group_by(array('row_occ', 'line_occ', 'shelf_occ'));
			$records = $this->db->get();
			
			if($records->result()) {
				foreach($records->result() as $record) {
					if($record->prodVolume>0) {
						$product_name = $this->global_model->getItem('products', 'product_id',$productId,'product_name');
						$product_barcode = $this->global_model->getItem('products', 'product_id',$productId,'product_barcode');
						$content .='<tr class="storagepos-row">';
						$content .='<td>'.$product_barcode.'-'.$this->session->userdata('warehouseid').'</td>';
						$content .='<td>'.$product_name.'</td>';
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->prodVolume).' '.$this->lang->line("cubic_meter").'</td>';
						$content .='<td>'.$record->row_occ.'</td>';
						$content .='<td>'.$record->line_occ.'</td>';
						$content .='<td>'.$record->shelf_occ.'</td>';
						$content .='</tr>';
					}
				}
			} else {
				$content =  '<tr class="storagepos-row"><td colspan="6"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_pos_found").'</div></td></tr>';
			}
			return $content;
		}
		
		
		
		
		
		
		
	}
?>