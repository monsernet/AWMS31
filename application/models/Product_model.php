<?php
	class Product_model extends CI_Model {
		
		function __construct(){
			parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->load->database();
			$this->load->model('global_model');
			
		}
		
		//CURRENT STOCK OF A PRODUCT
		public function productInventory ($productId, $warehouseId)
		{
			$this->db->select("SUM(inn) as sumIn, SUM(out_inv) as sumOut ");
			$this->db->from('inventory');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $warehouseId);
			$query = $this->db->get();
			$reservedQty = 0;
			if($row = $query->row()){
				$reservedQty = $this->stockReserved ($productId, $warehouseId);
				return ($row->sumIn-$row->sumOut-$reservedQty);
			} else {
				return 0;
			}
			
		}
		
		//RESERVED STOCK OF A SPECIFC PRODUCT
		public function stockReserved ($productId, $warehouseId)
		{
			$this->db->select("SUM(inn) as sumIn, SUM(out_inv) as sumOut ");
			$this->db->from('inventory_tmp');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $warehouseId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumOut-$row->sumIn);
			} else {
				return 0;
			}
			
		}
		
		//TOTAL RESERVED QTY IN WAREHOUSE 
		public function totalStockReserved ($warehouseId)
		{
			$this->db->select("SUM(inn) as sumIn, SUM(out_inv) as sumOut ");
			$this->db->from('inventory_tmp');
			$this->db->where('warehouse_id', $warehouseId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumOut-$row->sumIn);
			} else {
				return 0;
			}
			
		}
		
		//TOTAL NUMBER OF ITEMS IN WAREHOUSE 
		public function totalItems ($warehouseId)
		{
			$this->db->select("SUM(inn) as sumIn, SUM(out_inv) as sumOut ");
			$this->db->from('inventory');
			$this->db->where('warehouse_id', $warehouseId);
			$query = $this->db->get();
			if($row = $query->row()){
				return ($row->sumIn-$row->sumOut);
			} else {
				return 0;
			}
			
		}
		
		//NUMBER OF ITEMS WITH STOCK ALERT
		public function alertItems( $warehouseId)
		{
			$this->db->select("*");
			$this->db->from('products');
			$records = $this->db->get();
			$alertItems = 0;
			 foreach($records->result() as $record) {
				 $inventory =$this->productInventory ($record->product_id, $warehouseId);
				 if($inventory <= $record->alert_units)
				 {
					 $alertItems ++;
				 }
			 }
			 return $alertItems;
		}
		
		//NUMBER OF ITEMS WITH STOCK ALERT
		public function outOfStockItems( $warehouseId)
		{
			$this->db->select("*");
			$this->db->from('products');
			$records = $this->db->get();
			$alertItems = 0;
			 foreach($records->result() as $record) {
				 $inventory =$this->productInventory ($record->product_id, $warehouseId);
				 if($inventory <= 0)
				 {
					 $alertItems ++;
				 }
			 }
			 return $alertItems;
		}
		
		//LIST OF PRODUCTS WITH STOCK ALERT
		public function alertItemList( $warehouseId)
		{
			$this->db->select("*");
			$this->db->from('products');
			$records = $this->db->get();
			$content = '';
			 foreach($records->result() as $record) {
				 $inventory =$this->productInventory ($record->product_id, $warehouseId);
				 if($inventory <= $record->alert_units)
				 {
					$content .='<tr>';
					$content .='<td>'.$record->product_barcode.'</td>';
					$content .='<td>'.$record->product_name.'</td>';
					$content .='<td>'.$this->global_model->getItem('product_categories', 'category_id', $record->category_id, 'category_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->alert_units).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($inventory).'</td>';
					
					$content .='</tr>';
				 }
			 }
			 return $content;
		}
		
		//LIST OF PRODUCTS OUT OF STOCK
		public function outOfStock( $warehouseId)
		{
			$this->db->select("*");
			$this->db->from('products');
			$records = $this->db->get();
			$content = '';
			 foreach($records->result() as $record) {
				 //product current stock
				 $inventory =$this->productInventory ($record->product_id, $warehouseId);
				 if($inventory <= 0)
				 {
					$content .='<tr>';
					$content .='<td>'.$record->product_barcode.'</td>';
					$content .='<td>'.$record->product_name.'</td>';
					$content .='<td>'.$this->global_model->getItem('product_categories', 'category_id', $record->category_id, 'category_name').'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($record->alert_units).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($inventory).'</td>';
					
					$content .='</tr>';
				 }
			 }
			 return $content;
		}
		
		//SINGLE PRODUCT VOLUME
		public function singleProductVolume( $productId)
		{
			$this->db->select("*");
			$this->db->from('dimensions');
			$this->db->where('product_id', $productId);
			$query = $this->db->get();
			if($row = $query->row()){
				return (floatval($row->length_pr) * floatval($row->width_pr)*floatval($row->height_pr)/1000000);
			} else {
				return 0;
			}
		}
		
		//SINGLE PRODUCT WEIGHT
		public function singleProductWeight( $productId)
		{
			$this->db->select("*");
			$this->db->from('dimensions');
			$this->db->where('product_id', $productId);
			$query = $this->db->get();
			if($row = $query->row()){
				return (floatval($row->weight_pr));
			} else {
				return 0;
			}
		}
		
		//PRODUCT INVENTORY VOLUME 
		public function productInventoryVolume( $productId, $warehouseId)
		{
			$productInventory = $this->productInventory ($productId, $warehouseId);
			$productVolume = $this->singleProductVolume ($productId);
			return $productInventory * $productVolume;
		}
		
		//TOTAL INVENTORY VOLUME
		public function totalInventoryVolume( $warehouseId)
		{
			$this->db->select("*");
			$this->db->from('products');
			$records = $this->db->get();
			$totalVolume = 0;
			 foreach($records->result() as $record) {
				 $productInventoryVolume =$this->productInventoryVolume ($record->product_id, $warehouseId);
				 $totalVolume += $productInventoryVolume;
			 }
			 return $totalVolume;
		}
		
		//ADDING THE LIST OF SHELVES WITH THEIR COLUMES
		public function addStockRacking($volume, $nbShelves) {
			$nbAsiles = intval($this->warehouse_model->nb_aisles ($this->session->userdata('warehouseid')));
			$nbRacksPerLine = intval($this->warehouse_model->nb_racks_per_line ($this->session->userdata('warehouseid')));
			$nbShelvesPerRack = intval($this->storage_model->nb_shelves_rack ($this->session->userdata('warehouseid')));
			$asileArr = array();
			for($i=1;$i<($nbAsiles*3);$i++) {
				array_push($asileArr, $i);
				$i+=2;
			}
			$content ='';
			$fullShelfVolume = floatval($this->storage_model->max_shelf_volume($this->session->userdata('warehouseid')));
			$lastShelfVolume = floatval($volume)-(($nbShelves-1) * $fullShelfVolume);
			for ($i=0 ;$i<=$nbShelves-2;$i++) {
				$content .='<tr id="addStockTableRow'.$i.'">';
				$content .='<td><div class="form-group">
								
								<input type="number" min="0" step="0.01" name="shelfVolume[]" id="shelfVolume'.$i.'" value="'.$fullShelfVolume.'" class="form-control form-control-sm" placeholder="'.$this->lang->line("volume").'" READONLY>
								</div></td>';
				$content .='<td><div class="form-group">
							<select class="form-control select2" name="addStockRow[]" id="addStockRow'.$i.'" REQUIRED >
							<option value=""></option>';
							for($k=1;$k<=$nbRacksPerLine;$k++) {
								$content .='<option value="'.$k.'">'.$k.'</option>';
							}
							$content .='</select></div></td>';
				$content .='<td><div class="form-group">
							<select class="form-control select2" name="addStockLine[]" id="addStockLine'.$i.'" REQUIRED >
							<option value=""></option>';
							$c=0;
							for($j=1;$j<=($nbAsiles*3);$j++) { 
								if (!in_array(($j-1), $asileArr)){
									$c++;
									$content .='<option value="'.$j.'">'.$c.'</option>';
								}
							}
							$content .='</select></div></td>';
				$content .='<td><div class="form-group d-flex">
							<select class="form-control select2 add-stock-shelf" name="addStockShelf[]" id="addStockShelf'.$i.'" REQUIRED >
								<option value=""></option>';
								for($l=1;$l<=$nbShelvesPerRack;$l++) {
									$content .='<option value="'.$l.'">'.$l.'</option>';
								}
							$content .='</select>';
							$content .='</div></td>';
				$content .='</tr>';
				//$content .='<tr><td colspan="4"><span id="errorLocation'.$i.'"></span>';
			}
			$content .='<tr id="addStockTableRow'.($nbShelves-1).'">';
			$content .='<td><div class="form-group">
							<input type="number" min="0" step="0.01" name="shelfVolume[]" id="shelfVolume'.($nbShelves-1).'" value="'.$lastShelfVolume.'" class="form-control form-control-sm" placeholder="'.$this->lang->line("volume").'" READONLY>
							</div></td>';
			$content .='<td><div class="form-group">
							<select class="form-control select2" name="addStockRow[]" id="addStockRow'.$i.'" REQUIRED >
							<option value=""></option>';
							for($k=1;$k<=$nbRacksPerLine;$k++) {
								$content .='<option value="'.$k.'">'.$k.'</option>';
							}
			$content .='<td><div class="form-group">
							<select class="form-control select2" name="addStockLine[]" id="addStockLine'.$i.'" REQUIRED >
							<option value=""></option>';
							$c=0;
							for($j=1;$j<=($nbAsiles*3);$j++) { 
								if (!in_array(($j-1), $asileArr)){
									$c++;
									$content .='<option value="'.$j.'">'.$c.'</option>';
								}
							}
							$content .='</select></div></td>';
			$content .='<td><div class="form-group">
							<select class="form-control select2 add-stock-shelf" name="addStockShelf[]" id="addStockShelf'.$i.'" REQUIRED >
								<option value=""></option>';
								for($l=1;$l<=$nbShelvesPerRack;$l++) {
									$content .='<option value="'.$l.'">'.$l.'</option>';
								}
							$content .='</select></div></td>';
			$content .='</tr>';
			//$content .='<tr><td colspan="4"><span id="errorLocation'.($nbShelves-1).'"></span>';
			return $content;	
		}
		
		//PRODUCT MOVEMENTS
		public function displayProductMvt($productId)
		{
			$content='';
			$this->db->select("*");
			$this->db->from('inventory');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$records = $this->db->get();
			$stock =0;
			$reference='';
			if($records->result()) {
				foreach($records->result() as $record) {
					$product_unit = $this->global_model->getItem('products', 'product_id',$productId,'product_unit');
					$content .='<tr class="inventory-row">';
					$content .='<td>'.date("d-m-Y", strtotime($record->dateinventory)).'</td>';
					if($record->inn > 0) {
						$content .='<td>'.$this->lang->line("stock_in").'</td>';
					} elseif($record->out_inv > 0) {
						$content .='<td>'.$this->lang->line("stock_out").'</td>';
					}						
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($stock).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					if($record->inn > 0) {
						$content .='<td class="text-right text-success">'.$this->global_model->setNumberFormat(floatval($record->inn)).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat(floatval($record->inn)).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					}
					$stock += floatval($record->inn);
					if($record->out_inv > 0) {
						$content .='<td class="text-right text-danger">'.$this->global_model->setNumberFormat(floatval($record->out_inv)).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					} else {
						$content .='<td class="text-right">'.$this->global_model->setNumberFormat(floatval($record->out_inv)).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					}
					$stock -= floatval($record->out_inv);
					$content .='<td class="text-right">'.$this->global_model->setNumberFormat($stock).' '.$this->global_model->getProductUnit($record->product_id).'</td>';
					if($record->transfer_id != 0) {
						$reference = $this->lang->line("transfer_no").$record->transfer_id;
					} elseif($record->delivery_id != 0){
						$reference = $this->lang->line("delivery_no").$record->delivery_id;
					} elseif($record->order_id != 0){
						$reference = $this->lang->line("order_no").$record->order_id;
					} elseif($record->return_id != 0){
						$reference = $this->lang->line("return_no").$record->return_id;
					} else{
						$reference = $this->lang->line("new_stock").$record->lot;
					}
					$content .='<td>'.$reference.'</td>';
					$content .='<td>'.$this->global_model->getItem('users', 'id', $record->user_id, 'fullName').'</td>';
					$content .='</tr>';
				}
			} else {
				$content =  '<tr class="inventory-row"><td colspan="8"><div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> '.$this->lang->line("no_mvt_found").'</div></td></tr>';
			}
			return $content;
		}
		
		
		// INVENTORY BEFORE SPECIFIC DATE
		public function periodicInventory($productId, $endDate)
		{
			$inventory = 0;			
			
			$this->db->select("SUM(inn) as sumIn, SUM(out_inv) as sumOut ");
			$this->db->from('inventory');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->where('dateinventory <= "'. date('Y-m-d', strtotime($endDate)). '"');
			$query = $this->db->get();
			if($row = $query->row()){
				$inventory = $row->sumIn-$row->sumOut;
			} else {
				$inventory = 0;
			}
			return $inventory;
			
		}
		
		// AVERGAE INVENTORY IN A SPECIFIC PERIOD
		public function averageInventory($productId, $startDate, $endDate)
		{
			$beginingInventory = $this->periodicInventory($productId, $startDate);
			$endingInventory = $this->periodicInventory($productId, $endDate);
			return ($beginingInventory + $endingInventory)/2;
		}
		
		// QTY SOLD IN A SPECIFIC PERIOD
		public function periodicSoldQty($productId, $startDate, $endDate)
		{
			$qtySold = 0;			
			
			$this->db->select("SUM(out_inv) as sumOut ");
			$this->db->from('inventory');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->where('dateinventory BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
			$this->db->where('delivery_id !=', 0);
			$query = $this->db->get();
			if($row = $query->row()){
				$qtySold = $row->sumOut;
			} else {
				$qtySold = 0;
			}
			return $qtySold;
		}
		
		// INVENTORY TURNOVER IN A SPECIFIC PERIOD
		public function inventoryTurnover($productId, $startDate, $endDate)
		{
			$productCost = $this->global_model->getItem('price', 'product_id',$productId,'cost');
			$soldQty = $this->periodicSoldQty($productId, $startDate, $endDate);
			$soldCost = $productCost * $soldQty;
			$averageInventory = $this->averageInventory($productId, $startDate, $endDate);
			if($averageInventory !=0) {
				return (round($soldCost / $averageInventory));
			} else {
				return 0;
			}
		}
		
		// ESTIMATED PERIOD TO SELL CURRENT STOCK
		public function estimatesSellingPeriod($productId, $startDate, $endDate)
		{
			$inventoryTurnover = $this->inventoryTurnover($productId, $startDate, $endDate);
			if($inventoryTurnover !=0) {
				return (365/$inventoryTurnover);
			} else {
				return 0;
			}
		}
		
		// INVENTORY BEFORE SPECIFIC DATE
		public function ordersReceived($productId, $startDate, $endDate)
		{
			$total = 0;			
			
			$this->db->select("SUM(qty_appr) as sumIn");
			$this->db->from('order_received');
			$this->db->where('product_id', $productId);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$this->db->where('date_reception BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
			$query = $this->db->get();
			if($row = $query->row()){
				$total = $row->sumIn;
			} else {
				$total = 0;
			}
			return $total;
			
		}
		
		//PRODUCT MOVEMENTS
		public function getSuppProducts($supplierId)
		{
			$content='<option value="">'.$this->lang->line("select_product").'</option>';
			$this->db->select("*");
			$this->db->from('products');
			$this->db->where('supplier_id', $supplierId);
			$this->db->where('status', 1);
			$this->db->where('warehouse_id', $this->session->userdata('warehouseid'));
			$records = $this->db->get();
			if($records->result()) {
				foreach($records->result() as $record) {
					$content.='<option value="'.$record->product_id.'">'.$record->product_name.' ('.$record->product_barcode.')</option>';
				}
			} else {
				$content =  'noproducts';
			}
			return $content;
		}
		
		//ADD PRODUCT TO PACKAGE LIST 
		public function addProductToPackageList( $prId, $qty)
		{
			$content = '';
			$content .='<tr>';
			$content .='<td><input type="hidden" name="packBarPrId[]" value="'.$prId.'">'.$this->global_model->getItem('products', 'product_id', $prId, 'product_barcode').'</td>';
			$content .='<td>'.$this->global_model->getItem('products', 'product_id', $prId, 'product_name').'</td>';
			$content .='<td class="text-right"><input type="hidden" name="packBarPrQty[]" value="'.$qty.'">'.$this->global_model->setNumberFormat($qty).' '.$this->global_model->getProductUnit($prId).'</td>';
			$content .='<td class="text-center"><button type="button" class="btn btn-sm btn-danger removeRow" title="'.$this->lang->line('remove').'"><i class="fa fa-times-circle"></i></button> </td>';
			$content .='</tr>';
			return $content;
		}
		
		//INSERT PRODUCT QR CODE INFORMATION
		function insert_product_qr_data($qr)
		{
			$this->db->insert('product_qrcodes', $qr);
			return ($this->db->affected_rows());
		}
		
		
		
	}
?>