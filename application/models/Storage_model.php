<?php
	class Storage_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//WAREHOUSE TOTAL AREA
		public function warehouse_total_area ($warehouseId)
		{
			$this->db->select("*");
			$this->db->from('warh_dimensions');
			$this->db->where('warehouseId', $warehouseId);
			$query = $this->db->get();
			$area = 0;
			if($row = $query->row()){
				$area = floatval($row->warhLength)*floatval($row->warhWidth) * floatval($row->warhHeigth);
			} 
			return $area;
		}
		
		//STORAGE AREA
		public function storage_area ($warehouseId)
		{
			$this->db->select("*");
			$this->db->from('storage_area');
			$this->db->where('warehouseId', $warehouseId);
			$query = $this->db->get();
			$area = 0;
			if($row = $query->row()){
				$area = floatval($row->StorageLength)*floatval($row->StorageWidth) * floatval($row->StorageHeight);
			} 
			return $area;
		}
		
		//NUMBER OF AISLES
		public function nb_aisles ($warehouseId)
		{
			/* DESCRIPTION
			the racks will be disposed as following :
			- in the begining : 1 rack, then 1 aisle
			- at the end 1 rack and before it there is 1 aisle
			- the rest of the storage length will be divided by 2 racks superposed together followed by 1 aisle
			==> So the total number of aisles will be equal to the number of sets of 2 racks. It means , we will divide the storage length by (aisle+2 racks). then we will divide the number by 2 to get the number of aislea and by 4 to get the number of racks
			*/
			
			$storage_length = $this->global_model->getItem('storage_area', 'warehouseId', $warehouseId, 'StorageLength');
			$aisle_width = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'aisle');
			$rack_width = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackWidth');
			if($aisle_width > 0 AND $rack_width > 0) {
				$totalAisles = floatval($storage_length)/(floatval($aisle_width)+(2*floatval($rack_width)));
			} else {
				$totalAisles = 0;
			}
			return $totalAisles;
		}
		
		//NUMBER OF RACKS
		public function nb_racks ($warehouseId)
		{
			/* DESCRIPTION
				------ See the description of the function nb_racks () ----
			*/
			$storage_length = $this->global_model->getItem('storage_area', 'warehouseId', $warehouseId, 'StorageLength');
			$aisle_width = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'aisle');
			$rack_width = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackWidth');
			/* number of racks by line = storage width / rack length */
			$racksByLine = floor(floatval($this->global_model->getItem('storage_area', 'warehouseId', $warehouseId, 'StorageWidth'))/floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackLength')));
			
			if($aisle_width > 0 AND $rack_width > 0) {
				$totalRacks = 2*$racksByLine*(floatval($storage_length)/(floatval($aisle_width)+(2*floatval($rack_width))));
			} else {
				$totalRacks = 0;
			}
			return $totalRacks;
		}
		
		//NUMBER OF RACKS PER LINE
		public function nb_racks_per_line ($warehouseId)
		{
			
			/* number of racks by line = storage width / rack length */
			$storage_width = floatval($this->global_model->getItem('storage_area', 'warehouseId', $warehouseId, 'StorageWidth'));
			$rack_length = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackLength'));
			$racksByLine = floatval($rack_length)> 0 ? floor($storage_width / $rack_length) : 0 ;
			return $racksByLine;
		}
		
		
		
		//NUMBER OF SHELVES IN ALL STORAGE AREA
		public function nb_shelves ($warehouseId)
		{
			$rack_height = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackHeight');
			$shelf_height = $this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'shelfHeight');
			/* nb of shelves by rack = rack height / shelf height */
			if($shelf_height > 0) {
				$shelves_rack = floor(floatval($rack_height)/floatval($shelf_height));
				$total_shelves = $this->nb_racks($warehouseId) * $shelves_rack;
			} else {
				$shelves_rack = 0;
				$total_shelves = 0;
			}
			return $total_shelves;
			
		}
		
		//MAX VOLUME OF A NORMAL RACK
		public function max_rack_volume ($warehouseId)
		{
			$rack_height = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackHeight'));
			$rack_length = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackLength'));
			$rack_width = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackWidth'));
			return $rack_height * $rack_length * $rack_width ;
		}
		
		//VOLUME OF A RACK DEFINED BY ROW AND LINE NUMBERS
		public function rack_volume ($rowId, $lineId)
		{
			$this->db->select("SUM(inn_occ) as sumIn, SUM(out_occ) as sumOut ");
			$this->db->from('occupancy');
			$this->db->where('row_occ', $rowId);
			$this->db->where('line_occ', $lineId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumIn-$row->sumOut);
			} else {
				return 0;
			}
			
		}
		
		//MAX VOLUME OF A NORMAL SHELF
		public function max_shelf_volume ($warehouseId)
		{
			$shelf_height = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'shelfHeight'));
			$shelf_length = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackLength'));
			$shelf_width = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackWidth'));
			return ($shelf_height * $shelf_length * $shelf_width) ;
		}
		
		// VOLUME OF A specific SHELF
		public function shelf_current_volume ($rowId, $lineId, $shelfId)
		{
			$this->db->select("SUM(inn_occ) as sumIn, SUM(out_occ) as sumOut ");
			$this->db->from('occupancy');
			$this->db->where('row_occ', $rowId);
			$this->db->where('line_occ', $lineId);
			$this->db->where('shelf_occ', $shelfId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumIn-$row->sumOut);
			} else {
				return 0;
			}
		}
		
		//NUMBER OF SHELVES PER RACK
		public function nb_shelves_rack($warehouseId)
		{
			$rack_height = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackHeight'));
			$shelf_length = floatval($this->global_model->getItem('storage_racking', 'warehouseId', $warehouseId, 'rackLength'));
			return floor($rack_height/$shelf_length);
		}
		
		
		
		// LIST OF STORAGE POSITIONS FOR A DEFINED PRODUCT
		public function storage_positions_by_product ($productId)
		{
			$this->db->select("(SUM(inn_occ) - SUM(out_occ)) as volume, row_occ, line_occ, shelf_occ");
			$this->db->from('occupancy');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->group_by(array('row_occ', 'line_occ', 'shelf_occ'));
			$records = $this->db->get();
			$content = '';
			$count = 0;
			if($records->result()) {
				foreach($records->result() as $record) {
					if(floatval($record->volume) > 0) {
						$count++;
						$content .='<tr>';
						$content .='<td><input class="custom-checkbox form-control control-sm mr-2 mb-0" type="checkbox" name="chosenVolumes[]"></td>';
						$content .='<td><input type="hidden" name="currRow[]" value="'.$record->row_occ.'">
										<input type="hidden" name="currLine[]" value="'.$record->line_occ.'">
										<input type="hidden" name="currShelf[]" value="'.$record->shelf_occ.'">R'.$record->row_occ.'-L'.$this->warehouse_model->getRealLocation($record->line_occ).'-S'.$record->shelf_occ.'</td>';
						$content .='<td class="text-right"><input type="hidden" class="form-control control-sm " min="0" step="0.01" name="shelfPrVolume[]" id="shelfPrVolume'.$count.'" value="'.$record->volume.'">'.number_format($record->volume,2).' '.$this->lang->line('cubic_meter').'</td>';
						$content .='<td><input type="number" class="form-control control-sm pickedvolume" min="0" step="0.01" name="pickedVolume[]" id="pickedVolume'.$count.'" onkeyup="calculateRemainingVolume()" value="" ></td>';
						$content .='<td><input type="number" class="form-control control-sm " name="remainingVolume[]"  value="" READONLY></td>';
						$content .='</tr>';
					}
				}
			} else {
				$content .='<tr>';
				$content .='<td colspan="5">No storage positions found.</td>';
				$content .='</tr>';
			}
			return $content;
		}
		
		// LIST OF STORAGE POSITIONS FOR A DEFINED PRODUCT -- DELIVERY PICKUP
		public function delivery_storage_positions_by_product ($productId)
		{
			$this->db->select("(SUM(inn_occ) - SUM(out_occ)) as volume, row_occ, line_occ, shelf_occ");
			$this->db->from('occupancy');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->group_by(array('row_occ', 'line_occ', 'shelf_occ'));
			$records = $this->db->get();
			$content = '';
			$count = 0;
			if($records->result()) {
				foreach($records->result() as $record) {
					if(floatval($record->volume) > 0) {
						$count++;
						$content .='<tr>';
						$content .='<td><input class="custom-checkbox form-control control-sm mr-2 mb-0" type="checkbox" name="chosenVolumes[]"></td>';
						$content .='<td><input type="hidden" name="currRow[]" value="'.$record->row_occ.'">
										<input type="hidden" name="currLine[]" value="'.$record->line_occ.'">
										<input type="hidden" name="currShelf[]" value="'.$record->shelf_occ.'">R'.$record->row_occ.'-L'.$this->warehouse_model->getRealLocation($record->line_occ).'-S'.$record->shelf_occ.'</td>';
						$content .='<td class="text-right"><input type="hidden" class="form-control control-sm " min="0" step="0.01" name="shelfPrVolume[]" id="shelfPrVolume'.$count.'" value="'.$record->volume.'">'.number_format($record->volume,2).' '.$this->lang->line('cubic_meter').'</td>';
						$content .='<td><input type="number" class="form-control control-sm pickedvolume" min="0" step="0.01" name="pickedVolume[]" id="pickedVolume'.$count.'" onkeyup="calculateDeliveryRemainingVolume()" value="" ></td>';
						$content .='<td><input type="number" class="form-control control-sm " name="remainingVolume[]"  value="" READONLY></td>';
						$content .='</tr>';
					}
				}
			} else {
				$content .='<tr>';
				$content .='<td colspan="5">No storage positions found.</td>';
				$content .='</tr>';
			}
			return $content;
		}
		
		
		
		
		
	}
?>