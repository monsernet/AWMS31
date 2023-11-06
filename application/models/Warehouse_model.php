<?php
	class Warehouse_model extends CI_Model {
		
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
		
		//GET VISUAL LOCATIONS 
		public function getRealLocation($lineNo) {
			$realLine = $this->global_model->getItem('storage_reallines', 'virtualLine', $lineNo, 'visualLine');
			return $realLine;
		}
		
		
		
		
		
		
	}
?>